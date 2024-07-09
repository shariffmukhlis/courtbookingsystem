<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../styles/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
    
<body class="dashboard">    
    <?php
        include 'admin_nav.php';
        include '../php/db.php';

        $user_id = $_SESSION['user_id'];
        
        $sql = "select count(*) as totalBooking from booking where book_date >= CURDATE()";
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


        function infoBooking ($booking_id){
            include '../php/db.php';
            $sql = "select a.*, b.user_name, b.user_matricno, c.time from booking a natural join users b natural join time c where booking_id = '$booking_id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            echo "<script>
                    alert('".$row['user_name']." dengan matrik no ".$row['user_matricno']." telah membuat tempahan pada ".$row['book_date']." jam ".$row['time']." untuk gelanggang ".$row['court_name']."');
                </script>";
        }

    ?>
   
    <section class="dashboard-container admin-dashboard-container">
        <article class="container left">
            <header>
                <h3>Selamat Sejahtera, <?=$_SESSION['user_name'] ?> </h3>
            </header>
            <div class="information">
                <title>Information</title>
                <table class="info">
                    <tr>
                        <td>Name</td>
                        <td>: <?=$_SESSION['user_name']?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>: <?=$_SESSION['user_email']?></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>: <?=$_SESSION['user_phone']?></td>
                    </tr>
                    <tr>
                        <td>Role</td>
                        <td>: <?=$_SESSION['user_position']?></td>
                    </tr>
                </table>
                <div class="info-booking">
                  <p>Gelanggang mempunyai</p>  
                  <h3><?=$total?></h3>
                  <p>Tempahan</p>
                </div>
            </div>
            <div class="rules">
                <h4>Peraturan Tempahan</h4>
                <ol>
                    <li>Hanya yang mempunyai akaun sahaja yang boleh membuat tempahan</li>
                    <li>Tempahan hanya boleh dibuat pada masa yang disediakan oleh pihak fakulti</li>
                    <li>Tempahan dibuat boleh dibatalkan jika terdapat perubahan</li>
                </ol>
            </div>
        </article>
        <article class="container-right">
            <h5 class="booking-title">Senarai tempahan</h5>
            <ul class="booking-lists">
            <?php
                $sqlBooking= "select a.*, time as book_time, court_name, b.user_id, b.user_name, b.user_matricno from booking a NATURAL join time natural join court natural join users b where book_date >= CURDATE() order by book_date asc, time asc";
                $resultBooking = $conn->query($sqlBooking);
                if($resultBooking->num_rows > 0){
                    while($rowBooking = $resultBooking->fetch_assoc()){
                        echo "
                                <li class='booking-list'>
                                    <div class='booking-list-details'>
                                        <span class='id_book'>
                                            <img src = ' ".iconCourt($rowBooking['court_name'])."' width='20'>
                                            <span> ".$rowBooking['user_name']."</span>
                                            <span> ".$rowBooking['user_matricno']."</span>
                                        </span>
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