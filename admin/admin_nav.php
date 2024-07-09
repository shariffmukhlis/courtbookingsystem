<?php

// Start the session
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: ../index.html");   
}


  echo '
     <nav>
        <img src="../images/logojmti.png" alt="logo" class="logo">
        <ul class="menu">
            <li class="menu-lists">
                <a href="admin_dashboard.php">
                    <span class="material-symbols-outlined"> home_app_logo </span>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="menu-lists">
                <a href="admin_courtsetup.php">
                    <span class="material-symbols-outlined"> sports_soccer </span>
                    <p>Gelanggang</p>
                </a>
                <a href="admin_addadmin.php">
                    <span class="material-symbols-outlined"> group_add </span>
                    <p>Tambah Admin</p>
                </a>
            </li>            
            <li class="menu-lists">
                <a href="admin_complaint.php">
                <span class="material-symbols-outlined"> view_kanban </span>
                    <p>Aduan</p>
                </a>
            </li>
            <li class="menu-lists">
                <a href="change_password.php">
                <span class="material-symbols-outlined"> settings </span>
                    <p> Ubah kata laluan </p>
                </a>
            </li>
            <li class="menu-lists ">
                <a class="container-log-out" onclick= "logout()">
                    <span class="material-symbols-outlined log-out"> logout </span>
                </a>
            </li>
        </ul>
        </nav>
        <span class="material-symbols-outlined menu menu-mobile"> menu </span>

    <script>
        function logout(){
            if(confirm("Adakah anda pasti untuk log keluar?")){
                window.location.href = "../php/logout.php";
            }
        }
        
        document.querySelector(".material-symbols-outlined.menu").addEventListener("click", function(){
            document.querySelector("nav").classList.toggle("open");
        });
        
    </script>
';
