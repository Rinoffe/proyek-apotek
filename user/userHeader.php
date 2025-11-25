<header class="d-flex flex-wrap justify-content-between align-items-center p-3 px-5"
    style= "background-color: #1c794a;
            position: sticky;
            top: 0;
            z-index: 100;"
>
    <a href="home.php" class="d-flex align-items-center text-decoration-none">
        <img src="../asset/logo.png" alt="logo apotek" height="80" class="me-2">
        <h2 class="text-white mb-0 fw-bold">Apotek K25</h2>
    </a>
    <div class="d-flex flex-wrap justify-content-end">
        <a href="cart.php" class="btn btn-light me-4"><i class="bi bi-cart4"></i> Cart</a>
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-person-circle"></i> <?=$username?>'s</button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="editUser.php?id=<?=$username?>">Edit</a></li>
                <li><a class="dropdown-item text-danger" href="../logout.php">Logout</a></li>
                <li><hr class="dropdown-divider"></hr></li>
                <li><a class="dropdown-item" href="history.php">History</a></li>
                <li><a class="dropdown-item" href="pesanan.php">Status Pesanan</a></li>
            </ul>
        </div>
    </div>
</header>