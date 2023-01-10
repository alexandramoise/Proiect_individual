<?php

require 'dbconection.php';
include 'organizare.php';

echo "<table>";
echo '<br>'.'<br>'."<tr> <td> <h2 style='text-align: center; color: purple; font-style: italic;'>"; echo 'Formular creare produs nou'; echo "</td> </tr> </h2>"; echo'<br>';
echo "<tr> <td> <center> <form class='' action='' method='post' autocomplete='off' enctype='multipart/form-data'> </td> </tr>
        <tr> <td> <p class='text'> Numele noului produs :
        <input type='text' name='prodname' id='prodname' </p> </td> </tr>

        <tr> <td> <p class='text'> Imaginea produsului :
        <input type='file' name='image'> </p> </td> </tr>

        <tr> <td> <p class='text'>  Cantitatea disponibila ( max. 50 ):
        <input type='number' id='quantity' name='quantity' min='0' max='50' value='0'> </p> </td> </tr>

        <tr> <td> <p class='text'>  Pretul produsului ( max. 200 ):
        <input type='number' id='price' name='price' min='0' max='200' value='0'> </p> </td> </tr>
         
         <tr> <td> <p> <span class='text'> Categoria din care face parte: </span>
             <input type='radio' id='prajituri' name='cat' value='1'>
                <label for='prajituri'> Prajituri </label> 
            <input type='radio' id='patiserie' name='cat' value='2'>
                <label for='patiserie'> Patiserie </label>
            <input type='radio' id='sezon' name='cat' value='3'>
                <label for='sezon'> De Sezon </label>
        </p> </td> </tr>
        <tr> <td> <p class='text'> O scurta descriere: 
        <input type='text' name='desc' id='desc' </p> </td> </tr>

        <tr> <td> <button name='add' class='add'> Adauga </button> </td> </tr>
    </form> <center> </td> </tr>";

echo "</table";
?>


<html>

<head>
    <style>
        table {
        border-collapse: collapse;
        margin: 30px 0;
        min-width: 600px;
        min-height: 300px;
        background: white;
        border-bottom: 2px solid #B51895;
        overflow: hidden;
        box-shadow: 0 0 20px #CF3AC0;
        margin-left: auto;  
        margin-right: auto; 
    }
     .text{
        color: purple;
        font-weight: bold;
        font-style: italic;
     }
    </style>
</head>
</html>

<?php

if(isset($_POST["add"])) {
    $name = $_POST["prodname"];
    $img = $_FILES['image']['name'];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    $category = $_POST["cat"];
    $desc = $_POST["desc"];
    if(empty($name) || empty($img) || $quantity == 0 || $price == 0 || empty($category) || empty($desc)) 
        echo "<script> alert('Hei hei, nu poti lasa campuri goale'); </script>";
    else {
        if($category == 1)
            $cat = 'Prajituri';
        else if($category == 2)
            $cat = 'Patiserie';
        else if($category == 3)
            $cat = 'Sezon';
        $ins="INSERT INTO cakes VALUES('','$img','$name','$cat','$desc','$price','$quantity')";
        mysqli_query($conn, $ins);
        echo "<script> alert('S-a adaugat produsul $name'); </script>";
    }
} 
?>