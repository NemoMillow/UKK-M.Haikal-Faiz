<?php
include 'db.php';
session_start();

if ($_SESSION['status_login'] != true) {
    echo '<script>alert("Silakan login terlebih dahulu!"); window.location="login.php";</script>';
}

$siswa = mysqli_query($CON, "SELECT * FROM siswa WHERE nis = '" . $_GET['id'] . "' ");
if (mysqli_num_rows($siswa) == 0) {
    echo '<script>window.location="manajemen_siswa.php"</script>';
}
$k = mysqli_fetch_object($siswa);

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
            <h3>Edit Data Surat Masuk</h3>
            <div class="box">
                <form action="" method="post">
                    <h4>NIS</h4>
                    <input type="text" name="nis" class="input-control" value="<?php echo $k->nis ?>" readonly>
                    <h4>KELAS</h4>
                    <input type="text" name="kelas" class="input-control" value="<?php echo $k->kelas ?>" required>
                    <input type="submit" name="submit" value="Edit Data Surat" class="btn">
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    $kelas = $_POST['kelas'];

                    $update = mysqli_query($CON, "UPDATE siswa SET 
                            kelas = '" . $kelas . "'
                            WHERE nis = '" . $k->nis . "' ");
                    if ($update) {
                        echo '<script>alert("Edit data berhasil")</script>';
                        echo '<script>window.location="manajemen_siswa.php"</script>';
                    } else {
                        echo 'gagal ' . mysqli_error($CON);
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