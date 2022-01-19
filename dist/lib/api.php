<?php
require __DIR__.'/db.php';
require __DIR__.'/router.php';
require __DIR__.'/helper.php';


class RandomAPI {
    protected $Router;
    protected $DB;
    protected $dbFile;
    protected $validNodes;
    protected $route;
    protected $response = array(
        'request' => NULL, // $this->route['request']
        'errors' => array(), // errors, if any
        'data' => array(), // response data
    );

    public function __construct($dbFile, $validNodes) {
        $this->Router = new GETRouter();
        $this->route = $this->Router->parse_route();

        $this->response['request'] = $this->route['request'];

        $this->dbFile = realpath($dbFile);
        if (!$this->dbFile) {
            $this->response['errors'][] = 'dbFile not found.';
            return;
        }
        $this->DB = new DatabaseSQLite3($this->dbFile);

        $this->validNodes = $validNodes;
    }

    public function processRequest() {
        if (!in_array($this->route['node'], $this->validNodes)) {
            $this->response['errors'][] = sprintf('Invalid or no node defined: %s', $this->route['node']);
            return;
        }

        $table = $this->route['node'];
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

        $this->DB->open();

        if ($count == 1) {
            $r = $this->DB->querySingle($q, $v);
        }
        else {
            $r = $this->DB->query($q, $v);
        }

        $this->DB->close();

        if (!$r) {
            $this->response['errors'][] = 'Got no result from database.';
            return;
        }

        $this->response['data'] = $r;
    }

    public function output() {
        header('Content-type: application/json; charset=utf-8');
        print(jenc($this->response));
        exit(count($this->response['errors']));
    }
}
