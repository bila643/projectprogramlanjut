<?php
include "koneksi.php";

if(isset($_GET['hapus']))
{

$id = $_GET['hapus'];

mysqli_query($conn,"
DELETE FROM pelanggan
WHERE id='$id'
");

echo "
<script>
alert('Data berhasil dihapus');
window.location='pelanggan.php';
</script>
";

}

$edit = null;

if(isset($_GET['edit']))
{
    $id = $_GET['edit'];

    $query = mysqli_query($conn,"
    SELECT * FROM pelanggan
    WHERE id='$id'
    ");

    $edit = mysqli_fetch_assoc($query);
}

if(isset($_POST['simpan']))
{

    mysqli_query($conn,"
    INSERT INTO pelanggan
    (
        no_pelanggan,
        nama,
        alamat,
        no_hp,
        status
    )
    VALUES
    (
        '$_POST[no_pelanggan]',
        '$_POST[nama]',
        '$_POST[alamat]',
        '$_POST[no_hp]',
        '$_POST[status]'
    )
    ");

    echo "
    <script>
    alert('Data berhasil disimpan');
    window.location='pelanggan.php';
    </script>
    ";
}

if(isset($_POST['update']))
{

mysqli_query($conn,"
UPDATE pelanggan
SET

no_pelanggan='$_POST[no_pelanggan]',
nama='$_POST[nama]',
alamat='$_POST[alamat]',
no_hp='$_POST[no_hp]',
status='$_POST[status]'

WHERE id='$_POST[id]'
");

echo "
<script>
alert('Data berhasil diupdate');
window.location='pelanggan.php';
</script>
";

}

$data = mysqli_query($conn,"
SELECT *
FROM pelanggan
ORDER BY id DESC
");
?>

<!DOCTYPE html>

<html lang="id">

<head>

<meta charset="UTF-8">

<title>Data Pelanggan PDAM</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

body{
    background:#f4f6f9;
}

.card{
    border:none;
    border-radius:15px;
}

</style>

</head>

<body>

<div class="container mt-4">

<div class="card shadow">

<div class="card-header bg-primary text-white d-flex justify-content-between">

<h4 class="mb-0">
👥 Data Pelanggan PDAM
</h4>

<a href="dashboard.php"
class="btn btn-light btn-sm">

Dashboard

</a>

</div>

<div class="card-body">

<div class="d-flex justify-content-between mb-3">

<input
type="text"
id="cari"
class="form-control w-50"
placeholder="Cari pelanggan...">

<div class="d-flex gap-2">

<a href="laporan_pelanggan.php"
class="btn btn-success">

🖨 Cetak Laporan

</a>

<button
class="btn btn-primary"
data-bs-toggle="modal"
data-bs-target="#modalTambah">

➕ Tambah Pelanggan

</button>

</div>

</div>

<table
id="tabelPelanggan"
class="table table-bordered table-hover">

<thead class="table-primary">

<tr>

<th>No</th>
<th>No Pelanggan</th>
<th>Nama</th>
<th>Alamat</th>
<th>No HP</th>
<th>Status</th>
<th width="150">Aksi</th>

</tr>

</thead>

<tbody>

<?php

$no = 1;

while($d = mysqli_fetch_assoc($data))
{
?>

<tr>

<td><?= $no++ ?></td>

<td><?= $d['no_pelanggan'] ?></td>

<td><?= $d['nama'] ?></td>

<td><?= $d['alamat'] ?></td>

<td><?= $d['no_hp'] ?></td>

<td>

<?php

if($d['status']=="aktif")
{
    echo "<span class='badge bg-success'>Aktif</span>";
}
else
{
    echo "<span class='badge bg-danger'>Nonaktif</span>";
}

?>

</td>

<td>

<a
href="pelanggan.php?edit=<?= $d['id']; ?>"
class="btn btn-warning btn-sm">

<i class="fas fa-edit"></i>

</a>

<a
href="pelanggan.php?hapus=<?= $d['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Yakin ingin menghapus data ini?')">

<i class="fas fa-trash"></i>

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>
<!-- Modal Tambah Pelanggan -->

<div class="modal fade" id="modalTambah">

<div class="modal-dialog">

<div class="modal-content">

<form method="POST">

<div class="modal-header">

<h5>Tambah Pelanggan</h5>

<button
type="button"
class="btn-close"
data-bs-dismiss="modal">
</button>

</div>

<div class="modal-body">

<input
type="text"
name="no_pelanggan"
class="form-control mb-3"
placeholder="No Pelanggan"
required>

<input
type="text"
name="nama"
class="form-control mb-3"
placeholder="Nama Pelanggan"
required>

<textarea
name="alamat"
class="form-control mb-3"
placeholder="Alamat"></textarea>

<input
type="text"
name="no_hp"
class="form-control mb-3"
placeholder="No HP">

<select
name="status"
class="form-control">

<option value="aktif">Aktif</option>

<option value="nonaktif">Nonaktif</option>

</select>

</div>

<div class="modal-footer">

<button
class="btn btn-success"
name="simpan">

Simpan

</button>

</div>

</form>

</div>

</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?php if($edit){ ?>

<div class="modal fade show"
style="display:block;background:rgba(0,0,0,.5);">

<div class="modal-dialog">

<div class="modal-content">

<form method="POST">

<div class="modal-header">

<h5>Edit Pelanggan</h5>

</div>

<div class="modal-body">

<input
type="hidden"
name="id"
value="<?= $edit['id']; ?>">

<input
type="text"
name="no_pelanggan"
class="form-control mb-3"
value="<?= $edit['no_pelanggan']; ?>">

<input
type="text"
name="nama"
class="form-control mb-3"
value="<?= $edit['nama']; ?>">

<textarea
name="alamat"
class="form-control mb-3"><?= $edit['alamat']; ?></textarea>

<input
type="text"
name="no_hp"
class="form-control mb-3"
value="<?= $edit['no_hp']; ?>">

<select
name="status"
class="form-control">

<option value="aktif"
<?= $edit['status']=="aktif"?"selected":"" ?>>
Aktif
</option>

<option value="nonaktif"
<?= $edit['status']=="nonaktif"?"selected":"" ?>>
Nonaktif
</option>

</select>

</div>

<div class="modal-footer">

<button
class="btn btn-success"
name="update">

Update

</button>

<a
href="pelanggan.php"
class="btn btn-secondary">

Batal

</a>

</div>

</form>

</div>

</div>

</div>

<?php } ?>

<script>

document.getElementById("cari")
.addEventListener("keyup", function(){

let keyword =
this.value.toLowerCase();

let rows =
document.querySelectorAll(
"#tabelPelanggan tbody tr"
);

rows.forEach(function(row){

let text =
row.innerText.toLowerCase();

row.style.display =
text.includes(keyword)
? ""
: "none";

});

});

</script>

</body>

</html>
