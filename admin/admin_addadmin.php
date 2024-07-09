
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- Option 1: Include in HTML -->
    <link rel="icon" href="../images/favicon-16x16.png" type="image/icon type">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../styles/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Tambah Admin</title>

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


        
    ?> 
    <section class="dashboard-container admin-dashboard-container">
        <article class="container left">
            <header>
                <h3>Penambahan Admin</h3>
            </header>
            <form class="formstandard" action="addadmin.php" method="post">
                <label for="name">Nama</label>
                <input id= 'name' type="text" name="nama" placeholder="Nama">
                <label for="email"  >Email</label>
                <input id="email" type="email" name="email" placeholder="Email">
                <label for="phoneno">No Tel</label>
                <input type="text" name="phoneno" placeholder="No Tel">
                <label for="password">Katalaluan</label>
                <input type="password" name="password" placeholder="Katalaluan">
                <label for="password2">Pengesahan Katalaluan</label>
                <input type="password" name="password2" placeholder="Pengesahan Katalaluan">
                <button type="submit" name="login">Daftar</button>
            </form>
        </article>
        <article class="container-right">
            <h5 class="booking-title">Senarai Admin</h5>
            <ul class="booking-lists">
            <?php
                $sqlBooking= "select * from users where user_position = 'Admin'";
                $resultBooking = $conn->query($sqlBooking);
                if($resultBooking->num_rows > 0){
                    while($rowBooking = $resultBooking->fetch_assoc()){
                        echo "
                                <li class='booking-list'>
                                    <div class='booking-list-details'>
                                        <h5 class='name-court'>".$rowBooking['user_name']."</h5>
                                        <div class='booking-list-details-time'>
                                            <p>".$rowBooking['user_email']."</p>
                                        </div>
                                    </div>
                                    <div class='booking-list-setting'>
                                    </div>
                                        "; 
                        }
                    }

            ?>
        </article>
    </section>


</body>
</html>
