// public/js/particulas.js

document.addEventListener('DOMContentLoaded', function () {
    const particulas = document.querySelector('.particulas');
    if (particulas) {
        for (let i = 0; i < 50; i++) {
            const p = document.createElement('div');
            p.classList.add('particula');
            p.style.left = Math.random() * 100 + '%';
            p.style.width = Math.random() * 6 + 'px';
            p.style.height = p.style.width;
            p.style.animationDuration = 3 + Math.random() * 2 + 's';
            p.style.top = Math.random() * 100 + '%';
            particulas.appendChild(p);
        }
    }
});

