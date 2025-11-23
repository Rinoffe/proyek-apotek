<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== TRUE) {
    header("Location: ../login.php");
    exit;
}
$username = $_SESSION['username'];

include "../connection.php";

// Pastikan ID ada
if (!isset($_GET['id'])) {
    die("ID tidak ditemukan.");
}

$id = $_GET['id'];

// Ambil data lama
$query = mysqli_query($connect, "SELECT * FROM obat WHERE id_obat='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Produk tidak ditemukan.");
}

// Proses update
if (isset($_POST['submit'])) {

    $nama = $_POST['nama_obat'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $gambar_lama = $data['gambar'];

    // Cek jika upload gambar baru
    if ($_FILES['gambar']['name'] != "") {

        $gambar_baru = time() . "_" . $_FILES['gambar']['name'];
        $path = "../images/" . $gambar_baru;  // ← SUDAH DIGANTI KE /images

        // Upload file baru
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $path)) {

            // Hapus gambar lama jika ada
            if ($gambar_lama != "" && file_exists("../images/" . $gambar_lama)) { // ← SUDAH DIGANTI
                unlink("../images/" . $gambar_lama);  // ← SUDAH DIGANTI
            }

            $gambar_final = $gambar_baru;
        }
    } else {
        // Jika tidak ganti foto
        $gambar_final = $gambar_lama;
    }

    // Update data
    $update = mysqli_query($connect, "
        UPDATE obat SET 
            nama_obat='$nama',
            deskripsi='$deskripsi',
            stok='$stok',
            harga='$harga',
            gambar='$gambar_final'
        WHERE id_obat='$id'
    ");

    if ($update) {
        echo "<script>alert('Produk berhasil diupdate!'); window.location='produk.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate!');</script>";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        header { background-color: #1c794a; }
        label { font-weight: bold; }
    </style>
</head>

<body style="background-color: #ffffff;">

<header class="d-flex flex-wrap justify-content-between align-items-center p-3 px-5">
    <a href="produk.php" class="d-flex align-items-center text-decoration-none">
        <img src="../asset/logo.png" alt="logo" height="80" class="me-2">
        <h2 class="text-white mb-0">Apotek K25</h2>
    </a>

    <div class="dropdown">
        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
            <?= $username ?>
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item text-danger" href="../logout.php">Logout</a></li>
        </ul>
    </div>
</header>

<div class="container mt-4">
    <h3>Edit Produk</h3>
    <form action="" method="POST" enctype="multipart/form-data">

        <label class="mt-3">Nama Produk</label>
        <input type="text" name="nama_obat" value="<?= $data['nama_obat']; ?>" class="form-control" required>

        <label class="mt-3">Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="4" required><?= $data['deskripsi']; ?></textarea>

        <label class="mt-3">Harga</label>
        <input type="number" name="harga" value="<?= $data['harga']; ?>" class="form-control" required>

        <label class="mt-3">Stok</label>
        <input type="number" name="stok" value="<?= $data['stok']; ?>" class="form-control" required>

        <label class="mt-3">Gambar Saat Ini</label><br>
        <img src="../images/<?= $data['gambar']; ?>" width="150" class="border mb-3"> <!-- SUDAH DIGANTI -->

        <label class="mt-3">Ganti Gambar (opsional)</label>
        <input type="file" name="gambar" class="form-control">

        <button type="submit" name="submit" class="btn btn-success mt-3">Simpan Perubahan</button>
        <a href="produk.php" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
