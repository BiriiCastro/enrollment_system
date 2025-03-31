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
    <title>Admin - SJBPS Homepage Editor</title>
    <link rel="icon" type="image/png" href="images/logo/st-johns-logo.png">
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
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
        .text-title {
            font-size: 32px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }
        .card-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            min-height: 150px;
            padding: 15px;
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: center;
            transition: transform 0.3s ease;
        }
        .card-container:hover {
            transform: scale(1.03);
        }
        .card-title {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 22px;
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
        .metric-card.purple { background-color: #9b59b6; }
        .metric-card.teal { background-color: #1abc9c; }
        .metric-card.gray { background-color: #95a5a6; }
        .metric-card.pink { background-color: #e91e63; }
        .metric-card.brown { background-color: #8d6e63; }
        
        .card-action {
            font-size: 24px;
            font-weight: bold;
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
                            <i class="fas fa-users me-2"></i>Grade-Section
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="admin-homepage-editor.php">
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
            <div class="col-md-9 col-lg-10 px-md-4 pt-3">
                <div class="row">
                    <!-- First Row - 2 Cards -->
                    <div class="col-12 mb-4">
                        <h4 class="text-title text-align">
                            Main Page
                        </h4>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4">
                        <div class="card-container">
                            <div class="card-title">Logo</div>
                            <div class="metric-card red" data-bs-toggle="modal" data-bs-target="#editLogoModal">
                                <div class="metric-value">Edit</div>
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-6 mb-4">
                        <div class="card-container">
                            <div class="card-title">Carousel</div>
                            <div class="metric-card orange" data-bs-toggle="modal" data-bs-target="#editCarouselModal">
                                <div class="metric-value">Edit</div>
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Second Row - 2 Cards -->
                    <div class="col-12 mb-4">
                        <h4 class="text-title text-align">
                            Mission & Vission Page
                        </h4>
                    </div>

                    <div class="col-md-6 col-lg-6 mb-4">
                        <div class="card-container">
                            <div class="card-title">Mission</div>
                            <div class="metric-card green" data-bs-toggle="modal" data-bs-target="#editMissionModal">
                                <div class="metric-value">Edit</div>
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-6 mb-4">
                        <div class="card-container">
                            <div class="card-title">Vision</div>
                            <div class="metric-card blue" data-bs-toggle="modal" data-bs-target="#editVisionModal">
                                <div class="metric-value">Edit</div>
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Third Row - 2 Cards -->
                    <div class="col-12 mb-4">
                        <h4 class="text-title text-align">
                            School Gallery
                        </h4>
                    </div>

                    <div class="col-md-12 col-lg-12 mb-4">
                        <div class="card-container">
                            <div class="card-title">Pictures</div>
                            <div class="metric-card navy" data-bs-toggle="modal" data-bs-target="#editGalleryModal">
                                <div class="card-action">Edit</div>
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Fourth Row - 3 Cards -->
                    <div class="col-12 mb-4">
                        <h4 class="text-title text-align">
                            Enrollment Procedure
                        </h4>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card-container">
                            <div class="card-title">Enrollment Important Information</div>
                            <div class="metric-card yellow" data-bs-toggle="modal" data-bs-target="#editEnrollmentInfoModal">
                                <div class="card-action">Edit</div>
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card-container">
                        <div class="card-title">For Transferee/New Students</div>
                            <div class="metric-card purple" data-bs-toggle="modal" data-bs-target="#editTransfereeModal">
                                <div class="card-action">Edit</div>
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6  col-lg-4 mb-4">
                        <div class="card-container">
                            <div class="card-title">For Old Students</div>
                            <div class="metric-card teal" data-bs-toggle="modal" data-bs-target="#editOldStudentsModal">
                                <div class="card-action">Edit</div>
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

        </div>
    </div>

    <!-- Modal for Editing Logo -->
    <div class="modal fade" id="editLogoModal" tabindex="-1" aria-labelledby="editLogoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLogoModalLabel">Edit Logo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="logoForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <!-- Display the current logo -->
                        <h6 >Current Logo:</h6>
                        <div class="text-center mb-3">
                            <img id="currentLogo" src="assets/homepage_images/logo/placeholder.png" alt="Current Logo" class="img-fluid rounded-circle" style="max-width: 150px; height: auto;">
                        </div>
                        <!-- File input -->
                        <div class="mb-3">
                            <label for="logoFile" class="form-label">Upload New Logo</label>
                            <input type="file" class="form-control" id="logoFile" name="logoFile" accept="image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Editing Carousel -->
    <div class="modal fade" id="editCarouselModal" tabindex="-1" aria-labelledby="editCarouselModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCarouselModalLabel">Edit Carousel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="carouselForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <!-- Display current carousel images -->
                        <h6>Current Carousel Images:</h6>
                        <div id="carouselImagesContainer" class="mb-3 text-center">
                            <!-- Images will be dynamically loaded here -->
                        </div>
                        <!-- File input for new images -->
                        <div class="mb-3">
                            <label for="carouselFile1" class="form-label">Upload Image 1</label>
                            <input type="file" class="form-control" id="carouselFile1" name="carouselFile1" accept="image/*" required>
                            <small class="text-muted">Select an image file to replace the current carousel image.</small>
                        </div>

                        <div class="mb-3">
                            <label for="carouselFile2" class="form-label">Upload Image 2</label>
                            <input type="file" class="form-control" id="carouselFile2" name="carouselFile2" accept="image/*" required>
                            <small class="text-muted">Select an image file to replace the current carousel image.</small>
                        </div>

                        <div class="mb-3">
                            <label for="carouselFile3" class="form-label">Upload Image 3</label>
                            <input type="file" class="form-control" id="carouselFile3" name="carouselFile3" accept="image/*"  required>
                            <small class="text-muted">Select an image file to replace the current carousel image.</small>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal for Editing Mission -->
    <div class="modal fade" id="editMissionModal" tabindex="-1" aria-labelledby="editMissionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMissionModalLabel">Edit Mission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="missionForm">
                    <div class="modal-body">
                        <!-- Textarea for editing mission -->
                        <div class="mb-3">
                            <label for="missionText" class="form-label">Mission Statement</label>
                            <textarea class="form-control" id="missionText" name="missionText" rows="10" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Editing Vision -->
    <div class="modal fade" id="editVisionModal" tabindex="-1" aria-labelledby="editVisionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editVisionModalLabel">Edit Vision</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="visionForm">
                    <div class="modal-body">
                        <!-- Textarea for editing vision -->
                        <div class="mb-3">
                            <label for="visionText" class="form-label">Vision Statement</label>
                            <textarea class="form-control" id="visionText" name="visionText" rows="10" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Modal for Editing Gallery Pictures -->
    <div class="modal fade" id="editGalleryModal" tabindex="-1" aria-labelledby="editGalleryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGalleryModalLabel">Edit Gallery Pictures</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="galleryForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <h6>Current Gallery Pictures:</h6>
                        <div id="galleryImagesContainer" class="mb-3 text-center">
                            <!-- Images will be dynamically loaded here -->
                        </div>
                        <!-- File inputs for new images -->
                        <div class="mb-3">
                            <label for="galleryFile1" class="form-label">Upload Image 1</label>
                            <input type="file" class="form-control" id="galleryFile1" name="galleryFile1" accept="image/*">
                            <small class="text-muted">Select an image file to replace the current gallery image.</small>
                        </div>
                        <div class="mb-3">
                            <label for="galleryFile2" class="form-label">Upload Image 2</label>
                            <input type="file" class="form-control" id="galleryFile2" name="galleryFile2" accept="image/*">
                            <small class="text-muted">Select an image file to replace the current gallery image.</small>
                        </div>
                        <div class="mb-3">
                            <label for="galleryFile3" class="form-label">Upload Image 3</label>
                            <input type="file" class="form-control" id="galleryFile3" name="galleryFile3" accept="image/*">
                            <small class="text-muted">Select an image file to replace the current gallery image.</small>
                        </div>
                        <div class="mb-3">
                            <label for="galleryFile4" class="form-label">Upload Image 4</label>
                            <input type="file" class="form-control" id="galleryFile4" name="galleryFile4" accept="image/*">
                            <small class="text-muted">Select an image file to replace the current gallery image.</small>
                        </div>
                        <div class="mb-3">
                            <label for="galleryFile5" class="form-label">Upload Image 5</label>
                            <input type="file" class="form-control" id="galleryFile5" name="galleryFile5" accept="image/*">
                            <small class="text-muted">Select an image file to replace the current gallery image.</small>
                        </div>
                        <div class="mb-3">
                            <label for="galleryFile6" class="form-label">Upload Image 6</label>
                            <input type="file" class="form-control" id="galleryFile6" name="galleryFile6" accept="image/*">
                            <small class="text-muted">Select an image file to replace the current gallery image.</small>
                        </div>
                        <div class="mb-3">
                            <label for="galleryFile7" class="form-label">Upload Image 7</label>
                            <input type="file" class="form-control" id="galleryFile7" name="galleryFile7" accept="image/*">
                            <small class="text-muted">Select an image file to replace the current gallery image.</small>
                        </div>
                        <div class="mb-3">
                            <label for="galleryFile8" class="form-label">Upload Image 8</label>
                            <input type="file" class="form-control" id="galleryFile8" name="galleryFile8" accept="image/*">
                            <small class="text-muted">Select an image file to replace the current gallery image.</small>
                        </div>
                        <div class="mb-3">
                            <label for="galleryFile9" class="form-label">Upload Image 9</label>
                            <input type="file" class="form-control" id="galleryFile9" name="galleryFile9" accept="image/*">
                            <small class="text-muted">Select an image file to replace the current gallery image.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Editing Enrollment Important Information -->
    <div class="modal fade" id="editEnrollmentInfoModal" tabindex="-1" aria-labelledby="editEnrollmentInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEnrollmentInfoModalLabel">Edit Enrollment Important Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="enrollmentInfoForm">
                    <div class="modal-body">
                        <!-- Textarea for editing enrollment information -->
                        <div class="mb-3">
                            <label for="enrollmentInfoText" class="form-label">Enrollment Important Information</label>
                            <textarea class="form-control" id="enrollmentInfoText" name="enrollmentInfoText" rows="10" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Editing For Transferee/New Students -->
    <div class="modal fade" id="editTransfereeModal" tabindex="-1" aria-labelledby="editTransfereeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTransfereeModalLabel">Edit Information for Transferee/New Students</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="transfereeForm">
                    <div class="modal-body">
                        <!-- Textarea for editing transferee/new students information -->
                        <div class="mb-3">
                            <label for="transfereeText" class="form-label">Information for Transferee/New Students</label>
                            <textarea class="form-control" id="transfereeText" name="transfereeText" rows="10" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Editing For Old Students -->
    <div class="modal fade" id="editOldStudentsModal" tabindex="-1" aria-labelledby="editOldStudentsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editOldStudentsModalLabel">Edit Information for Old Students</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="oldStudentsForm">
                    <div class="modal-body">
                        <!-- Textarea for editing old students information -->
                        <div class="mb-3">
                            <label for="oldStudentsText" class="form-label">Information for Old Students</label>
                            <textarea class="form-control" id="oldStudentsText" name="oldStudentsText" rows="10" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const oldStudentsModal = document.getElementById("editOldStudentsModal");
            const oldStudentsText = document.getElementById("oldStudentsText");
            const oldStudentsForm = document.getElementById("oldStudentsForm");

            // Fetch and display current information when the modal opens
            oldStudentsModal.addEventListener("show.bs.modal", function () {
                fetch("databases/fetch_old_students_req_info.php")
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "success") {
                            oldStudentsText.value = data.info;
                        } else {
                            console.error("Error:", data.message);
                            alert("Error fetching information: " + data.message);
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching information:", error);
                        alert("Failed to load information. Check your connection.");
                    });
            });

            // Handle form submission for updating information
            oldStudentsForm.addEventListener("submit", function (e) {
                e.preventDefault();
                const formData = new FormData(oldStudentsForm);

                fetch("databases/edit_old_students_req_info.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    if (data.status === "success") {
                        // Close the modal after successful update
                        const modalInstance = bootstrap.Modal.getOrCreateInstance(oldStudentsModal);
                        modalInstance.hide();

                        // Refresh the admin-homepage-editor.php page
                        setTimeout(() => {
                            window.location.href = "admin-homepage-editor.php";
                        }, 500);
                    }
                })
                .catch(error => {
                    console.error("Error updating information:", error);
                    alert("Failed to update information.");
                });
            });
        });
    </script>


    
    
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    
    <!-- script to handle logo upload and display -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var editLogoModal = document.getElementById("editLogoModal");

            // Fetch and display current logo when modal opens
            editLogoModal.addEventListener("show.bs.modal", function () {
                fetch("databases/fetch_logo.php")
                    .then(response => response.json())
                    .then(data => {
                        let logoImg = document.getElementById("currentLogo");
                        if (data.status === "success" && data.image) {
                            logoImg.src = data.image; // Load logo from database
                        } else {
                            console.error("Error:", data.message);
                            logoImg.src = "assets/homepage_images/logo/placeholder.png"; // Default placeholder
                        }
                    })
                    .catch(error => console.error("Error fetching logo:", error));
            });

            // AJAX Upload Form Submission
            document.getElementById("logoForm").addEventListener("submit", function (e) {
                e.preventDefault();
                let formData = new FormData(this);

                fetch("databases/edit_logo.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        document.getElementById("currentLogo").src = data.image; // Update the logo preview
                        
                        // Close the modal
                        var modalInstance = bootstrap.Modal.getInstance(editLogoModal);
                        if (modalInstance) {
                            modalInstance.hide();
                        }

                        // Clear the file input fields after submission
                        document.querySelectorAll("#logoForm input[type='file']").forEach(input => {
                            input.value = "";

                        // Refresh the admin-homepage-editor.php page
                        setTimeout(() => {
                            window.location.href = "admin-homepage-editor.php";
                        }, 500);
                        });
                    } else {
                        alert("Error: " + data.message);
                    }
                })
                .catch(error => console.error("Upload error:", error));
            });
        });
    </script>

    <!-- Script to handle carousel image upload and edit -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            loadCarouselImages();

            document.getElementById("carouselForm").addEventListener("submit", function (event) {
                event.preventDefault();

                let formData = new FormData(this);
                fetch("databases/edit_carousel.php", {
                    method: "POST",
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    if (data.status === "success") {
                        loadCarouselImages();
                        let modal = bootstrap.Modal.getInstance(document.getElementById("editCarouselModal"));
                        modal.hide();

                        // Clear the file input fields after submission
                        document.querySelectorAll("#carouselForm input[type='file']").forEach(input => {
                            input.value = "";
                        });

                        // Refresh the admin-homepage-editor.php page
                        setTimeout(() => {
                            window.location.href = "admin-homepage-editor.php";
                        }, 500);

                    }
                })
                .catch(error => console.error("Error:", error));
            });
        });

        function loadCarouselImages() {
            fetch("databases/fetch_carousel.php")
                .then(response => response.json())
                .then(images => {
                    let container = document.getElementById("carouselImagesContainer");
                    container.innerHTML = "";

                    images.forEach((image, index) => {
                        let imgElement = document.createElement("img");
                        imgElement.src = image.image_path;
                        imgElement.className = "img-thumbnail me-2";
                        imgElement.style.width = "150px";
                        container.appendChild(imgElement);
                    });
                })
                .catch(error => console.error("Error loading images:", error));
        }
    </script>

    <!-- Script to handle mission editing -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const missionModal = document.getElementById("editMissionModal");
            const missionText = document.getElementById("missionText");
            const missionForm = document.getElementById("missionForm");

            // Fetch and display current mission when the modal opens
            missionModal.addEventListener("show.bs.modal", function () {
                fetch("databases/fetch_mission.php")
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "success") {
                            missionText.value = data.mission;
                        } else {
                            console.error("Error:", data.message);
                            alert("Error fetching mission: " + data.message);
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching mission:", error);
                        alert("Failed to load mission. Check your connection.");
                    });
            });

            // Handle form submission for updating mission
            missionForm.addEventListener("submit", function (e) {
                e.preventDefault();
                const formData = new FormData(missionForm);

                fetch("databases/edit_mission.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    if (data.status === "success") {
                        // Close the modal after successful update
                        const modalInstance = bootstrap.Modal.getOrCreateInstance(missionModal);
                        modalInstance.hide();

                        // Refresh the admin-homepage-editor.php page
                        setTimeout(() => {
                            window.location.href = "admin-homepage-editor.php";
                        }, 500);
                    }
                })
                .catch(error => {
                    console.error("Error updating mission:", error);
                    alert("Failed to update mission.");
                });
            });
        });
    </script>

    <!-- Script to handle vision editing -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const visionModal = document.getElementById("editVisionModal");
            const visionText = document.getElementById("visionText");
            const visionForm = document.getElementById("visionForm");

            // Fetch and display current vision when the modal opens
            visionModal.addEventListener("show.bs.modal", function () {
                fetch("databases/fetch_vision.php")
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "success") {
                            visionText.value = data.vision;
                        } else {
                            console.error("Error:", data.message);
                            alert("Error fetching vision: " + data.message);
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching vision:", error);
                        alert("Failed to load vision. Check your connection.");
                    });
            });

            // Handle form submission for updating vision
            visionForm.addEventListener("submit", function (e) {
                e.preventDefault();
                const formData = new FormData(visionForm);

                fetch("databases/edit_vision.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    if (data.status === "success") {
                        // Close the modal after successful update
                        const modalInstance = bootstrap.Modal.getOrCreateInstance(visionModal);
                        modalInstance.hide();

                        // Refresh the admin-homepage-editor.php page
                        setTimeout(() => {
                            window.location.href = "admin-homepage-editor.php";
                        }, 500);
                    }
                })
                .catch(error => {
                    console.error("Error updating vision:", error);
                    alert("Failed to update vision.");
                });
            });
        });
    </script>

    <!-- Script to handle gallery image upload and edit -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetchGalleryImages();

            document.getElementById("galleryForm").addEventListener("submit", function (e) {
                e.preventDefault();
                updateGalleryImages();
            });
        });

        function fetchGalleryImages() {
            fetch("databases/fetch_gallery.php")
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById("galleryImagesContainer");
                    container.innerHTML = "";
                    
                    if (data.status === "success" && data.images.length > 0) {
                        data.images.forEach(image => {
                            container.innerHTML += `<img src="${image}" class="img-thumbnail m-2" width="150">`;
                        });
                    } else {
                        container.innerHTML = "<p>No images found.</p>";
                    }
                })
                .catch(error => console.error("Error fetching images:", error));
        }

        function updateGalleryImages() {
            let formData = new FormData(document.getElementById("galleryForm"));

            fetch("databases/edit_gallery.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                fetchGalleryImages(); // Refresh images after upload

                // Clear the file input fields after submission
                document.querySelectorAll("#galleryForm input[type='file']").forEach(input => {
                    input.value = "";
                });

                // Refresh the admin-homepage-editor.php page
                setTimeout(() => {
                    window.location.href = "admin-homepage-editor.php";
                }, 500);
            })
            .catch(error => console.error("Error updating gallery:", error));
        }
    </script>

    <!-- Script to handle enrollment information editing -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const enrollmentInfoModal = document.getElementById("editEnrollmentInfoModal");
            const enrollmentInfoText = document.getElementById("enrollmentInfoText");
            const enrollmentInfoForm = document.getElementById("enrollmentInfoForm");

            // Fetch and display current enrollment information when the modal opens
            enrollmentInfoModal.addEventListener("show.bs.modal", function () {
                fetch("databases/fetch_enrollment_info.php")
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "success") {
                            enrollmentInfoText.value = data.info;
                        } else {
                            console.error("Error:", data.message);
                            alert("Error fetching enrollment information: " + data.message);
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching enrollment information:", error);
                        alert("Failed to load enrollment information. Check your connection.");
                    });
            });

            // Handle form submission for updating enrollment information
            enrollmentInfoForm.addEventListener("submit", function (e) {
                e.preventDefault();
                const formData = new FormData(enrollmentInfoForm);

                fetch("databases/edit_enrollment_info.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    if (data.status === "success") {
                        // Close the modal after successful update
                        const modalInstance = bootstrap.Modal.getOrCreateInstance(enrollmentInfoModal);
                        modalInstance.hide();

                        // Refresh the admin-homepage-editor.php page
                        setTimeout(() => {
                            window.location.href = "admin-homepage-editor.php";
                        }, 500);
                    }
                })
                .catch(error => {
                    console.error("Error updating enrollment information:", error);
                    alert("Failed to update enrollment information.");
                });
            });
        });
    </script>
    
    <!-- Script to handle transferee/new students information editing -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const transfereeModal = document.getElementById("editTransfereeModal");
            const transfereeText = document.getElementById("transfereeText");
            const transfereeForm = document.getElementById("transfereeForm");

            // Fetch and display current information when the modal opens
            transfereeModal.addEventListener("show.bs.modal", function () {
                fetch("databases/fetch_transferee_req_info.php")
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "success") {
                            transfereeText.value = data.info;
                        } else {
                            console.error("Error:", data.message);
                            alert("Error fetching information: " + data.message);
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching information:", error);
                        alert("Failed to load information. Check your connection.");
                    });
            });

            // Handle form submission for updating information
            transfereeForm.addEventListener("submit", function (e) {
                e.preventDefault();
                const formData = new FormData(transfereeForm);

                fetch("databases/edit_transferee_req_info.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    if (data.status === "success") {
                        // Close the modal after successful update
                        const modalInstance = bootstrap.Modal.getOrCreateInstance(transfereeModal);
                        modalInstance.hide();

                        // Refresh the admin-homepage-editor.php page
                        setTimeout(() => {
                            window.location.href = "admin-homepage-editor.php";
                        }, 500);
                    }
                })
                .catch(error => {
                    console.error("Error updating information:", error);
                    alert("Failed to update information.");
                });
            });
        });
    </script>
</body>
</html>
