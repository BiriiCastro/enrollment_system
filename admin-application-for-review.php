<?php
session_start();

// Redirect to login if the user is not authenticated
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Retrieve admin details from session
$adminFirstName = $_SESSION['first_name'];
$adminLastName = $_SESSION['last_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SJBPS Admin Dashboard - Applications Review</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #3498db;
            --sidebar-bg: #f8f9fa;
            --sidebar-active-bg: #f0f0f0;
            --sidebar-hover-bg: #e9ecef;
        }
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background-color: var(--primary-blue);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            color: white !important;
            font-weight: bold;
        }
        .navbar-brand img {
            margin-right: 10px;
            border: 2px solid white;
        }
        .sidebar {
            background-color: var(--sidebar-bg);
            min-height: calc(100vh - 56px);
            border-right: 1px solid #dee2e6;
            box-shadow: 2px 0 5px rgba(0,0,0,0.05);
        }
        .sidebar .nav-link {
            color: #333;
            border-radius: 4px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link.active {
            background-color: var(--sidebar-active-bg);
            font-weight: bold;
            color: var(--primary-blue);
        }
        .sidebar .nav-link:hover {
            background-color: var(--sidebar-hover-bg);
            transform: translateX(5px);
        }
        .main-content {
            padding: 20px;
        }
        .search-container {
            margin-bottom: 20px;
        }
        .table {
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        .table thead {
            background-color: #f8f9fa;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.05);
        }
        .review-btn {
            background-color: #2ecc71;
            border-color: #2ecc71;
            transition: all 0.3s ease;
        }
        .review-btn:hover {
            transform: scale(1.05);
            background-color: #27ae60;
        }
        .empty-table-message {
            color: #6c757d;
        }
        .input-group .form-control:focus,
        .input-group .btn:focus {
            box-shadow: none;
            border-color: var(--primary-blue);
        }
        .logo-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
        }
        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
        }
    </style>
    <!-- Fetch the name of the User -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const adminFirstName = "<?php echo htmlspecialchars($adminFirstName); ?>";
            const adminLastName = "<?php echo htmlspecialchars($adminLastName); ?>";
            const welcomeMessage = `WELCOME! Admin ${adminFirstName} ${adminLastName}`;
            document.getElementById('adminWelcomeMessage').textContent = welcomeMessage;
        });
    </script>
</head>
<body>
        <!-- Top Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <img src="images/logo/st-johns-logo.png" alt="Profile" class="logo-image me-2">
                <a class="navbar-brand" href="#" id="adminWelcomeMessage">WELCOME! Admin</a>
            </div>
            <div class="ms-auto">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="admin-dashboard.php"><i class="fas fa-home me-2"></i>Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar py-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="admin-dashboard.php">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="admin-application-for-review.php">
                            <i class="fas fa-file-alt me-2"></i>Applications for Review
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Payment.php">
                            <i class="fas fa-money-check-alt me-2"></i>Payment Transactions
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Approved.php">
                            <i class="fas fa-check-circle me-2"></i>Approved Applications
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="All Enrollees.php">
                            <i class="fas fa-users me-2"></i>All Enrollees
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-edit me-2"></i>Home Page Editor
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Users.php">
                            <i class="fas fa-user-cog me-2"></i>Users
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">Applications for Review</h4>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                        <i class="fas fa-filter me-2"></i>Advanced Filters
                    </button>
                </div>
                
                <!-- Search Bar -->
                <div class="search-container d-flex justify-content-end">
                    <div class="input-group" style="max-width: 300px;">
                        <input type="text" class="form-control" placeholder="Search applications" aria-label="Search">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Student Name</th>
                                <th>Type of Enrollment</th>
                                <th>Last Grade Level</th>
                                <th>Applying For</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6" class="text-center py-5 empty-table-message">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <p>No applications for review at this time</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Advanced Filter Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Advanced Filters</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Enrollment Type</label>
                        <select class="form-select">
                            <option>All Types</option>
                            <option>New Student</option>
                            <option>Transfer Student</option>
                            <option>Old Student</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Grade Level</label>
                        <select class="form-select">
                            <option>All Grade Levels</option>
                            <option>Pre-School</option>
                            <option>Kindergarten</option>
                            <option>Elementary</option>
                            <option>Junior High School</option>
                            <option>Senior High School</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Apply Filters</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>