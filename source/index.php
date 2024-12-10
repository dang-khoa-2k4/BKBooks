<?php
	require_once('./App/Route/router.php');
	require_once './App/config.php'; 
	session_start();

	require_once(__DIR__ . '/App/config.php');
	cors();
	
	$router = new router();
	$URI = $_SERVER['REQUEST_URI'];
	$router->handleURL($URI);
?>

