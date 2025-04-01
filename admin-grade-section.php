<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SJBPS Admin - Grade, Sections and Subjects</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #3498db;
            --sidebar-bg: #f8f9fa;
            --sidebar-active-bg: #f0f0f0;
            --sidebar-hover-bg: #e9ecef;
            --section-color: #4e73df;
            --subject-color: #1cc88a;
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
            border-left: 4px solid var(--primary-blue);
        }
        .grade-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .section-card {
            border-left: 4px solid var(--section-color);
            transition: all 0.3s ease;
        }
        .section-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        .subject-card {
            border-left: 4px solid var(--subject-color);
            transition: all 0.3s ease;
        }
        .subject-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
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
        .grade-detail {
            display: none;
        }
        .grade-detail.active {
            display: block;
        }
        .badge-section {
            background-color: var(--section-color);
            color: white;
        }
        .badge-subject {
            background-color: var(--subject-color);
            color: white;
        }
        .action-buttons {
            display: flex;
            gap: 5px;
        }
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }
        .add-button {
            position: relative;
            margin-left: auto;
        }
        .back-button {
            margin-right: 10px;
        }
        .grade-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .sections-container, .subjects-container {
            margin-top: 20px;
        }
        .tab-buttons {
            margin-bottom: 20px;
        }
        .tab-btn {
            padding: 10px 20px;
            border: none;
            background-color: #f0f0f0;
            border-radius: 5px 5px 0 0;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .tab-btn.active {
            background-color: #3498db;
            color: white;
        }
        .section-header, .subject-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        .tab-content {
            display: none;
            animation: fadeIn 0.5s;
        }
        .tab-content.active {
            display: block;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
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
                        <a class="nav-link active" href="admin-grade-section.php">
                            <i class="fas fa-users me-2"></i>Grade-Section
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
                <div id="grade-list-container">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">Grade and Sections</h4>
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <label for="schoolYearSelect" class="form-label mb-0 me-2">School Year:</label>
                                <select id="schoolYearSelect" class="form-select school-year-select">
                                    <option value="2024-2025">2024-2025</option>
                                    <option value="2023-2024">2023-2024</option>
                                    <option value="2022-2023">2022-2023</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Warning message -->
                    <div class="warning-alert mb-4">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>Warning: Undefined school year</span>
                    </div>

                    <!-- Grade Cards -->
                    <div class="row">
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card grade-card text-center" data-grade="Kinder">
                                <div class="card-body py-4">
                                    <h5 class="card-title">Kinder</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card grade-card text-center" data-grade="Preschool">
                                <div class="card-body py-4">
                                    <h5 class="card-title">Preschool</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card grade-card text-center" data-grade="Grade 1">
                                <div class="card-body py-4">
                                    <h5 class="card-title">Grade 1</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card grade-card text-center" data-grade="Grade 2">
                                <div class="card-body py-4">
                                    <h5 class="card-title">Grade 2</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card grade-card text-center" data-grade="Grade 3">
                                <div class="card-body py-4">
                                    <h5 class="card-title">Grade 3</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card grade-card text-center" data-grade="Grade 4">
                                <div class="card-body py-4">
                                    <h5 class="card-title">Grade 4</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card grade-card text-center" data-grade="Grade 5">
                                <div class="card-body py-4">
                                    <h5 class="card-title">Grade 5</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card grade-card text-center" data-grade="Grade 6">
                                <div class="card-body py-4">
                                    <h5 class="card-title">Grade 6</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card grade-card text-center" data-grade="Grade 7">
                                <div class="card-body py-4">
                                    <h5 class="card-title">Grade 7</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card grade-card text-center" data-grade="Grade 8">
                                <div class="card-body py-4">
                                    <h5 class="card-title">Grade 8</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card grade-card text-center" data-grade="Grade 9">
                                <div class="card-body py-4">
                                    <h5 class="card-title">Grade 9</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card grade-card text-center" data-grade="Grade 10">
                                <div class="card-body py-4">
                                    <h5 class="card-title">Grade 10</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card grade-card text-center" data-grade="Grade 11">
                                <div class="card-body py-4">
                                    <h5 class="card-title">Grade 11</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card grade-card text-center" data-grade="Grade 12">
                                <div class="card-body py-4">
                                    <h5 class="card-title">Grade 12</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grade Detail View (Initially Hidden) -->
                <div id="grade-detail-container" class="grade-detail">
                    <div class="grade-header">
                        <button class="btn btn-outline-secondary back-button">
                            <i class="fas fa-arrow-left"></i> Back to Grades
                        </button>
                        <h4 id="selected-grade-title" class="mb-0 ms-2">Grade Detail</h4>
                    </div>

                    <div class="tab-buttons">
                        <button class="tab-btn active" data-tab="sections">Sections</button>
                        <button class="tab-btn" data-tab="subjects">Subjects</button>
                    </div>

                    <!-- Sections Tab -->
                    <div id="sections-tab" class="tab-content active">
                        <div class="section-header">
                            <h5>Sections</h5>
                            <button class="btn btn-primary btn-sm" id="add-section-btn">
                                <i class="fas fa-plus"></i> Add Section
                            </button>
                        </div>
                        <div class="row" id="sections-list">
                            <!-- Section cards will be dynamically inserted here -->
                        </div>
                    </div>

                    <!-- Subjects Tab -->
                    <div id="subjects-tab" class="tab-content">
                        <div class="subject-header">
                            <h5>Subjects</h5>
                            <button class="btn btn-primary btn-sm" id="add-subject-btn">
                                <i class="fas fa-plus"></i> Add Subject
                            </button>
                        </div>
                        <div class="row" id="subjects-list">
                            <!-- Subject cards will be dynamically inserted here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Section Modal -->
    <div class="modal fade" id="addSectionModal" tabindex="-1" aria-labelledby="addSectionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSectionModalLabel">Add Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addSectionForm">
                        <div class="mb-3">
                            <label for="sectionName" class="form-label">Section Name</label>
                            <input type="text" class="form-control" id="sectionName" required>
                        </div>
                        <div class="mb-3">
                            <label for="sectionAdvisor" class="form-label">Section Advisor</label>
                            <input type="text" class="form-control" id="sectionAdvisor" required>
                        </div>
                        <div class="mb-3">
                            <label for="sectionRoom" class="form-label">Room Number</label>
                            <input type="text" class="form-control" id="sectionRoom">
                        </div>
                        <div class="mb-3">
                            <label for="sectionCapacity" class="form-label">Maximum Capacity</label>
                            <input type="number" class="form-control" id="sectionCapacity" min="1" value="40">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveSectionBtn">Save Section</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Subject Modal -->
    <div class="modal fade" id="addSubjectModal" tabindex="-1" aria-labelledby="addSubjectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSubjectModalLabel">Add Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addSubjectForm">
                        <div class="mb-3">
                            <label for="subjectCode" class="form-label">Subject Code</label>
                            <input type="text" class="form-control" id="subjectCode" required>
                        </div>
                        <div class="mb-3">
                            <label for="subjectName" class="form-label">Subject Name</label>
                            <input type="text" class="form-control" id="subjectName" required>
                        </div>
                        <div class="mb-3">
                            <label for="subjectDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="subjectDescription" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="subjectUnits" class="form-label">Units</label>
                            <input type="number" class="form-control" id="subjectUnits" min="1" value="1">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveSubjectBtn">Save Subject</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sample data for sections and subjects
        const sampleData = {
            sections: {
                "Kinder": [
                    { name: "Love", advisor: "Ms. Maria Santos", room: "K-1", capacity: 30, current: 28 },
                    { name: "Hope", advisor: "Ms. Anna Reyes", room: "K-2", capacity: 30, current: 25 }
                ],
                "Grade 1": [
                    { name: "Charity", advisor: "Mr. John Doe", room: "101", capacity: 40, current: 38 },
                    { name: "Faith", advisor: "Ms. Jane Smith", room: "102", capacity: 40, current: 35 },
                    { name: "Joy", advisor: "Mr. Robert Cruz", room: "103", capacity: 40, current: 32 }
                ],
                "Grade 2": [
                    { name: "Humility", advisor: "Ms. Patricia Tan", room: "201", capacity: 40, current: 36 },
                    { name: "Patience", advisor: "Mr. Michael Garcia", room: "202", capacity: 40, current: 34 }
                ],
                "Grade 3": [
                    { name: "Wisdom", advisor: "Ms. Elizabeth Lim", room: "301", capacity: 45, current: 40 },
                    { name: "Kindness", advisor: "Mr. David Santos", room: "302", capacity: 45, current: 38 }
                ],
                "Grade 4": [
                    { name: "Diligence", advisor: "Ms. Mary Johnson", room: "401", capacity: 45, current: 42 },
                    { name: "Integrity", advisor: "Mr. James Lee", room: "402", capacity: 45, current: 40 }
                ],
                "Grade 5": [
                    { name: "Courage", advisor: "Ms. Susan Wu", room: "501", capacity: 45, current: 43 },
                    { name: "Honor", advisor: "Mr. Peter Kim", room: "502", capacity: 45, current: 41 }
                ],
                "Grade 6": [
                    { name: "Loyalty", advisor: "Ms. Rebecca Santos", room: "601", capacity: 50, current: 48 },
                    { name: "Truth", advisor: "Mr. Joseph Reyes", room: "602", capacity: 50, current: 46 }
                ],
                "Grade 7": [
                    { name: "Diamond", advisor: "Ms. Jennifer Cruz", room: "701", capacity: 50, current: 47 },
                    { name: "Ruby", advisor: "Mr. Christopher Lim", room: "702", capacity: 50, current: 45 }
                ],
                "Grade 8": [
                    { name: "Emerald", advisor: "Ms. Sarah Park", room: "801", capacity: 50, current: 47 },
                    { name: "Sapphire", advisor: "Mr. Daniel Garcia", room: "802", capacity: 50, current: 44 }
                ],
                "Grade 9": [
                    { name: "Einstein", advisor: "Ms. Michelle Tan", room: "901", capacity: 55, current: 52 },
                    { name: "Newton", advisor: "Mr. Andrew Santos", room: "902", capacity: 55, current: 50 }
                ],
                "Grade 10": [
                    { name: "Tesla", advisor: "Ms. Rachel Kim", room: "1001", capacity: 55, current: 53 },
                    { name: "Edison", advisor: "Mr. Matthew Cruz", room: "1002", capacity: 55, current: 51 }
                ],
                "Grade 11": [
                    { name: "HUMSS", advisor: "Ms. Amanda Reyes", room: "1101", capacity: 60, current: 55 },
                    { name: "STEM", advisor: "Mr. Jason Park", room: "1102", capacity: 60, current: 58 },
                    { name: "ABM", advisor: "Ms. Sophia Lim", room: "1103", capacity: 60, current: 54 }
                ],
                "Grade 12": [
                    { name: "HUMSS", advisor: "Ms. Olivia Garcia", room: "1201", capacity: 60, current: 56 },
                    { name: "STEM", advisor: "Mr. William Tan", room: "1202", capacity: 60, current: 59 },
                    { name: "ABM", advisor: "Ms. Emily Santos", room: "1203", capacity: 60, current: 52 }
                ],
                "Preschool": [
                    { name: "Stars", advisor: "Ms. Catherine Reyes", room: "P-1", capacity: 25, current: 22 },
                    { name: "Moons", advisor: "Mr. Kevin Cruz", room: "P-2", capacity: 25, current: 20 }
                ]
            },
            subjects: {
                "Kinder": [
                    { code: "K-ENG", name: "English", description: "Basic alphabet and reading", units: 1 },
                    { code: "K-MATH", name: "Mathematics", description: "Basic counting and shapes", units: 1 },
                    { code: "K-SCI", name: "Science", description: "Basic nature and environment", units: 1 }
                ],
                "Preschool": [
                    { code: "PS-LAN", name: "Language", description: "Introduction to language", units: 1 },
                    { code: "PS-NUM", name: "Numbers", description: "Introduction to numbers", units: 1 },
                    { code: "PS-ART", name: "Arts", description: "Art and creativity", units: 1 }
                ],
                "Grade 1": [
                    { code: "G1-ENG", name: "English", description: "Reading and writing skills", units: 2 },
                    { code: "G1-MATH", name: "Mathematics", description: "Basic arithmetic", units: 2 },
                    { code: "G1-SCI", name: "Science", description: "Basic science concepts", units: 2 },
                    { code: "G1-FIL", name: "Filipino", description: "Filipino language", units: 2 },
                    { code: "G1-AP", name: "Araling Panlipunan", description: "Basic social studies", units: 1 },
                    { code: "G1-MUS", name: "Music", description: "Basic music appreciation", units: 1 }
                ],
                "Grade 2": [
                    { code: "G2-ENG", name: "English", description: "Advanced reading and writing", units: 2 },
                    { code: "G2-MATH", name: "Mathematics", description: "Advanced arithmetic", units: 2 },
                    { code: "G2-SCI", name: "Science", description: "Science and technology", units: 2 },
                    { code: "G2-FIL", name: "Filipino", description: "Filipino literature", units: 2 },
                    { code: "G2-AP", name: "Araling Panlipunan", description: "Philippine history", units: 1 },
                    { code: "G2-MUS", name: "Music", description: "Music and arts", units: 1 }
                ],
                "Grade 3": [
                    { code: "G3-ENG", name: "English", description: "Grammar and composition", units: 2 },
                    { code: "G3-MATH", name: "Mathematics", description: "Multiplication and division", units: 2 },
                    { code: "G3-SCI", name: "Science", description: "Life and physical sciences", units: 2 },{ code: "G3-FIL", name: "Filipino", description: "Filipino grammar and literature", units: 2 },
                    { code: "G3-AP", name: "Araling Panlipunan", description: "Community and society", units: 1 },
                    { code: "G3-MUS", name: "Music", description: "Music, arts, and crafts", units: 1 },
                    { code: "G3-PE", name: "Physical Education", description: "Physical fitness and games", units: 1 }
                ],
                "Grade 4": [
                    { code: "G4-ENG", name: "English", description: "Advanced grammar and literature", units: 2 },
                    { code: "G4-MATH", name: "Mathematics", description: "Fractions and decimals", units: 2 },
                    { code: "G4-SCI", name: "Science", description: "Earth and life science", units: 2 },
                    { code: "G4-FIL", name: "Filipino", description: "Advanced Filipino literature", units: 2 },
                    { code: "G4-AP", name: "Araling Panlipunan", description: "Philippine regions", units: 1 },
                    { code: "G4-EPP", name: "Edukasyong Pantahanan at Pangkabuhayan", description: "Home economics", units: 1 },
                    { code: "G4-PE", name: "Physical Education", description: "Sports and wellness", units: 1 }
                ],
                "Grade 5": [
                    { code: "G5-ENG", name: "English", description: "Literature and composition", units: 2 },
                    { code: "G5-MATH", name: "Mathematics", description: "Algebra basics", units: 2 },
                    { code: "G5-SCI", name: "Science", description: "Scientific investigation", units: 2 },
                    { code: "G5-FIL", name: "Filipino", description: "Filipino rhetoric and composition", units: 2 },
                    { code: "G5-AP", name: "Araling Panlipunan", description: "Nations of the world", units: 1 },
                    { code: "G5-EPP", name: "Edukasyong Pantahanan at Pangkabuhayan", description: "Entrepreneurship", units: 1 },
                    { code: "G5-COMP", name: "Computer", description: "Basic computer skills", units: 1 },
                    { code: "G5-PE", name: "Physical Education", description: "Team sports", units: 1 }
                ],
                "Grade 6": [
                    { code: "G6-ENG", name: "English", description: "Oral communication and debate", units: 2 },
                    { code: "G6-MATH", name: "Mathematics", description: "Geometry and statistics", units: 2 },
                    { code: "G6-SCI", name: "Science", description: "Environmental science", units: 2 },
                    { code: "G6-FIL", name: "Filipino", description: "Advanced Filipino composition", units: 2 },
                    { code: "G6-AP", name: "Araling Panlipunan", description: "Government and economics", units: 1 },
                    { code: "G6-EPP", name: "Edukasyong Pantahanan at Pangkabuhayan", description: "Applied technology", units: 1 },
                    { code: "G6-COMP", name: "Computer", description: "Computer applications", units: 1 },
                    { code: "G6-PE", name: "Physical Education", description: "Advanced physical fitness", units: 1 }
                ],
                "Grade 7": [
                    { code: "G7-ENG", name: "English", description: "Philippine literature in English", units: 2 },
                    { code: "G7-MATH", name: "Mathematics", description: "Intermediate algebra", units: 2 },
                    { code: "G7-SCI", name: "Science", description: "Integrated science", units: 2 },
                    { code: "G7-FIL", name: "Filipino", description: "Filipino literature", units: 2 },
                    { code: "G7-AP", name: "Araling Panlipunan", description: "Asian studies", units: 1 },
                    { code: "G7-TLE", name: "Technology and Livelihood Education", description: "Technology skills", units: 1 },
                    { code: "G7-MAPEH", name: "Music, Arts, PE, and Health", description: "Integrated arts and health", units: 2 },
                    { code: "G7-VALUES", name: "Values Education", description: "Character development", units: 1 }
                ],
                "Grade 8": [
                    { code: "G8-ENG", name: "English", description: "Afro-Asian literature", units: 2 },
                    { code: "G8-MATH", name: "Mathematics", description: "Advanced algebra", units: 2 },
                    { code: "G8-SCI", name: "Science", description: "Biology", units: 2 },
                    { code: "G8-FIL", name: "Filipino", description: "Ibong Adarna", units: 2 },
                    { code: "G8-AP", name: "Araling Panlipunan", description: "World history", units: 1 },
                    { code: "G8-TLE", name: "Technology and Livelihood Education", description: "Technical drawing", units: 1 },
                    { code: "G8-MAPEH", name: "Music, Arts, PE, and Health", description: "Advanced arts and health", units: 2 },
                    { code: "G8-VALUES", name: "Values Education", description: "Ethical leadership", units: 1 }
                ],
                "Grade 9": [
                    { code: "G9-ENG", name: "English", description: "British-American literature", units: 2 },
                    { code: "G9-MATH", name: "Mathematics", description: "Geometry", units: 2 },
                    { code: "G9-SCI", name: "Science", description: "Physics", units: 2 },
                    { code: "G9-FIL", name: "Filipino", description: "Florante at Laura", units: 2 },
                    { code: "G9-AP", name: "Araling Panlipunan", description: "Economics", units: 1 },
                    { code: "G9-TLE", name: "Technology and Livelihood Education", description: "Information technology", units: 1 },
                    { code: "G9-MAPEH", name: "Music, Arts, PE, and Health", description: "Performing arts", units: 2 },
                    { code: "G9-VALUES", name: "Values Education", description: "Social responsibility", units: 1 }
                ],
                "Grade 10": [
                    { code: "G10-ENG", name: "English", description: "World literature", units: 2 },
                    { code: "G10-MATH", name: "Mathematics", description: "Statistics and probability", units: 2 },
                    { code: "G10-SCI", name: "Science", description: "Chemistry", units: 2 },
                    { code: "G10-FIL", name: "Filipino", description: "Noli Me Tangere at El Filibusterismo", units: 2 },
                    { code: "G10-AP", name: "Araling Panlipunan", description: "Contemporary issues", units: 1 },
                    { code: "G10-TLE", name: "Technology and Livelihood Education", description: "Entrepreneurship", units: 1 },
                    { code: "G10-MAPEH", name: "Music, Arts, PE, and Health", description: "Health and wellness", units: 2 },
                    { code: "G10-VALUES", name: "Values Education", description: "Citizenship", units: 1 }
                ],
                "Grade 11": [
                    { code: "G11-EAPP", name: "English for Academic and Professional Purposes", description: "Academic writing", units: 3 },
                    { code: "G11-ORCOM", name: "Oral Communication", description: "Public speaking", units: 3 },
                    { code: "G11-GENPSY", name: "General Psychology", description: "Introduction to psychology", units: 3 },
                    { code: "G11-EARTH", name: "Earth and Life Science", description: "Geology and biology", units: 3 },
                    { code: "G11-PHYS", name: "Physical Science", description: "Physics concepts", units: 3 },
                    { code: "G11-FIL", name: "Komunikasyon at Pananaliksik", description: "Filipino research", units: 3 },
                    { code: "G11-STEM-1", name: "Pre-Calculus", description: "Advanced mathematics", units: 3, strand: "STEM" },
                    { code: "G11-STEM-2", name: "Basic Calculus", description: "Introduction to calculus", units: 3, strand: "STEM" },
                    { code: "G11-HUMSS-1", name: "Creative Writing", description: "Creative composition", units: 3, strand: "HUMSS" },
                    { code: "G11-HUMSS-2", name: "Introduction to World Religions", description: "Comparative religion", units: 3, strand: "HUMSS" },
                    { code: "G11-ABM-1", name: "Business Math", description: "Mathematics for business", units: 3, strand: "ABM" },
                    { code: "G11-ABM-2", name: "Organization and Management", description: "Business administration", units: 3, strand: "ABM" }
                ],
                "Grade 12": [
                    { code: "G12-UCSP", name: "Understanding Culture, Society and Politics", description: "Social sciences", units: 3 },
                    { code: "G12-MEDIA", name: "Media and Information Literacy", description: "Critical media analysis", units: 3 },
                    { code: "G12-PERDEV", name: "Personal Development", description: "Self-improvement", units: 3 },
                    { code: "G12-ENTRE", name: "Entrepreneurship", description: "Business development", units: 3 },
                    { code: "G12-PHILO", name: "Introduction to Philosophy", description: "Philosophical thought", units: 3 },
                    { code: "G12-STEM-1", name: "General Chemistry 1", description: "Advanced chemistry", units: 3, strand: "STEM" },
                    { code: "G12-STEM-2", name: "General Physics 1", description: "Advanced physics", units: 3, strand: "STEM" },
                    { code: "G12-HUMSS-1", name: "Disciplines and Ideas in Social Sciences", description: "Social science studies", units: 3, strand: "HUMSS" },
                    { code: "G12-HUMSS-2", name: "Philippine Politics and Governance", description: "Political science", units: 3, strand: "HUMSS" },
                    { code: "G12-ABM-1", name: "Business Finance", description: "Financial management", units: 3, strand: "ABM" },
                    { code: "G12-ABM-2", name: "Business Ethics", description: "Ethical business practices", units: 3, strand: "ABM" },
                    { code: "G12-RESRCH", name: "Research Project", description: "Capstone research", units: 3 }
                ]
            }
        };

        document.addEventListener('DOMContentLoaded', function() {
            const gradeDetailContainer = document.getElementById('grade-detail-container');
            const gradeListContainer = document.getElementById('grade-list-container');
            const gradeCards = document.querySelectorAll('.grade-card');
            const backButton = document.querySelector('.back-button');
            const tabButtons = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');
            const selectedGradeTitle = document.getElementById('selected-grade-title');
            const addSectionBtn = document.getElementById('add-section-btn');
            const addSubjectBtn = document.getElementById('add-subject-btn');
            const saveSectionBtn = document.getElementById('saveSectionBtn');
            const saveSubjectBtn = document.getElementById('saveSubjectBtn');

            // Bootstrap modal objects
            const addSectionModal = new bootstrap.Modal(document.getElementById('addSectionModal'));
            const addSubjectModal = new bootstrap.Modal(document.getElementById('addSubjectModal'));
            
            let currentGrade = '';
            
            // Add click handlers for grade cards
            gradeCards.forEach(card => {
                card.addEventListener('click', function() {
                    const gradeTitle = this.getAttribute('data-grade');
                    currentGrade = gradeTitle;
                    selectedGradeTitle.textContent = gradeTitle;
                    
                    // Show grade detail view and hide grade list
                    gradeListContainer.style.display = 'none';
                    gradeDetailContainer.classList.add('active');
                    
                    // Load sections and subjects for the selected grade
                    loadSections(gradeTitle);
                    loadSubjects(gradeTitle);
                });
            });
            
            // Back button handler
            backButton.addEventListener('click', function() {
                gradeDetailContainer.classList.remove('active');
                gradeListContainer.style.display = 'block';
            });
            
            // Tab buttons handler
            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const tabId = this.getAttribute('data-tab');
                    
                    // Update active tab button
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Show selected tab content
                    tabContents.forEach(content => content.classList.remove('active'));
                    document.getElementById(tabId + '-tab').classList.add('active');
                });
            });
            
            // Add Section button handler
            addSectionBtn.addEventListener('click', function() {
                // Reset form fields
                document.getElementById('sectionName').value = '';
                document.getElementById('sectionAdvisor').value = '';
                document.getElementById('sectionRoom').value = '';
                document.getElementById('sectionCapacity').value = '40';
                
                // Show modal
                addSectionModal.show();
            });
            
            // Add Subject button handler
            addSubjectBtn.addEventListener('click', function() {
                // Reset form fields
                document.getElementById('subjectCode').value = '';
                document.getElementById('subjectName').value = '';
                document.getElementById('subjectDescription').value = '';
                document.getElementById('subjectUnits').value = '1';
                
                // Show modal
                addSubjectModal.show();
            });
            
            // Save Section button handler
            saveSectionBtn.addEventListener('click', function() {
                const sectionName = document.getElementById('sectionName').value;
                const sectionAdvisor = document.getElementById('sectionAdvisor').value;
                const sectionRoom = document.getElementById('sectionRoom').value;
                const sectionCapacity = document.getElementById('sectionCapacity').value;
                
                if (sectionName && sectionAdvisor) {
                    // Add new section to sample data
                    if (!sampleData.sections[currentGrade]) {
                        sampleData.sections[currentGrade] = [];
                    }
                    
                    sampleData.sections[currentGrade].push({
                        name: sectionName,
                        advisor: sectionAdvisor,
                        room: sectionRoom,
                        capacity: parseInt(sectionCapacity),
                        current: 0
                    });
                    
                    // Reload sections
                    loadSections(currentGrade);
                    
                    // Hide modal
                    addSectionModal.hide();
                }
            });
            
            // Save Subject button handler
            saveSubjectBtn.addEventListener('click', function() {
                const subjectCode = document.getElementById('subjectCode').value;
                const subjectName = document.getElementById('subjectName').value;
                const subjectDescription = document.getElementById('subjectDescription').value;
                const subjectUnits = document.getElementById('subjectUnits').value;
                
                if (subjectCode && subjectName) {
                    // Add new subject to sample data
                    if (!sampleData.subjects[currentGrade]) {
                        sampleData.subjects[currentGrade] = [];
                    }
                    
                    sampleData.subjects[currentGrade].push({
                        code: subjectCode,
                        name: subjectName,
                        description: subjectDescription,
                        units: parseInt(subjectUnits)
                    });
                    
                    // Reload subjects
                    loadSubjects(currentGrade);
                    
                    // Hide modal
                    addSubjectModal.hide();
                }
            });
            
            // Function to load sections for a grade
            function loadSections(grade) {
                const sectionsList = document.getElementById('sections-list');
                sectionsList.innerHTML = '';
                
                const sections = sampleData.sections[grade] || [];
                
                if (sections.length === 0) {
                    sectionsList.innerHTML = '<div class="col-12"><div class="alert alert-info">No sections found for this grade level. Click "Add Section" to create one.</div></div>';
                    return;
                }
                
                sections.forEach(section => {
                    const sectionCard = document.createElement('div');
                    sectionCard.className = 'col-md-6 col-lg-4 mb-4';
                    sectionCard.innerHTML = `
                        <div class="card section-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h5 class="card-title mb-0">${section.name}</h5>
                                    <span class="badge badge-section">${section.current}/${section.capacity}</span>
                                </div>
                                <p class="card-text mb-1"><strong>Advisor:</strong> ${section.advisor}</p>
                                <p class="card-text mb-1"><strong>Room:</strong> ${section.room || 'Not assigned'}</p>
                                <div class="d-flex justify-content-end mt-3">
                                    <div class="action-buttons">
                                        <button class="btn btn-outline-primary btn-sm view-students-btn">
                                            <i class="fas fa-users"></i> Students
                                        </button>
                                        <button class="btn btn-outline-secondary btn-sm edit-section-btn">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-outline-danger btn-sm delete-section-btn">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    sectionsList.appendChild(sectionCard);
                });
            }
            
            // Function to load subjects for a grade
            function loadSubjects(grade) {
                const subjectsList = document.getElementById('subjects-list');
                subjectsList.innerHTML = '';
                
                const subjects = sampleData.subjects[grade] || [];
                
                if (subjects.length === 0) {
                    subjectsList.innerHTML = '<div class="col-12"><div class="alert alert-info">No subjects found for this grade level. Click "Add Subject" to create one.</div></div>';
                    return;
                }
                
                subjects.forEach(subject => {
                    const subjectCard = document.createElement('div');
                    subjectCard.className = 'col-md-6 col-lg-4 mb-4';
                    subjectCard.innerHTML = `
                        <div class="card subject-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h5 class="card-title mb-0">${subject.name}</h5>
                                    <span class="badge badge-subject">${subject.code}</span>
                                </div>
                                <p class="card-text mb-1">${subject.description || 'No description available'}</p>
                                <p class="card-text mb-1"><strong>Units:</strong> ${subject.units}</p>
                                ${subject.strand ? `<p class="card-text mb-1"><strong>Strand:</strong> ${subject.strand}</p>` : ''}
                                <div class="d-flex justify-content-end mt-3">
                                    <div class="action-buttons">
                                        <button class="btn btn-outline-secondary btn-sm edit-subject-btn">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-outline-danger btn-sm delete-subject-btn">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    subjectsList.appendChild(subjectCard);
                });
            }
        });
    </script>
</body>
</html>