// js/animaties.js
document.addEventListener("DOMContentLoaded", (event) => {
  gsap.registerPlugin();

  // Hero sectie animatie (fade in en slide up)
  gsap.from(".gsap-hero", {
    y: 30,
    opacity: 0,
    duration: 0.8,
    ease: "power3.out",
    stagger: 0.2
  });

  // Masonry cards stagger animatie
  gsap.from(".gsap-card", {
    y: 40,
    opacity: 0,
    duration: 0.6,
    ease: "power2.out",
    stagger: 0.05,
    delay: 0.2
  });

  // Navigatie balk animatie
  gsap.from("header", {
    y: -20,
    opacity: 0,
    duration: 0.5,
    ease: "power2.out"
  });
});