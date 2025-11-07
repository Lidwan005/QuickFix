<?php 
// Temporary session check - will be replaced with proper authentication in Sprint 2
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== 'provider') {
    // For demo purposes, we'll simulate a logged-in provider
    $_SESSION['logged_in'] = true;
    $_SESSION['user_type'] = 'provider';
    $_SESSION['user_id'] = 1;
    $_SESSION['first_name'] = 'John';
    $_SESSION['business_name'] = 'Osei Plumbing Services';
}
?>

<?php include 'includes/header.php'; ?>

<div class="dashboard-container">
    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <div class="welcome-section">
            <h1>Welcome back, <?php echo $_SESSION['first_name']; ?>! 👋</h1>
            <p>Manage your services, bookings, and grow your business</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-primary" onclick="showAddServiceModal()">
                <i class="fas fa-plus"></i> Add New Service
            </button>
            <div class="notification-bell">
                <i class="fas fa-bell"></i>
                <span class="notification-count">3</span>
            </div>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background: #3498db;">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="stat-info">
                <h3>12</h3>
                <p>Upcoming Bookings</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: #27ae60;">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-info">
                <h3>4.8</h3>
                <p>Average Rating</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: #e74c3c;">
                <i class="fas fa-eye"></i>
            </div>
            <div class="stat-info">
                <h3>156</h3>
                <p>Profile Views</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: #9b59b6;">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div class="stat-info">
                <h3>₵2,340</h3>
                <p>Monthly Earnings</p>
            </div>
        </div>
    </div>

    <!-- Main Dashboard Content -->
    <div class="dashboard-content">
        <!-- Left Column -->
        <div class="dashboard-left">
            <!-- Upcoming Bookings -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h2><i class="fas fa-calendar-alt"></i> Upcoming Bookings</h2>
                    <a href="bookings.php" class="view-all">View All</a>
                </div>
                <div class="bookings-list">
                    <div class="booking-item urgent">
                        <div class="booking-info">
                            <h4>Pipe Repair Service</h4>
                            <p><i class="fas fa-user"></i> Kwame Appiah</p>
                            <p><i class="fas fa-clock"></i> Today, 2:00 PM</p>
                            <p><i class="fas fa-map-marker-alt"></i> East Legon, Accra</p>
                        </div>
                        <div class="booking-actions">
                            <span class="status-badge urgent">Urgent</span>
                            <button class="btn btn-sm" onclick="contactCustomer('Kwame Appiah')">Contact</button>
                            <button class="btn btn-sm btn-primary" onclick="viewBookingDetails(1)">Details</button>
                        </div>
                    </div>
                    
                    <div class="booking-item">
                        <div class="booking-info">
                            <h4>Fixture Installation</h4>
                            <p><i class="fas fa-user"></i> Ama Serwaa</p>
                            <p><i class="fas fa-clock"></i> Tomorrow, 10:00 AM</p>
                            <p><i class="fas fa-map-marker-alt"></i> Cantonments, Accra</p>
                        </div>
                        <div class="booking-actions">
                            <span class="status-badge confirmed">Confirmed</span>
                            <button class="btn btn-sm" onclick="contactCustomer('Ama Serwaa')">Contact</button>
                            <button class="btn btn-sm btn-primary" onclick="viewBookingDetails(2)">Details</button>
                        </div>
                    </div>
                    
                    <div class="booking-item">
                        <div class="booking-info">
                            <h4>Leak Detection</h4>
                            <p><i class="fas fa-user"></i> David Ofori</p>
                            <p><i class="fas fa-clock"></i> Nov 15, 9:00 AM</p>
                            <p><i class="fas fa-map-marker-alt"></i> Tema, Community 25</p>
                        </div>
                        <div class="booking-actions">
                            <span class="status-badge confirmed">Confirmed</span>
                            <button class="btn btn-sm" onclick="contactCustomer('David Ofori')">Contact</button>
                            <button class="btn btn-sm btn-primary" onclick="viewBookingDetails(3)">Details</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Reviews -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h2><i class="fas fa-star"></i> Recent Reviews</h2>
                </div>
                <div class="reviews-list">
                    <div class="review-item">
                        <div class="review-header">
                            <div class="reviewer-info">
                                <div class="reviewer-avatar">KA</div>
                                <div>
                                    <h4>Kwame Appiah</h4>
                                    <div class="rating">5.0</div>
                                </div>
                            </div>
                            <span class="review-date">2 days ago</span>
                        </div>
                        <p class="review-text">"John fixed my leaking pipes quickly and professionally. Great service and fair pricing. Highly recommended!"</p>
                    </div>
                    
                    <div class="review-item">
                        <div class="review-header">
                            <div class="reviewer-info">
                                <div class="reviewer-avatar">AS</div>
                                <div>
                                    <h4>Ama Serwaa</h4>
                                    <div class="rating">4.5</div>
                                </div>
                            </div>
                            <span class="review-date">1 week ago</span>
                        </div>
                        <p class="review-text">"Excellent work installing our new bathroom fixtures. Very clean and efficient. Will definitely hire again."</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="dashboard-right">
            <!-- Profile Overview -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h2><i class="fas fa-user"></i> Profile Overview</h2>
                    <a href="edit-profile.php" class="view-all">Edit</a>
                </div>
                <div class="profile-overview">
                    <div class="profile-avatar-large">
                        JO
                    </div>
                    <h3><?php echo $_SESSION['business_name']; ?></h3>
                    <p class="profile-category">Plumbing Services</p>
                    
                    <div class="profile-stats">
                        <div class="profile-stat">
                            <strong>4.8</strong>
                            <span>Rating</span>
                        </div>
                        <div class="profile-stat">
                            <strong>47</strong>
                            <span>Completed Jobs</span>
                        </div>
                        <div class="profile-stat">
                            <strong>2</strong>
                            <span>Years</span>
                        </div>
                    </div>
                    
                    <div class="profile-actions">
                        <button class="btn btn-outline" onclick="viewPublicProfile()">
                            <i class="fas fa-eye"></i> View Public Profile
                        </button>
                        <button class="btn btn-primary" onclick="editProfile()">
                            <i class="fas fa-edit"></i> Edit Profile
                        </button>
                    </div>
                </div>
            </div>

            <!-- Availability -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h2><i class="fas fa-clock"></i> Availability</h2>
                    <a href="availability.php" class="view-all">Manage</a>
                </div>
                <div class="availability-widget">
                    <div class="availability-status">
                        <div class="status-indicator available"></div>
                        <span>Available for new bookings</span>
                    </div>
                    <div class="working-hours">
                        <h4>Working Hours</h4>
                        <div class="hours-list">
                            <div class="hour-item">
                                <span>Mon - Fri</span>
                                <span>8:00 AM - 6:00 PM</span>
                            </div>
                            <div class="hour-item">
                                <span>Saturday</span>
                                <span>9:00 AM - 2:00 PM</span>
                            </div>
                            <div class="hour-item">
                                <span>Sunday</span>
                                <span>Emergency Only</span>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-outline btn-block" onclick="updateAvailability()">
                        Update Availability
                    </button>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h2><i class="fas fa-bolt"></i> Quick Actions</h2>
                </div>
                <div class="quick-actions">
                    <button class="quick-action-btn" onclick="showAddServiceModal()">
                        <i class="fas fa-plus"></i>
                        <span>Add Service</span>
                    </button>
                    <button class="quick-action-btn" onclick="manageServices()">
                        <i class="fas fa-concierge-bell"></i>
                        <span>Manage Services</span>
                    </button>
                    <button class="quick-action-btn" onclick="viewEarnings()">
                        <i class="fas fa-chart-line"></i>
                        <span>View Earnings</span>
                    </button>
                    <button class="quick-action-btn" onclick="updatePricing()">
                        <i class="fas fa-tag"></i>
                        <span>Update Pricing</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Service Modal -->
