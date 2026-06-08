
<?php
session_start();
include 'includes/db.php';

if(isset($_FILES['pdf'])){

$file = $_FILES['pdf'];

if(pathinfo($file['name'], PATHINFO_EXTENSION) != 'pdf'){
    die("Only PDF allowed");
}

$filename = time().'_'.$file['name'];

$path = 'uploads/'.$filename;

move_uploaded_file($file['tmp_name'], $path);

$project = $_POST['project'];
$sender = $_POST['sender'];
$detail = $_POST['detail'];

$stmt = $conn->prepare("INSERT INTO files(filename,project_name,sender,detail,file_path) VALUES(?,?,?,?,?)");
$stmt->bind_param("sssss",$filename,$project,$sender,$detail,$path);
$stmt->execute();

}

header("Location: index.php");
