<?php
$pageTitle = 'Booking & Contact';
$pageDescription = 'Contactez Angela Volcimus Louis pour un booking, une collaboration ou un message fan.';
require_once __DIR__ . '/includes/header.php';

$flash = getFlash();
?>

<section class="page-hero">
  <div class="container">
    <p class="eyebrow reveal">Contact</p>
    <h1 class="display display-lg reveal">Booking &amp; messages</h1>
    <p class="lede reveal">Concerts, collaborations, presse — écrivez à l’équipe d’Angela Volcimus Louis.</p>
  </div>
</section>

<section class="section" style="padding-top: 0;">
  <div class="container">
    <div class="contact-layout">
      <aside class="contact-info reveal">
        <p>Pour une demande de date, précisez le format souhaité, la ville, la jauge et la période. Réponse sous 48 à 72 h.</p>

        <div class="contact-detail">
          <span>Booking</span>
          <strong><?= e(SITE_EMAIL) ?></strong>
        </div>
        <div class="contact-detail">
          <span>Presse</span>
          <strong><?= e(SITE_EMAIL_PRESS) ?></strong>
        </div>
        <div class="contact-detail">
          <span>Basée</span>
          <strong>Bruxelles · Belgique</strong>
        </div>
      </aside>

        <div class="form-frame reveal reveal-delay-1">
        <?php if ($flash): ?>
          <div class="alert-mangie" role="status"><?= e($flash['message']) ?></div>
        <?php endif; ?>

        <form class="form-mangie" action="process_contact.php" method="post" novalidate>
          <div class="row g-4">
            <div class="col-md-6">
              <label class="form-label" for="name">Nom</label>
              <input class="form-control" type="text" id="name" name="name" required autocomplete="name">
            </div>
            <div class="col-md-6">
              <label class="form-label" for="email">Email</label>
              <input class="form-control" type="email" id="email" name="email" required autocomplete="email">
            </div>
            <div class="col-md-6">
              <label class="form-label" for="type">Type de demande</label>
              <select class="form-select" id="type" name="type" required>
                <option value="booking">Booking / Concert</option>
                <option value="press">Presse / Médias</option>
                <option value="fan">Message fan</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="subject">Sujet</label>
              <input class="form-control" type="text" id="subject" name="subject" required>
            </div>
            <div class="col-12">
              <label class="form-label" for="message">Message</label>
              <textarea class="form-control" id="message" name="message" required placeholder="Décrivez votre projet, date, lieu, format…"></textarea>
            </div>
            <div class="col-12">
              <button class="btn-mangie" type="submit">Envoyer le message</button>
            </div>
          </div>
        </form>
        </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
