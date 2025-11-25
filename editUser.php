<?php
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== TRUE) {
        header("Location: ../login.php");
        exit;
    }
    $role = $_SESSION['role'];
    $kembali = '';
    if ($role != 'user') {
        $kembali = 'admin/produk.php';
    }else{
        $kembali = 'user/home.php';
    }

    include ('connection.php');
    $message = "";
    $currentUsername = $_SESSION['username'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if ($connect->connect_error) {
            $message = "Koneksi database gagal: " . $connect->connect_error;
        } else {
            $newUsername = $_POST['username'];
            $password = $_POST['password']; 
            $nama = $_POST['nama'];
            $canUpdate = true;
            
            if ($newUsername !== $currentUsername) {
                $stmt_check = $connect->prepare("SELECT username FROM users WHERE username = ?");
                $stmt_check->bind_param("s", $newUsername);
                $stmt_check->execute();
                $stmt_check->store_result();
            
                if ($stmt_check->num_rows > 0) {
                    $message = "<span class='text-danger'>Error: Username <b>" . htmlspecialchars($newUsername) . "</b> sudah terdaftar. Silakan gunakan username lain.</span>";
                    $canUpdate = false;
                } 
                $stmt_check->close();
            }

            if ($canUpdate) {
                $stmt_insert = $connect->prepare("UPDATE users SET username=?, nama=?, password=? WHERE username=?");
                $stmt_insert->bind_param("ssss", $newUsername, $nama, $password, $currentUsername);
                
                if ($stmt_insert->execute()) {
                    $message = "<span class='text-success'>Edit data berhasil!</span>";

                    $_SESSION['username'] = $newUsername;
                    $currentUsername = $newUsername;
        
                } else {
                    $message = "<span class='text-danger'>Error saat menyimpan data: " . $stmt_insert->error . "</span>";
                }
                $stmt_insert->close();
            }
        }
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Akun</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        header{
            background-color: #1c794a;
            position: sticky;
            top: 0;
            z-index: 100;
        }
    </style>
</head>

<body style="background-color: #ffffff;">

    <?php
        $role = $_SESSION['role'];
        if ($role == 'admin') { ?>
            <header class="d-flex flex-wrap justify-content-between align-items-center p-3 px-5">
                <a href="produk.php" class="d-flex align-items-center text-decoration-none">
                    <img src="asset/logo.png" alt="logo.png" height="80" class="me-2">
                    <h2 class="text-white mb-0 fw-bold">Apotek K25</h2>
                </a>
                <div class="d-flex flex-wrap justify-content-end align-items-center">
                    <ul class="nav justify-content-end px-3">
                        <li class="nav-item">
                            <a class="nav-link active text-white fw-bold" href="admin/produk.php">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white fw-bold" href="admin/pesanan.php">Pesanan Masuk</a>
                        </li> 
                    </ul>
                    <div class="dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-person-circle"></i> <?=$currentUsername?>'s</button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="editUser.php?id=<?=$currentUsername?>">Edit</a></li>
                            <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </header>
        <?php } else { ?>
            <header class="d-flex flex-wrap justify-content-between align-items-center p-3 px-5">
                <a href="<?= $kembali ?>" class="d-flex align-items-center text-decoration-none">
                    <img src="asset/logo.png" alt="logo apotek" height="80" class="me-2">
                    <h2 class="text-white mb-0 fw-bold">Apotek K25</h2>
                </a>
                <div class="d-flex flex-wrap justify-content-end">
                    <a href="user/cart.php" class="btn btn-light me-4">Cart</a>
                    <div class="dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-person-circle"></i> <?=$currentUsername?>'s</button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="editUser.php?id=<?=$currentUsername?>">Edit</a></li>
                            <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                            <li><hr class="dropdown-divider"></hr></li>
                            <li><a class="dropdown-item" href="user/history.php">History</a></li>
                            <li><a class="dropdown-item" href="user/pesanan.php">Status Pesanan</a></li>
                        </ul>
                    </div>
                </div>
            </header>
        <?php } ?>
    
    <div class="container mt-4" style="width: 600px;">
        <h3 class="m-0 text-center">Edit Akun</h3><br>

        <?php
            include ('connection.php');
            $sql = "SELECT * FROM users WHERE username = '$currentUsername'";
            $query = mysqli_query($connect, $sql);
            $data = mysqli_fetch_array($query);
            
            if (!empty($message)){
                $alert_class = (strpos($message, 'Error') !== false || strpos($message, 'gagal') !== false) ? 'alert-danger' : 'alert-success';
                echo "<div class='alert $alert_class text-center' role='alert'>$message</div>";
            }
        ?>

        <div class="p-4 border rounded shadow">
            <form action="editUser.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label fw-bold">Username</label>
                    <input type="text" class="form-control bg-light" name="username" value="<?=$data['username']?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label fw-bold">Nama</label>
                    <input type="text" class="form-control" name="nama" value="<?=$data['nama']?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Password</label>
                    <input type="password" class="form-control" name="password" value="<?=$data['password']?>" required>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="<?= $kembali ?>" class="btn btn-success">Kembali</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>