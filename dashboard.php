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
    <title>Dashboard | E-Ticket System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>E-Ticket System</h3>
            <p>Manage your tickets efficiently</p>
        </div>
        <div class="nav-links">
            <a href="dashboard.php" class="nav-item active">
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
            <a href="settings.php" class="nav-item">
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
            <h1>Dashboard Overview</h1>
            <div class="user-info">
                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($username); ?>&background=ff4757&color=fff" alt="User Avatar" class="user-avatar">
                <div class="user-details">
                    <h3><?php echo htmlspecialchars($username); ?></h3>
                    <p><?php echo htmlspecialchars(ucfirst($role)); ?></p>
                </div>
            </div>
        </div>
        
        <div class="dashboard-content">
            <div class="stats-container">
                <div class="stat-card">
                    <h3>Total Tickets</h3>
                    <div class="value">124</div>
                    <div class="change positive">
                        <i class="fas fa-arrow-up"></i> 12% from last month
                    </div>
                </div>
                <div class="stat-card">
                    <h3>Open Tickets</h3>
                    <div class="value">24</div>
                    <div class="change negative">
                        <i class="fas fa-arrow-down"></i> 5% from last week
                    </div>
                </div>
                <div class="stat-card">
                    <h3>Resolved Tickets</h3>
                    <div class="value">87</div>
                    <div class="change positive">
                        <i class="fas fa-arrow-up"></i> 18% from last month
                    </div>
                </div>
                <div class="stat-card">
                    <h3>Customer Satisfaction</h3>
                    <div class="value">94%</div>
                    <div class="change positive">
                        <i class="fas fa-arrow-up"></i> 3% from last quarter
                    </div>
                </div>
            </div>

            <div class="recent-tickets">
                <h2 class="section-title">Recent Tickets</h2>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Ticket ID</th>
                                <th>Subject</th>
                                <th>Requester</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#TKT-1001</td>
                                <td>Login issues</td>
                                <td>john.doe@example.com</td>
                                <td><i class="fas fa-arrow-up" style="color: #ff4757;"></i> High</td>
                                <td><span class="status-badge status-open">Open</span></td>
                                <td>2 hours ago</td>
                            </tr>
                            <tr>
                                <td>#TKT-1000</td>
                                <td>Payment not processing</td>
                                <td>sarah.smith@example.com</td>
                                <td><i class="fas fa-arrow-up" style="color: #ff4757;"></i> High</td>
                                <td><span class="status-badge status-pending">Pending</span></td>
                                <td>5 hours ago</td>
                            </tr>
                            <tr>
                                <td>#TKT-999</td>
                                <td>Feature request</td>
                                <td>mike.johnson@example.com</td>
                                <td><i class="fas fa-arrow-down" style="color: #2ed573;"></i> Low</td>
                                <td><span class="status-badge status-open">Open</span></td>
                                <td>1 day ago</td>
                            </tr>
                            <tr>
                                <td>#TKT-998</td>
                                <td>Password reset</td>
                                <td>emily.wilson@example.com</td>
                                <td><i class="fas fa-equals" style="color: #ffa502;"></i> Medium</td>
                                <td><span class="status-badge status-resolved">Resolved</span></td>
                                <td>2 days ago</td>
                            </tr>
                            <tr>
                                <td>#TKT-997</td>
                                <td>Account verification</td>
                                <td>david.brown@example.com</td>
                                <td><i class="fas fa-equals" style="color: #ffa502;"></i> Medium</td>
                                <td><span class="status-badge status-resolved">Resolved</span></td>
                                <td>3 days ago</td>
                            </tr>
                        </tbody>
                    </table>
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

        // Enhanced hover effect with GSAP-like animation
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(10px)';
                this.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.2)';
            });
            
            item.addEventListener('mouseleave', function() {
                if (!this.classList.contains('active')) {
                    this.style.transform = 'translateX(0)';
                    this.style.boxShadow = 'none';
                }
            });
        });

        // Card hover effect
        document.querySelectorAll('.stat-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.boxShadow = '0 15px 30px rgba(0, 0, 0, 0.1)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = 'var(--box-shadow)';
            });
        });

        // Avatar hover effect
        document.querySelector('.user-avatar').addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1)';
            this.style.boxShadow = '0 6px 12px rgba(0, 0, 0, 0.15)';
        });
        
        document.querySelector('.user-avatar').addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
            this.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
        });
    </script>
</body>
</html>