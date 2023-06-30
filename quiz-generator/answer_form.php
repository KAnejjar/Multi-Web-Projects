<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="">
<head>
<title>Plagiarism Checker</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">
  <div class="bgded" style="background-image:url('images/demo/backgrounds/01.webp');"> 
    <div class="wrapper overlay row0">
      <div id="topbar" class="hoc clear">
        <div class="fl_left"> 
        </div>
      </div>
    </div>
  </div>

  <div class="wrapper overlay">
    <div id="pageintro2" class="hoc"> 
      <article>
        <h3 class="heading">Welcome To Plagiarism Checker</h3>
      </article>
    </div>
  </div>

<?php
#connection to the database
$conn = mysqli_connect("localhost:3306","root","") or die("Erreur: Connection Issue");
$bd = mysqli_select_db($conn,"plagiarism_tester") or die("Errreur: Database Issue");

#getting the question whole description
$question_id = $_GET['question_id'];
$question_number = $_GET['question_number'];
$question_details = "select description,choices from question where question_id=".$question_id;
$question_details_result = mysqli_query($conn,$question_details);

while($l = mysqli_fetch_row($question_details_result)){
  $description = $l[0];
  $choices = $l[1];
  $array_choices = explode(',', $choices);
?>
<div class="bgded overlay row4" style="background-image:url('images/demo/backgrounds/01.png');">
  <footer id="footer" class="hoc clear"> 
    <figure id="ctdetails">
      <ul class="nospace group">
        <li class="one_quarter first">
          <div class="clear"><a href="questions.php"><i class="fas fa-question"></i></a> <span><strong>Questions</strong>Return to Questions</span></div>
        </li>
        <li class="one_quarter">
          <div class="clear"><a href="answers.php"><i class="fas fa-reply"></i></a> <span><strong>Answers</strong>See all the answers</span></div>
        </li>
        <li class="one_quarter">
          <div class="clear"><a href="file_upload.php"><i class="fas fa-file"></i></a> <span><strong>Upload</strong>Upload a new file</span></div>
        </li>
        <li class="">
        </li>
        <li class="one_quarter">
          <div class="clear"><a href="test_results.php"><i class="fas fa-check"></i></a> <span><strong>Results</strong>Test results</span></div>
        </li>
      </ul>
    </figure>
    <div class="">
      <form action="#" method="get">
        <h6 class="heading">Question <?php echo $question_number;?></h6>
          <input type="hidden" name="question_id" value="<?php echo($question_id);?>"/>
          <textarea class="mytextarea" readonly><?php echo $description;?></textarea>
          <br></br>
          <?php
          foreach($array_choices as $choice)
            echo ' <label class="rcontainer">'.$choice.'
                    <input type="radio" name="radio" value="'.$choice.'">
                    <span class="rcheckmark"></span>
                  </label>';
          ?>
          <br></br>
          <button class="btn" type="submit" name="send_response">Submit</button>

          <?php
        }
          //insert the answer enterd by the student
          if (isset($_GET['send_response'])){
            $submission_id = $_SESSION["submission_id"];
            $question = $_GET['question_id'];
            $response = $_GET['radio'];

            $ready_for_results="";
            $req_insert_response = "insert into response (submission,question,response) values(".$submission_id.",".$question.",'".$response."')";
            $resultat = mysqli_query($conn,$req_insert_response);

            $count_reponses = "select count(response_id) from response where submission=".$submission_id;
            $responses = mysqli_query($conn,$count_reponses);
            $count_resp=0;
            while($l = mysqli_fetch_row($responses)){
                $count_resp = $l[0];
            }
            if($count_resp == 5){
              $ready_for_results = 'Consult Results page to see your Test results';
            }

            if($resultat){
              echo "<script type=\"text/javascript\">alert('Success : Answer Submited! ".$ready_for_results."')</script>";
            }
            else echo "<script type=\"text/javascript\">alert('Erreur : Error while submiting, try again')</script>";
          
          
          }

          ?>
      </form>
    </div>
  </footer>
</div>
  <div class="wrapper row5">
    <div id="copyright" class="hoc clear"> 
      <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved - <a href="#">Domain Name</a></p>
      <p class="fl_right">Template by <a target="_blank" href="https://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
    </div>
  </div>

<a id="backtotop" href="#top"><i class="fas fa-chevron-up"></i></a>
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
<script src="layout/scripts/jquery.easypiechart.min.js"></script>
</body>
</html>