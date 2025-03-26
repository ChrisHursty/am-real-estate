jQuery(document).ready(function($) {
    $('.portfolio-carousel').owlCarousel({
        items: 4,
        loop: true,
        margin: 10,
        responsiveClass: true,
        responsive: {
            0: {
                items: 3,
                nav: false
            },
            600: {
                items: 4,
                nav: false
            }
        },
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true
    });

    // Initialize Magnific-Popup for the links in the Owl Carousel
    $('.portfolio-carousel').magnificPopup({
        delegate: 'a', // child items selector, by clicking on it popup will open
        type: 'image',
        gallery: {
            enabled: true // Enable gallery mode
        },
        image: {
            titleSrc: 'title' // Attribute for image captions
        }
        // other Magnific-Popup options as needed
    });
});
