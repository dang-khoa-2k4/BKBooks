<?php
	require_once('./App/Route/router.php');
	require_once './App/config.php'; 
	session_start();
	$router = new router();
	$URI = $_SERVER['REQUEST_URI'];
	$router->handleURL($URI);
?>

