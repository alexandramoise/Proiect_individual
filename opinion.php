<?php

require 'dbconection.php';
include 'menu.html';

$user = $_SESSION["username"];
$users = mysqli_query($conn,"SELECT * FROM customers WHERE username = '$user'");
$name = '';
if($users->num_rows > 0) {
    while($r = $users->fetch_assoc()) 
        $name = $r['name'];
}

echo "<table>";
echo '<br>'.'<br>'."<tr> <td> <h2 style='text-align: center; color: purple; font-style: italic;'>"; echo 'Formular plasare recenzii'; echo "</td> </tr> </h2>"; echo'<br>';
echo "<tr> <td> <center> <form class='' action='' method='post' autocomplete='off'> 
        <p> Spune-ne o parere scurta : <br>
        <textarea name='opinion' id='opinion' rows='3' cols='25' placeholder='Parerea mea despre patiserie...'> </textarea>' </p>
        <p>  Acorda un numar de stele: <br>
        <input type='range' id='stars' name='stars' 
         min='0' max='5' value='0' step='1' oninput='out_stars.value = stars.value'> 
         <output id='out_stars'></output>
         </p>
         <button name='send' class='send'> Posteaza </button>
    </form> <center> </td> </tr>";

echo "</table";
?>

<html>

<head>

<style>
    table {
        border-collapse: collapse;
        margin: 30px 0;
        min-width: 400px;
        min-height: 200px;
        background: white;
        border-bottom: 2px solid #B51895;
        overflow: hidden;
        box-shadow: 0 0 20px #CF3AC0;
        margin-left: auto;  
        margin-right: auto; 
    }
    .send {
    color: white;
    background-color: purple;
    padding: 3px;
    text-align: center;
    font-weight: bold;
    font-size: 13px;
    border-radius: 8px;
}

.send:hover {
    background-color: white;
    color: purple;
}
</style>
</head>
</html>


<?php

if(isset($_POST["send"])) {
    $comm = $_POST["opinion"];
    $stars = $_POST["stars"];
    $date = date('Y-m-d');
    if(empty($comm) || $stars == 0)
        echo "<script> alert('Hei hei, nu poti lasa campuri goale'); </script>";
    else {
        $place_review="INSERT INTO reviews VALUES('','$name','$user','$date','$comm','$stars')";
        mysqli_query($conn, $place_review);
        echo "<script> alert('Multumim pentru parare,$name'); </script>";
    }
}
?>