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
        }
        .gambar-produk img{
            width: 100%;
            height: 100%;
            object-fit: cover;
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
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">ADMIN</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Edit</a></li>
                    <li><a class="dropdown-item text-danger" href="#">Logout</a></li>
                    <li><hr class="dropdown-divider"></hr></li>
                    <li><a class="dropdown-item" href="#">History</a></li>
                    <li><a class="dropdown-item" href="#">Announcement</a></li>
                </ul>
            </div>
        </div>
    </header>

    <?php
        include ('../connection.php');
        $id = $_GET['id'];
        $sql = "SELECT * FROM obat WHERE id_obat = '$id'";
        $query = mysqli_query($connect, $sql);
        $data = mysqli_fetch_array($query);
    ?>

    <div class="m-5 row">
        <div class="col-md-5">
            <div class="m-2 gambar-produk border rounded">
                <img src="../images/<?=$data['gambar']?>" alt="foto produk">
            </div>
        </div>
        

        <div class="col-md-7">
            <div class="m-2">
                <h1 class="pb-4"><?=$data['nama_obat']?></h1>
                <div class="container rounded border py-4 mb-4">
                    <p class="m-0"><?=$data['deskripsi']?></p>
                </div>
                <h4 class="pb-4">Stok: <?=$data['stok']?></h4>

                <div class="d-flex">
                    <form action="cartProses.php" method="POST">
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                            </div>
                            <div class="col input-group">
                                <span class="input-group-text">Qty</span>
                                <input type="number" class="form-control" name="qty" min="1" max="<?=$data['stok']?>" required>
                            </div>
                            <input type="hidden" name="id_obat" value="<?=$data['id_obat']?>">
                        </div>
                    </form>
                </div>
            </div>
            

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>