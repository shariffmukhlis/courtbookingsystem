<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="icon" href="../images/favicon-16x16.png" type="image/icon type">
    <title>Sistem Tempahan Gelanggang JMTI</title>
</head>
<body class="index-body">
    <section class="container-left">
        <article>
            <img class="logo" src="../images/logojmti.png" alt="logo JMTI">
            <form method='post' action="registerDB.php" >
                <label for="name">Nama</label>
                <input type="text" name="nama" placeholder="Nama">
                <label for="usertype">Peranan</label>
                <select id="usertype" name="usertype">
                    <option value="Staff">Staff</option>
                    <option value="Student">Student</option>
                </select>
                <label for="matricno">Matric No</label>
                <input type="text" name="matricno" placeholder="Matric No">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Email">
                <label for="phoneno">No Tel</label>
                <input type="text" name="phoneno" placeholder="No Tel">
                <label for="password">Katalaluan</label>
                <input type="password" name="password" placeholder="Katalaluan">
                <label for="password2">Pengesahan Katalaluan</label>
                <input type="password" name="password2" placeholder="Pengesahan Katalaluan">
                <button type="submit" name="login">Daftar</button>
            </form>
            <p class="daftar">Klik <a href="../index.html">di sini</a> untuk log masuk</p>
        </article>
    </section>
    <section class="container-right">
        <article>
            <header class="title">
                <h1>Sistem Tempahan Gelanggang JMTI</h1>
            </header>
            <p>Sistem Tempahan Gelanggang JMTI adalah sistem tempahan bagi pelajar dan staf JMTI untuk membuat tempahan gelanggang terdiri daripada gelanggang badminton, bola tampar, futsal, padang bola, sepak takraw, dan bola jaring.</p>
            
        </article>
    </section>
    <script>

        //if the user select usertype as staff, the matric no input will be disabled
        document.getElementById('usertype').addEventListener('change', function(){
            if(this.value == 'Staff'){
                document.querySelector('input[name="matricno"]').disabled = true;
            }else{
                document.querySelector('input[name="matricno"]').disabled = false;
            }
        });
    </script>
</body>
</html>