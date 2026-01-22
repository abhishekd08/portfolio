(function () {
  const select = (selector, scope = document) => scope.querySelector(selector);
  const selectAll = (selector, scope = document) => Array.from(scope.querySelectorAll(selector));

  const clamp = (value, min, max) => Math.min(Math.max(value, min), max);

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
      headerBaseBottom: 0
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

    const readMetrics = () => {
      const heroRect = heroTitle.getBoundingClientRect();
      metrics.heroTop = heroRect.top + (window.scrollY || window.pageYOffset);

      const headerRect = header.getBoundingClientRect();
      metrics.headerBaseBottom = headerRect.bottom;
      metrics.initialDistance = Math.max(metrics.heroTop - metrics.headerBaseBottom, 1);
    };

    const update = () => {
      const scrollY = window.scrollY || window.pageYOffset;
      const headerRect = header.getBoundingClientRect();
      header.classList.toggle('is-condensed', scrollY > 50);

      const headerBottomDoc = scrollY + headerRect.bottom;
      const distanceRemaining = metrics.heroTop - headerBottomDoc;
      const shouldHandOff = distanceRemaining <= 0;

      if (shouldHandOff !== handedOff) {
        handedOff = shouldHandOff;
        setHeaderTitleVisibility(handedOff);
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

  const initSectionHighlights = () => {
    const sections = selectAll('[data-section]');
    const navLinks = selectAll('[data-nav-link]');
    if (!sections.length || !navLinks.length) return;

    const linkMap = new Map();
    navLinks.forEach((link) => {
      const id = link.getAttribute('data-nav-link');
      if (!id) return;
      const siblings = linkMap.get(id) || [];
      siblings.push(link);
      linkMap.set(id, siblings);
    });

    const setActive = (id) => {
      if (!id || !linkMap.has(id)) return;
      navLinks.forEach((link) => link.classList.remove('is-active'));
      linkMap.get(id).forEach((link) => link.classList.add('is-active'));
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const sectionId = entry.target.getAttribute('data-section');
          setActive(sectionId);
        }
      });
    }, { threshold: 0.45 });

    sections.forEach((section) => observer.observe(section));
    const initial = sections[0]?.getAttribute('data-section');
    if (initial) {
      setActive(initial);
    }
  };

  const initTimelineFocus = () => {
    const items = selectAll('[data-timeline-item]');
    if (!items.length) return;

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        entry.target.classList.toggle('is-active', entry.isIntersecting);
      });
    }, { rootMargin: '-20% 0px -45% 0px', threshold: 0.25 });

    items.forEach((item) => observer.observe(item));
  };

  const initExperienceCards = () => {
    const cards = selectAll('[data-experience-card]');
    if (!cards.length) return;

    const setExpanded = (card, expanded) => {
      card.classList.toggle('is-expanded', expanded);
      const toggleText = card.querySelector('.pv-experience__toggle-text');
      if (toggleText) {
        toggleText.textContent = expanded ? 'Show less' : 'Read more';
      }
    };

    cards.forEach((card) => {
      const toggleButton = card.querySelector('[data-experience-toggle]');

      const toggle = () => {
        const nextState = !card.classList.contains('is-expanded');
        setExpanded(card, nextState);
      };

      card.addEventListener('click', (event) => {
        if (event.target.closest('[data-experience-toggle]')) {
          return;
        }
        toggle();
      });

      card.addEventListener('keydown', (event) => {
        if (event.key === 'Enter' || event.key === ' ') {
          event.preventDefault();
          toggle();
        }
      });

      if (toggleButton) {
        toggleButton.addEventListener('click', (event) => {
          event.preventDefault();
          event.stopPropagation();
          toggle();
        });
      }
    });
  };

  const initBlogTilt = () => {
    const cards = selectAll('[data-tilt-card]');
    const prefersFinePointer = window.matchMedia('(pointer: fine)').matches;
    if (!cards.length || !prefersFinePointer) return;

    const reset = (card) => {
      card.style.setProperty('--tilt-x', '0deg');
      card.style.setProperty('--tilt-y', '0deg');
    };

    cards.forEach((card) => {
      card.addEventListener('pointermove', (event) => {
        const bounds = card.getBoundingClientRect();
        const ratioX = (event.clientX - bounds.left) / bounds.width;
        const ratioY = (event.clientY - bounds.top) / bounds.height;
        const rotateY = (ratioX - 0.5) * 4;
        const rotateX = (0.5 - ratioY) * 4;
        card.style.setProperty('--tilt-x', `${rotateY}deg`);
        card.style.setProperty('--tilt-y', `${rotateX}deg`);
      });

      card.addEventListener('pointerleave', () => {
        reset(card);
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
    initSectionHighlights();
    initTimelineFocus();
    initExperienceCards();
    initMobileMenu();
    initSmoothScroll();
    initAnimations();
    initBlogTilt();
  });
})();
