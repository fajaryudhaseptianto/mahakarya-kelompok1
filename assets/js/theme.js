(function () {
  document.addEventListener('DOMContentLoaded', () => {
    document.body.classList.add('fade-in');

    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(btn => {
      btn.addEventListener('mouseenter', () => btn.classList.add('btn-hover'));
      btn.addEventListener('mouseleave', () => btn.classList.remove('btn-hover'));
    });

    const toggles = document.querySelectorAll('[data-theme-toggle]');
    const applyTheme = mode => {
      if (!mode || mode === 'light') {
        document.body.classList.remove('dark-mode');
      } else {
        document.body.classList.add('dark-mode');
      }
      localStorage.setItem('pg-theme', mode);
      toggles.forEach(btn => {
        const label = btn.querySelector('span');
        if (label) {
          label.textContent = mode === 'light' ? 'Dark' : 'Light';
        }
      });
    };

    if (toggles.length) {
      applyTheme(localStorage.getItem('pg-theme'));

      toggles.forEach(btn => {
        btn.addEventListener('click', () => {
          const current = localStorage.getItem('pg-theme') || 'light';
          const next = current === 'light' ? 'dark' : 'light';
          applyTheme(next);
        });
      });
    }
  });
})();

function showToast(message, type = 'success') {
  let container = document.querySelector('.toast-container');
  if (!container) {
    container = document.createElement('div');
    container.className = 'toast-container';
    document.body.appendChild(container);
  }

  const toast = document.createElement('div');
  toast.className = `toast-message ${type}`;
  toast.textContent = message;
  container.appendChild(toast);

  requestAnimationFrame(() => toast.classList.add('show'));

  setTimeout(() => {
    toast.classList.remove('show');
    setTimeout(() => toast.remove(), 300);
  }, 3500);
}

