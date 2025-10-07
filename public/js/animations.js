// =============================================
// CHOCOART - ANIMACIONES TEMÁTICAS DE CHOCOLATE
// =============================================

// =============================================
// 1. PARTÍCULAS DE CHOCOLATE CAYENDO
// =============================================
class ChocolateParticles {
    constructor() {
        this.canvas = document.createElement('canvas');
        this.ctx = this.canvas.getContext('2d');
        this.particles = [];
        this.colors = ['#e28dc4', '#81cacf', '#c6d379', '#5f3917'];

        this.init();
    }

    init() {
        // Configurar canvas
        this.canvas.style.cssText = `
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        `;

        this.resize();
        window.addEventListener('resize', () => this.resize());

        // Crear partículas
        for (let i = 0; i < 30; i++) {
            this.createParticle();
        }

        // Insertar en el hero
        const hero = document.querySelector('#inicio');
        if (hero) {
            hero.appendChild(this.canvas);
            this.animate();
        }
    }

    resize() {
        this.canvas.width = this.canvas.offsetWidth;
        this.canvas.height = this.canvas.offsetHeight;
    }

    createParticle() {
        this.particles.push({
            x: Math.random() * this.canvas.width,
            y: Math.random() * -this.canvas.height,
            size: Math.random() * 4 + 2,
            speed: Math.random() * 2 + 0.5,
            color: this.colors[Math.floor(Math.random() * this.colors.length)],
            opacity: Math.random() * 0.5 + 0.3,
            drift: Math.random() * 2 - 1
        });
    }

    animate() {
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);

        this.particles.forEach((particle, index) => {
            // Actualizar posición
            particle.y += particle.speed;
            particle.x += particle.drift;

            // Redibujar si sale de la pantalla
            if (particle.y > this.canvas.height) {
                this.particles[index] = {
                    x: Math.random() * this.canvas.width,
                    y: -10,
                    size: Math.random() * 4 + 2,
                    speed: Math.random() * 2 + 0.5,
                    color: this.colors[Math.floor(Math.random() * this.colors.length)],
                    opacity: Math.random() * 0.5 + 0.3,
                    drift: Math.random() * 2 - 1
                };
            }

            // Dibujar partícula
            this.ctx.beginPath();
            this.ctx.arc(particle.x, particle.y, particle.size, 0, Math.PI * 2);
            this.ctx.fillStyle = particle.color;
            this.ctx.globalAlpha = particle.opacity;
            this.ctx.fill();
        });

        this.ctx.globalAlpha = 1;
        requestAnimationFrame(() => this.animate());
    }
}

// =============================================
// 2. EFECTO DE DERRETIMIENTO EN PRODUCTOS
// =============================================
function initMeltingEffect() {
    const products = document.querySelectorAll('.popular-product-item, .product-card');

    products.forEach(product => {
        const circle = product.querySelector('.product-image-circle, .product-circle > div, .product-placeholder');

        if (circle) {
            product.addEventListener('mouseenter', () => {
                circle.style.transform = 'translateY(-10px) scale(1.05)';
                circle.style.borderRadius = '45% 55% 60% 40% / 50% 45% 55% 50%';
                circle.style.transition = 'all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55)';
            });

            product.addEventListener('mouseleave', () => {
                circle.style.transform = 'translateY(0) scale(1)';
                circle.style.borderRadius = '50%';
            });
        }
    });
}

// =============================================
// 3. BURBUJAS FLOTANTES CON COLORES DE MARCA
// =============================================
class FloatingBubbles {
    constructor(sectionSelector) {
        this.section = document.querySelector(sectionSelector);
        if (!this.section) return;

        this.bubbles = [];
        this.colors = [
            'rgba(226, 141, 196, 0.2)',
            'rgba(129, 202, 207, 0.2)',
            'rgba(198, 211, 121, 0.2)'
        ];

        this.init();
    }

