<?php
$pageTitle = 'Musique';
$pageDescription = 'Écoutez Angela Volcimus Louis — R&B, classique et gospel.';
require_once __DIR__ . '/includes/header.php';

$tracks = getTracks();
$featured = $tracks[0] ?? null;
?>

<section class="page-hero">
  <div class="container">
    <p class="eyebrow reveal">Salle d’écoute</p>
    <h1 class="display display-lg reveal">Musique</h1>
    <p class="lede reveal">Une voix, trois couleurs. Choisissez un titre — ou laissez-vous porter.</p>
  </div>
</section>

<?php if ($featured): ?>
<section class="section section-listen" style="padding-top: 0;">
  <div class="container">
    <div class="listen-stage reveal">
      <div class="album-stage" aria-hidden="true">
        <div class="vinyl"></div>
        <div class="album-cover">
          <img src="assets/img/angela-live.jpeg" alt="" class="img-live">
        </div>
      </div>

      <div class="listen-copy">
        <p class="eyebrow">Projet</p>
        <h2 class="display display-md">Lumière Intérieure</h2>
        <p class="lede">Clair-obscur vocal : prière gospel, ligne classique, chaleur R&amp;B.</p>

        <div class="now-playing" data-now-playing>
          <button class="btn-listen" type="button" data-play data-track-id="<?= (int) $featured['id'] ?>" aria-label="Écouter <?= e($featured['title']) ?>" aria-pressed="false">
            <span class="btn-listen-disc">
              <svg viewBox="0 0 24 24"><path d="M8.4 6.2v11.6L18.2 12Z"/></svg>
            </span>
          </button>
          <div>
            <p class="now-playing-label">À écouter</p>
            <p class="now-playing-title"><?= e($featured['title']) ?></p>
            <p class="now-playing-meta"><?= e($featured['genre']) ?> · <?= e($featured['duration'] ?? '') ?></p>
          </div>
        </div>

        <div class="listen-platforms">
          <a href="<?= e($featured['spotify_url'] ?? '#') ?>">Spotify</a>
          <a href="<?= e($featured['apple_url'] ?? '#') ?>">Apple Music</a>
          <a href="<?= e($featured['youtube_url'] ?? '#') ?>">YouTube</a>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="section" style="padding-top: 0;">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow">Titres</p>
      <h2 class="display display-md">La sélection</h2>
    </div>

    <div class="music-filters reveal" role="tablist" aria-label="Filtrer par univers">
      <button type="button" class="music-filter is-on" data-filter="all">Tous</button>
      <button type="button" class="music-filter" data-filter="rnb">R&amp;B</button>
      <button type="button" class="music-filter" data-filter="classique">Classique</button>
      <button type="button" class="music-filter" data-filter="gospel">Gospel</button>
    </div>

    <ul class="track-list">
      <?php foreach ($tracks as $i => $track):
        $genreKey = strtolower($track['genre'] ?? '');
        $filters = [];
        if (str_contains($genreKey, 'r&b') || str_contains($genreKey, 'rnb') || str_contains($genreKey, 'soul')) {
            $filters[] = 'rnb';
        }
        if (str_contains($genreKey, 'classique')) {
            $filters[] = 'classique';
        }
        if (str_contains($genreKey, 'gospel')) {
            $filters[] = 'gospel';
        }
        ?>
        <li class="track-item reveal <?= $i === 0 ? 'is-current' : '' ?>" data-genres="<?= e(implode(' ', $filters)) ?>">
          <button class="play-btn" type="button" data-play data-track-id="<?= (int) $track['id'] ?>" aria-label="Écouter <?= e($track['title']) ?>" aria-pressed="false">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
          </button>
          <div class="track-meta">
            <h3><?= e($track['title']) ?></h3>
            <p><?= e($track['genre']) ?></p>
          </div>
          <span class="track-duration"><?= e($track['duration'] ?? '') ?></span>
          <div class="track-links">
            <a href="<?= e($track['spotify_url'] ?? '#') ?>">Spotify</a>
            <a href="<?= e($track['apple_url'] ?? '#') ?>">Apple</a>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<section class="section" style="padding-top: 0;">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow">Trois portes</p>
      <h2 class="display display-md">Par où entrer</h2>
      <p class="lede">Chaque univers a son titre. Commencez par celui qui vous appelle.</p>
    </div>

    <div class="listen-doors">
      <button type="button" class="listen-door reveal" data-filter="rnb">
        <span class="listen-door-kicker">R&amp;B</span>
        <strong>Midnight Honey</strong>
        <span>Groove velours, confession nocturne.</span>
      </button>
      <button type="button" class="listen-door reveal reveal-delay-1" data-filter="classique">
        <span class="listen-door-kicker">Classique</span>
        <strong>Aria of Silence</strong>
        <span>Ligne vocale, silence tenu.</span>
      </button>
      <button type="button" class="listen-door reveal reveal-delay-2" data-filter="gospel">
        <span class="listen-door-kicker">Gospel</span>
        <strong>Velvet Prayer</strong>
        <span>Élan, lumière, voix ouverte.</span>
      </button>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="split">
      <div class="split-media photo-frame reveal">
        <div class="photo-crop">
          <img src="assets/img/angela-gospel.jpeg" alt="Angela Volcimus Louis en performance gospel" class="img-gospel">
        </div>
      </div>
      <div class="split-content reveal reveal-delay-1">
        <p class="eyebrow">Sur scène comme en écoute</p>
        <h2 class="display display-md">La voix avant tout</h2>
        <p>Chaque titre est pensé pour la scène autant que pour l’écoute intime — un souffle, une phrase, une montée.</p>
        <div class="cta-row">
          <a class="btn-mangie" href="concerts.php">Voir les dates</a>
          <a class="btn-mangie btn-mangie-ghost" href="contact.php">Licensing</a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
