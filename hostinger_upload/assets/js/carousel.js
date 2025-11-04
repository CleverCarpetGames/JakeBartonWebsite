/**
 * Card Stack Carousel - Enhanced Auto-Rotating Showcase
 * Smooth 3D card stacking effect with automatic rotation
 */

class Carousel {
    constructor(selector = '.carousel-wrapper') {
        this.wrapper = document.querySelector(selector);
        if (!this.wrapper) {
            console.warn('Carousel: Wrapper not found');
            return;
        }
        
        this.slides = Array.from(this.wrapper.querySelectorAll('.carousel-slide'));
        this.currentIndex = 0;
        this.totalSlides = this.slides.length;
        this.autoplayInterval = null;
        this.autoplayDelay = 3500; // 3.5 seconds
        this.isPaused = false;
        
        if (this.totalSlides === 0) {
            console.warn('Carousel: No slides found');
            return;
        }
        
        this.init();
    }

    init() {
        // Set initial positions
        this.updatePositions();
        
        // Start autoplay
        this.startAutoplay();
        
        // Pause on hover
        this.wrapper.addEventListener('mouseenter', () => this.pause());
        this.wrapper.addEventListener('mouseleave', () => this.resume());
        
        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') this.prev();
            if (e.key === 'ArrowRight') this.next();
        });
        
        console.log(`Carousel: Initialized with ${this.totalSlides} slides`);
    }

    updatePositions() {
        this.slides.forEach((slide, index) => {
            // Calculate relative position
            let relativePos = (index - this.currentIndex + this.totalSlides) % this.totalSlides;
            
            // Remove all position classes
            slide.className = 'carousel-slide';
            
            // Assign position class
            if (relativePos === 0) {
                slide.classList.add('position-0'); // Active center
            } else if (relativePos === 1) {
                slide.classList.add('position-1'); // First behind
            } else if (relativePos === 2) {
                slide.classList.add('position-2'); // Second behind
            } else if (relativePos === this.totalSlides - 1) {
                slide.classList.add('position-exit'); // Exiting to left
            } else {
                slide.classList.add('position-enter'); // Entering from right
            }
        });
    }

    next() {
        this.currentIndex = (this.currentIndex + 1) % this.totalSlides;
        this.updatePositions();
    }

    prev() {
        this.currentIndex = (this.currentIndex - 1 + this.totalSlides) % this.totalSlides;
        this.updatePositions();
    }

    startAutoplay() {
        if (this.autoplayInterval) return;
        this.autoplayInterval = setInterval(() => {
            if (!this.isPaused) {
                this.next();
            }
        }, this.autoplayDelay);
    }

    stopAutoplay() {
        if (this.autoplayInterval) {
            clearInterval(this.autoplayInterval);
            this.autoplayInterval = null;
        }
    }

    pause() {
        this.isPaused = true;
    }

    resume() {
        this.isPaused = false;
    }

    destroy() {
        this.stopAutoplay();
        this.slides.forEach(slide => {
            slide.className = 'carousel-slide';
        });
    }
}

// Auto-initialize carousel when DOM is ready
function initCarousel() {
    if (document.querySelector('.carousel-wrapper')) {
        new Carousel();
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCarousel);
} else {
    initCarousel();
}

// Export for manual initialization if needed
if (typeof module !== 'undefined' && module.exports) {
    module.exports = Carousel;
}
