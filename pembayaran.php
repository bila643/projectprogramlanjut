<?php
include "koneksi.php";

$data = mysqli_query($conn,"
SELECT
pembayaran.*,
pelanggan.nama

FROM pembayaran

LEFT JOIN tagihan
ON pembayaran.tagihan_id = tagihan.id

LEFT JOIN pelanggan
ON tagihan.pelanggan_id = pelanggan.id

ORDER BY pembayaran.id DESC
");

$total_pembayaran = mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM pembayaran")
);

?>

<!DOCTYPE html>
<html>

<head>

<title>Data Pembayaran</title>

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

<h2>💰 Data Pembayaran</h2>

<p class="text-muted mb-0">

Kelola data pembayaran pelanggan PDAM

</p>

</div>

</div>

<div class="row mb-4">

<div class="col-md-4">

<div class="card bg-success text-white shadow">

<div class="card-body">

<h5>Total Pembayaran</h5>

<h2><?= $total_pembayaran ?></h2>

</div>

</div>

</div>

</div>

<div class="d-flex gap-2 mb-3">

<a href="laporan_pembayaran.php"
class="btn btn-success">

🖨 Cetak Laporan

</a>

<a href="dashboard.php"
class="btn btn-secondary">

⬅ Kembali

</a>

<a href="logout.php"
class="btn btn-danger">

🚪 Logout

</a>

</div>

<table class="table table-bordered table-hover shadow-sm">

<thead class="table-success">

<tr>

<th>No</th>
<th>Pelanggan</th>
<th>Tanggal Bayar</th>
<th>Metode Pembayaran</th>
<th>Status Verifikasi</th>

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

<td><?= $d['tanggal_bayar'] ?></td>

<td><?= $d['metode_pembayaran'] ?></td>

<td>

<?php

if($d['status_verifikasi']=="terverifikasi")
{
echo "<span class='badge bg-success'>Terverifikasi</span>";
}
else
{
echo "<span class='badge bg-warning text-dark'>Menunggu Verifikasi</span>";
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
```
