<?php

echo "PAGINA DE VIZUALIZARE RECENZII <br> <br>";
require 'dbconection.php';
$result = mysqli_query($conn,"SELECT * FROM reviews");
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo 'User '.$row["name"].' '.$row["username"].' said '.$row["comment"].' number of stars '.$row["stars"]."<br>";
            }
        }



#include 'menu.html'
?>