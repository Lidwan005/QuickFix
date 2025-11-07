// QuickFix - Main JavaScript File
// Contains all interactive functionality for the platform

// Global variables
let currentFilters = {
    category: '',
    location: '',
    minRating: 0,
    maxPrice: Infinity
};

// DOM Content Loaded - Initialize all functionality
document.addEventListener('DOMContentLoaded', function() {
    initializeSearch();
    initializeFilters();
    initializeRatings();
    initializeBooking();
    initializeMobileMenu();
    initializeFormValidation();
    
    console.log('QuickFix platform initialized successfully!');
});

// Search functionality
function initializeSearch() {
    // Homepage search form
    const searchForm = document.querySelector('.search-box');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const searchInput = this.querySelector('input[name="search"]');
            const locationInput = this.querySelector('input[name="location"]');
            const query = searchInput ? searchInput.value.trim() : '';
            const location = locationInput ? locationInput.value.trim() : '';
            
            if (query || location) {
                let url = 'browse.php?';
                if (query) url += `search=${encodeURIComponent(query)}`;
                if (location) url += `${query ? '&' : ''}location=${encodeURIComponent(location)}`;
                window.location.href = url;
            }
        });
    }

    // Browse page URL parameter handling
    const urlParams = new URLSearchParams(window.location.search);
    const searchQuery = urlParams.get('search');
    const categoryQuery = urlParams.get('category');
    const locationQuery = urlParams.get('location');

    if (searchQuery && document.getElementById('location')) {
        document.getElementById('location').value = searchQuery;
    }
    
    if (locationQuery && document.getElementById('location')) {
        document.getElementById('location').value = locationQuery;
    }

    if (categoryQuery && document.getElementById('category')) {
        document.getElementById('category').value = categoryQuery;
        // Auto-apply filters if category comes from URL
        setTimeout(() => applyFilters(), 100);
    }
}

// Filter functionality for browse page
function initializeFilters() {
    const filterForm = document.querySelector('.filters');
    if (!filterForm) return;

    // Auto-apply filters when inputs change (optional)
    const filterInputs = filterForm.querySelectorAll('select, input');
    filterInputs.forEach(input => {
        input.addEventListener('change', function() {
            // For instant filtering, uncomment the line below:
            // applyFilters();
        });
    });

    // Initialize current filters from form
    updateCurrentFilters();
}

function updateCurrentFilters() {
    const categorySelect = document.getElementById('category');
    const locationInput = document.getElementById('location');
    const ratingSelect = document.getElementById('rating');
    const priceInput = document.getElementById('price');

    currentFilters = {
        category: categorySelect ? categorySelect.value : '',
        location: locationInput ? locationInput.value.trim() : '',
        minRating: ratingSelect ? parseFloat(ratingSelect.value) || 0 : 0,
        maxPrice: priceInput ? parseFloat(priceInput.value) || Infinity : Infinity
    };
}

function applyFilters() {
    updateCurrentFilters();
    
    const providerCards = document.querySelectorAll('.provider-card');
    let visibleCount = 0;
    
    providerCards.forEach(card => {
        const cardCategory = card.getAttribute('data-category');
        const cardRating = parseFloat(card.getAttribute('data-rating'));
        const cardPrice = parseFloat(card.getAttribute('data-price'));
        const cardLocation = card.getAttribute('data-location') || '';
        
        const categoryMatch = !currentFilters.category || cardCategory === currentFilters.category;
        const ratingMatch = cardRating >= currentFilters.minRating;
        const priceMatch = cardPrice <= currentFilters.maxPrice;
        const locationMatch = !currentFilters.location || 
                             cardLocation.toLowerCase().includes(currentFilters.location.toLowerCase());
        
        if (categoryMatch && ratingMatch && priceMatch && locationMatch) {
            card.style.display = 'block';
            card.style.opacity = '0';
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transition = 'opacity 0.3s ease';
            }, 10);
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });
    
    showResultsMessage(visibleCount);
    updateURLWithFilters();
}

function clearFilters() {
    // Reset form inputs
    const categorySelect = document.getElementById('category');
    const locationInput = document.getElementById('location');
    const ratingSelect = document.getElementById('rating');
    const priceInput = document.getElementById('price');

    if (categorySelect) categorySelect.value = '';
    if (locationInput) locationInput.value = '';
    if (ratingSelect) ratingSelect.value = '';
    if (priceInput) priceInput.value = '';

    // Reset current filters
    currentFilters = {
        category: '',
        location: '',
        minRating: 0,
        maxPrice: Infinity
    };

    // Show all cards with fade-in effect
    const providerCards = document.querySelectorAll('.provider-card');
    providerCards.forEach((card, index) => {
        setTimeout(() => {
            card.style.display = 'block';
            card.style.opacity = '0';
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transition = 'opacity 0.3s ease';
            }, 10);
        }, index * 50); // Staggered appearance
    });

    // Remove results message
    const resultsMessage = document.getElementById('results-message');
    if (resultsMessage) {
        resultsMessage.remove();
    }

    // Update URL
    updateURLWithFilters();
}

