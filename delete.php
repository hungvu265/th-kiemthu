<?php
	require 'connectdb.php';
	session_start();
	if(!$_SESSION['login']){
		header('Location: login.php');
	}

	$con = (new DB())->getConnect();
	$id = $_GET['id'];
	$sql = mysqli_query($con, "DELETE FROM sanpham WHERE id = '$id'") or die(mysqli_error($con));
	header("Location: listproduct.php");
?>
