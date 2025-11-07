<?php include 'includes/header.php'; ?>

<div class="auth-container">
    <div class="auth-form">
        <h2>Login to QuickFix</h2>
        
        <?php
        // Display error message if exists
        if (isset($_GET['error']) && $_GET['error'] == 'invalid') {
            echo '<div class="alert alert-error">Invalid email or password. Please try again.</div>';
        }
        
        if (isset($_GET['error']) && $_GET['error'] == 'required') {
            echo '<div class="alert alert-error">Please fill in all required fields.</div>';
        }
        
        if (isset($_GET['success']) && $_GET['success'] == 'registered') {
            echo '<div class="alert alert-success">Registration successful! Please login with your credentials.</div>';
        }
        ?>
        
        <form action="process-login.php" method="POST" id="login-form">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required 
                       placeholder="Enter your email address">
                <div class="error-message" id="email-error"></div>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required 
                       placeholder="Enter your password">
                <div class="error-message" id="password-error"></div>
            </div>
            
            <div class="form-options">
                <label class="checkbox-container">
                    <input type="checkbox" name="remember_me">
                    <span class="checkmark"></span>
                    Remember me
                </label>
                <a href="forgot-password.php" class="forgot-password">Forgot Password?</a>
            </div>
            
            <button type="submit" class="btn-primary">
                <i class="fas fa-sign-in-alt"></i>
                Login
            </button>
        </form>
        
        <div class="auth-divider">
            <span>Or continue with</span>
        </div>
        
        <div class="social-login">
            <button type="button" class="btn-social btn-google">
                <i class="fab fa-google"></i>
                Google
            </button>
            <button type="button" class="btn-social btn-facebook">
                <i class="fab fa-facebook-f"></i>
                Facebook
            </button>
        </div>
        
        <div class="auth-link">
            <p>Don't have an account? <a href="register.php">Create one here</a></p>
        </div>
    </div>
    
    <div class="auth-features">
        <h3>Why Join QuickFix?</h3>
        <div class="feature-list">
            <div class="feature-item">
                <i class="fas fa-shield-alt"></i>
                <div>
                    <h4>Secure Account</h4>
                    <p>Your information is protected with encryption</p>
                </div>
            </div>
            <div class="feature-item">
                <i class="fas fa-bolt"></i>
                <div>
                    <h4>Quick Access</h4>
                    <p>Book services faster with saved preferences</p>
                </div>
            </div>
            <div class="feature-item">
                <i class="fas fa-history"></i>
                <div>
                    <h4>Booking History</h4>
                    <p>Track all your past and upcoming appointments</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>