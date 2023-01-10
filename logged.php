<?php

require 'dbconection.php';
include 'menu.html';
//session_start();
$user = $_SESSION["username"];
echo '<br>'.'<br>'."<h2 style='text-align: center;'>"; echo 'Bine ai venit, '; echo "<span style='color: purple';> <i> $user </i> </span>"; echo "</h2>"; echo'<br>';

if(isset($_POST["logout"])) {
    require 'dbconection.php';
    session_unset();
    session_destroy();
    unset($_SESSION["username"]);
    header("Location: login.php");
}

if(isset($_POST["orders_history"])) 
    header("Location: history.php");

if(isset($_POST["account"])) {
    header("Location: account.php");
}

?>


<html>
<head>
    <style>
        .buttons {
    color: white;
    background-color: purple;
    padding: 3px;
    text-align: center;
    font-weight: bold;
    font-size: 13px;
    border-radius: 8px;
}
    .buttons:hover{
        color: purple;
        background-color: white;
    }
    a { text-decoration: none; }
    </style>
</head>
<body>
    <center> <form class="" action="" method="post" autocomplete="off">
        <button name="logout" class="buttons"> DECONECTARE </button>
        <button name="orders_history" class="buttons"> Istoric comenzi </button> 
        <button name="account" class="buttons"> Datele contului </button> 

    </form> </center>
</body>
</html>