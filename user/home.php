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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
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

    <?php include ('userHeader.php'); ?>
    
    <div class="row g-0">
        <div class="col-lg-2 sidebar mt-3" style="height: 100%">
            <div class="m-3 p-1 rounded" style="background-color: #ffffffff">
                <h5 class="mb-3"><i class="bi bi-funnel"></i> Filter</h5>
                <div class="d-grid gap-2 mb-3">
                    <button id="filterMurah" class="btn btn-outline-success filter-btn">Harga Termurah</button>
                    <button id="filterMahal" class="btn btn-outline-success filter-btn">Harga Termahal</button>
                    <button id="asc" class="btn btn-outline-success filter-btn">Nama A-Z</button>
                    <button id="desc" class="btn btn-outline-success filter-btn">Nama Z-A</button>
                </div><hr>

                <h5 class="mt-3">Filter Harga</h5>
                <div class="row g-2 mb-2">
                    <div class="col-6">
                        <input type="number" id="minPrice" class="form-control" placeholder="Min">
                    </div>
                    <div class="col-6">
                        <input type="number" id="maxPrice" class="form-control" placeholder="Max">
                    </div>
                </div>
                <button class="btn btn-primary w-100" onclick="filterHarga()">Terapkan</button>
            </div>
        </div>

        <div class="col-lg-10 etalase">
            <!-- SEARCH BAR -->
            <div class="row m-3">
                <div class="col-lg-2">
                    <button class="btn btn-success w-100 fw-bold" onclick="searchProduk()"><i class="bi bi-search"></i> Cari</button>
                </div>
                <div class="col-lg-10">
                    <input type="text" id="searchInput" class="form-control"
                        placeholder="Cari nama obat...">
                </div>
            </div>

            <div class="row m-3 g-0" id="productList">
                <?php
                    include ('../connection.php');
                    $sql = "SELECT * FROM obat";
                    $query = mysqli_query($connect, $sql);
                    while($data = mysqli_fetch_array($query)){
                ?>
                    
                <div class="col-md-4 col-lg-3 p-0">
                    <a href="produk.php?id=<?=$data['id_obat']?>">
                        <div class="produk m-3 p-0 border rounded shadow-sm" style="height: 350px;">
                            <div class="gambar-produk border-bottom" style="height: 70%";>
                                <img src="../images/<?=$data['gambar']?>" alt="foto produk">
                            </div>
                            <div class="d-flex flex-column justify-content-between p-2" style="height: 30%;">
                                <h5 class="text-truncate"><?=$data['nama_obat']?></h5>
                                <p class="m-0 text-secondary">Stok: <?=$data['stok']?></p>
                                <h5 class="m-0 text-success">Rp. <?=number_format($data['harga'], 0, ',', '.')?></h5>
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

    <script src="../filter/search.js"></script>
    <script>
        const buttons = document.querySelectorAll('.filter-btn');
        buttons.forEach(btn => {
            btn.addEventListener('click', function () {
                buttons.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });

        function loadProducts(filter = "") {
            fetch("../filter/produkFilter.php?filter=" + filter)
                .then(response => response.text())
                .then(html => {
                    document.getElementById("productList").innerHTML = html;
                });
        }

        function filterHarga() {
            let min = document.getElementById("minPrice").value;
            let max = document.getElementById("maxPrice").value;

            fetch("../filter/produkFilter.php?min=" + min + "&max=" + max)
                .then(response => response.text())
                .then(html => {
                    document.getElementById("productList").innerHTML = html;
                });
        }

        document.getElementById("filterMurah").addEventListener("click", function() {loadProducts("murah");});
        document.getElementById("filterMahal").addEventListener("click", function() {loadProducts("mahal");});
        document.getElementById("asc").addEventListener("click", function() {loadProducts("az");});
        document.getElementById("desc").addEventListener("click", function() {loadProducts("za");});
    </script>

</body>

</html>