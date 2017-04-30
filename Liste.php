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


<!DOCTYPE html>
  <html ng-app="app">
  <head>
      <title>Contacte</title>
      <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
      <meta charset="utf-8">
      <style>
        html, body {
          height: 100%;
          margin: 0;
          padding: 0;
        }
        #map {
          height: 100%;
          z-index: 5;
        }
      </style>

    <link rel="stylesheet" type="text/css" href="css/liste.scss">

  <?php


@$dc = mysql_connect('localhost', 'root', ''); 


mysql_select_db('mag',$dc); 

// on crée la requête SQL 
$sqi = 'SELECT Id,Name,Prix,Image,Link FROM produits'; 

// on envoie la requête 
$req3 = mysql_query($sqi) or die('Erreur SQL !<br>'.$sqi.'<br>'.mysql_error()); 
$req4 = mysql_query($sqi) or die('Erreur SQL !<br>'.$sqi.'<br>'.mysql_error()); 

// on fait une boucle qui va faire un tour pour chaque enregistrement 

    ?>

  </head>


  <body>


    <div id="map"></div>

    <!--Bouton de navigation-->
      <a href="Index.php" class ="navbtn"><img src="img/poz2.png" class="btnpoz"><b class="btntext">Home</b></a>
      <a href="Liste.html" class= "navbtn2 active"><img src="img/burger.png" class="btnpoz2"><b class="btntext2">Boutique</b></a>
      <a href="Map.php" class ="navbtn3 "><img src="img/poz2.png" class="btnpoz"><b class="btntext">Ma position</b></a>
<div class="dropdown">
     <span class="glyphicon glyphicon-user"></span>&nbsp;Bonjour <?php echo $userRow['userName']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>Sign Out</a>
              </ul>
            </div>s

      <a href="" class ="prod1"><img src="img/boba.jpg" class="imgprod1"><b class="textprod1">Armure Boba Fett</b></a>
      <a href="" class ="prod2"><img src="img/boba.jpg" class="imgprod2"><b class="textprod2">Armure Boba Fett</b></a>
      <a href="" class ="prod3"><img src="img/boba.jpg" class="imgprod3"><b class="textprod3">Armure Boba Fett</b></a>
      <a href="" class ="prod4"><img src="img/boba.jpg" class="imgprod4"><b class="textprod4">Armure Boba Fett</b></a>


                <a href="logout.php?logout" class="dropdown"><ul class="signout">Sign Out</ul></a>




    <script src="js/jquery.js"></script>
    <script src="js/angular.js"></script>
    <script src="js/controller/NavCtrl.js"></script>
    <script src="js/controller/WeatherCtrl.js"></script>
    <script src="js/app.js"></script>

  </body>

</html>