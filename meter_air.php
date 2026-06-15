<?php
session_start();
include "koneksi.php";

if(isset($_POST['simpan']))
{

$pemakaian =
$_POST['meter_akhir']
-
$_POST['meter_awal'];

mysqli_query($conn,"
INSERT INTO meter_air
(
pelanggan_id,
bulan,
meter_awal,
meter_akhir,
pemakaian
)
VALUES
(
'$_POST[pelanggan_id]',
'$_POST[bulan]',
'$_POST[meter_awal]',
'$_POST[meter_akhir]',
'$pemakaian'
)
");

echo "
<script>
alert('Data berhasil disimpan');
window.location='meter_air.php';
</script>
";

}

$data = mysqli_query($conn,"
SELECT meter_air.*,
pelanggan.nama

FROM meter_air

LEFT JOIN pelanggan
ON meter_air.pelanggan_id = pelanggan.id

ORDER BY meter_air.id DESC
");
?>

<!DOCTYPE html>
<html>

<head>

<title>Meter Air</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f4f6f9;
}

table{
background:white;
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

<h2>💧 Data Meter Air</h2>

<p class="text-muted mb-0">
Kelola data pencatatan meter air pelanggan
</p>

</div>

</div>

<?php

$total_meter = mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM meter_air")
);

?>

<div class="row mb-4">

<div class="col-md-4">

<div class="card bg-primary text-white shadow">

<div class="card-body">

<h5>Total Input Meter</h5>

<h2><?= $total_meter ?></h2>

</div>

</div>

</div>

</div>

<div class="d-flex gap-2 mb-3">

<button
class="btn btn-primary"
data-bs-toggle="modal"
data-bs-target="#modalTambah">

➕ Input Meter Air

</button>

<a href="laporan_meter.php"
class="btn btn-success">

🖨 Cetak

</a>

<?php

if($_SESSION['role']=="admin")
{
?>

<a href="dashboard.php"
class="btn btn-secondary">

⬅ Kembali

</a>

<?php
}
elseif($_SESSION['role']=="petugas")
{
?>

<a href="dashboard_petugas.php"
class="btn btn-secondary">

⬅ Kembali

</a>

<?php
}
?>

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

<td><?= $no++ ?></td>

<td><?= $d['nama'] ?></td>

<td><?= $d['bulan'] ?></td>

<td><?= $d['meter_awal'] ?></td>

<td><?= $d['meter_akhir'] ?></td>

<td>

<?= $d['pemakaian'] ?> m³

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<?php

$pelanggan =
mysqli_query($conn,"
SELECT *
FROM pelanggan
");

?>

<div class="modal fade" id="modalTambah">

<div class="modal-dialog">

<div class="modal-content">

<form method="POST">

<div class="modal-header">

<h5>Input Meter Air</h5>

<button
type="button"
class="btn-close"
data-bs-dismiss="modal">
</button>

</div>

<div class="modal-body">

<select
name="pelanggan_id"
class="form-control mb-3"
required>

<?php
while($p=mysqli_fetch_assoc($pelanggan))
{
?>

<option
value="<?= $p['id']; ?>">

<?= $p['nama']; ?>

</option>

<?php } ?>

</select>

<input
type="date"
name="bulan"
class="form-control mb-3"
required>

<input
type="number"
name="meter_awal"
class="form-control mb-3"
placeholder="Meter Awal"
required>

<input
type="number"
name="meter_akhir"
class="form-control mb-3"
placeholder="Meter Akhir"
required>

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
```
