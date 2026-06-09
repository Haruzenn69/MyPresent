document.addEventListener('DOMContentLoaded', function () {

  // ─── 1. Staggered Entrance for admin-card ────────────────────────────────
  (function () {
    var cards = document.querySelectorAll('.admin-card');
    cards.forEach(function (card, i) {
      card.classList.add('entrance-pending');
      var delay = Math.min((i + 1) * 60, 700);
      setTimeout(function () {
        card.classList.remove('entrance-pending');
        card.classList.add('animate-fade-slide-up');
        card.style.setProperty('--entrance-delay', delay + 'ms');
      }, delay);
    });
  })();

  // ─── 2. Staggered Entrance for table rows ────────────────────────────────
  (function () {
    var tables = document.querySelectorAll('.admin-card .table-responsive table');
    tables.forEach(function (table) {
      table.classList.add('table-stagger');
    });
  })();

  // ─── 3. Counter Animation (count-up) ────────────────────────────────────
  (function () {
    var counters = document.querySelectorAll('.count-up');
    if (!counters.length) return;

    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          var el = entry.target;
          var target = parseInt(el.getAttribute('data-target') || el.textContent.replace(/[^0-9]/g, ''), 10) || 0;
          var suffix = el.getAttribute('data-suffix') || '';
          var duration = parseInt(el.getAttribute('data-duration') || '800', 10);
          var start = 0;
          var step = Math.max(1, Math.floor(target / (duration / 16)));
          var current = start;

          var timer = setInterval(function () {
            current += step;
            if (current >= target) {
              current = target;
              clearInterval(timer);
              el.classList.add('count-up-done');
            }
            el.textContent = current + suffix;
          }, 16);

          observer.unobserve(el);
        }
      });
    }, { threshold: 0.3 });

    counters.forEach(function (el) { observer.observe(el); });
  })();

  // ─── 4. Ripple Effect on buttons with .ripple class ─────────────────────
  (function () {
    document.querySelectorAll('.ripple').forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        var rect = btn.getBoundingClientRect();
        var x = ((e.clientX - rect.left) / rect.width) * 100;
        var y = ((e.clientY - rect.top) / rect.height) * 100;
        btn.style.setProperty('--ripple-x', x + '%');
        btn.style.setProperty('--ripple-y', y + '%');
      });
    });
  })();

  // ─── 5. Auto ripple on all buttons with admin-card style ────────────────
  (function () {
    document.querySelectorAll('.admin-card a, .admin-card button').forEach(function (el) {
      if (!el.classList.contains('ripple')) {
        el.classList.add('ripple');
      }
    });
  })();

  // ─── 6. Toast notification auto-dismiss ──────────────────────────────────
  (function () {
    document.querySelectorAll('.toast-auto').forEach(function (toast) {
      var duration = parseInt(toast.getAttribute('data-duration') || '4000', 10);
      setTimeout(function () {
        toast.classList.remove('toast-enter');
        toast.classList.add('toast-exit');
        setTimeout(function () { toast.remove(); }, 300);
      }, duration);
    });
  })();

});
