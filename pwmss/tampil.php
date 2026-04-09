<?php
include 'koneksi.php';

$sql = "SELECT * FROM tb_bphp1";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pengguna</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
  table {
    border-collapse: collapse;
    width: auto;
  }
  th, td {
    border: 1px solid black;
    padding: 8px;
    text-align: left;
  }
  th {
    background-color: white;
    color: black;
  }
</style>
</head>
<body>

<h2>Data Pengguna</h2>
<a href="tambah.php" class="aksi-btn">Tambah</a>
<i class="fas fa-add" style="color:green;"></i>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Pekerjaan</th>
        <th>Aksi</th>
    </tr>

<?php while ($row = mysqli_fetch_assoc($result)) : ?>
    <tr>
        <td><?= $row['id']; ?></td>
        <td><?= $row['nama']; ?></td>
        <td><?= $row['email']; ?></td>
        <td><?= $row['pekerjaan']; ?></td>
        <td>
            <!-- Tombol Edit -->
            <a href="edit.php?id=<?= $row['id']; ?>" title="Edit">
                <i class="fas fa-edit" style="color:blue;"></i>
            </a>
            &nbsp;
            <!-- Tombol Hapus -->
            <a href="hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?');" title="Hapus">
                <i class="fas fa-trash" style="color:red;"></i>
            </a>
        </td>
    </tr>
<?php endwhile; ?>
</table>
<a href="index.php">Beranda</a>
</body>
</html>