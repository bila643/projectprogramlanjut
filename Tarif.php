<?php
include "koneksi.php";

/* SIMPAN */

if(isset($_POST['simpan']))
{
    mysqli_query($conn,"
    INSERT INTO tarif
    (
        nama_tarif,
        harga_per_m3
    )
    VALUES
    (
        '$_POST[nama_tarif]',
        '$_POST[harga_per_m3]'
    )
    ");

    echo "<script>
    alert('Tarif berhasil ditambah');
    window.location='tarif.php';
    </script>";
}

/* HAPUS */

if(isset($_GET['hapus']))
{
    mysqli_query($conn,"
    DELETE FROM tarif
    WHERE id='$_GET[hapus]'
    ");

    echo "<script>
    window.location='tarif.php';
    </script>";
}

$data = mysqli_query($conn,"
SELECT *
FROM tarif
ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html>

<head>

<title>Data Tarif</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<h2>💰 Data Tarif Air</h2>

<button
class="btn btn-primary mb-3"
data-bs-toggle="modal"
data-bs-target="#modalTambah">

+ Tambah Tarif

</button>

<table class="table table-bordered">

<thead class="table-primary">

<tr>

<th>No</th>
<th>Nama Tarif</th>
<th>Harga per m³</th>
<th>Aksi</th>

</tr>

<a href="dashboard.php"
class="btn btn-secondary">

⬅ Kembali

</a>

</thead>

<tbody>

<?php

$no=1;

while($d=mysqli_fetch_assoc($data))
{

?>

<tr>

<td><?= $no++ ?></td>

<td><?= $d['nama_tarif'] ?></td>

<td>
Rp <?= number_format($d['harga_per_m3']) ?>
</td>

<td>

<a
href="tarif.php?hapus=<?= $d['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus data?')">

Hapus

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<!-- MODAL -->

<div class="modal fade" id="modalTambah">

<div class="modal-dialog">

<div class="modal-content">

<form method="POST">

<div class="modal-header">

<h5>Tambah Tarif</h5>

</div>

<div class="modal-body">

<input
type="text"
name="nama_tarif"
class="form-control mb-3"
placeholder="Nama Tarif">

<input
type="number"
name="harga_per_m3"
class="form-control"
placeholder="Harga per m3">

</div>

<div class="modal-footer">

<button
class="btn btn-success"
name="simpan">

Simpan

</button>

</div>

</form>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>