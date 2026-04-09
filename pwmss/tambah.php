<?php
include 'koneksi.php';

// Proses tambah data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pekerjaan = $_POST['pekerjaan'];

    $sql_insert = "INSERT INTO tb_bphp1 (nama, email, pekerjaan) VALUES ('$nama', '$email', '$pekerjaan')";
    if (mysqli_query($conn, $sql_insert)) {
        header("Location: tampil.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Pegawai</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            border: 2px solid black;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Tambah Data Pegawai</h2>

<form method="POST" action="">
    Nama: <input type="text" name="nama" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Pekerjaan: <input type="text" name="pekerjaan" required><br><br>
    <button type="submit">Tambah</button>
</form>

<br>
<a href="tampil.php">Kembali ke Data Pegawai</a>

</body>
</html>
