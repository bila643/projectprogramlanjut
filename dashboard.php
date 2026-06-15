<?php
session_start();
if(!isset($_SESSION['id']))
{
    header("Location: login.php");
    exit;
}

if($_SESSION['role']!="admin")
{
    header("Location: login.php");
    exit;
}
?>

<?php
include "koneksi.php";

$total_pelanggan = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM pelanggan")
);

$total_tagihan = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM tagihan")
);

$total_pengaduan = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM pengaduan")
);

$total_pembayaran = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM pembayaran")
);
$total_pengaduan = mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM pengaduan")
);

$total_sambungan = mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM sambungan_baru")
);

$total_berita = mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM berita")
);
$pendapatan = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT SUM(total_tagihan) as total
FROM tagihan
WHERE status='lunas'
")
);
?>

<!DOCTYPE html>
<html lang="id">

<head>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<meta charset="UTF-8">

<title>Sistem Informasi PDAM</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

body{
    background:#eef2f7;
    font-family:'Segoe UI',sans-serif;
}

.sidebar{
    width:250px;
    height:100vh;
    position:fixed;
    background:#0f172a;
    color:white;
    left:0;
    top:0;
}

.logo{
    text-align:center;
    padding:20px;
    font-size:24px;
    font-weight:bold;
    border-bottom:1px solid rgba(255,255,255,.1);
}

.sidebar a{
    display:block;
    color:#cbd5e1;
    text-decoration:none;
    padding:15px 20px;
    transition:.3s;
}

.sidebar a:hover{
    background:#1e293b;
    color:white;
}

.content{
    margin-left:250px;
    padding:25px;
}

.card-dashboard{
    border:none;
    border-radius:20px;
    color:white;
    transition:.3s;
    box-shadow:0 10px 20px rgba(0,0,0,.1);
}

.card-dashboard:hover{
    transform:translateY(-8px);
}

.card-dashboard:hover{
    transform:translateY(-5px);
}

