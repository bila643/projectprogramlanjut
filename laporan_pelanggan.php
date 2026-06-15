<?php
include "koneksi.php";

$data = mysqli_query($conn,"
SELECT *
FROM pelanggan
ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html>

<head>

<title>Laporan Data Pelanggan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<h2>
📄 Laporan Data Pelanggan
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
<th>No Pelanggan</th>
<th>Nama</th>
<th>Alamat</th>
<th>No HP</th>
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

<td><?= $d['no_pelanggan'] ?></td>

<td><?= $d['nama'] ?></td>

<td><?= $d['alamat'] ?></td>

<td><?= $d['no_hp'] ?></td>

<td><?= $d['status'] ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</body>

</html>

