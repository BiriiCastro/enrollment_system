<?php
require 'db_connection.php'; // Ensure this file connects to your 'enrollment_system' database

$query = "SELECT 
            s.student_id, 
            CONCAT(s.last_name, ', ', s.first_name, ' ', s.middle_name, ' ', COALESCE(s.suffix, '')) AS student_name,
            gl_applying.grade_name AS grade_applying_name, 
            sy.school_year, 
            s.enrollment_status 
            FROM students s 
            LEFT JOIN grade_levels gl_applying ON s.grade_applying_for = gl_applying.grade_level_id 
            LEFT JOIN school_year sy ON s.school_year_id = sy.school_year_id 
            WHERE s.enrollment_status = 'For Payment'
            ORDER BY s.created_at ASC, sy.school_year DESC";

$result = $conn->query($query);
$students = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}

echo json_encode($students);
?>
