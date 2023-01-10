<?php

require 'dbconection.php';
include 'menu.html';

echo '<br>'."<h2 style='text-align: center; font-style: italic;'>"; echo "<span style='color: purple; text-shadow: 2px 1px white;'> Pareri </span>"; echo 'ale clientilor'.'</h2> <br> <br>';

$result = mysqli_query($conn,"SELECT * FROM reviews ORDER BY data DESC");
        if($result->num_rows > 0) {
            echo "<table class='tabel'>";
        echo "<thead>";
                echo "<th> Nume Utilizator </th>";
                echo "<th> Data </th>";
                echo "<th> Comentariu </th>";
                echo "<th> Stele acordate </th>";
       echo  "</thead>";        
       $sum = 0;
    while($row = $result->fetch_assoc()) {
            echo "<tr>";
                echo "<td class='user'>"; echo $row['name'];  echo "</td>";
                echo "<td>"; echo $row['data'];  echo "</td>";
                echo "<td class='zoom'>"; echo $row['comment'];
                    echo "</td>";
                echo "<td class='stars'>"; echo $row['stars'].'&#11088;'; echo "</td>";
            echo "</tr>"; 
            $sum += $row['stars'];
        }
        $avg = round($sum / $result->num_rows,2);
        $stars = $avg.'&#11088;';
        echo "<tr> <td> </td> <td class='user'> Nota medie a patiseriei: ".$stars." </td> <td> </td> </tr>";
    }

    if(isset($_SESSION["username"])) {
    $user = $_SESSION["username"];
    $can = mysqli_query($conn,"SELECT * FROM orders WHERE user = '$user'");
    if($can->num_rows > 0) {
        echo "<h3 style='text-align: center;' > Multumim pt incredere: ai depus in total <span style='font-weight: bold; color: purple;'>". $can->num_rows."</span> comenzi </h3>".'<br>';
        echo "<h3 style='text-align: center; '> Poti lasa chiar tu o recenzie daca apesi <a href='opinion.php'> aici </a> </h3> ".'<br>';
    }
    else
        echo "<h3 style='text-align: center; '> Pt a lasa o parere, trebuie sa plasezi o comanda </h3> ".'<br>';
    }
?>

<html>

<head>
<style>
    table {
    margin-left: auto;
    margin-right: auto;
    background: white;
    text-align: center;
    font-size: 1.3em;
    min-width: 400px;
    border: 1px solid black;
}
    thead {
    background: purple; 
    color: white;
    font-style: italic;
}
    table,th,td {
        border-collapse: collapse;
        border-bottom: 2px solid purple;
    }

    .user {
        font-weight: bold;
        color: purple;
    }

    .zoom {
        height: 50px;
        overflow: hidden;
}

    .zoom:hover {
        transform: scale(1.1);
        color: purple;
}
    .stars {
        height: 50px;
        overflow: hidden;
    }

    .stars:hover {
        color: orange;
        transform: scale(1.2);
   }
</style>
</head>

</html>