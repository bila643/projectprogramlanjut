<?php
session_start();
include "koneksi.php";

$user_id = $_SESSION['id'];

$data = mysqli_query($conn,"
SELECT pengaduan.*
FROM pengaduan
JOIN pelanggan
ON pengaduan.pelanggan_id = pelanggan.id
WHERE pelanggan.user_id = '$user_id'
ORDER BY pengaduan.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>

<title>Pengaduan Saya</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<h2>📢 Pengaduan Saya</h2>

<a href="tambah_pengaduan_pelanggan.php"
class="btn btn-primary mb-3">

➕ Ajukan Pengaduan

</a>

<a href="dashboard_pelanggan.php"
class="btn btn-secondary mb-3">

Kembali

</a>

<table class="table table-bordered">

<thead class="table-primary">

<tr>
<th>No</th>
<th>Kategori</th>
<th>Deskripsi</th>
<th>Tanggal</th>
<th>Status</th>
</tr>

</thead>

<tbody>

<?php
$no=1;

while($d=mysqli_fetch_assoc($data))
{
?>

<tr>

<td><?= $no++; ?></td>

<td><?= $d['kategori']; ?></td>

<td><?= $d['deskripsi']; ?></td>

<td><?= $d['tanggal_pengaduan']; ?></td>

<td>

<?php

if($d['status']=="diajukan")
{
echo "<span class='badge bg-secondary'>Diajukan</span>";
}
elseif($d['status']=="diproses")
{
echo "<span class='badge bg-warning'>Diproses</span>";
}
else
{
echo "<span class='badge bg-success'>Selesai</span>";
}

?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</body>
</html>