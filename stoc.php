<?php

require 'dbconection.php';
include 'organizare.php';

$result = mysqli_query($conn,"SELECT * FROM cakes");
echo '<br>'.'<br>'."<h2 style='text-align: center; font-weight: bold;'>"; echo "<span style='color: purple'>STOC </span>: Se regasesc "."<span style='color: purple';>".$result->num_rows.' </span> produse'; 
echo "<br> <br> <a class='add' href='addprod.php'> Adauga un produs </a> </h2>"; echo'<br>';
 if($result->num_rows > 0) {
    echo "<table>";
    echo "<thead>";
         echo "<th> Nume Produs </th>";
         echo "<th> Cantitate in stoc </th>";
         echo "<th> Pret Produs</th>";
    echo  "</thead>";        
    while($row = $result->fetch_assoc()) {
                $id = $row['id']; 
                $name = $row['name'];
                echo "<tr style='height: 50px'>";
                    echo "<td class='prod'>"; echo $row['name']."</td>";
                    echo "<td>"; echo $row['pieces']."</td>";
                    echo "<td>"; echo $row['price'].' lei'."</td>";
                    echo "<td class='delete'> <form class='' action='' method='post' autocomplete='off'> 
                            <button name='deleted' class='buttons'> Sterge $name </button>
                            <input type='hidden' name='prodcode' value='$id'>
                            </form> </td>";
                echo "</tr>"; 
                
    }

    if(isset($_POST["deleted"])) {
        $code = $_POST["prodcode"];
        $check = mysqli_query($conn,"SELECT * FROM cakes WHERE id = $code");
        if($check->num_rows > 0) {
            while($r = $check->fetch_assoc()) {
                 $prod_name = $r['name'];
             }
        }
        echo "<script> alert('Se va sterge produsul $prod_name') </script>";
        $delete_prod = mysqli_multi_query($conn,"DELETE FROM cakes WHERE id = $code");
    }
}
else {
    echo '<br>'.'<br>'."<h2 style='text-align: center;'>"; echo 'Niciun produs in stoc.'; echo "</h2>"; echo'<br>';
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
    min-width: 800px;
}
thead {
    background: purple; 
    color: white;
}
td{
    border-bottom: 1px solid purple;
}

.prod {
    font-weight: bold;
}

.delete {
    border-left: 1px solid purple;
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