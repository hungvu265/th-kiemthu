<!DOCTYPE html>
<html>
<head>
	<title>Đăng nhập</title>
</head>
<body>
	<form method="POST" action="" class="form-group">
		Email<input type="text" name="username" class="form-control" placeholder="Nhập email">
		Password<input type="password" name="password" class="form-control" placeholder="Nhập password">
		<input type="submit" name="dangnhap" value="Đăng nhập">
	</form>
			
	
	<?php
	session_start();
	$con = mysqli_connect("localhost", "root", "", "laravel");
	
	//Đăng nhập
	if(isset($_POST['dangnhap'])){
		if(empty($_POST['username']) || empty($_POST['password'])){
			echo "Hãy điền đầy đủ thông tin";
		}
		else{

			$username = $_POST['username'];
			$password = $_POST['password'];
			
			$sql = mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND password='$password'");

			$row = mysqli_fetch_assoc($sql);
			if($row){
				$_SESSION['login'] = 1;
				header('Location: listproduct.php');
			}
			else{
				echo "Đăng nhập thất bại";
			}
		}
	}
	?>
</body>
</html>