    init() {
        // Crear contenedor de burbujas
        const container = document.createElement('div');
        container.style.cssText = `
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
            z-index: 0;
        `;

        // Crear burbujas
        for (let i = 0; i < 15; i++) {
            this.createBubble(container);
        }

        // Asegurar que la sección tenga position relative
        if (getComputedStyle(this.section).position === 'static') {
            this.section.style.position = 'relative';
        }

        this.section.appendChild(container);
    }

    createBubble(container) {
        const bubble = document.createElement('div');
        const size = Math.random() * 80 + 20;
        const left = Math.random() * 100;
        const delay = Math.random() * 5;
        const duration = Math.random() * 10 + 15;
        const color = this.colors[Math.floor(Math.random() * this.colors.length)];

        bubble.style.cssText = `
            position: absolute;
            bottom: -100px;
            left: ${left}%;
            width: ${size}px;
            height: ${size}px;
            background: ${color};
            border-radius: 50%;
            backdrop-filter: blur(2px);
            animation: floatUp ${duration}s ease-in ${delay}s infinite;
            box-shadow: inset 0 0 20px rgba(255, 255, 255, 0.3);
        `;

        container.appendChild(bubble);
    }
}

// =============================================
// 4. EFECTO SPLASH AL HACER CLIC
// =============================================
function initSplashEffect() {
    const buttons = document.querySelectorAll('.btn, button, a.group');

    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            const splash = document.createElement('div');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;

            splash.style.cssText = `
                position: absolute;
                left: ${x}px;
                top: ${y}px;
                width: ${size}px;
                height: ${size}px;
                border-radius: 50%;
                background: radial-gradient(circle, rgba(255, 255, 255, 0.6), transparent);
                pointer-events: none;
                animation: splashAnimation 0.6s ease-out;
                z-index: 100;
            `;

            // Asegurar que el botón tenga position relative
            if (getComputedStyle(this).position === 'static') {
                this.style.position = 'relative';
            }

            this.appendChild(splash);

            setTimeout(() => splash.remove(), 600);
        });
    });
}

// =============================================
// 5. ONDAS LÍQUIDAS EN LOS DIVISORES
// =============================================
function animateWaveDividers() {
    const waves = document.querySelectorAll('.wave-divider svg path, svg path[fill="white"]');

    waves.forEach(wave => {
        let offset = 0;

        setInterval(() => {
            offset += 0.5;
            wave.style.transform = `translateX(${Math.sin(offset * 0.1) * 2}px)`;
        }, 50);
    });
}

// =============================================
// 6. EFECTO DE GOTEO EN TARJETAS
// =============================================
function initDripEffect() {
    const cards = document.querySelectorAll('.feature-card, .course-item');

    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            // Crear elemento de goteo
            const drip = document.createElement('div');
            drip.style.cssText = `
                position: absolute;
                top: 0;
                left: 50%;
                width: 4px;
                height: 0;
                background: linear-gradient(to bottom,
                    rgba(226, 141, 196, 0.8),
                    rgba(226, 141, 196, 0));
                border-radius: 0 0 50% 50%;
                animation: drip 1.5s ease-out forwards;
                pointer-events: none;
            `;

            if (getComputedStyle(this).position === 'static') {
                this.style.position = 'relative';
            }

            this.appendChild(drip);

            setTimeout(() => drip.remove(), 1500);
        });
    });
}

// =============================================
// 7. PARALLAX DE SCROLL SUAVE
// =============================================
function initSmoothParallax() {
    const parallaxElements = document.querySelectorAll('.product-circle, .hero-logo-container');

    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;

        parallaxElements.forEach(el => {
            const speed = 0.3;
            const rect = el.getBoundingClientRect();
            const elementTop = rect.top + scrolled;
            const yPos = -(scrolled - elementTop) * speed;

            el.style.transform = `translateY(${yPos}px)`;
        });
    });
}

