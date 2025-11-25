<?php
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== TRUE) {
        header("Location: ../login.php");
        exit;
    }

    include "../connection.php";

    // Pastikan ID ada
    if (!isset($_GET['id'])) {
        die("ID tidak ditemukan.");
    }

    $id = $_GET['id'];

    // Ambil gambar lama
    $query = mysqli_query($connect, "SELECT gambar FROM obat WHERE id_obat='$id'");
    $data = mysqli_fetch_assoc($query);
    $gambar = $data['gambar'];

    // Hapus file gambar jika ada
    if ($gambar != "" && file_exists("../uploads/" . $gambar)) {
        unlink("../images/" . $gambar);
    }

    // Hapus data obat dari database
    mysqli_query($connect, "DELETE FROM obat WHERE id_obat='$id'");

    // Balik ke halaman produk
    echo "<script>alert('Produk berhasil dihapus!'); window.location='produk.php';</script>";
?>
