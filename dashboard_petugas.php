<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['id']))
{
    header("Location: login.php");
    exit;
}

if($_SESSION['role'] != "petugas")
{
    header("Location: login.php");
    exit;
}

$total_meter = mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM meter_air")
);

$total_pengaduan = mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM pengaduan")
);

$total_sambungan = mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM sambungan_baru")
);
?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard Petugas</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f4f6f9;
}

.card{
border:none;
transition:.3s;
}

.card:hover{
transform:translateY(-5px);
}

</style>

</head>

<body>

<div class="container mt-5">

<div class="d-flex justify-content-between mb-4">

<div>

<h2>🛠 Dashboard Petugas</h2>

<p>
Selamat datang,
<b><?= $_SESSION['nama']; ?></b>
</p>

</div>

<a href="logout.php"
class="btn btn-danger">

Logout

</a>


</div>

<div class="row mb-4">

<div class="col-md-4">

<div class="card bg-primary text-white shadow">

<div class="card-body text-center">

<h5>Total Meter Air</h5>

<h1><?= $total_meter ?></h1>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card bg-warning shadow">

<div class="card-body text-center">

<h5>Total Pengaduan</h5>

<h1><?= $total_pengaduan ?></h1>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card bg-info text-white shadow">

<div class="card-body text-center">

<h5>Total Sambungan Baru</h5>

<h1><?= $total_sambungan ?></h1>

</div>

</div>

</div>

</div>

<div class="row">

<div class="col-md-4 mb-3">

<div class="card bg-primary text-white shadow">

<div class="card-body text-center">

<h1>💧</h1>

<h4>Meter Air</h4>

<a href="meter_air.php"
class="btn btn-light">

Masuk

</a>

</div>

</div>

</div>

<div class="col-md-4 mb-3">

<div class="card bg-warning shadow">

<div class="card-body text-center">

<h1>📢</h1>

<h4>Pengaduan</h4>

<a href="pengaduan.php"
class="btn btn-dark">

Masuk

</a>

</div>

</div>

</div>

<div class="col-md-4 mb-3">

<div class="card bg-info text-white shadow">

<div class="card-body text-center">

<h1>🔌</h1>

<h4>Sambungan Baru</h4>

<a href="sambungan_baru.php"
class="btn btn-light">

Masuk

</a>

</div>

</div>

</div>

</div>

</div>

</body>
</html>
```
