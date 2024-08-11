<?php
$connection = mysqli_connect("localhost:3307","root","","competency_management");
if(mysqli_connect_error()){

    echo "Failed to connect in Mysql" . mysqli_connect_error();

}else{
    echo "";
}
?>