<?php 
// Temporary session check - will be replaced with proper authentication in Sprint 2
session_start();
if (!isset($_SESSION['logged_in'])) {
    // For demo purposes, we'll simulate a logged-in customer
    $_SESSION['logged_in'] = true;
    $_SESSION['user_type'] = 'customer';
    $_SESSION['user_id'] = 2;
    $_SESSION['first_name'] = 'Kwame';
    $_SESSION['last_name'] = 'Appiah';
    $_SESSION['email'] = 'kwame.appiah@example.com';
}
?>

<?php include 'includes/header.php'; ?>

<div class="dashboard-container">
    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <div class="welcome-section">
            <h1>Welcome back, <?php echo $_SESSION['first_name']; ?>! 👋</h1>
            <p>Manage your bookings, track services, and find new providers</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-primary" onclick="bookNewService()">
                <i class="fas fa-plus"></i> Book New Service
            </button>
            <div class="notification-bell">
                <i class="fas fa-bell"></i>
                <span class="notification-count">2</span>
            </div>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background: #3498db;">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-info">
                <h3>3</h3>
                <p>Upcoming Bookings</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: #27ae60;">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-info">
                <h3>12</h3>
                <p>Completed Services</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: #e74c3c;">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-info">
                <h3>8</h3>
                <p>Reviews Given</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: #9b59b6;">
                <i class="fas fa-heart"></i>
            </div>
            <div class="stat-info">
                <h3>5</h3>
                <p>Favorite Providers</p>
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
                    <a href="my-bookings.php" class="view-all">View All</a>
                </div>
                <div class="bookings-list">
                    <div class="booking-item urgent">
                        <div class="booking-info">
                            <div class="booking-service">
                                <h4>Pipe Repair Service</h4>
                                <div class="provider-info">
                                    <div class="provider-avatar-small">JO</div>
                                    <span>John Osei - Plumbing</span>
                                </div>
                            </div>
                            <div class="booking-details">
                                <p><i class="fas fa-clock"></i> Today, 2:00 PM</p>
                                <p><i class="fas fa-map-marker-alt"></i> Your Location: East Legon, Accra</p>
                                <p><i class="fas fa-tag"></i> ₵50/hour (Est. 2 hours)</p>
                            </div>
                        </div>
                        <div class="booking-actions">
                            <span class="status-badge urgent">Confirmed</span>
                            <button class="btn btn-sm" onclick="contactProvider('John Osei')">Message</button>
                            <button class="btn btn-sm btn-outline" onclick="rescheduleBooking(1)">Reschedule</button>
                            <button class="btn btn-sm btn-danger" onclick="cancelBooking(1)">Cancel</button>
                        </div>
                    </div>
                    
                    <div class="booking-item">
                        <div class="booking-info">
                            <div class="booking-service">
                                <h4>Electrical Wiring Check</h4>
                                <div class="provider-info">
                                    <div class="provider-avatar-small">AK</div>
                                    <span>Ama Kumi - Electrical</span>
                                </div>
                            </div>
                            <div class="booking-details">
                                <p><i class="fas fa-clock"></i> Tomorrow, 10:00 AM</p>
                                <p><i class="fas fa-map-marker-alt"></i> Your Location: Cantonments, Accra</p>
                                <p><i class="fas fa-tag"></i> ₵65/hour (Est. 3 hours)</p>
                            </div>
                        </div>
                        <div class="booking-actions">
                            <span class="status-badge confirmed">Confirmed</span>
                            <button class="btn btn-sm" onclick="contactProvider('Ama Kumi')">Message</button>
                            <button class="btn btn-sm btn-outline" onclick="rescheduleBooking(2)">Reschedule</button>
                        </div>
                    </div>
                    
                    <div class="booking-item">
                        <div class="booking-info">
                            <div class="booking-service">
                                <h4>Math Tutoring Session</h4>
                                <div class="provider-info">
                                    <div class="provider-avatar-small">DA</div>
                                    <span>David Amponsah - Tutoring</span>
                                </div>
                            </div>
                            <div class="booking-details">
                                <p><i class="fas fa-clock"></i> Nov 15, 4:00 PM</p>
                                <p><i class="fas fa-map-marker-alt"></i> Online Session</p>
                                <p><i class="fas fa-tag"></i> ₵40/hour (2 hours scheduled)</p>
                            </div>
                        </div>
                        <div class="booking-actions">
                            <span class="status-badge pending">Pending Confirmation</span>
                            <button class="btn btn-sm" onclick="contactProvider('David Amponsah')">Message</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h2><i class="fas fa-history"></i> Recent Activity</h2>
                </div>
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-icon success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="activity-content">
                            <p><strong>Booking completed</strong> - Home Cleaning with Mary Arthur</p>
                            <span class="activity-time">2 hours ago</span>
                        </div>
                        <button class="btn btn-sm btn-outline" onclick="leaveReview(4)">Leave Review</button>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon info">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        <div class="activity-content">
                            <p><strong>New booking scheduled</strong> - Math Tutoring with David Amponsah</p>
                            <span class="activity-time">1 day ago</span>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon warning">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="activity-content">
                            <p><strong>Booking reminder</strong> - Pipe Repair with John Osei tomorrow</p>
                            <span class="activity-time">1 day ago</span>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon success">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="activity-content">
                            <p><strong>Review submitted</strong> - You rated Electrical Services 5 stars</p>
                            <span class="activity-time">3 days ago</span>
                        </div>
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
                        <?php echo substr($_SESSION['first_name'], 0, 1) . substr($_SESSION['last_name'], 0, 1); ?>
                    </div>
                    <h3><?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?></h3>
                    <p class="profile-email"><?php echo $_SESSION['email']; ?></p>
                    
                    <div class="profile-details">
                        <div class="detail-item">
                            <i class="fas fa-phone"></i>
                            <span>+233 24 123 4567</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>East Legon, Accra</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-calendar"></i>
                            <span>Member since Oct 2024</span>
                        </div>
                    </div>
                    
                    <div class="profile-actions">
                        <button class="btn btn-outline" onclick="viewBookingHistory()">
                            <i class="fas fa-history"></i> Booking History
                        </button>
                        <button class="btn btn-primary" onclick="editProfile()">
                            <i class="fas fa-edit"></i> Edit Profile
                        </button>
                    </div>
                </div>
            </div>

            <!-- Favorite Providers -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h2><i class="fas fa-heart"></i> Favorite Providers</h2>
                    <a href="favorites.php" class="view-all">View All</a>
                </div>
                <div class="favorites-list">
                    <div class="favorite-item">
                        <div class="provider-avatar-small">JO</div>
                        <div class="favorite-info">
                            <h4>John Osei</h4>
                            <p>Plumbing • 4.8 ★</p>
                        </div>
                        <button class="btn btn-sm" onclick="bookProvider('John Osei')">Book Again</button>
                    </div>
                    
                    <div class="favorite-item">
                        <div class="provider-avatar-small">AK</div>
                        <div class="favorite-info">
                            <h4>Ama Kumi</h4>
                            <p>Electrical • 4.9 ★</p>
                        </div>
                        <button class="btn btn-sm" onclick="bookProvider('Ama Kumi')">Book Again</button>
                    </div>
                    
                    <div class="favorite-item">
                        <div class="provider-avatar-small">MA</div>
                        <div class="favorite-info">
                            <h4>Mary Arthur</h4>
                            <p>Cleaning • 4.5 ★</p>
                        </div>
                        <button class="btn btn-sm" onclick="bookProvider('Mary Arthur')">Book Again</button>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h2><i class="fas fa-bolt"></i> Quick Actions</h2>
                </div>
                <div class="quick-actions">
                    <button class="quick-action-btn" onclick="bookNewService()">
                        <i class="fas fa-plus"></i>
                        <span>Book Service</span>
                    </button>
                    <button class="quick-action-btn" onclick="findProviders()">
                        <i class="fas fa-search"></i>
                        <span>Find Providers</span>
                    </button>
                    <button class="quick-action-btn" onclick="viewInvoices()">
                        <i class="fas fa-file-invoice"></i>
                        <span>View Invoices</span>
                    </button>
                    <button class="quick-action-btn" onclick="manageAddresses()">
                        <i class="fas fa-home"></i>
                        <span>My Addresses</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Review Modal -->
