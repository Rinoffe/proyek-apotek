<?php
    include ('../connection.php');
    session_start();

    $id = $_POST['id_obat'];
    $qty = $_POST['qty'];
    $username = $_SESSION['username'];

    $sql = "SELECT * FROM cart WHERE id_obat = '$id' AND username = '$username'";
    $query = mysqli_query($connect, $sql);

    if(mysqli_num_rows($query) == 0){
        $insert = "INSERT INTO cart (username, id_obat, qty) VALUES ('$username', '$id', '$qty')";
        mysqli_query($connect, $insert);
    } else {
        $update = "UPDATE cart SET qty = '$qty' WHERE id_obat = '$id' AND username = '$username'";
        mysqli_query($connect, $update);
    }

    header("location: ../user/produk.php?id=$id&qty=$qty&success=1");
?>