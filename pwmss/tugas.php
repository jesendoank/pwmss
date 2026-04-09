<?php
include 'sambung.php';

// Proses laporan jika ada form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lapor'])) {
    $id = $_POST['id'];
    $dokumen_nama_asli = $_FILES['dokumen']['name'];
    $file_ext = strtolower(pathinfo($dokumen_nama_asli, PATHINFO_EXTENSION));
    $allowed_types = ['pdf', 'doc', 'docx'];

    // Validasi jenis file
    if (!in_array($file_ext, $allowed_types)) {
        echo "Tipe file tidak diperbolehkan. Hanya PDF, DOC, atau DOCX.";
        } elseif ($_FILES['dokumen']['size'] > 2097152) { // 2MB
        echo "<p style='color: red;'>Ukuran file terlalu besar. Maksimal 2MB.</p>";
    } else {
        // Buat nama file unik
        $dokumen = time() . '_' . basename($dokumen_nama_asli);
        $target = "uploads/" . $dokumen;

        // Pindahkan file dan update database
        if (move_uploaded_file($_FILES['dokumen']['tmp_name'], $target)) {
            $stmt = $conn->prepare("UPDATE pekerjaan SET dokumen=?, status='Sudah Dilaporkan', waktu=NOW() WHERE id=?");
            $stmt->bind_param("si", $dokumen, $id);
            $stmt->execute();
            echo "Laporan berhasil dikirim.";
        } else {
            echo "Gagal mengunggah dokumen.";
        }
    }
}

// Ambil data pekerjaan
$sql = "SELECT * FROM pekerjaan";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pekerjaan</title>
</head>
<body>
    <h2>Daftar Pekerjaan</h2>
    <!-- Tombol untuk mengarah ke input_laporan.php -->
<a href="input_laporan.php" style="display: inline-block; margin-bottom: 30px; padding: 8px 16px; background-color: blue; color: white; text-decoration: none; border-radius: 20px;">Laporan Baru</a>
    <table border="1" cellpadding="10">
        <tr>
            <th>No</th>
            <th>Pekerjaan</th>
            <th>Pegawai</th>
            <th>Dokumen</th>
            <th>Foto</th>
            <th>Video</th>
            <th>Waktu</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>$no</td>";
            echo "<td>" . htmlspecialchars($row['pekerjaan']) . "</td>";
            echo "<td>" . htmlspecialchars($row['pegawai']) . "</td>";
            echo "<td>" . htmlspecialchars($row['dokumen']) . "</td>";
            echo "<td>" . htmlspecialchars($row['foto']) . "</td>";
            echo "<td>" . htmlspecialchars($row['video']) . "</td>";
            echo "<td>" . ($row['waktu'] ? $row['waktu'] : "-") . "</td>";
            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
            echo "<td>";
            // Cek jika pekerjaan statusnya 'Belum Dilaporkan'
            if ($row['status'] === 'Belum Dilaporkan') {
                echo "<form method='post' enctype='multipart/form-data'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <input type='file' name='dokumen' accept='.pdf,.doc,.docx' required>
                        <button type='submit' name='lapor' style='padding: 5px 10px; background-color: green; color: white; border: none; cursor: pointer;'>Lapor</button>
                      </form>";
            } else {
                // Jika sudah dilaporkan, tampilkan tanda centang
                echo "<span style='color: green;'>✔</span>";
            }
            echo "</td>";
            echo "</tr>";
            $no++;
        }
        // Tutup koneksi database
        $conn->close();
        ?>
    </table>
    <section>
        <a href="index.php" style="display: inline-block; margin-top: 30px; padding: 8px 16px; background-color: green; color:yellow; text-decoration: none; border-radius: 20px; box-shadow: 10px;">Kembali</a>
    </section>
</body>
</html>
