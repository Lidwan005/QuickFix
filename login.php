<div style="display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 20px; background: #f5f5f5;">
    <div style="display: flex; max-width: 900px; width: 100%; background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); overflow: hidden;">
        <div style="flex: 1; padding: 3rem;">
            <h2 style="text-align: center; margin-bottom: 2rem; color: #333; font-size: 2rem;">Login to QuickFix</h2>
            
            <?php
            // Display error message if exists
            if (isset($_GET['error']) && $_GET['error'] == 'invalid') {
                echo '<div style="background: #fee; border: 1px solid #f5c6cb; color: #721c24; padding: 12px; border-radius: 6px; margin-bottom: 1.5rem; text-align: center;">Invalid email or password. Please try again.</div>';
            }
            
            if (isset($_GET['error']) && $_GET['error'] == 'required') {
                echo '<div style="background: #fee; border: 1px solid #f5c6cb; color: #721c24; padding: 12px; border-radius: 6px; margin-bottom: 1.5rem; text-align: center;">Please fill in all required fields.</div>';
            }
            
            if (isset($_GET['success']) && $_GET['success'] == 'registered') {
                echo '<div style="background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 12px; border-radius: 6px; margin-bottom: 1.5rem; text-align: center;">Registration successful! Please login with your credentials.</div>';
            }
            ?>
            
            <form action="process-login.php" method="POST" id="login-form">
                <div style="margin-bottom: 1.5rem;">
                    <label for="email" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">Email Address</label>
                    <input type="email" id="email" name="email" required 
                           placeholder="Enter your email address" style="width: 100%; padding: 12px; border: 2px solid #e1e1e1; border-radius: 6px; font-size: 14px; transition: border-color 0.3s;">
                    <div id="email-error" style="color: #e74c3c; font-size: 12px; margin-top: 5px;"></div>
                </div>
                
                <div style="margin-bottom: 1.5rem;">
                    <label for="password" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">Password</label>
                    <input type="password" id="password" name="password" required 
                           placeholder="Enter your password" style="width: 100%; padding: 12px; border: 2px solid #e1e1e1; border-radius: 6px; font-size: 14px; transition: border-color 0.3s;">
                    <div id="password-error" style="color: #e74c3c; font-size: 12px; margin-top: 5px;"></div>
                </div>
                
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                        <input type="checkbox" name="remember_me" style="margin: 0; transform: scale(1.2);">
                        <span style="font-size: 14px; color: #333;">Remember me</span>
                    </label>
                    <a href="forgot-password.php" style="color: #3498db; text-decoration: none; font-size: 14px; font-weight: 500;">Forgot Password?</a>
                </div>
                
                <button type="submit" style="width: 100%; padding: 14px; background: #3498db; color: white; border: none; border-radius: 6px; font-size: 16px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem; transition: background 0.3s;">
                    <i class="fas fa-sign-in-alt"></i>
                    Login
                </button>
            </form>
            
            <div style="margin: 2rem 0; text-align: center; position: relative;">
                <span style="background: white; padding: 0 1rem; color: #666; font-size: 14px;">Or continue with</span>
                <div style="position: absolute; top: 50%; left: 0; right: 0; height: 1px; background: #e1e1e1; z-index: -1;"></div>
            </div>
            
            <div style="display: flex; gap: 1rem; margin-bottom: 2rem;">
                <button type="button" style="flex: 1; padding: 12px; border: 2px solid #e1e1e1; border-radius: 6px; background: white; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem; font-size: 14px; font-weight: 500; transition: border-color 0.3s;">
                    <i class="fab fa-google" style="color: #DB4437;"></i>
                    Google
                </button>
                <button type="button" style="flex: 1; padding: 12px; border: 2px solid #e1e1e1; border-radius: 6px; background: white; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem; font-size: 14px; font-weight: 500; transition: border-color 0.3s;">
                    <i class="fab fa-facebook-f" style="color: #4267B2;"></i>
                    Facebook
                </button>
            </div>
            
            <div style="text-align: center; padding-top: 1.5rem; border-top: 1px solid #e1e1e1;">
                <p style="color: #666; font-size: 14px; margin: 0;">Don't have an account? <a href="register.php" style="color: #3498db; text-decoration: none; font-weight: 600;">Create one here</a></p>
            </div>
        </div>
        
        <div style="flex: 1; padding: 3rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
            <h3 style="margin-bottom: 2rem; font-size: 1.5rem;">Why Join QuickFix?</h3>
            <div>
                <div style="display: flex; align-items: flex-start; gap: 1rem; margin-bottom: 2rem;">
                    <i class="fas fa-shield-alt" style="font-size: 1.5rem; margin-top: 0.2rem; color: rgba(255,255,255,0.9);"></i>
                    <div>
                        <h4 style="margin: 0 0 0.5rem 0; font-size: 1.1rem;">Secure Account</h4>
                        <p style="margin: 0; opacity: 0.9; font-size: 14px;">Your information is protected with encryption</p>
                    </div>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 1rem; margin-bottom: 2rem;">
                    <i class="fas fa-bolt" style="font-size: 1.5rem; margin-top: 0.2rem; color: rgba(255,255,255,0.9);"></i>
                    <div>
                        <h4 style="margin: 0 0 0.5rem 0; font-size: 1.1rem;">Quick Access</h4>
                        <p style="margin: 0; opacity: 0.9; font-size: 14px;">Book services faster with saved preferences</p>
                    </div>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 1rem; margin-bottom: 2rem;">
                    <i class="fas fa-history" style="font-size: 1.5rem; margin-top: 0.2rem; color: rgba(255,255,255,0.9);"></i>
                    <div>
                        <h4 style="margin: 0 0 0.5rem 0; font-size: 1.1rem;">Booking History</h4>
                        <p style="margin: 0; opacity: 0.9; font-size: 14px;">Track all your past and upcoming appointments</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    input:focus {
        border-color: #3498db !important;
        outline: none;
    }
    
    button:hover {
        opacity: 0.9;
    }
    
    .btn-social:hover {
        border-color: #3498db !important;
    }
</style>