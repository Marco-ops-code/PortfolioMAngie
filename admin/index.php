<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/functions.php';

$error = '';

if (!empty($_SESSION['admin_logged_in'])) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim((string) ($_POST['username'] ?? ''));
    $pass = (string) ($_POST['password'] ?? '');

    $validUser = hash_equals(ADMIN_USER, $user);
    $validPass = hash_equals(ADMIN_PASS_PLAIN, $pass);

    if ($validUser && $validPass) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: dashboard.php');
        exit;
    }

    $error = 'Identifiants incorrects.';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Connexion — Admin <?= e(SITE_NAME) ?></title>
  <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicon-32.png">
  <link rel="apple-touch-icon" href="../assets/img/apple-touch-icon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600&family=Outfit:wght@300;400;500&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="admin-body">
  <div class="admin-wrap" style="max-width: 420px; padding-top: 6rem;">
    <p class="eyebrow">Espace artiste</p>
    <h1 class="display display-md" style="margin-bottom: 1.5rem;">Connexion</h1>

    <?php if ($error): ?>
      <div class="alert-mangie"><?= e($error) ?></div>
    <?php endif; ?>

    <div class="admin-card">
      <form class="form-mangie" method="post">
        <div class="mb-4">
          <label class="form-label" for="username">Identifiant</label>
          <input class="form-control" type="text" id="username" name="username" required autocomplete="username">
        </div>
        <div class="mb-4">
          <label class="form-label" for="password">Mot de passe</label>
          <input class="form-control" type="password" id="password" name="password" required autocomplete="current-password">
        </div>
        <button class="btn-mangie w-100" type="submit">Entrer</button>
      </form>
    </div>

    <p style="margin-top: 1.5rem;"><a href="../index.php">← Retour au site</a></p>
  </div>
</body>
</html>
