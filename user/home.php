<?php
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== TRUE) {
        header("Location: ../login.php");
        exit;
    }
    $username = $_SESSION['username'];
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        header{
            background-color: #1c794a;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .sidebar {
            position: sticky;
            top: 128px;
        }
        .gambar-produk img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        a {
            text-decoration: none;
            color: black;
        }        
    </style>
</head>

<body style="background-color: #ffffff;">

    <header class="d-flex flex-wrap justify-content-between align-items-center p-3 px-5">
        <a href="home.php" class="d-flex align-items-center text-decoration-none">
            <img src="../asset/logo.png" alt="logo apotek" height="80" class="me-2">
            <h2 class="text-white mb-0">Apotek K25</h2>
        </a>
        <div class="d-flex flex-wrap justify-content-end">
            <a href="cart.php" class="btn btn-light me-4">Cart</a>
            <div class="dropdown">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"><?=$username?>'s</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Edit</a></li>
                    <li><a class="dropdown-item text-danger" href="../logout.php">Logout</a></li>
                    <li><hr class="dropdown-divider"></hr></li>
                    <li><a class="dropdown-item" href="#">History</a></li>
                    <li><a class="dropdown-item" href="#">Status Pesanan</a></li>
                </ul>
            </div>
        </div>
    </header>
    
    <div class="row g-0">
        <div class="col-lg-2 sidebar mt-3" style="height: 100%">
            <div class="m-3 p-1" style="background-color: #a7a7a7ff">
                assafasf
            </div>
        </div>

        <div class="col-lg-10 etalase">
            <div class="row m-3 g-0">
                <?php
                    include ('../connection.php');
                    $sql = "SELECT * FROM obat";
                    $query = mysqli_query($connect, $sql);
                    while($data = mysqli_fetch_array($query)){
                ?>
                    
                <div class="col-md-4 col-lg-3 p-0">
                    <a href="produk.php?id=<?=$data['id_obat']?>">
                        <div class="produk m-3 p-0 border rounded shadow" style="height: 350px;">
                            <div class="gambar-produk border-bottom" style="height: 70%";>
                                <img src="../images/<?=$data['gambar']?>" alt="foto produk">
                            </div>
                            <div class="d-flex flex-column justify-content-between p-2" style="height: 30%;">
                                <h5 class="text-truncate"><?=$data['nama_obat']?></h5>
                                <p class="m-0 text-secondary">Stok: <?=$data['stok']?></p>
                                <h5 class="m-0">Rp. <?=number_format($data['harga'], 0, ',', '.')?></h5>
                            </div>
                        </div>
                    </a>
                </div>
                    
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>