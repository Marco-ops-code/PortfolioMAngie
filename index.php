<?php
$pageTitle = 'Accueil';
$pageDescription = 'Angela Volcimus Louis — artiste vocale entre R&B, classique et gospel. Découvrez la musique, les dates et le booking.';
$bodyClass = 'page-home';
require_once __DIR__ . '/includes/header.php';

$tracks = array_slice(getTracks(), 0, 3);
$concerts = getUpcomingConcerts(3);
?>

<section class="hero">
  <div class="hero-media" aria-hidden="true">
    <img class="hero-bg" src="assets/img/hero-mic.png" alt="">
  </div>
  <div class="hero-notes" aria-hidden="true">
    <svg class="note note-8 n1" viewBox="0 0 28 48"><use href="#icon-croche"/></svg>
    <svg class="note note-16 n2" viewBox="0 0 28 48"><use href="#icon-double-croche"/></svg>
    <svg class="note note-8 n3" viewBox="0 0 28 48"><use href="#icon-croche"/></svg>
    <svg class="note note-16 n4" viewBox="0 0 28 48"><use href="#icon-double-croche"/></svg>
    <svg class="note note-8 n5" viewBox="0 0 28 48"><use href="#icon-croche"/></svg>
    <svg class="note note-16 n6" viewBox="0 0 28 48"><use href="#icon-double-croche"/></svg>
    <svg class="note note-8 n7" viewBox="0 0 28 48"><use href="#icon-croche"/></svg>
    <svg class="note note-16 n8" viewBox="0 0 28 48"><use href="#icon-double-croche"/></svg>
    <svg class="note note-8 n9" viewBox="0 0 28 48"><use href="#icon-croche"/></svg>
  </div>
  <svg class="note-defs" aria-hidden="true" width="0" height="0">
    <defs>
      <g id="icon-croche" fill="currentColor">
        <ellipse cx="8" cy="40" rx="7" ry="4.6" transform="rotate(-22 8 40)"/>
        <rect x="13.4" y="6" width="2" height="33.2"/>
        <path d="M15.4 6c7.6 2.4 10.6 8.2 8.8 14.2-2.4-3.4-5.4-5.2-8.8-6.2V6Z"/>
      </g>
      <g id="icon-double-croche" fill="currentColor">
        <ellipse cx="8" cy="40" rx="7" ry="4.6" transform="rotate(-22 8 40)"/>
        <rect x="13.4" y="6" width="2" height="33.2"/>
        <path d="M15.4 6c7.6 2.4 10.6 8.2 8.8 14.2-2.4-3.4-5.4-5.2-8.8-6.2V6Z"/>
        <path d="M15.4 13c7.6 2.4 10.6 8.2 8.8 14.2-2.4-3.4-5.4-5.2-8.8-6.2v-8Z"/>
      </g>
    </defs>
  </svg>
  <div class="container hero-content">
    <p class="eyebrow">Artiste vocale</p>
    <h1 class="display display-xl">Angela Volcimus Louis</h1>
    <p class="hero-welcome">Bienvenue dans mon Univers</p>
    <div class="hero-actions">
      <a class="btn-listen" href="music.php">
        <span class="btn-listen-disc" aria-hidden="true">
          <svg viewBox="0 0 24 24"><path d="M8.4 6.2v11.6L18.2 12Z"/></svg>
        </span>
        <span class="btn-listen-text">Écouter maintenant</span>
      </a>
      <a class="btn-dates" href="concerts.php">
        <span>Prochaines dates</span>
        <span class="btn-dates-staff" aria-hidden="true"></span>
      </a>
    </div>
    <div class="hero-genres">
      <span>R&amp;B</span>
      <span>Classique</span>
      <span>Gospel</span>
    </div>
  </div>
</section>

