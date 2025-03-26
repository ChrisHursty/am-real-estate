document.addEventListener('DOMContentLoaded', function() {
    var lastScrollTop = 0;
    var header = document.getElementById('masthead'); // Replace with your header ID
    var startSmartBehavior = 120; // Start the smart behavior after 120px of scrolling

    window.addEventListener('scroll', function() {
        var currentScroll = window.scrollY;

        if (currentScroll > lastScrollTop && currentScroll > startSmartBehavior) {
            // Scrolling down and past 120px
            header.style.top = '-110px'; // Adjust as needed
        } else if (currentScroll <= lastScrollTop || currentScroll <= startSmartBehavior) {
            // Scrolling up or hasn't scrolled 120px yet
            header.style.top = '0';
        }

        lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
    }, false);
});
