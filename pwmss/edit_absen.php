<?php
require 'ab_koneksi.php';

// Ambil ID absensi yang akan di-edit
$id_absen = $_GET['id'] ?? null;
if ($id_absen) {
    // Ambil data absensi yang ingin diedit
    $sql = "SELECT a.id_absen, a.id_pegawai, p.nama, a.tanggal, a.status 
            FROM absen a
            JOIN pegawai p ON a.id_pegawai = p.id
            WHERE a.id_absen = :id_absen";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_absen', $id_absen, PDO::PARAM_INT);
    $stmt->execute();
    $absen = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$absen) {
        echo "Absensi tidak ditemukan.";
        exit;
    }
}

// Proses edit jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pegawai = $_POST['id_pegawai'];
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status'];

    // Query untuk memperbarui data absensi
    $sql = "UPDATE absen SET id_pegawai = :id_pegawai, tanggal = :tanggal, status = :status WHERE id_absen = :id_absen";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_pegawai', $id_pegawai);
    $stmt->bindParam(':tanggal', $tanggal);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id_absen', $id_absen);

    if ($stmt->execute()) {
        echo "<p>Absensi berhasil diperbarui!</p>";
    } else {
        echo "<p>Gagal memperbarui absensi.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Absensi</title>
</head>
<body>
    <h2>Edit Absensi Pegawai</h2>

    <form method="POST" action="edit_absen.php?id=<?= $id_absen; ?>">
        <label for="id_pegawai">Nama Pegawai:</label>
        <select name="id_pegawai" id="id_pegawai" required>
            <?php
            // Ambil data pegawai untuk dropdown
            $pegawai_sql = "SELECT id, nama FROM pegawai";
            $pegawai_stmt = $pdo->prepare($pegawai_sql);
            $pegawai_stmt->execute();
            $pegawai_list = $pegawai_stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($pegawai_list as $pegawai) {
                $selected = ($pegawai['id'] == $absen['id_pegawai']) ? 'selected' : '';
                echo "<option value='{$pegawai['id']}' $selected>{$pegawai['nama']}</option>";
            }
            ?>
        </select><br>

        <label for="tanggal">Tanggal:</label>
        <input type="date" name="tanggal" value="<?= $absen['tanggal']; ?>" required><br>

        <label for="status">Status:</label>
        <select name="status" required>
            <option value="Hadir" <?= ($absen['status'] == 'Hadir') ? 'selected' : ''; ?>>Hadir</option>
            <option value="Izin" <?= ($absen['status'] == 'Izin') ? 'selected' : ''; ?>>Izin</option>
            <option value="Sakit" <?= ($absen['status'] == 'Sakit') ? 'selected' : ''; ?>>Sakit</option>
            <option value="Alfa" <?= ($absen['status'] == 'Alfa') ? 'selected' : ''; ?>>Alfa</option>
        </select><br>

        <input type="submit" value="Perbarui Absensi">
    </form>
</body>
</html>
