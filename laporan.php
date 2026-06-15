```php
<!DOCTYPE html>
<html>

<head>

<title>Menu Laporan</title>

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
transform:translateY(-5px);
}

</style>

</head>

<body>

<div class="container mt-5">

<div class="card shadow border-0 mb-4">

<div class="card-body">

<h2>
📄 Menu Laporan
</h2>

<p class="mb-0">

Cetak seluruh laporan sistem PDAM

</p>

</div>

</div>

<div class="row">

<div class="col-md-6 mb-3">

<div class="card card-menu bg-primary shadow">

<div class="card-body text-center">

<h1>👥</h1>

<h5>Laporan Pelanggan</h5>

<a href="laporan_pelanggan.php"
class="btn btn-light btn-sm">

Buka

</a>

</div>

</div>

</div>

<div class="col-md-6 mb-3">

<div class="card card-menu bg-success shadow">

<div class="card-body text-center">

<h1>📄</h1>

<h5>Laporan Tagihan</h5>

<a href="laporan_tagihan.php"
class="btn btn-light btn-sm">

Buka

</a>

</div>

</div>

</div>

<div class="col-md-6 mb-3">

<div class="card card-menu bg-warning shadow">

<div class="card-body text-center">

<h1>📢</h1>

<h5>Laporan Pengaduan</h5>

<a href="laporan_pengaduan.php"
class="btn btn-dark btn-sm">

Buka

</a>

</div>

</div>

</div>

<div class="col-md-6 mb-3">

<div class="card card-menu bg-info shadow">

<div class="card-body text-center">

<h1>🔌</h1>

<h5>Laporan Sambungan Baru</h5>

<a href="laporan_sambungan.php"
class="btn btn-light btn-sm">

Buka

</a>

</div>

</div>

</div>

<div class="col-md-12 mb-3">

<div class="card card-menu bg-secondary shadow">

<div class="card-body text-center">

<h1>⬅</h1>

<h5>Kembali</h5>

<a href="dashboard.php"
class="btn btn-light btn-sm">

Dashboard

</a>

</div>

</div>

</div>

</div>

</div>

</body>

</html>
```
