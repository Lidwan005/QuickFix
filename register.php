<div class="auth-container" style="display: flex; justify-content: center; align-items: center; min-height: 80vh; padding: 20px;">
    <div class="auth-form" style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: 100%; max-width: 500px;">
        <h2 style="text-align: center; margin-bottom: 1.5rem; color: #333;">Join QuickFix</h2>
        
        <?php
        // Display error messages if exists
        if (isset($_GET['error'])) {
            $error = $_GET['error'];
            $errorStyle = "background: #fee; border: 1px solid #f5c6cb; color: #721c24; padding: 12px; border-radius: 4px; margin-bottom: 1rem;";
            if ($error == 'email_exists') {
                echo '<div style="' . $errorStyle . '">Email already exists. Please use a different email or login.</div>';
            } elseif ($error == 'password_mismatch') {
                echo '<div style="' . $errorStyle . '">Passwords do not match. Please try again.</div>';
            } elseif ($error == 'weak_password') {
                echo '<div style="' . $errorStyle . '">Password must be at least 8 characters long.</div>';
            } elseif ($error == 'required') {
                echo '<div style="' . $errorStyle . '">Please fill in all required fields.</div>';
            }
        }
        
        // Display success message
        if (isset($_GET['success']) && $_GET['success'] == 'registered') {
            $successStyle = "background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 12px; border-radius: 4px; margin-bottom: 1rem;";
            echo '<div style="' . $successStyle . '">Registration successful! Redirecting to login page...</div>';
            echo '<script>setTimeout(function() { window.location.href = "login.php"; }, 2000);</script>';
        }
        ?>
        
        <form action="process-register.php" method="POST" id="register-form">
            <div class="form-row" style="display: flex; gap: 1rem;">
                <div class="form-group" style="flex: 1;">
                    <label for="first_name" style="display: block; margin-bottom: 0.5rem; font-weight: bold; color: #333;">First Name</label>
                    <input type="text" id="first_name" name="first_name" required 
                           placeholder="Enter your first name" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                    <div class="error-message" id="first-name-error" style="color: #e74c3c; font-size: 12px; margin-top: 5px;"></div>
                </div>
                
                <div class="form-group" style="flex: 1;">
                    <label for="last_name" style="display: block; margin-bottom: 0.5rem; font-weight: bold; color: #333;">Last Name</label>
                    <input type="text" id="last_name" name="last_name" required 
                           placeholder="Enter your last name" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                    <div class="error-message" id="last-name-error" style="color: #e74c3c; font-size: 12px; margin-top: 5px;"></div>
                </div>
            </div>
            
            <div class="form-group" style="margin-bottom: 1rem;">
                <label for="email" style="display: block; margin-bottom: 0.5rem; font-weight: bold; color: #333;">Email Address</label>
                <input type="email" id="email" name="email" required 
                       placeholder="Enter your email address" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                <div class="error-message" id="email-error" style="color: #e74c3c; font-size: 12px; margin-top: 5px;"></div>
            </div>
            
            <div class="form-group" style="margin-bottom: 1rem;">
                <label for="phone" style="display: block; margin-bottom: 0.5rem; font-weight: bold; color: #333;">Phone Number</label>
                <input type="tel" id="phone" name="phone" 
                       placeholder="+233 XX XXX XXXX" pattern="[+][0-9]{1,4} [0-9]{2} [0-9]{3} [0-9]{4}" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                <small style="color: #666; font-size: 12px;">Format: +233 XX XXX XXXX</small>
            </div>
            
            <div class="form-group" style="margin-bottom: 1rem;">
                <label for="user_type" style="display: block; margin-bottom: 0.5rem; font-weight: bold; color: #333;">I want to:</label>
                <select id="user_type" name="user_type" required onchange="toggleProviderFields()" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                    <option value="">Select account type</option>
                    <option value="customer">Find Services (Customer)</option>
                    <option value="provider">Offer Services (Provider)</option>
                </select>
            </div>
            
            <!-- Provider-specific fields (hidden by default) -->
            <div id="provider-fields" style="display: none;">
                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="business_name" style="display: block; margin-bottom: 0.5rem; font-weight: bold; color: #333;">Business Name</label>
                    <input type="text" id="business_name" name="business_name" 
                           placeholder="Your business or trade name" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                </div>
                
                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="service_category" style="display: block; margin-bottom: 0.5rem; font-weight: bold; color: #333;">Service Category</label>
                    <select id="service_category" name="service_category" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
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
            
            <div class="form-group" style="margin-bottom: 1rem;">
                <label for="password" style="display: block; margin-bottom: 0.5rem; font-weight: bold; color: #333;">Password</label>
                <input type="password" id="password" name="password" required 
                       placeholder="Create a password (min. 8 characters)" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                <div class="password-strength" style="margin-top: 0.5rem;">
                    <div class="strength-bar" style="height: 4px; background: #eee; border-radius: 2px; overflow: hidden;">
                        <div class="strength-fill" id="strength-fill" style="height: 100%; width: 0%; transition: width 0.3s;"></div>
                    </div>
                    <span class="strength-text" id="strength-text" style="font-size: 12px; color: #666;">Password strength</span>
                </div>
            </div>
            
            <div class="form-group" style="margin-bottom: 1rem;">
                <label for="confirm_password" style="display: block; margin-bottom: 0.5rem; font-weight: bold; color: #333;">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required 
                       placeholder="Confirm your password" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                <div class="error-message" id="confirm-password-error" style="color: #e74c3c; font-size: 12px; margin-top: 5px;"></div>
            </div>
            
            <div class="form-group" style="margin-bottom: 1rem;">
                <label style="display: flex; align-items: flex-start; gap: 0.5rem; cursor: pointer;">
                    <input type="checkbox" name="terms" required style="margin-top: 0.2rem;">
                    <span style="font-size: 14px; color: #333;">
                        I agree to the <a href="terms.php" target="_blank" style="color: #3498db;">Terms of Service</a> and <a href="privacy.php" target="_blank" style="color: #3498db;">Privacy Policy</a>
                    </span>
                </label>
            </div>
            
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label style="display: flex; align-items: flex-start; gap: 0.5rem; cursor: pointer;">
                    <input type="checkbox" name="newsletter" style="margin-top: 0.2rem;">
                    <span style="font-size: 14px; color: #333;">
                        Send me updates about new features and services
                    </span>
                </label>
            </div>
            
            <button type="submit" class="btn-primary" style="width: 100%; padding: 12px; background: #3498db; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                <i class="fas fa-user-plus"></i>
                Create Account
            </button>
        </form>
        
        <div class="auth-link" style="text-align: center; margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid #eee;">
            <p style="color: #666; font-size: 14px;">Already have an account? <a href="login.php" style="color: #3498db; text-decoration: none;">Login here</a></p>
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