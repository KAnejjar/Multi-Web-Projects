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
<title>dash</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<style>
/*style selon la priorite du ticket*/
.haute{background-color:#dc3545; color:white;font-size: small; padding: 4px 8px; margin: 2px 1px;border-radius:10px;}
.moyenne{background-color:#ffc107;color:white;font-size: small; padding: 4px 8px; margin: 2px 1px;border-radius:10px;}
.faible{background-color:#28a745;color:white;font-size: small; padding: 4px 8px; margin: 2px 1px;border-radius:10px;}

/*style selon le statut du ticket*/
.resolu{background-color:#0ed145;color:white;font-size: small;}
.clos{background-color:#88001b;color:white;font-size: small;}
.statut{color:#00a8f3;font-size: small;}

.button1 {
  border-radius:10px;
  background-color: #343a40;
  border: none;
  color: white;
  padding: 7px 15px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  margin: 2px 1px;
  cursor: pointer;
}
.button2 {
  border-radius:10px;
  background-color: #6c757d;
  border: none;
  color: white;
  padding: 7px 15px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  margin: 2px 1px;
  cursor: pointer;
}
</style> 
</head>

<body id="top">
<div class="bgded overlay padtop" style="background-image:url('images/demo/backgrounds/01.jpg');"> 
 </div>
<div class="wrapper row1">
<?php
//Acces à la base de donnees
$conn = mysqli_connect("localhost:3306","root","") or die("Erreur: probleme de connexion");
$bd = mysqli_select_db($conn,"helpdesk") or die("Errreur: probleme de base de donnee");
$user_id = $_SESSION['id_user']; 

if(isset($_GET['ticket']) && !empty($_GET['ticket'])){
          $ticket = $_GET['ticket'];
}


$requete = "SELECT titre,description,date_creation, nom,role FROM suivi,utilisateur WHERE utilisateur.id_utilisateur=suivi.id_utilisateur and id_ticket=".$ticket." order by id_suivi desc";
$resultat = mysqli_query($conn,$requete);

if(!$resultat){
    echo mysqli_errno();
    echo mysqli_error();
    echo "<script type=\"text/javascript\">alert('Erreur : ".mysqli_error()."')</script>";
  }

?>
</div>
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <div class="sidebar one_quarter first"> 
      <h4><span class="fas fa-user"></span>&emsp;<span>Espace Utilisateur</span></h4>
      <br>
      <nav class="sdb_holder">
        <ul>
          <li><a href="#"><h6><?php echo $_SESSION['nom'];?></h6></a></li>
            <ul>
              <li><a href="utilisateur_dash.php"><span class="far fa-calendar-alt"></span>&emsp;<span>Tableau de Bord</span></a></li>
              <li><a href="utilisateur_creation_ticket.php"><span class="fas fa-book"></span>&emsp;<span>Tickets</span></a></li>
              <li><a href="login.php"><span class="fas fa-sign-out-alt"></span>&emsp;<span>Déconnexion</span></a></li>
            </ul>
          </li>
          </ul>
      </nav>
    </div>
    <div class="content three_quarter"> 
      <div class="scrollable">
        <div id="comments">
          <div class="group btmspace-50 demo">
            <div class="one_third first">
              <a href="historique_actions.php?ticket=<?php echo($ticket);?>"><button class="btn" type="submit" value="submit">Historique des Actions</button></a>
            </div>
            <div class="one_third ">
              <a href="suivi_ticket.php?ticket=<?php echo($ticket);?>"><button class="btn" type="submit" value="submit">Ajouter un Suivi</button></a>
            </div>
            <hr>
          </div>
          <br>

        <h2><b>Historique des Actions</b></h2>
        <ul>
          <?php
              while($ligne = mysqli_fetch_row($resultat)) {
                $titre = $ligne[0];
                $description = $ligne[1];
                $date_creation = $ligne[2];
                $nom = $ligne[3];
                $role = $ligne[4];

                echo ' <li>
                        <article>
                          <header>
                            <figure class="avatar"><img src="images/demo/'.$role.'.png" alt=""></figure>
                            <address>
                            '.$titre.' : <a href="#"> '.$nom.'</a> <span style="color:gray; font-size:10px;">('.$role.')</span>
                            </address>
                            <time>'.$date_creation.'</time>
                          </header>
                          <div class="comcont">
                            <p>'.$description.'.</p>
                          </div>
                        </article>
                      </li>';
            }
          ?>
        </ul>
      </div>
      </div>
    </div>
 
  </main>
</div>

<div>
<div id="copyright" class="hoc clear"> 
    <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved -</p>
    <p class="fl_right">Template by <a target="_blank" href="https://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
</div>
</div>

<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>

</body>
</html>