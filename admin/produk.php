<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== TRUE) {
    header("Location: ../login.php");
    exit;
}
$username = $_SESSION['username'];

include "../connection.php";

// TAMBAH STOK PRODUK
if (isset($_POST['tambah_stok'])) {
    $id = $_POST['id'];
    $tambah_stok = $_POST['tambah_stok'];

    // Ambil stok lama
    $q = mysqli_query($connect, "SELECT stok FROM obat WHERE id_obat='$id'");
    $d = mysqli_fetch_assoc($q);
    $stok_baru = $d['stok'] + $tambah_stok;

    // Update stok
    mysqli_query($connect, "UPDATE obat SET stok='$stok_baru' WHERE id_obat='$id'");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produk</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .th-color th {
            background-color: #1c794a;
            color: white;
        }
    </style>
</head>

<body style="background-color: #ffffff;">

    <?php include('adminHeader.php'); ?>

    <div class="container m-4 mx-auto">

        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <div class="d-flex flex-wrap align-items-center gap-3">
                <h3>Data Produk</h3>

                <div class="dropdown">
                    <button type="button" class="btn btn-outline-success dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="bi bi-funnel"></i> Filters
                    </button>
                    <ul class="dropdown-menu">
                        <button id="latest" class="btn filter-btn">Produk Terbaru</button>
                        <button id="asc" class="btn filter-btn">Nama A-Z</button>
                        <button id="desc" class="btn filter-btn">Nama Z-A</button>
                        <button id="stok" class="btn filter-btn">Stok Minim</button>
                    </ul>
                </div>
            </div>

            <a href="tambah_produk.php" class="btn btn-success">
                <i class="bi bi-database-add"></i> Tambah Produk
            </a>
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
                $sql = "SELECT * FROM obat";
                $query = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_assoc($query)) :
                ?>

                    <tr>
                        <td><?= $row['id_obat']; ?></td>
                        <td><?= $row['nama_obat']; ?></td>
                        <td><?= $row['stok']; ?></td>

                        <td>
                            <form action="produk.php" method="POST" class="d-flex align-items-center gap-2">
                                <input type="number" class="form-control form-control-sm" name="tambah_stok" min="1" style="width: 70px;">
                                <input type="hidden" name="id" value="<?= $row['id_obat']; ?>">
                                <button class="btn btn-warning btn-sm">Tambah</button>
                            </form>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function loadProducts(filter = "") {
            fetch("../filter/adminFilter.php?filter=" + filter)
                .then(response => response.text())
                .then(html => {
                    document.getElementById("productList").innerHTML = html;
                });
        }
        document.getElementById("latest").addEventListener("click", function() { loadProducts("latest"); });
        document.getElementById("asc").addEventListener("click", function() { loadProducts("az"); });
        document.getElementById("desc").addEventListener("click", function() { loadProducts("za"); });
        document.getElementById("stok").addEventListener("click", function() { loadProducts("minStok"); });
    </script>

</body>

</html>
