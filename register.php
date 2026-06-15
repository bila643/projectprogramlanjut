<!DOCTYPE html>
<html>
<head>

<title>Register Pelanggan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background: linear-gradient(135deg,#0d6efd,#00c6ff);
}

.card{
    margin-top:80px;
    border-radius:20px;
}

</style>

</head>

<body>

<div class="container">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card shadow">

<div class="card-body">

<h2 class="text-center mb-4">
📝 Daftar Pelanggan
</h2>

<form action="proses_register.php" method="POST">

<input
type="text"
name="nama"
class="form-control mb-3"
placeholder="Nama Lengkap"
required>

<input
type="email"
name="email"
class="form-control mb-3"
placeholder="Email"
required>

<input
type="password"
name="password"
class="form-control mb-3"
placeholder="Password"
required>

<button
type="submit"
class="btn btn-success w-100">

Daftar

</button>

</form>

<hr>

<p class="text-center">

Sudah punya akun?

<a href="login.php">
Login
</a>

</p>

</div>

</div>

</div>

</div>

</div>

</body>

</html>