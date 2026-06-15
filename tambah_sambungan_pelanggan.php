```php
<?php
session_start();
include "koneksi.php";

if(isset($_POST['simpan']))
{
    mysqli_query($conn,"
    INSERT INTO sambungan_baru
    (
    nama,
    nik,
    alamat,
    no_hp,
    tanggal_pengajuan,
    status
    )
    VALUES
    (
    '".$_SESSION['nama']."',
    '$_POST[nik]',
    '$_POST[alamat]',
    '$_POST[no_hp]',
    CURDATE(),
    'menunggu'
    )
    ");

    echo "
    <script>
    alert('Pengajuan sambungan baru berhasil dikirim');
    window.location='sambungan_saya.php';
    </script>
    ";
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Ajukan Sambungan Baru</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f6f9;
}

.card{
    border:none;
    border-radius:20px;
}

</style>

</head>

<body>

<div class="container mt-5">

<div class="card shadow">

<div class="card-body">

<h2 class="mb-4">
🔌 Ajukan Sambungan Baru
</h2>

<form method="POST">

<label>NIK</label>

<input
type="text"
name="nik"
class="form-control mb-3"
required>

<label>Alamat</label>

<textarea
name="alamat"
class="form-control mb-3"
required>
</textarea>

<label>No HP</label>

<input
type="text"
name="no_hp"
class="form-control mb-4"
required>

<button
type="submit"
name="simpan"
class="btn btn-success">

Kirim Pengajuan

</button>

<a href="sambungan_saya.php"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

</body>

</html>
```
