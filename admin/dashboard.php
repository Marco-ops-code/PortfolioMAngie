<?php
declare(strict_types=1);

$pageTitle = 'Dashboard';
$adminPage = 'dashboard';
require_once __DIR__ . '/_layout_top.php';

$concertCount = 0;
$messageCount = 0;
$unread = 0;

if (dbAvailable()) {
    try {
        $pdo = getDB();
        $concertCount = (int) $pdo->query('SELECT COUNT(*) FROM concerts WHERE event_date >= CURDATE()')->fetchColumn();
        $messageCount = (int) $pdo->query('SELECT COUNT(*) FROM messages')->fetchColumn();
        $unread = (int) $pdo->query('SELECT COUNT(*) FROM messages WHERE is_read = 0')->fetchColumn();
    } catch (Throwable $e) {
        // ignore
    }
} else {
    $concertCount = count(demoConcerts());
}
?>

<div class="stat-row">
  <div class="stat-box">
    <strong><?= $concertCount ?></strong>
    <span>Dates à venir</span>
  </div>
  <div class="stat-box">
    <strong><?= $messageCount ?></strong>
    <span>Messages</span>
  </div>
  <div class="stat-box">
    <strong><?= $unread ?></strong>
    <span>Non lus</span>
  </div>
</div>

<div class="admin-card">
  <h2 class="display admin-card-title">Bienvenue</h2>
  <p class="admin-note">
    Gérez les concerts et les messages reçus depuis le formulaire de contact.
    <?php if (!dbAvailable()): ?>
      <br><br><strong>MySQL non connecté.</strong> Importez <code>sql/schema.sql</code> puis ajustez <code>includes/config.php</code>.
    <?php endif; ?>
  </p>
</div>

<?php require_once __DIR__ . '/_layout_bottom.php'; ?>
