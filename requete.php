
<?php


@$db = mysql_connect('localhost', 'root', ''); 


mysql_select_db('mag',$db); 

// on crée la requête SQL
$aze = 'SELECT Name,Prix FROM panier'; 

// on envoie la requête 

$ra2 = mysql_query($aze) or die('Erreur SQL !<br>'.$aze.'<br>'.mysql_error()); 


    ?>

<?php
try
{
  $conn = new PDO('mysql:host=localhost;dbname=mag;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$sql = "INSERT INTO panier (ID, Name, Prix, Quantité)
VALUES (1, 'Boba', 200, 1)";

($conn->query($sql) === TRUE);

?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['userEmail']; ?></title>
<link rel="stylesheet" href="css/article.scss" type="text/css" />
<style>html, body {
          height: 100%;
          margin: 0;
          padding: 0;
 
    /* The image used */
    background-image: url("http://vignette4.wikia.nocookie.net/la-bibliotheque-du-bastion2/images/9/9d/Le_Chevalier_Noir.jpg/revision/latest?cb=20140524150531&path-prefix=fr");");

    /* Full height */
    height: 100%; 

    /* Create the parallax scrolling effect */
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;

        }        
        #map {
          height: 100%;
          z-index: 5;
        }"</style>
</head>


<body>



      <a href="Index.php" class ="navbtn"><img src="img/poz2.png" class="btnpoz"><b class="btntext">Home</b></a>
      <a href="Liste.php" class= "navbtn2 active"><img src="img/burger.png" class="btnpoz2"><b class="btntext2">Boutique</b></a>
      <a href="Map.php" class ="navbtn3 "><img src="img/poz2.png" class="btnpoz"><b class="btntext">Ma position</b></a>

      <div class="titrepanier"> Votre panier : </div>

      <table>
   <tr>
       <th>Nom</th>
       <th>Prix</th>

   </tr>

   <tr>
       <td><?php while($data = mysql_fetch_assoc($ra2)) { echo $data['Name']; } ?></td>
       <td><?php while($data = mysql_fetch_assoc($ra2)) { echo $data['Prix']; } ?></td>
      
   <tr>
       <td><?php while($data = mysql_fetch_assoc($ra2)) { echo $data['Name']; } ?></td>
       <td><?php while($data = mysql_fetch_assoc($ra2)) { echo $data['Prix']; } ?></td>
      
   </tr>
</table>


    
</body>
</html>