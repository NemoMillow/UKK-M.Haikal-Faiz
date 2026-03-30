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
        <div class="container-tabel">
            <h3>Data Surat Masuk</h3>
            <a class="btn-tambah" href="tambah_siswa.php">Tambah Siswa Baru</a>
                <table class="table">
                <thead>
                    <tr>
                        <th width="60px">No</th>
                        <th width="350px">NIS</th>
                        <th>Kelas</th>
                        <th width="150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  
                        $no = 1;
                        $siswa = mysqli_query($CON, "SELECT * FROM siswa ORDER BY nis DESC");
                        if(mysqli_num_rows($siswa) > 0){
                            while($row = mysqli_fetch_array($siswa)){
                     ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $row['nis'] ?></td>
                        <td><?php echo $row['kelas'] ?></td>
                        <td class="actions">
                            <a class="btn-edit" href="edit_siswa.php?id=<?php echo $row['nis'] ?>">Edit</a>
                            <a class="btn-hapus" href="proses_hapus.php?ids=<?php echo $row['nis'] ?>" onclick="return confirm('HAPUS DATA INI?')">Hapus</a>  
                        </td>
                    </tr>
                    <?php }}else{ ?>
                        <tr>
                            <td colspan="4">Tidak ada data</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>

        <!-- Footer -->
        <footer>
            <div class="container">
                <small>Copyright &copy; 2026 - Dinas Nemo.</small>
            </div>
</body>
</html>