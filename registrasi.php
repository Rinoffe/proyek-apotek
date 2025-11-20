<?php

$servername = "localhost";
$username_db = "root"; 
$password_db = ""; 
$dbname = "apotek"; 

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    if ($conn->connect_error) {
        $message = "Koneksi database gagal: " . $conn->connect_error;
    } else {
        $username = $_POST['username'];
        $password = $_POST['password']; 
        
        
        $stmt_check = $conn->prepare("SELECT username FROM users WHERE username = ?");
        $stmt_check->bind_param("s", $username);
        $stmt_check->execute();
        $stmt_check->store_result();
        
        if ($stmt_check->num_rows > 0) {
            $message = "<span class='text-danger'>Error: Username <b>" . htmlspecialchars($username) . "</b> sudah terdaftar. Silakan gunakan username lain.</span>";
        } else {

            $stmt_insert = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt_insert->bind_param("ss", $username, $password);
            
            if ($stmt_insert->execute()) {
                $message = "<span class='text-success'>Registrasi berhasil! Silakan <a href='login.php' class='alert-link'>Login</a>.</span>";
                
                $_POST['username'] = ''; 
                $_POST['password'] = '';
            } else {
                $message = "<span class='text-danger'>Error saat menyimpan data: " . $stmt_insert->error . "</span>";
            }
            
            $stmt_insert->close();
        }
        
        $stmt_check->close();
        $conn->close();
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi Apotek K25</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        
        .header-custom {
            background-color: #1c794a; 
            position: sticky;
            top: 0;
        }
    </style>
</head>

<body style="background-color: #f4f4f4;">

    <header class="header-custom d-flex flex-wrap justify-content-start align-items-center p-3 px-5">
        <div class="d-flex align-items-center text-decoration-none">
            <img src="asset/logo.png" alt="logo apotek" height="80" class="me-2">
            <h2 class="text-white mb-0">Apotek K25</h2>
        </div>
    </header>
    
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h3 class="card-title text-center mb-4">Registrasi Akun Baru</h3>
                        
                        <?php 
                        
                        if (!empty($message)) {
                            
                            $alert_class = (strpos($message, 'Error') !== false || strpos($message, 'gagal') !== false) ? 'alert-danger' : 'alert-success';
                            echo "<div class='alert $alert_class text-center' role='alert'>$message</div>";
                        }
                        ?>

                        <form action="registrasi.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" id="username" name="username" class="form-control" required>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100" style="background-color: #1c794a; border-color: #1c794a;">Daftar Sekarang</button>
                            <p class="mt-3 text-center text-muted">Sudah punya akun? <a href="login.php">Login di sini</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>