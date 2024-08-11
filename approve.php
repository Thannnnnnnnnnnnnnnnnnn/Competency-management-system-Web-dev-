<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $case_id = $_GET['id'];
    
    // Implement logic to approve the case based on the provided case_id
    // Update the `case_status` field in the database
    $query = "UPDATE `tables` SET case_status = 'Approved' WHERE case_id = '$case_id'";
    if (mysqli_query($connection, $query)) {
        // Redirect to admin.php after updating the status
        header("Location: admin.php");
        exit(); // Terminate the script after redirection
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }
} else {
    echo "Invalid request";
}
?>
