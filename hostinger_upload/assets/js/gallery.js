// Gallery and Modal functionality with enhanced animations
class GalleryManager {
    constructor() {
        this.currentIndex = 0;
        this.designs = [];
        this.modal = null;
        this.init();
    }

    init() {
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.setup());
        } else {
            this.setup();
        }
        
        // Add parallax scrolling effect
        this.addParallaxEffect();
    }

    addParallaxEffect() {
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const parallaxElements = document.querySelectorAll('.animated-bg');
            parallaxElements.forEach(el => {
                el.style.transform = `translateY(${scrolled * 0.5}px)`;
            });
        });
    }

    setup() {
        this.modal = document.getElementById('designModal');
        if (!this.modal) return;

        // Get all gallery items
        this.designs = Array.from(document.querySelectorAll('.gallery-item'));

        // Add click handlers to gallery items
        this.designs.forEach((item, index) => {
            item.addEventListener('click', () => this.openModal(index));
        });

        // Close modal handlers
        const closeBtn = document.querySelector('.close');
        if (closeBtn) {
            closeBtn.addEventListener('click', () => this.closeModal());
        }

        // Navigation handlers
        const prevBtn = document.querySelector('.modal-prev');
        const nextBtn = document.querySelector('.modal-next');
        
        if (prevBtn) {
            prevBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                this.navigate(-1);
            });
        }
        
        if (nextBtn) {
            nextBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                this.navigate(1);
            });
        }

        // Close on outside click
        this.modal.addEventListener('click', (e) => {
            if (e.target === this.modal) {
                this.closeModal();
            }
        });

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (this.modal.style.display === 'block') {
                if (e.key === 'Escape') this.closeModal();
                if (e.key === 'ArrowLeft') this.navigate(-1);
                if (e.key === 'ArrowRight') this.navigate(1);
            }
        });

        // Filter functionality
        this.setupFilters();
    }

    setupFilters() {
        const filterBtns = document.querySelectorAll('.filter-btn');
        filterBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                // Remove active class from all buttons
                filterBtns.forEach(b => b.classList.remove('active'));
                // Add active class to clicked button
                e.target.classList.add('active');
                
                const filter = e.target.dataset.filter;
                this.filterGallery(filter);
            });
        });
    }

    filterGallery(filter) {
        this.designs.forEach(item => {
            if (filter === 'all' || item.dataset.year === filter) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    openModal(index) {
        this.currentIndex = index;
        this.updateModal();
        this.modal.style.display = 'block';
        document.body.style.overflow = 'hidden'; // Prevent scrolling
    }

    closeModal() {
        this.modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    navigate(direction) {
        const visibleDesigns = this.designs.filter(d => d.style.display !== 'none');
        const currentVisibleIndex = visibleDesigns.findIndex(d => 
            d === this.designs[this.currentIndex]
        );
        
        let newIndex = currentVisibleIndex + direction;
        
        // Wrap around
        if (newIndex < 0) newIndex = visibleDesigns.length - 1;
        if (newIndex >= visibleDesigns.length) newIndex = 0;
        
        this.currentIndex = this.designs.indexOf(visibleDesigns[newIndex]);
        this.updateModalWithAnimation();
    }

    updateModalWithAnimation() {
        const modalImg = document.getElementById('modalImage');
        const modalInfo = document.querySelector('.modal-info');
        
        // Add fade-out class to both image and info
        modalImg.classList.add('fade-out');
        if (modalInfo) modalInfo.classList.add('fade-out');
        
        // Wait for fade-out, then update and fade-in
        setTimeout(() => {
            this.updateModal();
            modalImg.classList.remove('fade-out');
            modalImg.classList.add('fade-in');
            if (modalInfo) {
                modalInfo.classList.remove('fade-out');
                modalInfo.classList.add('fade-in');
            }
            
            // Remove fade-in class after animation completes
            setTimeout(() => {
                modalImg.classList.remove('fade-in');
                if (modalInfo) modalInfo.classList.remove('fade-in');
            }, 400);
        }, 150);
    }

    updateModal() {
        const design = this.designs[this.currentIndex];
        const img = design.querySelector('img');
        const title = design.dataset.title;
        const description = design.dataset.description;
        const year = design.dataset.year;

        // Update modal image
        const modalImg = document.getElementById('modalImage');
        if (modalImg && img) {
            // Use full-size image instead of thumbnail
            const fullImageSrc = img.src.replace('/thumbnails/', '/full/');
            modalImg.src = fullImageSrc;
            modalImg.alt = title;
        }

        // Update modal info
        const modalTitle = document.getElementById('modalTitle');
        const modalDescription = document.getElementById('modalDescription');
        const modalYear = document.getElementById('modalYear');

        if (modalTitle) modalTitle.textContent = title;
        if (modalDescription) modalDescription.textContent = description;
        if (modalYear) modalYear.textContent = year;
    }
}

// Initialize gallery when script loads
new GalleryManager();
