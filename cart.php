<html>
<head>
    <link rel="stylesheet" href="cart.css">
</head>
<body>
       
    
    <?php
    include 'dbconection.php';
    include 'menu.html';
    if(isset($_SESSION["username"])) {
    $user = $_SESSION["username"];
    echo '<br>'.'<br>'."<h2 style='text-align: center;'>"; echo 'Cosul utilizatorului '; echo "<p style='color: purple';> <i> $user </i> </p>"; echo "</h2>"; echo'<br>';
    $cost = 0;
    $produse = "";
    $full = true;
    $cart = mysqli_query($conn,"SELECT * FROM cart WHERE user = '$user'");
    if($cart->num_rows == 0)
         { $full = false;
            echo '<br>'."<h3 style='text-align: center;'>"; echo 'Cosul tau este'; echo "<span style='color: purple; text-shadow: 1px 1px white;'> GOL </span>"; }
    else {
    echo "<table class='tabel'>";
        echo "<thead>";
                echo "<th> Nume Produs </th>";
                echo "<th> Cantitate Produs </th>";
                echo "<th> Cost Produs </th>";
       echo  "</thead>";        
    while($row = $cart->fetch_assoc()) {
            echo "<tr>";
                 $id = $row['product_id'];
                 $name = $row['name'];
                 $pieces = $row['quantity'];
                echo "<td class='product'>"; echo $row['name'];  echo "</td>";
                echo "<td class='border'>"; echo $row['quantity'];
                    echo "</td>";
                echo "<td class='product'>"; echo $row['price']; echo "</td>";
                echo "<td class='product'> <form class='' action='' method='post' autocomplete='off'> 
                            <button name='delete' class='order'> STERGE </button>
                            <input type='hidden' name='prodcode' value='$id'>
                            <input type='hidden' name='pieces' value='$pieces'>
                            </form> </td>";
                $cost += $row['price'];
                $produse = $produse.' '.$row['name'].' *'.$row['quantity'].' / ';
            echo "</tr>"; 
     }
    echo "<tr> <td class='price'> </td> 
               <td class='price'> TOTAL: "; echo $cost.' lei'; echo "<td 
               <td class='price'> <form class='' action='' method='post' autocomplete='off'>
                                  <button name='order' class='order'> LIVRARE </button> 
                                  <input type='hidden' name='products' value='$produse'> </form> </td> 
        
                <td class='price'> </td>
                </tr> ";
         echo "</table>";
    }
echo "</body>";
    if(isset($_POST["delete"])) {
        $delete_prod = mysqli_multi_query($conn,"DELETE FROM cart WHERE product_id = $id");
        $update_stock = mysqli_query($conn,"UPDATE cakes SET pieces = pieces + $pieces WHERE id = $id");
        echo "<script> alert('Produsul $name a fost sters din cosul tau, $user') </script>";
    }

    if(isset($_POST["order"]) && $full == true) {
        echo '<br>'.'<br>'."<h2 style='text-align: center'>  Pret produse comanda: ".$cost.' lei'."</h2>".'<br>';
        echo "<center> <form class='' action='' method='post' autocomplete='off'>
                <h4> Alege metoda de livrare: </h4>
                <input type='radio' id='free' name='delivery' value='1'>
                <label for='free'> Ridicare la patiserie </label> <br> 
                <input type='radio' id='pay' name='delivery' value='2'>
                <label for='pay'> Livrare la domiciliu </label> <br>
                <button name='confirm' class='order'> Confirma </button>
                </form> </center>";
    }

    if(isset($_POST["confirm"])) {
        if($_POST['delivery'] == 1) {
            echo '<br>'.'<br>'."<h3 style='text-align: center;'>"; echo 'Te asteptam! <3 '.'<br>'.'Pretul ramane '.$cost.' lei'; echo "</h3>"; echo'<br>';
            echo "<center> <form class='' action='' method='post' autocomplete='off'>
            <input type='hidden' name='adress' value='La Patiserie'> 
            <p> Introduceti nr de telefon: </p> <input type='text' name='phone' id='phone'>
            <input type='hidden' name='money' value='$cost'> 
            <input type='hidden' name='products' value='$produse'> <br>
            <button name='place_order' class='order'> Plaseaza comanda </button>
            </form> </center>";
        }
        else if($_POST['delivery'] == 2) {
            $new_cost = $cost + 5;
            $now = date("H:i");
            $hour = date("H:i", strtotime('+4 hours', strtotime($now)));
            echo '<br>'.'<br>'."<h3 style='text-align: center;'>"; echo 'Comanda va fi livrata in 3 ore, in jurul orei '.$hour.'<br>'.'Pretul va fi marit cu 5 lei: '; echo "<span style='color:purple;'>".$new_cost."</span>".' lei'; echo "</h3>"; echo'<br>';
            echo "<center> <form class='' action='' method='post' autocomplete='off'>
            <p> Introduceti adresa: </p> <input type='text' name='adress' id='adress'>
            <p> Introduceti nr de telefon: </p> <input type='text' name='phone' id='phone'>
            <input type='hidden' name='money' value='$new_cost'>
            <input type='hidden' name='products' value='$produse'> <br>
            <button name='place_order' class='order'> Plaseaza comanda </button>
            </form> </center>";
        }
    }

    if(isset($_POST["place_order"])) {
        $location = $_POST['adress'];
        $phone = $_POST['phone'];
        $price = $_POST['money'];
        $date = date('Y-m-d');
        $check_phone = "/^0{1}[237]{1}[0-9]{8}/";
        if(preg_match($check_phone, $phone)) {
        $place_order="INSERT INTO orders VALUES('','Asteptare','$user','$date','$produse','$location', '$phone','$price')";
        $order = mysqli_multi_query($conn,"DELETE FROM cart WHERE user = '$user'");
        mysqli_query($conn, $place_order);
        echo "<script> alert('Comanda a fost plasata cu succes!') </script>";
        }
        else 
          echo "<script> alert('Nr de telefon invalid!') </script>";
}
    }
else { echo '<br>'.'<br>'."<h2 style='text-align: center;'>"; echo 'Trebuie sa te conectezi pentru a avea acces la cos!'; echo "</h2>"; echo'<br>'; } 
?>
</html>