<?php
include "koneksi.php";

$id = $_GET['id'];
$status = $_GET['status'];

mysqli_query($conn,"
UPDATE sambungan_baru
SET status='$status'
WHERE id='$id'
");

header("Location: sambungan_baru.php");
exit;
?>