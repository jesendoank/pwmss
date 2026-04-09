<?php
// Data pegawai (dengan ID, nama, email, dan pekerjaan)
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

// Ambil ID pegawai dari URL (misalnya ?id=14)
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Cari pegawai berdasarkan ID
$pegawai = null;
foreach ($data as $row) {
    if ($row['id'] == $id) {
        $pegawai = $row;
        break;
    }
}

if ($pegawai === null) {
    // Jika pegawai tidak ditemukan
    echo "Pegawai tidak ditemukan!";
    exit;
}

// Tampilkan detail pegawai
echo '
<style>
  .profil {
    border: 1px solid black;
    padding: 20px;
    margin: 20px;
    width: 50%;
    margin: 0 auto;
    text-align: left;
  }
  .profil h2 {
    text-align: center;
  }
  .profil .label {
    font-weight: bold;
  }
  .profil td {
    padding: 8px;
  }
  .btn-kembali {
    background-color: #28a745;
    color: white;
    padding: 6px 12px;
    text-decoration: none;
    border-radius: 4px;
    font-size: 1em;
    display: block;
    margin-top: 20px;
    width: fit-content;
    margin-left: auto;
    margin-right: auto;
  }
</style>

<div class="profil">
    <h2>Detail Profil Pegawai</h2>
    <table>
        <tr><td class="label">ID</td><td>:</td><td>' . $pegawai['id'] . '</td></tr>
        <tr><td class="label">Nama</td><td>:</td><td>' . htmlspecialchars($pegawai['nama']) . '</td></tr>
        <tr><td class="label">Email</td><td>:</td><td>' . htmlspecialchars($pegawai['email']) . '</td></tr>
        <tr><td class="label">Pekerjaan</td><td>:</td><td>' . htmlspecialchars($pegawai['pekerjaan']) . '</td></tr>
    </table>
    <a href="index.php" class="btn-kembali">Kembali</a>
</div>
';
?>
