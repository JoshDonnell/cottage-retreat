/**
 * Cottage Retreat App
 */

import { Introduction } from './modules/introduction';
import { Animations } from './animations/';
import { Menus } from './modules/menus';
import { Accordions } from './modules/accordions';

// Non Dom Interactive
Introduction();

document.addEventListener('DOMContentLoaded', () => {
  Animations();
  Menus();
  Accordions();
});