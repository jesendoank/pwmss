<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int) $_POST['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pekerjaan = $_POST['pekerjaan'];

    $sql = "UPDATE tb_bphp1 SET nama='$nama', email='$email', pekerjaan='$pekerjaan' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        header("Location: tampil.php");
        exit;
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($conn);
    } 
}
?>