function showResultsMessage(visibleCount) {
    let resultsMessage = document.getElementById('results-message');
    
    if (!resultsMessage) {
        resultsMessage = document.createElement('div');
        resultsMessage.id = 'results-message';
        resultsMessage.style.cssText = `
            text-align: center; 
            padding: 1rem; 
            font-size: 1.1rem; 
            color: #2c3e50; 
            margin: 1rem 0;
            background: #ecf0f1;
            border-radius: 8px;
            border-left: 4px solid #3498db;
        `;
        const providersGrid = document.querySelector('.providers-grid');
        if (providersGrid) {
            providersGrid.insertAdjacentElement('beforebegin', resultsMessage);
        }
    }
    
    if (visibleCount === 0) {
        resultsMessage.innerHTML = `
            <i class="fas fa-search" style="margin-right: 0.5rem;"></i>
            No providers match your filters. Try adjusting your criteria.
            <button onclick="clearFilters()" style="margin-left: 1rem; padding: 0.3rem 0.8rem; background: #3498db; color: white; border: none; border-radius: 4px; cursor: pointer;">
                Show All Providers
            </button>
        `;
        resultsMessage.style.background = '#ffeaa7';
        resultsMessage.style.borderLeftColor = '#fdcb6e';
    } else {
        resultsMessage.textContent = `Found ${visibleCount} provider${visibleCount !== 1 ? 's' : ''} matching your criteria`;
        resultsMessage.style.background = '#d1f2eb';
        resultsMessage.style.borderLeftColor = '#27ae60';
    }
}

function updateURLWithFilters() {
    if (!window.history.replaceState) return;
    
    let newUrl = 'browse.php?';
    const params = [];
    
    if (currentFilters.category) params.push(`category=${encodeURIComponent(currentFilters.category)}`);
    if (currentFilters.location) params.push(`location=${encodeURIComponent(currentFilters.location)}`);
    if (currentFilters.minRating > 0) params.push(`rating=${currentFilters.minRating}`);
    if (currentFilters.maxPrice < Infinity) params.push(`price=${currentFilters.maxPrice}`);
    
    newUrl += params.join('&');
    window.history.replaceState({}, '', newUrl);
}

// Rating display functionality
function initializeRatings() {
    const ratingElements = document.querySelectorAll('.rating');
    ratingElements.forEach(rating => {
        const score = parseFloat(rating.textContent);
        if (!isNaN(score)) {
            const fullStars = '★'.repeat(Math.floor(score));
            const hasHalfStar = score % 1 >= 0.5;
            const emptyStars = '☆'.repeat(5 - Math.floor(score) - (hasHalfStar ? 1 : 0));
            const halfStar = hasHalfStar ? '⭐' : ''; // Half-star approximation
            
            rating.innerHTML = `
                <span style="color: #f39c12;">${fullStars}${halfStar}${emptyStars}</span>
                <span style="color: #7f8c8d; font-size: 0.9em; margin-left: 0.5rem;">${score.toFixed(1)}</span>
            `;
        }
    });
}

// Booking functionality
function initializeBooking() {
    const bookButtons = document.querySelectorAll('.book-btn');
    bookButtons.forEach(button => {
        button.addEventListener('click', function() {
            const providerCard = this.closest('.provider-card');
            const providerName = providerCard.querySelector('h3').textContent;
            const providerPrice = providerCard.querySelector('.price').textContent;
            const providerRating = providerCard.querySelector('.rating').textContent;
            
            showBookingModal(providerName, providerPrice, providerRating);
        });
    });
}

