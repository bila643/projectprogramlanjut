<?php

session_start();
include "koneksi.php";

$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

$query = mysqli_query(
$conn,
"SELECT * FROM users
WHERE email='$email'
AND password='$password'
AND role='$role'"
);

$data = mysqli_fetch_assoc($query);

if($data)
{
    $_SESSION['id'] = $data['id'];
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['role'] = $data['role'];

    if($data['role']=="admin")
    {
        header("Location: dashboard.php");
    }
    elseif($data['role']=="petugas")
    {
        header("Location: dashboard_petugas.php");
    }
    elseif($data['role']=="pelanggan")
    {
        header("Location: dashboard_pelanggan.php");
    }

    exit;
}
else
{
    echo "
    <script>
    alert('Email, Password, atau Role salah!');
    window.location='login.php';
    </script>
    ";
}

?>