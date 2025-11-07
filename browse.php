<?php include 'includes/header.php'; ?>

<div class="services-section">
    <h1 class="section-title">Find Service Providers</h1>
    
    <div class="filters">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
            <div class="filter-group">
                <label for="category">Category</label>
                <select id="category" name="category">
                    <option value="">All Categories</option>
                    <option value="plumbing">Plumbing</option>
                    <option value="electrical">Electrical</option>
                    <option value="tutoring">Tutoring</option>
                    <option value="fitness">Personal Training</option>
                    <option value="cleaning">Cleaning</option>
                    <option value="painting">Painting</option>
                    <option value="carpentry">Carpentry</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label for="location">Location</label>
                <input type="text" id="location" name="location" placeholder="Enter location">
            </div>
            
            <div class="filter-group">
                <label for="rating">Minimum Rating</label>
                <select id="rating" name="rating">
                    <option value="">Any Rating</option>
                    <option value="5">5 Stars</option>
                    <option value="4">4+ Stars</option>
                    <option value="3">3+ Stars</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label for="price">Max Price (₵/hr)</label>
                <input type="number" id="price" name="price" placeholder="Maximum price" min="0">
            </div>
        </div>
        
        <div style="margin-top: 1rem; display: flex; gap: 1rem;">
            <button type="button" class="btn-primary" onclick="applyFilters()" style="padding: 0.8rem 2rem;">
                Apply Filters
            </button>
            <button type="button" class="btn" onclick="clearFilters()" style="padding: 0.8rem 2rem; background: #95a5a6;">
                Clear Filters
            </button>
        </div>
    </div>
    
    <div class="providers-grid">
        <!-- Sample Provider 1 - Plumber -->
        <div class="provider-card" data-category="plumbing" data-rating="4.8" data-price="50">
            <div class="provider-header">
                <div class="provider-avatar" style="background: #3498db;">JO</div>
                <div class="provider-info">
                    <h3>John Osei</h3>
                    <div class="rating">4.8</div>
                    <div><i class="fas fa-map-marker-alt"></i> East Legon, Accra</div>
                </div>
            </div>
            
            <div class="provider-specialties">
                <span class="specialty-tag">Pipe Repair</span>
                <span class="specialty-tag">Fixture Installation</span>
                <span class="specialty-tag">Leak Detection</span>
            </div>
            
            <p>With over 10 years of experience, I provide reliable plumbing services with a focus on quality and customer satisfaction. Available for emergency calls.</p>
            
            <div class="provider-footer">
                <div class="price">₵50/hr</div>
                <button class="btn book-btn" onclick="bookService('John Osei', 'Plumbing')">Book Now</button>
            </div>
        </div>
        
        <!-- Sample Provider 2 - Electrician -->
        <div class="provider-card" data-category="electrical" data-rating="4.9" data-price="65">
            <div class="provider-header">
                <div class="provider-avatar" style="background: #e74c3c;">AK</div>
                <div class="provider-info">
                    <h3>Ama Kumi</h3>
                    <div class="rating">4.9</div>
                    <div><i class="fas fa-map-marker-alt"></i> Cantonments, Accra</div>
                </div>
            </div>
            
            <div class="provider-specialties">
                <span class="specialty-tag">Electrical Wiring</span>
                <span class="specialty-tag">Lighting Installation</span>
                <span class="specialty-tag">Safety Inspections</span>
            </div>
            
            <p>Certified electrician providing safe and efficient electrical solutions for homes and businesses. Fully insured and certified.</p>
            
            <div class="provider-footer">
                <div class="price">₵65/hr</div>
                <button class="btn book-btn" onclick="bookService('Ama Kumi', 'Electrical')">Book Now</button>
            </div>
        </div>
        
        <!-- Sample Provider 3 - Tutor -->
        <div class="provider-card" data-category="tutoring" data-rating="4.7" data-price="40">
            <div class="provider-header">
                <div class="provider-avatar" style="background: #9b59b6;">DA</div>
                <div class="provider-info">
                    <h3>David Amponsah</h3>
                    <div class="rating">4.7</div>
                    <div><i class="fas fa-map-marker-alt"></i> University of Ghana</div>
                </div>
            </div>
            
            <div class="provider-specialties">
                <span class="specialty-tag">Mathematics</span>
                <span class="specialty-tag">Physics</span>
                <span class="specialty-tag">Chemistry</span>
                <span class="specialty-tag">Calculus</span>
            </div>
            
            <p>Experienced tutor helping students excel in STEM subjects with personalized learning approaches. PhD in Mathematics from University of Ghana.</p>
            
            <div class="provider-footer">
                <div class="price">₵40/hr</div>
                <button class="btn book-btn" onclick="bookService('David Amponsah', 'Tutoring')">Book Now</button>
            </div>
        </div>
        
        <!-- Sample Provider 4 - Personal Trainer -->
        <div class="provider-card" data-category="fitness" data-rating="4.6" data-price="55">
            <div class="provider-header">
                <div class="provider-avatar" style="background: #27ae60;">EK</div>
                <div class="provider-info">
                    <h3>Esi Kwame</h3>
                    <div class="rating">4.6</div>
                    <div><i class="fas fa-map-marker-alt"></i> Osu, Accra</div>
                </div>
            </div>
            
            <div class="provider-specialties">
                <span class="specialty-tag">Weight Training</span>
                <span class="specialty-tag">Cardio</span>
                <span class="specialty-tag">Nutrition Planning</span>
                <span class="specialty-tag">Yoga</span>
            </div>
            
            <p>Certified personal trainer with 8 years experience helping clients achieve their fitness goals. Specialized in weight loss and strength training.</p>
            
            <div class="provider-footer">
                <div class="price">₵55/hr</div>
                <button class="btn book-btn" onclick="bookService('Esi Kwame', 'Personal Training')">Book Now</button>
            </div>
        </div>
        
        <!-- Sample Provider 5 - Cleaner -->
        <div class="provider-card" data-category="cleaning" data-rating="4.5" data-price="35">
            <div class="provider-header">
                <div class="provider-avatar" style="background: #f39c12;">MA</div>
                <div class="provider-info">
                    <h3>Mary Arthur</h3>
                    <div class="rating">4.5</div>
                    <div><i class="fas fa-map-marker-alt"></i> Tema Community 25</div>
                </div>
            </div>
            
            <div class="provider-specialties">
                <span class="specialty-tag">Home Cleaning</span>
                <span class="specialty-tag">Office Cleaning</span>
                <span class="specialty-tag">Deep Cleaning</span>
                <span class="specialty-tag">Move-in Cleaning</span>
            </div>
            
            <p>Professional cleaning services with eco-friendly products. Offering regular and one-time cleaning for homes and offices. References available.</p>
            
            <div class="provider-footer">
                <div class="price">₵35/hr</div>
                <button class="btn book-btn" onclick="bookService('Mary Arthur', 'Cleaning')">Book Now</button>
            </div>
        </div>
        
        <!-- Sample Provider 6 - Painter -->
        <div class="provider-card" data-category="painting" data-rating="4.8" data-price="45">
            <div class="provider-header">
                <div class="provider-avatar" style="background: #d35400;">KA</div>
                <div class="provider-info">
                    <h3>Kofi Ansah</h3>
                    <div class="rating">4.8</div>
                    <div><i class="fas fa-map-marker-alt"></i> Spintex, Accra</div>
                </div>
            </div>
            
            <div class="provider-specialties">
                <span class="specialty-tag">Interior Painting</span>
                <span class="specialty-tag">Exterior Painting</span>
                <span class="specialty-tag">Wallpaper</span>
                <span class="specialty-tag">Color Consultation</span>
            </div>
            
            <p>Professional painter with 12 years experience in residential and commercial painting. Quality work with attention to detail and clean finishes.</p>
            
            <div class="provider-footer">
                <div class="price">₵45/hr</div>
                <button class="btn book-btn" onclick="bookService('Kofi Ansah', 'Painting')">Book Now</button>
            </div>
        </div>
    </div>
