<?php
// Memasukkan file koneksi database
require 'ab_koneksi.php';

// Menambahkan absensi jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id_pegawai = $_POST['id_pegawai'];
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status'];

    // Query untuk menambah data absensi
    $sql = "INSERT INTO absen (id_pegawai, tanggal, status) VALUES (:id_pegawai, :tanggal, :status)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_pegawai', $id_pegawai);
    $stmt->bindParam(':tanggal', $tanggal);
    $stmt->bindParam(':status', $status);

    if ($stmt->execute()) {
        echo "<p>Absensi berhasil ditambahkan!</p>";
    } else {
        echo "<p>Gagal menambahkan absensi.</p>";
    }
}

// Query untuk mengambil data absensi dari database
$sql = "SELECT a.id AS id_absen, a.id_pegawai, p.nama, a.tanggal, a.status 
        FROM absen a 
        JOIN tb_bphp1 p ON a.id_pegawai = p.id
        ORDER BY a.tanggal DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$absensi = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Pegawai</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            width: 80%;
            margin: 20px auto;
        }
        input[type="date"], select, input[type="submit"] {
            padding: 8px;
            margin: 5px;
        }
    </style>
</head>
<body>

    <h2 style="text-align: center;">Absensi Pegawai</h2>

    <!-- Formulir Absensi -->
    <form method="POST" action="absen.php">
        <label for="id_pegawai">Nama Pegawai:</label>
        <select name="id_pegawai" id="id_pegawai" required>
            <?php
            // Ambil data pegawai untuk dropdown
            $pegawai_sql = "SELECT id, nama FROM pegawai";
            $pegawai_stmt = $pdo->prepare($pegawai_sql);
            $pegawai_stmt->execute();
            $pegawai_list = $pegawai_stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($pegawai_list as $pegawai) {
                echo "<option value='{$pegawai['id']}'>{$pegawai['nama']}</option>";
            }
            ?>
        </select><br>

        <label for="tanggal">Tanggal:</label>
        <input type="date" name="tanggal" required><br>

        <label for="status">Status:</label>
        <select name="status" required>
            <option value="Hadir">Hadir</option>
            <option value="Izin">Izin</option>
            <option value="Sakit">Sakit</option>
            <option value="Alfa">Alfa</option>
        </select><br>

        <input type="submit" value="Tambah Absensi">
    </form>

    <!-- Tabel Absensi -->
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Pegawai</th>
            <th>Tanggal</th>
            <th>Status</th>
        </tr>
        <?php foreach ($absensi as $absen): ?>
            <tr>
                <td><?= $absen['id_absen']; ?></td>
                <td><?= htmlspecialchars($absen['nama']); ?></td>
                <td><?= $absen['tanggal']; ?></td>
                <td><?= htmlspecialchars($absen['status']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <table>
    <tr>
        <th>ID</th>
        <th>Nama Pegawai</th>
        <th>Tanggal</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($absensi as $absen): ?>
        <tr>
            <td><?= $absen['id_absen']; ?></td>
            <td><?= htmlspecialchars($absen['nama']); ?></td>
            <td><?= $absen['tanggal']; ?></td>
            <td><?= htmlspecialchars($absen['status']); ?></td>
            <td>
                <a href="edit_absen.php?id=<?= $absen['id_absen']; ?>">Edit</a> | 
                <a href="hapus_absen.php?id=<?= $absen['id_absen']; ?>" onclick="return confirm('Yakin ingin menghapus absensi ini?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