function showBookingModal(providerName, price, rating) {
    // Create modal overlay
    const modalOverlay = document.createElement('div');
    modalOverlay.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.7);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    `;
    
    // Create modal content
    const modalContent = document.createElement('div');
    modalContent.style.cssText = `
        background: white;
        padding: 2rem;
        border-radius: 12px;
        max-width: 500px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
        position: relative;
    `;
    
    modalContent.innerHTML = `
        <button onclick="closeModal()" style="position: absolute; top: 1rem; right: 1rem; background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #7f8c8d;">&times;</button>
        <h2 style="color: #2c3e50; margin-bottom: 1rem;">Book Service with ${providerName}</h2>
        <div style="background: #f8f9fa; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
            <div><strong>Price:</strong> ${price}</div>
            <div><strong>Rating:</strong> ${rating}</div>
        </div>
        <form id="booking-form">
            <div class="form-group">
                <label for="booking-date">Preferred Date</label>
                <input type="date" id="booking-date" name="booking-date" required min="${getTomorrowDate()}">
            </div>
            <div class="form-group">
                <label for="booking-time">Preferred Time</label>
                <select id="booking-time" name="booking-time" required>
                    <option value="">Select a time</option>
                    <option value="09:00">9:00 AM</option>
                    <option value="10:00">10:00 AM</option>
                    <option value="11:00">11:00 AM</option>
                    <option value="12:00">12:00 PM</option>
                    <option value="14:00">2:00 PM</option>
                    <option value="15:00">3:00 PM</option>
                    <option value="16:00">4:00 PM</option>
                </select>
            </div>
            <div class="form-group">
                <label for="service-details">Service Details</label>
                <textarea id="service-details" name="service-details" placeholder="Please describe the service you need..." required></textarea>
            </div>
            <div class="form-group">
                <label for="customer-address">Your Address</label>
                <input type="text" id="customer-address" name="customer-address" placeholder="Enter your address for service" required>
            </div>
            <button type="submit" class="btn-primary" style="margin-top: 1rem;">
                <i class="fas fa-calendar-check" style="margin-right: 0.5rem;"></i>
                Confirm Booking
            </button>
        </form>
    `;
    
    modalOverlay.appendChild(modalContent);
    document.body.appendChild(modalOverlay);
    
    // Handle form submission
    const bookingForm = modalContent.querySelector('#booking-form');
    bookingForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const bookingDetails = {
            provider: providerName,
            date: formData.get('booking-date'),
            time: formData.get('booking-time'),
            details: formData.get('service-details'),
            address: formData.get('customer-address')
        };
        
        processBooking(bookingDetails);
        closeModal();
    });
    
    // Prevent closing when clicking inside modal
    modalContent.addEventListener('click', function(e) {
        e.stopPropagation();
    });
    
    // Close modal when clicking overlay
    modalOverlay.addEventListener('click', closeModal);
}

function closeModal() {
    const modal = document.querySelector('div[style*="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7)"]');
    if (modal) {
        modal.remove();
    }
}

function getTomorrowDate() {
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    return tomorrow.toISOString().split('T')[0];
}

function processBooking(bookingDetails) {
    // Simulate booking process
    const loadingAlert = `
        <div style="
            position: fixed; 
            top: 50%; 
            left: 50%; 
            transform: translate(-50%, -50%); 
            background: white; 
            padding: 2rem; 
            border-radius: 12px; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.3); 
            z-index: 1001;
            text-align: center;
        ">
            <div style="font-size: 3rem; color: #3498db; margin-bottom: 1rem;">
                <i class="fas fa-spinner fa-spin"></i>
            </div>
            <h3>Processing Your Booking...</h3>
            <p>Please wait while we confirm your appointment.</p>
        </div>
    `;
    
    document.body.insertAdjacentHTML('beforeend', loadingAlert);
    
    // Simulate API call delay
    setTimeout(() => {
        document.querySelector('div[style*="position: fixed; top: 50%"]').remove();
        
        alert(`🎉 Booking Confirmed!\n\nService with: ${bookingDetails.provider}\nDate: ${bookingDetails.date}\nTime: ${bookingDetails.time}\n\nYou will receive a confirmation email shortly.\n\nIn Sprint 2, this will integrate with the actual booking system.`);
    }, 2000);
}

// Mobile menu functionality
function initializeMobileMenu() {
    // This will be enhanced in future sprints for mobile responsiveness
    console.log('Mobile menu initialized - ready for enhancement');
}

// Form validation
function initializeFormValidation() {
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    highlightFieldError(field);
                } else {
                    clearFieldError(field);
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                showFormError('Please fill in all required fields.');
            }
        });
    });
}

function highlightFieldError(field) {
    field.style.borderColor = '#e74c3c';
    field.style.backgroundColor = '#fdf2f2';
}

function clearFieldError(field) {
    field.style.borderColor = '';
    field.style.backgroundColor = '';
}

function showFormError(message) {
    // Remove existing error message
    const existingError = document.querySelector('.form-error-message');
    if (existingError) {
        existingError.remove();
    }
    
    // Create new error message
    const errorDiv = document.createElement('div');
    errorDiv.className = 'form-error-message';
    errorDiv.style.cssText = `
        background: #e74c3c;
        color: white;
        padding: 1rem;
        border-radius: 6px;
        margin: 1rem 0;
        text-align: center;
    `;
    errorDiv.innerHTML = `
        <i class="fas fa-exclamation-triangle" style="margin-right: 0.5rem;"></i>
        ${message}
    `;
    
    const form = document.querySelector('form');
    if (form) {
        form.insertBefore(errorDiv, form.firstChild);
    }
}

// Utility functions
function formatPrice(amount) {
    return `₵${parseFloat(amount).toFixed(2)}`;
}

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

// Export functions for global access (if needed)
window.applyFilters = applyFilters;
window.clearFilters = clearFilters;
window.bookService = showBookingModal;
window.closeModal = closeModal;