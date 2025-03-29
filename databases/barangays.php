<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "enrollment_system");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get municipality ID from request
$municipalityId = isset($_GET['municipalityId']) ? intval($_GET['municipalityId']) : 0;

$barangays = [];
if ($municipalityId > 0) {
    $sql = "SELECT id, brgyDesc FROM refbrgy WHERE citymunCode = (SELECT citymunCode FROM refcitymun WHERE id = $municipalityId)";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $barangays[] = $row;
        }
    }
}

$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($barangays);
?>
