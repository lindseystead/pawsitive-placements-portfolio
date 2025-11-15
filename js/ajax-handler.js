/**
 * Pawsitive Placements
 * 
 * @file       js/ajax-handler.js
 * @author     Lindsey D. Stead
 * @date       November 7, 2025
 * @description Centralized AJAX utility functions for form submissions.
 *              Provides consistent error handling, loading states, and user feedback.
 */

/**
 * Submits a form via AJAX
 * @param {string} formSelector - CSS selector for the form
 * @param {string} apiEndpoint - API endpoint URL
 * @param {Object} options - Configuration options
 */
function submitFormAjax(formSelector, apiEndpoint, options = {}) {
    const form = document.querySelector(formSelector);
    if (!form) {
        console.error('Form not found:', formSelector);
        return;
    }
    
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const formData = new FormData(form);
        const submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
        const originalText = submitBtn ? submitBtn.textContent || submitBtn.value : '';
        const messageContainer = options.messageContainer || form.parentElement;
        
        // Show loading state
        if (submitBtn) {
            submitBtn.disabled = true;
            if (submitBtn.tagName === 'BUTTON') {
                submitBtn.textContent = 'Submitting...';
            } else {
                submitBtn.value = 'Submitting...';
            }
        }
        
        // Remove any existing messages
        const existingMessages = messageContainer.querySelectorAll('.ajax-message');
        existingMessages.forEach(msg => msg.remove());
        
        try {
            const response = await fetch(apiEndpoint, {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                // Show success message
                showMessage(data.message || 'Operation completed successfully!', 'success', messageContainer);
                
                // Reset form if option is set (default: true)
                if (options.resetForm !== false) {
                    form.reset();
                }
                
                // Call success callback if provided
                if (options.onSuccess) {
                    options.onSuccess(data);
                }
            } else {
                // Show error message
                const errorMsg = data.error || 'An error occurred. Please try again.';
                showMessage(errorMsg, 'error', messageContainer);
                
                // Show field-level errors if provided
                if (data.errors) {
                    showFieldErrors(data.errors);
                }
                
                // Call error callback if provided
                if (options.onError) {
                    options.onError(data);
                }
            }
        } catch (error) {
            console.error('AJAX Error:', error);
            showMessage('Network error. Please check your connection and try again.', 'error', messageContainer);
            
            if (options.onError) {
                options.onError({ error: 'Network error' });
            }
        } finally {
            // Restore button state
            if (submitBtn) {
                submitBtn.disabled = false;
                if (submitBtn.tagName === 'BUTTON') {
                    submitBtn.textContent = originalText;
                } else {
                    submitBtn.value = originalText;
                }
            }
        }
    });
}

/**
 * Shows a message to the user
 * @param {string} message - Message text
 * @param {string} type - Message type ('success' or 'error')
 * @param {HTMLElement} container - Container element to insert message
 */
function showMessage(message, type, container) {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type === 'success' ? 'success' : 'danger'} ajax-message`;
    alertDiv.setAttribute('role', 'alert');
    alertDiv.innerHTML = `<strong>${type === 'success' ? 'Success!' : 'Error:'}</strong> ${escapeHtml(message)}`;
    
    // Insert at top of container
    if (container) {
        container.insertBefore(alertDiv, container.firstChild);
    } else {
        document.body.insertBefore(alertDiv, document.body.firstChild);
    }
    
    // Auto-remove after 5 seconds (optional)
    if (type === 'success') {
        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 5000);
    }
    
    // Scroll to message
    alertDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

/**
 * Shows field-level validation errors
 * @param {Object} errors - Object with field names as keys and error messages as values
 */
function showFieldErrors(errors) {
    Object.keys(errors).forEach(fieldName => {
        const field = document.querySelector(`[name="${fieldName}"]`);
        if (field) {
            // Add error class
            field.classList.add('is-invalid');
            
            // Show error message
            let errorDiv = field.parentElement.querySelector('.invalid-feedback');
            if (!errorDiv) {
                errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback';
                field.parentElement.appendChild(errorDiv);
            }
            errorDiv.textContent = errors[fieldName];
            
            // Remove error on input
            field.addEventListener('input', function() {
                field.classList.remove('is-invalid');
                if (errorDiv) {
                    errorDiv.textContent = '';
                }
            }, { once: true });
        }
    });
}

/**
 * Escapes HTML to prevent XSS
 * @param {string} text - Text to escape
 * @returns {string} Escaped text
 */
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

/**
 * Gets CSRF token from form or meta tag
 * @returns {string} CSRF token
 */
function getCsrfToken() {
    // Try to get from form
    const csrfInput = document.querySelector('input[name="csrf_token"]');
    if (csrfInput) {
        return csrfInput.value;
    }
    
    // Try to get from meta tag
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    if (csrfMeta) {
        return csrfMeta.getAttribute('content');
    }
    
    return '';
}

/**
 * Handles redirects from API responses
 * @param {string} url - URL to redirect to
 */
function handleRedirect(url) {
    if (url) {
        window.location.href = url;
    }
}

