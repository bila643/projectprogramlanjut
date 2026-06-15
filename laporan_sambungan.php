```php
<?php
include "koneksi.php";

$data = mysqli_query($conn,"
SELECT *
FROM sambungan_baru
ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html>

<head>

<title>Laporan Sambungan Baru</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<h2>
📄 Laporan Sambungan Baru
</h2>

<div class="mb-3">

<button
onclick="window.print()"
class="btn btn-success">

🖨 Cetak

</button>

<a href="dashboard.php"
class="btn btn-secondary">

⬅ Kembali

</a>

</div>

<table class="table table-bordered">

<thead class="table-primary">

<tr>

<th>No</th>
<th>Nama</th>
<th>NIK</th>
<th>No HP</th>
<th>Tanggal Pengajuan</th>
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

<td><?= $d['nik'] ?></td>

<td><?= $d['no_hp'] ?></td>

<td><?= $d['tanggal_pengajuan'] ?></td>

<td>

<?php

if($d['status']=="menunggu")
{
echo "<span class='badge bg-secondary'>Menunggu</span>";
}
elseif($d['status']=="survey")
{
echo "<span class='badge bg-warning'>Survey</span>";
}
elseif($d['status']=="disetujui")
{
echo "<span class='badge bg-success'>Disetujui</span>";
}
else
{
echo "<span class='badge bg-danger'>Ditolak</span>";
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
