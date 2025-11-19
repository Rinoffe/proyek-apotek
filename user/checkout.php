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
        <h2 class="mb-4">Checkout</h2>

        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label fw-bold">Alamat Pengiriman</label>
                <textarea name="lokasi" class="form-control" rows="3" placeholder="Masukkan alamat lengkap..." required></textarea>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Metode Pembayaran</label>
                <select name="metode_pembayaran" class="form-select" required>
                    <option value="" disabled selected>Pilih metode</option>
                    <option value="tunai">Tunai</option>
                    <option value="transfer">Transfer</option>
                </select>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Produk</h5>
                </div>
                <div class="card-body">

                    <?php
                        include('../connection.php');
                        $sql = "SELECT c.nama_obat, c.qty, o.harga, o.gambar
                                FROM cart c JOIN obat o ON c.id_obat = o.id_obat
                                WHERE c.username = 'admin'";
                        $query = mysqli_query($connect, $sql);
                        $total = 0;
                        while($data = mysqli_fetch_array($query)){
                            $subtotal = $data['harga'] * $data['qty'];
                            $total += $subtotal;
                    ?>

                    <div class="d-flex justify-content-between border-bottom pb-2 mb-2">
                        <div class="card-body d-flex align-items-center gap-3">
                            <img src="../images/<?=$data['gambar']?>" class="rounded cart-img" alt="foto produk">
                            <div class="flex-grow-1">
                                <h4 class="mb-1"><?=$data['nama_obat']?></h4>
                                <p class="mb-0 text-muted">Qty: <?=$data['qty']?></p>
                            </div>
                            <div>
                                <h5 class="mb-1">Rp. <?=number_format($subtotal, 0, ',', '.')?></h5>
                            </div>
                        </div>
                    </div>

                    <?php } ?>

                    <div class="d-flex justify-content-between mt-3 px-3">
                        <h5>Total:</h5>
                        <h5 class="fw-bold">Rp. <?= number_format($total, 0, ',', '.') ?></h5>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success w-100 py-2">Buat Pesanan</button>
        </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>