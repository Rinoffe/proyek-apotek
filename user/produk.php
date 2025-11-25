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

    <?php include ('userHeader.php'); ?>

    <div class="container m-4 mx-auto d-flex align-items-center gap-3">
        <a href="home.php" class="btn btn-success px-4 fs-6">🡸</a>
        <h3>Produk</h3>
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

    <div class="container m-4 mx-auto row">
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
                <h5 class="pb-4">Stok: <?=$data['stok']?></h5>

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