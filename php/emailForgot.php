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

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../phpmailer/src/Exception.php';
    require '../phpmailer/src/PHPMailer.php';
    require '../phpmailer/src/SMTP.php';

    if(isset($_GET['email'])){
        $sql = "select * from users where user_email = '".$_GET['email']."'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $user_id = $row['user_id'];
            $user_email = $row['user_email'];
            $user_name = $row['user_name'];
            $token = bin2hex(random_bytes(50));
            $sql = "insert into password_reset (user_id, token) values ('$user_id', '$token')";
            $conn->query($sql);
            $mail = new PHPMailer(true);
            //Server settings
            $mail->isSMTP();                                           
            $mail->Host       = 'smtp.gmail.com';                    
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'courtbookingjmti@gmail.com';
            $mail->Password   = 'hrvnimxkkhnlgehw';
            $mail->SMTPSecure= 'ssl';
            $mail->Port       = 465;                                    
            $mail->setFrom('courtbookingjmti@gmail.com', 'JMTI Court Booking');
            $mail->addAddress($user_email, $user_name);
            $mail->isHTML(true);
            $mail->Subject = 'Ubah Kata Laluan';
            $mail->Body = 'Anda telah meminta untuk ubah kata laluan. Klik pada pautan berikut untuk ubah kata laluan anda <a href="http://localhost/courtbookingsystem/php/passwordForgot.php?token='.$token.'">Ubah Kata Laluan</a>';
            $mail->send();
            echo "<script> alert('Semak email anda untuk ubah kata laluan anda')</script>";
    }
    else{
        echo "<script> alert('Email tidak wujud')</script>";
    }
}



?>
<body class="forgot">
    <section class="forgot-password">
        <img src="../images/logoutem.png" alt="logo" class="logo">
        <h1>Lupa Kata Laluan</h1>
        <form method="get">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            <button type="submit">Hantar</button>
        </form>
        <a href="../index.html">Kembali ruang log masuk</a>
    </section>
</body>
</html>