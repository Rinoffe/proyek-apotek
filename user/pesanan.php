<?php
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== TRUE) {
        header("Location: ../login.php");
        exit;
    }
    $username = $_SESSION['username'];
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Status Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        header{
            background-color: #1c794a;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .sidebar {
            position: sticky;
            top: 128px;
        }
        .th-color th{
            background-color: #1c794a;
            color: #ffffffff;
        }
        .cart-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
        }     
        a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>

<body style="background-color: #ffffff;">

    <header class="d-flex flex-wrap justify-content-between align-items-center p-3 px-5">
        <a href="home.php" class="d-flex align-items-center text-decoration-none">
            <img src="../asset/logo.png" alt="logo apotek" height="80" class="me-2">
            <h2 class="text-white mb-0">Apotek K25</h2>
        </a>
        <div class="d-flex flex-wrap justify-content-end">
            <a href="cart.php" class="btn btn-light me-4">Cart</a>
            <div class="dropdown">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"><?=$username?>'s</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="../editUser.php?id=<?=$username?>">Edit</a></li>
                    <li><a class="dropdown-item text-danger" href="../logout.php">Logout</a></li>
                    <li><hr class="dropdown-divider"></hr></li>
                    <li><a class="dropdown-item" href="history.php">History</a></li>
                    <li><a class="dropdown-item" href="pesanan.php">Status Pesanan</a></li>
                </ul>
            </div>
        </div>
    </header>
    
    <div class="container m-4 mx-auto">
        <h3 class="m-0">Status Pesanan</h3><br>

        <table class="table table-striped table-bordered th-color shadow" style="border-radius: 12px; overflow: hidden;">
            <tr>
                <th>ID Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>Detail</th>
                <th>Status</th>
            </tr>

            <?php
                include ('../connection.php');

                $sql = "SELECT * FROM transaksi";
                $query = mysqli_query($connect, $sql);
                while ($data = mysqli_fetch_array($query)) { ?>
                    
            <tr>
                <td><?=$data['id_transaksi']?></td>
                <td><?=$data['tanggal']?></td>
                <td><a href="detailPesanan.php?id=<?=$data['id_transaksi']?>" class="btn btn-primary btn-sm">Detail</a></td>
                <td><?=$data['status']?></td>
            </tr>

            <?php } ?>

        </table>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>