<?php
session_start();
require 'conn.php'; // file untuk koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Cek user di database
  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
  
  // Cek apakah statement berhasil disiapkan
  if ($stmt) {
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verifikasi password
    if ($user && $password == $user['password']) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      header("Location: ./"); // redirect ke halaman chat
      exit();
    } else {
      echo "Username atau password salah!";
    }
  } else {
    // Menampilkan pesan error jika prepare() gagal
    echo "Error: " . $conn->error;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login It-jobs</title>
  <link rel="icon" type="image/png" href="barcode.png">
  <style>
    /* Reset default margin and padding */
body, html {
  margin: 0;
  padding: 0;
  font-family: 'Arial', sans-serif;
  background-color: #f0f2f5; /* Warna latar belakang lembut */
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

form {
  background-color: #ffffff; /* Warna latar belakang putih */
  border-radius: 15px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); /* Shadow halus */
  padding: 2rem;
  width: 80%;
  /* max-width: 400px; Batas maksimal untuk tampilan besar */
  display: flex;
  flex-direction: column;
  justify-content:center;
}

input {
  margin-bottom: 1rem;
  padding: 0.75rem;
  border: 1px solid #ddd;
  border-radius: 10px;
  outline: none;
  font-size: 1rem;
  transition: border 0.3s ease;
}

input:focus {
  border-color: #007bff; /* Warna biru saat input aktif */
}

button {
  padding: 0.75rem;
  background-color: #007bff; /* Warna biru */
  color: white;
  border: none;
  border-radius: 10px;
  font-size: 1rem;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #0056b3; /* Biru lebih gelap saat hover */
}

@media (max-width: 600px) {
  form {
    padding: 1.5rem;
  }
  
  input, button {
    font-size: 0.9rem;
    padding: 0.65rem;
  }
}
img{
    display:flex;
    justify-content:center;
    margin-left: 33%;
}

 /* Gaya untuk loader */
 #loader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.9);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999; /* Prioritas di atas elemen lain */
  }

  .spinner {
    width: 50px;
    height: 50px;
    border: 5px solid #f3f3f3; /* Warna luar */
    border-top: 5px solid #007bff; /* Warna utama */
    border-radius: 50%;
    animation: spin 1s linear infinite;
  }

  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }
    100% {
      transform: rotate(360deg);
    }
  }
  </style>
</head>
<body>
<div id="loader">
  <div class="spinner"></div>
</div>

  <div class="head">
    <form method="POST" action="login.php">
      <img src="barcode.png"  alt="logo" width="60"> <hr>
      <input type="text" name="username" placeholder="nama" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">MASUK</button>
    </form> <hr>
    <div class="footer" style="text-align:center;   font-family: 'Arial', sans-serif;">
    <p><i>Powered by</i> : Barcode section TBR</p>
      <b style="font-size:10px;">Version 1.0.1</b> <br><br>
      <a href="">Kebijakan Privasi</a>
    </div>
  </div>
  <script>
      window.addEventListener("load", function () {
    const loader = document.getElementById("loader");
    loader.style.display = "none"; // Sembunyikan loader
  });
  </script>
</body>
</html>
