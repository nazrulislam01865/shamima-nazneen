(() => {
  'use strict';

  const body = document.body;
  const defaultImageFallback = body.dataset.imageFallbackText || 'Image is not available.';

  const showImageFallback = (image) => {
    if (!image || image.dataset.noFallback !== undefined || image.dataset.fallbackApplied === '1') return;
    image.dataset.fallbackApplied = '1';
    image.hidden = true;

    let fallback = image.nextElementSibling;
    if (!fallback?.classList.contains('media-fallback')) {
      fallback = document.createElement('span');
      fallback.className = 'media-fallback';
      image.insertAdjacentElement('afterend', fallback);
    }

    fallback.textContent = image.dataset.fallbackText || image.alt || defaultImageFallback;
    fallback.classList.add('is-visible');
  };

  document.querySelectorAll('img:not([data-no-fallback])').forEach((image) => {
    image.addEventListener('error', () => showImageFallback(image), { once: true });
    if (!image.getAttribute('src') || (image.complete && image.naturalWidth === 0)) {
      showImageFallback(image);
    }
  });

  document.querySelectorAll('[data-safe-background]').forEach((element) => {
    const source = element.dataset.safeBackground;
    const fallback = element.querySelector('[data-background-fallback]');
    if (!source) {
      fallback?.classList.add('is-visible');
      return;
    }

    const probe = new Image();
    probe.onload = () => {
      element.style.backgroundImage = `url(${JSON.stringify(source)})`;
      fallback?.classList.remove('is-visible');
    };
    probe.onerror = () => fallback?.classList.add('is-visible');
    probe.src = source;
  });

  document.querySelectorAll('a[href^="#"]').forEach((link) => {
    link.addEventListener('click', (event) => {
      const selector = link.getAttribute('href');
      if (!selector || selector === '#') return;
      const target = document.querySelector(selector);
      if (!target) return;
      event.preventDefault();
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      document.querySelector('.navlinks')?.classList.remove('open');
      document.querySelector('.mobile-nav-toggle')?.setAttribute('aria-expanded', 'false');
    });
  });

  const navToggle = document.querySelector('.mobile-nav-toggle');
  const nav = document.querySelector('.navlinks');
  navToggle?.addEventListener('click', () => {
    const open = nav?.classList.toggle('open') ?? false;
    navToggle.setAttribute('aria-expanded', String(open));
  });

  document.addEventListener('click', (event) => {
    if (!nav?.classList.contains('open')) return;
    if (nav.contains(event.target) || navToggle?.contains(event.target)) return;
    nav.classList.remove('open');
    navToggle?.setAttribute('aria-expanded', 'false');
  });

  document.querySelectorAll('[data-slider]').forEach((slider) => {
    const slides = Array.from(slider.querySelectorAll('[data-slide]'));
    if (slides.length < 2) return;
    let index = Math.max(0, slides.findIndex((slide) => slide.classList.contains('active')));
    window.setInterval(() => {
      slides[index].classList.remove('active');
      index = (index + 1) % slides.length;
      slides[index].classList.add('active');
    }, 6000);
  });

  document.querySelectorAll('[data-testimonial-slider]').forEach((slider) => {
    const slides = Array.from(slider.querySelectorAll('[data-testimonial-slide]'));
    const dots = Array.from(slider.querySelectorAll('[data-testimonial-dot]'));
    const previous = slider.querySelector('[data-testimonial-prev]');
    const next = slider.querySelector('[data-testimonial-next]');
    if (slides.length < 2) return;

    let index = Math.max(0, slides.findIndex((slide) => slide.classList.contains('active')));
    let timer = null;

    const show = (newIndex) => {
      index = (newIndex + slides.length) % slides.length;
      slides.forEach((slide, slideIndex) => {
        const active = slideIndex === index;
        slide.classList.toggle('active', active);
        slide.setAttribute('aria-hidden', String(!active));
      });
      dots.forEach((dot, dotIndex) => dot.classList.toggle('active', dotIndex === index));
    };

    const restart = () => {
      if (timer) window.clearInterval(timer);
      if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
      timer = window.setInterval(() => show(index + 1), 6500);
    };

    previous?.addEventListener('click', () => { show(index - 1); restart(); });
    next?.addEventListener('click', () => { show(index + 1); restart(); });
    dots.forEach((dot) => dot.addEventListener('click', () => { show(Number(dot.dataset.testimonialDot || 0)); restart(); }));
    slider.addEventListener('mouseenter', () => timer && window.clearInterval(timer));
    slider.addEventListener('mouseleave', restart);
    slider.addEventListener('focusin', () => timer && window.clearInterval(timer));
    slider.addEventListener('focusout', restart);
    restart();
  });

  const modal = document.getElementById('workModal');
  const closeModalButton = modal?.querySelector('.close-modal');
  let modalReturnFocus = null;

  const setText = (id, value) => {
    const element = document.getElementById(id);
    if (element) element.textContent = value || '—';
  };

  const closeWorkModal = () => {
    if (!modal) return;
    modal.classList.remove('active');
    modal.setAttribute('aria-hidden', 'true');
    body.classList.remove('modal-open');
    modalReturnFocus?.focus?.();
  };

  document.querySelectorAll('.work-detail-trigger').forEach((button) => {
    button.addEventListener('click', () => {
      if (!modal) return;
      modalReturnFocus = button;
      const data = button.dataset;
      const detailContainer = button.parentElement;
      const descriptionTemplate = detailContainer?.querySelector('template[data-work-description]')
        || (data.descriptionTemplate ? document.getElementById(data.descriptionTemplate) : null);
      const linksTemplate = detailContainer?.querySelector('template[data-work-links]');
      const modalHero = document.getElementById('modalHero');
      const modalHeroFallback = document.getElementById('modalHeroFallback');
      if (modalHero) {
        modalHero.style.backgroundImage = '';
        if (modalHeroFallback) modalHeroFallback.textContent = data.imageFallback || defaultImageFallback;
        modalHeroFallback?.classList.remove('is-visible');
        if (data.image) {
          const imageProbe = new Image();
          imageProbe.onload = () => {
            modalHero.style.backgroundImage = `url(${JSON.stringify(data.image)})`;
            modalHeroFallback?.classList.remove('is-visible');
          };
          imageProbe.onerror = () => modalHeroFallback?.classList.add('is-visible');
          imageProbe.src = data.image;
        } else {
          modalHeroFallback?.classList.add('is-visible');
        }
      }
      setText('modalType', data.type);
      setText('modalYear', data.year);
      setText('modalTitle', data.title);
      setText('infoTitle', data.title);
      setText('infoYear', data.year);
      setText('infoType', data.type);
      setText('infoCredit', data.credit);
      setText('infoRole', data.role);
      setText('infoPlatform', data.platform);

      const description = document.getElementById('modalDescription');
      if (description) description.innerHTML = descriptionTemplate?.innerHTML || '<p>No description has been added.</p>';

      const links = document.getElementById('modalLinks');
      if (links) {
        links.replaceChildren();
        if (linksTemplate) {
          links.append(linksTemplate.content.cloneNode(true));
        } else if (data.linkName && data.linkUrl) {
          const anchor = document.createElement('a');
          anchor.href = data.linkUrl;
          if (/^https?:\/\//i.test(data.linkUrl)) {
            anchor.target = '_blank';
            anchor.rel = 'noopener noreferrer';
          }
          anchor.textContent = data.linkName;
          links.append(anchor);
        }
      }

      modal.classList.add('active');
      modal.setAttribute('aria-hidden', 'false');
      body.classList.add('modal-open');
      closeModalButton?.focus();
    });
  });

  closeModalButton?.addEventListener('click', closeWorkModal);
  modal?.addEventListener('click', (event) => {
    if (event.target === modal) closeWorkModal();
  });

  document.querySelectorAll('.media-tab').forEach((tab) => {
    tab.addEventListener('click', () => {
      document.querySelectorAll('.media-tab').forEach((item) => item.classList.remove('active'));
      document.querySelectorAll('.media-panel').forEach((panel) => panel.classList.remove('active'));
      tab.classList.add('active');
      document.getElementById(tab.dataset.tab)?.classList.add('active');
    });
  });

  const worksRoot = document.querySelector('main[data-initial-category]');
  if (worksRoot) {
    const typeButtons = Array.from(document.querySelectorAll('.type-filter'));
    const searchInput = document.getElementById('workSearch');
    const yearFilter = document.getElementById('yearFilter');
    const sortBy = document.getElementById('sortBy');
    const noResults = document.getElementById('noResults');
    let activeType = typeButtons.find((button) => button.classList.contains('active'))?.dataset.type || 'All';

    const allWorkElements = () => Array.from(document.querySelectorAll('.credit-row, .featured-work'));

    const applyFilters = () => {
      const query = (searchInput?.value || '').trim().toLowerCase();
      const decade = yearFilter?.value || 'All Years';
      let visibleRows = 0;

      allWorkElements().forEach((element) => {
        const searchable = [element.dataset.title, element.dataset.credit, element.dataset.platform, element.dataset.type, element.dataset.year]
          .filter(Boolean).join(' ').toLowerCase();
        const typeMatch = activeType === 'All' || element.dataset.type === activeType;
        const yearMatch = decade === 'All Years' || element.dataset.decade === decade;
        const queryMatch = !query || searchable.includes(query);
        const show = typeMatch && yearMatch && queryMatch;
        element.classList.toggle('hide', !show);
        if (show && element.classList.contains('credit-row')) visibleRows += 1;
      });

      document.querySelectorAll('.credit-section').forEach((section) => {
        const rows = Array.from(section.querySelectorAll('.credit-row'));
        section.classList.toggle('hide', !rows.some((row) => !row.classList.contains('hide')));
      });

      noResults?.classList.toggle('active', visibleRows === 0);
    };

    typeButtons.forEach((button) => {
      button.addEventListener('click', () => {
        typeButtons.forEach((item) => item.classList.remove('active'));
        button.classList.add('active');
        activeType = button.dataset.type || 'All';
        const url = new URL(window.location.href);
        if (button.dataset.slug) url.searchParams.set('category', button.dataset.slug);
        else url.searchParams.delete('category');
        window.history.replaceState({}, '', url);
        applyFilters();
      });
    });

    searchInput?.addEventListener('input', applyFilters);
    yearFilter?.addEventListener('change', applyFilters);
    sortBy?.addEventListener('change', () => {
      const mode = sortBy.value;
      document.querySelectorAll('.credit-list').forEach((list) => {
        const rows = Array.from(list.querySelectorAll('.credit-row'));
        rows.sort((a, b) => {
          if (mode === 'az') return (a.dataset.title || '').localeCompare(b.dataset.title || '');
          if (mode === 'category') return (a.dataset.type || '').localeCompare(b.dataset.type || '');
          const aYear = Number(a.dataset.year || 0);
          const bYear = Number(b.dataset.year || 0);
          return mode === 'oldest' ? aYear - bYear : bYear - aYear;
        });
        rows.forEach((row) => list.append(row));
      });
      applyFilters();
    });

    applyFilters();
  }

  const galleryRoot = document.querySelector('main[data-initial-gallery-filter]');
  if (galleryRoot) {
    const buttons = Array.from(document.querySelectorAll('.filter-btn'));
    const cards = Array.from(document.querySelectorAll('.gallery-card'));
    const initial = galleryRoot.dataset.initialGalleryFilter;

    const applyGalleryFilter = (filter) => {
      cards.forEach((card) => {
        const [kind, value] = filter.split(':');
        const show = filter === 'all' || (kind === 'type' && card.dataset.type === value) || (kind === 'category' && card.dataset.category === value);
        card.classList.toggle('hide', !show);
      });
    };

    buttons.forEach((button) => {
      button.addEventListener('click', () => {
        buttons.forEach((item) => item.classList.remove('active'));
        button.classList.add('active');
        applyGalleryFilter(button.dataset.filter || 'all');
      });
    });

    if (initial) {
      const initialButton = buttons.find((button) => button.dataset.filter === `type:${initial}`);
      if (initialButton) {
        buttons.forEach((item) => item.classList.remove('active'));
        initialButton.classList.add('active');
        applyGalleryFilter(initialButton.dataset.filter);
      }
    }

    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightboxImg');
    const lightboxCaption = document.getElementById('lightboxCaption');
    const lightboxDescription = document.getElementById('lightboxDescription');
    const closeLightboxButton = lightbox?.querySelector('.close-lightbox');
    let lightboxReturnFocus = null;

    const closeLightbox = () => {
      if (!lightbox) return;
      lightbox.classList.remove('active');
      lightbox.setAttribute('aria-hidden', 'true');
      body.classList.remove('modal-open');
      if (lightboxImage) lightboxImage.src = '';
      lightboxReturnFocus?.focus?.();
    };

    document.querySelectorAll('.image-gallery-card').forEach((card) => {
      const open = () => {
        if (!lightbox) return;
        lightboxReturnFocus = card;
        const image = card.querySelector('img');
        const title = card.querySelector('h3');
        const description = card.querySelector('.gallery-description');
        if (lightboxImage && image) {
          lightboxImage.src = image.src;
          lightboxImage.alt = image.alt;
        }
        if (lightboxCaption) lightboxCaption.textContent = title?.textContent || image?.alt || 'Gallery image';
        if (lightboxDescription) lightboxDescription.innerHTML = description?.innerHTML || '';
        lightbox.classList.add('active');
        lightbox.setAttribute('aria-hidden', 'false');
        body.classList.add('modal-open');
        closeLightboxButton?.focus();
      };
      card.addEventListener('click', open);
      card.addEventListener('keydown', (event) => {
        if (event.key === 'Enter' || event.key === ' ') {
          event.preventDefault();
          open();
        }
      });
    });

    closeLightboxButton?.addEventListener('click', closeLightbox);
    lightbox?.addEventListener('click', (event) => {
      if (event.target === lightbox) closeLightbox();
    });
  }

  document.addEventListener('keydown', (event) => {
    if (event.key !== 'Escape') return;
    if (modal?.classList.contains('active')) closeWorkModal();
    const lightbox = document.getElementById('lightbox');
    if (lightbox?.classList.contains('active')) lightbox.querySelector('.close-lightbox')?.click();
    nav?.classList.remove('open');
    navToggle?.setAttribute('aria-expanded', 'false');
  });


  const makeButtonBusy = (element) => {
    if (!element || element.dataset.loadingApplied === '1') return;
    element.dataset.loadingApplied = '1';
    element.classList.add('is-loading');
    element.setAttribute('aria-busy', 'true');
    const width = element.getBoundingClientRect().width;
    if (width > 0) element.style.minWidth = `${Math.ceil(width)}px`;
    if (element.matches('button, input[type="submit"]')) element.disabled = true;
  };

  document.addEventListener('submit', (event) => {
    const form = event.target;
    if (!(form instanceof HTMLFormElement)) return;
    if (event.defaultPrevented || !form.checkValidity()) return;

    const submitter = event.submitter || form.querySelector('button[type="submit"], input[type="submit"], .btn[type="submit"]');
    makeButtonBusy(submitter);
  });

  document.querySelectorAll('a.btn, a.nav-cta, a.work-external-link, a.text-link, .modal-links a').forEach((link) => {
    link.addEventListener('click', (event) => {
      if (event.defaultPrevented || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;
      if (link.target === '_blank' || link.hasAttribute('download')) return;
      const href = link.getAttribute('href') || '';
      if (!href || href === '#' || href.startsWith('#') || href.startsWith('javascript:')) return;
      makeButtonBusy(link);
    });
  });

  window.setTimeout(() => {
    document.querySelectorAll('.site-flash').forEach((flash) => flash.remove());
  }, 7000);
})();
