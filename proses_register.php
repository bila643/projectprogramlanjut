<?php

include "koneksi.php";

$nama = $_POST['nama'];
$email = $_POST['email'];
$password = $_POST['password'];

$cek = mysqli_query($conn,"
SELECT *
FROM users
WHERE email='$email'
");

if(mysqli_num_rows($cek)>0)
{
    echo "
    <script>
    alert('Email sudah terdaftar!');
    window.location='register.php';
    </script>
    ";
    exit;
}

mysqli_query($conn,"
INSERT INTO users
(
nama,
email,
password,
role
)
VALUES
(
'$nama',
'$email',
'$password',
'pelanggan'
)
");

echo "
<script>
alert('Registrasi berhasil');
window.location='login.php';
</script>
";

?>