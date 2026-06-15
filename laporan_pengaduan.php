<?php
include "koneksi.php";

$data = mysqli_query($conn,"
SELECT pengaduan.*, pelanggan.nama
FROM pengaduan
JOIN pelanggan
ON pengaduan.pelanggan_id = pelanggan.id
ORDER BY pengaduan.id DESC
");
?>

<!DOCTYPE html>
<html>

<head>

<title>Laporan Pengaduan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<h2>
📄 Laporan Pengaduan
</h2>

<div class="mb-3">

<button
onclick="window.print()"
class="btn btn-success">

🖨 Cetak

</button>

<a href="dashboard_petugas.php"
class="btn btn-secondary">

⬅ Kembali

</a>

</div>

<table class="table table-bordered">

<thead class="table-primary">

<tr>

<th>No</th>
<th>Nama Pelanggan</th>
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

<td><?= $no++ ?></td>

<td><?= $d['nama'] ?></td>

<td><?= $d['kategori'] ?></td>

<td><?= $d['deskripsi'] ?></td>

<td><?= $d['tanggal_pengaduan'] ?></td>

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
```
