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
    <title>Checkout</title>
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
                    <li><a class="dropdown-item" href="#">Edit</a></li>
                    <li><a class="dropdown-item text-danger" href="../logout.php">Logout</a></li>
                    <li><hr class="dropdown-divider"></hr></li>
                    <li><a class="dropdown-item" href="history.php">History</a></li>
                    <li><a class="dropdown-item" href="pesanan.php">Status Pesanan</a></li>
                </ul>
            </div>
        </div>
    </header>
    
    <div class="container my-5">
        <div class="row">
            
            <!-- LIST PRODUK -->
            <div class="col-lg-7">
                <div class="card" style="height: 75vh;">
                    <div class="card-header">
                        <h5 class="mb-0">Produk Dibeli</h5>
                    </div>
                    <div class="card-body "style="overflow-y: auto; height: calc(75vh - 70px);">

                        <?php
                            include('../connection.php');
                            $sql = "SELECT o.nama_obat, c.qty, o.harga, o.gambar
                                    FROM cart c JOIN obat o ON c.id_obat = o.id_obat
                                    WHERE c.username = '$_SESSION[username]'";
                            $query = mysqli_query($connect, $sql);
                            $total = 0;
                            while($data = mysqli_fetch_array($query)){
                                $subtotal = $data['harga'] * $data['qty'];
                                $total += $subtotal;
                        ?>

                        <div class="d-flex justify-content-between border-bottom pb-2 mb-3">
                            <div class="d-flex align-items-start gap-3 flex-grow-1">
                                <img src="../images/<?=$data['gambar']?>" class="rounded cart-img" alt="foto produk">
                                <div class="flex-grow-1">
                                    <h5 class="mb-1"><?=$data['nama_obat']?></h5>
                                    <p class="mb-0 text-muted">Qty: <?=$data['qty']?></p>
                                </div>
                            </div>
                            <div class="text-end">
                                <h6 class="fw-bold">Rp <?= number_format($subtotal, 0, ',', '.') ?></h6>
                            </div>
                        </div>

                        <?php } ?>

                    </div>
                </div>
            </div>

            <!-- FORM KANAN -->
            <div class="col-lg-5">
                <h2 class="mb-4">Checkout</h2>
                <form action="" method="POST">

                    <div class="mb-3">
                        <label class="form-label fw-bold">Alamat Pengiriman</label>
                        <textarea name="lokasi" class="form-control" rows="3" placeholder="Masukkan alamat lengkap..." required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Metode Pembayaran</label>
                        <select name="metode_pembayaran" class="form-select" required>
                            <option value="" disabled selected>Pilih metode</option>
                            <option value="tunai">Tunai</option>
                            <option value="transfer">Transfer</option>
                        </select>
                    </div>

                    <div class="mb-4 p-3 border rounded">
                        <div class="d-flex justify-content-between">
                            <h5>Total:</h5>
                            <h5 class="fw-bold text-success">Rp <?= number_format($total, 0, ',', '.') ?></h5>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success w-100 py-2">
                        Buat Pesanan
                    </button>

                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>