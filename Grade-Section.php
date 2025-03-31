<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System - Admin Dashboard</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
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
    </style>
<body>
    <!-- Header -->
    <div class="header d-flex justify-content-between align-items-center">
        <div>
            <h4 class="mb-0">WELCOME! <?php echo strtoupper($userName); ?></h4>
        </div>
        <div>
            <a href="Admin.php">dashboard</a>
            <a href="Login Form.php">logout</a>
        </div>
    </div>
    
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="Admin.php" class="active">Dashboard</a>
        <a href="Enrollment For Review.php">Enrollment for Review</a>
        <a href="All Students.php">All Students</a>
        <a href="Teachers.php">Teachers</a>
        <a href="Grade-Section.php">Grade & Sections</a>
        <a href="Pages Editor.php">Pages Editor</a>
        <a href="User Management.php">User Management</a>
    </div>
    
    <!-- Main Content -->
    <div class="content-area p-4">
        <h2 class="mb-4">Grade and Sections</h2>
        
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div></div>
                    <div class="d-flex align-items-center">
                        <label for="school-year" class="me-2">School Year</label>
                        <select id="school-year" class="form-select" style="width: 200px;" onchange="changeSchoolYear(this.value)">
                            <option value="2024-2025" <?php echo $schoolYear == '2024-2025' ? 'selected' : ''; ?>>2024-2025</option>
                            <option value="2025-2026" <?php echo $schoolYear == '2025-2026' ? 'selected' : ''; ?>>2025-2026</option>
                            <option value="2026-2027" <?php echo $schoolYear == '2026-2027' ? 'selected' : ''; ?>>2026-2027</option>
                        </select>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                        <a href="grade_details.php?grade=kinder&year=<?php echo $schoolYear; ?>" class="btn btn-primary w-100 grade-btn">Kinder</a>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <a href="grade_details.php?grade=preschool&year=<?php echo $schoolYear; ?>" class="btn btn-primary w-100 grade-btn">Preschool</a>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <a href="grade_details.php?grade=1&year=<?php echo $schoolYear; ?>" class="btn btn-primary w-100 grade-btn">Grade 1</a>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <a href="grade_details.php?grade=2&year=<?php echo $schoolYear; ?>" class="btn btn-primary w-100 grade-btn">Grade 2</a>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <a href="grade_details.php?grade=3&year=<?php echo $schoolYear; ?>" class="btn btn-primary w-100 grade-btn">Grade 3</a>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <a href="grade_details.php?grade=4&year=<?php echo $schoolYear; ?>" class="btn btn-primary w-100 grade-btn">Grade 4</a>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <a href="grade_details.php?grade=5&year=<?php echo $schoolYear; ?>" class="btn btn-primary w-100 grade-btn">Grade 5</a>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <a href="grade_details.php?grade=6&year=<?php echo $schoolYear; ?>" class="btn btn-primary w-100 grade-btn">Grade 6</a>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <a href="grade_details.php?grade=7&year=<?php echo $schoolYear; ?>" class="btn btn-primary w-100 grade-btn">Grade 7</a>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <a href="grade_details.php?grade=8&year=<?php echo $schoolYear; ?>" class="btn btn-primary w-100 grade-btn">Grade 8</a>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <a href="grade_details.php?grade=9&year=<?php echo $schoolYear; ?>" class="btn btn-primary w-100 grade-btn">Grade 9</a>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <a href="grade_details.php?grade=10&year=<?php echo $schoolYear; ?>" class="btn btn-primary w-100 grade-btn">Grade 10</a>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <a href="grade_details.php?grade=11&year=<?php echo $schoolYear; ?>" class="btn btn-primary w-100 grade-btn">Grade 11</a>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <a href="grade_details.php?grade=12&year=<?php echo $schoolYear; ?>" class="btn btn-primary w-100 grade-btn">Grade 12</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function changeSchoolYear(year) {
            window.location.href = 'grade_sections.php?school_year=' + year;
        }
    </script>
</body>
</html>