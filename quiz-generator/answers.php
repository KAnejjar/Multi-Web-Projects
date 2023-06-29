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
<?php
#connection to the database
$conn = mysqli_connect("localhost:3306","root","") or die("Erreur: Connection Issue");
$bd = mysqli_select_db($conn,"plagiarism_tester") or die("Errreur: Database Issue");

// $default_student_id = 1;
// $default_assignment_id = 1;
$default_student_id = $_SESSION["student_id"];
$default_assignment_id = $_SESSION["assignment_id"];
$submission = $_SESSION["submission_id"];

$get_questions_answers = "select description, response from question,response where response.question=question.question_id and response.submission=".$submission;
$questions_answers = mysqli_query($conn,$get_questions_answers);

$nbr = 0;

?>
<div class="bgded overlay" style="background-image:url('images/demo/backgrounds/01.png');">
  <section id="services" class="hoc container clear"> 
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
    <div class="sectiontitle">
      <h6 class="heading font-x2">Your Answers</h6>
    </div>
    <ul class="nospace group elements elements-three">
      <?php 
      while($l = mysqli_fetch_row($questions_answers)){
        $nbr++;
        $description = $l[0];
        $response = $l[1];

        echo '<li class="one_third">
                  <article>
                    <div>
                      <footer><a href="#"><i class="fas fa-reply"></i></a></footer>
                      <h6 class="heading">Question '.$nbr.'</h6>
                    </div>
                    <p>'.$description.'</p>
                    <p><a href="#">Answer : </a> '.$response.'</p>
                  </article>
                </li>';
      }
      ?>   
    </ul>
  </section>
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