

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- Option 1: Include in HTML -->
    <link rel="icon" href="../images/favicon-16x16.png" type="image/icon type">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../styles/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Suntingan Status Gelanggang</title>

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

        function courtStatus ($status){
            //change icon by status, if status is 1, show green icon, if status is 0, show red icon
            if($status == 1){
                return "<i class='bi bi-circle-fill' style='color: green;'></i>";
            }
            else if($status == 0){
                return "<i class='bi bi-circle-fill' style='color: red;'></i>";
            }
        }

    ?>
   
    <section class="dashboard-container admin-dashboard-container">
        <article class="container left">
            <header>
                <h3>Status Gelanggang</h3>
            </header>
            <table class="list-court">
                <tr>
                    <th>Senarai Gelanggang</th>
                    <th> Status </th>
                </tr>
                <?php 
                    $sqlCourt = "select * from court";
                    $resultCourt = $conn->query($sqlCourt);
                    if($resultCourt->num_rows > 0){
                        while($rowCourt = $resultCourt->fetch_assoc()){
                            echo "
                                <tr>
                                    <td>".$rowCourt['court_name']."</td>
                                    <td> <a href = updatecourt.php?court_id=".$rowCourt['court_id']."> ".courtStatus($rowCourt['court_status'])."</a></td>
                                </tr>
                            ";
                        }
                    }

                ?>

            </table>
        </article>
        <article class="container-right">
            <h5 class="booking-title">Senarai jumlah tempahan</h5>
            <ul class="booking-lists">
            <?php
                $sqlBooking= "select a.court_name ,count(b.court_id) as total from court a left join booking b on a.court_id = b.court_id group by a.court_id ";
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
                                    </div>
                                    <div class='booking-list-setting'>
                                        <p>".$rowBooking['total']." </p>
                                    </div>
                                </li>
                                        "; 
                        }
                    }

            ?>
        </article>
    </section>
    <script>
        function infoBooking(bookingId) {
            $.ajax({
                url: 'info_booking.php',
                method: 'POST',
                data: { booking_id: bookingId },
                success: function(response) {
                    alert(response);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    </script>
</body>
</html>
