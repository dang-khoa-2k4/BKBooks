<?php

class App
{
    private $controller, $action, $params, $role;

    public function __construct()
    {
        $this->controller = 'Home';
        $this->action = 'index';
        $this->params = [];
        $this->role = 'guest';
        $this->handleURL();
    }

    public function handleURL()
    {
        $url = $this->getURL();

        if (!empty($url[0])) {
            $this->controller = $url[0];
            if (isset($_SESSION['Role'])) {
                $this->role = $_SESSION['Role']; // admin, member, guest
                if (file_exists('Controller/' . $this->role . '/' . ucfirst($url[0]) . 'Controller.php')) {
                    require_once 'Controller/' . $this->role . '/' . ucfirst($url[0]) . 'Controller.php';
                    $this->controller = new $this->controller;
                } else {
                    echo 'Controller không tồn tại hoặc bạn không có quyền truy cập';
                    // header('Location: /login');
                    exit();
                }
            } else {
                header('Location: /login');
                exit();
            }
        } else {
            if (isset($_SESSION['Role'])) {
                $this->role = $_SESSION['Role'];
                if ($this->role == 'admin') {
                    require_once 'View/admin/pages/home.php';
                    return;
                }
            }
            require_once 'View/user/pages/home.php';
            return;
        }

        if (!empty($url[1])) {
            if (method_exists($this->controller, $this->action)) {
                $this->action = $url[1];
            } else {
                echo 'Action không tồn tại';
                return;
            }
        }
        unset($url[0], $url[1]);
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->action], $this->params);
    }

    public function getURL()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url)[0];  // Remove query string
        $url = rtrim($url, '/');  // Remove trailing slash
        $url = explode('/', $url); // Split by slashes
        $url = array_filter($url);  // Remove empty values
        return $url;
    }
}

?>
