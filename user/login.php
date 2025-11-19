<?php
session_start();
require_once __DIR__ . '/../config.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    $data = mysqli_fetch_assoc($query);

    if ($data && password_verify($password, $data['password'])) {

        $_SESSION['login'] = true;
        $_SESSION['role']  = $data['role'];
        $_SESSION['nama']  = $data['nama'];

        if ($data['role'] == 'admin') {
            header("Location: ../admin/dashboard.php");
        } else {
            header("Location: user_home.php");
        }
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>
<p style="color:red;"><?= $error ?></p>

<form method="POST">
    <label>Username</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Masuk</button>
</form>

<a href="register.php">Belum punya akun? Daftar</a>

</body>
</html>
