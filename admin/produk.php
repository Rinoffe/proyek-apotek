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
                    <a class="nav-link active text-white fw-bold" href="produk.php">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold" href="pesanan.php">Pesanan Masuk</a>
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
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <div class="d-flex flex-wrap align-items-center gap-3">
                <h3>Data Produk</h3>
                <div class="dropdown">
                    <button type="button" class="btn btn-outline-success dropdown-toggle" data-bs-toggle="dropdown">Filters</button>
                    <ul class="dropdown-menu">
                        <button id="asc" class="btn filter-btn">Nama A-Z</button>
                        <button id="desc" class="btn filter-btn">Nama Z-A</button>
                    </ul>
                </div>
            </div>
            <a href="tambah-produk.php" class="btn btn-success">Tambah Produk</a>
        </div><br>

        <table class="table table-striped table-bordered th-color">
            <tr>
                <th>Produk ID</th>
                <th>Nama Produk</th>
                <th>Stok</th>
                <th>Tambah Stok</th>
                <th>Aksi</th>
            </tr>

            <tbody id="productList">
                <?php
                    include "../connection.php";
                    $sql = "SELECT * FROM obat";
                    $query = mysqli_query($connect, "$sql");
                    while ($row = mysqli_fetch_assoc($query)) : ?>

                    <tr>
                        <td><?= $row['id_obat']; ?></td>
                        <td><?= $row['nama_obat']; ?></td>
                        <td><?= $row['stok']; ?></td>

                        <td>
                            <a href="tambah-stok.php?id=<?= $row['id_obat']; ?>" class="btn btn-warning btn-sm">Tambah</a>
                        </td>

                        <td>
                            <a href="edit_produk.php?id=<?= $row['id_obat']; ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="hapus_produk.php?id=<?= $row['id_obat']; ?>" 
                                class="btn btn-danger btn-sm" 
                                onclick="return confirm('Yakin hapus produk ini?');">
                            Hapus
                            </a>

                        </td>
                    </tr>

                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script>

        function loadProducts(filter = "") {
            fetch("../filter/adminFilter.php?filter=" + filter)
                .then(response => response.text())
                .then(html => {
                    document.getElementById("productList").innerHTML = html;
                });
        }
        document.getElementById("asc").addEventListener("click", function() {loadProducts("az");});
        document.getElementById("desc").addEventListener("click", function() {loadProducts("za");});

    </script>
</body>

</html>
