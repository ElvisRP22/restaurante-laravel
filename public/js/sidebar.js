const hamburger = document.querySelector('#toggle-btn');
const links = document.querySelectorAll('.sidebar-link');

hamburger.addEventListener('click', function () {
    document.querySelector('#sidebar').classList.toggle('expand');

});

