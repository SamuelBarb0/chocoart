// =============================================
// MOBILE MENU TOGGLE
// =============================================
const menuToggle = document.querySelector('.menu-toggle');
const navMenu = document.querySelector('.nav-menu');

menuToggle.addEventListener('click', () => {
    navMenu.classList.toggle('active');

    // Animate hamburger menu
    const spans = menuToggle.querySelectorAll('span');
    if (navMenu.classList.contains('active')) {
        spans[0].style.transform = 'rotate(45deg) translate(7px, 7px)';
        spans[1].style.opacity = '0';
        spans[2].style.transform = 'rotate(-45deg) translate(7px, -7px)';
    } else {
        spans[0].style.transform = 'none';
        spans[1].style.opacity = '1';
        spans[2].style.transform = 'none';
    }
});

// Close menu when clicking on a link
document.querySelectorAll('.nav-menu a').forEach(link => {
    link.addEventListener('click', () => {
        navMenu.classList.remove('active');
        const spans = menuToggle.querySelectorAll('span');
        spans[0].style.transform = 'none';
        spans[1].style.opacity = '1';
        spans[2].style.transform = 'none';
    });
});

// =============================================
// NAVBAR BACKGROUND ON SCROLL
// =============================================
const navbar = document.querySelector('.navbar');

window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        navbar.style.background = 'rgba(255, 255, 255, 0.98)';
        navbar.style.boxShadow = '0 4px 30px rgba(0, 0, 0, 0.15)';
    } else {
        navbar.style.background = 'rgba(255, 255, 255, 0.95)';
        navbar.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.1)';
    }
});

// =============================================
// SMOOTH SCROLL FOR ANCHOR LINKS
// =============================================
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));

        if (target) {
            const offsetTop = target.offsetTop - 80; // Account for fixed navbar
            window.scrollTo({
                top: offsetTop,
                behavior: 'smooth'
            });
        }
    });
});

// =============================================
// INTERSECTION OBSERVER FOR ANIMATIONS
// =============================================
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observe all animated elements
const animatedElements = document.querySelectorAll(
    '.feature-card, .product-card, .course-item, .gallery-item, .contact-item'
);

animatedElements.forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(30px)';
    el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    observer.observe(el);
});

// =============================================
// FORM SUBMISSION HANDLER
// =============================================
const contactForm = document.querySelector('.contact-form');

contactForm.addEventListener('submit', (e) => {
    e.preventDefault();

    // Get form data
    const formData = new FormData(contactForm);

    // Here you would normally send the data to a server
    // For now, we'll just show a success message

    // Create success message
    const successMessage = document.createElement('div');
    successMessage.style.cssText = `
        position: fixed;
        top: 100px;
        left: 50%;
        transform: translateX(-50%);
        background: linear-gradient(135deg, #e28dc4, #81cacf);
        color: white;
        padding: 1.5rem 3rem;
        border-radius: 50px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        z-index: 9999;
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        animation: slideDown 0.5s ease;
    `;
    successMessage.textContent = '¡Mensaje enviado! Te contactaremos pronto 🍫';

    document.body.appendChild(successMessage);

    // Reset form
    contactForm.reset();

    // Remove message after 5 seconds
    setTimeout(() => {
        successMessage.style.animation = 'slideUp 0.5s ease';
        setTimeout(() => {
            successMessage.remove();
        }, 500);
    }, 5000);
});

// Add animations for the success message
const style = document.createElement('style');
style.textContent = `
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translate(-50%, -100%);
        }
        to {
            opacity: 1;
            transform: translate(-50%, 0);
        }
    }

    @keyframes slideUp {
        from {
            opacity: 1;
            transform: translate(-50%, 0);
        }
        to {
            opacity: 0;
            transform: translate(-50%, -100%);
        }
    }
`;
document.head.appendChild(style);

// =============================================
// PARALLAX EFFECT FOR LIQUID SHAPES
// =============================================
const liquidShapes = document.querySelectorAll('.liquid-shape');

window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;

    liquidShapes.forEach((shape, index) => {
        const speed = 0.5 + (index * 0.1);
        const yPos = -(scrolled * speed);
        shape.style.transform = `translateY(${yPos}px)`;
    });
});

// =============================================
// PRODUCT CARD TILT EFFECT
// =============================================
const productCards = document.querySelectorAll('.product-card');

