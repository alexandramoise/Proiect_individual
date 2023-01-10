<?php

include 'menu.html';

 require 'dbconection.php';
 if(isset($_POST["submit"])){
     $name= $_POST["name"];
     $username= $_POST["username"];
     $email= $_POST["email"];
     $password= $_POST["password"];
     $confirmpassword= $_POST["confirmpassword"];
     if(empty($name) || empty($username) || empty($email) || empty($password) || empty($confirmpassword))
        echo "<script> alert('Hei hei, nu poti lasa campuri goale'); </script>";
     else {
     $duplicate1=mysqli_query($conn, "SELECT * FROM customers WHERE username='$username'");
     $duplicate2=mysqli_query($conn, "SELECT * FROM customers WHERE email='$email'");
     if(mysqli_num_rows($duplicate1)>0){
         echo
         "<script> alert('Ups, numele de utilizator apartine deja cuiva!'); </script>";
     }
     else if (mysqli_num_rows($duplicate2)>0) {
        echo "<script> alert('Ups, acest email este deja utilizat'); </script>";
     }
     else{
         if($password==$confirmpassword){
             $query="INSERT INTO customers VALUES('','$name', '$username', '$email', '$password')";
             mysqli_query($conn, $query);
             echo "<script> alert('Felicitari, cont creat cu succes! :)'); </script>";
             header("Location: login.php");
         }
         else{
             echo
             "<script> alert('Of, parola si confirmarea sunt diferite :('); </script>";
         }
     }
    }
 }

 if(isset($_POST["login"])){
    header("Location: login.php");
 }
?>

<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="UFT-8">
     <meta http-equiv="X-UA-Compatible" content="IE-edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="cont.css">

 </head>
 <body>

     <br>

     <table>
        <form class="" action="" method="post" autocomplete="off"> 
        <th> Creare cont <i> Client </i> </th>

        <tr>
            <td> Introduceți <i style="color: #cc0099;"> numele dvs: </i> </td>
            <td> <input type="text" name="name" id="name" style="font-weight: bold; color: #cc0099;"> </td>
        </tr>

        <tr>
            <td> Introduceți un <i style="color: #cc0099;"> nume de utilizator: </i> </td>
            <td> <input type="text" name="username" id="username" style="font-weight: bold; color: #cc0099;"> </td>
        </tr>

        <tr>
            <td> Introduceți o <i style="color: #cc0099;"> adresa de mail: </i> </td>
            <td> <input type="email" name="email" id="email" style="font-weight: bold; color: #cc0099;"> </td>
        </tr>
        <tr>
            <td> Introduceți <i style="color: #cc0099;"> parola: </i> </td>
            <td> <input type="password" name="password" id="password" style="font-weight: bold; color: #cc0099;">
        </tr>

        <tr>
            <td> Introduceți <i style="color: #cc0099;"> confirmarea parolei: </i> </td>
            <td> <input type="password" name="confirmpassword" id="confirmpassword" style="font-weight: bold; color: #cc0099;"> <br> <input type="checkbox" onclick="myFunction()"> afiseaza parola </td>
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
            <td> Vrei sa te conectezi la un <i style="color: #cc0099;"> cont deja existent? </i> </td>
            <td> <input type="submit" name="login" value="Conectare"> </td>
        </tr>

        </form>
</table>


    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
            var y = document.getElementById("confirmpassword");
            if (y.type === "password") {
                y.type = "text";
            } else {
                y.type = "password";
            }
        }
</script>
</body>
</html>