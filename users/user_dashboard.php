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

</head>
    
<body class="dashboard">    
    <?php
        include 'nav.php';
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

    ?>
   
    <section class="dashboard-container">
        <article class="container left">
            <header>
                <?php
                    if($_SESSION['user_position'] == 'Student'){
                        
                        
                        ?>
                <p class="matricno"> <?=$_SESSION['user_matricno']; ?></p>
                
                <?php
                    }
                    ?>
                <h3>Selamat Sejahtera, <?=$_SESSION['user_name'] ?> </h3>
                <p>Selamat untuk membuat tempahan gelanggang! </p>
                <div class="location">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16"> <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/> </svg>
                
                    <p>59, Lorong Bukit Minyak 15, Kawasan Perindustrian Bukit Minyak, 14100 Bukit Mertajam, Pulau Pinang</p>
                </div>
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
                  <p>Anda mempunyai</p>  
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
                    <li>Keadaan gelanggang perlu ditangkap sebelum dan selepas digunakan</li>
                </ol>
            </div>
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