<div class="container mt-4" style="width: 600px;">
    <h3 class="m-0 text-center">Edit Akun</h3><br>

    <?php
        include ('../connection.php');
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $query = mysqli_query($connect, $sql);
        $data = mysqli_fetch_array($query);

        if ($_SESSION['role'] == 'admin'){
            $kembali = "../admin/produk.php";
        } else {
            $kembali = "../user/home.php";
        }
        
        if (!empty($message)){
            $alert_class = (strpos($message, 'Error') !== false || strpos($message, 'gagal') !== false) ? 'alert-danger' : 'alert-success';
            echo "<div class='alert $alert_class text-center' role='alert'>$message</div>";
        }
    ?>

    <div class="p-4 border rounded shadow">
        <form action="editUser.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label fw-bold">Username</label>
                <input type="text" class="form-control bg-light" name="username" value="<?=$data['username']?>" readonly>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label fw-bold">Nama</label>
                <input type="text" class="form-control" name="nama" value="<?=$data['nama']?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label fw-bold">Password</label>
                <input type="password" class="form-control" name="password" value="<?=$data['password']?>" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="<?= $kembali ?>" class="btn btn-success">Kembali</a>
            </div>
        </form>
    </div>
</div>