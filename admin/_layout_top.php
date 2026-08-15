<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/db.php';
requireAdmin();

$adminPage = $adminPage ?? 'dashboard';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($pageTitle ?? 'Admin') ?> — <?= e(SITE_NAME) ?></title>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600&family=Outfit:wght@300;400;500&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="admin-body">
  <div class="admin-wrap">
    <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-3">
      <div>
        <p class="eyebrow"><?= e(SITE_NAME) ?></p>
        <h1 class="display display-md"><?= e($pageTitle ?? 'Dashboard') ?></h1>
      </div>
      <a class="btn-mangie btn-mangie-ghost" href="logout.php">Déconnexion</a>
    </div>

    <nav class="admin-nav">
      <a class="<?= $adminPage === 'dashboard' ? 'active' : '' ?>" href="dashboard.php">Dashboard</a>
      <a class="<?= $adminPage === 'concerts' ? 'active' : '' ?>" href="concerts.php">Concerts</a>
      <a class="<?= $adminPage === 'messages' ? 'active' : '' ?>" href="messages.php">Messages</a>
      <a href="../index.php" target="_blank" rel="noopener">Voir le site</a>
    </nav>
