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
<title>Création de Ticket</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<style>
  select {
  // A reset of styles, including removing the default dropdown arrow
  appearance: none;
  background-color: transparent;
  border: none;
  padding: 0 1em 0 0;
  margin: 0;
  width: 100%;
  font-family: inherit;
  font-size: inherit;
  cursor: inherit;
  line-height: inherit;

  // Stack above custom arrow
  z-index: 1;

  // Remove dropdown arrow in IE10 & IE11
  // @link https://www.filamentgroup.com/lab/select-css.html
  &::-ms-expand {
    display: none;
  }
  // Remove focus outline, will add on alternate element
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
  max-width: 30ch;
  border: 1px solid var(--select-border);
  border-radius: 0.25em;
  padding: 0.25em 0.5em;
  font-size: 1.25rem;
  cursor: pointer;
  line-height: 1.1;
  // Optional styles
  // remove for transparency
  background-color: #17b0dd;
  background-image: linear-gradient(to top, #17b0dd, #17b0dd 100%);

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

</div>
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <div class="sidebar one_quarter first"> 
      <h4><span class=" fas fa-user"></span>&emsp;<span>Espace Utilisateur</span></h4>
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
      <div id="comments">
        <div style="text-align:center;"><h2>Consultation de Tickets</h2></div>
        <form action="#" method="GET">
           <?php
          //Acces à la base de donnees
            $conn = mysqli_connect("localhost:3306","root","") or die("Erreur: probleme de connexion");
            $bd = mysqli_select_db($conn,"helpdesk") or die("Errreur: probleme de base de donnee");
            $id_user=$_SESSION['id_user'];
            $nom_user="";
            $req_get_name = "SELECT nom from utilisateur WHERE id_utilisateur=".$id_user;
            $resultat_get_name = mysqli_query($conn,$req_get_name);
           

            if(isset($_GET['ticket']) && !empty($_GET['ticket'])){
              $requete = "SELECT titre,type,categorie,priorite,statut,description,demandeur,technicien,piece_jointe FROM ticket WHERE ticket.id_ticket=".$_GET['ticket'];
              $resultat = mysqli_query($conn,$requete);

              if(!$resultat){
                  echo mysqli_errno();
                  echo mysqli_error();
                  echo "<script type=\"text/javascript\">alert('Erreur : ".mysqli_error()."')</script>";
                }

              while($ligne = mysqli_fetch_row($resultat)) {
                $titre = $ligne[0];
                $type = $ligne[1];
                $categorie = $ligne[2];
                $priorite = $ligne[3];
                $statut = $ligne[4];
                $description = $ligne[5];
                $demandeur = $ligne[6];
                $technicien = $ligne[7];
                $piece_jointe = $ligne[8];
            

            ?>
          <div class="block clear">
            <label for="titre">Titre<span>*</span></label>
            <input type="text" name="titre"size="22" value="<?php echo($titre);?>" readonly>
          </div>
          <div class="select one_third first">
            <select name="type" disabled="true">
              <option value=""><?php echo($type);?></option>
            </select>
          </div>
          <div class="select one_third">
            <select name="categorie" disabled="true">
              <option value=""><?php echo($categorie);?></option>
            </select>
          </div>
          <div class="select one_third">
            <select name="priorite" disabled="true">
              <option value=""><?php echo($priorite);?></option>
            </select>
          </div>
        
          <div class="one_third first">
            <label for="titre">Status</label>
            <input type="text" size="10" value="<?php echo($statut);?>" readonly>
          </div>
          <div class="one_third ">
            <label for="titre">Demandeur</label>
            <input type="text" size="10" value="<?php echo($demandeur);?>" readonly>
          </div>
          <div class="one_third">
            <label for="titre">Technicien</label>
            <input type="text" size="10" value="<?php echo($technicien);?>" readonly>
          </div>

          <div class="block clear">
            <label for="description">Description <span>*</span></label>
            <textarea name="description" cols="25" rows="10"  readonly><?php echo($description);?></textarea>
          </div>
          <div>
          </div>
        <?php }}?>
        </form>
      </div>
    </div>
  </main>
</div>

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