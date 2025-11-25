<header class="d-flex flex-wrap justify-content-between align-items-center p-3 px-5">
    <a href="produk.php" class="d-flex align-items-center text-decoration-none">
        <img src="../asset/logo.png" alt="logo.png" height="80" class="me-2">
        <h2 class="text-white mb-0">Apotek K25</h2>
    </a>
    <div class="d-flex flex-wrap justify-content-end align-items-center">
        <ul class="nav justify-content-end px-3">
            <li class="nav-item">
                <a class="nav-link active text-white fw-bold" href="produk.php">Produk</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white fw-bold" href="pesanan.php">Pesanan Masuk</a>
            </li> 
        </ul>
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"><?=$username?>'s</button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../editUser.php?id=<?=$username?>">Edit</a></li>
                <li><a class="dropdown-item text-danger" href="../logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</header>