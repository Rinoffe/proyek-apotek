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

        $delete = "DELETE FROM history WHERE username='$username'";
        mysqli_query($connect, $delete);

        header("Location: history.php");
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

    <?php include ('userHeader.php'); ?>
    
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
            $sql = "SELECT h.id_obat, o.nama_obat, o.harga, h.qty, o.stok, o.gambar, h.tanggal, h.metode_pembayaran
                    FROM obat o
                    JOIN history h ON o.id_obat = h.id_obat
                    WHERE h.username = '$_SESSION[username]'";
            $query = mysqli_query($connect, $sql);

            $total = 0;

            while($data = mysqli_fetch_array($query)){
                $total = $data['harga'] * $data['qty'];
        ?>

        <div class="card d-flex flex-row align-items-start gap-3 p-0 mb-2">
            <img src="../images/<?=$data['gambar']?>" class="rounded cart-img" alt="foto produk">
            <div class="flex-grow-1 p-2">
                <a href="produk.php?id=<?=$data['id_obat']?>">
                    <h5 class="mb-1"><?=$data['nama_obat']?></h5>
                </a>
                <p class="m-0"><?=$data['stok']?> x Rp. <?=number_format($data['harga'], 0, ',', '.')?></p>
                <p class="fw-bold m-0">Total: Rp <?=number_format($total, 0, ',', '.')?></p>
            </div>
            <div class="d-flex flex-column align-items-end p-2">
                <p class="mb-0 text-muted"><small><?=$data['tanggal']?></small></p>
                <p class="mb-0 text-muted"><small><?=$data['metode_pembayaran']?></small></p>
            </div>
        </div>

        <?php } ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>