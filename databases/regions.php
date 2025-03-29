<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "enrollment_system");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch regions from refregion table
$sql = "SELECT id, regDesc FROM refregion ORDER BY regDesc ASC";
$result = $conn->query($sql);

$regions = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $regions[] = $row;
    }
}

$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($regions);
?>
