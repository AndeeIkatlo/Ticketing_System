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
    <title>Tickets | E-Ticket System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/tickets.css">
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
            <a href="tickets.php" class="nav-item active">
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
            <h1>Ticket Management</h1>
            <div class="user-info">
            <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($username); ?>&background=ff4757&color=fff" alt="User Avatar" class="user-avatar">
            <div class="user-details">
                    <h3><?php echo htmlspecialchars($username); ?></h3>
                    <p><?php echo htmlspecialchars(ucfirst($role)); ?></p>
                </div>
            </div>
        </div>
        
        <div class="tickets-content">
            <div class="action-bar">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search tickets...">
                </div>
                <div class="filter-group">
                    <select id="status-filter">
                        <option value="">All Statuses</option>
                        <option value="open">Open</option>
                        <option value="pending">Pending</option>
                        <option value="resolved">Resolved</option>
                    </select>
                    <select id="priority-filter">
                        <option value="">All Priorities</option>
                        <option value="high">High</option>
                        <option value="medium">Medium</option>
                        <option value="low">Low</option>
                    </select>
                    <button class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create Ticket
                    </button>
                </div>
            </div>

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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#TKT-1001</td>
                            <td>Login issues</td>
                            <td>john.doe@example.com</td>
                            <td><span class="priority-badge priority-high">High</span></td>
                            <td><span class="status-badge status-open">Open</span></td>
                            <td>2 hours ago</td>
                            <td>
                                <div class="action-buttons">
                                    <div class="btn-icon">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                    <div class="btn-icon">
                                        <i class="fas fa-edit"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#TKT-1000</td>
                            <td>Payment not processing</td>
                            <td>sarah.smith@example.com</td>
                            <td><span class="priority-badge priority-high">High</span></td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td>5 hours ago</td>
                            <td>
                                <div class="action-buttons">
                                    <div class="btn-icon">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                    <div class="btn-icon">
                                        <i class="fas fa-edit"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#TKT-999</td>
                            <td>Feature request</td>
                            <td>mike.johnson@example.com</td>
                            <td><span class="priority-badge priority-low">Low</span></td>
                            <td><span class="status-badge status-open">Open</span></td>
                            <td>1 day ago</td>
                            <td>
                                <div class="action-buttons">
                                    <div class="btn-icon">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                    <div class="btn-icon">
                                        <i class="fas fa-edit"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#TKT-998</td>
                            <td>Password reset</td>
                            <td>emily.wilson@example.com</td>
                            <td><span class="priority-badge priority-medium">Medium</span></td>
                            <td><span class="status-badge status-resolved">Resolved</span></td>
                            <td>2 days ago</td>
                            <td>
                                <div class="action-buttons">
                                    <div class="btn-icon">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                    <div class="btn-icon">
                                        <i class="fas fa-edit"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#TKT-997</td>
                            <td>Account verification</td>
                            <td>david.brown@example.com</td>
                            <td><span class="priority-badge priority-medium">Medium</span></td>
                            <td><span class="status-badge status-resolved">Resolved</span></td>
                            <td>3 days ago</td>
                            <td>
                                <div class="action-buttons">
                                    <div class="btn-icon">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                    <div class="btn-icon">
                                        <i class="fas fa-edit"></i>
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

    <!-- Create Ticket Modal -->
    <div class="modal" id="createTicketModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Create New Ticket</h3>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-body">
                <form id="createTicketForm">
                    <div class="form-group">
                        <label for="ticketSubject">Subject</label>
                        <input type="text" id="ticketSubject" name="ticketSubject" required>
                    </div>
                    <div class="form-group">
                        <label for="ticketDescription">Description</label>
                        <textarea id="ticketDescription" name="ticketDescription" rows="4" required></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="ticketPriority">Priority</label>
                            <select id="ticketPriority" name="ticketPriority" required>
                                <option value="low">Low</option>
                                <option value="medium" selected>Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ticketCategory">Category</label>
                            <select id="ticketCategory" name="ticketCategory" required>
                                <option value="technical">Technical</option>
                                <option value="billing">Billing</option>
                                <option value="general">General</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-cancel">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Ticket</button>
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
        const createTicketBtn = document.querySelector('.btn-primary');
        const modal = document.getElementById('createTicketModal');
        const closeModal = document.querySelector('.close-modal');
        const cancelBtn = document.querySelector('.btn-cancel');

        createTicketBtn.addEventListener('click', () => {
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
        document.getElementById('createTicketForm').addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Ticket created successfully!');
            modal.style.display = 'none';
        });

        // Filter functionality
        document.getElementById('status-filter').addEventListener('change', filterTickets);
        document.getElementById('priority-filter').addEventListener('change', filterTickets);

        function filterTickets() {
            const statusFilter = document.getElementById('status-filter').value;
            const priorityFilter = document.getElementById('priority-filter').value;
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const status = row.querySelector('.status-badge').classList[1].split('-')[1];
                const priority = row.querySelector('.priority-badge').classList[1].split('-')[1];
                
                const statusMatch = !statusFilter || status === statusFilter;
                const priorityMatch = !priorityFilter || priority === priorityFilter;
                
                row.style.display = (statusMatch && priorityMatch) ? '' : 'none';
            });
        }

        // Pagination functionality
        document.querySelectorAll('.page-item').forEach(item => {
            item.addEventListener('click', function() {
                if (this.classList.contains('active')) return;
                
                document.querySelectorAll('.page-item').forEach(i => {
                    i.classList.remove('active');
                });
                
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>