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

  /* Track play UI */
  playButtons.forEach((btn) => {
    btn.addEventListener("click", () => {
      const wasPlaying = btn.classList.contains("is-playing");
      const id = btn.getAttribute("data-track-id");
      playButtons.forEach((b) => {
        b.classList.remove("is-playing");
        b.setAttribute("aria-pressed", "false");
        b.innerHTML = b.classList.contains("btn-listen") ? listenPlay() : playIcon();
      });
      document.querySelectorAll(".track-item").forEach((row) => row.classList.remove("is-current"));
      if (!wasPlaying) {
        playButtons.forEach((b) => {
          if (id && b.getAttribute("data-track-id") === id) {
            b.classList.add("is-playing");
            b.setAttribute("aria-pressed", "true");
            b.innerHTML = b.classList.contains("btn-listen") ? listenPause() : pauseIcon();
          }
        });
        document.querySelectorAll(".track-item").forEach((row) => {
          const play = row.querySelector("[data-play]");
          if (id && play && play.getAttribute("data-track-id") === id) {
            row.classList.add("is-current");
          }
        });
      }
    });
  });

  function listenPlay() {
    return `<span class="btn-listen-disc"><svg viewBox="0 0 24 24"><path d="M8.4 6.2v11.6L18.2 12Z"/></svg></span>`;
  }

  function listenPause() {
    return `<span class="btn-listen-disc"><svg viewBox="0 0 24 24"><path d="M6 5h4v14H6zm8 0h4v14h-4z"/></svg></span>`;
  }

  /* Genre filters */
  const filters = document.querySelectorAll(".music-filter, .listen-door");
  const rows = document.querySelectorAll(".track-item[data-genres]");

  const applyFilter = (key) => {
    document.querySelectorAll(".music-filter").forEach((btn) => {
      btn.classList.toggle("is-on", btn.getAttribute("data-filter") === key);
    });
    rows.forEach((row) => {
      const genres = (row.getAttribute("data-genres") || "").split(/\s+/);
      const show = key === "all" || genres.includes(key);
      row.hidden = !show;
    });
    if (key !== "all") {
      document.querySelector(".track-list")?.scrollIntoView({ behavior: "smooth", block: "start" });
    }
  };

  filters.forEach((btn) => {
    btn.addEventListener("click", () => applyFilter(btn.getAttribute("data-filter") || "all"));
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
