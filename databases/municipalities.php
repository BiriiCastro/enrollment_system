<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "enrollment_system");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get province ID from request
$provinceId = isset($_GET['provinceId']) ? intval($_GET['provinceId']) : 0;

$municipalities = [];
if ($provinceId > 0) {
    $sql = "SELECT id, citymunDesc FROM refcitymun WHERE provCode = (SELECT provCode FROM refprovince WHERE id = $provinceId)";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $municipalities[] = $row;
        }
    }
}

$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($municipalities);
?>
