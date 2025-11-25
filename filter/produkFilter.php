<?php
    include('../connection.php');

    $minPrice = $_GET['min'] ?? '';
    $maxPrice = $_GET['max'] ?? '';
    $filter = $_GET['filter'] ?? '';
    $search = $_GET['search'] ?? '';
    $order = "";

    // BASE QUERY
    $sql = "SELECT * FROM obat WHERE 1";

    // FILTER HARGA
    if ($minPrice !== '') {
        $sql .= " AND harga >= " . intval($minPrice);
    }
    if ($maxPrice !== '') {
        $sql .= " AND harga <= " . intval($maxPrice);
    }

    // SEARCH
    if ($search != "") {
        $sql .= " AND nama_obat LIKE '%$search%'";
    }

    // FILTER HARGA TERMURAH
    if ($filter === "murah") {
        $order = " ORDER BY harga ASC";
    }

    // FILTER HARGA TERMAHAL
    if ($filter === "mahal") {
        $order = " ORDER BY harga DESC";
    }

    // FILTER ABJAD
    if ($filter === "az") {
        $order = " ORDER BY nama_obat ASC";
    }
    if ($filter === "za") {
        $order = " ORDER BY nama_obat DESC";
    }
    $sql .= $order;

    $query = mysqli_query($connect, $sql);

    if (mysqli_num_rows($query) == 0) {
        echo "<p class='text-center mt-5'>Tidak ada produk ditemukan</p>";
        exit;
    }

    //OUTPUT
    while ($data = mysqli_fetch_array($query)) { ?>

    <div class="col-md-4 col-lg-3 p-0">
        <a href="produk.php?id=<?=$data['id_obat']?>">
            <div class="produk m-3 p-0 border rounded shadow-sm" style="height: 350px;">
                <div class="gambar-produk border-bottom" style="height: 70%;">
                    <img src="../images/<?=$data['gambar']?>" alt="foto produk" 
                        style="width:100%;height:100%;object-fit:cover;">
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
