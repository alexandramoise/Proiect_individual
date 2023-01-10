<?php 
require 'dbconection.php';

include 'menu.html';

if(isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if(empty($username) || empty($password))
        echo "<script> alert('Hei hei, nu poti lasa campuri necompletate ;) '); </script>";
    else {
        $result = mysqli_query($conn,"SELECT * FROM customers WHERE username = '$username'");
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) > 0) {
        if($password == $row["password"]) {
            $_SESSION["login"] = true;
            $id_client = $row["id"];
            echo "<script> alert('Client $id_client conectat cu succes! '); </script>";
            $_SESSION["username"] = $row["username"]; 
            header("Location: logged.php");
        }
        else {
            echo "<script> alert('Parola nu corespunde contului introdus :( '); </script>";
        }
    }
    else {
        echo "<script> alert('Acest cont de client nu a fost inregistrat!'); </script>";
    }
    }
}

if(isset($_POST["register"])) {
    header("Location: register.php");
}
?>

<!DOCTYPE html>
<html lang="en">
 <head>
     <meta charset="UFT-8">
     <meta http-equiv="X-UA-Compatible" content="IE-edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="cont.css">

     <style>
        a { text-decoration: none; }
    </style>
 </head>
 <body>

    <table>
        <form class="" action="" method="post" autocomplete="off"> 
        <th> Conectare <i> Client </i> </th>
        <tr>
            <td> Introduceți <i style="color: #cc0099;"> numele de utilizator: </i> </td>
            <td> <input type="text" name="username" id="username" style="font-weight: bold; color: #cc0099;"> </td>
        </tr>

        <tr>
            <td> Introduceți <i style="color: #cc0099;"> parola: </i> </td>
            <td> <input type="password" name="password" id="password" style="font-weight: bold; color: #cc0099;"> <br> <input type="checkbox" onclick="myFunction()"> afiseaza parola </td>
        </tr>

        <tr> <td> </td> <td> </td> </tr> <tr> <td> </td> <td> </td> </tr>

        <tr> 
            <td> Dacă vrei să <i style="color: #cc0099;"> ștergi </i> datele introduse: </td>
            <td> <input type="reset" value="Anuleaza"> </td>
        </tr>

        <tr> 
            <td> Dacă vrei să <i style="color: #cc0099;"> confirmi </i> datele introduse: </td>
            <td> <input type="submit" name="submit" value="Confirma"> </td>
        </tr>

        <tr> <td> </td> <td> </td> </tr> 

        <tr>
            <td> Vrei sa creezi un <i style="color: #cc0099;"> cont nou? </i> </td>
            <td> <input type="submit" name="register" value="Creare"> </td>
        </tr>

    </form>


    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
</script>
</body>
</html>