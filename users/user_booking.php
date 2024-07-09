<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="icon" href="../images/favicon-16x16.png" type="image/icon type">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Dashboard</title>
</head>
<body class="dashboard">    
    <?php
        include 'nav.php';
        include '../php/db.php';

        $user_id = $_SESSION['user_id'];
        
        $sql = "select count(*) as totalBooking from booking where user_id = '$user_id'";
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

    ?>


   
    <section class="booking-container" >
        <article class="container-left">
            <h1>Tempahan Gelanggang</h1> 
            <ul class="court-lists">

            <?php
                $sqlCourt = "select * from court";
                $resultCourt = $conn->query($sqlCourt);
                if($resultCourt->num_rows > 0){
                    while($rowCourt = $resultCourt->fetch_assoc()){
                        if ($rowCourt['court_status'] == 1 )
                        {
                            $class = 'available';
                        }
                        else{
                            $class = 'not-available';
                        }
                        echo "
                            <li>
                                <a class='".$class."' href='userBookingDetail.php?court=".$rowCourt['court_name']."'>
                                    <img src = '".iconCourt($rowCourt['court_name'])."' alt='' class='icon-court'>
                                    <p>".$rowCourt['court_name']."</p>
                                </a>
                            </li>
                        ";
                    }
                }


            ?>
            </ul>
        </article>
        <article class="container-right">
            <h5 class="booking-title">Senarai tempahan</h5>
            <ul class="booking-lists">
            <?php
                $sqlBooking= "select a.*, time as book_time, court_name from booking a NATURAL join time natural join court where user_id = '$user_id' and book_date >= CURDATE() order by book_date asc, time asc";
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
                                        <a style ='cursor:pointer;' onclick = 'deleteBooking(".$rowBooking['booking_id'].")' ><span class='material-symbols-outlined'> delete </span> 
                                        </a>
                                    </div>
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
        } input.setAttribute('min', dateStr)
    </script>
</body>
</html>