</main>

  <footer class="site-footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <p class="footer-name"><?= e(SITE_NAME) ?></p>
          <p class="footer-tag"><?= e(SITE_TAGLINE) ?></p>
        </div>

        <div class="footer-links">
          <a href="music.php">Écouter</a>
          <a href="concerts.php">Dates</a>
          <a href="about.php">Biographie</a>
          <a href="contact.php">Contact</a>
        </div>

        <div class="footer-social">
          <a href="#" aria-label="Instagram">Instagram</a>
          <a href="#" aria-label="YouTube">YouTube</a>
          <a href="#" aria-label="Spotify">Spotify</a>
          <a href="#" aria-label="Apple Music">Apple Music</a>
        </div>
      </div>

      <div class="footer-bottom">
        <p>&copy; <?= date('Y') ?> <?= e(SITE_NAME) ?>. Tous droits réservés.</p>
        <a href="admin/index.php" class="footer-admin">Espace artiste</a>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>
</html>
