<?php
// Include your database connection
include("connection.php");

// Check if ID is provided
if(isset($_GET['id'])) {
    $caseId = $_GET['id'];
    // Prepare a parameterized query to fetch case details by ID
    $query = "SELECT * FROM `tables` WHERE ID = ?";
    
    // Prepare the statement
    $stmt = mysqli_prepare($connection, $query);
    
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "i", $caseId);
    
    // Execute the statement
    mysqli_stmt_execute($stmt);
    
    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    if($result) {
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // Build HTML content for the edit modal form
            $html = "<form id='edit-case-form' method='post' action='update_case.php'>";
            $html .= "<input type='hidden' name='edit-case-ID' value='{$row['ID']}'>";
            $html .= "<div class='mb-3'>";
            $html .= "<label for='edit-case-Name' class='form-label'>Name</label>";
            $html .= "<input type='text' class='form-control' id='edit-case-Name' name='edit-case-Name' value='{$row['Name']}'>";
            $html .= "</div>";
            $html .= "<div class='mb-3'>";
            $html .= "<label for='edit-case-Skills' class='form-label'>Skills</label>";
            $html .= "<textarea class='form-control' id='edit-case-Skills' name='edit-case-Skills'>{$row['Skills']}</textarea>";
            $html .= "</div>";
            $html .= "<div class='mb-3'>";
            $html .= "<label for='edit-case-Qualification' class='form-label'>Qualification</label>";
            $html .= "<input type='text' class='form-control' id='edit-case-Qualification' name='edit-case-Qualification' value='{$row['Qualification']}'>";
            $html .= "</div>";
            $html .= "<div class='mb-3'>";
            $html .= "<label for='edit-case-Profession' class='form-label'>Profession</label>";
            $html .= "<input type='text' class='form-control' id='edit-case-Profession' name='edit-case-Profession' value='{$row['Profession']}'>";
            $html .= "</div>";
            // Add more fields if needed
            $html .= "<button type='submit' class='btn btn-primary'>Save Changes</button>  ";
            // Add close button
            $html .= "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>";
            
            // End of form
            $html .= "</form>";
            
            echo $html;
        } else {
            echo "No  provided ID.";
        }
    } else {
        echo "Query execution failed.";
    }
} else {
    echo "No ID provided.";
}
?>
