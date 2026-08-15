<?php
$pageTitle = 'Scène';
$pageDescription = 'Agenda des concerts et récitals d’Angela Volcimus Louis.';
require_once __DIR__ . '/includes/header.php';

$concerts = getUpcomingConcerts(20);
?>

<section class="page-hero">
  <div class="container">
    <p class="eyebrow reveal">Agenda</p>
    <h1 class="display display-lg reveal">Scène</h1>
    <p class="lede reveal">Retrouvez Angela Volcimus Louis en concert, en récital ou en expérience gospel.</p>
  </div>
</section>

<section class="section" style="padding-top: 0;">
  <div class="container">
    <?php if (!$concerts): ?>
      <p class="reveal">Aucune date annoncée pour le moment. Suivez les réseaux ou contactez le booking.</p>
    <?php else: ?>
      <div class="table-responsive reveal">
        <table class="concert-table">
          <thead>
            <tr>
              <th scope="col">Date</th>
              <th scope="col">Événement</th>
              <th scope="col">Ville</th>
              <th scope="col">Billetterie</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($concerts as $c): ?>
              <tr>
                <td class="concert-date"><?= e(formatDateFr($c['event_date'])) ?></td>
                <td>
                  <h2 class="concert-title"><?= e($c['title']) ?></h2>
                  <p class="concert-venue"><?= e($c['venue']) ?></p>
                </td>
                <td class="concert-city"><?= e($c['city']) ?></td>
                <td>
                  <?php
                  $status = $c['status'] ?? 'available';
                  if ($status === 'soldout'): ?>
                    <span class="status-pill status-soldout">Complet</span>
                  <?php elseif ($status === 'cancelled'): ?>
                    <span class="status-pill status-cancelled">Annulé</span>
                  <?php else: ?>
                    <a class="status-pill status-available" href="<?= e($c['ticket_url'] ?: 'contact.php') ?>">Billets</a>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>

    <div class="cta-row reveal" style="margin-top: 2.5rem;">
      <a class="btn-mangie" href="contact.php">Proposer une date</a>
      <a class="btn-mangie btn-mangie-ghost" href="about.php">Découvrir l’artiste</a>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="split">
      <div class="split-content reveal">
        <p class="eyebrow">Booking</p>
        <h2 class="display display-md">Formats disponibles</h2>
        <p><strong>Intimate Set</strong> — voix &amp; piano / guitare, 45 à 60 min.</p>
        <p><strong>Full Band</strong> — R&amp;B &amp; gospel live, énergie collective.</p>
        <p><strong>Récital</strong> — programme classique &amp; croisements soul, halls et festivals.</p>
        <div class="cta-row">
          <a class="btn-mangie btn-mangie-ghost" href="contact.php">Contacter le booking</a>
        </div>
      </div>
      <div class="split-media photo-frame reveal reveal-delay-1">
        <div class="photo-crop">
          <img src="assets/img/angela-scene.jpeg" alt="Angela Volcimus Louis sur scène, au micro avec le groupe" class="img-scene">
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
