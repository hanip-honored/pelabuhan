const sidebar = document.querySelector('.sidebar');
const menuToggle = document.getElementById('menu-toggle');

menuToggle.addEventListener('click', () => {
    sidebar.classList.toggle('open');
});
