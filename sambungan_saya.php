<?php
session_start();
include "koneksi.php";

$user_id = $_SESSION['id'];

$data = mysqli_query($conn,"
SELECT *
FROM sambungan_baru
WHERE nama = '".$_SESSION['nama']."'
ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html>
<head>

<title>Sambungan Baru Saya</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<h2>🔌 Sambungan Baru Saya</h2>

<a href="tambah_sambungan_pelanggan.php"
class="btn btn-primary mb-3">

➕ Ajukan Sambungan Baru

</a>

<a href="dashboard_pelanggan.php"
class="btn btn-secondary mb-3">

Kembali

</a>

<table class="table table-bordered">

<thead class="table-primary">

<tr>

<th>No</th>
<th>Nama</th>
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

<td><?= $d['nama']; ?></td>

<td><?= $d['tanggal_pengajuan']; ?></td>

<td>

<?php

if($d['status']=="menunggu")
{
echo "<span class='badge bg-secondary'>Menunggu</span>";
}
elseif($d['status']=="survey")
{
echo "<span class='badge bg-warning'>Survey</span>";
}
elseif($d['status']=="disetujui")
{
echo "<span class='badge bg-success'>Disetujui</span>";
}
else
{
echo "<span class='badge bg-danger'>Ditolak</span>";
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