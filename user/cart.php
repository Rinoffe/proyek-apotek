<?php
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== TRUE) {
        header("Location: ../login.php");
        exit;
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        header{
            background-color: #1c794a;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .cart-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
        }
    </style>
</head>

<body style="background-color: #f8f9fa;">

    <header class="d-flex flex-wrap justify-content-between align-items-center p-3 px-5">
        <a href="home.php" class="d-flex align-items-center text-decoration-none">
            <img src="../asset/logo.png" alt="logo apotek" height="80" class="me-2">
            <h2 class="text-white mb-0">Apotek K25</h2>
        </a>
        <div class="d-flex flex-wrap justify-content-end">
            <a href="cart.php" class="btn btn-light me-4">Cart</a>
            <div class="dropdown">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">ADMIN</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Edit</a></li>
                    <li><a class="dropdown-item text-danger" href="#">Logout</a></li>
                    <li><hr class="dropdown-divider"></hr></li>
                    <li><a class="dropdown-item" href="#">History</a></li>
                    <li><a class="dropdown-item" href="#">Announcement</a></li>
                </ul>
            </div>
        </div>
    </header>

    <div class="container my-5">
        <h2 class="mb-4">Keranjang Belanja</h2>

        <?php
            include('../connection.php');
            $sql = "SELECT o.nama_obat, o.harga, c.qty, o.stok, o.gambar
                    FROM obat o JOIN cart c ON o.id_obat = c.id_obat
                    WHERE c.username = '$_SESSION[username]'";
            $query = mysqli_query($connect, $sql);
            $total = 0;
            while($data = mysqli_fetch_array($query)){
                $total += $data['harga'] * $data['qty'];
        ?>
        
        <div class="card mb-3">
            <div class="card-body d-flex align-items-center gap-3">
                <img src="../images/<?=$data['gambar']?>" class="rounded cart-img" alt="foto produk">
                <div class="flex-grow-1">
                    <h4 class="mb-1"><?=$data['nama_obat']?></h4>
                    <p class="mb-1">Harga: Rp <?=number_format($data['harga'], 0, ',', '.')?></p>
                    <p class="mb-0 text-muted">Stok: <?=$data['stok']?></p>
                </div>
                <div class="col input-group" style="max-width:150px;">
                    <span class="input-group-text">Qty</span>
                    <input type="number" class="form-control" name="qty" min="1" max="<?=$data['stok']?>" value="<?=$data['qty']?>" required>
                </div>
                <button class="btn btn-danger">Hapus</button>
            </div>
        </div>

        <?php } ?>

        <div class="card p-3 checkout-summary">
            <h4>Total Harga: <span class="text-success">Rp <?=number_format($total, 0, ',', '.')?></span></h4>
            <a href="checkout.php" class="btn btn-primary w-100 mt-3">Checkout</a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
