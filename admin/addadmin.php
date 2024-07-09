<?php

include '../php/db.php';

$name = $_POST['nama'];
$email = $_POST['email'];
$phoneno = $_POST['phoneno'];
$password = $_POST['password'];
$password2 = $_POST['password2'];


function checkEmail($email){
    include '../php/db.php';
    $query = "SELECT * FROM users WHERE user_email = '$email'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
        return true;
    }else{
        return false;
    }
}

function checkPhone($phoneno){
    include '../php/db.php';
    $query = "SELECT * FROM users WHERE user_phone = '$phoneno'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
        return true;
    }else{
        return false;
    }
}

if($password == $password2){    
    $enc_password = password_hash($password, PASSWORD_DEFAULT);

    if(checkEmail($email)){
        echo '<script>alert("Email telah wujud")</script>';
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=register.php\">";
    }
    if(checkPhone($phoneno)){
        echo '<script>alert("No Tel telah wujud")</script>';
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=register.php\">";
    }
    $query = "INSERT INTO users (user_name, user_position, user_email, user_phone, user_password) VALUES ('$name',  'Admin', '$email', $phoneno, '$enc_password')";
    $result = mysqli_query($conn, $query);
    if($result===TRUE){
        echo '<script>alert("Anda berjaya mendaftar! Kembali log masuk")</script>';
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=admin_addadmin.php\">";
    }else{
        echo '<script>alert("Anda tidak berjaya mendaftar! Kembali mendaftar")</script>';
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=admin_addadmin.php\">";
    }

    }else{
        echo '<script>alert("Kata laluan tidak seragam")</script>';
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=admin_addadmin.php\">";
    }
?>