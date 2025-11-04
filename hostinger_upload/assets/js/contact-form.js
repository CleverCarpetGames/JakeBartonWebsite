/**
 * Contact Form Handler
 * AJAX form submission with validation
 */

class ContactForm {
    constructor(formId = 'contactForm') {
        this.form = document.getElementById(formId);
        if (!this.form) return;
        
        this.submitBtn = document.getElementById('submitBtn');
        this.messageDiv = document.getElementById('formMessage');
        
        this.init();
    }

    init() {
        this.form.addEventListener('submit', (e) => this.handleSubmit(e));
    }

    async handleSubmit(e) {
        e.preventDefault();
        
        // Disable button and show loading
        this.submitBtn.disabled = true;
        this.submitBtn.textContent = 'SENDING...';
        this.hideMessage();
        
        // Get form data
        const formData = new FormData(this.form);
        
        try {
            const response = await fetch('contact-handler.php', {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.showMessage(data.message, 'success');
                this.form.reset();
            } else {
                this.showMessage(data.errors.join(', '), 'error');
            }
        } catch (error) {
            this.showMessage(
                'Error sending message. Please try emailing directly at ' + 
                this.form.dataset.email || 'jbarton4@samford.edu',
                'error'
            );
        } finally {
            // Re-enable button
            this.submitBtn.disabled = false;
            this.submitBtn.textContent = 'SEND MESSAGE';
        }
    }

    showMessage(message, type) {
        if (!this.messageDiv) return;
        
        this.messageDiv.textContent = message;
        this.messageDiv.className = 'form-message ' + type;
        this.messageDiv.style.display = 'block';
        
        // Auto-hide success messages after 5 seconds
        if (type === 'success') {
            setTimeout(() => this.hideMessage(), 5000);
        }
    }

    hideMessage() {
        if (!this.messageDiv) return;
        this.messageDiv.style.display = 'none';
    }
}

// Auto-initialize contact form
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => new ContactForm());
} else {
    new ContactForm();
}
