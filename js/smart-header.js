document.addEventListener('DOMContentLoaded', function() {
    var lastScrollTop = 0;
    var header = document.getElementById('masthead'); // Replace with your header ID
    var startSmartBehavior = 120; // Start the smart behavior after 120px of scrolling

    window.addEventListener('scroll', function() {
        var currentScroll = window.scrollY;

        if (currentScroll > lastScrollTop && currentScroll > startSmartBehavior) {
            // Scrolling down and past 120px
            header.style.top = '-150px'; // Adjust as needed
        } else if (currentScroll <= lastScrollTop || currentScroll <= startSmartBehavior) {
            // Scrolling up or hasn't scrolled 120px yet
            header.style.top = '0';
        }

        lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
    }, false);
});

document.addEventListener('DOMContentLoaded', function () {
    const dropdowns = document.querySelectorAll('.navbar-nav .dropdown');
  
    dropdowns.forEach(function (dropdown) {
      let timeout;
  
      dropdown.addEventListener('mouseenter', function () {
        clearTimeout(timeout);
        const menu = dropdown.querySelector('.dropdown-menu');
        if (menu) menu.style.display = 'block';
      });
  
      dropdown.addEventListener('mouseleave', function () {
        const menu = dropdown.querySelector('.dropdown-menu');
        timeout = setTimeout(() => {
          if (menu) menu.style.display = 'none';
        }, 200); // Delay makes hover feel natural
      });
    });
  });
  
