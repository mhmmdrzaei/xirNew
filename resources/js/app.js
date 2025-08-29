import.meta.glob([
  '../images/**',
  '../fonts/**',
]);

document.addEventListener('DOMContentLoaded', () => {
  // X toggle
  const label = document.querySelector('.x-cross');
  const checkbox = label.querySelector('.x-checkbox');
  const box = label.querySelector('.x-box');
  box.textContent = 'X';
  checkbox.addEventListener('change', () => {
    box.textContent = checkbox.checked ? '' : 'X';
  });

  // Mobile menu toggle
  const toggle = document.getElementById('menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');
  toggle?.addEventListener('click', () => {
    mobileMenu.classList.toggle('show');
  });
});