// =============================================
// ANIMACIONES CSS ADICIONALES
// =============================================
const animationStyles = document.createElement('style');
animationStyles.textContent = `
    @keyframes floatUp {
        0% {
            bottom: -100px;
            opacity: 0;
        }
        10% {
            opacity: 0.8;
        }
        90% {
            opacity: 0.8;
        }
        100% {
            bottom: 110%;
            opacity: 0;
        }
    }

    @keyframes splashAnimation {
        0% {
            transform: scale(0);
            opacity: 1;
        }
        100% {
            transform: scale(2);
            opacity: 0;
        }
    }

    @keyframes drip {
        0% {
            height: 0;
            opacity: 1;
        }
        70% {
            height: 30px;
            opacity: 0.8;
        }
        100% {
            height: 40px;
            opacity: 0;
            transform: translateY(10px);
        }
    }

    /* Animación de pulso suave para productos */
    @keyframes gentlePulse {
        0%, 100% {
            box-shadow: 0 0 0 0 rgba(226, 141, 196, 0.4);
        }
        50% {
            box-shadow: 0 0 0 20px rgba(226, 141, 196, 0);
        }
    }

    .popular-product-item:hover .product-image-circle,
    .product-card:hover .product-placeholder {
        animation: gentlePulse 2s infinite;
    }

    /* Efecto de brillo deslizante */
    @keyframes shine {
        0% {
            left: -100%;
        }
        100% {
            left: 100%;
        }
    }

    .product-card::after,
    .popular-product-item::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 50%;
        height: 100%;
        background: linear-gradient(
            90deg,
            transparent,
            rgba(255, 255, 255, 0.3),
            transparent
        );
        transition: left 0.5s;
        pointer-events: none;
    }

    .product-card:hover::after,
    .popular-product-item:hover::after {
        animation: shine 1.5s ease-in-out;
    }

    /* Animación de ondulación en botones */
    @keyframes ripple {
        0% {
            transform: scale(0);
            opacity: 1;
        }
        100% {
            transform: scale(4);
            opacity: 0;
        }
    }

    /* Efecto de levitación */
    @keyframes levitate {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-15px);
        }
    }

    .gallery-item:hover {
        animation: levitate 2s ease-in-out infinite;
    }

    /* Rotación suave en features */
    @keyframes rotateIn {
        from {
            opacity: 0;
            transform: rotate(-10deg) scale(0.8);
        }
        to {
            opacity: 1;
            transform: rotate(0deg) scale(1);
        }
    }

    .feature-card {
        animation: rotateIn 0.6s ease-out backwards;
    }

    .feature-card:nth-child(1) { animation-delay: 0.1s; }
    .feature-card:nth-child(2) { animation-delay: 0.2s; }
    .feature-card:nth-child(3) { animation-delay: 0.3s; }

    /* Efecto de derretimiento suave */
    @keyframes melt {
        0%, 100% {
            border-radius: 50%;
        }
        25% {
            border-radius: 45% 55% 50% 50% / 50% 45% 55% 50%;
        }
        50% {
            border-radius: 40% 60% 55% 45% / 55% 40% 60% 45%;
        }
        75% {
            border-radius: 55% 45% 45% 55% / 45% 55% 45% 55%;
        }
    }

    /* Texto con efecto líquido */
    @keyframes liquidText {
        0%, 100% {
            transform: scaleY(1);
        }
        50% {
            transform: scaleY(1.1);
        }
    }

    h1, h2 {
        transform-origin: bottom;
        animation: liquidText 4s ease-in-out infinite;
    }
`;
document.head.appendChild(animationStyles);

// =============================================
// INICIALIZAR TODAS LAS ANIMACIONES
// =============================================
window.addEventListener('load', () => {
    console.log('%c🍫 Inicializando animaciones de Chocoart...', 'color: #e28dc4; font-size: 14px; font-weight: bold;');

    // Solo en desktop para mejor rendimiento
    if (window.innerWidth > 768) {
        new ChocolateParticles();
        // new FloatingBubbles('#productos');
        // new FloatingBubbles('#cursos');
        initSmoothParallax();
    }

    // En todos los dispositivos
    initMeltingEffect();
    initSplashEffect();
    initDripEffect();
    animateWaveDividers();

    console.log('%c✨ Animaciones cargadas exitosamente!', 'color: #81cacf; font-size: 12px;');
});
