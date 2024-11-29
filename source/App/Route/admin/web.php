<?php
    $controller = $_GET['controller'];
    $controller = ucfirst($controller) . 'Controller'; /*chuyển đổi chữ cái đầu tiên của chuỗi thành chữ hoa */
    require('./Controller/admin/' . $controller . '.php'); /*require controller tương ứng*/


    $actionName = $_REQUEST['action']  ?? 'index';
    $request = new $controller; /*khởi tạo một class controller tương ứng với biến $controller*/

    $request -> $actionName();
?>