<?php
    class Router {
        private static $routes = [];

        private function __construct() {}
        private function __clone() {}

        public static function init(array $_routes){
            foreach($_routes as $_route){
                Router::route($_route['method'], $_route['path'], $_route['callback']);
            }

            Router::execute($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
        }

        public static function route($method, $pattern, $callback)
        {
            $pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';
            
            self::$routes[$method][$pattern] = $callback;
        }
   
        public static function execute($url, $request_method)
        {   
            $param_start = strpos($url, '?');

            if($param_start !== false){
                $url = substr($url, 0, $param_start);
            }

            foreach (self::$routes[$request_method] as $pattern => $callback)
            {
                if (preg_match($pattern, $url, $params))
                {
                    array_shift($params);
                    return call_user_func_array($callback, array_values($params));
                }
            }
            
            Router::ErrorPage404();
        }

        public static function ErrorPage404()
        {
            $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
            header('HTTP/1.1 404 Not Found');
            header("Status: 404 Not Found");
            echo "404";
            exit;
        }
    }