<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "enrollment_system");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get region ID from request
$regionId = isset($_GET['regionId']) ? intval($_GET['regionId']) : 0;

$provinces = [];
if ($regionId > 0) {
    $sql = "SELECT id, provDesc FROM refprovince WHERE regCode = (SELECT regCode FROM refregion WHERE id = $regionId)";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $provinces[] = $row;
        }
    }
}

$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($provinces);
?>
