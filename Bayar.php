<?php
include "koneksi.php";

$id = $_GET['id'];

mysqli_query($conn,"
UPDATE tagihan
SET status='lunas'
WHERE id='$id'
");

header("Location: Tagihan.php");
exit;
?>