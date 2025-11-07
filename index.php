<?php include 'includes/header.php'; ?>

<section class="hero">
    <div class="hero-content">
        <h1>Find Trusted Local Service Providers</h1>
        <p>Connect with verified plumbers, electricians, tutors, personal trainers and more in your area</p>
        <form class="search-box" action="browse.php" method="GET">
            <input type="text" name="search" class="search-input" placeholder="What service do you need?">
            <input type="text" name="location" class="search-input" placeholder="Enter your location">
            <button type="submit" class="search-btn">Search</button>
        </form>
    </div>
</section>

<section class="services-section">
    <h2 class="section-title">Popular Services</h2>
    <div class="services-grid">
        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-wrench"></i>
            </div>
            <h3>Plumbing</h3>
            <p>Fix leaks, install fixtures, and handle all your plumbing needs</p>
            <a href="browse.php?category=plumbing" class="btn">Find Plumbers</a>
        </div>
        
        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-bolt"></i>
            </div>
            <h3>Electrical</h3>
            <p>Professional electricians for installations and repairs</p>
            <a href="browse.php?category=electrical" class="btn">Find Electricians</a>
        </div>
        
        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <h3>Tutoring</h3>
            <p>Expert tutors for all subjects and grade levels</p>
            <a href="browse.php?category=tutoring" class="btn">Find Tutors</a>
        </div>
        
        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-dumbbell"></i>
            </div>
            <h3>Personal Training</h3>
            <p>Certified trainers to help you reach your fitness goals</p>
            <a href="browse.php?category=fitness" class="btn">Find Trainers</a>
        </div>
    </div>
</section>

<section class="services-section" style="background: #f8f9fa; padding: 4rem 2rem;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h2 class="section-title">How QuickFix Works</h2>
        <div class="services-grid">
            <div class="service-card" style="text-align: center;">
                <div class="service-icon" style="background: #27ae60;">
                    <i class="fas fa-search"></i>
                </div>
                <h3>Search</h3>
                <p>Find service providers in your area with verified reviews and ratings</p>
            </div>
            
            <div class="service-card" style="text-align: center;">
                <div class="service-icon" style="background: #e74c3c;">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <h3>Book</h3>
                <p>Schedule appointments at your convenience with available time slots</p>
            </div>
            
            <div class="service-card" style="text-align: center;">
                <div class="service-icon" style="background: #9b59b6;">
                    <i class="fas fa-star"></i>
                </div>
                <h3>Review</h3>
                <p>Share your experience and help others find quality service providers</p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>