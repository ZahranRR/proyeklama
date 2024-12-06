<?php
session_start(); // Memulai session

require 'function.php'; 

if(isset($_SESSION['login'])) {
    // Jika user sudah login, lakukan sesuatu di sini
} else {
    header('Location: loginpage.php'); // Redirect ke halaman login jika tidak ada session login
    exit; // Pastikan skrip berhenti setelah melakukan redirect
}
?>
