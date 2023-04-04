<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST" action="" class="form-group">
		Email <input type="text" name="username" class="form-control" placeholder="Nhập username">
		Password <input type="password" name="password" class="form-control" placeholder="Nhập password">
		Nhập lại password <input type="password" name="repassword" class="form-control" placeholder="Nhập lại password">
		<input type="submit" name="dangki" value="Đăng kí">
	</form>

	<?php
	$con = mysqli_connect("localhost", "root", "", "laravel");

	//Đăng kí
	if(isset($_POST['dangki'])){
		if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['repassword'])) {
			echo "Đăng kí thất bại";
		}
		else{
			$username = $_POST['username'];
			$password = $_POST['password'];
			$repassword = $_POST['repassword'];

			if($password === $repassword){
				mysqli_query($con, "INSERT INTO users (username, password) VALUES ('$username', '$password')") or die (mysqli_error($sql));
				echo "Đăng kí thành công";
			}
			else{
				echo "Đăng kí thất bại";
			}
		}
	}

	?>
</body>
</html>