/* ============================================
   DGIE — JavaScript principal
   Animations, interactions, micro-feedbacks
   ============================================ */

/* --- Preloader + Modal événement --- */
/* Safety timeout: hide preloader after 4s even if load hasn't fired */
setTimeout(function () {
  var preloader = document.getElementById('preloader');
  if (preloader && !preloader.classList.contains('hidden')) {
    preloader.classList.add('hidden');
    setTimeout(function () { preloader.remove(); }, 500);
  }
}, 4000);

window.addEventListener('load', function () {
  var preloader = document.getElementById('preloader');
  if (preloader) {
    preloader.classList.add('hidden');
    setTimeout(function () { preloader.remove(); }, 500);
  }

  // Modal événement — s'affiche une fois par session
  var modal = document.getElementById('welcomeModal');
  if (modal && !sessionStorage.getItem('welcomeModalSeen')) {
    setTimeout(function () {
      modal.classList.add('open');
    }, 800);

    var closeModal = function () {
      modal.classList.remove('open');
      sessionStorage.setItem('welcomeModalSeen', '1');
    };

    var closeBtn = document.getElementById('welcomeModalClose');
    var backdrop = document.getElementById('welcomeModalBackdrop');
    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    if (backdrop) backdrop.addEventListener('click', closeModal);

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && modal.classList.contains('open')) {
        closeModal();
      }
    });
  }
});

