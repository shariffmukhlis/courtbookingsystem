<?php

session_start();
require '../php/db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

$booking_id = $_GET['booking_id'];
$sql = "DELETE FROM booking WHERE booking_id = $booking_id";
if ($conn->query($sql)===TRUE) {
    $sqlAdmin = "select * from users where user_position = 'Admin'";
    $resultAdmin = $conn->query($sqlAdmin);
    if($resultAdmin->num_rows > 0){
        while($rowAdmin = $resultAdmin->fetch_assoc()){
            $email = $rowAdmin['user_email'];
            $adminame = $rowAdmin['user_name'];
            $subject = "Tempahan dibatalkan";
            $message = "Tempahan telah dibatalkan oleh "  .$_SESSION['user_name']. ". Sila semak tempahan";
            mail($email, $subject, $message);
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
                             $mail->addAddress($email, $adminame);
                             $mail->isHTML(true);
                             $mail->Subject = $subject;
                             $mail->Body = $message;
                             $mail->send();
        }
    echo "<script>alert('Anda berjaya batalkan tempahan')</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=user_dashboard.php\">";
    }


} else {
    echo "<script>alert('Gagal batalkan tempahan')</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=user_dashboard.php\">";
}