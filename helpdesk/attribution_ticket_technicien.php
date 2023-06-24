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
<head>
<title>Atribution de Ticket</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<style>
  select {
  // A reset of styles, including removing the default dropdown arrow
  appearance: none;
  background-color: transparent;
  border: none;
  margin: 0;
  width: 100%;
  font-family: inherit;
  font-size: inherit;
  cursor: inherit;
  line-height: inherit;

  // Stack above custom arrow
  z-index: 1;

  &::-ms-expand {
    display: none;
  }
  outline: none;
}

.select {
  display: grid;
  grid-template-areas: "select";
  align-items: center;
  position: relative;
  select,
  &::after {
    grid-area: select;
  }
  min-width: 15ch;
  border: 1px solid var(--select-border);
  border-radius: 0.25em;
  padding: 0.25em 0.5em;
  font-size: 1.2rem;
  cursor: pointer;
  line-height: 1.1;
  // Optional styles
  // remove for transparency
  background-color: #0ac6fc;
  background-image: linear-gradient(to top, #0ac6fc, #0ac6fc 100%);

  // Custom arrow
  &:not(.select--multiple)::after {
    content: "";
    justify-self: end;
    width: 0.8em;
    height: 0.5em;
    background-color: var(--select-arrow);
    clip-path: polygon(100% 0%, 0 0%, 50% 100%);
  }
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


$requete = "SELECT id_utilisateur,nom FROM utilisateur WHERE role='technicien'";
$resultat = mysqli_query($conn,$requete);
?>
</div>
<div class="wrapper row3">
 <main class="hoc container clear"> 
    <div class="sidebar one_quarter first"> 
      <h4><span class=" fas fa-user"></span>&emsp;<span>Responsable HelpDesk</span></h4>
      <br>
      <nav class="sdb_holder">
        <ul>
          <li><a href="#"><h6><?php echo $_SESSION['nom'];?></h6></a></li>
            <ul>
              <li><a href="responsable_dash.php"><span class="far fa-calendar-alt"></span>&emsp;<span>Tableau de Bord</span></a></li>
              <li><a href="responsable_dash.php"><span class="fas fa-book"></span>&emsp;<span>Tickets</span></a></li>
              <li><a href="login.php"><span class="fas fa-sign-out-alt"></span>&emsp;<span>Déconnexion</span></a></li>
            </ul>
          </li>
          </ul>
      </nav>
    </div>
    <?php
    $id_ticket = $_GET['ticket'];
    ?>
    <div class="content three_quarter"> 
      <div id="comments">
        <div style="text-align:center;"><h2>Attribution de Ticket</h2></div>
        <form action="attribution_ticket_technicien.php?ticket=<?php echo($id_ticket);?>" method="get">
          <div>
            <input type="hidden" name="ticket" value="<?php echo($id_ticket);?>"/>
          </div>
          <div class="select" style="text-align: center">
            <select name="technicien">
              <option value="">Responsable de Traitement</option>
              <?php
                while($ligne = mysqli_fetch_row($resultat)) {
                  $id_utilisateur = $ligne[0];
                  $nom = $ligne[1];
                  echo "<option value='".$id_utilisateur."'>".$nom."</option>";
                }
              ?>
            </select>
          </div>
          <br></br><br></br><br></br>
          <input type="submit" name="attribuer_ticket" value="Valider">
          &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;
          <input type="reset" name="annuler" value="Annuler">
          </div>
        </form>
      </div>
    </div>
  </main>
</div>
<?php
$id_ticket = $_GET['ticket'];

// echo $id_ticket;
if (isset($_GET['attribuer_ticket']) and !empty($_GET['attribuer_ticket'])){
  $technicien = $_GET['technicien'];
  $requete = "INSERT INTO attribution(ticket,utilisateur) VALUES (".$id_ticket.",".$technicien.")";
  $resultat = mysqli_query($conn,$requete);

  if($resultat !== null){
    echo "<script type=\"text/javascript\">alert('Le Ticket a été assigné au Technicien')</script>";  
  }

  $tech_name="";
  $req_get_name = "SELECT nom,email from utilisateur WHERE id_utilisateur=".$technicien;
  $resultat_get_name = mysqli_query($conn,$req_get_name);
  while($l = mysqli_fetch_row($resultat_get_name))
  $tech_name = $l[0]; 
  $email = $l[1];

  $requete2 = "UPDATE ticket SET statut='en cours de traitement', technicien='".$tech_name."' WHERE id_ticket=".$id_ticket;
  $resultat2 = mysqli_query($conn,$requete2);

  //envoi d'un mail au technicien
  $to = $email;
  $subject = "Nouveau Ticket";
  $txt = "Bonjour ".$tech_name.", Un nouveau ticket vous a été attribué.";
  mail($to,$subject,$txt);
}
?>
  <div id="copyright" class="hoc clear"> 
    <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved - <a href="#">Domain Name</a></p>
    <p class="fl_right">Template by <a target="_blank" href="https://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
  </div>


<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>

</body>
</html>