<?php
// Include your database connection
include("connection.php");

// Check if ID is provided
if(isset($_GET['id'])) {
    $caseId = $_GET['id'];
    // Query to fetch case details by ID
    $query = "SELECT * FROM `tables` WHERE ID = $caseId";
    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Build HTML content for displaying case details in the modal
        $html = "<p><strong>Case ID:</strong> {$row['ID']}</p>";
        $html .= "<p><strong>Name:</strong> {$row['Name']}</p>";
        $html .= "<p><strong>Skills:</strong> {$row['Skills']}</p>";
        $html .= "<p><strong>Qualification:</strong> {$row['Qualification']}</p>";
        $html .= "<p><strong>Profession:</strong> {$row['Profession']}</p>";
        $html .= "<p><strong>Time:</strong> {$row['Time']}</p>";
        $html .= "<p><strong>Date:</strong> {$row['Date']}</p>";
        echo $html;
    } else {
        echo "No case found with the provided ID.";
    }
} else {
    echo "No case ID provided.";
}
?>
