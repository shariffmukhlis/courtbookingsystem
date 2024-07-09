<?php

include '../php/db.php';

$complaint = $_POST['complain'];
$after_image = $_FILES['after-image']['name'];
$before_image = $_FILES['before-image']['name'];
$booking_id = $_POST['booking_id'];


$tempafterimage= $_FILES['after-image']['tmp_name'];
$tempbeforeimage= $_FILES['before-image']['tmp_name'];

$folder = "../complaint_images/$after_image";
$folderafter = "../complaint_images/$before_image";


$sql = "insert into complaint (complaint_text, complaint_before, complaint_after, booking_id) values ('$complaint', '$before_image', '$after_image', '$booking_id')";
$result = $conn->query($sql);
if ($result) {
    if(move_uploaded_file($tempbeforeimage, $folder) & move_uploaded_file($tempafterimage, $folderafter)){
        echo "Image uploaded successfully";
        echo "<script>alert('Aduan telah berjaya dihantar'); </script>";
        header("Location: user_complain.php");
    } else {
        echo "Failed to upload image";
        header("Location: user_complain.php");
        echo "<script>alert('Aduan tidak berjaya dihantar'); </script>";
    }

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    header("Location: user_complain.php");
}   
?>