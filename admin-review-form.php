<?php
session_start();

// Redirect to login if the user is not authenticated
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include "databases/db_connection.php"; // Include database connection

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["student_id"])) {
    $student_id = $_POST["student_id"];

    $query = "SELECT 
            s.student_id,
            s.last_name,
            s.first_name,
            s.middle_name,
            s.suffix,
            r.regDesc AS region_name,
            p.provDesc AS province_name,
            c.citymunDesc AS municipality_name,
            b.brgyDesc AS barangay_name,
            s.street_address,
            s.zip_code,
            s.date_of_birth,
            s.place_of_birth,
            s.gender,
            n.nationality_name,
            rel.religion_name,
            g.grade_name AS previous_grade_level,
            s.email,
            s.contact,
            s.school_last_attended,
            s.school_address,
            s.father_name,
            s.father_occupation,
            s.father_contact_number,
            s.mother_name,
            s.mother_occupation,
            s.mother_contact_number,
            s.guardian_name,
            s.guardian_relationship,
            s.guardian_contact_number,
            sy.school_year AS school_year,  
            s.type_of_student,
            ga.grade_name AS grade_applying_for,
            s.academic_track,
            s.academic_semester,
            s.appointment_date,
            s.appointment_time,
            s.birth_certificate,
            s.report_card,
            s.id_picture,
            s.enrollment_status,
            s.created_at
        FROM students s
        JOIN refregion r ON s.region_id = r.id
        JOIN refprovince p ON s.province_id = p.id
        JOIN refcitymun c ON s.municipality_id = c.id
        JOIN refbrgy b ON s.barangay_id = b.id
        JOIN nationalities n ON s.nationality_id = n.nationality_id
        JOIN religions rel ON s.religion_id = rel.religion_id
        JOIN grade_levels g ON s.prev_grade_lvl = g.grade_level_id  -- Joining for previous grade level
        JOIN grade_levels ga ON s.grade_applying_for = ga.grade_level_id  -- Joining again for applying grade
        JOIN school_year sy ON s.school_year_id = sy.school_year_id
        WHERE s.student_id = ?";
        
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
    } else {
        die("Student not found.");
    }
    $stmt->close();
} else {
    die("Access denied.");
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
    <title>Admin View - School Enrollment Form</title>
    <link rel="icon" type="image/png" href="images/logo/st-johns-logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #3498db;
            --primary-dark-blue: #003366;
            --bg-light-gray: #f4f6f9;
            --sidebar-bg: #f8f9fa;
            --sidebar-active-bg: #e9ecef;
            --sidebar-hover-bg: #e0e4e9;
            --decline-red: #dc3545;
            --approve-blue: #0d6efd;
        }
        
        body {
            background-color: var(--bg-light-gray);
            font-family: 'Arial', sans-serif;
        }
        
        .logo-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .navbar {
            background-color: var(--primary-blue);
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }
        
        .navbar-brand {
            display: flex;
            align-items: center;
            color: white !important;
            font-weight: bold;
            letter-spacing: 0.5px;
        }
        
        .navbar-brand img {
            margin-right: 12px;
            border: 2px solid white;
        }
        
        .sidebar {
            background-color: var(--sidebar-bg);
            min-height: calc(100vh - 56px);
            border-right: 1px solid #dee2e6;
            box-shadow: 2px 0 5px rgba(0,0,0,0.05);
            padding-top: 1.5rem;
        }
        
        .sidebar .nav-link {
            color: #333;
            border-radius: 6px;
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            transition: all 0.2s ease;
        }
        
        .sidebar .nav-link.active {
            background-color: var(--sidebar-active-bg);
            font-weight: bold;
            color: var(--primary-blue);
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .sidebar .nav-link:hover {
            background-color: var(--sidebar-hover-bg);
            transform: translateX(5px);
        }
        
        .sidebar .nav-link i {
            width: 24px;
            text-align: center;
            margin-right: 8px;
        }
        
        .admin-card {
            max-width: 95%;
            margin: 25px auto;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            border: none;
            overflow: hidden;
        }
        
        .card-header {
            background-color: var(--primary-dark-blue);
            color: white;
            padding: 15px 20px;
            border-bottom: none;
        }
        
        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .school-logo {
            width: 60px;
            height: 60px;
            border: 3px solid white;
            border-radius: 50%;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
        }
        
        .card-body {
            padding: 25px;
        }
        
        .form-section {
            margin-bottom: 30px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }
        
        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary-dark-blue);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #eaeaea;
        }
        
        .form-group {
            margin-bottom: 18px;
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 6px;
            font-size: 14px;
            color: #555;
        }
        
        .form-control-static {
            background-color: #f8f9fa;
            padding: 10px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            min-height: 42px;
            font-size: 14px;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
        }
        
        .btn-view {
            background-color: var(--primary-dark-blue);
            color: white;
            width: 100px;
            border-radius: 6px;
            transition: all 0.3s;
            border: none;
            padding: 8px 12px;
            font-weight: 500;
        }
        
        .btn-view:hover {
            background-color: #00264d;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 30px;
            padding: 15px 0;
        }
        
        .btn-decline {
            background-color: var(--decline-red);
            color: white;
            border: none;
            width: 140px;
            padding: 10px;
            border-radius: 6px;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        
        .btn-decline:hover {
            background-color: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(220, 53, 69, 0.3);
        }
        
        .btn-approve {
            background-color: var(--approve-blue);
            color: white;
            border: none;
            width: 140px;
            padding: 10px;
            border-radius: 6px;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        
        .btn-approve:hover {
            background-color: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(13, 110, 253, 0.3);
        }
        
        .modal-content {
            border-radius: 10px;
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .modal-header {
            background-color: var(--primary-dark-blue);
            color: white;
            border-radius: 10px 10px 0 0;
            border-bottom: none;
        }
        
        .modal-footer {
            border-top: 1px solid #eaeaea;
            padding: 15px 20px;
        }
        
        @media (max-width: 768px) {
            .admin-card {
                max-width: 100%;
                margin: 15px 0;
            }
            
            .action-buttons {
                flex-direction: column;
                align-items: center;
                gap: 15px;
            }
            
            .btn-decline, .btn-approve {
                width: 100%;
                max-width: 200px;
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
            
            // Initialize Bootstrap tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
    <!-- Fetch the logo from the database and display it in the navbar and form -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetch("databases/fetch_logo.php")
                .then(response => response.json())
                .then(data => {
                    let navLogo = document.getElementById("navLogo");
                    let formLogo = document.getElementById("formLogo");

                    if (data.status === "success" && data.image) {
                        navLogo.src = data.image; // Load logo from database
                        formLogo.src = data.image; // Load logo from database
                    } else {
                        console.error("Error:", data.message);
                        navLogo.src = "assets/homepage_images/logo/placeholder.png"; // Default placeholder
                        formLogo.src = "assets/homepage_images/logo/placeholder.png"; // Default placeholder
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
                <img id="navLogo" src="assets/homepage_images/logo/placeholder.png" alt="School Logo" class="logo-image me-2">
                <a class="navbar-brand" href="admin-dashboard.php" id="adminWelcomeMessage">WELCOME! Admin</a>
            </div>
            <div class="ms-auto">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="admin-dashboard.php" data-bs-toggle="tooltip" title="Go to Dashboard">
                            <i class="fas fa-home me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php" data-bs-toggle="tooltip" title="Sign Out">
                            <i class="fas fa-sign-out-alt me-2"></i>Log Out
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block sidebar">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="admin-dashboard.php">
                            <i class="fas fa-tachometer-alt"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="admin-application-for-review.php">
                            <i class="fas fa-file-alt"></i>Applications for Review
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-approved-application.php">
                            <i class="fas fa-check-circle"></i>Approved Applications
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-money-check-alt"></i>Payment Transactions
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-all-enrollees.php">
                            <i class="fas fa-users"></i>All Enrollees
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-homepage-editor.php">
                            <i class="fas fa-edit"></i>Home Page Editor
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-user-cog"></i>Users
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Main Content Area -->
            <div class="col-md-9 col-lg-10 ms-sm-auto px-md-4">
                <div class="admin-card card">
                    <div class="card-header header-container">
                        <h4 class="mb-0 text-white">St. John the Baptist Parochial School Admission Form</h4>
                        <img id="formLogo" src="assets/homepage_images/logo/placeholder.png" alt="School Logo" class="school-logo">
                        
                    </div>
                    <div class="card-body">
                        <!-- General Information Section -->
                        <div class="form-section">
                            <h5 class="section-title"><i class="fas fa-user me-2"></i>General Information</h5>
                            <div class="row">
                                <div class="col-md-5 pt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                            <div class="form-control-static" id="displayLastName"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Middle Name <span class="text-danger">*</span></label>
                                            <div class="form-control-static" id="displayMiddleName">no data</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 pt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">First Name <span class="text-danger">*</span></label>
                                            <div class="form-control-static" id="displayFirstName"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Suffix</label>
                                            <div class="form-control-static" id="displaySuffix">no data</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">ID Picture <span class="text-danger">*</span></label>
                                            <img id="displayIdPicture" src="<?= htmlspecialchars($student['id_picture']) ?>" alt="ID Picture" style="width: 100%; height: auto; border: 1px solid #ccc; border-radius: 6px; object-fit: cover;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">House Number, Street, Subdivision <span class="text-danger">*</span></label>
                                        <div class="form-control-static" id="displayStreetAddress">no data</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Barangay <span class="text-danger">*</span></label>
                                        <div class="form-control-static" id="displayBarangay">no data</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Municipality <span class="text-danger">*</span></label>
                                        <div class="form-control-static" id="displayMunicipality">no data</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Province <span class="text-danger">*</span></label>
                                        <div class="form-control-static" id="displayProvince">no data</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="form-label">Region <span class="text-danger">*</span></label>
                                        <div class="form-control-static" id="displayRegion">no data</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">ZIP Code <span class="text-danger">*</span></label>
                                        <div class="form-control-static" id="displayZipCode">no data</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                        <div class="form-control-static" id="displayDateOfBirth">no data</div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="form-label">Place of Birth <span class="text-danger">*</span></label>
                                        <div class="form-control-static" id="displayPlaceOfBirth">no data</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Gender <span class="text-danger">*</span></label>
                                        <div class="form-control-static" id="displayGender">no data</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Nationality <span class="text-danger">*</span></label>
                                        <div class="form-control-static" id="displayNationality">no data</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Religion <span class="text-danger">*</span></label>
                                        <div class="form-control-static" id="displayReligion">no data</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Previous Grade Level <span class="text-danger">*</span></label>
                                        <div class="form-control-static" id="displayGradeLevel">no data</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Email <span class="text-danger">*</span></label>
                                        <div class="form-control-static" id="displayEmail">no data</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Contact Number <span class="text-danger">*</span></label>
                                        <div class="form-control-static" id="displayContactNumber">no data</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">School Last Attended <span class="text-danger">*</span></label>
                                        <div class="form-control-static" id="displaySchoolLastAttended">no data</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Family Background Section -->
                        <div class="form-section">
                            <h5 class="section-title"><i class="fas fa-users me-2"></i>Family Background</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Father's Full Name <span class="text-danger">*</span></label>
                                        <div class="form-control-static" id="displayFatherFullName">no data</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Father's Occupation</label>
                                        <div class="form-control-static" id="displayFatherOccupation">no data</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Father's Contact Number <span class="text-danger">*</span></label>
                                        <div class="form-control-static" id="displayFatherContactNumber">no data</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Mother's Full Name <span class="text-danger">*</span></label>
                                        <div class="form-control-static" id="displayMotherFullName">no data</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Mother's Occupation</label>
                                        <div class="form-control-static" id="displayMotherOccupation">no data</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Mother's Contact Number <span class="text-danger">*</span></label>
                                        <div class="form-control-static" id="displayMotherContactNumber">no data</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Guardian's Full Name <span class="text-danger">*</span></label>
                                        <div class="form-control-static" id="displayGuardianFullName">no data</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Relationship to Student <span class="text-danger">*</span></label>
                                        <div class="form-control-static" id="displayRelationshipToStudent">no data</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Guardian's Contact Number <span class="text-danger">*</span></label>
                                        <div class="form-control-static" id="displayGuardianContactNumber">no data</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Requirements Section -->
                        <div class="form-section">
                            <h5 class="section-title"><i class="fas fa-clipboard-list me-2"></i>Requirements</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">School Year <span class="text-danger">*</span></label>
                                        <div class="form-control-static" id="displaySchoolYear">no data</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Type of Student <span class="text-danger">*</span></label>
                                        <div class="form-control-static" id="displayStudentType">no data</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Applying For <span class="text-danger">*</span></label>
                                        <div class="form-control-static" id="displayApplyingFor">no data</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="form-label">Select Appointment for Onsite Interview <span class="text-danger">*</span></label>
                                <div class="ps-4 row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Select Date <span class="text-danger">*</span></label>
                                            <div class="form-control-static" id="displayAppointmentDate">no data</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Select Time <span class="text-danger">*</span></label>
                                            <div class="form-control-static" id="displayAppointmentTime">no data</div>
                                        </div>
                                    </div>
                                </div>                                    
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label class="form-label">Select Academic Track <span class="text-danger">*</span></label>
                                        <div class="form-control-static" id="displayAcademicTrack">no data</div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-label">Select Academic Semester <span class="text-danger">*</span></label>
                                        <div class="form-control-static" id="displayAcademicSemester">no data</div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Document Thumbnails -->
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Birth Certificate <span class="text-danger">*</span></label>
                                        <img src="path/to/birth_certificate_thumbnail.jpg" alt="Birth Certificate" class="img-thumbnail preview-thumbnail" 
                                            data-bs-toggle="modal" data-bs-target="#birthCertModal" 
                                            data-pdf="<?= htmlspecialchars($student['birth_certificate']) ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Report Card <span class="text-danger">*</span></label>
                                        <img src="path/to/report_card_thumbnail.jpg" alt="Report Card" class="img-thumbnail preview-thumbnail" 
                                            data-bs-toggle="modal" data-bs-target="#reportCardModal" 
                                            data-pdf="<?= htmlspecialchars($student['report_card']) ?>">
                                    </div>
                                </div>
                            </div>

                            <!-- Birth Certificate Modal -->
                            <div class="modal fade" id="birthCertModal" tabindex="-1" aria-labelledby="birthCertModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="birthCertModalLabel">Birth Certificate</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <iframe id="birthCertViewer" src="" width="100%" height="500px" style="border: none;"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Report Card Modal -->
                            <div class="modal fade" id="reportCardModal" tabindex="-1" aria-labelledby="reportCardModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="reportCardModalLabel">Report Card</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <iframe id="reportCardViewer" src="" width="100%" height="500px" style="border: none;"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- JavaScript to Load Documents Dynamically -->
                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    document.querySelectorAll('.preview-thumbnail').forEach(img => {
                                        img.addEventListener('click', function () {
                                            let pdfUrl = this.getAttribute('data-pdf');
                                            let targetModal = this.getAttribute('data-bs-target');
                                            
                                            if (targetModal === '#birthCertModal') {
                                                document.getElementById('birthCertViewer').src = pdfUrl;
                                            } else if (targetModal === '#reportCardModal') {
                                                document.getElementById('reportCardViewer').src = pdfUrl;
                                            }
                                        });
                                    });
                                });
                            </script>

                        
                            <!-- Action Buttons -->
                        <div class="p-5">
                            <div class="action-buttons">
                                <button type="button" class="btn btn-decline" id="declineBtn" data-bs-toggle="modal" data-bs-target="#declineModal">
                                    <i class="fas fa-times-circle me-1"></i> Decline
                                </button>
                                <button type="button" class="btn btn-approve" id="approveBtn" data-bs-toggle="modal" data-bs-target="#confirmModal">
                                    <i class="fas fa-check-circle me-1"></i> Approve
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Decline Reason Modal -->
    <div class="modal fade" id="declineModal" tabindex="-1" aria-labelledby="declineModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="declineModalLabel">Reason for Declining</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="declineForm">
                        <div class="mb-3">
                            <label for="declineReason" class="form-label">Please provide a reason for declining this application:</label>
                            <textarea class="form-control" id="declineReason" rows="4" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeclineBtn">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("confirmDeclineBtn").addEventListener("click", function () {
            let declineReason = document.getElementById("declineReason").value;

            if (declineReason.trim() === "") {
                alert("Please provide a reason for declining.");
                return;
            }

            let applicationId = <?= json_encode($student['student_id']); ?>;

            // Send the data using AJAX
            fetch("process_decline.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: `applicationId=${applicationId}&reason=${encodeURIComponent(declineReason)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Application declined successfully.");
                    // Optionally, reload page or update UI
                    location.reload();
                } else {
                    alert("Error: " + data.message);
                }
            })
            .catch(error => console.error("Error:", error));
        });

    </script>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="confirmModalBody">
                    Are you sure you want to approve this application?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="finalConfirmBtn">Confirm</button>
                </div>
            </div>
        </div>
    </div>

<!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    
    <!-- Script for displaying the data in the form -->
    <script>
        document.getElementById("displayLastName").textContent = "<?= htmlspecialchars($student['last_name']) ?>";
        document.getElementById("displayFirstName").textContent = "<?= htmlspecialchars($student['first_name']) ?>";
        document.getElementById("displayMiddleName").textContent = "<?= htmlspecialchars($student['middle_name']) ?>";
        document.getElementById("displaySuffix").textContent = "<?= htmlspecialchars($student['suffix']) ?>";
        document.getElementById("displayRegion").textContent = "<?= htmlspecialchars($student['region_name']) ?>";
        document.getElementById("displayProvince").textContent = "<?= htmlspecialchars($student['province_name']) ?>";
        document.getElementById("displayMunicipality").textContent = "<?= htmlspecialchars($student['municipality_name']) ?>";
        document.getElementById("displayBarangay").textContent = "<?= htmlspecialchars($student['barangay_name']) ?>";
        document.getElementById("displayStreetAddress").textContent = "<?= htmlspecialchars($student['street_address']) ?>";
        document.getElementById("displayZipCode").textContent = "<?= htmlspecialchars($student['zip_code']) ?>";
        document.getElementById("displayDateOfBirth").textContent = "<?= htmlspecialchars($student['date_of_birth']) ?>";
        document.getElementById("displayPlaceOfBirth").textContent = "<?= htmlspecialchars($student['place_of_birth']) ?>";
        document.getElementById("displayGender").textContent = "<?= htmlspecialchars($student['gender']) ?>";
        document.getElementById("displayNationality").textContent = "<?= htmlspecialchars($student['nationality_name']) ?>";
        document.getElementById("displayReligion").textContent = "<?= htmlspecialchars($student['religion_name']) ?>";
        document.getElementById("displayGradeLevel").textContent = "<?= htmlspecialchars($student['previous_grade_level']) ?>";
        document.getElementById("displayEmail").textContent = "<?= htmlspecialchars($student['email']) ?>";
        document.getElementById("displayContactNumber").textContent = "<?= htmlspecialchars($student['contact']) ?>";
        document.getElementById("displaySchoolLastAttended").textContent = "<?= htmlspecialchars($student['school_last_attended']) ?>";
        document.getElementById("displayFatherFullName").textContent = "<?= htmlspecialchars($student['father_name']) ?>";
        document.getElementById("displayFatherOccupation").textContent = "<?= htmlspecialchars($student['father_occupation']) ?>";
        document.getElementById("displayFatherContactNumber").textContent = "<?= htmlspecialchars($student['father_contact_number']) ?>";
        document.getElementById("displayMotherFullName").textContent = "<?= htmlspecialchars($student['mother_name']) ?>";
        document.getElementById("displayMotherOccupation").textContent = "<?= htmlspecialchars($student['mother_occupation']) ?>";
        document.getElementById("displayMotherContactNumber").textContent = "<?= htmlspecialchars($student['mother_contact_number']) ?>";
        document.getElementById("displayGuardianFullName").textContent = "<?= htmlspecialchars($student['guardian_name']) ?>";
        document.getElementById("displayRelationshipToStudent").textContent = "<?= htmlspecialchars($student['guardian_relationship']) ?>";
        document.getElementById("displayGuardianContactNumber").textContent = "<?= htmlspecialchars($student['guardian_contact_number']) ?>";
        document.getElementById("displaySchoolYear").textContent = "<?= htmlspecialchars($student['school_year']) ?>";
        document.getElementById("displayStudentType").textContent = "<?= htmlspecialchars($student['type_of_student']) ?>";
        document.getElementById("displayApplyingFor").textContent = "<?= htmlspecialchars($student['grade_applying_for']) ?>";
        document.getElementById("displayAcademicTrack").textContent = "<?= htmlspecialchars($student['academic_track']) ?>";
        document.getElementById("displayAcademicSemester").textContent = "<?= htmlspecialchars($student['academic_semester']) ?>";
        document.getElementById("displayAppointmentDate").textContent = "<?= htmlspecialchars($student['appointment_date']) ?>";
        document.getElementById("displayAppointmentTime").textContent = "<?= htmlspecialchars($student['appointment_time']) ?>";

    </script>

    <!-- JavaScript for Approve Actions -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("finalConfirmBtn").addEventListener("click", function () {
                let studentId = <?= json_encode($student['student_id']); ?>;
                let email = <?= json_encode($student['email']); ?>;
                let surname = <?= json_encode($student['last_name']); ?>;
                let gender = <?= json_encode($student['gender']); ?>;

                // Step 1: Update Enrollment Status
                fetch("databases/approve_application.php", {
                    method: "POST",
                    body: JSON.stringify({ student_id: studentId }),
                    headers: { "Content-Type": "application/json" },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("Enrollment approved! Status changed to 'For Payment'.");
                        alert("Enrollment approved! Status changed to 'For Payment'.");

                        // Step 2: Send Email Notification
                        return fetch("databases/approve_application_email.php", {
                            method: "POST",
                            body: JSON.stringify({
                                email: email,
                                surname: surname,
                                gender: gender
                            }),
                            headers: { "Content-Type": "application/json" },
                        });
                    } else {
                        throw new Error("Error: " + data.message);
                    }
                })
                .then(response => response.json())
                .then(emailData => {
                    if (emailData.success) {
                        console.log("Confirmation email sent successfully!");
                        alert("Enrollment approved and email sent successfully!");

                        setTimeout(function() {
                            window.location.href = "admin-application-for-review.php"; // Redirect to approved applications page
                        }, 500); // Add a 500ms delay before redirecting

                    } else {
                        console.log("Failed to send email: " + emailData.message);
                    }
                })
                .catch(error => console.error("Error:", error));
            });
        });
    </script>
</body>
</html>