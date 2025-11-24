<?php
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== TRUE) {
        header("Location: ../login.php");
        exit;
    }
    $username = $_SESSION['username'];

    if (isset($_POST['hapus_history'])) {
    include('../connection.php');
    $username = $_SESSION['username'];

    $delete = "DELETE FROM cart WHERE username='$username'";
    mysqli_query($connect, $delete);

    header("Location: history.php");
    exit;
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>History</title>
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
            width: 100px;
            height: 100px;
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
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <h3>Sejarah Pembelian</h3>
            <form action="history.php" method="POST">
                <button type="submit" name="hapus_history" class="btn btn-danger m-0">
                    Hapus Semua History
                </button>
            </form>

        </div><br>

        <?php
            include('../connection.php');
            $sql = "SELECT c.id_obat, o.nama_obat, o.harga, c.qty, o.stok, o.gambar
                    FROM obat o JOIN cart c ON o.id_obat = c.id_obat
                    WHERE c.username = '$_SESSION[username]'";
            $query = mysqli_query($connect, $sql);

            $total = 0;
            $stokhabis = false;

            while($data = mysqli_fetch_array($query)){
                $total += $data['harga'] * $data['qty'];
                if ($data['stok'] == 0) $stokhabis = true;
        ?>

        <div class="card d-flex flex-row align-items-start gap-3 p-0 mb-2">
            <img src="../images/<?=$data['gambar']?>" class="rounded cart-img" alt="foto produk">
            <div class="flex-grow-1 p-2">
                <a href="produk.php?id=<?=$data['id_obat']?>">
                    <h5 class="mb-1"><?=$data['nama_obat']?></h5>
                </a>
                <p class="m-0"><?=$data['stok']?> x Rp. <?=number_format($data['harga'], 0, ',', '.')?></p>
                <p class="fw-bold m-0">Total: Rp <?=number_format($data['harga'] * $data['qty'], 0, ',', '.')?></p>
            </div>
            <div class="d-flex flex-column align-items-end p-2">
                <p class="mb-0 text-muted"><small>23 Mei 2005</small></p>
                <p class="mb-0 text-muted"><small>Tunai</small></p>
            </div>
        </div>

        <?php } ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>