productCards.forEach(card => {
    card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        const centerX = rect.width / 2;
        const centerY = rect.height / 2;

        const rotateX = (y - centerY) / 10;
        const rotateY = (centerX - x) / 10;

        card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-10px)`;
    });

    card.addEventListener('mouseleave', () => {
        card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0)';
    });
});

// =============================================
// GALLERY LIGHTBOX EFFECT
// =============================================
const galleryItems = document.querySelectorAll('.gallery-item');

galleryItems.forEach(item => {
    item.addEventListener('click', () => {
        const title = item.querySelector('h4') ? item.querySelector('h4').textContent : 'Galería';
        const placeholder = item.querySelector('.gallery-placeholder, > div:first-child');

        // Get background gradient from the clicked item
        let backgroundGradient = 'linear-gradient(135deg, #e28dc4, #81cacf)';
        if (placeholder) {
            const computedStyle = window.getComputedStyle(placeholder);
            backgroundGradient = computedStyle.backgroundImage || computedStyle.background;
        }

        // Create lightbox overlay
        const lightbox = document.createElement('div');
        lightbox.className = 'gallery-lightbox';
        lightbox.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            animation: fadeIn 0.3s ease;
            padding: 2rem;
        `;

        // Create close button
        const closeBtn = document.createElement('button');
        closeBtn.innerHTML = `
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        `;
        closeBtn.style.cssText = `
            position: absolute;
            top: 2rem;
            right: 2rem;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            z-index: 10001;
        `;
        closeBtn.addEventListener('mouseenter', () => {
            closeBtn.style.background = '#e28dc4';
            closeBtn.style.transform = 'rotate(90deg) scale(1.1)';
        });
        closeBtn.addEventListener('mouseleave', () => {
            closeBtn.style.background = 'rgba(255, 255, 255, 0.1)';
            closeBtn.style.transform = 'rotate(0deg) scale(1)';
        });

        // Create image container
        const imageContainer = document.createElement('div');
        imageContainer.style.cssText = `
            max-width: 90%;
            max-height: 80vh;
            width: 600px;
            height: 600px;
            border-radius: 20px;
            background: ${backgroundGradient};
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.5);
            animation: zoomIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        `;

        // Add shimmer effect
        const shimmer = document.createElement('div');
        shimmer.style.cssText = `
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
            animation: shimmer 3s ease-in-out infinite;
        `;
        imageContainer.appendChild(shimmer);

        // Create title overlay
        const titleOverlay = document.createElement('div');
        titleOverlay.style.cssText = `
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            padding: 2rem;
            color: white;
            text-align: center;
        `;
        titleOverlay.innerHTML = `
            <h2 style="font-size: 2rem; margin-bottom: 0.5rem; font-family: 'Poppins', sans-serif; font-weight: 600;">${title}</h2>
            <p style="font-family: 'Dancing Script', cursive; font-size: 1.2rem; opacity: 0.9;">Creación artesanal de Chocoart</p>
        `;
        imageContainer.appendChild(titleOverlay);

        // Create instruction text
        const instruction = document.createElement('p');
        instruction.style.cssText = `
            color: rgba(255, 255, 255, 0.6);
            font-family: 'Quicksand', sans-serif;
            font-size: 0.9rem;
            margin-top: 1.5rem;
            text-align: center;
        `;
        instruction.textContent = 'Haz clic en cualquier lugar para cerrar';

        // Append elements
        lightbox.appendChild(closeBtn);
        lightbox.appendChild(imageContainer);
        lightbox.appendChild(instruction);
        document.body.appendChild(lightbox);

        // Prevent body scroll
        document.body.style.overflow = 'hidden';

        // Close functions
        const closeLightbox = () => {
            lightbox.style.animation = 'fadeOut 0.3s ease';
            imageContainer.style.animation = 'zoomOut 0.3s ease';
            setTimeout(() => {
                lightbox.remove();
                document.body.style.overflow = '';
            }, 300);
        };

        // Close on background click
        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) {
                closeLightbox();
            }
        });

        // Close on button click
        closeBtn.addEventListener('click', closeLightbox);

        // Close on ESC key
        const handleEscape = (e) => {
            if (e.key === 'Escape') {
                closeLightbox();
                document.removeEventListener('keydown', handleEscape);
            }
        };
        document.addEventListener('keydown', handleEscape);
    });
});

