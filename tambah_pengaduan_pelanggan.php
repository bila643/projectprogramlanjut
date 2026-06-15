<?php
session_start();
include "koneksi.php";

if(isset($_POST['simpan']))
{
    $user_id = $_SESSION['id'];

    $pelanggan = mysqli_fetch_assoc(
    mysqli_query($conn,"
    SELECT *
    FROM pelanggan
    WHERE user_id='$user_id'
    ")
    );

    mysqli_query($conn,"
    INSERT INTO pengaduan
    (
    pelanggan_id,
    kategori,
    deskripsi,
    tanggal_pengaduan,
    status
    )
    VALUES
    (
    '".$pelanggan['id']."',
    '$_POST[kategori]',
    '$_POST[deskripsi]',
    CURDATE(),
    'diajukan'
    )
    ");

    echo "
    <script>
    alert('Pengaduan berhasil dikirim');
    window.location='pengaduan_saya.php';
    </script>
    ";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Ajukan Pengaduan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

<h2>📢 Ajukan Pengaduan</h2>

<form method="POST">

<input
type="text"
name="kategori"
class="form-control mb-3"
placeholder="Kategori"
required>

<textarea
name="deskripsi"
class="form-control mb-3"
placeholder="Deskripsi Pengaduan"
required>
</textarea>

<button
type="submit"
name="simpan"
class="btn btn-success">

Kirim

</button>

<a href="pengaduan_saya.php"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</body>
</html>