const navToggle = document.querySelector('.nav-toggle');
const navLinks = document.getElementById('nav-links');

if (navToggle && navLinks) {
  navToggle.addEventListener('click', () => {
    const expanded = navToggle.getAttribute('aria-expanded') === 'true';
    navToggle.setAttribute('aria-expanded', String(!expanded));
    navLinks.classList.toggle('open');
  });
}

const yearEl = document.getElementById('year');
if (yearEl) {
  yearEl.textContent = String(new Date().getFullYear());
}

const contactSection = document.getElementById('contact');
const contactForm = contactSection?.querySelector('form');

const getQueryParams = () => {
  if (window.location.search) {
    return new URLSearchParams(window.location.search);
  }

  const hash = window.location.hash;
  if (hash.includes('?')) {
    const queryString = hash.split('?')[1];
    return new URLSearchParams(queryString);
  }

  return new URLSearchParams();
};

const params = getQueryParams();
if (contactSection && contactForm && (params.has('sent') || params.has('error'))) {
  const message = document.createElement('div');
  if (params.get('sent') === '1') {
    message.className = 'flash flash-success';
    message.textContent = 'Merci, votre message a bien été envoyé.';
  } else {
    message.className = 'flash flash-error';
    message.textContent = 'Une erreur est survenue. Merci de réessayer ou d’utiliser le mail direct.';
  }
  contactForm.parentElement?.insertBefore(message, contactForm);

  const cleanUrl = `${window.location.pathname}${window.location.hash.split('?')[0] || ''}`;
  window.history.replaceState({}, document.title, cleanUrl);
}
