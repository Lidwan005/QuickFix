<?php include 'includes/header.php'; ?>

<div class="auth-container">
    <div class="auth-form">
        <h2>Join QuickFix</h2>
        
        <?php
        // Display error messages if exists
        if (isset($_GET['error'])) {
            $error = $_GET['error'];
            if ($error == 'email_exists') {
                echo '<div class="alert alert-error">Email already exists. Please use a different email or login.</div>';
            } elseif ($error == 'password_mismatch') {
                echo '<div class="alert alert-error">Passwords do not match. Please try again.</div>';
            } elseif ($error == 'weak_password') {
                echo '<div class="alert alert-error">Password must be at least 8 characters long.</div>';
            } elseif ($error == 'required') {
                echo '<div class="alert alert-error">Please fill in all required fields.</div>';
            }
        }
        ?>
        
        <form action="process-register.php" method="POST" id="register-form">
            <div class="form-row">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" required 
                           placeholder="Enter your first name">
                    <div class="error-message" id="first-name-error"></div>
                </div>
                
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" required 
                           placeholder="Enter your last name">
                    <div class="error-message" id="last-name-error"></div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required 
                       placeholder="Enter your email address">
                <div class="error-message" id="email-error"></div>
            </div>
            
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" 
                       placeholder="+233 XX XXX XXXX" pattern="[+][0-9]{1,4} [0-9]{2} [0-9]{3} [0-9]{4}">
                <small>Format: +233 XX XXX XXXX</small>
            </div>
            
            <div class="form-group">
                <label for="user_type">I want to:</label>
                <select id="user_type" name="user_type" required onchange="toggleProviderFields()">
                    <option value="">Select account type</option>
                    <option value="customer">Find Services (Customer)</option>
                    <option value="provider">Offer Services (Provider)</option>
                </select>
            </div>
            
            <!-- Provider-specific fields (hidden by default) -->
            <div id="provider-fields" style="display: none;">
                <div class="form-group">
                    <label for="business_name">Business Name</label>
                    <input type="text" id="business_name" name="business_name" 
                           placeholder="Your business or trade name">
                </div>
                
                <div class="form-group">
                    <label for="service_category">Service Category</label>
                    <select id="service_category" name="service_category">
                        <option value="">Select your main service</option>
                        <option value="plumbing">Plumbing</option>
                        <option value="electrical">Electrical</option>
                        <option value="tutoring">Tutoring</option>
                        <option value="fitness">Personal Training</option>
                        <option value="cleaning">Cleaning</option>
                        <option value="painting">Painting</option>
                        <option value="carpentry">Carpentry</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required 
                       placeholder="Create a password (min. 8 characters)">
                <div class="password-strength">
                    <div class="strength-bar">
                        <div class="strength-fill" id="strength-fill"></div>
                    </div>
                    <span class="strength-text" id="strength-text">Password strength</span>
                </div>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required 
                       placeholder="Confirm your password">
                <div class="error-message" id="confirm-password-error"></div>
            </div>
            
            <div class="form-group">
                <label class="checkbox-container">
                    <input type="checkbox" name="terms" required>
                    <span class="checkmark"></span>
                    I agree to the <a href="terms.php" target="_blank">Terms of Service</a> and <a href="privacy.php" target="_blank">Privacy Policy</a>
                </label>
            </div>
            
            <div class="form-group">
                <label class="checkbox-container">
                    <input type="checkbox" name="newsletter">
                    <span class="checkmark"></span>
                    Send me updates about new features and services
                </label>
            </div>
            
            <button type="submit" class="btn-primary">
                <i class="fas fa-user-plus"></i>
                Create Account
            </button>
        </form>
        
        <div class="auth-link">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
</div>

<script>
function toggleProviderFields() {
    const userType = document.getElementById('user_type').value;
    const providerFields = document.getElementById('provider-fields');
    
    if (userType === 'provider') {
        providerFields.style.display = 'block';
        // Add required attribute to provider fields
        document.getElementById('business_name').required = true;
        document.getElementById('service_category').required = true;
    } else {
        providerFields.style.display = 'none';
        // Remove required attribute
        document.getElementById('business_name').required = false;
        document.getElementById('service_category').required = false;
    }
}

// Password strength indicator
document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const strengthFill = document.getElementById('strength-fill');
    const strengthText = document.getElementById('strength-text');
    
    let strength = 0;
    let color = '#e74c3c';
    let text = 'Weak';
    
    if (password.length >= 8) strength += 25;
    if (/[A-Z]/.test(password)) strength += 25;
    if (/[0-9]/.test(password)) strength += 25;
    if (/[^A-Za-z0-9]/.test(password)) strength += 25;
    
    if (strength >= 75) {
        color = '#27ae60';
        text = 'Strong';
    } else if (strength >= 50) {
        color = '#f39c12';
        text = 'Medium';
    } else if (strength >= 25) {
        color = '#e67e22';
        text = 'Fair';
    }
    
    strengthFill.style.width = strength + '%';
    strengthFill.style.background = color;
    strengthText.textContent = text;
    strengthText.style.color = color;
});
</script>

<?php include 'includes/footer.php'; ?>