</div>

<script>
// Filter functionality
function applyFilters() {
    const category = document.getElementById('category').value;
    const minRating = parseFloat(document.getElementById('rating').value) || 0;
    const maxPrice = parseFloat(document.getElementById('price').value) || Infinity;
    
    const providerCards = document.querySelectorAll('.provider-card');
    let visibleCount = 0;
    
    providerCards.forEach(card => {
        const cardCategory = card.getAttribute('data-category');
        const cardRating = parseFloat(card.getAttribute('data-rating'));
        const cardPrice = parseFloat(card.getAttribute('data-price'));
        
        const categoryMatch = !category || cardCategory === category;
        const ratingMatch = cardRating >= minRating;
        const priceMatch = cardPrice <= maxPrice;
        
        if (categoryMatch && ratingMatch && priceMatch) {
            card.style.display = 'block';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });
    
    // Show message if no results
    const resultsMessage = document.getElementById('results-message') || createResultsMessage();
    resultsMessage.textContent = visibleCount === 0 ? 'No providers match your filters. Try adjusting your criteria.' : `Found ${visibleCount} providers`;
}

function createResultsMessage() {
    const message = document.createElement('div');
    message.id = 'results-message';
    message.style.cssText = 'text-align: center; padding: 1rem; font-size: 1.1rem; color: #2c3e50; margin: 1rem 0;';
    document.querySelector('.providers-grid').insertAdjacentElement('beforebegin', message);
    return message;
}

function clearFilters() {
    document.getElementById('category').value = '';
    document.getElementById('location').value = '';
    document.getElementById('rating').value = '';
    document.getElementById('price').value = '';
    
    // Show all cards
    const providerCards = document.querySelectorAll('.provider-card');
    providerCards.forEach(card => {
        card.style.display = 'block';
    });
    
    // Remove results message if exists
    const resultsMessage = document.getElementById('results-message');
    if (resultsMessage) {
        resultsMessage.remove();
    }
}

// Booking functionality
function bookService(providerName, serviceType) {
    alert(`Booking functionality for ${providerName} (${serviceType}) would open here!\n\nIn the next sprint, this will:\n- Show available time slots\n- Allow date selection\n- Process payment\n- Send confirmation`);
}

// Initialize rating display
document.addEventListener('DOMContentLoaded', function() {
    const ratingElements = document.querySelectorAll('.rating');
    ratingElements.forEach(rating => {
        const score = parseFloat(rating.textContent);
        const fullStars = '★'.repeat(Math.floor(score));
        const emptyStars = '☆'.repeat(5 - Math.floor(score));
        rating.textContent = fullStars + emptyStars + ' ' + score.toFixed(1);
    });
    
    // Add search functionality from URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const searchQuery = urlParams.get('search');
    const categoryQuery = urlParams.get('category');
    
    if (searchQuery) {
        document.getElementById('location').value = searchQuery;
    }
    
    if (categoryQuery) {
        document.getElementById('category').value = categoryQuery;
        applyFilters();
    }
});
</script>

    </div>
</div>

<?php include 'includes/footer.php'; ?>