<?php
    include 'db.php';
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
    <div class="section">
        <div class="container">
            <h3>Berikan Aspirasi Kepada Sekolah</h3>
            <div class="box">
                <form action="" method="post" onsubmit="return confirm('Data tidak akan bisa di edit dan di hapus. Yakin akan tambah data?');">
                    <h4>NISN</h4>
                    <select class="input-control" name="nisn" required>
                        <option value="">--PILIH--</option>
                        <?php 
                            $nisn = mysqli_query($CON, "SELECT * FROM siswa ORDER BY nis DESC");
                            while($Nsiswa = mysqli_fetch_array($nisn)){
                        ?>
                        <option value="<?php echo $Nsiswa['nis'] ?>"><?php echo $Nsiswa['nis'],' (-) ',$Nsiswa['kelas'] ?></option>

                        <?php } ?>
                    </select>

                    <h4>Kategori Aspirasi</h4>
                    <select class="input-control" name="kategori" required>
                        <option value="">--PILIH--</option>
                        <?php 
                            $kategori = mysqli_query($CON, "SELECT * FROM kategori ORDER BY id_kategori DESC");
                            while($k = mysqli_fetch_array($kategori)){
                        ?>
                        <option value="<?php echo $k['id_kategori'] ?>"><?php echo $k['ket_kategori'] ?></option>

                        <?php } ?>
                    </select>

                    <h4>Lokasi</h4>
                    <input type="text" name="lokasi" class="input-control" required>

                    <h4>Keterangan</h4>
                    <input type="text" name="keterangan" class="input-control" required>
                    <input type="submit" name="submit" value="Kirimkan Aspirasi" class="btn">
                </form>
                <?php 
                    if(isset($_POST['submit'])){
                        $nisn = mysqli_real_escape_string($CON, $_POST['nisn']);
                        $kategori = mysqli_real_escape_string($CON, $_POST['kategori']);
                        $lokasi = mysqli_real_escape_string($CON, $_POST['lokasi']);
                        $keterangan = mysqli_real_escape_string($CON, $_POST['keterangan']);
                    
                        $sql = "INSERT INTO input_aspirasi (nis, id_kategori, lokasi, ket) VALUES (
                            '".$nisn."',
                            '".$kategori."',
                            '".$lokasi."',
                            '".$keterangan."')";
                        try {
                            $insert = mysqli_query($CON, $sql);
                            if($insert){
                                echo '<script>alert("Tambah data berhasil")</script>';
                                echo '<script>window.location="data_aspirasi.php"</script>';
                            } else {
                                // Jika mysqli_report melempar exception, ini tidak akan dijalankan, tapi tetap aman
                                echo 'gagal '.mysqli_error($CON);
                            }
                        } catch (mysqli_sql_exception $e) {
                            // 1062 = Duplicate entry
                            if($e->getCode() == 1062){
                                echo '<script>alert("Gagal: TERDAPAT KODE SURAT MASUK YANG SAMA, HARAP PERIKSA DAN UBAH KODE SURAT MASUK")</script>';
                            } else {
                                echo 'gagal '.htmlspecialchars($e->getMessage());
                            }
                            error_log('[tambah_masuk] SQL error: ' . $e->getMessage());
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