<?php
$pageTitle = 'Galerie';
$pageDescription = 'Galerie photo d’Angela Volcimus Louis — scène, studio et portraits.';
require_once __DIR__ . '/includes/header.php';

$items = [
    ['title' => 'Portrait', 'src' => 'assets/img/angela-portrait.jpeg', 'alt' => 'Portrait d’Angela Volcimus Louis', 'pos' => 'img-face'],
    ['title' => 'Live — scène', 'src' => 'assets/img/angela-scene.jpeg', 'alt' => 'Angela Volcimus Louis en concert', 'pos' => 'img-scene'],
    ['title' => 'Gospel', 'src' => 'assets/img/angela-gospel.jpeg', 'alt' => 'Angela Volcimus Louis en performance gospel', 'pos' => 'img-gospel'],
    ['title' => 'Voix & présence', 'src' => 'assets/img/angela-live.jpeg', 'alt' => 'Angela Volcimus Louis au micro', 'pos' => 'img-live'],
];
?>

<section class="page-hero">
  <div class="container">
    <p class="eyebrow reveal">Visuels</p>
    <h1 class="display display-lg reveal">Galerie</h1>
    <p class="lede reveal">Scène, studio, portraits — l’atmosphère d’Angela Volcimus Louis en images.</p>
  </div>
</section>

<section class="section" style="padding-top: 0;">
  <div class="container">
    <div class="gallery-grid">
      <?php foreach ($items as $i => $item): ?>
        <figure class="gallery-item photo-frame reveal <?= $i % 3 === 1 ? 'reveal-delay-1' : ($i % 3 === 2 ? 'reveal-delay-2' : '') ?>">
          <div class="photo-crop">
            <img src="<?= e($item['src']) ?>" alt="<?= e($item['alt']) ?>" class="<?= e($item['pos']) ?>">
          </div>
          <figcaption class="gallery-caption"><?= e($item['title']) ?></figcaption>
        </figure>
      <?php endforeach; ?>
    </div>

    <div class="cta-row reveal" style="margin-top: 2.5rem;">
      <a class="btn-mangie" href="contact.php">Demande presse / photos</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
