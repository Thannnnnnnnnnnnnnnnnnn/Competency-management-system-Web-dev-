<?php
include("connection.php");

if(isset($_POST['ID'])) {
    $ID = $_POST['ID'];

    $query = "SELECT * FROM `tables` WHERE `ID` = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $ID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $ID_details = mysqli_fetch_assoc($result);

    if($ID_details) {
        // Format case details into HTML
        $output = '<p><strong>Name:</strong> '.$ID_details['Name'].'</p>';
        $output .= '<p><strong>Skills:</strong> '.$ID_details['Skills'].'</p>';
        $output .= '<p><strong>Qualification:</strong> '.$ID_details['Qualification'].'</p>';
        $output .= '<p><strong>Profession:</strong> '.$ID_details['Profession'].'</p>';
        $output .= '<p><strong>Time:</strong> '.$ID_details['Time'].'</p>';
        $output .= '<p><strong>Date:</strong> '.$ID_details['Date'].'</p>';

        echo $output;
    } else {
        echo "<p>No details found for the provided ID</p>";
    }
} else {
    echo "<p>ID not provided</p>";
}
?>
