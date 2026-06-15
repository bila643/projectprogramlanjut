<?php
include "koneksi.php";

if(isset($_POST['simpan']))
{
    $pelanggan_id = $_POST['pelanggan_id'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];

    mysqli_query($conn,"
    INSERT INTO pengaduan
    (
    pelanggan_id,
    kategori,
    deskripsi,
    tanggal_pengaduan
    )
    VALUES
    (
    '$pelanggan_id',
    '$kategori',
    '$deskripsi',
    '$tanggal'
    )
    ");

    header("Location: pengaduan.php");
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Tambah Pengaduan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<h2>📢 Tambah Pengaduan</h2>

<form method="POST">

<div class="mb-3">

<label>Pelanggan</label>

<select name="pelanggan_id" class="form-control">

<?php

$pelanggan = mysqli_query($conn,"
SELECT * FROM pelanggan
");

while($p=mysqli_fetch_assoc($pelanggan))
{
?>

<option value="<?= $p['id']; ?>">

<?= $p['nama']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Kategori</label>

<input type="text"
name="kategori"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Deskripsi</label>

<textarea
name="deskripsi"
class="form-control"
required></textarea>

</div>

<div class="mb-3">

<label>Tanggal</label>

<input type="date"
name="tanggal"
class="form-control"
required>

</div>

<button
type="submit"
name="simpan"
class="btn btn-primary">

Simpan

</button>

<a href="pengaduan.php"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</body>

</html>