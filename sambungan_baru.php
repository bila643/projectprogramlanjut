<?php
include "koneksi.php";

if(isset($_POST['simpan']))
{

$foto_ktp = $_FILES['foto_ktp']['name'];
$foto_rumah = $_FILES['foto_rumah']['name'];

move_uploaded_file(
$_FILES['foto_ktp']['tmp_name'],
"assets/upload/".$foto_ktp
);

move_uploaded_file(
$_FILES['foto_rumah']['tmp_name'],
"assets/upload/".$foto_rumah
);

mysqli_query($conn,"
INSERT INTO sambungan_baru
(
nama,
nik,
alamat,
no_hp,
foto_ktp,
foto_rumah,
tanggal_pengajuan,
status
)
VALUES
(
'$_POST[nama]',
'$_POST[nik]',
'$_POST[alamat]',
'$_POST[no_hp]',
'$foto_ktp',
'$foto_rumah',
CURDATE(),
'menunggu'
)
");

echo "
<script>
alert('Pengajuan berhasil');
window.location='sambungan_baru.php';
</script>
";

}

$data = mysqli_query($conn,"
SELECT *
FROM sambungan_baru
ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html>

<head>

<title>Sambungan Baru</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<h2>🔌 Sambungan Baru</h2>

<div class="mb-3">

<a href="dashboard_petugas.php"
class="btn btn-secondary">

Dashboard

</a>

<a href="dashboard.php"
class="btn btn-secondary">

⬅ Kembali

</a>

<button
class="btn btn-primary"
data-bs-toggle="modal"
data-bs-target="#modalTambah">

➕ Pengajuan Baru

</button>

</div>

<table class="table table-bordered table-hover">

<thead class="table-primary">

<tr>

<th>No</th>
<th>Nama</th>
<th>NIK</th>
<th>KTP</th>
<th>Rumah</th>
<th>No HP</th>
<th>Tanggal</th>
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

<td><?= $d['nik'] ?></td>

<td>

<?php if(!empty($d['foto_ktp'])){ ?>

<img
src="assets/upload/<?= $d['foto_ktp']; ?>"
width="70">

<?php } ?>

</td>

<td>

<?php if(!empty($d['foto_rumah'])){ ?>

<img
src="assets/upload/<?= $d['foto_rumah']; ?>"
width="70">

<?php } ?>

</td>

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

<td>

<?php if($d['status']=="menunggu"){ ?>

<a
href="ubah_sambungan.php?id=<?= $d['id']; ?>&status=survey"
class="btn btn-warning btn-sm">

Survey

</a>

<?php } ?>

<?php if($d['status']=="survey"){ ?>

<a
href="ubah_sambungan.php?id=<?= $d['id']; ?>&status=disetujui"
class="btn btn-success btn-sm">

Setujui

</a>

<a
href="ubah_sambungan.php?id=<?= $d['id']; ?>&status=ditolak"
class="btn btn-danger btn-sm">

Tolak

</a>

<?php } ?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- MODAL TAMBAH -->

<div class="modal fade" id="modalTambah">

<div class="modal-dialog">

<div class="modal-content">

<form method="POST" enctype="multipart/form-data">

<div class="modal-header">

<h5>Pengajuan Sambungan Baru</h5>

<button
type="button"
class="btn-close"
data-bs-dismiss="modal">
</button>

</div>

<div class="modal-body">

<input
type="text"
name="nama"
class="form-control mb-3"
placeholder="Nama Lengkap"
required>

<input
type="text"
name="nik"
class="form-control mb-3"
placeholder="NIK"
required>

<textarea
name="alamat"
class="form-control mb-3"
placeholder="Alamat"
required></textarea>

<input
type="text"
name="no_hp"
class="form-control mb-3"
placeholder="No HP"
required>

<label>Foto KTP</label>

<input
type="file"
name="foto_ktp"
class="form-control mb-3"
required>

<label>Foto Rumah</label>

<input
type="file"
name="foto_rumah"
class="form-control"
required>

</div>

<div class="modal-footer">

<button
type="submit"
name="simpan"
class="btn btn-success">

Simpan

</button>

</div>

</form>

</div>

</div>

</div>

</body>

</html>