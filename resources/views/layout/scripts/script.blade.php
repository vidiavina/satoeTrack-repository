<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    
    function isNumber(evt) {
        let charCode = evt.which ? evt.which : evt.keyCode;
        if (charCode < 48 || charCode > 57) {
            return false; // Only allow digits (0-9)
        }
        return true;
    }
    
    document.addEventListener("DOMContentLoaded", function (event) {
        const toggle = document.getElementById('header-toggle');
        const nav = document.getElementById('nav-bar');
        const body = document.getElementById('body-pd');
        const header = document.getElementById('header');

        // Setup accordion functionality for all screen sizes
        const accordionToggles = document.querySelectorAll('.accordion-toggle');

        accordionToggles.forEach(toggle => {
            toggle.addEventListener('click', function (e) {
                e.preventDefault();

                // Toggle the active class
                this.classList.toggle('active');

                // Find the next sibling which is the menu
                const menu = this.nextElementSibling;

                // Toggle the open class
                menu.classList.toggle('open');

                // Optional: Close other open menus when opening a new one
                if (menu.classList.contains('open')) {
                    accordionToggles.forEach(otherToggle => {
                        if (otherToggle !== toggle) {
                            otherToggle.classList.remove('active');
                            otherToggle.nextElementSibling.classList.remove('open');
                        }
                    });
                }
            });
        });

        // Handle responsive behavior
        function handleResponsiveChange(mediaQuery) {
            if (mediaQuery.matches) {
                // 576px and larger - Hoverable behavior

                // Remove original event listener for toggle
                toggle.removeEventListener('click', originalToggleFunction);

                // Add new toggle behavior
                toggle.addEventListener('click', hoverableToggleFunction);

                // Add hover functionality
                nav.addEventListener('mouseenter', mouseEnterFunction);
                nav.addEventListener('mouseleave', mouseLeaveFunction);
            } else {
                // Smaller than 576px - Original behavior

                // Remove hoverable event listeners
                toggle.removeEventListener('click', hoverableToggleFunction);
                nav.removeEventListener('mouseenter', mouseEnterFunction);
                nav.removeEventListener('mouseleave', mouseLeaveFunction);

                // Add original toggle function
                toggle.addEventListener('click', originalToggleFunction);
            }
        }

        // Define functions for different behaviors
        function originalToggleFunction() {
            // Original behavior (for small screens)
            nav.classList.toggle('show-custom');
            toggle.classList.toggle('bx-x');
            body.classList.toggle('body-pd');
            header.classList.toggle('body-pd');
        }

        function hoverableToggleFunction() {
            // New behavior (for 576px+)
            nav.classList.toggle('expanded');
            toggle.classList.toggle('bx-x');
            body.classList.toggle('body-expanded');
            header.classList.toggle('header-expanded');
        }

        function mouseEnterFunction() {
            body.classList.add('body-expanded');
            header.classList.add('header-expanded');
        }

        function mouseLeaveFunction() {
            if (!nav.classList.contains('expanded')) {
                body.classList.remove('body-expanded');
                header.classList.remove('header-expanded');

                // Close all accordion menus when sidebar collapses on mouse leave
                document.querySelectorAll('.accordion-menu').forEach(menu => {
                    menu.classList.remove('open');
                });
                document.querySelectorAll('.accordion-toggle').forEach(toggle => {
                    toggle.classList.remove('active');
                });
            }
        }

        // Initialize media query
        const mediaQuery = window.matchMedia('(min-width: 576px)');

        // Call handler right away to set initial state
        handleResponsiveChange(mediaQuery);

        // Add listener for changes
        mediaQuery.addEventListener('change', handleResponsiveChange);

        // Handle link clicks
        const navLinks = document.querySelectorAll('.nav_link:not(.accordion-toggle):not(.sub-link)');
        const subLinks = document.querySelectorAll('.sub-link');

        navLinks.forEach(link => {
            link.addEventListener('click', function () {
                navLinks.forEach(l => l.classList.remove('active'));
                subLinks.forEach(l => l.classList.remove('active'));
                this.classList.add('active');

                // Close all accordion menus
                document.querySelectorAll('.accordion-menu').forEach(menu => {
                    menu.classList.remove('open');
                });
                document.querySelectorAll('.accordion-toggle').forEach(toggle => {
                    toggle.classList.remove('active');
                });
            });
        });

        subLinks.forEach(link => {
            link.addEventListener('click', function () {
                navLinks.forEach(l => l.classList.remove('active'));
                subLinks.forEach(l => l.classList.remove('active'));
                this.classList.add('active');

                // Make parent accordion toggle active
                const parentAccordion = this.closest('.nav_accordion');
                if (parentAccordion) {
                    const parentToggle = parentAccordion.querySelector('.accordion-toggle');
                    parentToggle.classList.add('active');
                }
            });
        });
    });
</script>