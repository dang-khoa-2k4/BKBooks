<?php
    $controller = ucfirst($_GET['controller']) . 'Controller';
    require('Controller/user/' . $controller . '.php'); /*require controller tương ứng*/
    $controller = ucfirst($controller); /*chuyển đổi chữ cái đầu tiên của chuỗi thành chữ hoa */

    $actionName = $_REQUEST['action'] ?? 'index';
    $request = new $controller; /*khởi tạo một class controller tương ứng với biến $controller*/

    $request -> $actionName();
?>