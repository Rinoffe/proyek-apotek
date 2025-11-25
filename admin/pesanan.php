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
    <title>Pesanan Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        header{
            background-color: #1c794a;
        }
        .th-color th{
            background-color: #1c794a;
            color: white;
        }
    </style>
</head>

<body style="background-color: #ffffff;">

    <header class="d-flex flex-wrap justify-content-between align-items-center p-3 px-5">
        <a href="produk.php" class="d-flex align-items-center text-decoration-none">
            <img src="../asset/logo.png" alt="logo.png" height="80" class="me-2">
            <h2 class="text-white mb-0">Apotek K25</h2>
        </a>
        <div class="d-flex flex-wrap justify-content-end align-items-center">
            <ul class="nav justify-content-end px-3">
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold" href="produk.php">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-white fw-bold" href="pesanan.php">Pesanan Masuk</a>
                </li> 
            </ul>
            <div class="dropdown">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"><?=$username?>'s</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="../editUser.php?id=<?=$username?>">Edit</a></li>
                    <li><a class="dropdown-item text-danger" href="../logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </header>

    <div class="container m-4 mx-auto">
        <h3>Pesanan Masuk</h3><br>

        <table class="table table-striped table-bordered th-color">
            <tr>
                <th>ID Transaksi</th>
                <th>Username</th>
                <th>Tanggal Masuk</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>

            <?php 
                include ('../connection.php');
                $sql = "SELECT * FROM transaksi ORDER BY id_transaksi DESC";
                $query = mysqli_query($connect, $sql);

                while ($data = mysqli_fetch_array($query)){ ?>

            <tr>
                <td><?=$data['id_transaksi']?></td>
                <td><?=$data['username']?></td>
                <td><?=$data['tanggal']?></td>
                <td><?=$data['status']?></td>

                <td>
                    <?php
                        if ($data['status'] == "Dikemas") {
                            echo "<a href='ubah_status.php?id=" . $data['id_transaksi'] . "&aksi=kirim' class='btn btn-warning'>Kirim</a>";
                        }
                        else if ($data['status'] == "Dikirim") {
                            echo "<a href='ubah_status.php?id=" . $data['id_transaksi'] . "&aksi=selesai' class='btn btn-primary'>Selesai</a>";
                        }
                    ?>
                </td>

            </tr>

            <?php } ?>

        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>