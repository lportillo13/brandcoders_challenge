document.addEventListener('DOMContentLoaded', function() {
    // Get the current URL
    var currentUrl = window.location.href;

    // Get all elements with class 'nav-link'
    var navLinks = document.querySelectorAll('.nav-link');

    // Loop through each menu item and compare its href to the current URL
    navLinks.forEach(function(navLink) {
        var menuItemUrl = navLink.getAttribute('href');

        // Check if the current URL contains the menu item's href
        if (currentUrl.indexOf(menuItemUrl) !== -1) {
            navLink.classList.add('active');
        } else {
            navLink.classList.remove('active'); // Remove 'active' class if not on the corresponding page
        }
    });
});