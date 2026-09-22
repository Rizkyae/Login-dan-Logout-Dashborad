<?php
session_start();
require_once "../config/database.php";

// Jika sudah login, langsung ke dashboard
if (isset($_SESSION['admin_id'])) {
    header("Location: ../dashboard/index.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email    = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if (empty($email) || empty($password)) {
        $error = "Email dan password wajib diisi.";
    } else {
        $sql  = "SELECT * FROM admins WHERE email = :email LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["email" => $email]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin["password"])) {
            session_regenerate_id(true);
            $_SESSION["admin_id"]    = $admin["id"];
            $_SESSION["admin_name"]  = $admin["name"];
            $_SESSION["admin_email"] = $admin["email"];
            header("Location: ../dashboard/index.php");
            exit;
        } else {
            $error = "Email atau password salah.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="scene">
  <div class="orb orb-a"></div>
  <div class="orb orb-b"></div>

  <div class="login-container">
    <div class="login-card">
      <div class="login-header">
        <div class="admin-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="url(#g1)" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
            <defs>
              <linearGradient id="g1" x1="0" y1="0" x2="1" y2="1">
                <stop offset="0%" stop-color="#22d3ee"/>
                <stop offset="100%" stop-color="#8b5cf6"/>
              </linearGradient>
            </defs>
            <path d="M12 2 4 5.5V11c0 5.2 3.4 9.8 8 11 4.6-1.2 8-5.8 8-11V5.5L12 2Z"/>
            <path d="M9 12.2l2.1 2.1L15.5 10"/>
          </svg>
        </div>
        <h1>Admin Access</h1>
        <p>Masuk ke panel kontrol sistem</p>
      </div>

      <?php if (!empty($error)): ?>
        <div class="alert-error"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form method="POST" action="" autocomplete="off">
        <div class="form-group">
          <label for="email">Email</label>
          <input
            type="email"
            id="email"
            name="email"
            placeholder="nama@perusahaan.com"
            required
          >
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <div class="password-wrapper">
            <input
              type="password"
              id="password"
              name="password"
              placeholder="Masukkan password"
              required
            >
            <button
              type="button"
              class="toggle-password"
              id="togglePassword"
              aria-label="Tampilkan password"
            ></button>
          </div>
        </div>

        <button type="submit" class="btn-primary">Masuk</button>
      </form>
    </div>
  </div>
</div>

<script src="../assets/js/login.js"></script>
</body>
</html>
