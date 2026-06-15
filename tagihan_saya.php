<?php
session_start();
include "koneksi.php";

$user_id = $_SESSION['id'];

$q = mysqli_query($conn,"
SELECT tagihan.*, pelanggan.nama
FROM tagihan
JOIN pelanggan
ON tagihan.pelanggan_id = pelanggan.id
WHERE pelanggan.user_id = '$user_id'
");
?>

<!DOCTYPE html>
<html>
<head>

<title>Tagihan Saya</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<h2>📄 Tagihan Saya</h2>

<a href="dashboard_pelanggan.php"
class="btn btn-secondary mb-3">

Kembali

</a>

<table class="table table-bordered">

<thead class="table-primary">

<tr>

<th>No</th>
<th>Nama</th>
<th>Bulan</th>
<th>Total Tagihan</th>
<th>Status</th>

</tr>

</thead>

<tbody>

<?php
$no=1;

while($d=mysqli_fetch_assoc($q))
{
?>

<tr>

<td><?= $no++; ?></td>

<td><?= $d['nama']; ?></td>

<td><?= $d['bulan']; ?></td>

<td>
Rp <?= number_format($d['total_tagihan']); ?>
</td>

<td>

<?php
if($d['status']=="lunas")
{
echo "<span class='badge bg-success'>Lunas</span>";
}
else
{
echo "<span class='badge bg-danger'>Belum Lunas</span>";
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