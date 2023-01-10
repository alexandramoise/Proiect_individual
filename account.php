<?php
    require 'dbconection.php';
    include 'menu.html';


    $user = $_SESSION["username"];
    $get_user = mysqli_query($conn,"SELECT * FROM customers WHERE username = '$user'");
    echo '<br> <br>'."<h2 style='text-align: center;'>"; echo 'Datele utilizatorului'; echo "<span style='color: purple; font-style: italic;'> $user </span> </h2> <br>";
    if($get_user->num_rows > 0) {
        echo "<table>";
        while($r = $get_user->fetch_assoc()) {
            $id = $r['id'];
            echo "<tr> <td class='label'> Username: </td> <td>".$r['username']."</td> </tr>";
            echo "<tr> <td class='label'> Nume: </td> <td>".$r['name']."</td>  </td> </tr>";
            echo "<tr> <td class='label'> Email: </td> <td>".$r['email']."</td> </tr>";
            echo "<tr> <td class='label'> Password: </td> <td>".str_repeat("*",strlen($r['password']))."</td> </tr>";
        }
        echo "<tr> <td> </td> <td> </td> <td> </td> </tr> <tr> <td> </td> <td> </td> <td> </td> </tr> <tr> <td> </td> <td> </td> <td> </td> </tr>";
        echo "<tr> <td> </td> <td> <form class='' action='' method='post' autocomplete='off'>
        <button name='back' class='buttons'> Inapoi la cont </button> </form> </td> </tr>";
        echo "</table>";
    }

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
        font-size: 1.3em;
        min-width: 400px;
    }
    .label {
        font-style: italic;
        color: purple;
    }

        </style>
</head>
<body>
     
</body>

</html>