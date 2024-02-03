const header = document.querySelector('header');

window.addEventListener ('scroll', () => {
    header.classList.toggle('sticky', window.scrollY > 80);
});

const div = document.getElementById('menu-bar');

div.addEventListener ('click', () => {
    nav.classList.toggle('close-nav');
});


const nav = document.querySelector('nav');

nav.addEventListener ('click', () => {
    nav.classList.add('close-nav');
});


  


  