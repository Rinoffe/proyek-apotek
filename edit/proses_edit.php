<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if ($connect->connect_error) {
            $message = "Koneksi database gagal: " . $connect->connect_error;
        } else {
            $newUsername = $_POST['username'];
            $password = $_POST['password']; 
            $nama = $_POST['nama'];
            $canUpdate = true;
            
            if ($newUsername !== $username) {
                $stmt_check = $connect->prepare("SELECT username FROM users WHERE username = ?");
                $stmt_check->bind_param("s", $newUsername);
                $stmt_check->execute();
                $stmt_check->store_result();
            
                if ($stmt_check->num_rows > 0) {
                    $message = "<span class='text-danger'>Error: Username <b>" . htmlspecialchars($newUsername) . "</b> sudah terdaftar. Silakan gunakan username lain.</span>";
                    $canUpdate = false;
                } 
                $stmt_check->close();
            }

            if ($canUpdate) {
                $stmt_insert = $connect->prepare("UPDATE users SET username=?, nama=?, password=? WHERE username=?");
                $stmt_insert->bind_param("ssss", $newUsername, $nama, $password, $username);
                
                if ($stmt_insert->execute()) {
                    $message = "<span class='text-success'>Edit data berhasil!</span>";

                    $_SESSION['username'] = $newUsername;
                    $username = $newUsername;
        
                } else {
                    $message = "<span class='text-danger'>Error saat menyimpan data: " . $stmt_insert->error . "</span>";
                }
                $stmt_insert->close();
            }
        }
    }
?>