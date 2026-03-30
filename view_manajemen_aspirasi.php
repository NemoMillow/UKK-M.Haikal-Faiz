<?php
include 'db.php';
session_start();

if ($_SESSION['status_login'] != true) {
    echo '<script>alert("Silakan login terlebih dahulu!"); window.location="login.php";</script>';
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo '<script>alert("ID surat tidak ditemukan."); window.location="manajemen_aspirasi.php";</script>';
    exit;
}
$id = mysqli_real_escape_string($CON, $_GET['id']);

// ambil data disposisi beserta data surat masuk dan nama petugas berdasarkan kd_disposisi
$q = mysqli_query($CON, "
    SELECT 
        ia.nis, 
        ia.lokasi, 
        ia.ket, 
        k.ket_kategori, 
        a.status, 
        a.feedback,
        s.nis,
        s.kelas
    FROM input_aspirasi ia
    LEFT JOIN kategori k ON ia.id_kategori = k.id_kategori
    LEFT JOIN aspirasi a ON ia.id_pelaporan = a.id_pelaporan
    LEFT JOIN siswa s ON ia.nis = s.nis
    WHERE ia.id_pelaporan = '$id'
    LIMIT 1
");

if(!$q || mysqli_num_rows($q) == 0){
    echo '<script>alert("Data aspirasi tidak ditemukan."); window.location="data_aspirasi.php";</script>';
    exit;
}
$data = mysqli_fetch_object($q);
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

<div class="section">
        <div class="container">
            <h3>Detail Surat Disposisi</h3>
            <div class="box">
                <table class="detail-table">
                    <tr>
                        <th>NIS Siswa</th>
                        <td><?php echo htmlspecialchars($data->nis) ?></td>
                    </tr>
                    <tr>
                        <th>Kelas Siswa</th>
                        <td><?php echo htmlspecialchars($data->kelas) ?></td>
                    </tr>
                    <tr>
                        <th>Kategori Pelaporan</th>
                        <td><?php echo htmlspecialchars($data->ket_kategori) ?></td>
                    </tr>
                    <tr>
                        <th>Lokasi Terlapor</th>
                        <td><?php echo htmlspecialchars($data->lokasi) ?></td>
                    </tr>
                    <tr>
                        <th>Keterangan Laporan</th>
                        <td><?php echo html_entity_decode($data->ket) ?></td>
                    </tr>
                    <tr>
                        <th>Feedback Dari Petugas</th>
                        <td><?php echo htmlspecialchars($data->feedback) ?></td>
                    </tr>
                    <tr>
                        <th>Status Penyelesaian Aspirasi</th>
                        <td><?php echo html_entity_decode($data->status); ?></td>
                    </tr>
                </table>
                <div class="detail-actions">
                    <a class="btn" href="manajemen_aspirasi.php">Kembali</a>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <small>Copyright &copy; 2026 - Dinas Nemo</small>
        </div>
    </footer>
</body>

</html>