<?php
include "koneksi.php";

if(isset($_POST['simpan']))
{
    $gambar = $_FILES['gambar']['name'];

    move_uploaded_file(
        $_FILES['gambar']['tmp_name'],
        "assets/berita/".$gambar
    );

    mysqli_query($conn,"
    INSERT INTO berita
    (
        judul,
        isi,
        gambar,
        tanggal_publish
    )
    VALUES
    (
        '$_POST[judul]',
        '$_POST[isi]',
        '$gambar',
        CURDATE()
    )
    ");

    header("Location: berita.php");
    exit;
}

$data = mysqli_query($conn,"
SELECT *
FROM berita
ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Berita</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-4">

<h2>📰 Data Berita</h2>

<div class="mb-3">

<a href="dashboard.php" class="btn btn-secondary">
Dashboard
</a>

<button
class="btn btn-primary"
data-bs-toggle="modal"
data-bs-target="#modalTambah">

+ Tambah Berita

</button>

</div>

<table class="table table-bordered table-hover">

<thead class="table-primary">

<tr>
<th>No</th>
<th>Gambar</th>
<th>Judul</th>
<th>Tanggal</th>
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

<td>

<?php if($d['gambar']){ ?>

<img
src="assets/berita/<?= $d['gambar']; ?>"
width="80">

<?php } ?>

</td>

<td><?= $d['judul'] ?></td>

<td><?= $d['tanggal_publish'] ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<!-- MODAL -->

<div class="modal fade" id="modalTambah">

<div class="modal-dialog">

<div class="modal-content">

<form method="POST" enctype="multipart/form-data">

<div class="modal-header">

<h5>Tambah Berita</h5>

<button
type="button"
class="btn-close"
data-bs-dismiss="modal">
</button>

</div>

<div class="modal-body">

<input
type="text"
name="judul"
class="form-control mb-3"
placeholder="Judul Berita"
required>

<textarea
name="isi"
class="form-control mb-3"
placeholder="Isi Berita"
required></textarea>

<input
type="file"
name="gambar"
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>