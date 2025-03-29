<?php
include 'db_connection.php'; // Ensure correct database connection

header("Content-Type: application/json");

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Decode JSON request
$data = json_decode(file_get_contents("php://input"), true);

// Validate required fields
if (!isset($data['email']) || !isset($data['schoolYear']) || !isset($data['gradeLevel'])) {
    echo json_encode(["error" => "Invalid input - missing required fields", "received" => $data]); 
    exit;
}

// Sanitize input
$email = $conn->real_escape_string($data['email']);
$school_year_id = (int)$data['schoolYear'];
$grade_level = (int)$data['gradeLevel'];

// Validate academicSemester: Required for Grade 11 (13) and Grade 12 (14)
if (($grade_level == 13 || $grade_level == 14) && (!isset($data['academicSemester']) || $data['academicSemester'] === "")) {
    echo json_encode(["error" => "Academic Semester is required for Grade 11 and 12"]);
    exit;
}

// Handle academic semester conversion
$academic_semester = isset($data['academicSemester']) ? (int)$data['academicSemester'] : null;

// Debugging log
error_log("Checking Email: $email, School Year: $school_year_id, Grade Level: $grade_level, Semester: " . ($academic_semester ?? "NULL"));

// Base query: Check email for the same school year
$query = "SELECT * FROM students WHERE email = '$email' AND school_year_id = $school_year_id";

// If Grade 11 (13) or 12 (14), ensure academicSemester is also checked
if ($grade_level == 13 || $grade_level == 14) {
    $query .= " AND academic_semester = $academic_semester";
}

// Execute query
$result = $conn->query($query);

// Check for database errors
if (!$result) {
    echo json_encode(["error" => "Database query failed", "sql_error" => $conn->error]); 
    exit;
}

// Return whether the email exists
echo json_encode(["exists" => $result->num_rows > 0]);

$conn->close();
?>
