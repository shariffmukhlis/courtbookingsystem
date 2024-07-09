<?php

include '../php/db.php';
// Get the court id from the URL
$court_id = $_GET['court_id'];

// Get the court details from the database
$sql = "SELECT * FROM court WHERE court_id = $court_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

//update status if the court is available or not, if the court is available, set the status to 1, if not, set the status to 0

if($row['court_status'] == 1){
    $sql = "UPDATE court SET court_status = 0 WHERE court_id = $court_id";
    $conn->query($sql);
    if($conn->error){
        echo '<script>alert("Error")</script>';
    }else{
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=admin_courtsetup.php\">";
    }
}
else if($row['court_status'] == 0){
    $sql = "UPDATE court SET court_status = 1 WHERE court_id = $court_id";
    $conn->query($sql);
    if($conn->error){
        echo '<script>alert("Error")</script>';
    }else{
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=admin_courtsetup.php\">";
    }
}  



?>