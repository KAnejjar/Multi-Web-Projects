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
        <div style="text-align:center;"><h2>Enregistrer un Nouveau Ticket</h2></div>
        <form action="#" method="GET">
          <div class="two_quarter first">
            <label for="titre">Titre <span>*</span></label>
            <input type="text" name="titre"size="22" required>
          </div>
          <div class="two_quarter">
            <label for="piece_jointe">Pièce Jointe</label>
            <input type="file" name="piece_jointe" accept="image/png, image/jpeg">
          </div>
          <div class="block clear">
            <label for="titre">Titre <span>*</span></label>
            <input type="text" name="titre"size="22" required>
          </div>
          <div class="select one_third first">
<!--             <label for="type">Type <span>*</span></label> -->
            <select name="type" required>
              <option value="">Type</option>
              <option value="incident">Incident</option>
              <option value="demande">Demande</option>
            </select>
          </div>
          <div class="select one_third" required>
            <select name="categorie">
              <option value="">Catégorie</option>
              <option value="materiel">Matériel</option>
              <option value="logiciel">Logiciel</option>
              <option value="reseau">Réseau</option>
              <option value="messagerie">Messagerie</option>
            </select>
          </div>
          <div class="select one_third" required>
<!--             <label for="categorie">Priorité <span>*</span></label>-->
            <select name="priorite">
              <option value="">Priorité</option>
              <option value="haute">Haute</option>
              <option value="moyenne">Moyenne</option>
              <option value="faible">Faible</option>
            </select>
          </div>
        
          <div class="block clear">
            <label for="description">Description <span>*</span></label>
            <textarea name="description" cols="25" rows="10" required></textarea>
          </div>
          <div>
            <input type="submit" name="valider" value="Valider"/>
            &nbsp;
            <input type="reset" name="annuler" value="Annuler"/>
          </div>
          <?php
          //Acces à la base de donnees
            $conn = mysqli_connect("localhost:3306","root","") or die("Erreur: probleme de connexion");
            $bd = mysqli_select_db($conn,"helpdesk") or die("Errreur: probleme de base de donnee");
            $id_user=$_SESSION['id_user'];
            $nom_user="";
            $req_get_name = "SELECT nom from utilisateur WHERE id_utilisateur=".$id_user;
            $resultat_get_name = mysqli_query($conn,$req_get_name);
            while($l = mysqli_fetch_row($resultat_get_name))
              $nom_user = $l[0]; 
            //$validation = $_GET['valider'];
            //if($validation){
              // if(!empty($_POST['titre']) && !empty($_POST['type']) && !empty($_POST['categorie']) && !empty($_POST['priorite']) && !empty($_POST['description'])){
                $titre = $_GET['titre'];
                $type = $_GET['type'];
                $categorie = $_GET['categorie'];
                $priorite = $_GET['priorite'];
                $description = $_GET['description'];
                $piece_jointe = $_GET['piece_jointe'];

                if($titre && $type && $categorie && $priorite && $description){
                //insertion dans la BD
                $requete = "INSERT INTO ticket(type,categorie,titre,description,statut,priorite,piece_jointe,demandeur) VALUES ('".$type."','".$categorie."','".$titre."','".$description."','nouveau ticket','".$priorite."','".$piece_jointe."','".$nom_user."')";
               
                $resultat = mysqli_query($conn,$requete);
                if(!$resultat){
                  echo mysqli_errno();
                  echo mysqli_error();
                  echo "<script type=\"text/javascript\">alert('Erreur : ".mysqli_error()."')</script>";
                }
                if($resultat) {
                  $last_id = mysqli_insert_id($conn);
                  echo "<script type=\"text/javascript\">alert('Ticket Inseré avec succes : ".$last_id."')</script>";
                  $req_attribution = "INSERT INTO attribution(ticket,utilisateur) VALUES(".$last_id.",".$id_user.")";
                  $res_attrinution = mysqli_query($conn,$req_attribution);

                  //envoi d'un mail au responsable
                  $requete_mail = "select nom,email from utilisateur where role='chefdeprojet'";
                  $res_mail = mysqli_query($conn,$requete_mail);
                  while($l = mysqli_fetch_row($res_mail)){
                    $nom = $l[0];
                    $email =$l[1];

                    $to = $email;
                    $subject = "Nouveau Ticket";
                    $txt = "Bonjour ".$nom.", Un nouveau ticket a été crée.";
                    mail($to,$subject,$txt);
                  }
                  
                   
                } else {
                  echo mysqli_errno();
                  echo mysqli_error();
                  echo "<script type=\"text/javascript\">alert('Erreur : ".mysqli_error()."')</script>";
                }
                }
          ?>
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