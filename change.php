<?php
    require 'connectdb.php';
	session_start();
	if(!$_SESSION['login']){
		header('Location: login.php');
	}

    $con = (new DB())->getConnect();
	$id = $_GET['id'];
	$sql = "SELECT * FROM sanpham WHERE id = '$id'";

	$query = mysqli_query($con, $sql) or die (mysqli_error($con)); 

	$row = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Thay đổi</title>
</head>
<body>
	<form action="" method="POST">
		<div>
			<p>Tên sản phẩm</p>
			<input type="text" name="tensp" value="<?php echo $row['tensp']; ?>">
		</div>
		<div>
			<p>Loại sản phẩm</p>
			<input type="text" name="loaisp" value="<?php echo $row['loaisp']; ?>">
		</div>
		<div>
			<p>Số lượng</p>
			<input type="number" name="soluong" value="<?php echo $row['soluong']; ?>">
		</div>
		<div>
			<p>Đơn giá</p>
			<input type="number" name="dongia" value="<?php echo $row['dongia']; ?>">
		</div>
		<button name="submit">Thay đổi</button>
	</form>
</body>
<?php 
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
				$update = mysqli_query($con, "UPDATE sanpham SET tensp = '$tensp', loaisp = '$loaisp', soluong = '$soluong', dongia = '$dongia' WHERE id = '$id'");
				header("Location: listproduct.php");
			}
		}
	}
?>
</html>