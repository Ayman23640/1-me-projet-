// ============================================
// RESPONSIVE NAVBAR - BURGER MENU TOGGLE
// ============================================

/**
 * Toggle the burger menu open/closed
 */
function toggleMenu() {
    const navMenu = document.getElementById('navMenu');
    const burger = document.querySelector('.burger');
    
    if (navMenu && burger) {
        navMenu.classList.toggle('active');
        burger.classList.toggle('active');
    }
}

/**
 * Close menu when a link is clicked
 */
document.addEventListener('DOMContentLoaded', function() {
    const navMenu = document.getElementById('navMenu');
    const burger = document.querySelector('.burger');
    const navLinks = document.querySelectorAll('.nav-menu a');
    
    // Close menu when clicking on a link
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (navMenu && burger) {
                navMenu.classList.remove('active');
                burger.classList.remove('active');
            }
        });
    });
});

/**
 * Close menu when clicking outside of it
 */
document.addEventListener('click', function(event) {
    const navMenu = document.getElementById('navMenu');
    const burger = document.querySelector('.burger');
    const navbar = document.querySelector('.navbar');
    
    if (navMenu && burger && navbar) {
        const isClickInsideNav = navbar.contains(event.target);
        const isMenuActive = navMenu.classList.contains('active');
        
        if (!isClickInsideNav && isMenuActive) {
            navMenu.classList.remove('active');
            burger.classList.remove('active');
        }
    }
});

/**
 * Handle window resize - close menu on larger screens
 */
window.addEventListener('resize', function() {
    const navMenu = document.getElementById('navMenu');
    const burger = document.querySelector('.burger');
    
    if (window.innerWidth > 850) {
        if (navMenu && burger) {
            navMenu.classList.remove('active');
            burger.classList.remove('active');
        }
    }
});

/**
 * Add keyboard support (ESC to close menu)
 */
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const navMenu = document.getElementById('navMenu');
        const burger = document.querySelector('.burger');
        
        if (navMenu && burger) {
            navMenu.classList.remove('active');
            burger.classList.remove('active');
        }
    }
});

/**
 * Add smooth scroll support for anchor links
 */
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        if (href !== '#' && document.querySelector(href)) {
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }
    });
});

/**
 * Simple console log for debugging (optional)
 */
console.log('Navbar initialized successfully!');
