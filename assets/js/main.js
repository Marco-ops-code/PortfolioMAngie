(() => {
  "use strict";

  const header = document.querySelector(".site-header");
  const reveals = document.querySelectorAll(".reveal");
  const playButtons = document.querySelectorAll("[data-play]");

  /* Header shrink / glass on scroll */
  const onScroll = () => {
    if (!header) return;
    header.classList.toggle("is-scrolled", window.scrollY > 24);
  };
  onScroll();
  window.addEventListener("scroll", onScroll, { passive: true });

  /* Scroll reveal */
  if ("IntersectionObserver" in window && reveals.length) {
    const io = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("is-visible");
            io.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.16, rootMargin: "0px 0px -40px 0px" }
    );
    reveals.forEach((el) => io.observe(el));
  } else {
    reveals.forEach((el) => el.classList.add("is-visible"));
  }

  /* Track play UI (demo — branche un <audio> réel si besoin) */
  playButtons.forEach((btn) => {
    btn.addEventListener("click", () => {
      const wasPlaying = btn.classList.contains("is-playing");
      playButtons.forEach((b) => {
        b.classList.remove("is-playing");
        b.setAttribute("aria-pressed", "false");
        b.innerHTML = playIcon();
      });
      if (!wasPlaying) {
        btn.classList.add("is-playing");
        btn.setAttribute("aria-pressed", "true");
        btn.innerHTML = pauseIcon();
      }
    });
  });

  function playIcon() {
    return `<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>`;
  }

  function pauseIcon() {
    return `<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 5h4v14H6zm8 0h4v14h-4z"/></svg>`;
  }

  /* Close mobile nav after click */
  document.querySelectorAll("#mainNav .nav-link").forEach((link) => {
    link.addEventListener("click", () => {
      const collapse = document.getElementById("mainNav");
      if (collapse && collapse.classList.contains("show") && window.bootstrap) {
        const inst = bootstrap.Collapse.getInstance(collapse);
        if (inst) inst.hide();
      }
    });
  });
})();
