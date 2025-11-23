<?php
include '../connection.php';

if (isset($_POST['id_obat'])) {

    $id_obat     = $_POST['id_obat'];
    $nama_obat   = $_POST['nama_obat'];
    $harga       = $_POST['harga'];
    $stok        = $_POST['stok'];
    $deskripsi   = $_POST['deskripsi'];
    $gambar_lama = $_POST['gambar_lama']; // dari hidden input

    // cek apakah user upload gambar baru
    if (!empty($_FILES['gambar']['name'])) {

        $nama_file_baru = time() . '_' . $_FILES['gambar']['name']; 
        $lokasi_tmp = $_FILES['gambar']['tmp_name'];

        // pindahkan file baru ke folder images/
        move_uploaded_file($lokasi_tmp, 'images/' . $nama_file_baru);

        // hapus gambar lama (jika ada dan file-nya ditemukan)
        if (!empty($gambar_lama) && file_exists('images/' . $gambar_lama)) {
            unlink('images/' . $gambar_lama);
        }

        $gambar_fix = $nama_file_baru; // simpan nama baru
    } else {
        // jika tidak upload gambar baru
        $gambar_fix = $gambar_lama; 
    }

    // update ke database
    $update = $connect->query("UPDATE produk SET 
        nama_obat   = '$nama_obat',
        harga       = '$harga',
        stok        = '$stok',
        deskripsi   = '$deskripsi',
        gambar      = '$gambar_fix'
        WHERE id_obat = '$id_obat'
    ");

    if ($update) {
        echo "<script>
                alert('Produk berhasil diperbarui!');
                window.location.href='produk.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal memperbarui produk!');
                window.location.href='produk.php';
              </script>";
    }
}
?>
