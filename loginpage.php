<?php
require 'function.php';

if(!isset($_SESSION['login'])) { // "!" fungsinya adalah untuk reverse
    // Jika user sudah login, lakukan sesuatu di sini
} else {
    header('Location: index.php'); // Redirect ke halaman login jika tidak ada session login
    exit; // Pastikan skrip berhenti setelah melakukan redirect
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/styleloginpage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
    
        <form method="post">
            <div class="login-container">
                <div class="login-header">LOGIN</div>
                <form action="#" method="post">
                    <div class="text-username" for="username">Username:</div>
                    <input type="text" name="username" placeholder="Masukkan Username" required ><br>
                    <div class="text-password" for="password">Password:</div>
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <input type="password" name="password" placeholder="Masukkan Password" required><br>
                        <button type="submit" name="login">LOGIN</button> 
                    </div>      
                </form> 
            </div> 
        </form>    
</body>
</html>
