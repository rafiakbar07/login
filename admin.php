<?php
//memulai session atau melanjutkan session yang sudah ada
session_start();

//check apakah ada variable username yang tersimpan pada session
if (isset($_SESSION['username'])) {
		//jika ada, tampilkan greeting
    echo "Selamat Datang ".$_SESSION['username']."<a href='./logout.php'>LOGOUT</a>";
}else{
		//jika tidak ada, alihkan ke halaman login
    header("location:login.php"); 
}

?>