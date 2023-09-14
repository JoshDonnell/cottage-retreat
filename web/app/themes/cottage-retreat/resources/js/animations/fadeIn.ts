/**
 * Basic Fade Animation to include
 */

import { gsap } from "gsap/all";

export const FadeIn = (element, delay) => {
  let y = 100;

  element.style.transform = "translate(" + y + "px)";
  element.style.opacity = "0";

  gsap.fromTo(element, {x: 'auto', y: y, autoAlpha: 0}, {
    duration: 1,
    x: 'auto',
    y: 0, 
    autoAlpha: 1, 
    ease: "power1.easeInOut",
    delay: delay
  });
}