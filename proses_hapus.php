<?php
include 'db.php';

if(isset($_GET['ids'])){
    $ids = mysqli_real_escape_string($CON, $_GET['ids']);
    // coba hapus dari siswa
    $delete = mysqli_query($CON, "DELETE FROM siswa WHERE nis = '$ids' ");
    if($delete && mysqli_affected_rows($CON) > 0){
        echo '<script>alert("Hapus data berhasil")</script>';
        echo '<script>window.location="manajemen_siswa.php"</script>';
        exit;
    }
}
if(isset($_GET['idk'])){
    $idk = mysqli_real_escape_string($CON, $_GET['idk']);
    $delete = mysqli_query($CON, "DELETE FROM kategori WHERE id_kategori = '$idk' ");
    if($delete){
        echo '<script>alert("Hapus data berhasil")</script>';
        echo '<script>window.location="manajemen_kategori.php"</script>';
        exit;
    } else {
        echo 'gagal '.mysqli_error($CON);
    }
}

?>