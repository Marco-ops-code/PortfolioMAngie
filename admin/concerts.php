<?php
declare(strict_types=1);

$pageTitle = 'Concerts';
$adminPage = 'concerts';
require_once __DIR__ . '/_layout_top.php';

$flash = getFlash();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && dbAvailable()) {
    $title = trim((string) ($_POST['title'] ?? ''));
    $venue = trim((string) ($_POST['venue'] ?? ''));
    $city = trim((string) ($_POST['city'] ?? ''));
    $date = trim((string) ($_POST['event_date'] ?? ''));
    $ticket = trim((string) ($_POST['ticket_url'] ?? ''));
    $status = (string) ($_POST['status'] ?? 'available');

    if (!in_array($status, ['available', 'soldout', 'cancelled'], true)) {
        $status = 'available';
    }

    if ($title && $venue && $city && $date) {
        try {
            $pdo = getDB();
            $stmt = $pdo->prepare(
                'INSERT INTO concerts (title, venue, city, event_date, ticket_url, status) VALUES (?, ?, ?, ?, ?, ?)'
            );
            $stmt->execute([$title, $venue, $city, $date, $ticket ?: null, $status]);
            flash('success', 'Concert ajouté.');
            header('Location: concerts.php');
            exit;
        } catch (Throwable $e) {
            $error = 'Impossible d’enregistrer le concert.';
        }
    } else {
        $error = 'Champs obligatoires manquants.';
    }
}

if (isset($_GET['delete']) && dbAvailable()) {
    $id = (int) $_GET['delete'];
    try {
        $pdo = getDB();
        $stmt = $pdo->prepare('DELETE FROM concerts WHERE id = ?');
        $stmt->execute([$id]);
        flash('success', 'Concert supprimé.');
    } catch (Throwable $e) {
        flash('error', 'Suppression impossible.');
    }
    header('Location: concerts.php');
    exit;
}

$concerts = getUpcomingConcerts(50);
if (dbAvailable()) {
    try {
        $pdo = getDB();
        $concerts = $pdo->query('SELECT * FROM concerts ORDER BY event_date DESC')->fetchAll();
    } catch (Throwable $e) {
        // keep fallback
    }
}
?>

<?php if ($flash): ?>
  <div class="alert-mangie"><?= e($flash['message']) ?></div>
<?php endif; ?>
<?php if ($error): ?>
  <div class="alert-mangie"><?= e($error) ?></div>
<?php endif; ?>

<div class="admin-card mb-4">
  <h2 class="display admin-card-title">Ajouter une date</h2>
  <?php if (!dbAvailable()): ?>
    <p style="color: var(--muted); margin: 0;">Connectez MySQL pour ajouter des concerts en base.</p>
  <?php else: ?>
    <form class="form-mangie" method="post">
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label" for="title">Titre</label>
          <input class="form-control" id="title" name="title" required>
        </div>
        <div class="col-md-6">
          <label class="form-label" for="venue">Lieu</label>
          <input class="form-control" id="venue" name="venue" required>
        </div>
        <div class="col-md-4">
          <label class="form-label" for="city">Ville</label>
          <input class="form-control" id="city" name="city" required>
        </div>
        <div class="col-md-4">
          <label class="form-label" for="event_date">Date</label>
          <input class="form-control" type="date" id="event_date" name="event_date" required>
        </div>
        <div class="col-md-4">
          <label class="form-label" for="status">Statut</label>
          <select class="form-select" id="status" name="status">
            <option value="available">Disponible</option>
            <option value="soldout">Complet</option>
            <option value="cancelled">Annulé</option>
          </select>
        </div>
        <div class="col-12">
          <label class="form-label" for="ticket_url">Lien billets</label>
          <input class="form-control" type="url" id="ticket_url" name="ticket_url" placeholder="https://">
        </div>
        <div class="col-12">
          <button class="btn-mangie" type="submit">Enregistrer</button>
        </div>
      </div>
    </form>
  <?php endif; ?>
</div>

<div class="admin-card">
  <h2 class="display admin-card-title">Liste</h2>
  <div class="table-responsive">
    <table class="table-admin">
      <thead>
        <tr>
          <th>Date</th>
          <th>Titre</th>
          <th>Ville</th>
          <th>Statut</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($concerts as $c): ?>
          <tr>
            <td><?= e(formatDateFr($c['event_date'])) ?></td>
            <td><?= e($c['title']) ?><br><small style="color:var(--muted)"><?= e($c['venue']) ?></small></td>
            <td><?= e($c['city']) ?></td>
            <td><?= e($c['status'] ?? 'available') ?></td>
            <td>
              <?php if (dbAvailable() && !empty($c['id'])): ?>
                <a href="?delete=<?= (int) $c['id'] ?>" onclick="return confirm('Supprimer cette date ?');">Suppr.</a>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php require_once __DIR__ . '/_layout_bottom.php'; ?>
