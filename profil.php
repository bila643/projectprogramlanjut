<?php

session_start();
include "koneksi.php";

$id = $_SESSION['id'];

$data = mysqli_query($conn,"
SELECT *
FROM users
WHERE id='$id'
");

$user = mysqli_fetch_assoc($data);

?>

<!DOCTYPE html>
<html>

<head>

<title>Profil Saya</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3>👤 Profil Saya</h3>

</div>

<div class="card-body">

<table class="table">

<tr>
<th>Nama</th>
<td><?= $user['nama']; ?></td>
</tr>

<tr>
<th>Email</th>
<td><?= $user['email']; ?></td>
</tr>

<tr>
<th>Role</th>
<td><?= ucfirst($user['role']); ?></td>
</tr>

</table>

<a href="edit_profil.php"
class="btn btn-warning">

✏ Edit Profil

</a>

<a href="dashboard_pelanggan.php"
class="btn btn-secondary">

Kembali

</a>

</div>

</div>

</div>

</body>

</html>