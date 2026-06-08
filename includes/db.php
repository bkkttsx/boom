
<?php
$conn = new mysqli("localhost","root","","pdfvault");

if($conn->connect_error){
    die("Database Error");
}
