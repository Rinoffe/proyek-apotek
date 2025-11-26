<?php
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== TRUE) {
        header("Location: ../login.php");
        exit;
    }

    include "../connection.php";

    // Cek filter dari AJAX
    $filter = isset($_GET['filter']) ? $_GET['filter'] : "";

    // Tentukan query berdasarkan filter
    if ($filter == "az") {
        $sql = "SELECT * FROM obat ORDER BY nama_obat ASC";
    } elseif ($filter == "latest") {
        $sql = "SELECT * FROM obat ORDER BY id_obat DESC";
    } elseif ($filter == "za") {
        $sql = "SELECT * FROM obat ORDER BY nama_obat DESC";
    } else if ($filter == "minStok") {
        $sql = "SELECT * FROM obat ORDER BY stok ASC";
    } else {
        $sql = "SELECT * FROM obat";
    }

    $query = mysqli_query($connect, $sql);

    // OUTPUT
    while ($row = mysqli_fetch_assoc($query)) { ?>
    
        <tr>
            <td><?= $row['id_obat']; ?></td>
            <td><?= $row['nama_obat']; ?></td>
            <td><?= $row['stok']; ?></td>

            <td>
                <form action="produk.php" method="POST" class="d-flex align-items-center gap-2">
                    <input type="number" class="form-control form-control-sm" name="tambah_stok" min="1" style="width: 70px;">
                    <input type="hidden" name="id" value="<?= $row['id_obat']; ?>">
                    <button class="btn btn-warning btn-sm">Tambah</button>
                </form>
            </td>

            <td>
                <a href="edit_produk.php?id=<?= $row['id_obat']; ?>" class="btn btn-primary btn-sm">Edit</a>

                <a href="hapus_produk.php?id=<?= $row['id_obat']; ?>"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Yakin hapus produk ini?');">
                    Hapus
                </a>
            </td>
        </tr>
<?php } ?>