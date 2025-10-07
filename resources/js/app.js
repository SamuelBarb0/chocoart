import './bootstrap';

// Reveal on scroll con IntersectionObserver
const ready = (fn) => (document.readyState !== 'loading') ? fn() : document.addEventListener('DOMContentLoaded', fn);
ready(() => {
  const els = document.querySelectorAll('[data-animate]');
  if (!('IntersectionObserver' in window) || !els.length) return;

  const io = new IntersectionObserver((entries) => {
    entries.forEach(({ target, isIntersecting }) => {
      if (!isIntersecting) return;
      const anim = target.getAttribute('data-animate') || 'fade-up';
      const delay = target.getAttribute('data-delay');
      target.style.willChange = 'transform, opacity';
      if (delay) target.style.animationDelay = `${delay}ms`;
      target.classList.remove('opacity-0');       // estado inicial
      target.classList.add(`animate-${anim}`);
      io.unobserve(target);
    });
  }, { threshold: 0.12, rootMargin: '0px 0px -10% 0px' });

  els.forEach(el => {
    el.classList.add('opacity-0'); // oculta antes de entrar
    io.observe(el);
  });
});
