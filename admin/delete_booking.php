<?php

require '../php/db.php';
 use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

$booking_id = $_GET['booking_id'];
$sql = "DELETE FROM booking WHERE booking_id = $booking_id";
if ($conn->query($sql)===TRUE) {
    echo "<script>alert('Anda berjaya batalkan tempahan')</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=admin_dashboard.php\">";
    }
 else {
    echo "<script>alert('Gagal batalkan tempahan')</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=admin_dashboard.php\">";
}