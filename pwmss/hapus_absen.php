<?php
require 'ab_koneksi.php';

$id_absen = $_GET['id'] ?? null;
if ($id_absen) {
    // Query untuk menghapus absensi
    $sql = "DELETE FROM absen WHERE id_absen = :id_absen";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_absen', $id_absen, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<p>Absensi berhasil dihapus!</p>";
    } else {
        echo "<p>Gagal menghapus absensi.</p>";
    }
} else {
    echo "Absensi tidak ditemukan.";
}
?>
