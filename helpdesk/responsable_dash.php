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
<title>Dash</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style>
  .reset{
    color:#0ac6fc;
    background-color:white;
  }

.button3 {
  border-radius:10px;
  background-color: #28a745;
  border: none;
  color: white;
  padding: 7px 15px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  margin: 1px 1px;
  cursor: pointer;
}
.button4 {
  border-radius:10px;
  background-color: #dc3545;
  border: none;
  color: white;
  padding: 7px 15px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  margin: 1px 1px;
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

$requete = "SELECT titre,type,categorie,priorite,statut,nom,role,id_ticket,demandeur,technicien FROM ticket,utilisateur,attribution WHERE attribution.ticket=ticket.id_ticket GROUP BY titre";
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
   <div class="content three_quarter">
       <div class="scrollable">
        <br>
        <div style="text-align:center;"><h1><b>Mes Tickets</b></h1></div>
        <br>
        <table>
          <col style="width:20%">
          <col style="width:10%">
          <col style="width:10%">
          <col style="width:10%">
          <col style="width:10%">
          <col style="width:10%">
          <col style="width:10%">
          <col style="width:10%">
          <col style="width:10%">
          <thead>
            <tr> 
              <th>Titre</th>
              <th>Type</th>
              <th>Catégorie</th>
              <th>Priorité</th>
              <th>Technicien</th>
              <th>Demandeur</th>
              <th>Statut</th>
              <th>Action</th>
              <th>Vérification</th>
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
                $nom_utilisateur = $ligne[5];
                $role = $ligne[6];
                $id_ticket = $ligne[7];

                $technicien = $ligne[9];
                $demandeur = $ligne[8];

                $ticket_assigne = "submit";
                if($technicien) $ticket_assigne = "reset";
                

                //On donne la valeur hidden a la variable si le ticket n'est pas resolu, et la valeur visible si le ticket est resolu, pour pouvoir controler l'affichage des boutons de verification
                $ticket_resolu = "hidden";
                if(strcmp($statut,"resolu")==0){
                  $ticket_resolu="visible";
                }
                

                echo "<tr class='row'>
                        <td><b>".$titre."</b></td>
                        <td>".$type."</td>
                        <td>".$categorie."</td>
                        <td><b><span class='".$priorite."'>&nbsp;".$priorite."&nbsp;</span></b></td>
                        <td>".$technicien."</td>
                        <td>".$demandeur."</td>
                        <td><b><span class='".$statut."'>".$statut."</span></b></td>
                        <td>
                          <a href='attribution_ticket_technicien.php?ticket=".$id_ticket."'>
                            <button class='btn ".$ticket_assigne."' type='".$ticket_assigne."'>Assigner</button>
                          </a>
                        </td>
                        <td style='visibility:".$ticket_resolu.";' id='ticket_td'>
                        <form action='#' method='get' id='form_action'>
                          <a>
                            <input type='hidden' name='ticket_id' value='".$id_ticket."'/>
                            <button type='button' class='button3 cloturer' name='cloturer'>Clôturer</button>
                          </a>
                        </form>
                          <a href='attribution_ticket_technicien.php?ticket=".$id_ticket."'>
                            <button type='button' class='button4' name='reattribuer'>Reattribuer</button>
                          </a>
                        </td>
                        </tr>";
              
              }
              $colturer = $_POST['id_ticket'];

              if(isset($colturer) && !empty($colturer) ){
                  $requete_cloture = "UPDATE ticket SET statut='clos' WHERE id_ticket=".$_POST['id_ticket'];
                  //echo 'requete =='.$requete_cloture; 
                  $resultat = mysqli_query($conn,$requete_cloture);
              }
            
            ?>      
          </tbody>
        </table>
        <br>
      </div>
    </div>
 
  </main>
</div>

  <div id="copyright" class="hoc clear"> 
    <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved - <a href="#">Domain Name</a></p>
    <p class="fl_right">Template by <a target="_blank" href="https://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
  </div>


<!-- JAVASCRIPTS -->
<script type="text/javascript">
   $(document).ready(function(){
  $("#form_action .cloturer").click(function(){
    var tick_id = $(this).parent().find('input[name="ticket_id"]').val();
    var button_clot = $(this);
    var button = $(this).parents("#ticket_td").find('button[name="reattribuer"]');
    var status = $(this).parents(".row").find('td .resolu');
  
    $.ajax({
      url: '#',
      method : 'POST',
      data :{'id_ticket':tick_id},

      success: function(res){
        console.log("success");
        button_clot.hide();
        button.hide();
        status.text('clos');
        
      }
    }) 
  });
});

</script>


<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>

</body>
</html>