<?php
require 'connectdb.php';
session_start();
if(!$_SESSION['login']){
    header('Location: login.php');
}

$con = (new DB())->getConnect();
$id = $_GET['id'];
$stmt = $con->prepare("SELECT * FROM comment WHERE product_id = ?");
$stmt->bind_param("s", $id);
$stmt->execute();

$query = $stmt->get_result();

//$sql = "SELECT * FROM comment WHERE product_id = '$id'";
//
//$query = mysqli_query($con, $sql) or die (mysqli_error($con));
//
//$row = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bình luận</title>
</head>
<body>
<div>
    <table style="width: 150px">
        <?php foreach($query as $key=>$value): ?>
            <tr>
                <td><?= htmlspecialchars($value['user'], ENT_QUOTES,'UTF-8'); ?></td>
                <td><?= htmlspecialchars($value['content'], ENT_QUOTES,'UTF-8'); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>
<form action="" method="POST">
    <div>
        <p>Bình luận</p>
        <textarea name="comment" placeholder="Hãy viết bình luận">

        </textarea>
    </div>
    <button name="submit">Gửi</button>
</form>
</body>
<?php
if (isset($_POST['submit'])) {
    if (empty($_POST['comment'])) {
        echo "Hãy viết bình luận";
    }

    $comment = $_POST['comment'];
    $username = $_SESSION['login'];
//    var_dump($comment);
//    die();
    $sql = mysqli_query($con, "SELECT username FROM users WHERE id = '$username'");
    $result = mysqli_fetch_assoc($sql);
    $user = $result['username'];
    mysqli_query($con, "INSERT INTO comment (product_id, user, content) VALUES ('$id', '$user', '$comment')") or die (mysqli_error($con));

    header("Refresh:0");
}
?>
</html>