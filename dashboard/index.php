<?php
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION["admin_id"])) {
    header("Location: ../auth/login.php");
    exit;
}

$adminName  = $_SESSION["admin_name"];
$adminEmail = $_SESSION["admin_email"];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="scene">
  <div class="orb orb-a"></div>
  <div class="orb orb-b"></div>

  <div class="dashboard-container">
    <nav class="navbar">
      <div class="brand">
        <span class="dot"></span>
        Admin Panel
      </div>
      <a href="../auth/logout.php" class="btn-logout">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
          <path d="M16 17l5-5-5-5"/>
          <path d="M21 12H9"/>
        </svg>
        Logout
      </a>
    </nav>

    <main class="dashboard-content">
      <div class="dashboard-card">
        <span class="eyebrow">Sesi aktif</span>
        <h1>Selamat datang, <?= htmlspecialchars($adminName) ?></h1>
        <p>Anda berhasil login ke dalam sistem administrator. Semua akses dan sesi Anda terenkripsi dan tercatat secara aman.</p>

        <div class="info-row">
          <strong>Email:</strong>
          <span><?= htmlspecialchars($adminEmail) ?></span>
        </div>
      </div>
    </main>
  </div>
</div>
</body>
</html>
