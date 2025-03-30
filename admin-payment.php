<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SJBPS Admin Dashboard - Payment Transactions</title>
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
    </style>
</head>
<body>
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
                        <a class="nav-link" href="Admin.php">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Enrollment For Review.php">
                            <i class="fas fa-file-alt me-2"></i>Applications for Review
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="Payment.php">
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
                    <h4 class="mb-0">Payment Transactions</h4>
                    <div class="d-flex">
                        <!-- Updated Date Transaction Dropdown -->
                        <div class="dropdown me-2">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dateDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-calendar me-2"></i>Date Transaction
                            </button>
                            <div class="dropdown-menu p-3" style="width: 300px;" aria-labelledby="dateDropdown">
                                <h6 class="dropdown-header">Select Date Range</h6>
                                <div class="mb-2">
                                    <label for="datePreset" class="form-label">Quick Select:</label>
                                    <select class="form-select form-select-sm" id="datePreset">
                                        <option value="">Custom Range</option>
                                        <option value="today">Today</option>
                                        <option value="yesterday">Yesterday</option>
                                        <option value="thisWeek">This Week</option>
                                        <option value="lastWeek">Last Week</option>
                                        <option value="thisMonth">This Month</option>
                                        <option value="lastMonth">Last Month</option>
                                        <option value="thisYear">This Year</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="startDate" class="form-label">From:</label>
                                    <input type="date" class="form-control form-control-sm" id="startDate">
                                </div>
                                <div class="mb-2">
                                    <label for="endDate" class="form-label">To:</label>
                                    <input type="date" class="form-control form-control-sm" id="endDate">
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-sm btn-secondary me-2" id="clearDateFilter">Clear</button>
                                    <button type="button" class="btn btn-sm btn-primary" id="applyDateFilter">Apply</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Value Dropdown -->
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="valueDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-peso-sign me-2"></i>Value
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="valueDropdown">
                                <li><a class="dropdown-item" href="#">All Values</a></li>
                                <li><a class="dropdown-item" href="#">Above 1000</a></li>
                                <li><a class="dropdown-item" href="#">Below 1000</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
        
                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Student Number</th>
                                <th>Grade Level</th>
                                <th>Amount</th>
                                <th>Date Posted</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6" class="text-center py-5 empty-table-message">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <p>No payment transactions found</p>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <!-- Fetch the logo from the database and display it in the navbar -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetch("databases/fetch_logo.php")
                .then(response => response.json())
                .then(data => {
                    let navLogo = document.getElementById("navLogo");
                    if (data.status === "success" && data.image) {
                        navLogo.src = data.image; // Load logo from database
                    } else {
                        console.error("Error:", data.message);
                        navLogo.src = "assets/homepage_images/logo/placeholder.png"; // Default placeholder
                    }
                })
                .catch(error => console.error("Error fetching logo:", error));
        });
    </script>

    <!-- Date Filter Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Date filter functionality
        const datePreset = document.getElementById('datePreset');
        const startDate = document.getElementById('startDate');
        const endDate = document.getElementById('endDate');
        const clearDateFilter = document.getElementById('clearDateFilter');
        const applyDateFilter = document.getElementById('applyDateFilter');
        const dateDropdown = document.getElementById('dateDropdown');
        
        // Set default date to today
        const today = new Date();
        const todayString = today.toISOString().split('T')[0];
        endDate.value = todayString;
        
        // Function to set date range based on preset selection
        datePreset.addEventListener('change', function() {
            const today = new Date();
            let start = new Date();
            let end = new Date();
            
            switch(this.value) {
                case 'today':
                    // Start and end are already today
                    break;
                case 'yesterday':
                    start.setDate(today.getDate() - 1);
                    end.setDate(today.getDate() - 1);
                    break;
                case 'thisWeek':
                    start.setDate(today.getDate() - today.getDay());
                    break;
                case 'lastWeek':
                    start.setDate(today.getDate() - today.getDay() - 7);
                    end.setDate(today.getDate() - today.getDay() - 1);
                    break;
                case 'thisMonth':
                    start.setDate(1);
                    break;
                case 'lastMonth':
                    start = new Date(today.getFullYear(), today.getMonth() - 1, 1);
                    end = new Date(today.getFullYear(), today.getMonth(), 0);
                    break;
                case 'thisYear':
                    start = new Date(today.getFullYear(), 0, 1);
                    break;
                default:
                    // If custom, don't change the dates
                    return;
            }
            
            startDate.value = start.toISOString().split('T')[0];
            endDate.value = end.toISOString().split('T')[0];
        });
        
        // Clear date filter
        clearDateFilter.addEventListener('click', function() {
            datePreset.value = '';
            startDate.value = '';
            endDate.value = '';
            dateDropdown.textContent = 'Date Transaction';
            dateDropdown.innerHTML = '<i class="fas fa-calendar me-2"></i>Date Transaction';
        });
        
        // Apply date filter
        applyDateFilter.addEventListener('click', function() {
            let filterText = 'Date Transaction';
            
            if (datePreset.value) {
                // If a preset is selected, use that as the label
                const presetLabel = datePreset.options[datePreset.selectedIndex].text;
                filterText = presetLabel;
            } else if (startDate.value && endDate.value) {
                // If custom date range, show the range
                filterText = `${startDate.value} to ${endDate.value}`;
            } else if (startDate.value) {
                // If only start date is set
                filterText = `From ${startDate.value}`;
            } else if (endDate.value) {
                // If only end date is set
                filterText = `Until ${endDate.value}`;
            }
            
            // Update button text and keep the icon
            dateDropdown.innerHTML = `<i class="fas fa-calendar me-2"></i>${filterText}`;
            
            // Close the dropdown (requires bootstrap methods)
            const dropdownInstance = bootstrap.Dropdown.getInstance(dateDropdown);
            if (dropdownInstance) {
                dropdownInstance.hide();
            }
            
            // Here you would typically trigger a form submission or AJAX request to filter the table
            console.log('Filter applied:', {
                preset: datePreset.value,
                startDate: startDate.value,
                endDate: endDate.value
            });
            
            // You can add code here to refresh the table based on the selected date range
            // This would typically involve an AJAX call to your server to fetch filtered data
        });
        
        // Prevent closing dropdown when clicking inside it
        document.querySelector('.dropdown-menu').addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });
    </script>
</body>
</html>