<?php
    class LoginController
    {
        public function __construct(){}

        public static function show()
        {
            $view = new View();

            if(isset($_SESSION['user']) && base64_decode($_SESSION['user']) == 'admin'){
                header('Location: ./');
            }
            else {
                $view->generate('login_page.php');
            }
        }

        public static function login()
        {
            $data = json_decode(file_get_contents('php://input'), true);

            if($data['login'] == 'admin' && $data['password'] == '123'){
                $_SESSION['user'] = base64_encode('admin');
                echo 'OK';
                exit;
            }
            else {
                echo 'ERROR';
            }
        }

        public static function logout()
        {
            $_SESSION['user'] = "";
            echo 'OK';
            exit;
        }

        public static function isAuth()
        {
            if(empty($_SESSION['user'])){
                return false;
            }
            return true;
        }
    }