document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.getElementById('toggle-btn');
    const navMenu = document.getElementById('topnav-menu');

    if (!toggleBtn || !navMenu) return;

    toggleBtn.addEventListener('click', () => {
        navMenu.classList.toggle('show');
        toggleBtn.textContent = navMenu.classList.contains('show') ? '✕' : '☰';

        // Optional: lock scroll when menu is open
        document.body.style.overflow = navMenu.classList.contains('show') ? 'hidden' : '';
    });

    document.addEventListener('click', (e) => {
        const isClickInside = toggleBtn.contains(e.target) || navMenu.contains(e.target);
        if (!isClickInside) {
            navMenu.classList.remove('show');
            toggleBtn.textContent = '☰';
            document.body.style.overflow = ''; // restore scroll
        }
    });
});


    // Toggle mobile menu
    const menuToggle = document.querySelector('.menu-toggle');
    const navMenu = document.querySelector('.nav-menu');

    menuToggle.addEventListener('click', () => {
        navMenu.classList.toggle('active');
    });