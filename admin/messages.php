<?php
declare(strict_types=1);

$pageTitle = 'Messages';
$adminPage = 'messages';
require_once __DIR__ . '/_layout_top.php';

$messages = [];

if (dbAvailable()) {
    try {
        $pdo = getDB();

        if (isset($_GET['read'])) {
            $stmt = $pdo->prepare('UPDATE messages SET is_read = 1 WHERE id = ?');
            $stmt->execute([(int) $_GET['read']]);
            header('Location: messages.php');
            exit;
        }

        $messages = $pdo->query('SELECT * FROM messages ORDER BY created_at DESC')->fetchAll();
    } catch (Throwable $e) {
        $messages = [];
    }
} else {
    $logFile = __DIR__ . '/../uploads/messages.log';
    if (is_file($logFile)) {
        $lines = array_reverse(file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: []);
        foreach (array_slice($lines, 0, 50) as $i => $line) {
            $messages[] = [
                'id' => $i + 1,
                'created_at' => '',
                'type' => 'log',
                'name' => 'Fichier local',
                'email' => '',
                'subject' => 'Entrée log',
                'message' => $line,
                'is_read' => 1,
            ];
        }
    }
}
?>

<div class="admin-card">
  <?php if (!$messages): ?>
    <p style="margin: 0; color: var(--muted);">Aucun message pour le moment.</p>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table-admin">
        <thead>
          <tr>
            <th>Date</th>
            <th>De</th>
            <th>Type</th>
            <th>Sujet / Message</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($messages as $m): ?>
            <tr style="<?= empty($m['is_read']) ? 'background: rgba(122,47,53,0.06);' : '' ?>">
              <td><?= e($m['created_at'] ?? '') ?></td>
              <td>
                <?= e($m['name'] ?? '') ?><br>
                <small style="color:var(--muted)"><?= e($m['email'] ?? '') ?></small>
              </td>
              <td><?= e($m['type'] ?? '') ?></td>
              <td>
                <strong><?= e($m['subject'] ?? '') ?></strong><br>
                <?= nl2br(e($m['message'] ?? '')) ?>
              </td>
              <td>
                <?php if (dbAvailable() && empty($m['is_read'])): ?>
                  <a href="?read=<?= (int) $m['id'] ?>">Marquer lu</a>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

<?php require_once __DIR__ . '/_layout_bottom.php'; ?>
