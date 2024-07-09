<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="icon" href="../images/favicon-16x16.png" type="image/icon type">
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../styles/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
    
<body class="dashboard">    
    <?php
        include 'admin_nav.php';
        include '../php/db.php';


        function checkPassword($currentPassword){
            include '../php/db.php';
            $user_id = $_SESSION['user_id'];
            $sql = "select user_password from users where user_id = '$user_id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $password = $row['user_password'];
            if(password_verify($currentPassword, $password)){
                return true;
            }
            else{
                return false;
            }
        }


        if(isset($_GET['current_password']) && isset($_GET['new_password']) && isset($_GET['confirm_password'])){
            $current_password = $_GET['current_password'];
            $new_password = $_GET['new_password'];
            $confirm_password = $_GET['confirm_password'];
            $user_id = $_SESSION['user_id'];
            if(checkPassword($current_password)){
                if($new_password == $confirm_password){
                    $new_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $sql = "update users set user_password = '$new_password' where user_id = '$user_id'";
                    $conn->query($sql);
                    echo "<script>alert('Kata laluan berjaya diubah')</script>";
                }
                else{
                    echo "<script>alert('Kata laluan baru tidak sama')</script>";
                }
            }
            else{
                echo "<script>alert('Kata laluan semasa salah')</script>";
            }
        }
        else{
            echo "<script>alert('Sila isi semua ruangan')</script>";
        }

    
    ?>
   
    <section class="dashboard-container">
        <article class="container left">
            <h5 class="title">Ubah kata laluan</h5>
            <form class="change_password" action="" method="get">
                <label for="current_password">Kata laluan semasa</label>
                <input type="password" name="current_password" id="current_password" class="form-control" required>
                <label for="new_password">Kata laluan baru</label>
                <input type="password" name="new_password" id="new_password" class="form-control" required>
                <label for="confirm_password">Sahkan kata laluan baru</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                <button type="submit" class="btn btn-primary">Hantar</button>
            </form>
           
        </article>
        <article class="container-right">
        </article>
    </section>

</body>
</html>