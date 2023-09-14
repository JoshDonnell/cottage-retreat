/**
 * Scroll Animations
 */

import { gsap, ScrollTrigger } from "gsap/all";
import { FadeIn } from './fadeIn';

export const Scroll = () => {
  gsap.registerPlugin(ScrollTrigger);

  // Scroll Based Hero Animation
  const heroWrapper = document.querySelector('.js-hero-wrapper');
  const contentWrapper = document.querySelector('.js-content-wrapper');
  const footerWrapper = document.querySelector('.js-footer-wrapper');
  const accordionWrapper = document.querySelector('.js-accordion-wrapper');
  const galleryItems = document.querySelectorAll('.js-gallery-item');

  // Create our blank array of elements
  let elementsToAnimate = [];

  // Check for elements within the DOM
  if (heroWrapper) elementsToAnimate.push(heroWrapper);
  
  if (contentWrapper) elementsToAnimate.push(contentWrapper);

  if (accordionWrapper) elementsToAnimate.push(accordionWrapper);
  
  if (footerWrapper) elementsToAnimate.push(footerWrapper);
  
  if (galleryItems.length) {
    galleryItems.forEach(item => {
      elementsToAnimate.push(item)
    });
  }

  // Check if we have any active elements in our Array
  if (elementsToAnimate.length) {
    // Loop over our list of elements
    elementsToAnimate.forEach((element, key) => {
      // Create a new scroll trigger intance
      ScrollTrigger.create({
        trigger: element,
        start: 'top +=90%',
        onEnter: () => { FadeIn(element, key == 0 ? 0.5 : 0) },
        once: true
      });
    })
  }
}