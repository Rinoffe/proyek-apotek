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
    <title>Keranjang</title>
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
                <div class="card" style="height: 75vh">
                    <div class="card-header">
                        <h5 class="mb-0">Produk</h5>
                    </div>
                    <div class="card-body "style="overflow-y: auto; height: calc(75vh - 70px);">

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

                        <div class="d-flex justify-content-between border-bottom pb-2 mb-3">
                            <div class="card-body d-flex align-items-center gap-3 p-0">

                                <img src="../images/<?=$data['gambar']?>" class="rounded cart-img" alt="foto produk">
                                <div class="flex-grow-1">
                                    <a href="produk.php?id=<?=$data['id_obat']?>">
                                        <h5 class="mb-1"><?=$data['nama_obat']?></h5>
                                    </a>
                                    <p class="mb-1">Harga: Rp <?=number_format($data['harga'], 0, ',', '.')?></p>
                                    <p class="mb-0 text-muted"><small>Stok: <?=$data['stok']?></small></p>

                                    <?php if ($data['stok'] == 0): ?>
                                        <p class="text-danger fw-bold "><small>Stok habis — hapus produk ini untuk checkout</small></p>
                                    <?php endif; ?>

                                </div>
                                <div class="d-flex flex-column align-items-end" style="width: 130px;">
                                    <div class="input-group input-group-sm mb-2">
                                        <span class="input-group-text">Qty</span>
                                        <input type="number" class="form-control" name="qty"
                                            min="1" max="<?=$data['stok']?>" value="<?=$data['qty']?>" disabled>
                                    </div>
                                    <a href="deleteCartItem.php?id=<?=$data['id_obat']?>" class="btn btn-danger btn-sm w-100">Hapus</a>
                                </div>
                            </div>
                        </div> 

                        <?php }
                            if (mysqli_num_rows($query) == 0) {
                                echo "<p class='text-center text-muted'>Keranjang kosong.</p>";
                            }
                        ?>

                    </div>
                </div>
            </div>

            <!-- FORM KANAN -->
            <div class="col-lg-5">
                <h2 class="mb-4">Keranjang Belanja</h2>
                <div class="card p-3 checkout-summary">
                    <h4>Total Harga: <span class="text-success">Rp <?=number_format($total, 0, ',', '.')?></span></h4>

                    <form action="checkout.php" method="GET">
                        <button type="submit" class="btn btn-primary w-100 mt-3"
                                <?= ($total == 0 || $stokhabis ? 'disabled' : '') ?>> Checkout
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

</body>

</html>