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
    <title>SJBPS Admin - Curriculum</title>
    <link rel="icon" type="image/png" href="images/logo/st-johns-logo.png">

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
        .logo-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
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
        .grade-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .grade-card:hover {
            background-color: #3498db;
            color: #f0f0f0;
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .school-year-select {
            max-width: 200px;
        }
        .warning-alert {
            background-color: #fff3cd;
            border-color: #ffecb5;
            color: #664d03;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            margin-bottom: 1rem;
            display: inline-flex;
            align-items: center;
        }
        .warning-alert i {
            margin-right: 0.5rem;
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
                        <a class="nav-link" href="#">
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
                        <a class="nav-link active" href="admin-curriculum.php">
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
                    <div class="d-flex align-items-center">
                        <h4 class="mb-0">Grade and Sections</h4>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="ms-auto">
                            <div class="col">
                                <!--<label for="schoolYearSelect" class="form-label mb-0 me-2">School Year:</label>-->
                                <select id="schoolYearSelect" class="form-select school-year-select">
                                    <!-- Options will be populated dynamically -->
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end align-items-center mb-4 gap-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCurriculumModal">
                        Add Curriculum
                    </button>
                    <!-- Search Bar -->
                    <div class="search-container">
                        <div class="input-group" style="max-width: 300px;">
                            <input type="text" id="searchCurriculum" class="form-control" placeholder="Search applications" aria-label="Search">
                            <button class="btn btn-outline-secondary" type="button" id="clearBtn">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Add Curriculum Modal -->
                <div class="modal fade" id="addCurriculumModal" tabindex="-1" aria-labelledby="addCurriculumModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addCurriculumModalLabel">Add Curriculum</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="addCurriculumForm">
                                    <div class="mb-3">
                                        <label for="curriculumName" class="form-label">Curriculum Name</label>
                                        <input type="text" class="form-control" id="curriculumName" name="curriculumName" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="schoolYearModal" class="form-label">School Year</label>
                                        <select class="form-select" id="schoolYearModal" name="schoolYearModal" required>
                                            <!-- Dynamically populated -->
                                        </select>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-2">Update</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Curriculum Modal -->
                <div class="modal fade" id="editCurriculumModal" tabindex="-1" aria-labelledby="editCurriculumModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editCurriculumModalLabel">Edit Curriculum</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="editCurriculumForm">
                                    <input type="hidden" id="editCurriculumId" name="editCurriculumId">
                                    <div class="mb-3">
                                        <label for="editCurriculumName" class="form-label">Curriculum Name</label>
                                        <input type="text" class="form-control" id="editCurriculumName" name="editCurriculumName" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editSchoolYearModal" class="form-label">School Year</label>
                                        <select class="form-select" id="editSchoolYearModal" name="editSchoolYearModal" required>
                                            <!-- Dynamically populated -->
                                        </select>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-2">Update</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete Curriculum Modal -->
                <div class="modal fade" id="deleteCurriculumModal" tabindex="-1" aria-labelledby="deleteCurriculumModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteCurriculumModalLabel">Delete Curriculum</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this curriculum?</p>
                                <input type="hidden" id="deleteCurriculumId">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                </script>

                <!-- Curriculum Table -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Curriculum Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="curriculumContainer">
                            <!-- Dynamic Content will be inserted here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const schoolYearSelect = document.getElementById("schoolYearSelect");
            const schoolYearModal = document.getElementById("schoolYearModal");
            const editSchoolYearModal = document.getElementById("editSchoolYearModal");
            const curriculumContainer = document.getElementById("curriculumContainer"); // Assuming there's a container for curriculums

            // Search Bar Method
            const searchInput = document.getElementById("searchCurriculum");

            searchInput.addEventListener("input", function () {
                const searchTerm = searchInput.value.toLowerCase();

                Array.from(curriculumContainer.children).forEach(row => {
                    const curriculumName = row.querySelector("td:nth-child(2)").textContent.toLowerCase();
                    if (curriculumName.includes(searchTerm)) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            });

            // Function to fetch curriculums based on school year
            function fetchCurriculums(schoolYearId) {
                if (!schoolYearId) return;

                fetch(`databases/fetch_curriculums.php?school_year_id=${schoolYearId}`)
                    .then(response => response.json())
                    .then(data => {
                        curriculumContainer.innerHTML = '';
                        if (data.status === "success" && Array.isArray(data.curriculums)) {
                            data.curriculums.forEach((curriculum, index) => {
                                const row = document.createElement("tr");
                                // Inside the fetchCurriculums function
                                console.log(curriculum.curriculum_id)
                                row.innerHTML = `
                                    <td>${curriculum.curriculum_id}</td>
                                    <td>${curriculum.curriculum_name}</td>
                                    <td>
                                        <form action="admin-subjects.php" method="POST" style="display:inline;">
                                            <input type="hidden" name="curriculum_id" value="${curriculum.curriculum_id}">
                                            <button type="submit" class="btn btn-success btn-sm">Subjects</button>
                                        </form>
                                        <button class="btn btn-warning btn-sm edit-btn" 
                                            data-id="${curriculum.curriculum_id}" 
                                            data-name="${curriculum.curriculum_name}" 
                                            data-year="${curriculum.school_year_id}">
                                            Edit
                                        </button>
                                        <button class="btn btn-danger btn-sm delete-btn" 
                                            data-id="${curriculum.curriculum_id}" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteCurriculumModal">
                                            Delete
                                        </button>
                                    </td>
                                `;

                                curriculumContainer.appendChild(row);
                            });

                            // Attach event listener to the "Edit" buttons
                            document.querySelectorAll(".edit-btn").forEach(button => {
                                button.addEventListener("click", function () {
                                    const curriculumId = this.getAttribute("data-id");
                                    const curriculumName = this.getAttribute("data-name");
                                    const schoolYearId = this.getAttribute("data-year");

                                    if (!curriculumId) {
                                        console.error("Error: curriculumId is missing");
                                        return;
                                    }

                                    // Populate the edit modal
                                    document.getElementById("editCurriculumId").value = curriculumId;
                                    document.getElementById("editCurriculumName").value = curriculumName;
                                    document.getElementById("editSchoolYearModal").value = schoolYearId;

                                    // Show the modal
                                    const editModal = new bootstrap.Modal(document.getElementById("editCurriculumModal"));
                                    editModal.show();
                                });
                            });

                            const deleteModal = new bootstrap.Modal(document.getElementById("deleteCurriculumModal")); // Initialize modal
                            const deleteCurriculumIdInput = document.getElementById("deleteCurriculumId");
                            const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");

                            // Attach event listener to the "Delete" buttons
                            document.querySelectorAll(".delete-btn").forEach(button => {
                                button.addEventListener("click", function () {
                                    const curriculumId = this.getAttribute("data-id");

                                    console.log("Curriculum ID to delete:", curriculumId);
                                    if (!curriculumId) {
                                    console.error("Error: curriculumId is missing");
                                    return;
                                    }

                                    deleteCurriculumIdInput.value = curriculumId;
                                    deleteModal.show(); // Show the modal
                                });
                            });

                            // Handle delete confirmation
                            confirmDeleteBtn.addEventListener("click", function () {
                                const curriculumId = deleteCurriculumIdInput.value;

                                if (curriculumId) {
                                    fetch(`databases/delete_curriculum.php?curriculum_id=${curriculumId}`, {
                                        method: "GET"
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.status === "success") {
                                            alert("Curriculum deleted successfully!");
                                            location.reload(); // Reload the page to refresh the list
                                        } else {
                                            alert("Error: " + data.message);
                                        }
                                    })
                                    .catch(error => console.error("Error:", error));
                                }
                            });

                        } else {
                            curriculumContainer.innerHTML = `<tr><td colspan="3" class="text-muted text-center">No curriculums available.</td></tr>`;
                        }
                    })
                    .catch(error => console.error("Error fetching curriculums:", error));
            }

            // Fetch school years and populate the dropdowns
            fetch("databases/school_years.php")
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success" && Array.isArray(data.schoolYears)) {
                        data.schoolYears.forEach(year => {
                            const option = document.createElement("option");
                            option.value = year.school_year_id;
                            option.textContent = year.school_year;
                            schoolYearSelect.appendChild(option);
                            schoolYearModal.appendChild(option.cloneNode(true));
                            editSchoolYearModal.appendChild(option.cloneNode(true));
                        });

                        if (schoolYearSelect.value) {
                            fetchCurriculums(schoolYearSelect.value);
                        }
                    } else {
                        console.error("Error fetching school years:", data.message);
                    }
                })
                .catch(error => console.error("Error:", error));

            // Fetch curriculums when school year is changed
            schoolYearSelect.addEventListener("change", function () {
                fetchCurriculums(schoolYearSelect.value);
            });

            // Handle curriculum addition
            document.getElementById("addCurriculumForm").addEventListener("submit", function (event) {
                event.preventDefault();

                const formData = new FormData(this);

                fetch("databases/insert_curriculum.php", {
                    method: "POST",
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "success") {
                            alert("Curriculum added successfully!");
                            location.reload();
                        } else {
                            alert("Error: " + data.message);
                        }
                    })
                    .catch(error => console.error("Error:", error));
            });

            // Handle curriculum editing
            document.getElementById("editCurriculumForm").addEventListener("submit", function (event) {
                event.preventDefault();

                const formData = new FormData(this);

                console.log("FormData contents:");
                for (let [key, value] of formData.entries()) {
                    console.log(`${key}: ${value}`);
                }

                fetch("databases/edit_curriculum.php", {
                    method: "POST",
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "success") {
                            alert("Curriculum updated successfully!");
                            location.reload();
                        } else {
                            alert("Error: " + data.message);
                        }
                    })
                    .catch(error => console.error("Error:", error));
            });


        });
    </script>



</body>
</html>