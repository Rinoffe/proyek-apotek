<?php

session_start();

$servername = "localhost";
$username_db = "root"; 
$password_db = ""; 
$dbname = "apotek"; 

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    
    $input_username = $_POST['username'];
    $input_password = $_POST['password']; 

    
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    if ($conn->connect_error) {
        $message = "Koneksi database gagal: " . $conn->connect_error;
    } else {
        
        
        $stmt = $conn->prepare("SELECT username, nama, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $input_username);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows == 1) {
            
            $stmt->bind_result($db_username, $db_nama, $hashed_password);
            $stmt->fetch();
            
            
            if ($input_password == $hashed_password) {
                
                
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['username'] = $db_username;
                
                header("Location: user/home.php");
                exit;
            } else {
                $message = "<span class='text-danger'>Error: Password yang dimasukkan salah.</span>";
            }
        } else {
            $message = "<span class='text-danger'>Error: Username tidak terdaftar.</span>";
        }
        
        $stmt->close();
        $conn->close();
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Apotek K25</title>
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
        <a href="home.php" class="d-flex align-items-center text-decoration-none">
            <img src="asset/logo.png" alt="logo apotek" height="80" class="me-2">
            <h2 class="text-white mb-0">Apotek K25</h2>
        </a>
    </header>
    
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h3 class="card-title text-center mb-4">Login ke Akun Anda</h3>
                        
                        <?php 
                        
                        if (!empty($message)) {
                            $alert_class = (strpos($message, 'Error') !== false || strpos($message, 'salah') !== false) ? 'alert-danger' : 'alert-success';
                            echo "<div class='alert $alert_class text-center' role='alert'>$message</div>";
                        }
                        ?>

                        <form action="login.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" id="username" name="username" class="form-control" required>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100" style="background-color: #1c794a; border-color: #1c794a;">Login</button>
                            <p class="mt-3 text-center text-muted">Belum punya akun? <a href="registrasi.php">Daftar di sini</a></p>
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