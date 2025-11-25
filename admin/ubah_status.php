<?php
    include ('../connection.php');

    $id  = $_GET['id'];
    $aksi = $_GET['aksi'];

    if ($aksi == "kirim") {
        // Ubah status menjadi dikirim
        $query = "UPDATE transaksi SET status = 'Dikirim' WHERE id_transaksi = '$id'";
        mysqli_query($connect, $query);

        header("Location: pesanan.php");
    }

    if ($aksi == "selesai") {
        $ambil = "SELECT td.id_obat, o.nama_obat, td.qty, t.tanggal, t.lokasi, t.metode_pembayaran, t.username
                FROM transaksi t
                JOIN transaksi_detail td ON t.id_transaksi = td.id_transaksi
                JOIN obat o ON td.id_obat = o.id_obat
                WHERE t.id_transaksi = '$id'";
        $queryAmbil = mysqli_query($connect, $ambil);

        while ($data = mysqli_fetch_assoc($queryAmbil)){
            //INSERT KE HISTORY
            $insert = "INSERT INTO history (username, id_obat, nama_obat, qty, tanggal, lokasi, metode_pembayaran)
                    VALUES ('{$data['username']}',
                            '{$data['id_obat']}',
                            '{$data['nama_obat']}',
                            '{$data['qty']}',
                            NOW(),
                            '{$data['lokasi']}',
                            '{$data['metode_pembayaran']}')";
            mysqli_query($connect, $insert);
        }        

        // Hapus dari transaksi & transaksi_detail
        mysqli_query($connect, "DELETE FROM transaksi WHERE id_transaksi = '$id'");
        mysqli_query($connect, "DELETE FROM transaksi_detail WHERE id_transaksi = '$id'");

        header("Location: pesanan.php");
    }
?>
