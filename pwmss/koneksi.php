<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_bphp";

// Membuat koneksi
$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

<?php
$host = 'localhost';  // Ganti dengan host database
$dbname = 'db_bphp';  // Ganti dengan nama database
$username = 'root';  // Ganti dengan username database
$password = '';  // Ganti dengan password database jika ada

// Membuat koneksi PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>