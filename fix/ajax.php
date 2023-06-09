<?php
    require 'connectdb.php';
    $con = (new DB())->getConnect();

	//Tìm kiếm
	$timkiem = "%{$_POST['data']}%";

	$stmt = $con->prepare("SELECT * FROM sanpham WHERE tensp LIKE ?");
	$stmt->bind_param("s", $timkiem);
	$stmt->execute();

	$query = $stmt->get_result();	
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
