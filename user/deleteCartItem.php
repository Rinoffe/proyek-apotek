<?php
    include ('../connection.php');
    session_start();

    $id = $_GET['id'];
    $username = $_SESSION['username'];

    $sql = "SELECT * FROM cart WHERE id_obat = '$id' AND username = '$username'";
    $query = mysqli_query($connect, $sql);

    if(mysqli_num_rows($query)){
        $delete = "DELETE FROM cart WHERE id_obat = '$id' AND username = '$username'";
        mysqli_query($connect, $delete);
    }
    header("location: ../user/cart.php");
?>