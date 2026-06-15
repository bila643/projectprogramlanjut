```php
<?php
include "koneksi.php";

$data = mysqli_query($conn,"
SELECT tagihan.*, pelanggan.nama
FROM tagihan
JOIN pelanggan
ON tagihan.pelanggan_id = pelanggan.id
ORDER BY tagihan.id DESC
");
?>

<!DOCTYPE html>
<html>

<head>

<title>Laporan Tagihan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<h2>
📄 Laporan Tagihan
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
<th>Nama Pelanggan</th>
<th>Bulan</th>
<th>Total Tagihan</th>
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

<td><?= $d['bulan'] ?></td>

<td>
Rp <?= number_format($d['total_tagihan']); ?>
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

</tr>

<?php } ?>

</tbody>

</table>

</div>

</body>

</html>
```
