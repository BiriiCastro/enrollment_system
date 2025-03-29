<?php
header("Content-Type: application/json");
error_reporting(E_ALL);
ini_set("display_errors", 0); // Disable direct error output
ini_set("log_errors", 1);
ini_set("error_log", "php_errors.log"); // Log errors instead

require_once "db_connection.php";

$response = ["exists" => false];

try {
    // Get JSON input
    $jsonInput = file_get_contents("php://input");
    $data = json_decode($jsonInput, true);

    // Validate JSON format
    if ($data === null) {
        echo json_encode(["error" => "Invalid JSON format"]);
        exit;
    }

    // Check for missing fields
    if (!isset($data["firstName"], $data["middleName"], $data["lastName"], $data["birthDate"], $data["gradeApplyingFor"])) {
        echo json_encode(["error" => "Missing required fields"]);
        exit;
    }

    // Sanitize and format inputs
    $firstName = trim($data["firstName"]);
    $middleName = trim($data["middleName"]);
    $lastName = trim($data["lastName"]);
    $birthDate = trim($data["birthDate"]);
    $gradeApplyingFor = intval($data["gradeApplyingFor"]); // Convert to integer

    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT COUNT(*) FROM students WHERE first_name = ? AND middle_name = ? AND last_name = ? AND date_of_birth = ? AND grade_applying_for = ?");
    if (!$stmt) {
        throw new Exception("Prepared statement failed: " . $conn->error);
    }

    // Bind parameters (integer for gradeApplyingFor)
    $stmt->bind_param("ssssi", $firstName, $middleName, $lastName, $birthDate, $gradeApplyingFor);
    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }

    // Fetch result properly
    $stmt->bind_result($count);
    $stmt->fetch();

    // Set response
    if ($count > 0) {
        $response["exists"] = true;
    }

    // Close resources
    $stmt->close();
    $conn->close();

    // Return JSON response
    echo json_encode($response);
} catch (Exception $e) {
    error_log("Error in check_duplicate_student.php: " . $e->getMessage());
    echo json_encode(["error" => "Database error. Please try again later."]);
    exit;
}
?>
