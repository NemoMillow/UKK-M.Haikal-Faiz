<?php
include 'db.php';
session_start();

if ($_SESSION['status_login'] != true) {
    echo '<script>alert("Silakan login terlebih dahulu!"); window.location="login.php";</script>';
}

if (!isset($_GET['id'])) {
    echo '<script>window.location="data_aspirasi.php"</script>';
}

$id = mysqli_real_escape_string($CON, $_GET['id']);

$query = mysqli_query($CON, "
    SELECT 
        i.*, 
        s.kelas,
        k.ket_kategori,
        a.status,
        a.feedback
    FROM input_aspirasi i
    LEFT JOIN siswa s ON i.nis = s.nis
    LEFT JOIN kategori k ON i.id_kategori = k.id_kategori
    LEFT JOIN aspirasi a ON i.id_pelaporan = a.id_pelaporan
    WHERE i.id_pelaporan = '$id'
");

if (mysqli_num_rows($query) == 0) {
    echo '<script>window.location="manajemen_aspirasi.php"</script>';
}

$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html>

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
            <h3>Detail & Update Status Aspirasi</h3>

            <div class="box">
                <form method="post">

                    <h4>NIS</h4>
                    <input type="text" class="input-control"
                        value="<?php echo $data['nis'] . ' - ' . $data['kelas']; ?>" readonly>

                    <h4>Kategori</h4>
                    <input type="text" class="input-control"
                        value="<?php echo $data['ket_kategori']; ?>" readonly>

                    <h4>Lokasi</h4>
                    <input type="text" class="input-control"
                        value="<?php echo $data['lokasi']; ?>" readonly>

                    <h4>Keterangan</h4>
                    <textarea class="input-control" rows="3" readonly><?php echo $data['ket']; ?></textarea>

                    <hr>

                    <h4>Status</h4>
                    <select name="status" class="input-control" required>
                        <option value="Menunggu" <?php if ($data['status'] == "Menunggu") echo "selected"; ?>>Menunggu</option>
                        <option value="Diproses" <?php if ($data['status'] == "Diproses") echo "selected"; ?>>Diproses</option>
                        <option value="Selesai" <?php if ($data['status'] == "Selesai") echo "selected"; ?>>Selesai</option>
                    </select>

                    <h4>Feedback</h4>
                    <textarea name="feedback" class="input-control" rows="4"><?php echo $data['feedback']; ?></textarea>

                    <br>
                    <input type="submit" name="submit" value="Update Status" class="btn">

                </form>

                <?php
                if (isset($_POST['submit'])) {

                    $status = mysqli_real_escape_string($CON, $_POST['status']);
                    $feedback = mysqli_real_escape_string($CON, $_POST['feedback']);

                    /* Cek apakah sudah ada di tabel aspirasi */
                    $cek = mysqli_query($CON, "SELECT * FROM aspirasi WHERE id_pelaporan = '$id'");

                    if (mysqli_num_rows($cek) > 0) {

                        mysqli_query($CON, "
            UPDATE aspirasi SET
                status = '$status',
                feedback = '$feedback'
            WHERE id_pelaporan = '$id'
        ");
                    } else {

                        mysqli_query($CON, "
            INSERT INTO aspirasi (id_pelaporan, status, feedback)
            VALUES ('$id', '$status', '$feedback')
        ");
                    }

                    echo '<script>alert("Status berhasil diperbarui")</script>';
                    echo '<script>window.location="manajemen_aspirasi.php"</script>';
                }
                ?>

            </div>
        </div>
    </div>

</body>

</html>