<?php
include("connection.php");

$query = "SELECT * FROM `tables`"; 
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="systems.css">
    <link rel="stylesheet" href="Main.css">
    <link href="https://cdn.jsdelivr.net/boxicons/2.0.7/css/boxicons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
    </header>

    <footer class="footer1">
        <div class="footer-section">
            <br>
            <a href="#" style="margin-left: 10px"><b>● Competency management</b></a>
        </div>
    </footer>

    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> 
                <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">Competency management</span> </a>
                <div class="nav_list"> 
                    <a href="admin.php" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a> 
                    <a href="user.php" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Add info</span> </a> 
                  
                </div>
            </div> 
            <a href="login.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">log out</span> </a>
        </nav>
    </div>
    
   <br><br>


   <div class="container4">
   <div class="row mt-5">
           
               
                    <br><br><br>
                </div>

                <br>
                <center>
                    <?php if ($result && mysqli_num_rows($result) > 0) : ?>
                        <table class="table" style="text-align: center">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>                                
                                    <th scope="col">Skills</th>
                                    <th scope="col">Qualification</th>
                                    <th scope="col">Profession</th>
                                    <th scope="col">Actions</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                      
                                        <td><?php echo $row['Name']; ?></td>
                                        <td><?php echo $row['Skills']; ?></td>
                                        <td><?php echo $row['Qualification']; ?></td>
                                        <td><?php echo $row['Profession']; ?></td>
                                     
                                       

                                        <td>
                                        <a href="#" class="view-button" data-bs-toggle="modal" data-bs-target="#viewModal" data-case-id="<?php echo $row['ID']; ?>">
                                                <i class='bx bx-show'></i>
                                            </a> |
                                           
                                        <a href="#" class="edit-button" data-bs-toggle="modal" data-bs-target="#editModal" data-case-id="<?php echo $row['ID']; ?>">
                                            <i class="bx bx-edit"></i>
                                        </a> |
                                        <a href='delete.php?id=<?php echo $row['ID']; ?>' onclick='return confirm("Are you sure you want to delete this record?")' class='delete-button'>
                                            <i class="bx bx-trash"></i>
                                        </a>
                                   

                                    </tr>
                                    <?php
                                    $count++;
                                endwhile; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <p>No records found</p>
                    <?php endif; ?>
                </center>
            </div>
        </div>
    </div>
    </div>
    </div>


    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Full details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="caseDetails">
                    <!-- Case details will be dynamically inserted here -->
                </div>
                
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Added modal-lg class for larger size -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="edit-case-form">
 
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
   
    $('.view-button').on('click', function(event) {
        event.preventDefault(); // Prevent default link behavior
        var caseId = $(this).data('case-id');
  
        $.get('view_case.php', {id: caseId}, function(data) {

            $('#caseDetails').html(data);
            $('#viewModal').modal('show'); // Show the view modal
        });
    });


    $('.edit-button').on('click', function(event) {
        event.preventDefault(); // Prevent default link behavior
        var caseId = $(this).data('case-id');
    
        $.get('edit_case_form.php', {id: caseId}, function(data) {
           
            $('#edit-case-form').html(data);
            $('#editModal').modal('show'); // Show the edit modal
        });
    });

  
    $(document).on('submit', '#edit-case-form', function(event) {
        event.preventDefault(); 
        var formData = $(this).serialize(); 
        $.ajax({
            url: 'edit_case.php',
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
    

                    $('#editModal').modal('hide');

                    location.reload(); // Reload the page
                } else {


                    alert('Updated ');
                }
            },
            error: function(xhr, status, error) {
       
                console.error(xhr.responseText);
            }
        });
    });
});
</script>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        const showNavbar = (toggleId, navId, bodyId, headerId) =>{
            const toggle = document.getElementById(toggleId),
            nav = document.getElementById(navId),
            bodypd = document.getElementById(bodyId),
            headerpd = document.getElementById(headerId)
            

            if(toggle && nav && bodypd && headerpd){
                toggle.addEventListener('click', ()=>{
            
                    nav.classList.toggle('show')

                    toggle.classList.toggle('bx-x')
           
                    bodypd.classList.toggle('body-pd')

                    headerpd.classList.toggle('body-pd')
                })
            }
        }
        
        showNavbar('header-toggle','nav-bar','body-pd','header')
        
 
        const linkColor = document.querySelectorAll('.nav_link')
        
        function colorLink(){
            if(linkColor){
                linkColor.forEach(l=> l.classList.remove('active'))
                this.classList.add('active')
            }
        }
        linkColor.forEach(l=> l.addEventListener('click', colorLink))
    });
</script>

</body>
</html>
