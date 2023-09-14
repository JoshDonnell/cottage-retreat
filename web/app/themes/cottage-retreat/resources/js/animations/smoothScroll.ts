/**
 * Smooth Scroll via Lenis
 */

import Lenis from '@studio-freight/lenis';
import { gsap, ScrollTrigger } from "gsap/all";

export const SmoothScroll = () => {
  gsap.registerPlugin(ScrollTrigger);
  
  const lenis = new Lenis({
    duration: 1.5,
    smoothWheel: true,
    easing: (t) => (t === 1 ? 1 : 1 - Math.pow(2, -10 * t))
  });

  lenis.on('scroll', ScrollTrigger.update);

  gsap.ticker.add((time)=>{
    lenis.raf(time * 1000)
  });
  
  gsap.ticker.lagSmoothing(0);
};