
document.addEventListener('DOMContentLoaded', function () {
    // Initialize tooltips
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));



    // Initialize popovers
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));

    // Enable dropdowns
    document.querySelectorAll('.dropdown-toggle').forEach(function (el) {
        el.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const dropdown = this.closest('.dropdown');
            const isOpen = dropdown.classList.contains('show');
            // Close all dropdowns first
            document.querySelectorAll('.dropdown.show').forEach(function (openDropdown) {
                if (openDropdown !== dropdown) {
                    openDropdown.classList.remove('show');
                    openDropdown.querySelector('.dropdown-menu')?.classList.remove('show');
                }
            });
            // Toggle current dropdown
            if (!isOpen) {
                dropdown.classList.add('show');
                const menu = dropdown.querySelector('.dropdown-menu');
                if (menu) {
                    menu.classList.add('show');
                }
            } else {
                dropdown.classList.remove('show');
                const menu = dropdown.querySelector('.dropdown-menu');
                if (menu) {
                    menu.classList.remove('show');
                }
            }
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown.show').forEach(function (openDropdown) {
                openDropdown.classList.remove('show');
                openDropdown.querySelector('.dropdown-menu')?.classList.remove('show');
            });
        }
    });

    // Close dropdowns when pressing Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.dropdown.show').forEach(function (openDropdown) {
                openDropdown.classList.remove('show');
                openDropdown.querySelector('.dropdown-menu')?.classList.remove('show');
            });
        }
    });

    // Enable hover dropdowns
    document.querySelectorAll('.dropdown-hover').forEach(function (el) {
        el.addEventListener('mouseenter', function () {
            const dropdown = this.closest('.dropdown');
            if (dropdown) {
                dropdown.classList.add('show');
                const menu = dropdown.querySelector('.dropdown-menu');
                if (menu) {
                    menu.classList.add('show');
                }
            }
        });
        el.addEventListener('mouseleave', function () {
            const dropdown = this.closest('.dropdown');
            if (dropdown) {
                dropdown.classList.remove('show');
                const menu = dropdown.querySelector('.dropdown-menu');
                if (menu) {
                    menu.classList.remove('show');
                }
            }
        });
    });

    // Enable hover submenus
    document.querySelectorAll('.dropdown-submenu').forEach(function (el) {
        el.addEventListener('mouseenter', function () {
            const submenu = this.querySelector('.dropdown-menu');


            if (submenu) {
                submenu.classList.add('show');
                this.classList.add('show');
            }
        });
        el.addEventListener('mouseleave', function () {
            const submenu = this.querySelector('.dropdown-menu');
            if (submenu) {
                submenu.classList.remove('show');
                this.classList.remove('show');
            }
        });
    });
    // Enable click-to-toggle for submenus
    document.querySelectorAll('.dropdown-submenu > a.dropdown-toggle').forEach(function (el) {
        el.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            // Toggle submenu visibility
            const submenu = this.nextElementSibling;
            const parent = this.parentElement;

            // Close other submenus in the same dropdown
            parent.parentElement.querySelectorAll('.dropdown-submenu.show').forEach(function (openSubmenu) {
                if (openSubmenu !== parent) {
                    openSubmenu.classList.remove('show');
                    openSubmenu.querySelector('.dropdown-menu')?.classList.remove('show');
                }
            });

            submenu.classList.toggle('show');
            parent.classList.toggle('show');
        });
    });

});



// Enable click toggle on submenus
document.querySelectorAll('.dropdown-submenu > a').forEach(function (el) {
    el.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        // Close other open submenus in this dropdown
        const parent = el.closest('.dropdown-menu');
        parent.querySelectorAll('.dropdown-submenu').forEach(sub => {
            if (sub !== el.parentElement) {
                sub.classList.remove('show');
                sub.querySelector('.dropdown-menu')?.classList.remove('show');
            }
        });

        // Toggle current
        el.parentElement.classList.toggle('show');
        el.nextElementSibling?.classList.toggle('show');
    });
});

// When the main dropdown closes, also close any open submenus
document.querySelectorAll('.dropdown').forEach(function (dd) {
    dd.addEventListener('hide.bs.dropdown', function () {
        this.querySelectorAll('.dropdown-submenu').forEach(function (submenu) {
            submenu.classList.remove('show');
            submenu.querySelector('.dropdown-menu')?.classList.remove('show');
        });
    });
});