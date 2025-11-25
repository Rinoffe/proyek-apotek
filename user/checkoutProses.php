<?php
    include ('../connection.php');
    session_start();

    $lokasi = $_POST['lokasi'];
    $metode_pembayaran = $_POST['metode_pembayaran'];

    // TABEL TRANSAKSI
    $transaksi = "INSERT INTO transaksi (tanggal, username, lokasi, metode_pembayaran) 
        VALUES (NOW(),'$_SESSION[username]', '$lokasi', '$metode_pembayaran')";
    mysqli_query($connect, $transaksi);

    $id_transaksi = mysqli_insert_id($connect);

    // TABEL DETAIL TRANSAKSI
    $detail = "SELECT c.qty, o.harga, c.id_obat
        FROM cart c JOIN obat o ON c.id_obat = o.id_obat
        WHERE c.username = '$_SESSION[username]'";
    $query = mysqli_query($connect, $detail);

    while($data = mysqli_fetch_array($query)){
        $insertDetail = "INSERT INTO transaksi_detail (id_transaksi, username, id_obat, qty) 
            VALUES ($id_transaksi, '$_SESSION[username]', '$data[id_obat]', '$data[qty]')";
        mysqli_query($connect, $insertDetail);

        // UPDATE STOK OBAT
        $updateStok = "UPDATE obat SET stok = stok - {$data['qty']} 
            WHERE id_obat = '{$data['id_obat']}'";
        mysqli_query($connect, $updateStok);
    }

    // CLEAR CART
    $clearCart = "DELETE FROM cart WHERE username = '$_SESSION[username]'";
    mysqli_query($connect, $clearCart);

    header("location: home.php");
?>