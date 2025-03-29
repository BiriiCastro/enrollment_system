<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SJBPS Cashier Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #3498db;
            --bg-light-gray: #f0f2f5;
            --sidebar-bg: white;
            --sidebar-hover: #f8f9fa;
            --sidebar-active: #e9ecef;
        }
        body {
            background-color: var(--bg-light-gray);
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background-color: var(--primary-blue);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .sidebar {
            background-color: var(--sidebar-bg);
            min-height: calc(100vh - 56px);
            border-right: 1px solid #e0e0e0;
        }
        .sidebar .nav-link {
            color: #333;
            padding: 12px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover {
            background-color: var(--sidebar-hover);
            transform: translateX(5px);
        }
        .sidebar .nav-link.active {
            background-color: var(--sidebar-active);
            font-weight: bold;
            color: var(--primary-blue);
        }
        .card-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 15px;
            margin-bottom: 20px;
            text-align: center;
            transition: transform 0.3s ease;
        }
        .card-container:hover {
            transform: scale(1.03);
        }
        .card-title {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 16px;
            color: #555;
        }
        .metric-card {
            color: white;
            padding: 12px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 6px;
        }
        .metric-card.red { background-color: #e74c3c; }
        .metric-card.orange { background-color: #f39c12; }
        .metric-card.green { background-color: #2ecc71; }
        .metric-card.blue { background-color: #3498db; }
        .metric-card.navy { background-color: #34495e; }
        .metric-card.yellow { background-color: #f1c40f; }
        
        .metric-value {
            font-size: 24px;
            font-weight: bold;
        }
        .profile-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
        }
        .table-recent-activity {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <img src="logo.jpg" alt="Profile" class="profile-image me-2">
                <a class="navbar-brand" href="#">WELCOME! SJBPS Cashier</a>
            </div>
            <div class="ms-auto">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-home me-2"></i>Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-sign-out-alt me-2"></i>Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block sidebar pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="Cashier.php">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Cashier Payment.php">
                            <i class="fas fa-file-alt me-2"></i>Approved Applications
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Transactions.php">
                            <i class="fas fa-money-check-alt me-2"></i>Payment Transactions
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-history me-2"></i>Payment History
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-users me-2"></i>All Enrollees
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 px-md-4 pt-3">
                <div class="row">
                    <!-- Metrics Cards -->
                    <div class="col-md-3 mb-4">
                        <div class="card-container">
                            <div class="card-title">Payment Transactions</div>
                            <div class="metric-card red">
                                <div class="metric-value">77</div>
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 mb-4">
                        <div class="card-container">
                            <div class="card-title">Transactions Today</div>
                            <div class="metric-card orange">
                                <div class="metric-value">77</div>
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 mb-4">
                        <div class="card-container">
                            <div class="card-title">Total Payments Today</div>
                            <div class="metric-card green">
                                <div class="metric-value">₱77,000</div>
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 mb-4">
                        <div class="card-container">
                            <div class="card-title">Total Enrollees</div>
                            <div class="metric-card blue">
                                <div class="metric-value">77</div>
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity Section -->
                    <div class="col-12">
                        <div class="card-container">
                            <h5 class="mb-3">Recent Activity</h5>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-recent-activity">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Student Number</th>
                                            <th>Grade Level</th>
                                            <th>Amount</th>
                                            <th>Date Posted</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Jean D'Arc</td>
                                            <td>2025000001</td>
                                            <td>Grade 1</td>
                                            <td>₱5,000</td>
                                            <td>March 3, 2025</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>