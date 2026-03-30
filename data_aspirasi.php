<?php
    include 'db.php';
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
    <div class="logo">SMK Negeri 5 Telkom Banda Aceh </div>
    <div class="user">
        <button class="btn-log"><a href="login.php">LOGIN PETUGAS</a></button>
    </div>
</div>
<div class="menu">
    <a href="index.php">Dashboard</a>
    <a href="data_aspirasi.php">Data Aspirasi</a>
</div>
</header>
    <!-- Content -->
    <div class="section">
        <div class="container-tabel">
            <br>
            <h3>Data Seluruh Aspirasi Sekolah</h3>
                <table class="table">
                <thead>
                    <a class="btn-tambah" href="tambah_aspirasi.php">BERIKAN ASPIRASI</a>
                    <tr>
                        <th width="60px">No</th>
                        <th width="170px">Kategori</th>
                        <th>Lokasi</th>
                        <th>Keterangan</th>
                        <th width="150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  
                        $no = 1;
                        $kategori = mysqli_query($CON, "SELECT * FROM input_aspirasi LEFT JOIN kategori USING (id_kategori) ORDER BY id_pelaporan DESC");
                        if(mysqli_num_rows($kategori) > 0){
                            while($row = mysqli_fetch_array($kategori)){
                     ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $row['ket_kategori'] ?></td>
                        <td><?php echo $row['lokasi'] ?></td>
                        <td><?php echo $row['ket'] ?></td>
                        <td>
                            <a class="btn-view" href="detail_aspirasi.php?id=<?php echo urlencode($row['id_pelaporan']) ?>">View</a>
                        </td>
                    </tr>
                    <?php }}else{ ?>
                        <tr>
                            <td colspan="6">Tidak ada data</td>
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