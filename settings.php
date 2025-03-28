<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$username = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest";
$role = isset($_SESSION['role']) ? $_SESSION['role'] : "User";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings | E-Ticket System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/settings.css">
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>E-Ticket System</h3>
            <p>Manage your tickets efficiently</p>
        </div>
        <div class="nav-links">
            <a href="dashboard.php" class="nav-item">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="accounts.php" class="nav-item">
                <i class="fas fa-users"></i>
                <span>Accounts</span>
            </a>
            <a href="tickets.php" class="nav-item">
                <i class="fas fa-ticket-alt"></i>
                <span>Tickets</span>
            </a>
            <a href="settings.php" class="nav-item active">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
            </a>
        </div>
        <div class="logout">
            <form action="logout.php" method="post">
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>System Settings</h1>
            <div class="user-info">
                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($username); ?>&background=ff4757&color=fff" alt="User Avatar" class="user-avatar">
                <div class="user-details">
                    <h3><?php echo htmlspecialchars($username); ?></h3>
                    <p><?php echo htmlspecialchars(ucfirst($role)); ?></p>
                </div>
            </div>
        </div>
        
        <div class="settings-content">
            <div class="settings-tabs">
                <div class="tab active" data-tab="profile">Profile</div>
                <div class="tab" data-tab="security">Security</div>
                <div class="tab" data-tab="notifications">Notifications</div>
                <div class="tab" data-tab="system">System</div>
            </div>
            
            <div class="tab-content active" id="profile-tab">
                <div class="settings-card">
                    <h3><i class="fas fa-user-circle"></i> Profile Information</h3>
                    <form id="profileForm">
                        <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <input type="text" id="fullName" name="fullName" value="<?php echo htmlspecialchars($username); ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="user@example.com">
                        </div>
                        <div class="form-group">
                            <label for="avatar">Profile Picture</label>
                            <div class="avatar-upload">
                                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($username); ?>&background=ff4757&color=fff" alt="Avatar" id="avatarPreview" class="avatar-preview">
                                <input type="file" id="avatar" name="avatar" accept="image/*" style="display: none;">
                                <button type="button" class="btn btn-secondary" onclick="document.getElementById('avatar').click()">
                                    <i class="fas fa-upload"></i> Upload New
                                </button>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="reset" class="btn btn-cancel">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="tab-content" id="security-tab">
                <div class="settings-card">
                    <h3><i class="fas fa-shield-alt"></i> Password & Security</h3>
                    <form id="securityForm">
                        <div class="form-group">
                            <label for="currentPassword">Current Password</label>
                            <input type="password" id="currentPassword" name="currentPassword" required>
                        </div>
                        <div class="form-group">
                            <label for="newPassword">New Password</label>
                            <input type="password" id="newPassword" name="newPassword" required>
                            <div class="password-strength">
                                <div class="strength-bar"></div>
                                <div class="strength-text">Weak</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Confirm New Password</label>
                            <input type="password" id="confirmPassword" name="confirmPassword" required>
                        </div>
                        <div class="form-actions">
                            <button type="reset" class="btn btn-cancel">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </form>
                </div>
                
                <div class="settings-card">
                    <h3><i class="fas fa-lock"></i> Two-Factor Authentication</h3>
                    <div class="two-factor-status">
                        <div class="status-info">
                            <i class="fas fa-shield-alt"></i>
                            <div>
                                <h4>Two-Factor Authentication</h4>
                                <p>Add an extra layer of security to your account</p>
                            </div>
                        </div>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="two-factor-methods">
                        <div class="method">
                            <i class="fas fa-mobile-alt"></i>
                            <div>
                                <h4>Authenticator App</h4>
                                <p>Use an authenticator app to get verification codes</p>
                            </div>
                            <button class="btn btn-secondary">Setup</button>
                        </div>
                        <div class="method">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <h4>Email Verification</h4>
                                <p>Get verification codes sent to your email</p>
                            </div>
                            <button class="btn btn-secondary">Setup</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="tab-content" id="notifications-tab">
                <div class="settings-card">
                    <h3><i class="fas fa-bell"></i> Notification Preferences</h3>
                    <form id="notificationsForm">
                        <div class="notification-group">
                            <h4>Email Notifications</h4>
                            <div class="notification-item">
                                <div class="notification-info">
                                    <h5>Ticket Assignments</h5>
                                    <p>Get notified when you're assigned a new ticket</p>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <div class="notification-item">
                                <div class="notification-info">
                                    <h5>Ticket Updates</h5>
                                    <p>Get notified when your tickets are updated</p>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <div class="notification-item">
                                <div class="notification-info">
                                    <h5>System Announcements</h5>
                                    <p>Get important system updates and announcements</p>
                                </div>
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="notification-group">
                            <h4>In-App Notifications</h4>
                            <div class="notification-item">
                                <div class="notification-info">
                                    <h5>New Messages</h5>
                                    <p>Show notifications for new messages</p>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <div class="notification-item">
                                <div class="notification-info">
                                    <h5>Due Date Reminders</h5>
                                    <p>Show reminders for approaching due dates</p>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="reset" class="btn btn-cancel">Reset</button>
                            <button type="submit" class="btn btn-primary">Save Preferences</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="tab-content" id="system-tab">
                <div class="settings-card">
                    <h3><i class="fas fa-cog"></i> System Configuration</h3>
                    <form id="systemForm">
                        <div class="form-group">
                            <label for="timezone">Timezone</label>
                            <select id="timezone" name="timezone">
                                <option value="UTC">UTC</option>
                                <option value="EST">Eastern Standard Time (EST)</option>
                                <option value="PST">Pacific Standard Time (PST)</option>
                                <option value="CET">Central European Time (CET)</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="dateFormat">Date Format</label>
                            <select id="dateFormat" name="dateFormat">
                                <option value="Y-m-d">YYYY-MM-DD</option>
                                <option value="m/d/Y">MM/DD/YYYY</option>
                                <option value="d/m/Y">DD/MM/YYYY</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="theme">Theme</label>
                            <select id="theme" name="theme">
                                <option value="light">Light</option>
                                <option value="dark">Dark</option>
                                <option value="system">System Default</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="ticketsPerPage">Tickets Per Page</label>
                            <input type="number" id="ticketsPerPage" name="ticketsPerPage" min="5" max="50" value="15">
                        </div>
                        
                        <div class="form-actions">
                            <button type="reset" class="btn btn-cancel">Reset</button>
                            <button type="submit" class="btn btn-primary">Save Configuration</button>
                        </div>
                    </form>
                </div>
                
                <div class="settings-card danger-zone">
                    <h3><i class="fas fa-exclamation-triangle"></i> Danger Zone</h3>
                    <div class="danger-item">
                        <div>
                            <h4>Clear All Data</h4>
                            <p>Permanently delete all your data from the system</p>
                        </div>
                        <button class="btn btn-danger">Clear Data</button>
                    </div>
                    <div class="danger-item">
                        <div>
                            <h4>Deactivate Account</h4>
                            <p>Temporarily disable your account</p>
                        </div>
                        <button class="btn btn-danger">Deactivate</button>
                    </div>
                    <div class="danger-item">
                        <div>
                            <h4>Delete Account</h4>
                            <p>Permanently delete your account</p>
                        </div>
                        <button class="btn btn-danger">Delete Account</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add active class to current nav item
        document.querySelectorAll('.nav-item').forEach(item => {
            if (item.href === window.location.href) {
                item.classList.add('active');
            }
            
            item.addEventListener('click', function() {
                document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Tab switching functionality
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs and content
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
                
                // Add active class to clicked tab and corresponding content
                this.classList.add('active');
                const tabId = this.getAttribute('data-tab');
                document.getElementById(`${tabId}-tab`).classList.add('active');
            });
        });

        // Avatar preview
        document.getElementById('avatar').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('avatarPreview').src = event.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        // Password strength indicator
        document.getElementById('newPassword').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.querySelector('.strength-bar');
            const strengthText = document.querySelector('.strength-text');
            
            // Very simple strength calculation
            let strength = 0;
            if (password.length > 0) strength += 1;
            if (password.length >= 8) strength += 1;
            if (/[A-Z]/.test(password)) strength += 1;
            if (/[0-9]/.test(password)) strength += 1;
            if (/[^A-Za-z0-9]/.test(password)) strength += 1;
            
            // Update UI
            const width = strength * 20;
            strengthBar.style.width = `${width}%`;
            
            if (strength <= 1) {
                strengthBar.style.backgroundColor = '#ff4757';
                strengthText.textContent = 'Weak';
            } else if (strength <= 3) {
                strengthBar.style.backgroundColor = '#ffa502';
                strengthText.textContent = 'Medium';
            } else {
                strengthBar.style.backgroundColor = '#2ed573';
                strengthText.textContent = 'Strong';
            }
        });

        // Form submissions
        document.getElementById('profileForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Profile updated successfully!');
        });

        document.getElementById('securityForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            if (newPassword !== confirmPassword) {
                alert('Passwords do not match!');
                return;
            }
            
            alert('Password updated successfully!');
            this.reset();
        });

        document.getElementById('notificationsForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Notification preferences saved!');
        });

        document.getElementById('systemForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('System configuration saved!');
        });

        // Danger zone buttons
        document.querySelectorAll('.btn-danger').forEach(btn => {
            btn.addEventListener('click', function() {
                const action = this.textContent.trim();
                if (confirm(`Are you sure you want to ${action}? This action cannot be undone.`)) {
                    alert(`${action} request has been submitted.`);
                }
            });
        });
    </script>
</body>
</html>