.pelanggan{
    background:linear-gradient(135deg,#2563eb,#1d4ed8);
}

.tagihan{
    background:linear-gradient(135deg,#16a34a,#15803d);
}

.pengaduan{
    background:linear-gradient(135deg,#dc2626,#b91c1c);
}

.pendapatan{
    background:linear-gradient(135deg,#ea580c,#c2410c);
}

.card{
    border:none;
    border-radius:20px;
}

.card-header{
    font-weight:bold;
}

table{
    margin-bottom:0;
}

</style>

</head>

<body>

<div class="sidebar">

<div class="logo">
💧 PDAM
</div>

<a href="#">
<i class="fas fa-home"></i>
Dashboard
</a>

<a href="pelanggan.php">
<i class="fas fa-users"></i>
Data Pelanggan
</a>

<a href="tarif.php">
<i class="fas fa-money-bill-wave"></i>
Tarif
</a>

<a href="meter_air.php">
<i class="fas fa-tint"></i>
Meter Air
</a>

<a href="tagihan.php">
<i class="fas fa-file-invoice"></i>
Tagihan
</a>

<a href="pembayaran.php">
<i class="fas fa-money-bill"></i>
Pembayaran
</a>

<a href="pengaduan.php">
<i class="fas fa-comments"></i>
Pengaduan
</a>

<a href="sambungan_baru.php">
<i class="fas fa-plug"></i>
Sambungan Baru
</a>

<a href="berita.php">
<i class="fas fa-newspaper"></i>
Berita
</a>

<a href="logout.php">
<i class="fas fa-sign-out-alt"></i>
Logout
</a>

</div>

<div class="content">

<div class="bg-white shadow-sm rounded p-3 mb-4 d-flex justify-content-between align-items-center">

    <div>
        <h4 class="mb-0">💧 Sistem Informasi PDAM</h4>
        <small class="text-muted">
            Kelola pelanggan, tagihan, pembayaran dan pengaduan
        </small>
    </div>

    <div>
        <b><?= $_SESSION['nama']; ?></b>
        <span class="badge bg-success">Online</span>
    </div>

</div>

<div class="d-flex justify-content-between mb-4">

<h2>
Dashboard Admin
</h2>

<h5>
Halo,
<?= $_SESSION['nama']; ?>
👋
</h5>

</div>

<div class="row">

<div class="col-md-3 mb-4">

<div class="card card-dashboard pelanggan shadow">

<div class="card-body">

<h5>Total Pelanggan</h5>

<h1><?= $total_pelanggan ?></h1>

</div>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card card-dashboard tagihan shadow">

<div class="card-body">

<h5>Total Tagihan</h5>

<h1><?= $total_tagihan ?></h1>

</div>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card card-dashboard pengaduan shadow">

<div class="card-body">

<h5>Pengaduan</h5>

<h1><?= $total_pengaduan ?></h1>

</div>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card card-dashboard pendapatan shadow">

<div class="card-body">

<h5>Total Pendapatan</h5>

<h4>
Rp <?= number_format($pendapatan['total']) ?>
</h4>

</div>

</div>

</div>

<div class="row">

<div class="col-md-4 mb-4">

<div class="card bg-warning text-dark shadow">

<div class="card-body text-center">

<h5>💰 Pembayaran</h5>

<h2><?= $total_pembayaran ?></h2>

</div>

</div>

</div>

<div class="col-md-4 mb-4">

<div class="card bg-info text-white shadow">

<div class="card-body text-center">

<h5>🔌 Sambungan Baru</h5>

<h2><?= $total_sambungan ?></h2>

</div>

</div>

</div>

<div class="col-md-4 mb-4">

<div class="card bg-secondary text-white shadow">

<div class="card-body text-center">

<h5>📰 Berita</h5>

<h2><?= $total_berita ?></h2>

</div>

</div>

</div>

</div>

<!-- QUICK MENU -->

<div class="row mt-4">

<div class="col-md-3">
<a href="pelanggan.php" class="btn btn-outline-primary w-100 p-3">
👥 Data Pelanggan
</a>
</div>

<div class="col-md-3">
<a href="meter_air.php" class="btn btn-outline-success w-100 p-3">
💧 Meter Air
</a>
</div>

<div class="col-md-3">
<a href="tagihan.php" class="btn btn-outline-warning w-100 p-3">
🧾 Tagihan
</a>
</div>

<div class="col-md-3">
<a href="pengaduan.php" class="btn btn-outline-danger w-100 p-3">
📢 Pengaduan
</a>
</div>

</div>

<!-- INFORMASI SISTEM -->

<div class="card shadow mt-4">

<div class="card-header">
Aktivitas Terbaru
</div>

<div class="card-body">

<table class="table">

<tr>
<td>👥 Pelanggan baru ditambahkan</td>
<td>Hari ini</td>
</tr>

<tr>
<td>💰 Pembayaran berhasil</td>
<td>Hari ini</td>
</tr>

<tr>
<td>📢 Pengaduan masuk</td>
<td>Hari ini</td>
</tr>

</table>

</div>

</div>

<div class="card shadow mt-4">

<div class="card-header">
<h5 class="mb-0">Informasi Sistem</h5>
</div>

<div class="card-body">

<p>
Sistem Informasi PDAM digunakan untuk mengelola data pelanggan,
tagihan air, pembayaran pelanggan, pengaduan masyarakat,
dan pengajuan sambungan baru.
</p>

</div>

</div>


<div class="card shadow mt-4">

<div class="card-header">
📊 Statistik Sistem
</div>

<div class="card-body">

<canvas id="myChart"></canvas>

</div>

</div>

<script>

const ctx = document.getElementById('myChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            'Pelanggan',
            'Tagihan',
            'Pengaduan'
        ],
        datasets: [{
            label: 'Data Sistem',
            data: [
                <?= $total_pelanggan ?>,
                <?= $total_tagihan ?>,
                <?= $total_pengaduan ?>
            ]
        }]
    }
});

</script>

</body>

</html>