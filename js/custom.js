// Mobile Menu Toggle
jQuery(document).ready(function($) {
    const menuToggle = document.querySelector('.menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuClose = document.querySelector('.menu-close');

    if (menuToggle && mobileMenu && menuClose) {
        // Toggle menu open
        menuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            mobileMenu.classList.add('toggled');
            menuToggle.setAttribute('aria-expanded', 'true');
            document.body.style.overflow = 'hidden';
        });

        // Toggle menu close
        menuClose.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            mobileMenu.classList.remove('toggled');
            menuToggle.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
        });

        // Close menu when clicking outside
        $(document).on('click touchstart', function(e) {
            if (mobileMenu.classList.contains('toggled') && 
                !$(e.target).closest('#mobile-menu').length && 
                !$(e.target).closest('.menu-toggle').length) {
                mobileMenu.classList.remove('toggled');
                menuToggle.setAttribute('aria-expanded', 'false');
                document.body.style.overflow = '';
            }
        });

        // Prevent clicks inside mobile menu from closing it
        $(mobileMenu).on('click touchstart', function(e) {
            e.stopPropagation();
        });
    }
}); 