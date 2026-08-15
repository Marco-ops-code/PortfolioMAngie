<?php
$pageTitle = 'Musique';
$pageDescription = 'Discographie et titres d’Angela Volcimus Louis — R&B, classique et gospel.';
require_once __DIR__ . '/includes/header.php';

$tracks = getTracks();
?>

<section class="page-hero">
  <div class="container">
    <p class="eyebrow reveal">Discographie</p>
    <h1 class="display display-lg reveal">Musique</h1>
    <p class="lede reveal">Écoutez l’univers d’Angela Volcimus Louis — des prières soul aux arias contemporaines.</p>
  </div>
</section>

<section class="section" style="padding-top: 0;">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow">Album</p>
      <h2 class="display display-md">Lumière Intérieure</h2>
      <p class="lede">Un voyage vocal en clair-obscur : douceur R&amp;B, élévation gospel, architecture classique.</p>
    </div>

    <ul class="track-list">
      <?php foreach ($tracks as $i => $track): ?>
        <li class="track-item reveal">
          <button class="play-btn" type="button" data-play aria-label="Écouter <?= e($track['title']) ?>" aria-pressed="false">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
          </button>
          <div class="track-meta">
            <h3><?= e($track['title']) ?></h3>
            <p><?= e($track['genre']) ?><?= !empty($track['album']) ? ' · ' . e($track['album']) : '' ?></p>
          </div>
          <span class="track-duration"><?= e($track['duration'] ?? '') ?></span>
          <div class="track-links">
            <a href="<?= e($track['spotify_url'] ?? '#') ?>">Spotify</a>
            <a href="<?= e($track['apple_url'] ?? '#') ?>">Apple</a>
            <a href="<?= e($track['youtube_url'] ?? '#') ?>">YouTube</a>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>

    <div class="cta-row reveal" style="margin-top: 2.5rem;">
      <a class="btn-mangie" href="#" target="_blank" rel="noopener">Ouvrir sur Spotify</a>
      <a class="btn-mangie btn-mangie-ghost" href="contact.php">Licensing &amp; sync</a>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="split">
      <div class="split-media photo-frame reveal">
        <div class="photo-crop">
          <img src="assets/img/angela-live.jpeg" alt="Angela Volcimus Louis au micro, pull bordeaux" class="img-live">
        </div>
      </div>
      <div class="split-content reveal reveal-delay-1">
        <p class="eyebrow">Interprétation</p>
        <h2 class="display display-md">La voix avant tout</h2>
        <p>Chaque titre est pensé pour la scène autant que pour l’écoute intime — un souffle, une phrase, une montée.</p>
        <p>Le gospel porte l’élan, le classique la ligne, le R&amp;B la chaleur. Ici, tout se rejoint.</p>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="genre-strip reveal">
      <div class="genre-item">
        <h3>Pour les fans</h3>
        <p>Playlists, lives acoustiques et sessions gospel exclusives à venir.</p>
      </div>
      <div class="genre-item">
        <h3>Pour les pros</h3>
        <p>Catalogues disponibles pour film, pub, cérémonies et événements.</p>
      </div>
      <div class="genre-item">
        <h3>Pour la scène</h3>
        <p>Setlists modulables : intimate set, full band, ou récital classique.</p>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
