<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "codashop";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Inisialisasi variabel untuk menyimpan pesan error dan sukses
$error = "";
$success = "";

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];

    // Validasi input
    if (empty($username) || empty($password) || empty($confirm_password) || empty($email)) {
        $error = "Semua bidang harus diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email tidak valid.";
    } elseif ($password !== $confirm_password)
        $error = "Password dan konfirmasi password tidak cocok.";
    } else {
        // Enkripsi passwordeehehef ehfghefefbh ehfbwehfbehbf wiehfefwef
        g
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Menyimpan data ke database dengan prepared statement
        $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashed_password, $email);

        if ($stmt->execute()) {
            $success = "Registrasi berhasil!";
        } else {
            $error = "Error: " . $stmt->error;
        }

        // Menutup statement
        $stmt->close();
    }
}

// Menutup koneksi
$conn->close();
?>


