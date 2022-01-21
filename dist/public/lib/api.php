<?php
require __DIR__.'/router.php';
require __DIR__.'/db.php';
require __DIR__.'/helper.php';


class RandomAPI {
    protected $DB;
    protected $Router;

    protected $conf = array();
    protected $route = array();
    protected $clientHash = 'unknown';
    protected $response = array(
        'time' => NULL,
        'request' => NULL,
        'errors' => array(),
        'data' => array(),
    );

    public function __construct($conf) {
        // Save conf for later use.
        $this->conf = $conf;

        // Parse route.
        $this->Router = new WebRouter();
        $this->route = $this->Router->parse_route();
        if (!$this->route['node']) {
            $this->route = $this->Router->parse_route(array('r' => $this->conf['validNodes'][array_rand($this->conf['validNodes'])]));
        }
        $this->response['time'] = $this->route['time'];
        $this->response['request'] = $this->route['request'];

        // Check if node is valid.
        if (!in_array($this->route['node'], $this->conf['validNodes'])) {
            $this->response['errors'][] = sprintf('Invalid node: %s', $this->route['node']);
            return;
        }

        // Save client IP as hash.
        $clientIP = getClientIP();
        if ($clientIP) {
            $this->clientHash = hash('ripemd160', $clientIP);
        }

        // Check/init database.
        $dbFile = realpath($this->conf['dbFile']);
        if (!$dbFile || !is_file($dbFile))  {
            $this->response['errors'][] = 'Could not connect to database.';
            return;
        }
        $this->DB = new DatabaseSQLite3($dbFile);

        // If all good, process request.
        $this->DB->open(TRUE);
        $this->processRequest();
        $this->DB->close();
    }

    public function processRequest() {
        // Get clients requests from today for rate limiting.
        $q = 'SELECT accessTime
              FROM sys_accesslog
              WHERE clientHash = :clientHash
              AND accessTime >= strftime(\'%s\', \'now\', \'-86400 seconds\')
              ORDER BY id DESC;';
        $v = array(
            array('clientHash', $this->clientHash, SQLITE3_TEXT),
        );
        $r = $this->DB->query($q, $v);

        // Stop if rate limit request per day applies.
        if (count($r) >= $this->conf['rateLimiting']['maxRequestsPerDay']) {
            $this->response['errors'][] = sprintf('Maximum %s requests per 24 hours.', $this->conf['rateLimiting']['maxRequestsPerDay']);
            return;
        }

        // Stop if rate limit delay applies.
        if (isset($r[0]) && isset($r[0]['accessTime']) && time() - $r[0]['accessTime'] < $this->conf['rateLimiting']['requestDelay']) {
            $this->response['errors'][] = sprintf('Minimum %ss delay between requests.', $this->conf['rateLimiting']['requestDelay']);
            return;
        }

        // Log access and return response data if rate limit does not apply.
        $q = 'INSERT INTO sys_accesslog (accessTime, clientHash, apiRequest)
              VALUES (:accessTime, :clientHash, :apiRequest);';
        $v = array(
            array('accessTime', time(), SQLITE3_INTEGER),
            array('clientHash', $this->clientHash, SQLITE3_TEXT),
            array('apiRequest', $this->route['request'], SQLITE3_TEXT),
        );
        $this->DB->write($q, $v);

        // If all good, get response data.
        $this->response['data'] = $this->getResponseData();
    }

    protected function getResponseData() {
        $table = sprintf('data_%s', $this->route['node']);
        $columns = 'id, val';
        $minCount = 1;
        $maxCount = 10;
        $count = $minCount;

        if (isset($this->route['var']['count']) && ctype_digit($this->route['var']['count'])) {
            if ((int)$this->route['var']['count'] >= $minCount && (int)$this->route['var']['count'] <= $maxCount) {
                $count = $this->route['var']['count'];
            }
        }

        if (in_array('noid', $this->route['flag'])) {
            $columns = 'val';
        }

        $q = sprintf('
        SELECT %2$s FROM %1$s WHERE id IN (
            SELECT id FROM %1$s
            ORDER BY RANDOM() LIMIT :limit
        ) ORDER BY val ASC;', $table, $columns);

        $v = array(
            array('limit', $count, SQLITE3_INTEGER),
        );

        // if ($count == 1) {
        //     $r = $this->DB->querySingle($q, $v);
        // }
        // else {
        //     $r = $this->DB->query($q, $v);
        // }
        $r = $this->DB->query($q, $v);

        if (!$r) {
            $this->response['errors'][] = 'Request returned no result.';
            return;
        }

        return $r;
    }

    public function output() {
        if (!$this->conf['debugApi']) {
            header('Content-type: application/json; charset=utf-8');
            print(jenc($this->response));
        }
        else {
            header('Content-type: text/plain; charset=utf-8');
            print_r($this->response);
            print_r($this);
        }
        exit;
    }
}
