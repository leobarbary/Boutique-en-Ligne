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

    <link rel="stylesheet" type="text/css" href="css/option.scss">


  </head>


  <body>


    <div id="map"></div>

    <!--Bouton de navigation-->
      <a href="Index.php" class ="navbtn"><img src="img/poz2.png" class="btnpoz"><b class="btntext">Home</b></a>
      <a href="Liste.php" class= "navbtn2"><img src="img/burger.png" class="btnpoz2"><b class="btntext2">Boutique</b></a>
      <a href="Map.php" class ="navbtn3 "><img src="img/poz2.png" class="btnpoz"><b class="btntext">Ma position</b></a>
      <a href="Contact.php" class ="navbtn4 active"><img src="img/poz2.png" class="btnpoz"><b class="btntext">Connection</b></a>


    <script src="js/jquery.js"></script>
    <script src="js/angular.js"></script>
    <script src="js/controller/NavCtrl.js"></script>
    <script src="js/controller/WeatherCtrl.js"></script>
    <script src="js/app.js"></script>

  </body>

</html>