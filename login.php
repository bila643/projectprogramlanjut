<!DOCTYPE html>
<html>
<head>

<title>Login PDAM</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:linear-gradient(135deg,#0d6efd,#00b4d8);
min-height:100vh;
display:flex;
align-items:center;
font-family:'Poppins',sans-serif;
}

.login-card{
background:white;
border-radius:25px;
box-shadow:0 20px 50px rgba(0,0,0,.2);
overflow:hidden;
}

.form-control,
.form-select{
height:55px;
border-radius:15px;
}

.btn-login{
height:55px;
border-radius:15px;
font-weight:600;
}
</style>

</head>

<body>

<div class="container">

<div class="row justify-content-center">

<div class="col-md-4">

<div class="card shadow">

<div class="card-body">

<h2 class="text-center mb-4">
💧 Sistem PDAM
</h2>

<form action="proses_login.php" method="POST">

<select
name="role"
class="form-control mb-3"
required>

<option value="">
Pilih Role
</option>

<option value="admin">
Admin
</option>

<option value="petugas">
Petugas
</option>

<option value="pelanggan">
Pelanggan
</option>

</select>

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
class="btn btn-primary w-100">

Login

</button>
<hr>

<p class="text-center">

Belum punya akun?

<a href="register.php">
Daftar Disini
</a>

</p>
</form>

</div>

</div>

</div>

</div>

</div>

</body>
</html>