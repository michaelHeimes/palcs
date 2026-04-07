/**
 * Add button roles and alt text/aria labels to swiper bundle
 */

document.querySelectorAll('.swiper-button-next, .swiper-button-prev').forEach(btn => {
   btn.setAttribute('role', 'button');
   btn.setAttribute('tabindex', '0');
 });
 
 document.querySelector('.swiper-button-next')?.setAttribute('aria-label','Next slide');
 document.querySelector('.swiper-button-prev')?.setAttribute('aria-label','Previous slide');