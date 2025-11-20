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
    <title>Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        header{
            background-color: #1c794a;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .gambar-produk img{
            width: 100%;
            height: 420px;
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
                    <li><a class="dropdown-item" href="#">History</a></li>
                    <li><a class="dropdown-item" href="#">Status Pesanan</a></li>
                </ul>
            </div>
        </div>
    </header>

    <div class="ms-5 mt-4 d-flex align-items-center gap-3">
        <a href="home.php" class="btn btn-success px-4 fs-5">🡸</a>
        <h2>Produk</h2>
    </div>

    <?php
        include ('../connection.php');
        $id = $_GET['id'];
        $sql = "SELECT * FROM obat WHERE id_obat = '$id'";
        $query = mysqli_query($connect, $sql);
        $data = mysqli_fetch_array($query);
        $qty = 1;

        if (isset($_GET['success'])) {
            $qty = $_GET['qty'];
        }
    ?>

    <div class="m-5 mt-3 row">
        <div class="col-md-5 p-0">
            <div class="m-2 gambar-produk">
                <img src="../images/<?=$data['gambar']?>" alt="foto produk" class="border rounded shadow">
            </div>
        </div>
        

        <div class="col-md-7">
            <div class="m-2 container p-4 shadow rounded">
                <h1 class="pb-4"><?=$data['nama_obat']?></h1>
                <div class="card p-4 mb-4" style="background-color: #ffffffff;">
                    <p class="m-0"><?=$data['deskripsi']?></p>
                </div>
                <h4 class="pb-4">Stok: <?=$data['stok']?></h4>

                <div class="d-flex">
                    <form action="cartProses.php" method="POST">
                        <div class="row">
                            <div class="col input-group">
                                <span class="input-group-text fw-bold">Qty</span>
                                <input type="number" class="form-control" name="qty" min="1" max="<?=$data['stok']?>" value="<?=$qty?>" required>
                            </div>
                            <input type="hidden" name="from" value="produk">
                            <input type="hidden" name="id_obat" value="<?=$data['id_obat']?>">
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Tambahkan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success text-center mx-5 mt-3">
                    Produk berhasil dimasukkan ke keranjang!
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>