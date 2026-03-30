<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Dinas Nemo</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
</head>

<body id="bg-login">
   <div class="login-wrapper">
        <!-- BOX KIRI -->
        <div class="login-info">
            <h1>Selamat Datang<br>Sistem Admin Pelaporan</h1>
            <p>     
                Sistem admin manajemen pelaporan aspirasi siswa SMK Negeri 5 Telkom Banda Aceh, memudahkan petugas dalam mengelola dan menanggapi laporan siswa dengan efisien.
            </p>
        </div>

        <!-- BOX KANAN -->
        <div class="login-box">
            <h2>Login Sistem Admin Pelaporan</h2>

            <form action="" method="post">
                <input type="text" name="user" placeholder="Username" class="input-class">

                <div class="password-box">
                    <input type="password" id="password" name="pass" placeholder="Password" class="input-class">
                </div>

                <input type="submit" name="submit" value="Login" class="btn-login">
            </form>

            <div class="footer-login">
                &copy; 2026 Dinas Nemo. All rights reserved.
            </div>
        </div>

        <?php
        if (isset($_POST['submit'])) {
            session_start();
            include 'db.php'; 

            $user = mysqli_real_escape_string($CON, $_POST['user']);
            $pass = mysqli_real_escape_string($CON, $_POST['pass']);

            $cek = mysqli_query($CON, "SELECT * FROM admin WHERE username = '" . $user . "' AND password = '" . MD5($pass) . "'");
            if (mysqli_num_rows($cek) > 0) {
                $d = mysqli_fetch_object($cek);
                $_SESSION['status_login'] = true;
                $_SESSION['username'] = $d->username;
                $_SESSION['a_global'] = $d;
                $_SESSION['id'] = $d->id_admin;
                echo '<script>window.location="dashboard.php"</script>';
            } else {
                echo '<script>alert("Username atau Password Anda Salah!")</script>';
            }
        }
        ?>
    </div>
</body>

</html>