<div id="reviewModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Leave a Review</h2>
            <button class="modal-close" onclick="closeModal('reviewModal')">&times;</button>
        </div>
        <form id="reviewForm" class="modal-form">
            <input type="hidden" id="reviewBookingId" name="bookingId">
            
            <div class="form-group">
                <label>Service Provider</label>
                <div id="reviewProviderInfo" class="provider-review-info">
                    <!-- Provider info will be filled by JavaScript -->
                </div>
            </div>
            
            <div class="form-group">
                <label>Rating</label>
                <div class="star-rating">
                    <span class="star" data-rating="1">★</span>
                    <span class="star" data-rating="2">★</span>
                    <span class="star" data-rating="3">★</span>
                    <span class="star" data-rating="4">★</span>
                    <span class="star" data-rating="5">★</span>
                </div>
                <input type="hidden" id="reviewRating" name="rating" required>
            </div>
            
            <div class="form-group">
                <label for="reviewTitle">Review Title</label>
                <input type="text" id="reviewTitle" name="reviewTitle" required placeholder="Summarize your experience">
            </div>
            
            <div class="form-group">
                <label for="reviewText">Your Review</label>
                <textarea id="reviewText" name="reviewText" required placeholder="Share details of your experience with this provider..." rows="4"></textarea>
            </div>
            
            <div class="form-actions">
                <button type="button" class="btn btn-outline" onclick="closeModal('reviewModal')">Cancel</button>
                <button type="submit" class="btn btn-primary">Submit Review</button>
            </div>
        </form>
    </div>
