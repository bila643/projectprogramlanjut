<?php
include "koneksi.php";

if(isset($_GET['generate']))
{

$meter = mysqli_query($conn,"
SELECT
meter_air.*,
pelanggan.tarif_id,
tarif.harga_per_m3

FROM meter_air

LEFT JOIN pelanggan
ON meter_air.pelanggan_id = pelanggan.id

LEFT JOIN tarif
ON pelanggan.tarif_id = tarif.id
");

while($m=mysqli_fetch_assoc($meter))
{

$total =
$m['pemakaian']
*
$m['harga_per_m3'];

mysqli_query($conn,"
INSERT INTO tagihan
(
pelanggan_id,
meter_id,
bulan,
total_tagihan,
status
)
VALUES
(
'".$m['pelanggan_id']."',
'".$m['id']."',
'".$m['bulan']."',
'$total',
'belum_lunas'
)
");

}

echo "
<script>
alert('Tagihan berhasil dibuat');
window.location='tagihan.php';
</script>
";

}

$data = mysqli_query($conn,"
SELECT
tagihan.*,
pelanggan.nama

FROM tagihan

LEFT JOIN pelanggan
ON tagihan.pelanggan_id = pelanggan.id

ORDER BY tagihan.id DESC
");

$total_tagihan = mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM tagihan")
);

?>

<!DOCTYPE html>
<html>

<head>

<title>Tagihan PDAM</title>

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

<h2>💰 Data Tagihan PDAM</h2>

<p class="text-muted mb-0">

Kelola tagihan pelanggan PDAM

</p>

</div>

</div>

<div class="row mb-4">

<div class="col-md-4">

<div class="card bg-success text-white shadow">

<div class="card-body">

<h5>Total Tagihan</h5>

<h2><?= $total_tagihan ?></h2>

</div>

</div>

</div>

</div>

<div class="d-flex gap-2 mb-3">

<a href="tagihan.php?generate=1"
class="btn btn-primary">

⚙ Generate Tagihan

</a>

<a href="laporan_tagihan.php"
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

<thead class="table-primary">

<tr>

<th>No</th>
<th>Pelanggan</th>
<th>Bulan</th>
<th>Total Tagihan</th>
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

<td><?= $d['bulan'] ?></td>

<td>

Rp <?= number_format($d['total_tagihan']) ?>

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

<td>

<?php if($d['status']=="belum_lunas"){ ?>

<a
href="bayar.php?id=<?= $d['id']; ?>"
class="btn btn-success btn-sm">

Bayar

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
