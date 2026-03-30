<?php
include 'db.php';
session_start();

if ($_SESSION['status_login'] != true) {
    echo '<script>alert("Silakan login terlebih dahulu!"); window.location="login.php";</script>';
}

// untuk menjalankan query dengan filter
$where = "WHERE 1=1";

if (isset($_GET['tanggal_dari']) && $_GET['tanggal_dari'] != '') {
    $tgl1 = $_GET['tanggal_dari'];
    $where .= " AND DATE(i.created_at) >= '$tgl1'";
}

if (isset($_GET['tanggal_sampai']) && $_GET['tanggal_sampai'] != '') {
    $tgl2 = $_GET['tanggal_sampai'];
    $where .= " AND DATE(i.created_at) <= '$tgl2'";
}

if (isset($_GET['nis']) && $_GET['nis'] != '') {
    $nis = $_GET['nis'];
    $where .= " AND i.nis = '$nis'";
}

if (isset($_GET['kategori']) && $_GET['kategori'] != '') {
    $kategori = $_GET['kategori'];
    $where .= " AND i.id_kategori = '$kategori'";
}

$query = mysqli_query($CON, "
SELECT i.*, s.kelas, k.ket_kategori, a.status, a.feedback
FROM input_aspirasi i
LEFT JOIN siswa s ON i.nis = s.nis
LEFT JOIN kategori k ON i.id_kategori = k.id_kategori
LEFT JOIN aspirasi a ON i.id_pelaporan = a.id_pelaporan
$where
ORDER BY i.created_at DESC
");


$data_siswa = mysqli_query($CON, "SELECT * FROM siswa");
$data_kategori = mysqli_query($CON, "SELECT * FROM kategori");

// query untuk statistik card
$q_total = mysqli_query($CON, "SELECT COUNT(*) as total FROM input_aspirasi");
$total_aspirasi = mysqli_fetch_array($q_total)['total'];

$q_selesai = mysqli_query($CON, "SELECT COUNT(*) as total FROM aspirasi WHERE feedback IS NOT NULL AND feedback !=''");
$sudah_dijawab = mysqli_fetch_array($q_selesai)['total'];

$q_belum = mysqli_query($CON, "
SELECT COUNT(*) as total
FROM input_aspirasi i
LEFT JOIN aspirasi a ON i.id_pelaporan = a.id_pelaporan
WHERE a.id_pelaporan IS NULL OR a.feedback IS NULL OR a.feedback=''
");
$belum_dijawab = mysqli_fetch_array($q_belum)['total'];

$q_siswa = mysqli_query($CON, "SELECT COUNT(*) as total FROM siswa");
$total_siswa = mysqli_fetch_array($q_siswa)['total'];

$q_bulan = mysqli_query($CON, "
SELECT COUNT(*) as total 
FROM input_aspirasi 
WHERE MONTH(created_at)=MONTH(CURRENT_DATE())
AND YEAR(created_at)=YEAR(CURRENT_DATE())
");
$aspirasi_bulan_ini = mysqli_fetch_array($q_bulan)['total'];

// query untuk statistik per kategori
$stat_kategori = mysqli_query($CON, "
SELECT k.ket_kategori, COUNT(*) as total
FROM input_aspirasi i
JOIN kategori k ON i.id_kategori = k.id_kategori
GROUP BY k.id_kategori
");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | SNKN 5 Telkom BNA</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
</head>

<body>

    <div class="navbar">
        <div class="logo">SMK Negeri 5 Telkom Banda Aceh </div>
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

    <div class="container">
        <h2>Selamat Datang, <?php echo $_SESSION['a_global']->username ?> Pada sistem manajemen aspirasi siswa</h2>

        <div class="card-container">
            <div class="card-total">
                <h4>Total Aspirasi</h4>
                <h2><?= $total_aspirasi ?></h2>
            </div>
            <div class="card-total">
                <h4>Sudah Dijawab</h4>
                <h2><?= $sudah_dijawab ?></h2>
            </div>
            <div class="card-total">
                <h4>Belum Dijawab</h4>
                <h2><?= $belum_dijawab ?></h2>
            </div>
            <div class="card-total">
                <h4>Total Siswa Aktif</h4>
                <h2><?= $total_siswa ?></h2>
            </div>
            <div class="card-total">
                <h4>Aspirasi Bulan Ini</h4>
                <h2><?= $aspirasi_bulan_ini ?></h2>
            </div>
        </div>

        <div class="filter-box">
            <form method="GET">
                <input type="date" name="tanggal_dari">
                <input type="date" name="tanggal_sampai">

                <select name="nis">
                    <option value="">-- Pilih Siswa --</option>
                    <?php while ($s = mysqli_fetch_array($data_siswa)) { ?>
                        <option value="<?= $s['nis'] ?>"><?= $s['nis'] ?> (-) <?= $s['kelas'] ?></option>
                    <?php } ?>
                </select>

                <select name="kategori">
                    <option value="">-- Semua Kategori --</option>
                    <?php while ($k = mysqli_fetch_array($data_kategori)) { ?>
                        <option value="<?= $k['id_kategori'] ?>"><?= $k['ket_kategori'] ?></option>
                    <?php } ?>
                </select>

                <button type="submit" class="btn-primary">Tampilkan</button>
                <a href="dashboard.php" class="btn-reset">Reset</a>
            </form>
        </div>

        <div class="table-box">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>NIS</th>
                        <th>Kelas</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Feedback</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    while ($row = mysqli_fetch_array($query)) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= date('d-m-Y', strtotime($row['created_at'])) ?></td>
                            <td><?= $row['nis'] ?></td>
                            <td><?= $row['kelas'] ?></td>
                            <td><?= $row['ket_kategori'] ?></td>
                            <td><?= $row['lokasi'] ?></td>
                            <td><?= $row['ket'] ?></td>
                            <td>
                                <?php
                                if ($row['status'] == 'Proses') {
                                    echo '<span class="badge primary">Proses</span>';
                                } elseif ($row['status'] == 'Selesai') {
                                    echo '<span class="badge success">Selesai</span>';
                                } else {
                                    echo '<span class="badge danger">Menunggu</span>';
                                }
                                ?>
                            </td>
                            <td><?= $row['feedback'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="stat-box">
            <h3>Statistik Per Kategori</h3>
            <?php while ($sk = mysqli_fetch_array($stat_kategori)) { ?>
                <div class="progress-item">
                    <label><?= $sk['ket_kategori'] ?> (<?= $sk['total'] ?>)</label>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width:<?= $sk['total'] * 10 ?>%"></div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>

    <footer class="container">
        Copyright &copy; 2026 - Dinas Nemo
    </footer>

</body>

</html>