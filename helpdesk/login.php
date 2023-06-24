<?php 
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(0);
?>
<!DOCTYPE html>
<!--
Template Name: Nekmit
Author: <a href="https://www.os-templates.com/">OS Templates</a>
Author URI: https://www.os-templates.com/
Copyright: OS-Templates.com
Licence: Free to use under our free template licence terms
Licence URI: https://www.os-templates.com/template-terms
-->
<html lang="">
<!-- To declare your language - read more here: https://www.w3.org/International/questions/qa-html-language-declarations -->
<head>
<title>Login</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">
</div>

<div class="wrapper row4">
  <footer id="footer" class="hoc clear"> 
   <h4>Connexion HelpDesk</h4>
   <br></br><br></br>
    <div class="">
      <p class="nospace btmspace-15">Entrez votre email et mot de passe pour acceder à HelpDesk</p>
      <form action="#" method="get">
        <fieldset>
          <legend></legend>
          <input class="btmspace-15" type="text" name="mail" placeholder="Adresse Email" required>
          <input class="btmspace-15" type="password" name="pass" placeholder="Mot de passe" required>
          <button class="btn" type="submit" name="login" >se connecter</button>
        </fieldset>
          <?php 

          $conn = mysqli_connect("localhost:3306","root","") or die("Erreur: probleme de connexion");
          $bd = mysqli_select_db($conn,"helpdesk") or die("Errreur: probleme de base de donnee");
          
          if(isset($_GET['login']))
          {
            $mail = $_GET['mail'];
            $pass = $_GET['pass'];

            $requete = "SELECT id_utilisateur,role,nom FROM utilisateur WHERE email='".$mail."' and password='".$pass."'";
            $resultat = mysqli_query($conn,$requete);
            while($ligne = mysqli_fetch_row($resultat)) {
                $id_user = $ligne[0];
                $role = $ligne[1];
                $nom = $ligne[2];
                $_SESSION["id_user"] = $id_user;
                $_SESSION["nom"] = $nom;

              if($role == "utilisateur"){
                header("Location: utilisateur_creation_ticket.php");
              }
              else if($role == "technicien"){
                header("Location: technicien_dash.php");
              }
              else if($role == "chefdeprojet"){
                header("Location: responsable_dash.php");
              }
           }
         }
          ?> 
      </form>
    </div>
      
  </footer>
  <div><br></br><br></br><br></br></div>
</div>
<div class="wrapper row5">
  <div id="copyright" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved - <a href="#">Domain Name</a></p>
    <p class="fl_right">Template by <a target="_blank" href="https://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
    <!-- ################################################################################################ -->
  </div>
</div>
<a id="backtotop" href="#top"><i class="fas fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
</body>
</html>