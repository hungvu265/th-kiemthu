<!DOCTYPE html>
<html>
<head>
	<title>List product</title>
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!-- JavaScript Bundle with Popper -->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
	<h3 class="text-center">Danh sách sản phẩm</h3>
	<a href="insert.php" class="btn btn-primary">Thêm sản phẩm</a>

	<input type="search" name="timkiem" id="timkiem">
	<button class="btn btn-primary" id="submit">Tìm kiếm</button>

	<?php
    require 'connectdb.php';
    $con = (new DB())->getConnect();
	session_start();
	if(!$_SESSION['login']){
		header('Location: login.php');
	}

	$sql = mysqli_query($con, "SELECT * FROM sanpham");
	?>
	<table class="table table-bordered">
		<thead>
			<tr>
				<td>Id</td>
				<td>Tên sản phẩm</td>
				<td>Loại sản phẩm</td>
				<td>Số lượng</td>
				<td>Đơn giá</td>
			</tr>
		</thead>
		<tbody class="danhsach">
			<?php foreach($sql as $key=>$value): ?>
				<tr>
					<td><?= $key+1; ?></td>
					<td><?= $value['tensp']; ?></td>
					<td><?= $value['loaisp']; ?></td>
					<td><?= $value['soluong']; ?></td>
					<td><?= $value['dongia']; ?></td>
					<td><a href="comment.php?id=<?= $value['id']; ?>" class="btn btn-primary">Bình luận</a>
					<td><a href="delete.php?id=<?= $value['id']; ?>" class="btn btn-danger">Xóa</a>
				</tr>
			<?php endforeach; ?>

		</tbody>
	</table>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#submit').click(function(event) {
				var data = $('#timkiem').val();
				$.post('ajax.php', {data: data}, function(data) {
					$('.danhsach').html(data);
				});
			});
		});
		
	</script>
</body>
</html>