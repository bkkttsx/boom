
<?php
include 'includes/db.php';

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM files WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

if($row){
    if(file_exists($row['file_path'])){
        unlink($row['file_path']);
    }

    $del = $conn->prepare("DELETE FROM files WHERE id=?");
    $del->bind_param("i",$id);
    $del->execute();
}

header("Location: index.php");
