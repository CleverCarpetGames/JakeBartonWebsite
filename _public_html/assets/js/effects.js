// Interactive Effects for Jake Barton Website
// Includes: Particles Background, Flowing Menu, Scroll Reveal

// ======================
// UTILITY: Debounce Function
// ======================
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// ======================
// 1. PARTICLES BACKGROUND
// ======================
class ParticlesBackground {
    constructor() {
        this.canvas = null;
        this.ctx = null;
        this.particles = [];
        this.particleCount = 80; // Number of particles
        this.init();
    }

    init() {
        // Create canvas for particles
        this.canvas = document.createElement('canvas');
        this.canvas.id = 'particles-canvas';
        this.canvas.style.position = 'fixed';
        this.canvas.style.top = '0';
        this.canvas.style.left = '0';
        this.canvas.style.width = '100%';
        this.canvas.style.height = '100%';
        this.canvas.style.zIndex = '-1';
        this.canvas.style.pointerEvents = 'none';

        // Insert before animated-bg
        const animatedBg = document.querySelector('.animated-bg');
        if (animatedBg) {
            animatedBg.parentNode.insertBefore(this.canvas, animatedBg);
        } else {
            document.body.insertBefore(this.canvas, document.body.firstChild);
        }

        this.ctx = this.canvas.getContext('2d');
        this.resize();
        this.createParticles();
        this.animate();

        // Handle resize with debouncing
        const debouncedResize = debounce(() => this.resize(), 250);
        window.addEventListener('resize', debouncedResize);
    }

    resize() {
        this.canvas.width = window.innerWidth;
        this.canvas.height = window.innerHeight;
    }

    createParticles() {
        this.particles = [];
        for (let i = 0; i < this.particleCount; i++) {
            this.particles.push({
                x: Math.random() * this.canvas.width,
                y: Math.random() * this.canvas.height,
                vx: (Math.random() - 0.5) * 0.5,
                vy: (Math.random() - 0.5) * 0.5,
                size: Math.random() * 2 + 1,
                opacity: Math.random() * 0.5 + 0.2
            });
        }
    }

    animate() {
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);

        // Update and draw particles
        this.particles.forEach((particle, i) => {
            // Move particle
            particle.x += particle.vx;
            particle.y += particle.vy;

            // Wrap around screen
            if (particle.x < 0) particle.x = this.canvas.width;
            if (particle.x > this.canvas.width) particle.x = 0;
            if (particle.y < 0) particle.y = this.canvas.height;
            if (particle.y > this.canvas.height) particle.y = 0;

            // Draw particle
            this.ctx.fillStyle = `rgba(255, 255, 255, ${particle.opacity})`;
            this.ctx.beginPath();
            this.ctx.arc(particle.x, particle.y, particle.size, 0, Math.PI * 2);
            this.ctx.fill();

            // Draw connections
            for (let j = i + 1; j < this.particles.length; j++) {
                const p2 = this.particles[j];
                const dx = particle.x - p2.x;
                const dy = particle.y - p2.y;
                const distance = Math.sqrt(dx * dx + dy * dy);

                if (distance < 120) {
                    const opacity = (1 - distance / 120) * 0.2;
                    this.ctx.strokeStyle = `rgba(255, 255, 255, ${opacity})`;
                    this.ctx.lineWidth = 0.5;
                    this.ctx.beginPath();
                    this.ctx.moveTo(particle.x, particle.y);
                    this.ctx.lineTo(p2.x, p2.y);
                    this.ctx.stroke();
                }
            }
        });

        requestAnimationFrame(() => this.animate());
    }
}

// ======================
// 2. FLOWING MENU
// ======================
class FlowingMenu {
    constructor() {
        this.nav = document.querySelector('nav ul');
        this.links = Array.from(document.querySelectorAll('nav ul li a'));
        this.indicator = null;
        
        if (!this.nav || this.links.length === 0) return;
        
        this.init();
    }

    init() {
        // Create flowing indicator
        this.indicator = document.createElement('div');
        this.indicator.className = 'nav-indicator';
        this.indicator.style.width = '0px';
        this.indicator.style.opacity = '1';
        this.nav.appendChild(this.indicator);

        // Track active link
        this.links.forEach((link, index) => {
            link.addEventListener('mouseenter', () => this.moveIndicator(link));
            link.addEventListener('click', (e) => {
                this.setActive(link);
            });
        });

        // Set initial position
        const activeLink = document.querySelector('nav ul li a.active') || this.links[0];
        if (activeLink) {
            setTimeout(() => {
                this.setActive(activeLink);
            }, 50);
        }

        // Handle mouse leave
        this.nav.addEventListener('mouseleave', () => {
            const activeLink = document.querySelector('nav ul li a.active') || this.links[0];
            if (activeLink) {
                this.moveIndicator(activeLink);
            }
        });
    }

    moveIndicator(link) {
        if (!this.indicator || !link) return;
        
        const linkRect = link.getBoundingClientRect();
        const navRect = this.nav.getBoundingClientRect();
        
        const width = linkRect.width;
        const left = linkRect.left - navRect.left;
        
        this.indicator.style.width = `${width}px`;
        this.indicator.style.left = `${left}px`;
    }

    setActive(link) {
        this.links.forEach(l => l.classList.remove('active'));
        link.classList.add('active');
        this.moveIndicator(link);
    }
}

// ======================
// 3. SCROLL REVEAL ANIMATIONS
// ======================
class ScrollReveal {
    constructor() {
        this.elements = [];
        this.init();
    }

    init() {
        // Find all sections to reveal
        this.elements = document.querySelectorAll('.content-section, .showcase-item, .skill-tag');
        
        // Create observer
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        // Observe all elements
        this.elements.forEach(el => {
            el.classList.add('reveal-item');
            observer.observe(el);
        });
    }
}

// ======================
// INITIALIZE ALL EFFECTS
// ======================
function initializeEffects() {
    try {
        new ParticlesBackground();
    } catch (e) {
        // Silently fail in production
    }

    try {
        new FlowingMenu();
    } catch (e) {
        // Silently fail in production
    }

    try {
        new ScrollReveal();
    } catch (e) {
        // Silently fail in production
    }
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeEffects);
} else {
    initializeEffects();
}
