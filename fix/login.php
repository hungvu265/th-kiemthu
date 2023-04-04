<!DOCTYPE html>
<html>
<head>
	<title>Đăng nhập</title>
</head>
<body>
	<form method="POST" action="">
		username<input type="text" name="username">
		password<input type="password" name="password">
		<input type="submit" name="dangnhap" value="Đăng nhập">
	</form>
</body>
</html>

<?php
	session_start();
    require 'connectdb.php';
    $con = (new DB())->getConnect();

	if(isset($_POST['dangnhap']))
	{
		if(empty($_POST['username']) || empty($_POST['password'])){
			echo "Hãy điền đầy đủ thông tin";
		}
		else{
			$username = $_POST['username'];
			$password = $_POST['password'];

			$stmt = $con->prepare('SELECT * FROM users WHERE username = ? AND password = ?');

			$stmt->bind_param('ss', $username, $password); 

			$stmt->execute();

			$result = $stmt->get_result();
			$check = mysqli_fetch_row($result);
			if(empty($check)){
				echo "Đăng nhập thất bại";
			}
			else{
				$_SESSION['login'] = 1;
				header('Location: listproduct.php');
			}
		}
		
	}
	
?>