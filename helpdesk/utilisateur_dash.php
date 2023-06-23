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
.resolu{background-color:#28a745;color:white;font-size: small; padding: 4px 8px; margin: 2px 1px;border-radius:10px;}
.clos{background-color:#17a2b8;color:white;font-size: small; padding: 4px 8px; margin: 2px 1px;border-radius:10px;}
.statut{color:#00a8f3;font-size: small; padding: 4px 8px; margin: 2px 1px;border-radius:10px;}

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

$requete = "SELECT titre,type,categorie,priorite,statut,id_ticket FROM ticket,attribution WHERE ticket.id_ticket=attribution.ticket and attribution.utilisateur=".$user_id;
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
        <br>
        <div style="text-align:center;"><h1><b>Mes Tickets</b></h1></div>
        <br>
        <table>
          <thead>
            <tr>
              <th>Titre</th>
              <th>Type</th>
              <th>Catégorie</th>
              <th>Priorité</th>
              <th>Statut</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              while($ligne = mysqli_fetch_row($resultat)) {
                $titre = $ligne[0];
                $type = $ligne[1];
                $categorie = $ligne[2];
                $priorite = $ligne[3];
                $statut = $ligne[4];
                $id_ticket = $ligne[5];
    
                echo "<tr>
                        <td><b>".$titre."</b></td>
                        <td>".$type."</td>
                        <td>".$categorie."</td>
                        <td><b><span class='".$priorite."'>&nbsp;".$priorite."&nbsp;</span></b></td>
                        <td><b><span class='".$statut."'>&nbsp;".$statut."&nbsp;</span></b></td>
                        <td>
                          <a href='consultation_ticket.php?ticket=".$id_ticket."'><button type='button'class='button1' name='consulter'>Consulter</button></a>
                          <a href='suivi_ticket.php?ticket=".$id_ticket."'><button type='button' class='button2' name='Suivre'>Suivre</button></a>
                        </td>
                        </tr>";
              }
            ?>
          </tbody>
        </table>
        <br>
        <form method="post" action="utilisateur_creation_ticket.php">
          <button class="btn" type="submit" value="submit">Nouveau Ticket</button>
        </form>
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