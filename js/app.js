document.addEventListener('DOMContentLoaded', function() {
    const burger = document.getElementById('burger');
    const menu = document.getElementById('navbarMenu');
    
    if (burger && menu) {
        burger.addEventListener('click', function() {
            burger.classList.toggle('is-active');
            menu.classList.toggle('is-active');
        });
    }
});