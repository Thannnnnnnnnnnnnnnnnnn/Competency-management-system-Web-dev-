<?php
// Include your database connection
include("connection.php");

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form fields and sanitize inputs
    if (isset($_POST['edit-case-ID'], $_POST['edit-case-Name'], $_POST['edit-case-Skills'], $_POST['edit-case-Qualification'], $_POST['edit-case-Profession'])) {
        $ID = $_POST['edit-case-ID'];
        $Name = mysqli_real_escape_string($connection, $_POST['edit-case-Name']);
        $Skills = mysqli_real_escape_string($connection, $_POST['edit-case-Skills']);
        $Qualification = mysqli_real_escape_string($connection, $_POST['edit-case-Qualification']);
        $Profession = mysqli_real_escape_string($connection, $_POST['edit-case-Profession']);

       
        $query = "UPDATE `tables` SET Name = ?, Skills = ?, Qualification = ?, Profession = ? WHERE ID = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "ssssi", $Name, $Skills, $Qualification, $Profession, $ID);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Return success response
            echo json_encode(array("success" => true));
        } else {
            // Return error response
            echo json_encode(array("success" => false, "error" => "Failed to update record."));
        }
        mysqli_stmt_close($stmt);
    } else {
        // Return error response if form fields are missing
        echo json_encode(array("success" => false, "error" => "One or more form fields are missing."));
    }
} else {
    // Return error response if form data is not submitted
    echo json_encode(array("success" => false, "error" => "Form data not submitted."));
}
?>