document.addEventListener('DOMContentLoaded', function () {

  /* --- Menu mobile --- */
  const navToggle = document.getElementById('navToggle');
  const nav = document.getElementById('nav');

  if (navToggle && nav) {
    navToggle.setAttribute('aria-expanded', 'false');
    navToggle.addEventListener('click', function () {
      navToggle.classList.toggle('active');
      nav.classList.toggle('open');
      var expanded = nav.classList.contains('open');
      navToggle.setAttribute('aria-expanded', String(expanded));
    });

    nav.querySelectorAll('.nav__link').forEach(function (link) {
      link.addEventListener('click', function () {
        navToggle.classList.remove('active');
        nav.classList.remove('open');
      });
    });
  }

  /* --- FAQ Accordeon --- */
  document.querySelectorAll('.faq__question').forEach(function (btn) {
    btn.setAttribute('aria-expanded', 'false');
    btn.addEventListener('click', function () {
      const item = btn.closest('.faq__item');
      const answer = item.querySelector('.faq__answer');
      const isOpen = item.classList.contains('active');

      item.closest('.faq').querySelectorAll('.faq__item').forEach(function (other) {
        if (other !== item) {
          other.classList.remove('active');
          other.querySelector('.faq__answer').style.maxHeight = null;
          other.querySelector('.faq__question').setAttribute('aria-expanded', 'false');
        }
      });

      if (isOpen) {
        item.classList.remove('active');
        answer.style.maxHeight = null;
        btn.setAttribute('aria-expanded', 'false');
      } else {
        item.classList.add('active');
        answer.style.maxHeight = answer.scrollHeight + 'px';
        btn.setAttribute('aria-expanded', 'true');
      }
    });
  });

  /* --- Filtres actualites --- */
  const filterBtns = document.querySelectorAll('.filter-btn');
  const newsItems = document.querySelectorAll('[data-category]');

  if (filterBtns.length > 0) {
    filterBtns.forEach(function (btn) {
      btn.addEventListener('click', function () {
        filterBtns.forEach(function (b) { b.classList.remove('active'); });
        btn.classList.add('active');

        var filter = btn.getAttribute('data-filter');

        newsItems.forEach(function (item) {
          if (filter === 'tous' || item.getAttribute('data-category') === filter) {
            item.style.display = '';
          } else {
            item.style.display = 'none';
          }
        });
      });
    });
  }

  /* --- Formulaire de contact --- */
  const contactForm = document.getElementById('contactForm');

  if (contactForm) {
    contactForm.addEventListener('submit', function (e) {
      e.preventDefault();

      var valid = true;
      contactForm.querySelectorAll('[required]').forEach(function (field) {
        if (!field.value.trim()) {
          valid = false;
          field.style.borderColor = '#e53e3e';
        } else {
          field.style.borderColor = '';
        }
      });

      var emailField = contactForm.querySelector('input[type="email"]');
      if (emailField && emailField.value) {
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(emailField.value)) {
          valid = false;
          emailField.style.borderColor = '#e53e3e';
        }
      }

      if (valid) {
        contactForm.style.display = 'none';
        var successMsg = document.querySelector('.form__success');
        if (successMsg) {
          successMsg.classList.add('visible');
        }
      }
    });
  }

  /* --- Scroll header shadow --- */
  var header = document.querySelector('.header');
  var backToTop = document.getElementById('backToTop');

  if (header || backToTop) {
    window.addEventListener('scroll', function () {
      var scrollY = window.scrollY;

      if (header) {
        if (scrollY > 10) {
          header.classList.add('header--scrolled');
        } else {
          header.classList.remove('header--scrolled');
        }
      }

      if (backToTop) {
        if (scrollY > 400) {
          backToTop.classList.add('visible');
        } else {
          backToTop.classList.remove('visible');
        }
      }
    });
  }

  /* --- Back to top --- */
  if (backToTop) {
    backToTop.addEventListener('click', function () {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  /* --- Search toggle --- */
  var searchToggle = document.getElementById('searchToggle');
  var searchBox = document.getElementById('searchBox');
  var searchInput = document.getElementById('searchInput');

  if (searchToggle && searchBox) {
    searchToggle.setAttribute('aria-expanded', 'false');
    searchToggle.addEventListener('click', function () {
      searchBox.classList.toggle('open');
      var isOpen = searchBox.classList.contains('open');
      searchToggle.setAttribute('aria-expanded', String(isOpen));
      if (isOpen && searchInput) {
        searchInput.focus();
      }
    });

    document.addEventListener('click', function (e) {
      if (!e.target.closest('.header__search')) {
        searchBox.classList.remove('open');
        searchToggle.setAttribute('aria-expanded', 'false');
      }
    });
  }

  /* --- Stats Counter Animation --- */
  var counters = document.querySelectorAll('.stats-counter__number');
  if (counters.length > 0 && 'IntersectionObserver' in window) {
    var counterObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          var target = entry.target;
          var end = parseInt(target.getAttribute('data-count'), 10);
          var duration = 2000;
          var start = 0;
          var startTime = null;

          function animate(timestamp) {
            if (!startTime) startTime = timestamp;
            var progress = Math.min((timestamp - startTime) / duration, 1);
            var eased = 1 - Math.pow(1 - progress, 3);
            var current = Math.floor(eased * end);
            target.textContent = current.toLocaleString('fr-FR');
            var suffix = target.getAttribute('data-suffix');
            if (suffix) target.textContent += suffix;
            if (progress < 1) {
              requestAnimationFrame(animate);
            }
          }
          requestAnimationFrame(animate);
          counterObserver.unobserve(target);
        }
      });
    }, { threshold: 0.3 });

    counters.forEach(function (el) {
      counterObserver.observe(el);
    });
  }

  /* --- Scroll Reveal Animations --- */
  var animateElements = document.querySelectorAll(
    '.animate-on-scroll, .section-title, .articles-grid .article-card, .sidebar > *'
  );

  if (animateElements.length > 0 && 'IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('animated');
          observer.unobserve(entry.target);
        }
      });
    }, {
      threshold: 0.1,
      rootMargin: '0px 0px -40px 0px'
    });

    animateElements.forEach(function (el) {
      observer.observe(el);
    });
  } else {
    // Fallback: rendre tout visible si IntersectionObserver non supporte
    animateElements.forEach(function (el) {
      el.classList.add('animated');
    });
  }

  /* --- Calendrier sidebar --- */
  var calGrid = document.getElementById('calGrid');
  var calMonth = document.getElementById('calMonth');
  var calPrev = document.getElementById('calPrev');
  var calNext = document.getElementById('calNext');
  var calEvent = document.getElementById('calEvent');

  if (calGrid && calMonth) {
    // Activités : clé = "YYYY-MM-DD", valeur = description
    // Données injectées dynamiquement par le Blade (window.calendarEvents)
    var calendarEvents = window.calendarEvents || {};

    var calCurrentDate = new Date();
    var calViewYear = calCurrentDate.getFullYear();
    var calViewMonth = calCurrentDate.getMonth();

    var frMonths = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];

    function renderCalendar() {
      var firstDay = new Date(calViewYear, calViewMonth, 1);
      var lastDay = new Date(calViewYear, calViewMonth + 1, 0);
      var startDay = firstDay.getDay() === 0 ? 6 : firstDay.getDay() - 1; // Lundi = 0
      var totalDays = lastDay.getDate();
      var prevLastDay = new Date(calViewYear, calViewMonth, 0).getDate();

      calMonth.textContent = frMonths[calViewMonth] + ' ' + calViewYear;
      calGrid.innerHTML = '';
      calEvent.classList.remove('active');
      calEvent.innerHTML = '';

      var today = new Date();
      var todayStr = today.getFullYear() + '-' + String(today.getMonth() + 1).padStart(2, '0') + '-' + String(today.getDate()).padStart(2, '0');

      // Jours du mois précédent
      for (var i = startDay - 1; i >= 0; i--) {
        var d = document.createElement('span');
        d.className = 'sidebar-calendar__day sidebar-calendar__day--other';
        d.textContent = prevLastDay - i;
        calGrid.appendChild(d);
      }

      // Jours du mois en cours
      for (var day = 1; day <= totalDays; day++) {
        var d = document.createElement('span');
        d.className = 'sidebar-calendar__day';
        d.textContent = day;

        var dateStr = calViewYear + '-' + String(calViewMonth + 1).padStart(2, '0') + '-' + String(day).padStart(2, '0');

        if (dateStr === todayStr) {
          d.classList.add('sidebar-calendar__day--today');
        }

        if (calendarEvents[dateStr]) {
          d.classList.add('sidebar-calendar__day--event');
          d.setAttribute('data-event', calendarEvents[dateStr]);
          d.setAttribute('data-date', dateStr);
          d.addEventListener('click', function () {
            var evtDate = this.getAttribute('data-date');
            var parts = evtDate.split('-');
            var label = parseInt(parts[2]) + ' ' + frMonths[parseInt(parts[1]) - 1] + ' ' + parts[0];
            calEvent.innerHTML = '<strong>' + label + '</strong>' + this.getAttribute('data-event');
            calEvent.classList.add('active');
          });
        }

        calGrid.appendChild(d);
      }

      // Jours du mois suivant
      var remaining = 42 - calGrid.children.length;
      for (var i = 1; i <= remaining; i++) {
        var d = document.createElement('span');
        d.className = 'sidebar-calendar__day sidebar-calendar__day--other';
        d.textContent = i;
        calGrid.appendChild(d);
      }
    }

    calPrev.addEventListener('click', function () {
      calViewMonth--;
      if (calViewMonth < 0) { calViewMonth = 11; calViewYear--; }
      renderCalendar();
    });

    calNext.addEventListener('click', function () {
      calViewMonth++;
      if (calViewMonth > 11) { calViewMonth = 0; calViewYear++; }
      renderCalendar();
    });

    renderCalendar();
  }

  /* --- Article Share Buttons --- */
  var shareButtons = document.querySelectorAll('.article-share__btn');
  if (shareButtons.length > 0) {
    var pageUrl = encodeURIComponent(window.location.href);
    var pageTitle = encodeURIComponent(document.title);

    shareButtons.forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        var url = '';

        if (btn.classList.contains('article-share__btn--facebook')) {
          url = 'https://www.facebook.com/sharer/sharer.php?u=' + pageUrl;
        } else if (btn.classList.contains('article-share__btn--twitter')) {
          url = 'https://twitter.com/intent/tweet?url=' + pageUrl + '&text=' + pageTitle;
        } else if (btn.classList.contains('article-share__btn--linkedin')) {
          url = 'https://www.linkedin.com/sharing/share-offsite/?url=' + pageUrl;
        } else if (btn.classList.contains('article-share__btn--whatsapp')) {
          url = 'https://api.whatsapp.com/send?text=' + pageTitle + '%20' + pageUrl;
        }

        if (url) {
          window.open(url, '_blank', 'width=600,height=400,noopener,noreferrer');
        }
      });
    });
  }

  /* --- Gallery filter class normalization --- */
  var galleryFilterBtns = document.querySelectorAll('.filter-btn');
  galleryFilterBtns.forEach(function (btn) {
    if (btn.classList.contains('filter-btn--active')) {
      btn.classList.add('active');
    }
  });

});
