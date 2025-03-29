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
    <title>School Management Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
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
        .chart-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
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
            <div class="col-md-3 col-lg-2 d-md-block sidebar pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="admin-dashboard.php">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-application-for-review.php">
                            <i class="fas fa-file-alt me-2"></i>Applications for Review
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-approved-application.php">
                            <i class="fas fa-check-circle me-2"></i>Approved Applications
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Payment.php">
                            <i class="fas fa-money-check-alt me-2"></i>Payment Transactions
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
            <div class="col-md-9 col-lg-10 px-md-4 pt-3">
                <div class="row">
                    <!-- First Row - 4 Cards -->
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card-container">
                            <div class="card-title">Applications For Review</div>
                            <div class="metric-card red">
                                <div class="metric-value">77</div>
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card-container">
                            <div class="card-title">Payment Transactions</div>
                            <div class="metric-card orange">
                                <div class="metric-value">77</div>
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card-container">
                            <div class="card-title">Total Revenue</div>
                            <div class="metric-card green">
                                <div class="metric-value">₱ 77,777</div>
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card-container">
                            <div class="card-title">Total Enrollees</div>
                            <div class="metric-card blue">
                                <div class="metric-value">77</div>
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Second Row - 2 Cards -->
                    <div class="col-md-6 mb-4">
                        <div class="card-container">
                            <div class="card-title">Total Enrollees</div>
                            <div class="metric-card navy">
                                <div class="metric-value">77</div>
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <div class="card-container">
                            <div class="card-title">Total Users</div>
                            <div class="metric-card yellow">
                                <div class="metric-value">77</div>
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Chart Section -->
                    <div class="col-12">
                        <div class="chart-container">
                            <h5 class="mb-3">Number of Students per Grade Level</h5>
                            <div style="height: 300px; display: flex; align-items: center; justify-content: center;">
                                <canvas id="gradeLevelChart" style="width: 100%; height: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Example: Render a bar chart for "Number of Students per Grade Level"
        const ctx = document.createElement('canvas');
        ctx.style.width = '100%';
        ctx.style.height = '100%';
        const chartContainer = document.querySelector('.chart-container div');
        chartContainer.innerHTML = ''; // Clear placeholder text
        chartContainer.appendChild(ctx);

        const data = {
            labels: [
            'Pre-Kindergarten', 'Kindergarten', 'Grade 1', 'Grade 2', 'Grade 3', 
            'Grade 4', 'Grade 5', 'Grade 6', 'Grade 7', 'Grade 8', 
            'Grade 9', 'Grade 10', 'Grade 11', 'Grade 12'
            ],
            datasets: [{
            label: 'Number of Students',
            data: [30, 40, 50, 45, 60, 55, 70, 65, 80, 75, 85, 90, 95, 100],
            backgroundColor: [
                'rgba(52, 152, 219, 0.7)', 'rgba(46, 204, 113, 0.7)', 
                'rgba(241, 196, 15, 0.7)', 'rgba(231, 76, 60, 0.7)', 
                'rgba(155, 89, 182, 0.7)', 'rgba(52, 73, 94, 0.7)', 
                'rgba(26, 188, 156, 0.7)', 'rgba(22, 160, 133, 0.7)', 
                'rgba(39, 174, 96, 0.7)', 'rgba(41, 128, 185, 0.7)', 
                'rgba(142, 68, 173, 0.7)', 'rgba(44, 62, 80, 0.7)', 
                'rgba(243, 156, 18, 0.7)', 'rgba(192, 57, 43, 0.7)'
            ],
            borderColor: [
                'rgba(52, 152, 219, 1)', 'rgba(46, 204, 113, 1)', 
                'rgba(241, 196, 15, 1)', 'rgba(231, 76, 60, 1)', 
                'rgba(155, 89, 182, 1)', 'rgba(52, 73, 94, 1)', 
                'rgba(26, 188, 156, 1)', 'rgba(22, 160, 133, 1)', 
                'rgba(39, 174, 96, 1)', 'rgba(41, 128, 185, 1)', 
                'rgba(142, 68, 173, 1)', 'rgba(44, 62, 80, 1)', 
                'rgba(243, 156, 18, 1)', 'rgba(192, 57, 43, 1)'
            ],
            borderWidth: 1
            }]
        };

        const options = {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Grade Level Distribution'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    });
</script>


</body>
</html>
