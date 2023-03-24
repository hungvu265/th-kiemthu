<!DOCTYPE html>
<html>
<head>
	<title>Thêm sản phẩm</title>
</head>
<body>
	<form action="" method="POST">
		<div>
			<p>Tên sản phẩm</p>
			<input type="text" name="tensp">
		</div>
		<div>
			<p>Loại sản phẩm</p>
			<input type="text" name="loaisp">
		</div>
		<div>
			<p>Số lượng</p>
			<input type="number" name="soluong">
		</div>
		<div>
			<p>Đơn giá</p>
			<input type="number" name="dongia">
		</div>
		<button name="submit">Thêm sản phẩm</button>
	</form>
</body>
<?php
    require 'connectdb.php';
    $con = (new DB())->getConnect();
	session_start();
	if(!$_SESSION['login']){
		header('Location: login.php');
	}

	if (isset($_POST['submit'])) {
		if (empty($_POST['tensp']) || empty($_POST['loaisp']) || empty($_POST['soluong']) || empty($_POST['dongia'])) {
			echo "Điền đầy đủ thông tin";
		}
		else{
			$tensp = $_POST['tensp'];
			$loaisp = $_POST['loaisp'];
			$soluong = $_POST['soluong'];
			$dongia = $_POST['dongia'];
			if($soluong <= 0){
				echo "Số lượng phải >= 1";
			}
			else if($dongia < 10000){
				echo "Đơn giá tối thiểu là 10.000";
			}
			else{
				$insert = mysqli_query($con, "INSERT INTO sanpham (tensp, loaisp, soluong, dongia) VALUES ('$tensp', '$loaisp', '$soluong', '$dongia')");
				header("Location: listproduct.php");
			}
		}
	}
?>

</html>