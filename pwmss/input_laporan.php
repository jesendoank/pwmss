<?php
include 'sambung.php';

// Proses simpan data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $nama = $_POST['pekerjaan'];
    $pegawai = $_POST['pegawai'];
    $dokumen = $_POST['dokumen'];
    $foto = $_POST['foto'];
    $video = $_POST['video'];

    $stmt = $conn->prepare("INSERT INTO pekerjaan (pekerjaan, pegawai, dokumen, foto, video, status) VALUES (?, ?, ?, ?, ?, 'Belum Dilaporkan')");
    $stmt->bind_param("sssss", $nama, $pegawai, $dokumen, $foto, $video);

    if ($stmt->execute()) {
        echo "Data berhasil disimpan. <a href='index.php'>Kembali ke daftar</a>";
    } else {
        echo "Gagal menyimpan data: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Input Data Laporan</title>
       <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .cona {
            max-width: 800px;
            margin: 50px auto; /* tengah + jarak atas */
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class = "cona">
    <h2>Input Data Laporan Pekerjaan</h2>
    <form method="post">
        <label>Nama Pekerjaan:</label><br>
        <input type="text" name="pekerjaan" required><br><br>

        <label>Pegawai:</label><br>
        <input type="text" name="pegawai" required><br><br>

        <label>Dokumen:</label><br>
        <input type="text" name="dokumen" required><br><br>

        <label>Foto (nama file atau URL):</label><br>
        <input type="text" name="foto"><br><br>

        <label>Video (nama file atau URL):</label><br>
        <input type="text" name="video"><br><br>

        <button type="submit" name="submit">Simpan</button>
    </form>
    <a href="tugas.php" style="display: inline-block; margin-top: 30px; padding: 8px 16px; background-color: green; color:yellow; text-decoration: none; border-radius: 4px; box-shadow: 10px;">← Kembali</a>
    </div>
</body>
</html>