</div>

<script>
// Customer Dashboard functionality
function bookNewService() {
    window.location.href = 'browse.php';
}

function contactProvider(providerName) {
    alert(`Opening chat with ${providerName}...\n\nIn Sprint 2, this will open a messaging interface.`);
}

function rescheduleBooking(bookingId) {
    alert(`Rescheduling booking #${bookingId}...\n\nThis will open a calendar to choose a new date and time.`);
}

function cancelBooking(bookingId) {
    if (confirm('Are you sure you want to cancel this booking? Cancellation fees may apply based on our policy.')) {
        const loading = showLoading('Cancelling booking...');
        setTimeout(() => {
            loading.remove();
            alert('✅ Booking cancelled successfully!\n\nAny applicable refund will be processed within 3-5 business days.');
        }, 1500);
    }
}

function leaveReview(bookingId) {
    // In a real app, we'd fetch booking details from the server
    const providerInfo = {
        name: 'Mary Arthur',
        service: 'Home Cleaning',
        date: '2024-11-10'
    };
    
    document.getElementById('reviewBookingId').value = bookingId;
    document.getElementById('reviewProviderInfo').innerHTML = `
        <div style="display: flex; align-items: center; gap: 1rem; padding: 1rem; background: #f8f9fa; border-radius: 8px;">
            <div class="provider-avatar-small">MA</div>
            <div>
                <strong>${providerInfo.name}</strong><br>
                <span>${providerInfo.service} • ${providerInfo.date}</span>
            </div>
        </div>
    `;
    
    // Reset form
    document.getElementById('reviewForm').reset();
    document.getElementById('reviewRating').value = '';
    resetStars();
    
    document.getElementById('reviewModal').style.display = 'flex';
}

function viewBookingHistory() {
    alert('Opening booking history...\n\nView all your past and completed services.');
}

function editProfile() {
    alert('Opening profile editor...\n\nUpdate your personal information and preferences.');
}

function bookProvider(providerName) {
    alert(`Booking ${providerName}...\n\nRedirecting to service booking page.`);
}

function findProviders() {
    window.location.href = 'browse.php';
}

function viewInvoices() {
    alert('Opening invoices...\n\nView and download your payment receipts.');
}

function manageAddresses() {
    alert('Managing addresses...\n\nAdd or edit your service locations.');
}

// Star rating functionality
function resetStars() {
    const stars = document.querySelectorAll('.star');
    stars.forEach(star => {
        star.style.color = '#ddd';
        star.style.cursor = 'pointer';
    });
}

document.querySelectorAll('.star').forEach(star => {
    star.addEventListener('click', function() {
        const rating = parseInt(this.getAttribute('data-rating'));
        document.getElementById('reviewRating').value = rating;
        
        // Update star display
        const stars = document.querySelectorAll('.star');
        stars.forEach((s, index) => {
            if (index < rating) {
                s.style.color = '#f39c12';
            } else {
                s.style.color = '#ddd';
            }
        });
    });
    
    star.addEventListener('mouseover', function() {
        const rating = parseInt(this.getAttribute('data-rating'));
        const stars = document.querySelectorAll('.star');
        stars.forEach((s, index) => {
            if (index < rating) {
                s.style.color = '#f39c12';
            }
        });
    });
    
    star.addEventListener('mouseout', function() {
        const currentRating = parseInt(document.getElementById('reviewRating').value) || 0;
        const stars = document.querySelectorAll('.star');
        stars.forEach((s, index) => {
            if (index < currentRating) {
                s.style.color = '#f39c12';
            } else {
                s.style.color = '#ddd';
            }
        });
    });
});

// Handle review form submission
document.getElementById('reviewForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    const reviewData = {
        bookingId: formData.get('bookingId'),
        rating: formData.get('rating'),
        title: formData.get('reviewTitle'),
        text: formData.get('reviewText')
    };
    
    if (!reviewData.rating) {
        alert('Please select a rating');
        return;
    }
    
    const loading = showLoading('Submitting review...');
    setTimeout(() => {
        loading.remove();
        alert(`✅ Thank you for your review!\n\nYour ${reviewData.rating}-star rating has been submitted.`);
        closeModal('reviewModal');
    }, 1500);
});

// Modal and utility functions (reuse from provider dashboard)
function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

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

// Close modal when clicking outside
window.onclick = function(event) {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
}

// Initialize dashboard
document.addEventListener('DOMContentLoaded', function() {
    console.log('Customer dashboard initialized');
});
</script>

<?php include 'includes/footer.php'; ?>