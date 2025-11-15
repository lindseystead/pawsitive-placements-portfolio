/**
 * Pawsitive Placements
 * 
 * @file       js/forum.js
 * @author     Lindsey D. Stead
 * @date       November 7, 2025
 * @description JavaScript utilities for the community forum, including
 *              relative time formatting and interactive features.
 */

/**
 * Converts a timestamp to relative time (e.g., "2 hours ago")
 * @param {string} timestamp - ISO timestamp string
 * @returns {string} Relative time string
 */
function formatRelativeTime(timestamp) {
    if (!timestamp) return '';
    
    const now = new Date();
    const time = new Date(timestamp);
    const diffMs = now - time;
    const diffSecs = Math.floor(diffMs / 1000);
    const diffMins = Math.floor(diffSecs / 60);
    const diffHours = Math.floor(diffMins / 60);
    const diffDays = Math.floor(diffHours / 24);
    const diffWeeks = Math.floor(diffDays / 7);
    const diffMonths = Math.floor(diffDays / 30);
    const diffYears = Math.floor(diffDays / 365);
    
    if (diffSecs < 60) {
        return 'Just now';
    } else if (diffMins < 60) {
        return `${diffMins} minute${diffMins !== 1 ? 's' : ''} ago`;
    } else if (diffHours < 24) {
        return `${diffHours} hour${diffHours !== 1 ? 's' : ''} ago`;
    } else if (diffDays < 7) {
        return `${diffDays} day${diffDays !== 1 ? 's' : ''} ago`;
    } else if (diffWeeks < 4) {
        return `${diffWeeks} week${diffWeeks !== 1 ? 's' : ''} ago`;
    } else if (diffMonths < 12) {
        return `${diffMonths} month${diffMonths !== 1 ? 's' : ''} ago`;
    } else {
        return `${diffYears} year${diffYears !== 1 ? 's' : ''} ago`;
    }
}

/**
 * Updates all relative time elements on the page
 */
function updateRelativeTimes() {
    document.querySelectorAll('[data-timestamp]').forEach(function(element) {
        const timestamp = element.getAttribute('data-timestamp');
        const relativeTime = formatRelativeTime(timestamp);
        if (relativeTime) {
            element.textContent = relativeTime;
            element.title = new Date(timestamp).toLocaleString();
        }
    });
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    updateRelativeTimes();
    
    // Update relative times every minute
    setInterval(updateRelativeTimes, 60000);
    
    // Add smooth scroll to comments
    document.querySelectorAll('a[href^="#comment"]').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const target = document.getElementById(targetId);
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'center' });
                target.classList.add('highlight-comment');
                setTimeout(function() {
                    target.classList.remove('highlight-comment');
                }, 2000);
            }
        });
    });
});

