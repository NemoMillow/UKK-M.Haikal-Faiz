<?php
    include 'db.php';
session_start();

if ($_SESSION['status_login'] != true) {
    echo '<script>alert("Silakan login terlebih dahulu!"); window.location="login.php";</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Aspirasi | SNKN 5 Telkom BNA</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
</head>

<body>

    <header>
        <div class="navbar">
            <div class="logo">SMK Negeri 5 Telkom Banda Aceh</div>
            <div class="user">
                <button class="btn-log"><a href="index.php">LOGOUT</a></button>
            </div>
        </div>
        <div class="menu">
            <a href="dashboard.php">Dashboard</a>
            <a href="manajemen_aspirasi.php">Manajemen Aspirasi</a>
            <a href="manajemen_siswa.php">Manajemen Siswa</a>
            <a href="manajemen_kategori.php">Manajemen Kategori</a>
        </div>
    </header>
    <!-- Content -->
    <div class="section">
        <div class="container">
            <h3>Tambah Surat Masuk</h3>
            <div class="box">
                <form action="" method="post">
                    <h4>NIS</h4>
                    <input type="text" name="nis" class="input-control" required>
                    <h4>KELAS</h4>
                    <input type="text" name="kelas" class="input-control" required>
                    <input type="submit" name="submit" value="Tambah Data Siswa" class="btn">
                </form>
                <?php 
                    if(isset($_POST['submit'])){
                        $nis = mysqli_real_escape_string($CON, $_POST['nis']);
                        $kelas = mysqli_real_escape_string($CON, $_POST['kelas']);

                        $sql = "INSERT INTO siswa (nis, kelas) VALUES (
                            '".$nis."',
                            '".$kelas."')";

                        try {
                            $insert = mysqli_query($CON, $sql);
                            if($insert){
                                echo '<script>alert("Tambah data berhasil")</script>';
                                echo '<script>window.location="manajemen_siswa.php"</script>';
                            } else {
                                // kalau ada error lempar ini ya ommm
                                echo 'gagal '.mysqli_error($CON);
                            }
                        } catch (mysqli_sql_exception $e) {
                            // btw kalau ada duplicate entry lempar ini ya ommm
                            if($e->getCode() == 1062){
                                echo '<script>alert("Gagal: TERDAPAT KODE SURAT MASUK YANG SAMA, HARAP PERIKSA DAN UBAH KODE SURAT MASUK")</script>';
                            } else {
                                echo 'gagal '.htmlspecialchars($e->getMessage());
                            }
                            error_log('[tamabh_siswa] SQL error: ' . $e->getMessage());
                        }
                    }
                ?>
            </div>
                <br>
        </div>

        <!-- Footer -->
        <footer>
            <div class="container">
                <small>Copyright &copy; 2026 - Dinas Nemo.</small>
            </div>
        </footer>
    </div>
</body>
</html>