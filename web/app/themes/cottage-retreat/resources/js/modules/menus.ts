/**
 * Menu Module
 * 
 * Click handlers for all things menu related.
 */

export const Menus = () => {
  // Set the mobile menu trigger
  const trigger = document.querySelector('.js-mobile-trigger');

  // Set the mobile menu
  const menu = document.querySelector('.js-mobile-menu');

  // Set the header
  const header = document.querySelector('.js-header');

  const body = document.querySelector('body');

  // Check for trigger, menu and header
  if (trigger && menu && header && body) {
    trigger.addEventListener('click', () => {
      // Force scroll to top
      window.scrollTo(0,0);
      
      // Toggle a basic class switch
      trigger.classList.toggle('isActive');
      header.classList.toggle('isActive');
      body.classList.toggle('isLocked');
    });
  }
};