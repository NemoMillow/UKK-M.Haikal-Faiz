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
            <h3>Manajemen Data Kategori</h3>
            <a class="btn-tambah" href="tambah_kategori.php">Tambah Kategori Baru</a>
                <table class="table">
                <thead>
                    <tr>
                        <th width="60px">No</th>
                        <th>Kategori</th>
                        <th width="150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  
                        $no = 1;
                        $kategori = mysqli_query($CON, "SELECT * FROM kategori ORDER BY id_kategori DESC");
                        if(mysqli_num_rows($kategori) > 0){
                            while($row = mysqli_fetch_array($kategori)){
                     ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $row['ket_kategori'] ?></td>
                        <td class="actions">
                            <a class="btn-edit" href="edit_kategori.php?id=<?php echo $row['id_kategori'] ?>">Edit</a>
                            <a class="btn-hapus" href="proses_hapus.php?idk=<?php echo $row['id_kategori'] ?>" onclick="return confirm('HAPUS DATA INI?')">Hapus</a>  
                        </td>
                    </tr>
                    <?php }}else{ ?>
                        <tr>
                            <td colspan="3">Tidak ada data</td>
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