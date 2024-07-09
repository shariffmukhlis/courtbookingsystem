<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Laluan</title>
    <link rel="stylesheet" href="../styles/style.css">
    </title>
</head>
<?php
    include '../php/db.php';


    session_start();
   
    if(isset($_POST['password']) && isset($_POST['password2'])){
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        if($password == $password2){
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "select user_id from password_reset where token = '".$_GET['token']."'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();            
            $user_id = $row['user_id'];
            $sql = "update users set user_password = '".$password."' where user_id = ".$user_id."";
            $result = $conn->query($sql);
            if($result){
                echo "<script>alert('Kata laluan berjaya diubah')</script>";
                $sql = "delete from password_reset where token = '".$_GET['token']."'";
                $conn->query($sql);
                echo "<meta http-equiv='refresh' content='0;url=../index.html'>";
            }
            else{
                echo "<script>alert('Kata laluan tidak berjaya diubah')</script>";
            }
        }
        else{
            echo "<script>alert('Kata laluan tidak sama')</script>";
        }
    }
    else{
        echo "<script>alert('Sila isi semua ruangan')</script>";
    }

?>
<body class="forgot">
    <section class="forgot-password">
        <img src="../images/logoutem.png" alt="logo" class="logo">
        <h1>Ubah Kata Laluan</h1>
        <form method="POST">
            <label for="password">Kata Laluan</label>
            <input type="password" name="password" id="password" required>
            <label for="password2">Pengesahan Kata Laluan</label>
            <input type="password" name="password2" id="password2" required>
            <button type="submit">Hantar</button>
        </form>
        <a href="emailForgot.php">Kembali ke ruang email</a>
    </section>
</body>
</html>