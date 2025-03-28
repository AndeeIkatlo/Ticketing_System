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
    <title>Accounts | E-Ticket System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/accounts.css">
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
            <a href="accounts.php" class="nav-item active">
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
            <h1>Manage Accounts</h1>
            <div class="user-info">
                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($username); ?>&background=ff4757&color=fff" alt="User Avatar" class="user-avatar">
                <div class="user-details">
                    <h3><?php echo htmlspecialchars($username); ?></h3>
                    <p><?php echo htmlspecialchars(ucfirst($role)); ?></p>
                </div>
            </div>
        </div>
        
        <div class="accounts-content">
            <div class="action-bar">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search accounts...">
                </div>
                <button class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Account
                </button>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Last Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="user-avatar-sm">
                                    <span>John Doe</span>
                                </div>
                            </td>
                            <td>john.doe@example.com</td>
                            <td><span class="role-badge role-admin">Admin</span></td>
                            <td><i class="fas fa-circle status-active"></i> Active</td>
                            <td>2 hours ago</td>
                            <td>
                                <div class="action-buttons">
                                    <div class="btn-icon">
                                        <i class="fas fa-edit"></i>
                                    </div>
                                    <div class="btn-icon">
                                        <i class="fas fa-trash"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User" class="user-avatar-sm">
                                    <span>Sarah Smith</span>
                                </div>
                            </td>
                            <td>sarah.smith@example.com</td>
                            <td><span class="role-badge role-agent">Agent</span></td>
                            <td><i class="fas fa-circle status-active"></i> Active</td>
                            <td>1 day ago</td>
                            <td>
                                <div class="action-buttons">
                                    <div class="btn-icon">
                                        <i class="fas fa-edit"></i>
                                    </div>
                                    <div class="btn-icon">
                                        <i class="fas fa-trash"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="User" class="user-avatar-sm">
                                    <span>Michael Johnson</span>
                                </div>
                            </td>
                            <td>michael.j@example.com</td>
                            <td><span class="role-badge role-user">User</span></td>
                            <td><i class="fas fa-circle status-inactive"></i> Inactive</td>
                            <td>1 week ago</td>
                            <td>
                                <div class="action-buttons">
                                    <div class="btn-icon">
                                        <i class="fas fa-edit"></i>
                                    </div>
                                    <div class="btn-icon">
                                        <i class="fas fa-trash"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <img src="https://randomuser.me/api/portraits/women/28.jpg" alt="User" class="user-avatar-sm">
                                    <span>Emily Wilson</span>
                                </div>
                            </td>
                            <td>emily.w@example.com</td>
                            <td><span class="role-badge role-agent">Agent</span></td>
                            <td><i class="fas fa-circle status-active"></i> Active</td>
                            <td>3 hours ago</td>
                            <td>
                                <div class="action-buttons">
                                    <div class="btn-icon">
                                        <i class="fas fa-edit"></i>
                                    </div>
                                    <div class="btn-icon">
                                        <i class="fas fa-trash"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="User" class="user-avatar-sm">
                                    <span>David Brown</span>
                                </div>
                            </td>
                            <td>david.b@example.com</td>
                            <td><span class="role-badge role-user">User</span></td>
                            <td><i class="fas fa-circle status-pending"></i> Pending</td>
                            <td>Just now</td>
                            <td>
                                <div class="action-buttons">
                                    <div class="btn-icon">
                                        <i class="fas fa-edit"></i>
                                    </div>
                                    <div class="btn-icon">
                                        <i class="fas fa-trash"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                <div class="page-item"><i class="fas fa-chevron-left"></i></div>
                <div class="page-item active">1</div>
                <div class="page-item">2</div>
                <div class="page-item">3</div>
                <div class="page-item"><i class="fas fa-chevron-right"></i></div>
            </div>
        </div>
    </div>

    <!-- Add Account Modal (hidden by default) -->
    <div class="modal" id="addAccountModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add New Account</h3>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-body">
                <form id="addAccountForm">
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" id="fullName" name="fullName" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select id="role" name="role" required>
                            <option value="user">User</option>
                            <option value="agent">Agent</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-cancel">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Account</button>
                    </div>
                </form>
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
        

        // Modal functionality
        const addAccountBtn = document.querySelector('.btn-primary');
        const modal = document.getElementById('addAccountModal');
        const closeModal = document.querySelector('.close-modal');
        const cancelBtn = document.querySelector('.btn-cancel');

        addAccountBtn.addEventListener('click', () => {
            modal.style.display = 'block';
        });

        closeModal.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        cancelBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        // Close modal when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });

        // Form submission
        document.getElementById('addAccountForm').addEventListener('submit', (e) => {
            e.preventDefault();
            // Here you would typically send data to server
            alert('Account created successfully!');
            modal.style.display = 'none';
            // You would then refresh the accounts list or add the new account dynamically
        });

        // Search functionality
        const searchInput = document.querySelector('.search-box input');
        searchInput.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const name = row.querySelector('.user-cell span').textContent.toLowerCase();
                const email = row.cells[1].textContent.toLowerCase();
                
                if (name.includes(searchTerm) || email.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Pagination functionality
        document.querySelectorAll('.page-item').forEach(item => {
            item.addEventListener('click', function() {
                if (this.classList.contains('active')) return;
                
                document.querySelectorAll('.page-item').forEach(i => {
                    i.classList.remove('active');
                });
                
                this.classList.add('active');
                // Here you would typically fetch new page data from server
            });
        });

        // Action buttons functionality
        document.querySelectorAll('.action-buttons .btn-icon').forEach(btn => {
            btn.addEventListener('click', function() {
                const row = this.closest('tr');
                const userName = row.querySelector('.user-cell span').textContent;
                
                if (this.querySelector('.fa-edit')) {
                    // Edit action
                    alert(`Edit user: ${userName}`);
                } else if (this.querySelector('.fa-trash')) {
                    // Delete action
                    if (confirm(`Are you sure you want to delete ${userName}?`)) {
                        row.remove();
                        alert(`${userName} has been deleted`);
                    }
                }
            });
        });
    </script>
</body>
</html>