<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';
 
 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: index.php");
  exit;
 }
 // select loggedin users detail
 $res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $userRow=mysql_fetch_array($res);
?>


  <?php


@$db = mysql_connect('localhost', 'root', ''); 


mysql_select_db('mag',$db); 

// on crée la requête SQL 
$sql = 'SELECT Titre,Link,image FROM promo'; 

// on envoie la requête 
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error()); 
$req2 = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error()); 

// on fait une boucle qui va faire un tour pour chaque enregistrement 

    ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['userEmail']; ?></title>
<link rel="stylesheet" href="css/Index.scss" type="text/css" />
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



<a href="Index.php" class ="navbtn active"><img src="img/poz2.png" class="btnpoz"><b class="btntext">Home</b></a>
      <a href="Liste.php" class= "navbtn2"><img src="img/burger.png" class="btnpoz2"><b class="btntext2">Boutique</b></a>
      <a href="Map.php" class ="navbtn3 "><img src="img/poz2.png" class="btnpoz"><b class="btntext">Ma position</b></a>




  <div class ="titletop"><b class ="titlebut">Bienvenue sur Sword-Knight !</b><br /><b class="textsubtitle">Le site de vente </b></div>

<a href="promo.php" class ="promobutton"><img src="<?php while($data = mysql_fetch_assoc($req2)) { echo $data['image']; } ?>" class="imgpromo"><b class="textpromo">Promo de la semaine ! Armure de Batman-Steampunk</b></a>


<div class ="titlevideo"><b class ="titlebut">Le catch chevaleresque en Russie !</b></div>

<video class="videoacc" controls>
  <source src="Chevalier.mp4" type="video/mp4">
</video>




 <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">

        <div id="navbar" class="navbar-collapse collapse">
    
          <ul class="nav navbar-nav navbar-right">
            
            <div class="dropdown">
     <span class="glyphicon glyphicon-user"></span>&nbsp;<ul class="textco">Bonjour <?php echo $userRow['userName']; ?>&nbsp;</ul><span class="caret"></span></a>

                <a href="logout.php?logout" class="dropdown"><ul class="signout">Sign Out</ul></a>

            </div>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 

 <div id="wrapper">

 <div class="container">
    
        
    
    </div>
    
    </div>
    
    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
</body>
</html>
<?php ob_end_flush(); ?>