<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';
 
 // it will never let you open index(login) page if session is set
 if ( isset($_SESSION['user'])!="" ) {
  header("Location: home.php");

  exit;
 }
 
 $error = false;
 
 if( isset($_POST['btn-login']) ) { 
  
  // prevent sql injections/ clear user invalid inputs
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  
  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  // prevent sql injections / clear user invalid inputs
  
  if(empty($email)){
   $error = true;
   $emailError = "Entrez votre adresse";
  } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Merci de rentrer une adresse valide";
  }
  
  if(empty($pass)){
   $error = true;
   $passError = "Entrez votre mot de passe";
  }
  
  // if there's no error, continue to login
  if (!$error) {
   
   $password = hash('sha256', $pass); // password hashing using SHA256
  
   $res=mysql_query("SELECT userId, userName, userPass FROM users WHERE userEmail='$email'");
   $row=mysql_fetch_array($res);
   $count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row
   
   if( $count == 1 && $row['userPass']==$password ) {
    $_SESSION['user'] = $row['userId'];
    header("Location: home.php");

   } else {
    $errMSG = "Information incorrecte";
   }
    
  }
  
 }
?>

<!DOCTYPE html>
  <html ng-app="app">
  <head>
      <title>Home</title>
      <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
      <meta charset="utf-8">
      <style>
        html, body {
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
        }

input[type=email], select {
position: absolute;
top: 200px;
left :25%; width: 50%;
    padding: 12px 20px;
    margin: 0px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    right : 10%;
    position: fixed;
        text-align: center;
    z-index: 25;
}

input[type=password], select {
position: absolute;
top: 250px;
left : 25%; width: 50%;
    padding: 12px 20px;
    margin: 0px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
        position: fixed;
            text-align: center;
    z-index: 25;
}
input[type=submit] {
position: absolute;
top: 300px;
left : 25%; width: 50%;
    background-color: #929897;
    color: white;
    padding: 14px 20px;
    margin: 0px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    position: fixed;
text-align: center;

    z-index: 25;
}
input[type=register] {
position: absolute;
top:360px;
left : 25%; width: 50%;
    background-color: #929897;
    color: white;
    padding: 14px 0px;
    margin: 0px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    position: fixed;
    text-align: center;

    z-index: 25;
}

div{
  position: fixed;
  top: 450px;left: 25%;
width: 50%;
  font-size: 30px;
  text-align: center;
white-space: nowrap;
z-index: 25;
background-color: #929897;
border-radius: 4px;
    color:#ffffff;
font-family:Arial;
font-weight:bold;
text-shadow:0px -2px 0px #000;
}

}</style>

    <link rel="stylesheet" type="text/css" href="css/index.scss">


  </head>

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

  <body>
       
   

<ul class="welcome"> Bienvenue sur Sword&Knight !</br> Armes et armures de collection !</ul>

<ul class="continu"> Pour continuer, veuillez vous enregistrer</ul>
    <div class="container">

 <div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
     <div class="col-md-12">
        


            
            <?php
   if ( isset($errMSG) ) {
    
    ?>
    <div class="form-group">
             <div class="alert alert-danger">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
             </div>
                <?php
   }
   ?>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
             <input type="email" name="email" class="form-control" placeholder="Votre Email" value="<?php echo $email; ?>" maxlength="40" />
                </div>
                <span class="text-danger"><?php echo $emailError; ?></span>
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
             <input type="password" name="pass" class="form-control" placeholder="Votre mot de passe" maxlength="15" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>
            

            <div class="form-group">
             <input type="submit" name="btn-login">
            </div>
            

            
            <div class="form-group">
             <a href="register.php"><input type="register" name="btn-login" value ="Pas de compte ? Inscivez-vous ici !"> </a>
            </div>
        
        </div>
   
    </form>
    </div> 

</div>



    <script src="js/jquery.js"></script>
    <script src="js/angular.js"></script>
    <script src="js/controller/NavCtrl.js"></script>
    <script src="js/controller/WeatherCtrl.js"></script>
    <script src="js/app.js"></script>

  </body>

</html>

<?php ob_end_flush(); ?>