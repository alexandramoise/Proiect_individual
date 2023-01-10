<?php
require 'dbconection.php';
include 'menu.html'; 

$user = $_SESSION["username"];
$history = mysqli_query($conn,"SELECT * FROM orders where user = '$user'");
$count = 0;
echo '<br>'."<h2 style='text-align: center;'>"; echo 'Istoric comenzi'; echo "<span style='color: purple; font-style: italic;'> $user </span> </h2>";
    if($history->num_rows > 0) {
        echo "<table class='tabel'>";
        echo "<thead>";
                echo "<th> Data </th>";
                echo "<th> Produse </th>";
                echo "<th> Pret </th>";
       echo  "</thead>";        
    while($row = $history->fetch_assoc()) {
            echo "<tr>";
                echo "<td>"; echo $row['date'];  echo "</td>";
                echo "<td>"; echo $row['products'];  echo "</td>";
                echo "<td>"; echo $row['price'].' lei'; echo "</td>";
            echo "</tr>"; 
            $count++;
        }
        echo "<tr> <td class='border'> </td> <td class='border'> Numar comenzi: $count </td> <td class='border'> </td> </tr>";
        echo "<tr> <td> </td> <td> </td> <td> </td> </tr> <tr> <td> </td> <td> </td> <td> </td> </tr> <tr> <td> </td> <td> </td> <td> </td> </tr>";
        echo "<tr> <td> </td> <td> <form class='' action='' method='post' autocomplete='off'>
        <button name='back' class='buttons'> Inapoi la cont </button> </form> </td> <td> </td> </tr>";
    }
    else
        { echo '<br>'.'<br>'."<h2 style='text-align: center;'>"; echo 'Inca nu ati depus nicio comanda.'; echo "</h2>"; echo'<br>'; }


if(isset($_POST["back"])) 
    header("Location: logged.php");
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
table {
    margin-left: auto;
    margin-right: auto;
    background: white;
    text-align: center;
    font-size: 1.5em;
    min-width: 800px;
}
thead {
    background: purple; 
    color: white;
}
.border {
    border-top: 3px dotted purple;
}
        </style>
</head>
<body>
     
</body>

</html>