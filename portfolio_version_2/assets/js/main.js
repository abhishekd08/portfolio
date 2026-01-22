(function () {
  const select = (selector, scope = document) => scope.querySelector(selector);
  const selectAll = (selector, scope = document) => Array.from(scope.querySelectorAll(selector));

  const clamp = (value, min, max) => Math.min(Math.max(value, min), max);

  const toNumber = (value, fallback) => {
    const parsed = parseFloat(value);
    return Number.isNaN(parsed) ? fallback : parsed;
  };

  const storage = {
    get(key) {
      try {
        return window.localStorage.getItem(key);
      } catch (err) {
        return null;
      }
    },
    set(key, value) {
      try {
        window.localStorage.setItem(key, value);
      } catch (err) {
        /* noop */
      }
    }
  };

  const applyTheme = (isDark) => {
    document.body.classList.toggle('pv-dark', isDark);
  };

  const initThemeToggle = () => {
    const themeToggle = select('[data-theme-toggle]');
    if (!themeToggle) return;

    const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
    const stored = storage.get('pv-theme');
    let isDark = stored ? stored === 'dark' : mediaQuery.matches;

    applyTheme(isDark);

    themeToggle.addEventListener('click', () => {
      isDark = !isDark;
      applyTheme(isDark);
      storage.set('pv-theme', isDark ? 'dark' : 'light');
    });

    const handleMediaChange = (event) => {
      const remembered = storage.get('pv-theme');
      if (!remembered) {
        applyTheme(event.matches);
      }
    };

    if (typeof mediaQuery.addEventListener === 'function') {
      mediaQuery.addEventListener('change', handleMediaChange);
    } else if (typeof mediaQuery.addListener === 'function') {
      mediaQuery.addListener(handleMediaChange);
    }
  };

  const initScrollEffects = () => {
    const header = select('[data-header]');
    const heroTitle = select('[data-hero-title]');
    const headerTitle = select('[data-header-title]');

    if (!header || !heroTitle) {
      return;
    }

    const metrics = {
      heroTop: 0,
      initialDistance: 1,
      headerBaseBottom: 0,
      fontStart: 96,
      letterStart: -2,
      fontEnd: 24,
      letterEnd: 0
    };

    let handedOff = false;
    let headerTitleVisible = false;

    const setHeaderTitleVisibility = (visible) => {
      if (!headerTitle || headerTitleVisible === visible) {
        return;
      }
      headerTitleVisible = visible;
      headerTitle.classList.toggle('is-visible', visible);
      headerTitle.setAttribute('aria-hidden', visible ? 'false' : 'true');
    };

    const applyHeroStyles = (progress) => {
      const fontSize = metrics.fontStart + (metrics.fontEnd - metrics.fontStart) * progress;
      const letterSpacing = metrics.letterStart + (metrics.letterEnd - metrics.letterStart) * progress;
      heroTitle.style.fontSize = `${fontSize}px`;
      heroTitle.style.letterSpacing = `${letterSpacing}px`;
    };

    const readMetrics = () => {
      const previousFont = heroTitle.style.fontSize;
      const previousLetter = heroTitle.style.letterSpacing;
      heroTitle.style.fontSize = '';
      heroTitle.style.letterSpacing = '';

      const heroRect = heroTitle.getBoundingClientRect();
      metrics.heroTop = heroRect.top + (window.scrollY || window.pageYOffset);

      const heroStyles = window.getComputedStyle(heroTitle);
      metrics.fontStart = toNumber(heroStyles.fontSize, metrics.fontStart);
      metrics.letterStart = toNumber(heroStyles.letterSpacing, metrics.letterStart);

      heroTitle.style.fontSize = previousFont;
      heroTitle.style.letterSpacing = previousLetter;

      const headerRect = header.getBoundingClientRect();
      metrics.headerBaseBottom = headerRect.bottom;
      metrics.initialDistance = Math.max(metrics.heroTop - metrics.headerBaseBottom, 1);

      if (headerTitle) {
        const headerStyles = window.getComputedStyle(headerTitle);
        metrics.fontEnd = toNumber(headerStyles.fontSize, metrics.fontEnd);
        metrics.letterEnd = toNumber(headerStyles.letterSpacing, metrics.letterEnd);
      }
    };

    const update = () => {
      const scrollY = window.scrollY || window.pageYOffset;
      const headerRect = header.getBoundingClientRect();
      header.classList.toggle('is-condensed', scrollY > 50);

      const headerBottomDoc = scrollY + headerRect.bottom;
      const distanceRemaining = metrics.heroTop - headerBottomDoc;
      const progressRaw = 1 - distanceRemaining / metrics.initialDistance;
      const progress = clamp(progressRaw, 0, 1);

      const shouldHandOff = distanceRemaining <= 0;

      if (shouldHandOff !== handedOff) {
        handedOff = shouldHandOff;
        heroTitle.classList.toggle('is-handed-off', handedOff);
        if (handedOff) {
          heroTitle.style.fontSize = `${metrics.fontEnd}px`;
          heroTitle.style.letterSpacing = `${metrics.letterEnd}px`;
        }
        setHeaderTitleVisibility(handedOff);
      }

      if (!handedOff) {
        applyHeroStyles(progress);
      }
    };

    readMetrics();
    update();
    window.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', () => {
      readMetrics();
      update();
    });
    window.addEventListener('load', () => {
      readMetrics();
      update();
    });
  };

  const initMobileMenu = () => {
    const openButton = select('[data-mobile-open]');
    const closeButton = select('[data-mobile-close]');
    const panel = select('[data-mobile-panel]');
    const overlay = select('[data-mobile-overlay]');

    if (!panel || !overlay) return;

    const toggle = (force) => {
      const willOpen = typeof force === 'boolean' ? force : !panel.classList.contains('is-visible');
      panel.classList.toggle('is-visible', willOpen);
      overlay.classList.toggle('is-visible', willOpen);
      document.body.classList.toggle('pv-menu-open', willOpen);
    };

    openButton && openButton.addEventListener('click', () => toggle(true));
    closeButton && closeButton.addEventListener('click', () => toggle(false));
    overlay.addEventListener('click', () => toggle(false));

    selectAll('[data-scroll-link]', panel).forEach((link) => {
      link.addEventListener('click', () => toggle(false));
    });
  };

  const initSmoothScroll = () => {
    const links = selectAll('[data-scroll-link]');
    if (!links.length) return;

    links.forEach((link) => {
      link.addEventListener('click', (event) => {
        const targetId = link.getAttribute('href');
        if (targetId && targetId.startsWith('#')) {
          const target = document.querySelector(targetId);
          if (target) {
            event.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
          }
        }
      });
    });
  };

  const initAnimations = () => {
    const items = selectAll('[data-animate]');
    if (!items.length) return;

    if (!('IntersectionObserver' in window)) {
      items.forEach((item) => item.classList.add('is-visible'));
      return;
    }

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.2 });

    items.forEach((item) => observer.observe(item));
  };

  document.addEventListener('DOMContentLoaded', () => {
    initThemeToggle();
    initScrollEffects();
    initMobileMenu();
    initSmoothScroll();
    initAnimations();
  });
})();