<div id="addServiceModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Add New Service</h2>
            <button class="modal-close" onclick="closeModal('addServiceModal')">&times;</button>
        </div>
        <form id="addServiceForm" class="modal-form">
            <div class="form-group">
                <label for="serviceName">Service Name</label>
                <input type="text" id="serviceName" name="serviceName" required placeholder="e.g., Pipe Repair, Fixture Installation">
            </div>
            
            <div class="form-group">
                <label for="serviceCategory">Category</label>
                <select id="serviceCategory" name="serviceCategory" required>
                    <option value="">Select Category</option>
                    <option value="pipe_repair">Pipe Repair</option>
                    <option value="leak_detection">Leak Detection</option>
                    <option value="fixture_installation">Fixture Installation</option>
                    <option value="drain_cleaning">Drain Cleaning</option>
                    <option value="water_heater">Water Heater Services</option>
                </select>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="servicePrice">Price (₵)</label>
                    <input type="number" id="servicePrice" name="servicePrice" required placeholder="0.00" min="0" step="0.01">
                </div>
                
                <div class="form-group">
                    <label for="priceType">Price Type</label>
                    <select id="priceType" name="priceType" required>
                        <option value="hourly">Per Hour</option>
                        <option value="fixed">Fixed Price</option>
                        <option value="quote">Get Quote</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="serviceDescription">Description</label>
                <textarea id="serviceDescription" name="serviceDescription" required placeholder="Describe your service in detail..." rows="4"></textarea>
            </div>
            
            <div class="form-group">
                <label for="serviceDuration">Estimated Duration</label>
                <select id="serviceDuration" name="serviceDuration">
                    <option value="1">1 hour</option>
                    <option value="2">2 hours</option>
                    <option value="3">3 hours</option>
                    <option value="4">4+ hours</option>
                    <option value="varies">Varies</option>
                </select>
            </div>
            
            <div class="form-actions">
                <button type="button" class="btn btn-outline" onclick="closeModal('addServiceModal')">Cancel</button>
                <button type="submit" class="btn btn-primary">Add Service</button>
            </div>
        </form>
    </div>
