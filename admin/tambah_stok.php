<?php
include "../connection.php";

// Ambil ID obat dari URL
if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan.";
    exit;
}

$id_obat = $_GET['id'];

// Ambil data obat lama
$query = mysqli_query($connect, "SELECT * FROM obat WHERE id_obat = '$id_obat'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data obat tidak ditemukan.";
    exit;
}

// Proses Jika Form Disubmit
if (isset($_POST['submit'])) {

    $tambah_stok = intval($_POST['tambah_stok']);

    if ($tambah_stok <= 0) {
        echo "Stok harus lebih dari 0.";
        exit;
    }

    // Hitung stok baru
    $stok_baru = $data['stok'] + $tambah_stok;

    // Update database
    $update = mysqli_query($connect, "UPDATE obat SET stok = '$stok_baru' WHERE id_obat = '$id_obat'");

    if ($update) {
        echo "
            <script>
                alert('Stok berhasil ditambahkan');
                window.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "Gagal menambahkan stok: " . mysqli_error($connect);
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Tambah Stok</title>
</head>

<body>
    <h2>Tambah Stok Obat</h2>

    <p><b>Nama Obat:</b> <?= $data['nama_obat'] ?></p>
    <p><b>Stok Lama:</b> <?= $data['stok'] ?></p>

    <form action="" method="POST">
        <label>Tambah Stok:</label>
        <input type="number" name="tambah_stok" min="1" required>

        <button type="submit" name="submit">Tambah</button>
    </form>

</body>
</html>
