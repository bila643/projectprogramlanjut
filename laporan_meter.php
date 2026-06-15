<?php
include "koneksi.php";

$data = mysqli_query($conn,"
SELECT meter_air.*, pelanggan.nama
FROM meter_air
LEFT JOIN pelanggan
ON meter_air.pelanggan_id = pelanggan.id
ORDER BY meter_air.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>

<title>Laporan Meter Air</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body onload="window.print()">

<div class="container mt-4">

<h2 class="text-center mb-4">
LAPORAN METER AIR
</h2>

<table class="table table-bordered">

<thead>

<tr>

<th>No</th>
<th>Pelanggan</th>
<th>Bulan</th>
<th>Meter Awal</th>
<th>Meter Akhir</th>
<th>Pemakaian</th>

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

<td><?= $d['bulan']; ?></td>

<td><?= $d['meter_awal']; ?></td>

<td><?= $d['meter_akhir']; ?></td>

<td><?= $d['pemakaian']; ?> m³</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</body>
</html>