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
    <title>Detail Pesanan</title>
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

    <?php include ('userHeader.php'); ?>
    
    <div class="container m-4 mx-auto">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <h3 class="m-0">Detail Transaksi</h3>
            <div class="d-flex align-items-center gap-2">
                <a href="pesanan.php" class="btn btn-success">🡸</a>
                <span class="fs-4 fw-bold p-0">Kembali</span>
            </div>
        </div><br>

        <?php
            include('../connection.php');
            $id = $_GET['id'];

            $sql = "SELECT td.id_obat, o.nama_obat, o.harga, o.gambar, td.qty
                    FROM transaksi t
                    JOIN transaksi_detail td ON t.id_transaksi = td.id_transaksi
                    JOIN obat o ON td.id_obat = o.id_obat
                    WHERE t.id_transaksi = '$id'";
            $query = mysqli_query($connect, $sql);

            $total = $subtotal = 0;
            while($data = mysqli_fetch_array($query)){
                $subtotal = $data['harga'] * $data['qty'];
                $total += $subtotal;
        ?>

        <div class="card d-flex flex-row align-items-center gap-3 p-0 mb-2">
            <img src="../images/<?=$data['gambar']?>" class="rounded cart-img" alt="foto produk">
            <div class="flex-grow-1 p-2">
                <a href="produk.php?id=<?=$data['id_obat']?>">
                    <h5 class="mb-1"><?=$data['nama_obat']?></h5>
                </a>
                <p class="m-0"><?=$data['qty']?> x Rp. <?=number_format($data['harga'], 0, ',', '.')?></p>                
            </div>
            <p class="fw-bold m-0 p-2">Subtotal: Rp <?=number_format($subtotal, 0, ',', '.')?></p>
        </div>

        <?php } ?>
        <h4>Total Harga: <span class="text-success">Rp <?=number_format($total, 0, ',', '.')?></span></h4>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>