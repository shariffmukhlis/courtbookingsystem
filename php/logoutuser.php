<?php

include '../php/db.php';

session_start();
function checkComplain($userid){
    include '../php/db.php';
    $sql = "select a.booking_id, complaint_before, complaint_after from booking a  left join complaint b  on b.booking_id = a.booking_id where user_id = ".$userid." and a.book_date < CURRENT_DATE";
    $result = $conn->query($sql);
    if($result){
        while($row=$result->fetch_assoc()){
            if($row['complaint_before']=="" && $row['complaint_after'] ==""){
                return true;
            }
        }

    }
}
if(checkComplain($_SESSION['user_id'])){
    echo "<script> alert('Anda perlu memuat naik gambar sebelum dan selepas penggunaan gelanggang') </script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=../users/user_dashboard.php\">";
}

else {
    session_destroy();
    header("Location: ../index.html");
}
?>