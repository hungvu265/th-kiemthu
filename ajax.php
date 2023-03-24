<?php
    require 'connectdb.php';
    $con = (new DB())->getConnect();

	//Tìm kiếm
	$timkiem = $_POST['data'];

	$sql = "SELECT * FROM sanpham WHERE tensp LIKE '%$timkiem%'";

	$query = mysqli_query($con, $sql) or die (mysqli_error($con)); 
?>

<?php foreach($query as $key=>$value): ?>
	<tr>
		<td><?= $key+1; ?></td>
		<td><?= $value['tensp']; ?></td>

		<td><?= $value['loaisp']; ?></td>
		<td><?= $value['soluong']; ?></td>
		<td><?= $value['dongia']; ?></td>
		<td><a href="change.php?id=<?= $value['id']; ?>" class="btn btn-primary">Thay đổi</a>
		<td><a href="delete.php?id=<?= $value['id']; ?>" class="btn btn-danger">Xóa</a>
	</tr>
<?php endforeach; ?>
