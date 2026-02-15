document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('menuToggle');
    const dropdown = document.getElementById('menuDropdown');


    toggle.addEventListener('click', function (e) {
        e.stopPropagation();
        dropdown.classList.toggle('show');
    });


    document.addEventListener('click', function () {
        dropdown.classList.remove('show');
    });
});


const aboutBtn = document.getElementById('openAboutModal');
const aboutModal = document.getElementById('aboutModal');
const closeBtn = document.getElementById('closeAboutModal');


aboutBtn.addEventListener('click', function (e) {
    e.preventDefault();
    aboutModal.classList.add('show');
});


closeBtn.addEventListener('click', function () {
    aboutModal.classList.remove('show');
});


aboutModal.addEventListener('click', function (e) {
    if (e.target === this) {
        aboutModal.classList.remove('show');
    }
});
