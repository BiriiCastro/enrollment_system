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
    <title>Admin - SJBPS Payment Transactions</title>
    <link rel="icon" type="image/png" href="assets/main/logo/st-johns-logo.png">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #3498db;
            --bg-light-gray: #f0f2f5;
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
        .logo-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
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
        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
        }
        .status-paid {
            color: #2ecc71;
            font-weight: bold;
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

</head>
<body>
    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <img id="navLogo" src="assets/homepage_images/logo/placeholder.png" alt="Profile" class="logo-image me-2">
                <a class="navbar-brand" href="admin-dashboard.php" id="adminWelcomeMessage">WELCOME! Admin</a>
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
                        <a class="nav-link" href="admin-dashboard.php">
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
                        <a class="nav-link" href="admin-declined-application.php">
                            <i class="fas fa-times-circle me-2"></i>Declined Applications
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="admin-interviews.php">
                            <i class="fas fa-calendar-check me-2"></i>Interviews
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-declined-interviews.php">
                            <i class="fas fa-times-circle me-2"></i>Declined Interviews
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="admin-payment-transaction.php">
                            <i class="fas fa-money-check-alt me-2"></i>Payment Transactions
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-all-enrollees.php">
                            <i class="fas fa-users me-2"></i>All Enrollees
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-grade-section.php">
                            <i class="fas fa-chalkboard-teacher me-2"></i>Grade-Section
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-curriculum.php">
                            <i class="fas fa-book-open me-2"></i>Curriculum
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-homepage-editor.php">
                            <i class="fas fa-edit me-2"></i>Home Page Editor
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-user-cog me-2"></i>Users
                        </a>
                    </li>
                </ul>
            </div>
        
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">Approved Applications</h4>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                        <i class="fas fa-filter me-2"></i>Advanced Filters
                    </button>
                </div>
                
                <!-- Search Bar -->
                <div class="search-container d-flex justify-content-end">
                    <div class="input-group" style="max-width: 300px;">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search applications" aria-label="Search">
                        <button class="btn btn-outline-secondary" type="button" id="clearBtn">
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
                                <th>Applying For</th>
                                <th>School Year</th>
                                <th>Enrollment Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- JavaScript will populate this section -->
                            <tr>
                                <td colspan="6" class="text-center py-5 empty-table-message">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <p>No applications for review at this time</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </>
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
                    <!-- Enrollment Type Filter -->
                    <div class="mb-3">
                        <label class="form-label">Enrollment Type</label>
                        <select id="enrollmentTypeFilter" class="form-select">
                            <option value="">All Types</option>
                            <option value="old">Old Student</option>
                            <option value="new/transferee">New/Transferee Student</option>
                        </select>
                    </div>
                    
                    <!-- Grade Applying For Filter -->
                    <div class="mb-3">
                        <label class="form-label">Grade Applying For</label>
                        <select id="gradeApplyingFilter" class="form-select">
                            <option value="">All Grade Levels</option>
                            <option value="Prekindergarten">Prekindergarten</option>
                            <option value="Kindergarten">Kindergarten</option>
                            <option value="Grade 1">Grade 1</option>
                            <option value="Grade 2">Grade 2</option>
                            <option value="Grade 3">Grade 3</option>
                            <option value="Grade 4">Grade 4</option>
                            <option value="Grade 5">Grade 5</option>
                            <option value="Grade 6">Grade 6</option>
                            <option value="Grade 7">Grade 7</option>
                            <option value="Grade 8">Grade 8</option>
                            <option value="Grade 9">Grade 9</option>
                            <option value="Grade 10">Grade 10</option>
                            <option value="Grade 11">Grade 11</option>
                            <option value="Grade 12">Grade 12</option>
                        </select>
                    </div>
                    
                    <!-- School Year Filter -->
                    <div class="mb-3">
                        <label class="form-label">School Year</label>
                        <select id="schoolYearFilter" class="form-select">
                            <option value="">All School Years</option>
                            <option value="2023-2024">2023-2024</option>
                            <option value="2024-2025">2024-2025</option>
                            <option value="2025-2026">2025-2026</option>
                            <!-- Add more school years as needed -->
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="applyFiltersBtn" class="btn btn-primary">Apply Filters</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- Advance Filter Method -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetchEnrollments();

            // Get filter elements
            const gradeApplyingFilter = document.getElementById("gradeApplyingFilter");
            const applyFiltersBtn = document.getElementById("applyFiltersBtn");

            // Apply filters when the button is clicked
            applyFiltersBtn.addEventListener("click", () => {
                filterTable();
                // Close modal after applying filters
                let filterModalEl = document.getElementById("filterModal");
                let filterModal = bootstrap.Modal.getInstance(filterModalEl);
                filterModal.hide();

            });
            
            // Search Method
            // Filter subjects based on search input
            const searchInput = document.getElementById("searchInput");
            const clearBtn = document.getElementById("clearBtn");
            const tableBody = document.querySelector("tbody");
            
            searchInput.addEventListener("input", function () {
                const searchValue = this.value.toLowerCase().trim();
                let visibleRows = 0;

                document.querySelectorAll("tbody tr").forEach(row => {
                    const rowText = row.innerText.toLowerCase();
                    if (rowText.includes(searchValue)) {
                        row.style.display = "";
                        visibleRows++;
                    } else {
                        row.style.display = "none";
                    }
                });
            });

            clearBtn.addEventListener("click", function () {
                searchInput.value = "";
                document.querySelectorAll("tbody tr").forEach(row => row.style.display = "");
            });
        });

        // Fetch enrollments from the database
        function fetchEnrollments() {
            fetch("databases/fetch_for_payment_applications.php")
                .then(response => response.json())
                .then(data => {
                    let tbody = document.querySelector("tbody");
                    tbody.innerHTML = ""; // Clear existing rows

                    if (data.length === 0) {
                        tbody.innerHTML = `
                            <tr>
                                <td colspan="7" class="text-center py-5 empty-table-message">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <p>No applications for review at this time</p>
                                </td>
                            </tr>
                        `;
                    } else {
                        data.forEach((student, index) => {
                            let row = document.createElement("tr");
                            row.classList.add("student-row");
                            row.setAttribute("data-id", student.student_id);

                            row.innerHTML = `
                                <td>${index += 1}</td>
                                <td>${student.student_name}</td>
                                <td>${student.grade_applying_name}</td>
                                <td>${student.school_year}</td>
                                <td>${student.enrollment_status}</td>
                                <td>
                                    <form action="#" method="POST" style="display:inline;">
                                        <input type="hidden" name="student_id" value="${student.student_id}">
                                        <button type="submit" class="btn btn-primary btn-sm">Create Transaction</button>
                                    </form>
                                </td>
                            `;
                            tbody.appendChild(row);
                        });

                    }
                })
                .catch(error => console.error("Error fetching data:", error));
        }




        
        document.getElementById("applyFiltersBtn").addEventListener("click", function() {
            filterTable();  // Call the filterTable function when the "Apply Filters" button is clicked
            $('#filterModal').modal('hide');  // Close the modal after applying filters
        });

        // Filter Method
        function filterTable() {
            let enrollmentType = document.getElementById("enrollmentTypeFilter").value.toLowerCase();
            let gradeApplying = document.getElementById("gradeApplyingFilter").value.toLowerCase();
            let schoolYear = document.getElementById("schoolYearFilter").value.toLowerCase();

            document.querySelectorAll("tbody tr").forEach(row => {
                let typeMatch = enrollmentType === "" || row.innerHTML.toLowerCase().includes(enrollmentType);
                let gradeMatch = gradeApplying === "" || row.innerHTML.toLowerCase().includes(gradeApplying);
                let yearMatch = schoolYear === "" || row.innerHTML.toLowerCase().includes(schoolYear);

                row.style.display = typeMatch && gradeMatch && yearMatch ? "" : "none";
            });
        }

        function searchTable(query) {
            document.querySelectorAll("tbody tr").forEach(row => {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(query) ? "" : "none";
            });
        }





        


        




    </script>
</body>
</html>