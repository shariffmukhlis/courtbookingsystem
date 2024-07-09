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
    <title>Dashboard</title>
</head>
<body class="dashboard">    
    <?php
        include 'nav.php';
        include '../php/db.php';
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        require '../phpmailer/src/Exception.php';
        require '../phpmailer/src/PHPMailer.php';
        require '../phpmailer/src/SMTP.php';
        
        $user_id = $_SESSION['user_id'];
        
        $courtBook = $_GET['court'];

        $sqlCourt = "select * from court where court_name like '%".$_GET['court']."%'";
        $resultCourt = $conn->query($sqlCourt);
        $rowCourt = $resultCourt->fetch_assoc();
        $idCourt = $rowCourt['court_id'];

        
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

        function checkCourtStatus($court){
            include '../php/db.php';
            $sql = "select court_status from court where court_name like '%".$court."%'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            return $row['court_status'];
        }


    ?>
   
    <section class="booking-container" >
        <article class="container-left">


            <header>
                <h1>Tempahan Gelanggang</h1>
                <div class="court-type" style = "display: flex justify">
                    <img src="<?=iconCourt($courtBook)?>" alt="court icon" width="20px">
                    <h3>
                         <?=$courtBook;?>
                    </h3> 
                </div>
            </header> 
            <div class="booking-form">
                <form method="post" action=""  class="booking-form-date">
                     <label for="date-booking">Tarikh Tempah</label>
                     <input id="date" type="date" name='date' >
                     <button onclick= "searchDate()" name="cari">Cari</button>
                </form>
                <form method="post">
                <?php
                 if(isset($_POST['cari']) && !empty($_POST['date'])){
     
                     if($_POST['date'])
     
                     $_SESSION['date'] = $_POST['date'];
                     $sql = "select * from time where time_id not in (select time_id from booking where book_date = '".$_POST['date']."' and court_id = ".$idCourt.")";
                     $result = $conn->query($sql);
                     
                     if($result->num_rows > 0){
                             echo "<ul class = 'time-lists'>";
                             while($row=$result->fetch_assoc()){
                                 echo "
                                      <li class='time-list'>
                                             <h3>".$row['time']."</h3>
                                             <button type ='submit' name= 'id' value = '".$row['time_id']."'>
                                                 <span class='material-symbols-outlined'> arrow_forward_ios </span>
                                             </button>
                                      </li>
                                 ";
                             }
                             echo "</ul>";
     
                         }
                 }
     
                 if (checkCourtStatus($idCourt) == '0'){
                     echo "<script> alert('Gelanggang ini tidak aktif') </script>";
                     echo "<meta http-equiv=\"refresh\" content=\"0;URL=user_booking.php\">";
                 }
                 else{

                     if(isset($_POST['id'])){
                         $sqlBooking = "insert into booking(user_id, court_id, book_date, time_id) values ( ".$_SESSION['user_id'].", ".$idCourt.",'".$_SESSION['date']."' , ".$_POST['id'].")";
                         $result = $conn->query($sqlBooking);
         
                         $time = "select * from time where time_id = ".$_POST['id'];
                         $resultTime = $conn->query($time);
                         $rowTime = $resultTime->fetch_assoc();
                         $_SESSION['time'] = $rowTime['time'];
         
         
                         if($result){
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
                                 $mail->addAddress($_SESSION['user_email'], $_SESSION['user_name']);
                                 $mail->isHTML(true);
                                 $mail->Subject = 'Tempahan Berjaya';
                                 $mail->Body = 'Anda berjaya untuk tempah gelanggang '.$_GET['court'].' pada tarikh '.$_SESSION['date'].' pada jam '.$_SESSION['time'].'. Sila datang ke gelanggang berkenaan pada masa yang ditempah. Terima kasih';
                                 $mail->send();
                                 echo "<script> alert('Anda berjaya untuk tempah gelanggang ".$_GET['court']."') </script>";
                         }
         
                         else{
                             echo "<script> alert('Anda gagal untuk tempah gelanggang ".$_GET['court']."') </script>";
                         }

                 }
                 }
     
                ?>
             </form>
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
                                        "; 
                        }
                    }

            ?>
        </article>
    </section>

    <script>
        function searchDate(){
            let date = document.getElementById('date').value;
            if (date == ''){
                alert('Sila pilih tarikh');
            }
        }
        function bookingCourt(){
           window.confirm('Adakah anda pasti untuk tempah?');
        }
        let today = new Date()

        let year = today.getFullYear()
        let month = today.getMonth() + 1 // the months are indexed starting with 0
        let date = today.getDate()

        let dateStr = `${year}-${month}-${date}`

        let input = document.querySelector('#date')

       function deleteBooking(bookingid){
            if(confirm('Adakah anda pasti untuk membatalkan tempahan ini?')){
                window.location.href = 'delete_booking.php?booking_id='+bookingid;
            }
        } input.setAttribute('min', dateStr)
    </script>
</body>
</html>