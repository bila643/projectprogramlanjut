<?php
session_start();

if(!isset($_SESSION['id']))
{
    header("Location: login.php");
    exit;
}

if($_SESSION['role']!="pelanggan")
{
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Dashboard Pelanggan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>


body{
    background:#f4f6f9;
}

.card-menu{
    border:none;
    border-radius:20px;
    color:white;
    transition:.3s;
}

.card-menu:hover{
    transform:translateY(-8px);
}

h1{
    font-size:55px;
}

.btn{
    border-radius:15px;
}

</style>

</head>


<body>

<div class="container mt-5">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h2>
👤 Dashboard Pelanggan
</h2>

<p class="mb-0">
Selamat datang,
<b><?= $_SESSION['nama']; ?></b>
</p>

</div>

<a href="logout.php"
class="btn btn-danger">

Logout

</a>

</div>

<div class="row g-4">

<div class="col-md-3">

<div class="card card-menu bg-primary shadow">

<div class="card-body text-center p-5">

<h1>📄</h1>

<h4>Tagihan Saya</h4>

<a href="tagihan_saya.php"
class="btn btn-light mt-3">

Lihat

</a>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card card-menu bg-info shadow">

<div class="card-body text-center p-5">

<h1>📢</h1>

<h4>Pengaduan Saya</h4>

<a href="pengaduan_saya.php"
class="btn btn-light mt-3">

Lihat

</a>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card card-menu bg-success shadow">

<div class="card-body text-center p-5">

<h1>🔌</h1>

<h4>Sambungan Baru</h4>

<a href="sambungan_saya.php"
class="btn btn-light mt-3">

Lihat

</a>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card card-menu bg-secondary shadow">

<div class="card-body text-center p-5">

<h1>👤</h1>

<h4>Profil Saya</h4>

<a href="profil.php"
class="btn btn-light mt-3">

Buka

</a>

</div>

</div>

</div>

</div>

</div>

</body>

</html>

