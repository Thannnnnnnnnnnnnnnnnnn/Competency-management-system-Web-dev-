<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $ID = $_GET['id'];
    
    // Delete the record from the database based on the provided case_id
    $query = "DELETE FROM `tables` WHERE ID = '$ID'";
    if (mysqli_query($connection, $query)) {
        // Redirect to the admin page after successful deletion
        header("Location: admin.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($connections);
    }
} else {
    // If Reservation ID is not provided, redirect to the admin page
    header("Location: admin.php");
    exit();
}
?>
