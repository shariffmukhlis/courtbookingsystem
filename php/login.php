<?php
    include '../php/db.php';

    session_start();
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE user_email = '$email'";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            if(password_verify($password, $row['user_password'])){
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['user_email'] = $row['user_email'];
                $_SESSION['user_position'] = $row['user_position'];
                $_SESSION['user_phone'] = $row['user_phone'];
                $_SESSION['user_matricno'] = $row['user_matricno'];
            if($row['user_position'] == 'Admin'){
                header('Location: ../admin/admin_dashboard.php');}
            else {
                header('Location: ../users/user_dashboard.php');
                }
            }
            else{
                echo '<script>alert("Invalid email or password")</script>';
                echo "<meta http-equiv=\"refresh\" content=\"0;URL=..\index.html\">";
                    }
        }
            else{
                echo '<script>alert("Invalid email or password")</script>';
                echo "<meta http-equiv=\"refresh\" content=\"0;URL=..\index.html\">";
        }
    }
?>