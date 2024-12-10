<?php
class Router
{
    private $controller;
    private $action;
    private $params;
    private $role;

    public function __construct()
    {
        // Default controller, action, params, and role
        $this->controller = 'Book'; // Default controller
        $this->action = 'getAllbook'; // Default action
        $this->params = [];
        $this->role = 'guest'; // Default role (guest)
    }

    /**
     * Main function to handle the URL and set the controller, action, and parameters.
     */
    public function handleURL($URI)
    {
        $url = $this->getURL($URI);
        
        $this->setControllerFromURL($url);
        $this->setActionFromURL($url);
        $this->setParamsFromURL($url);
        $this->checkUserRole();

        $this->loadController();
    }

    /**
     * Get the URL from the request
     */
    public function getURL($URI)
    {
        $url = $URI;
        $url = explode('?', $url)[0]; // Remove query string
        $url = rtrim($url, '/'); // Remove trailing slash
        $url = explode('/', $url); // Split by slashes
        unset($url[0]); // Remove the first empty segment
        $url = array_values($url); // Re-index the array
        return $url; // Remove any empty values
    }

    /**
     * Set the controller based on URL (first segment)
     */
    private function setControllerFromURL($url)
    {
        if (!empty($url[0])) {
            $this->controller = ucfirst($url[0]); // Capitalize controller name
        }
    }

    /**
     * Check if the user has the appropriate role and is authenticated
     */
    private function checkUserRole()
    {
        if (isset($_SESSION['Role'])) {
            $this->role = $_SESSION['Role'];
            return true;
        }
        return false;
    }

    /**
     * Load the controller based on the role (admin, member, guest)
     */
    private function loadController()
    {
        $controllerName = $this->controller . 'Controller'; // Example: 'Home' -> 'HomeController'
        $controllerFile = 'App/Controller/' . $this->role . '/' . $controllerName . '.php';

        if (file_exists($controllerFile)) {
            require_once($controllerFile);
            if (!class_exists($controllerName)) {
                echo 'Controller class not found.';
                exit();
            }
            $this->controller = new $controllerName();
            if (method_exists($this->controller, $this->action)) {
                call_user_func_array([$this->controller, $this->action], $this->params);
            } else {
                echo 'Action not found.';
                exit();
            }
        } else {
            echo 'Controller not found.';
            exit();
        }
    }

    /**
     * Set the action based on URL (second segment)
     */
    private function setActionFromURL($url)
    {
        if (!empty($url[1])) {
            $this->action = $url[1] . ucfirst($this->controller); // Concatenate action with controller (e.g, addCustomer)')
        }
    }

    /**
     * Set parameters based on URL (remaining segments)
     */
    private function setParamsFromURL($url)
    {
        unset($url[0], $url[1]); // Remove the first two segments (controller and action)
        $this->params = $url ? array_values($url) : []; // Set parameters (remaining URL segments)
    }
}
