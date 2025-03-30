<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SJBPS Admin Dashboard</title>
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
        .profile-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #3498db;
            font-weight: bold;
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
            margin-bottom: 20px;
        }
        .metric-card {
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 0 0 5px 5px;
        }
        .metric-card.red { background-color: #e74c3c; }
        .metric-card.orange { background-color: #f39c12; }
        .metric-card.green { background-color: #2ecc71; }
        .metric-card.blue { background-color: #3498db; }
        .metric-value {
            font-size: 20px;
            font-weight: bold;
        }
        .chart-container {
            height: 300px;
            border: 1px dashed #ddd;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <!-- Top Navigation Bar based on the original code -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
            <img src="images/logo/st-johns-logo.png" alt="Profile" class="logo-image me-2">
                <a class="navbar-brand" href="#">WELCOME! SJBPS Sub-Admin</a>
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
                        <a class="nav-link active" href="#">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-file-alt me-2"></i>Applications for Review
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-money-check-alt me-2"></i>Payment Transactions
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-check-circle me-2"></i>Approved Applications
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
                    <!-- First Row - 4 Cards -->
                    <div class="col-md-3">
                        <div class="card card-container">
                            <div class="card-header text-center">
                                Applications For Review
                            </div>
                            <div class="card-body p-0">
                                <div class="metric-card red d-flex justify-content-between align-items-center">
                                    <div class="metric-value">77</div>
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="card card-container">
                            <div class="card-header text-center">
                                Payment Transactions
                            </div>
                            <div class="card-body p-0">
                                <div class="metric-card orange d-flex justify-content-between align-items-center">
                                    <div class="metric-value">77</div>
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="card card-container">
                            <div class="card-header text-center">
                                Total Revenue
                            </div>
                            <div class="card-body p-0">
                                <div class="metric-card green d-flex justify-content-between align-items-center">
                                    <div class="metric-value">₱ 77,777</div>
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="card card-container">
                            <div class="card-header text-center">
                                Total Enrollees
                            </div>
                            <div class="card-body p-0">
                                <div class="metric-card blue d-flex justify-content-between align-items-center">
                                    <div class="metric-value">77</div>
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Chart Section -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Number of Students per Grade Level</h5>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <p class="mb-0">Chart area - Grade level distribution would appear here</p>
                                </div>
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