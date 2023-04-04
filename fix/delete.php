<?php
	session_start();
	if(!$_SESSION['login']){
		header('Location: login.php');
	}
	
	$con = mysqli_connect("localhost", "root", "", "laravel");
	$id = $_GET['id'];
	$sql = mysqli_query($con, "DELETE FROM sanpham WHERE id = '$id'");
	header("Location: listproduct.php");
?>
