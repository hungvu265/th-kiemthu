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
    require 'connectdb.php';
	session_start();
    $con = (new DB())->getConnect();

    //Auto login if exist cookie
    if (isset($_COOKIE['customer_info'])) {
        $cookie = json_decode($_COOKIE['customer_info']);
        $username = $cookie->username;
        $password = $cookie->password;

        goto loginWithCookie;
    }

	//Login
	if(isset($_POST['dangnhap'])){
		if(empty($_POST['username']) || empty($_POST['password'])){
			echo "Hãy điền đầy đủ thông tin";
		}
		else{
			$username = $_POST['username'];
			$password = $_POST['password'];

            loginWithCookie:
			$sql = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
			$row = mysqli_fetch_assoc($sql);
			if($row){
                if (!password_verify($password, $row['password'])) {
                    echo "Đăng nhập thất bại";
                    die();
                }

                //Create session
				$_SESSION['login'] = 1;

                //Create cookie expire 1 day
                $data = ['username' => $username, 'password' => $password, 'bank' => $row['bank']];
                setcookie('customer_info', json_encode($data), time() + 86400);
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

