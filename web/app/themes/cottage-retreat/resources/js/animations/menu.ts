/**
 * Basic Menu Animations
 */

export const Menu = () => {
  // Mobile Icon Lading Animation
  const trigger = document.querySelector('.js-mobile-trigger');

  if (trigger) {
    trigger.classList.add('isLoaded');
  }



  // Loader header into view

  const logo:HTMLElement = document.querySelector('.js-logo');
  const mainNavigation:HTMLElement = document.querySelector('.js-main-navigation');

  if (logo && mainNavigation) {
    logo.style.opacity = '1';
    logo.style.top = '0px';

    // Simple delay effect
    setTimeout(() => {
      mainNavigation.style.opacity = '1';
      mainNavigation.style.top = '0px';
    }, 125);
  }
}