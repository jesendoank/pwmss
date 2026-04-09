<?php
echo "Halo, dunia! Ini proyek Hansen Ismawan (PHP) SIM Pegawai.";
?>

<!DOCTYPE html>
<html>
<head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <title>SIM PEGAWAI PWM SUMSEL</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background: #cdf53c;
        }
        h1 {
            color: #000000;
        }
        .menu {
            margin: 20px 0;
            
        }
        .menu a {
            display: inline-block;
            margin-right: 15px;
            padding: 10px 15px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 20px;
        
        }
        .menu a:hover {
            background: #2980b9;
            opacity: 70%;
        }
    
        table {
            border-collapse: collapse;
            width: auto;
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

    <h1>Selamat Datang di Sistem Informasi Kepegawaian Pimpinan Wilayah Muhammadiyah Sumatera Selatan</h1>
    <div class="menu">
        <a href="tampil.php">pegawai</a>
        <a href="absen.php">absen</a>
        <a href="tugas.php">pekerjaan</a>
        <a href="reward.html#">reward</a>
        <a href="#">lagu</a>
    </div>

    <p>Aplikasi ini memungkinkan Anda untuk:</p>
    <ul>
        <li>Melihat daftar dan data pegawai</li>
        <li>Melihat pekerjaan pegawai</li>
        <li>Melihat gaji reward dan punishment pegawai</li>
        <li>Mengedit data pegawai</li>
        <li>Menghapus data pegawai</li>
    </ul>
    <ul>
        <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-primary tombol" type="submit">Search</button>
        </form>
    </ul>

    <p>Selamat Datang!</p>

    <?php
// Data pegawai
$data = [
    ['id' => 14, 'nama' => 'Hansen Ismawan', 'email' => 'hansenismawan@gmail.com', 'pekerjaan' => 'Administrasi'],
    ['id' => 15, 'nama' => 'Marwandi', 'email' => 'marwandi@gmail.com', 'pekerjaan' => 'Administrasi'],
    ['id' => 16, 'nama' => 'Abdullah Asri', 'email' => 'abdulahasri@gmail.com', 'pekerjaan' => 'Administrasi'],
    ['id' => 26, 'nama' => 'Muhammad Jainuri', 'email' => 'mjainuri@gmail.com', 'pekerjaan' => 'Administrasi'],
    ['id' => 17, 'nama' => 'Marleo', 'email' => 'marleo@gmail.com', 'pekerjaan' => 'Asisten Bendahara'],
    ['id' => 18, 'nama' => 'Hendri', 'email' => 'hendri@gmail.com', 'pekerjaan' => 'Kebersihan'],
    ['id' => 19, 'nama' => 'Heriyadi', 'email' => 'heriyadi@gmail.com', 'pekerjaan' => 'Kebersihan'],
    ['id' => 20, 'nama' => 'Bambang Setyo Laksono', 'email' => 'bambangsl@gmail.com', 'pekerjaan' => 'Security'],
    ['id' => 21, 'nama' => 'Wahyudin', 'email' => 'wahyudin@gmail.com', 'pekerjaan' => 'Administrasi'],
    ['id' => 22, 'nama' => 'Arifin', 'email' => 'arifin@gmail.com', 'pekerjaan' => 'Sopir'],
    ['id' => 23, 'nama' => 'Dedi Asyani', 'email' => 'dediasyani@gmail.com', 'pekerjaan' => 'Sopir'],
    ['id' => 24, 'nama' => 'Heriyanto', 'email' => 'heriyanto@gmail.com', 'pekerjaan' => 'Security'],
    ['id' => 25, 'nama' => 'Yanto', 'email' => 'yanto@gmail.com', 'pekerjaan' => 'Sopir']
];

// Kelompokkan berdasarkan pekerjaan
$kelompok = [];
foreach ($data as $row) {
    $kelompok[$row['pekerjaan']][] = $row;
}

// Tampilkan CSS dan tabel
echo '
<style>
    table {
        border-collapse: collapse;
        margin-bottom: 20px;
        width: 100%;
    }
    th, td {
        border: 1px solid black;
        padding: 6px 10px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
    h3 {
        margin-top: 30px;
        margin-bottom: 10px;
    }
    .aksi-btn {
        background-color: #007bff;
        color: white;
        padding: 4px 8px;
        text-decoration: none;
        border-radius: 4px;
        font-size: 0.9em;
    }
</style>
';

foreach ($kelompok as $pekerjaan => $pegawaiList) {
    echo "<h3>Pekerjaan: $pekerjaan</h3>";
    echo '<table>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Pekerjaan</th>
                <th>Aksi</th>
            </tr>';
    foreach ($pegawaiList as $pegawai) {
        echo '<tr>
                <td>' . $pegawai['id'] . '</td>
                <td>' . htmlspecialchars($pegawai['nama']) . '</td>
                <td>' . htmlspecialchars($pegawai['email']) . '</td>
                <td>' . htmlspecialchars($pegawai['pekerjaan']) . '</td>
                <td><a href="detail.php?id=' . $pegawai['id'] . '" class="aksi-btn">Lihat</a></td>
              </tr>';
    }
    echo '</table>';
}
?>

<section>
    <h1>Footer</h1>
    <p>Aplikasi Created, Read, Update, Data (CRUD) Sederhana karya Hansen Ismawan</p>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
