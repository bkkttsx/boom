
<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}
include 'includes/db.php';

$search = $_GET['search'] ?? '';

$stmt = $conn->prepare("SELECT * FROM files WHERE filename LIKE ? OR project_name LIKE ? OR sender LIKE ? OR detail LIKE ? ORDER BY id DESC");
$keyword = "%$search%";
$stmt->bind_param("ssss",$keyword,$keyword,$keyword,$keyword);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ระบบจัดเก็บไฟล์</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="sidebar">
<h2>ระบบจัดเก็บไฟล์</h2>
<p>ระบบจัดเก็บไฟล์ PDF</p>
<hr>
<a class="menu" href="index.php">📁 ไฟล์ทั้งหมด</a>
<a class="menu" href="index.php">📁 งานถนน</a>
<a class="menu" href="index.php">📁 งานไฟโซล่าเซลล์</a>
<a class="menu" href="index.php">📁 งานบาดาล</a>
<a class="menu" href="logout.php">🚪 Logout</a>
</div>

<div class="main">

<div class="topbar">
<form>
<input class="search" type="text" name="search" placeholder="ค้นหาไฟล์..." value="<?= htmlspecialchars($search) ?>">
</form>
<div class="user">👤 <?= $_SESSION['user'] ?></div>
</div>

<div class="content">

<div class="card-box">

<h4>☁️ อัปโหลดไฟล์ PDF</h4>

<form action="upload.php" method="POST" enctype="multipart/form-data">

<div class="grid">

<div class="dropzone">
<input type="file" name="pdf" required>
</div>

<div class="form-area">

<input class="form-control" type="text" name="project" placeholder="Project" required>

<input class="form-control" type="text" name="sender" placeholder="ผู้ส่ง" required>

<input class="form-control" type="text" name="detail" placeholder="รายละเอียด">

<button class="btn-upload">Upload PDF</button>

</div>

</div>

</form>

</div>

<div class="card-box">

<h4>🗃️ รายการไฟล์</h4>

<table class="table">

<tr>
<th>ชื่อไฟล์</th>
<th>Project</th>
<th>ผู้ส่ง</th>
<th>รายละเอียด</th>
<th>จัดการ</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>

<tr>

<td><?= htmlspecialchars($row['filename']) ?></td>
<td><?= htmlspecialchars($row['project_name']) ?></td>
<td><?= htmlspecialchars($row['sender']) ?></td>
<td><?= htmlspecialchars($row['detail']) ?></td>

<td>

<a class="btn btn-primary btn-sm"
href="<?= $row['file_path'] ?>" download>
Download
</a>

<a class="btn btn-danger btn-sm"
href="delete.php?id=<?= $row['id'] ?>"
onclick="return confirm('Delete file?')">
Delete
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</div>

</body>
</html>
