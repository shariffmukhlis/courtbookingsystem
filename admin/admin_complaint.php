<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="icon" href="../images/favicon-16x16.png" type="image/icon type">
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../styles/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Aduan Pengguna</title>

</head>
<body class="dashboard">    
    <?php
        include 'admin_nav.php';
        include '../php/db.php';

        $user_id = $_SESSION['user_id'];
        
        $sql = "select count(*) as totalBooking from booking where user_id = '$user_id' and book_date >= CURDATE()";
        $result = $conn->query($sql);
        $rowTotal = $result->fetch_assoc();
        $total = $rowTotal['totalBooking'];

        function iconCourt($court){
            $trimCourt = $court;
            if($trimCourt=='Badminton 1'){
                return "../images/badminton.svg";
            }
            else if($trimCourt=='Badminton 2'){
                return "../images/badminton.svg";
            }
            else if($trimCourt=='Badminton 3'){
                return "../images/badminton.svg";
            }
            else if($trimCourt=='Futsal'){
                return "../images/futsal.svg";
            }
            else if($trimCourt=='Bola Jaring'){
                return "../images/netball.svg";
            }
            else if($trimCourt=='Padang bola'){
                return "../images/football.svg";
            }
            else if($trimCourt=='Bola Takraw BR'){
                return "../images/takraw.svg";
            }
            else if($trimCourt=='Bola Takraw BK'){
                return "../images/takraw.svg";
            }
            else if($trimCourt=='Bola Tampar'){
                return "../images/volleyball.svg";
            }
        }


        function checkImageExist(){
            include '../php/db.php';
            $sql = "select * from complaint where booking_id = '".$_GET['bookid']."'";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                return $result->fetch_assoc();
            } else {
                return '';
            }
        }
      

    ?>
   
    <section class="dashboard-container">
        <article class="container-left">

            <?php
            if(isset($_GET['bookid'])){
                if(checkImageExist() != '' ){
                           echo "
                           <div class = 'complaint-info'
                           <h3> Maklumat Aduan </h3>
                           <table class = 'complaint-info'>
                               <tr>
                                   <th>Aduan:</th>
                                   <td>
                                   ".checkImageExist()['complaint_text']."
                                   </td>
                               </tr>
                               <tr>
                                   <th>Gambar Sebelum:</th>
                                   <td>
                                   <img src= '../complaint_images/".checkImageExist()['complaint_before']."' width = '100px'>
                                   </td>
                               </tr>
                               <tr>
                                   <th>Gambar Selepas:</th>
                                   <td>
                                   <img src= '../complaint_images/".checkImageExist()['complaint_after']."' width = '100px'>
                                   </td>
                               </tr>
                               </table>
                               </div>
   
   
                               ";
                       }
            }
                    ?>
            
        </article>
        <article class="container-right">
            <h5 class="booking-title">Senarai sejarah tempahan</h5>
            <ul class="booking-lists">
            <?php

                function checkImage($bookingid){
                    include '../php/db.php';
                    $sql = "select complaint_before, complaint_after from complaint where booking_id = '$bookingid'";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                        $row = $result->fetch_assoc();
                        if($row['complaint_before'] != '' && $row['complaint_after'] != ''){
                            return 'nothasImage';
                        } else {
                            return '';

                        }
                    } 
                }

                $sqlBooking= "select a.*, time as book_time, court_name, complaint_before, complaint_after from booking a NATURAL join time natural join court left join complaint b  on b.booking_id = a.booking_id group by a.booking_id order by book_date asc, time asc ";
                $resultBooking = $conn->query($sqlBooking);
                if($resultBooking->num_rows > 0){
                    while($rowBooking = $resultBooking->fetch_assoc()){
                       
                        echo "
                                <li class='booking-list'>
                                    <div class='booking-list-details'>
                                        <p class='id_book'>
                                            <img src = '
                                        ".iconCourt($rowBooking['court_name'])."' width='20'
                                        
                                        ></p>
                                        <h5 class='name-court'>".$rowBooking['court_name']."</h5>
                                        <div class='booking-list-details-time'>
                                            <p>".$rowBooking['book_time']."</p>
                                            <p>".$rowBooking['book_date']."</p>
                                        </div>
                                    </div>
                                    <div class='booking-list-setting'>
                                        <a href = 'admin_complaint.php?bookid=".$rowBooking['booking_id']."' ><span class='material-symbols-outlined'> info </span> 
                                        </a>
                                    </div>
                                </li>
                                        "; 
                        }
                    }
            ?>
        </article>
    </section>
    <script>
        function deleteBooking(bookingid){
            if(confirm('Adakah anda pasti untuk membatalkan tempahan ini?')){
                window.location.href = 'delete_booking.php?booking_id='+bookingid;
            }
        }
    </script>
</body>
</html>