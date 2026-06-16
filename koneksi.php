<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "sistem_pdam"
);

if (!$conn) {
    die("Koneksi gagal : " . mysqli_connect_error());
}

?>
