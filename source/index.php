<?php
	// print_r($_SERVER['REQUEST_URI']);
	session_start();
	require 'bootstrap.php';
	$app = new App();

	// if (isset($_SESSION['Role'])){
	// 	if ($_SESSION['Role'] == 'admin'){
	// 		if (!isset($_GET['controller'])) {
	// 			header('Location: ?controller=home');
	// 			return;
	// 		}
	// 		require 'Route/admin/web.php'; 
	// 		return;
	// 	}
	// 	if ($_SESSION['Role'] == 'member'){
	// 		if (!isset($_GET['controller'])) {
	// 			require 'View/user/pages/home.php'; /*require giao diện trang chủ*/
	// 			return;
	// 		}
	// 		require 'Route/user/web.php'; 
	// 		return;
	// 	}
	// }
	// #This is guest
	// if (!isset($_GET['controller'])) {
	// 	require 'View/user/pages/home.php'; /*require giao diện trang chủ*/
	// 	return;
	// }
	// require 'Route/guest.php';
?>