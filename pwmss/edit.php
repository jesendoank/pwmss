<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $sql = "SELECT * FROM tb_bphp1 WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    echo "ID tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pegawai</title>
</head>
<body>

<h2>Edit Data Pegawai</h2>

<form method="post" action="update.php">
    <input type="hidden" name="id" value="<?= $row['id']; ?>">
    Nama: <input type="text" name="nama" value="<?= $row['nama']; ?>" required><br><br>
    Email: <input type="email" name="email" value="<?= $row['email']; ?>" required><br><br>
    Pekerjaan: <input type="text" name="pekerjaan" value="<?= $row['pekerjaan']; ?>" required><br><br>
    <button type="submit"><i class="fas fa-save"></i> Update</button>
</form>
<section>
    <p>Oke ya!</p>
</section>
</body>
</html>