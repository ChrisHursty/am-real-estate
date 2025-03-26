// main.js
document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.querySelector('.menu-toggle');
    const menuClose = document.querySelector('.menu-close');
    const siteNavigation = document.getElementById('site-navigation');

    // Function to toggle the menu
    function toggleMenu() {
        siteNavigation.classList.toggle('toggled');
        const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
        menuToggle.setAttribute('aria-expanded', !isExpanded);
    }

    // Event listeners
    menuToggle.addEventListener('click', toggleMenu);
    menuClose.addEventListener('click', toggleMenu);

    // Portfolio Grid Click Event
    const portfolioItems = document.querySelectorAll('.portfolio-item');

    portfolioItems.forEach(item => {
        item.addEventListener('click', function() {
            const overlay = this.querySelector('.portfolio-overlay');
            overlay.classList.toggle('is-active');
        });
    });

});

// Owl Carousel
jQuery(document).ready(function($) {
    
    // Testimonials Slider
    $(".testimonial-carousel").owlCarousel({
        items: 2,
        loop: true,
        margin: 20,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: false,
            },
            600: {
                items: 2,
                nav: false,
            },
            1000: {
            items: 2,
            nav: true,
            dots: true,
        }

        },
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true
    });

    // Companies Slider
    $('.logo-carousel').owlCarousel({
        loop: true,
        margin: 40,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 5
            }
        },
        slideBy: 2,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true
    });

    $(".hp-gallery-carousel").owlCarousel({
        items: 4,
        margin: 10,
        loop: true,
        autoplay: true,
        dots: false,
        autoplayTimeout: 3000, // 3 seconds
        autoplayHoverPause: true,
        slideBy: 2,
        responsive:{
            0:{
                items:1
            },
            600:{
                dots: false,
                items:2
            },
            1000:{
                items:4
            }
        }
    });

    $(".lp-gallery-carousel").owlCarousel({
        items: 4,
        margin: 10,
        loop: true,
        autoplay: true,
        dots: false,
        autoplayTimeout: 3000, // 3 seconds
        autoplayHoverPause: true,
        slideBy: 2,
        responsive:{
            0:{
                items:1
            },
            600:{
                dots: false,
                items:2
            },
            1000:{
                items:4
            }
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.hero-slide');
    let currentSlide = 0;
    
    // Set initial states
    slides.forEach((slide, index) => {
        slide.style.opacity = (index === 0) ? 1 : 0;
    });

    // Function to show a specific slide
    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.style.opacity = (i === index) ? 1 : 0;
        });
    }

    // Autoplay every 5 seconds
    setInterval(() => {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }, 5000);
});

jQuery(document).ready(function($){
    // Example: initialize a lightbox on the .listing-gallery
    $('.listing-gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        gallery: {
            enabled: true
        }
    });
});
