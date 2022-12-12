<?php
function pieces_bought($name,$nr) {
  echo "<script> alert('Produsul $name a fost adaugat in cos in cantitatea de $nr bucati'); </script>";
}

require 'dbconection.php';

$cake = '';
if(isset($_POST["buy"])) {
  $result = mysqli_query($conn,"SELECT * FROM cakes");
  if($result->num_rows > 0) {
      while($row = $result->fetch_assoc())
        if($row['id'] == $_POST["code"])
          $cake = $row['name'];
  }
    pieces_bought($cake,$_POST["quantity"]);
}

?>


<html>
<head>
    <style>
        body {
            background-color: #EEA9E9;
        }
a{
  text-decoration: none;
}
.cards{
  text-align: center;
  font-size: 0;
}
.card{
  margin: 0 10px;
  width: 300px;
  text-align: left;
  display: inline-block;
  font-size: medium;
}
.card-img{
  width: 250px;
  height: 200px;
  margin-bottom: -5px;
}
.card-title{
  width: 250px;
  padding:7px;
  margin-bottom: 20px;
  text-align: center;
}

.button{
    color: purple;
    background-color: yellow;
    padding: 5px;
    text-align: center;
    font-size: 16px;
    border-radius: 8px;
}

.quantity{
    border: 2px solid purple;
    color: purple;
}

        </style>
</head>

<body>
    <?php include 'menu.html' ?>
    <br> <h3 style="text-align: center;"> Aici gasiti toate produsele: </h3> <br>
        <div class="cards">
        <?php include("dbconection.php");
        $result = mysqli_query($conn,"SELECT * FROM cakes");
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
                    <div class="card"> <a href="#">  <!-- href catre pagina unde sa vad descrierea completa a produsului -->
                      <img src="<?php echo $row['picture'];?>" class="card-img" />
                      <div class="card-title">
                         <h2 style="color: #cc0099; font-style: oblique;"> <?php echo $row['name']; ?> </h2>
                          <h4> <?php echo $row['price']; ?> lei/buc </h4> <br>
                          <h4> Mai avem <?php echo $row['pieces']; ?> bucati </h4> 
                          </a>
                          <form class="" action="" method="post" autocomplete="off">
                          <button class="button" type="submit" name="buy"> Adauga in cos </button>   
                          <input type="hidden" name="code" value="<?php echo (int)$row['id']; ?>">  
                          <input type="number" id="quantity" name="quantity" min="0" max="<?php echo $row['pieces'] ?>" value="0" class="quantity"> 
                        </form>
                      </div> 
                  </div>
            <?php
          }
        }
        ?>
</body>
</html>