

<!DOCTYPE html>
  <html ng-app="app">
  <head>
      <title>Map</title>
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

    <link rel="stylesheet" type="text/css" href="css/Map.scss">


  </head>
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


      try
        {
          $bdd = new PDO('mysql:host=localhost;dbname=mag','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
          if (isset($_GET['selection']))
    {
            $toto=$_GET['selection'];
            $requeteposition= $bdd->query ("SELECT * FROM positions where Type_point='$toto'");         //Requête special
    }
    else{
          $requeteposition= $bdd->query ("SELECT * FROM positions ");                                   //requête global
    }

        }

      catch (PDOException $e)
        {

          print "Erreur ! : " . $e->getMessage() . "<br/>";
          die();

        }
    ?>


  <body>


    <div id="map"></div>

    <!--Bouton de navigation-->
      <a href="Index.php" class ="navbtn"><img src="img/poz2.png" class="btnpoz"><b class="btntext">Home</b></a>
      <a href="Liste.php" class= "navbtn2"><img src="img/burger.png" class="btnpoz2"><b class="btntext2">Boutique</b></a>
      <a href="Map.php" class ="navbtn3 active"><img src="img/poz2.png" class="btnpoz"><b class="btntext">Ma position</b></a>
      <div class="dropdown">
                <a href="logout.php?logout" class="dropdown"><ul class="signout">Sign Out</ul></a>

  <script type="text/javascript">

      //Initialisation de la map

        function initMap() {

          var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 45.0695601067551, lng: 4.828984353067672},
            zoom: 10,
            zoomControl: true,
            zoomControlOptions: {
            position: google.maps.ControlPosition.RIGHT_TOP},
            scaleControl: true,
            streetViewControl: true,
            streetViewControlOptions: {
              position: google.maps.ControlPosition.RIGHT_TOP}
            });

      //Variables d'image pour les marqueurs

        var garage = 'img/sav.png';
        var internet= 'img/internet.png';
        var photo ='img/photo.png';
        var point ='img/point.png';


      //Variables pour la creation des marqueurs   /  Boucle php

        <?php 

          $numval= 1;

          while ($donnees = $requeteposition->fetch())
          {

        ?>

          var marker<?php echo $numval ?> = new google.maps.Marker({                                          <!-- Création du marqueur X -->
            position: {lat:<?php echo $donnees['Latitude']; ?>, lng:<?php echo $donnees['Longitude']; ?>},    <!-- Definition de la position -->
            map: map,
            animation: google.maps.Animation.DROP,                                                            <!-- Choix de l'animation du marqueur -->
            icon: <?php echo $donnees['Type_point']; ?>});                                                    <!-- Choix de l'icone du marqueur -->
            marker<?php echo $numval ?>.addListener('click', function() {                                     <!-- Association de la fenêtre d'affichage -->
            infowindow<?php echo $numval ?>.open(map, marker<?php echo $numval ?>);});



          var contentString<?php echo $numval ?> ='<div id="content">'+                                     <!--> Titre/texte/Image <!-->
              '<div id="siteNotice">'+
              '</div>'+
              '<h2><?php echo $donnees['Titre']; ?></h2>'+
              '<BR>'+
              '<BR>'+
              '<div id="bodyContent">'+
                '<p><?php echo $donnees['Texte']; ?></p>'+
                '<div><img src=<?php echo $donnees['Image'];?> ></div>'+
                '<div><form method="link" action="Liste.html"><input type="submit" value="cliquez ici" style="background:#9900ff; color:#ffffff; position:absolute; z-index:1; padding:10px; width:100%; top:60px; border-radius:28px;" ></form></div>'
                
              '</div>'+
              '</div>';


          var infowindow<?php echo $numval ?> = new google.maps.InfoWindow({                                <!-- Création de la fenêtre d'affichage -->
            content: contentString<?php echo $numval ?>});


        <?php

          $numval++;

          }

          $requeteposition->closeCursor();

        ?>





      //Variable pour la position de l'utilisateur

        var image = 'img/poz.png';                                        //image
        var markpoz = new google.maps.Marker({map: map,icon:image});      //Creation du marqueur
          icon:image;

        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {                                                   //Variables position par
              lat: position.coords.latitude,                              //Latitude
              lng: position.coords.longitude                              //Longitude
            };

              markpoz.setPosition(pos);                                    //Mise en place du marqueur
              map.setCenter(pos);                                          //Vue centré sur le marqueur

            }, function() {
              handleLocationError(true, markpoz, map.getCenter());
            });} 

        else {

          // Géolocalisation non supporté par le navigateur

            handleLocationError(false, markpoz, map.getCenter());
          }
        }

        //Si erreur de la géolocalisation

          function handleLocationError(browserHasGeolocation, markpoz, pos) {                                     
            markpoz.setPosition(pos);
            marpoz.setContent(browserHasGeolocation ?
                                'Error: The Geolocation service failed.' :
                                'Error: Your browser doesn\'t support geolocation.');
          }

        function CenterControl(controlDiv, map) {

          // CSS pour la bordure
            var controlUI = document.createElement('div');
            controlUI.style.backgroundColor = '#fff';
            controlUI.style.border = '2px solid #fff';
            controlUI.style.borderRadius = '3px';
            controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
            controlUI.style.cursor = 'pointer';
            controlUI.style.marginBottom = '22px';
            controlUI.style.textAlign = 'center';
            controlUI.title = 'Click to recenter the map';
            controlDiv.appendChild(controlUI);

          // CSS pour l'interieur
            var controlText = document.createElement('div');
            controlText.style.color = 'rgb(25,25,25)';
            controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
            controlText.style.fontSize = '16px';
            controlText.style.lineHeight = '38px';
            controlText.style.paddingLeft = '5px';
            controlText.style.paddingRight = '5px';
            controlText.innerHTML = 'Center Map';
            controlUI.appendChild(controlText);

        }

navigator.camera.getPicture(onSuccess, onFail, { quality: 50,
    destinationType: Camera.DestinationType.FILE_URI });

function onSuccess(imageURI) {
    var image = document.getElementById('myImage');
    image.src = imageURI;
}

function onFail(message) {
    alert('Failed because: ' + message);
}
    </script>


 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0za6D9PXaLLtZnLVrdhEg_Zqgx-eywVU&signed_in=true&callback=initMap"async defer>
      </script>


    <script src="https://www.gstatic.com/firebasejs/live/3.0/firebase.js"></script>
    <script type="text/javascript">
      // Initalize Firebase
        var config = {
          apiKey: "AizaSyAWiRZxNSHvuYSdUuhttqEg3JM60Mmn37o",
          authDomain: "project-6089728335664582001.firebaseapp.com",
          databaseURL: "https://project-6089728335664582001.firebaseio.com",
          storageBucket: "project-6089728335664582001.appspot.com",
        };
        firebase.initializeApp(config);
    </script>

    <script src="js/jquery.js"></script>
    <script src="js/angular.js"></script>
    <script src="js/controller/NavCtrl.js"></script>
    <script src="js/controller/WeatherCtrl.js"></script>
    <script src="js/app.js"></script>

  </body>

</html>