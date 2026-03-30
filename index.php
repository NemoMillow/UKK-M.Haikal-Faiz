<?php
include 'db.php';

// hitung total aspirasi sudah dijawab
$q_Sjawab = mysqli_query($CON, "SELECT COUNT(*) AS total FROM aspirasi");
$data_Sjawab = mysqli_fetch_assoc($q_Sjawab);

// hitung total aspirasi belum dijawab
$q_Bjawab = mysqli_query($CON, "
SELECT COUNT(*) AS total
FROM input_aspirasi i
LEFT JOIN aspirasi a ON i.id_pelaporan = a.id_pelaporan
WHERE a.id_pelaporan IS NULL
");
$data_Bjawab = mysqli_fetch_assoc($q_Bjawab);

// hitung data total siswa
$q_Tsiswa = mysqli_query($CON, "SELECT COUNT(*) AS total FROM siswa");
$data_siswa = mysqli_fetch_assoc($q_Tsiswa);

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
            <button class="btn-log"><a href="login.php">LOGIN PETUGAS</a></button>
        </div>
    </div>
    <div class="menu">
        <a href="index.php">Dashboard</a>
        <a href="data_aspirasi.php">Data Aspirasi</a>
    </div>

            <div class="container">
            <div class="dashboard-card">
                <h2>Selamat Datang di Sistem Pengaduan Aspirasi SMK Negeri 5 Telkom Banda Aceh</h2>
                <p>Sistem ini dirancang untuk memfasilitasi siswa dalam menyampaikan aspirasi, keluhan, atau masukan terkait lingkungan sekolah. Dengan menggunakan sistem ini, siswa dapat dengan mudah mengajukan laporan dan mendapatkan tanggapan dari pihak sekolah.</p>
                <br>
                <a class="btnaspirasi" href="tambah_aspirasi.php">Ajukan Aspirasi Anda</a>
            </div>
    <div class="container">
        </div>
        <div class="dashboard-card">
            <div class="card-container">
                <div class="card">
                    <div class="card-left">
                        <div class="card-header">
                            <img class="card-icon" src="asset/megaphone.png" alt="ikon ajukan" />
                            <h3>Ajukan Aspirasi</h3>
                        </div>
                        <p>Klik “Ajukan Aspirasi Anda” untuk menyampaikan aspirasi, keluhan, atau masukan terkait lingkungan sekolah.</p>
                        <div class="checklist-wrapper">
                            <img class="aspirasi-photo" src="asset/orang-aspirasi.png" alt="ilustrasi aspirasi" />
                            <ul class="checklist">
                                <li><img src="asset/centang.png" alt="cek" /> Klik tombol “Ajukan Aspirasi Anda”</li>
                                <li><img src="asset/centang.png" alt="cek" /> Isi formulir dan jelaskan aspirasi Anda</li>
                                <li><img src="asset/centang.png" alt="cek" /> Kirim laporan Anda untuk diproses</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-left">
                        <div class="card-header">
                            <img class="card-icon" src="asset/komentar.png" alt="ikon pantau" />
                            <h3>Pantau Status</h3>
                        </div>
                        <p>Anda dapat memantau status aspirasi yang telah diajukan melalui halaman Data Aspirasi.</p>
                        <div class="checklist-wrapper-right">
                            <ul class="checklist">
                                <li><img src="asset/surat.png" alt="cek" /> Lihat daftar aspirasi yang diajukan</li>
                                <li><img src="asset/circle.png" alt="cek" /> Cek status terbaru dari laporan Anda</li>
                                <li><img src="asset/ceklis.png" alt="cek" /> Baca tanggapan dari pihak sekolah</li>
                            </ul>
                            <img class="pantau-photo" src="asset/orang-pantauan.png" alt="ilustrasi pantau" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2026 - Dinas Nemo.</small>
        </div>
</body>

</html>