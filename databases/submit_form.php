<?php
header('Content-Type: application/json'); // Ensure JSON output
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db_connection.php'; // Include your database connection file

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed"]);
    exit();
}

$response = ["success" => false, "message" => "Unknown error occurred"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $last_name = $_POST['studentLastName'] ?? '';
    $first_name = $_POST['studentFirstName'] ?? '';
    $middle_name = $_POST['studentMiddleName'] ?? '';
    $suffix = $_POST['suffix'] ?? null;
    $province_id = isset($_POST['province']) ? (int) $_POST['province'] : null;
    $municipality_id = isset($_POST['municipality']) ? (int) $_POST['municipality'] : null;
    $barangay_id = isset($_POST['barangay']) ? (int) $_POST['barangay'] : null;
    $street_address = $_POST['streetAddress'] ?? '';
    $zip_code = $_POST['zipCode'] ?? '';
    $date_of_birth = $_POST['dateOfBirth'] ?? null;
    $place_of_birth = $_POST['placeOfBirth'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $nationality_id = isset($_POST['nationality']) ? (int) $_POST['nationality'] : null;
    $religion_id = isset($_POST['religion']) ? (int) $_POST['religion'] : null;
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $contact = $_POST['contactNumber'] ?? '';
    $prev_grade_lvl = isset($_POST['prevGradeLevel']) ? (int) $_POST['prevGradeLevel'] : null;
    $school_last_attended = $_POST['schoolLastAttended'] ?? '';
    $school_address = $_POST['schoolLastAttendedAddress'] ?? '';
    $father_name = $_POST['fatherFullName'] ?? '';
    $father_occupation = $_POST['fatherOccupation'] ?? '';
    $father_contact_number = $_POST['fatherContactNumber'] ?? '';
    $mother_name = $_POST['motherFullName'] ?? '';
    $mother_occupation = $_POST['motherOccupation'] ?? '';
    $mother_contact_number = $_POST['motherContactNumber'] ?? '';
    $guardian_name = $_POST['guardianFullName'] ?? '';
    $guardian_relationship = $_POST['relationshipToStudent'] ?? '';
    $guardian_contact_number = $_POST['guardianContactNumber'] ?? '';
    $school_year_id = isset($_POST['schoolYear']) ? (int) $_POST['schoolYear'] : null;
    $type_of_student = $_POST['studentType'] ?? '';
    $grade_applying_for = isset($_POST['applyingFor']) ? (int) $_POST['applyingFor'] : null;
    $academic_track = $_POST['academicTrack'] ?? null;
    $appointment_date = $_POST['appointmentDate'] ?? null;
    $appointment_time = $_POST['appointmentTime'] ?? null;
    $upload_dir = "uploads/"; // Ensure this folder exists with proper permissions

    // Handle Birth Certificate Upload
    if (isset($_FILES['birthCertificate']) && $_FILES['birthCertificate']['error'] === UPLOAD_ERR_OK) {
        $birth_certificate_filename = basename($_FILES['birthCertificate']['name']);
        $birth_certificate_path = $upload_dir . $birth_certificate_filename;
        
        if (move_uploaded_file($_FILES['birthCertificate']['tmp_name'], $birth_certificate_path)) {
            $birth_certificate = $birth_certificate_path; // Store the file path
        } else {
            $birth_certificate = ""; // Handle failure
        }
    } else {
        $birth_certificate = "";
    }

    // Handle Report Card Upload
    if (isset($_FILES['reportCard']) && $_FILES['reportCard']['error'] === UPLOAD_ERR_OK) {
        $report_card_filename = basename($_FILES['reportCard']['name']);
        $report_card_path = $upload_dir . $report_card_filename;
        
        if (move_uploaded_file($_FILES['reportCard']['tmp_name'], $report_card_path)) {
            $report_card = $report_card_path;
        } else {
            $report_card = "";
        }
    } else {
        $report_card = "";
    }

    // Handle ID Picture Upload
    if (isset($_FILES['idPicture']) && $_FILES['idPicture']['error'] === UPLOAD_ERR_OK) {
        $id_picture_filename = basename($_FILES['idPicture']['name']);
        $id_picture_path = $upload_dir . $id_picture_filename;
        
        if (move_uploaded_file($_FILES['idPicture']['tmp_name'], $id_picture_path)) {
            $id_picture = $id_picture_path;
        } else {
            $id_picture = "";
        }
    } else {
        $id_picture = "";
    }


    // Prepare and execute query
    $stmt = $conn->prepare("INSERT INTO students (last_name, first_name, middle_name, suffix, province_id, municipality_id, barangay_id, street_address, zip_code, date_of_birth, place_of_birth, gender, nationality_id, religion_id, email, contact, prev_grade_lvl, school_last_attended, school_address, father_name, father_occupation, father_contact_number, mother_name, mother_occupation, mother_contact_number, guardian_name, guardian_relationship, guardian_contact_number, school_year_id, type_of_student, grade_applying_for, academic_track, appointment_date, appointment_time, birth_certificate, report_card, id_picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("ssssiiissssiiississsssssssssisissssss", $last_name, $first_name, $middle_name, $suffix, $province_id, $municipality_id, $barangay_id, $street_address, $zip_code, $date_of_birth, $place_of_birth, $gender, $nationality_id, $religion_id, $email, $contact, $prev_grade_lvl, $school_last_attended, $school_address, $father_name, $father_occupation, $father_contact_number, $mother_name, $mother_occupation, $mother_contact_number, $guardian_name, $guardian_relationship, $guardian_contact_number, $school_year_id, $type_of_student, $grade_applying_for, $academic_track, $appointment_date, $appointment_time, $birth_certificate, $report_card, $id_picture);

        if ($stmt->execute()) {
            $response = ["success" => true, "message" => "Data added successfully"];
        } else {
            $response = ["success" => false, "message" => "Error inserting data", "error" => $stmt->error];
        }
        $stmt->close();
    } else {
        $response = ["success" => false, "message" => "Database query preparation failed"];
    }
}

$conn->close();
echo json_encode($response);
exit();
?>
