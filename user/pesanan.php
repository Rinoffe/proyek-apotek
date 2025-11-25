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

    <?php include ('userHeader.php'); ?>
    
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