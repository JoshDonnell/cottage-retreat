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

  let elementsToAnimate = [];

  
  if (heroWrapper) elementsToAnimate.push(heroWrapper);
  
  if (contentWrapper) elementsToAnimate.push(contentWrapper);
  
  if (galleryItems.length) {
    galleryItems.forEach(item => {
      elementsToAnimate.push(item)
    });
  }

  if (accordionWrapper) elementsToAnimate.push(accordionWrapper);

  if (footerWrapper) elementsToAnimate.push(footerWrapper);

  if (elementsToAnimate.length) {
    elementsToAnimate.forEach((element, key) => {
      ScrollTrigger.create({
        trigger: element,
        start: 'top +=75%',
        onEnter: () => { FadeIn(element, key == 0 ? 0.5 : 0) },
        once: true
      });
    })
  }
}