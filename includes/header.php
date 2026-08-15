<?php
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/db.php';

$pageTitle = $pageTitle ?? SITE_NAME;
$pageDescription = $pageDescription ?? SITE_TAGLINE;
$bodyClass = $bodyClass ?? '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?= e($pageDescription) ?>">
  <title><?= e($pageTitle) ?> — <?= e(SITE_NAME) ?></title>
  <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16.png">
  <link rel="icon" type="image/png" sizes="192x192" href="assets/img/favicon-192.png">
  <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="<?= e($bodyClass) ?>">
  <a class="skip-link" href="#main">Aller au contenu</a>

  <header class="site-header" id="top">
    <nav class="navbar navbar-expand-lg site-nav">
      <div class="container nav-inner">
        <a class="navbar-brand brand" href="index.php" aria-label="<?= e(SITE_NAME) ?> — Accueil">
          <span class="brand-photo">
            <span class="photo-crop">
              <img src="assets/img/angela-portrait.jpeg" alt="" class="img-face">
            </span>
          </span>
          <span class="brand-name"><?= e(SITE_NAME) ?></span>
        </a>

        <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Menu">
          <span></span><span></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
          <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
            <li class="nav-item"><a class="nav-link <?= isActive('index.php') ?>" href="index.php">Accueil</a></li>
            <li class="nav-item"><a class="nav-link <?= isActive('about.php') ?>" href="about.php">Artiste</a></li>
            <li class="nav-item"><a class="nav-link <?= isActive('music.php') ?>" href="music.php">Musique</a></li>
            <li class="nav-item"><a class="nav-link <?= isActive('concerts.php') ?>" href="concerts.php">Scène</a></li>
            <li class="nav-item"><a class="nav-link <?= isActive('gallery.php') ?>" href="gallery.php">Galerie</a></li>
            <li class="nav-item"><a class="nav-link nav-cta <?= isActive('contact.php') ?>" href="contact.php">Booking</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <main id="main">
