<?php
	session_start();
	$router = new router();
	$URI = $_SERVER['REQUEST_URI'];
	$router->handleURL($URI);
?>

