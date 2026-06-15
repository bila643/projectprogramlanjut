
<?php
include "koneksi.php";

$data = mysqli_query($conn,"
SELECT pembayaran.*, pelanggan.nama
FROM pembayaran

LEFT JOIN tagihan
ON pembayaran.tagihan_id = tagihan.id

LEFT JOIN pelanggan
ON tagihan.pelanggan_id = pelanggan.id

ORDER BY pembayaran.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>

<title>Laporan Pembayaran</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body onload="window.print()">

<div class="container mt-4">

<h2 class="text-center mb-4">

LAPORAN PEMBAYARAN PDAM

</h2>

<table class="table table-bordered">

<thead>

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

<td><?= $no++; ?></td>

<td><?= $d['nama']; ?></td>

<td><?= $d['tanggal_bayar']; ?></td>

<td><?= $d['metode_pembayaran']; ?></td>

<td><?= $d['status_verifikasi']; ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</body>
</html>
```