<section class="genre-strip">
  <div class="genre-item reveal">
    <h3>R&amp;B</h3>
    <p>Groove velours, confessions nocturnes, chaleur contemporaine.</p>
  </div>
  <div class="genre-item reveal reveal-delay-1">
    <h3>Classique</h3>
    <p>Lignes vocales précises, respiration d’orchestre, élégance rare.</p>
  </div>
  <div class="genre-item reveal reveal-delay-2">
    <h3>Gospel</h3>
    <p>Élan spirituel, harmonies ouvertes, lumière partagée sur scène.</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="split">
      <div class="split-media photo-frame reveal">
        <div class="photo-crop">
          <img src="assets/img/angela-portrait.jpeg" alt="Portrait d’Angela Volcimus Louis, sourire éclatant" class="img-face">
        </div>
      </div>
      <div class="split-content reveal reveal-delay-1">
        <p class="eyebrow">L’artiste</p>
        <h2 class="display display-md">La voix comme un fil d’or entre trois mondes</h2>
        <p>Formée au répertoire classique, nourrie par le gospel et habitée par le R&amp;B, Angela Volcimus Louis construit une signature unique : une présence scénique intense, une technique maîtrisée, une émotion immédiate.</p>
        <p>Chaque prestation est une traversée — du souffle le plus fragile à la montée d’énergie collective.</p>
        <div class="cta-row">
          <a class="btn-mangie btn-mangie-ghost" href="about.php">Lire la biographie</a>
        </div>
        <blockquote class="quote-block">« Je chante pour que le silence se souvienne. »</blockquote>
      </div>
    </div>
  </div>
</section>

<section class="section" style="padding-top: 0;">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow">À écouter</p>
      <h2 class="display display-md">Sélection</h2>
      <p class="lede">Extraits de l’univers <em>Lumière Intérieure</em> — entre prière soul et nocturnes contemporaines.</p>
    </div>

    <ul class="track-list">
      <?php foreach ($tracks as $i => $track): ?>
        <li class="track-item reveal <?= $i ? 'reveal-delay-' . min($i, 3) : '' ?>">
          <button class="play-btn" type="button" data-play aria-label="Écouter <?= e($track['title']) ?>" aria-pressed="false">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
          </button>
          <div class="track-meta">
            <h3><?= e($track['title']) ?></h3>
            <p><?= e($track['genre']) ?> · <?= e($track['album'] ?? '') ?></p>
          </div>
          <span class="track-duration"><?= e($track['duration'] ?? '') ?></span>
          <div class="track-links">
            <a href="<?= e($track['spotify_url'] ?? '#') ?>">Spotify</a>
            <a href="<?= e($track['apple_url'] ?? '#') ?>">Apple</a>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>

    <div class="cta-row reveal">
      <a class="btn-mangie" href="music.php">Toute la discographie</a>
    </div>
  </div>
</section>

<section class="section" style="padding-top: 0;">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow">Sur scène</p>
      <h2 class="display display-md">Prochaines dates</h2>
      <p class="lede">Concerts, récitals et expériences gospel — réservez votre place.</p>
    </div>

    <div class="table-responsive reveal">
      <table class="concert-table">
        <tbody>
          <?php foreach ($concerts as $c): ?>
            <tr>
              <td class="concert-date"><?= e(formatDateFr($c['event_date'])) ?></td>
              <td>
                <h3 class="concert-title"><?= e($c['title']) ?></h3>
                <p class="concert-venue"><?= e($c['venue']) ?></p>
              </td>
              <td class="concert-city"><?= e($c['city']) ?></td>
              <td>
                <?php if (($c['status'] ?? '') === 'soldout'): ?>
                  <span class="status-pill status-soldout">Complet</span>
                <?php else: ?>
                  <a class="status-pill status-available" href="contact.php">Réserver</a>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="cta-row reveal">
      <a class="btn-mangie btn-mangie-ghost" href="concerts.php">Voir l’agenda</a>
      <a class="btn-mangie" href="contact.php">Demande de booking</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
