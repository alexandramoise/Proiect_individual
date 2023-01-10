<?php
require 'dbconection.php';
include 'organizare.php';

$result = mysqli_query($conn,"SELECT * FROM orders WHERE status = 'Asteptare'");
echo '<br>'.'<br>'."<h2 style='text-align: center; font-weight: bold;'>"; echo "<span style='color: purple'>Comenzi in asteptare </span>: Se regasesc "."<span style='color: purple';>".$result->num_rows.' </span>'; 
echo "<br> <br> <a class='add' href='allorders.php'> Vezi toate comenzile </a> </h2>"; echo'<br>'; 

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
        echo "<td> <form class='' action='' method='post' autocomplete='off'> 
                            <button name='done' class='buttons'> Livrare </button>
                            <input type='hidden' name='prodcode' value='$id'>
                            </form> </td>";
         
    echo "</tr>";  
    }
    echo "</table>";
 }
 else {
    echo '<br>'.'<br>'."<h2 style='text-align: center;'>"; echo 'Nicio comanda in asteptare'; echo "</h2>"; echo'<br>';
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
.add:link, .add:visited {
  background-color: white;
  color: purple;
  padding: 5px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  border-radius: 8px;
}

.add:hover, .add:active {
  background-color: purple;
  color: white;
}
    </style>
</head>

</html>

<?php
if(isset($_POST["done"])) {
    $cod = $_POST["prodcode"];
    $res = mysqli_query($conn,"SELECT * FROM orders WHERE order_id = $cod");
    if($res->num_rows>0) {
        while($r = $res->fetch_assoc()) {
            $user = $r['user'];
        }
    }
    $order = mysqli_multi_query($conn,"UPDATE orders SET status = 'Livrare' WHERE order_id = $cod");
    echo "<script> alert('Comanda cu id-ul $cod a clientului $user va fi livrata!'); </script>";
}
?>