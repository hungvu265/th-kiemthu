<?php
require 'connectdb.php';
session_start();

$con = (new DB())->getConnect();
$id = $_GET['id'];

$sql = "INSERT INTO hacker (data) VALUES ('$$id')";

$query = mysqli_query($con, $sql) or die (mysqli_error($con));