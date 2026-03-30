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

    <div class="section">
        <div class="container-tabel">
            <br>
            <h3>Manajemen Data Aspirasi Sekolah</h3>

            <table class="table">
                <thead>
                    <tr>
                        <th width="60px">No</th>
                        <th width="170px">Kategori</th>
                        <th>Lokasi</th>
                        <th>Keterangan</th>
                        <th width="150px">Status</th>
                        <th width="150px">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $no = 1;

                    $query = mysqli_query($CON, "
                    SELECT 
                        i.id_pelaporan,
                        i.lokasi,
                        i.ket,
                        k.ket_kategori,
                        a.status
                    FROM input_aspirasi i
                    LEFT JOIN kategori k ON i.id_kategori = k.id_kategori
                    LEFT JOIN aspirasi a ON i.id_pelaporan = a.id_pelaporan
                    ORDER BY i.id_pelaporan DESC
                    ");

                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_array($query)) {
                    ?>

                            <tr>
                                <td><?php echo $no++ ?></td>

                                <td><?php echo $row['ket_kategori'] ?></td>

                                <td><?php echo $row['lokasi'] ?></td>

                                <td><?php echo $row['ket'] ?></td>

                                <td>
                                    <?php
                                    if ($row['status'] == 'Menunggu') {
                                        echo '<span class="badge warning">Menunggu</span>';
                                    } elseif ($row['status'] == 'Proses') {
                                        echo '<span class="badge primary">Proses</span>';
                                    } elseif ($row['status'] == 'Selesai') {
                                        echo '<span class="badge success">Selesai</span>';
                                    } else {
                                        echo '<span class="badge danger">Belum Dijawab</span>';
                                    }
                                    ?>
                                </td>

                                <td class="actions">
                                    <a class="btn-view" href="view_manajemen_aspirasi.php?id=<?php echo urlencode($row['id_pelaporan']) ?>">View</a>
                                    <a class="btn-edit" href="edit_aspirasi.php?id=<?php echo urlencode($row['id_pelaporan']) ?>">Edit</a>
                                </td>

                            </tr>

                        <?php
                        }
                    } else {
                        ?>

                        <tr>
                            <td colspan="6">Tidak ada data</td>
                        </tr>

                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>

    <footer>
        <div class="container">
            <small>Copyright &copy; 2026 - Dinas Nemo.</small>
        </div>
    </footer>

</body>

</html>