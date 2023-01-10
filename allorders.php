<?php

require 'dbconection.php';
include 'organizare.php'; 

$result = mysqli_query($conn,"SELECT * FROM orders");
echo '<br>'.'<br>'."<h2 style='text-align: center; font-weight: bold;'>"; echo "<span style='color: purple'> Toate </span> comenzile ";

if($result->num_rows > 0) {
    echo "<table>";
    echo "<thead>";
         echo "<th> Nume  </th>";
         echo "<th> Data comanda </th>";
         echo "<th> Produse comandate </th>";
         echo "<th> Adresa </th>";
         echo "<th> Telefon </th>";
         echo "<th> Pret </th>";
    echo  "</thead>";        
    while($row = $result->fetch_assoc()) {
        $id = $row['order_id'];
        echo "<tr style='height: 50px;'>";
        echo "<td>".$row['user']."</td> ";
        echo "<td>".$row['date']."</td> ";
        echo "<td>".$row['products']."</td> ";
        echo "<td>".$row['location']."</td> ";
        echo "<td>".$row['phone']."</td> ";
        echo "<td>".$row['price']."</td> ";
    echo "</tr>";  
    }
    echo "</table>";
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
    font-size: 1em;
    min-width: 300px;
}
thead {
    background: purple; 
    color: white;
}
td{
    border-bottom: 1px solid purple;
    border-left: 0.5px solid purple;
    border-right: 0.5px solid purple;
}
.buttons {
    color: white;
    background-color: purple;
    padding: 3px;
    text-align: center;
    font-weight: bold;
    font-size: 13px;
    border-radius: 8px;
}

.buttons:hover {
    background-color: white;
    color: purple;
}
    </style>
</head>

</html>