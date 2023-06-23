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

?>
</div>
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <div class="sidebar one_quarter first"> 
      <h4><span class=" fas fa-user"></span>&emsp;<span>Technicien</span></h4>
      <br>
      <nav class="sdb_holder">
        <ul>
          <li><a href="#"><h6><?php echo $_SESSION['nom'];?></h6></a></li>
            <ul>
              <li><a href="technicien_dash.php"><span class="far fa-calendar-alt"></span>&emsp;<span>Tableau de Bord</span></a></li>
              <li><a href="#"><span class="fas fa-book"></span>&emsp;<span>Tickets</span></a></li>
              <li><a href="login.php"><span class="fas fa-sign-out-alt"></span>&emsp;<span>Déconnexion</span></a></li>
            </ul>
          </li>
          </ul>
      </nav>
    </div>
    <?php 
      if(isset($_GET['ticket']) && !empty($_GET['ticket'])){
          $ticket = $_GET['ticket'];
      }
    ?>
    <div class="content three_quarter"> 
       <div class="scrollable">
        <div id="comments">
          <div class="group btmspace-50 demo">
            <div class="one_third first">
              <a href="historique_actions_technicien.php?ticket=<?php echo($ticket);?>"><button class="btn" type="submit" value="submit">Historique des Actions</button></a>
            </div>
            <div class="one_third ">
              <a href="suivi_ticket_technicien.php?ticket=<?php echo($ticket);?>"><button class="btn" type="submit" value="submit">Ajouter un Suivi</button></a>
            </div>
            <hr>
          </div>
          <br>

        <h2><b>Nouvel élément - Suivi</b></h2>
        <form action="#" method="get">
          <div class="two_quarter first">
            <label for="comment">Sujet</label>
            <input type="text" name="sujet"size="22">
          </div>
          <div class="two_quarter">
            <label for="comment">Pièce jointe</label>
            <input type="file" name="piece_jointe"accept="image/png, image/jpeg">
          </div>
          
          <div class="block clear">
            <label for="comment">Description <span>*</span></label>
            <textarea name="description" id="comment" cols="25" rows="10" required></textarea>
          </div>
          <div>
            <input type='hidden' name='ticket' value='<?php echo($ticket);?>'/>
            <input type="submit" name="submit" value="Ajouter"/>
          </div>
          <?php
            if(isset($_GET['submit']) && !empty($_GET['submit'])){
                //insertion dans la BD
                $sujet = $_GET['sujet'];
                $piece_jointe = $_GET['piece_jointe'];
                $description = $_GET['description'];
                $date_creation = date('d-m-Y H:i');
        

                $requete = "insert into suivi(id_utilisateur,id_ticket,titre,description,date_creation,piece_jointe) values (".$user_id.",".$ticket.",'".$sujet."','".$description."','".$date_creation."','".$piece_jointe."')";
                $resultat = mysqli_query($conn,$requete);
             

                if(!$resultat){
                  echo mysqli_errno();
                  echo mysqli_error();
                  echo "<script type=\"text/javascript\">alert('Erreur : ".mysqli_error()."')</script>";
                }
                else{
                  echo "<script type=\"text/javascript\">alert('Elément Suivi indéré avec Succès.')</script>";
                }
            }
          ?>
        </form>
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