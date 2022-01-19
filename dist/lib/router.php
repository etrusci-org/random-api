<?php
/* Usage:

test.php:

    $Router = new GETRouter();
    $route = $Router->parse_route();
    var_dump($route);

test requests:

    - test.php
    - test.php?r=foo/bar
    - test.php?r=foo/moo:cow
    - test.php?r=wee/yay:batman/spiderman/foo
*/

class GETRouter
{
    public $requestKey = 'r';
    public $defaultRoute = array(
        'time' => NULL,
        'request'=> NULL,
        'node' => NULL,
        'var' => array(),
        'flag' => array(),
    );


    public function parse_route($array=NULL, $sort=TRUE) {
        $route = $this->defaultRoute;
        $route['time'] = microtime(TRUE);

        if (!$array) {
            $request = array_key_exists($this->requestKey, $_GET) ? $_GET[$this->requestKey] : NULL;
        }
        else {
            $request = array_key_exists($this->requestKey, $array) ? $array[$this->requestKey] : NULL;
        }

        $route['request'] = trim($request);

        if (!$request) {
            return $route;
        }

        $dump = explode('/', $request, 2);

        $route['node'] = count($dump) > 0 ? $dump[0] : NULL;

        if (count($dump) > 1) {
            $dump = explode('/', $dump[1]);
            foreach ($dump as $v) {
                if (stristr($v, ':')) {
                    $v = explode(':', $v);
                    if (count($v) == 2 && !empty($v[0]) && !empty($v[1])) {
                        $route['var'][$v[0]] = $v[1];
                    }
                }
                else {
                    if (!empty($v)) {
                        $route['flag'][] = $v;
                    }
                }
            }
        }

        if ($sort) {
            asort($route['var']);
            asort($route['flag']);
        }

        // var_dump($route);
        return $route;
    }
}
