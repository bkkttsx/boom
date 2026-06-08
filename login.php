
<?php
session_start();
include 'includes/db.php';

$error = "";

if(isset($_POST['login'])){

    $user = $_POST['username'];
    $pass = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss",$user,$pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $_SESSION['user'] = $user;
        header("Location: index.php");
        exit;
    } else {
        $error = "Username หรือ Password ไม่ถูกต้อง";
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body class="login-page">

<div class="login-card">

<h2>เว็บเก็บไฟล์แบบ</h2>

<form method="POST">

<input class="form-control mb-3" type="text" name="username" placeholder="Username">

<input class="form-control mb-3" type="password" name="password" placeholder="Password">

<button class="btn-upload w-100" name="login">Login</button>

</form>

<p class="text-danger mt-3"><?= $error ?></p>

<p class="mt-3 text-muted">ใส่ชื่อผู้ใช้ / รหัสผ่าน</p>

</div>

</body>
</html>