// Add lightbox animations
const fadeStyle = document.createElement('style');
fadeStyle.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }

    @keyframes zoomIn {
        from {
            opacity: 0;
            transform: scale(0.5);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes zoomOut {
        from {
            opacity: 1;
            transform: scale(1);
        }
        to {
            opacity: 0;
            transform: scale(0.5);
        }
    }

    @keyframes shimmer {
        0%, 100% {
            transform: translate(0, 0) rotate(0deg);
        }
        25% {
            transform: translate(10%, -10%) rotate(5deg);
        }
        50% {
            transform: translate(-5%, 10%) rotate(-5deg);
        }
        75% {
            transform: translate(-10%, -5%) rotate(3deg);
        }
    }

    .gallery-lightbox * {
        box-sizing: border-box;
    }
`;
document.head.appendChild(fadeStyle);

// =============================================
// COUNTER ANIMATION (for future stats section)
// =============================================
function animateCounter(element, target, duration = 2000) {
    let start = 0;
    const increment = target / (duration / 16); // 60fps

    const timer = setInterval(() => {
        start += increment;
        if (start >= target) {
            element.textContent = target;
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(start);
        }
    }, 16);
}

// =============================================
// LAZY LOADING FOR IMAGES (when you add real images)
// =============================================
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.classList.add('loaded');
                    observer.unobserve(img);
                }
            }
        });
    });

    // Observe all images with data-src attribute
    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });
}

// =============================================
// INITIALIZE EVERYTHING ON PAGE LOAD
// =============================================
window.addEventListener('load', () => {
    // Remove any loading screens
    document.body.classList.add('loaded');

    // Log success message
    console.log('%c🍫 Chocoart Website Loaded Successfully! ', 'background: linear-gradient(135deg, #e28dc4, #81cacf); color: white; padding: 10px 20px; border-radius: 5px; font-size: 16px; font-weight: bold;');
    console.log('%cArte con chocolate ✨', 'color: #5f3917; font-size: 14px; font-style: italic;');
});

// =============================================
// CURSOR FOLLOW EFFECT (Optional Enhancement)
// =============================================
let cursorFollower;

function createCursorFollower() {
    cursorFollower = document.createElement('div');
    cursorFollower.style.cssText = `
        position: fixed;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(226,141,196,0.3), transparent);
        pointer-events: none;
        z-index: 9999;
        transition: transform 0.2s ease;
        display: none;
    `;
    document.body.appendChild(cursorFollower);
}

// Only enable on desktop
if (window.innerWidth > 1024) {
    createCursorFollower();

    document.addEventListener('mousemove', (e) => {
        if (cursorFollower) {
            cursorFollower.style.display = 'block';
            cursorFollower.style.left = e.clientX - 10 + 'px';
            cursorFollower.style.top = e.clientY - 10 + 'px';
        }
    });

    // Scale up cursor on interactive elements
    const interactiveElements = document.querySelectorAll('a, button, .product-card, .gallery-item');

    interactiveElements.forEach(el => {
        el.addEventListener('mouseenter', () => {
            if (cursorFollower) {
                cursorFollower.style.transform = 'scale(2)';
            }
        });

        el.addEventListener('mouseleave', () => {
            if (cursorFollower) {
                cursorFollower.style.transform = 'scale(1)';
            }
        });
    });
}

// =============================================
// HERO CAROUSEL
// =============================================
const initCarousel = () => {
    const slides = document.querySelectorAll('.carousel-slide');
    const indicators = document.querySelectorAll('.carousel-indicators .indicator');
    const prevBtn = document.querySelector('.carousel-control.prev');
    const nextBtn = document.querySelector('.carousel-control.next');

    if (!slides.length) return;

    let currentSlide = 0;
    let isTransitioning = false;
    let autoplayInterval;

    const showSlide = (index) => {
        if (isTransitioning) return;
        isTransitioning = true;

        // Remove active class from all
        slides.forEach(slide => slide.classList.remove('active'));
        indicators.forEach(indicator => indicator.classList.remove('active'));

        // Add active to current
        slides[index].classList.add('active');
        indicators[index].classList.add('active');

        currentSlide = index;

        setTimeout(() => {
            isTransitioning = false;
        }, 600);
    };

    const nextSlide = () => {
        const next = (currentSlide + 1) % slides.length;
        showSlide(next);
    };

    const prevSlide = () => {
        const prev = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(prev);
    };

    // Event listeners
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            nextSlide();
            resetAutoplay();
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            prevSlide();
            resetAutoplay();
        });
    }

    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            showSlide(index);
            resetAutoplay();
        });
    });

    // Autoplay
    const startAutoplay = () => {
        autoplayInterval = setInterval(nextSlide, 5000);
    };

    const stopAutoplay = () => {
        if (autoplayInterval) {
            clearInterval(autoplayInterval);
        }
    };

    const resetAutoplay = () => {
        stopAutoplay();
        startAutoplay();
    };

    // Touch/Swipe support
    let touchStartX = 0;
    let touchEndX = 0;

    const carouselContainer = document.querySelector('.carousel-container');

    if (carouselContainer) {
        carouselContainer.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        });

        carouselContainer.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        const handleSwipe = () => {
            if (touchEndX < touchStartX - 50) {
                // Swipe left
                nextSlide();
                resetAutoplay();
            }
            if (touchEndX > touchStartX + 50) {
                // Swipe right
                prevSlide();
                resetAutoplay();
            }
        };
    }

    // Pause autoplay on hover
    const carouselSlides = document.querySelector('.carousel-slides');
    if (carouselSlides) {
        carouselSlides.addEventListener('mouseenter', stopAutoplay);
        carouselSlides.addEventListener('mouseleave', startAutoplay);
    }

    // Start autoplay
    startAutoplay();
};

// Initialize carousel when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCarousel);
} else {
    initCarousel();
}
