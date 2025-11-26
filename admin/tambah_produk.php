<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== TRUE) {
    header("Location: ../login.php");
    exit;
}
$username = $_SESSION['username'];

include "../connection.php";

// Proses tambah produk
if (isset($_POST['submit'])) {

    $nama = $_POST['nama_obat'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];

    // Upload gambar baru
    $gambar = "";
    if ($_FILES['gambar']['name'] != "") {

        $gambar = time() . "_" . $_FILES['gambar']['name'];
        $path = "../images/" . $gambar;

        move_uploaded_file($_FILES['gambar']['tmp_name'], $path);
    }

    // Insert data baru
    $insert = mysqli_query($connect, "
        INSERT INTO obat (nama_obat, deskripsi, stok, harga, gambar)
        VALUES ('$nama', '$deskripsi', '$stok', '$harga', '$gambar')
    ");

    if ($insert) {
        echo "<script>alert('Produk berhasil ditambahkan!'); window.location='produk.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan produk!');</script>";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        label { font-weight: bold; }
    </style>
</head>

<body style="background-color: #ffffff;">

    <?php include ('adminHeader.php'); ?>

<div class="container m-4 mx-auto">
    <h3 class="text-center">Tambah Produk</h3>

    <form action="" method="POST" enctype="multipart/form-data">

        <label class="mt-3">Nama Produk</label>
        <input type="text" name="nama_obat" class="form-control" required>

        <label class="mt-3">Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="4" required></textarea>

        <label class="mt-3">Harga</label>
        <input type="number" name="harga" class="form-control" required>

        <label class="mt-3">Stok</label>
        <input type="number" name="stok" class="form-control" required>

        <label class="mt-3">Upload Gambar</label>
        <input type="file" name="gambar" class="form-control" required>

        <button type="submit" name="submit" class="btn btn-success mt-3">Tambah Produk</button>
        <a href="produk.php" class="btn btn-secondary mt-3 ms-4">Batal</a>
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