</div>

<script>
// Dashboard functionality
function showAddServiceModal() {
    document.getElementById('addServiceModal').style.display = 'flex';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

function contactCustomer(customerName) {
    alert(`Contacting ${customerName}...\n\nIn Sprint 2, this will open a messaging interface.`);
}

function viewBookingDetails(bookingId) {
    alert(`Viewing details for booking #${bookingId}...\n\nThis will show complete booking information in Sprint 2.`);
}

function viewPublicProfile() {
    alert('Opening your public profile page...\n\nCustomers see this page when browsing services.');
}

function editProfile() {
    alert('Opening profile editor...\n\nThis will allow you to update your business information, photos, and services.');
}

function updateAvailability() {
    alert('Opening availability settings...\n\nSet your working hours and days off.');
}

function manageServices() {
    alert('Opening services management...\n\nEdit, update, or remove your service offerings.');
}

function viewEarnings() {
    alert('Opening earnings dashboard...\n\nView your income reports and payment history.');
}

function updatePricing() {
    alert('Opening pricing editor...\n\nUpdate your service rates and packages.');
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
}

// Handle add service form submission
document.getElementById('addServiceForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    const serviceData = {
        name: formData.get('serviceName'),
        category: formData.get('serviceCategory'),
        price: formData.get('servicePrice'),
        priceType: formData.get('priceType'),
        description: formData.get('serviceDescription'),
        duration: formData.get('serviceDuration')
    };
    
    // Simulate API call
    const loading = showLoading('Adding service...');
    setTimeout(() => {
        loading.remove();
        alert(`✅ Service "${serviceData.name}" added successfully!\n\nPrice: ₵${serviceData.price} ${serviceData.priceType}\n\nIn Sprint 2, this will be saved to the database.`);
        closeModal('addServiceModal');
        this.reset();
    }, 1500);
});

function showLoading(message) {
    const loading = document.createElement('div');
    loading.style.cssText = `
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(0,0,0,0.8);
        color: white;
        padding: 1rem 2rem;
        border-radius: 8px;
        z-index: 1000;
    `;
    loading.innerHTML = `<i class="fas fa-spinner fa-spin"></i> ${message}`;
    document.body.appendChild(loading);
    return loading;
}

// Initialize dashboard
document.addEventListener('DOMContentLoaded', function() {
    console.log('Provider dashboard initialized');
    
    // Initialize ratings display
    const ratingElements = document.querySelectorAll('.rating');
    ratingElements.forEach(rating => {
        const score = parseFloat(rating.textContent);
        const fullStars = '★'.repeat(Math.floor(score));
        const emptyStars = '☆'.repeat(5 - Math.floor(score));
        rating.innerHTML = `<span style="color: #f39c12;">${fullStars}${emptyStars}</span> ${score.toFixed(1)}`;
    });
});
</script>

<?php include 'includes/footer.php'; ?>