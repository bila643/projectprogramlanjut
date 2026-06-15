<?php
include "koneksi.php";

$data = mysqli_query($conn,"
SELECT
pengaduan.*,
pelanggan.nama

FROM pengaduan

LEFT JOIN pelanggan
ON pengaduan.pelanggan_id = pelanggan.id

ORDER BY pengaduan.id DESC
");

$total_pengaduan = mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM pengaduan")
);
?>

<!DOCTYPE html>
<html>

<head>

<title>Data Pengaduan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f4f6f9;
}

.card{
border:none;
border-radius:15px;
}

</style>

</head>

<body>

<div class="container mt-5">

<div class="card shadow border-0 mb-4">

<div class="card-body">

<h2>📢 Data Pengaduan</h2>

<p class="text-muted mb-0">

Kelola pengaduan pelanggan PDAM

</p>

</div>

</div>

<div class="row mb-4">

<div class="col-md-4">

<div class="card bg-danger text-white shadow">

<div class="card-body">

<h5>Total Pengaduan</h5>

<h2><?= $total_pengaduan ?></h2>

</div>

</div>

</div>

</div>

<div class="d-flex gap-2 mb-3">

<a href="tambah_pengaduan.php"
class="btn btn-primary">

➕ Tambah Pengaduan

</a>

<a href="laporan_pengaduan.php"
class="btn btn-success">

🖨 Cetak Laporan

</a>

<a href="dashboard_petugas.php"
class="btn btn-secondary">

⬅ Kembali

</a>

<a href="logout.php"
class="btn btn-danger">

🚪 Logout

</a>

</div>

<table class="table table-bordered table-hover shadow-sm">

<thead class="table-danger">

<tr>

<th>No</th>
<th>Pelanggan</th>
<th>Kategori</th>
<th>Deskripsi</th>
<th>Tanggal</th>
<th>Status</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

while($d=mysqli_fetch_assoc($data))
{

?>

<tr>

<td><?= $no++ ?></td>

<td><?= $d['nama'] ?></td>

<td><?= $d['kategori'] ?></td>

<td><?= $d['deskripsi'] ?></td>

<td><?= $d['tanggal_pengaduan'] ?></td>

<td>

<?php

if($d['status']=="diajukan")
{
echo "<span class='badge bg-danger'>Diajukan</span>";
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

<td>

<?php if($d['status']=="diajukan"){ ?>

<a
href="ubah_status.php?id=<?= $d['id']; ?>&status=diproses"
class="btn btn-warning btn-sm">

Proses

</a>

<?php } ?>

<?php if($d['status']=="diproses"){ ?>

<a
href="ubah_status.php?id=<?= $d['id']; ?>&status=selesai"
class="btn btn-success btn-sm">

Selesai

</a>

<?php } ?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</body>

</html>
```
