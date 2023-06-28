<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="">
<head>
<title>Questions</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">
<?php
#connection to the database
$conn = mysqli_connect("localhost:3306","root","") or die("Erreur: Connection Issue");
$bd = mysqli_select_db($conn,"plagiarism_tester") or die("Errreur: Database Issue");


$_SESSION["student_id"] = $_GET['student'];
$_SESSION["assignment_id"] = $_GET['assignment'];

$default_student_id = $_SESSION["student_id"];
$default_assignment_id = $_SESSION["assignment_id"];

?>
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
        <br></br>
        <span class="center_title">Answer the questions to complete the test</span>
        <br></br><br>
      </article>
    </div>
  </div>
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <section id="introblocks">
      <ul class="nospace group elements elements-three">
        <?php 
        //Getting the questions' ids from the link
        $question_list = explode('|', $_GET['questions']); 
          //getting the question description for each of the 5 questions
          $index = 0;
          foreach ($question_list as $question_id) {
            $index++;
            $request_get_question = "select description from question where question_id=".$question_id;
            $request_get_question_result = mysqli_query($conn,$request_get_question);

          //displaying the questions 
            while($l = mysqli_fetch_row($request_get_question_result)){
              $description = $l[0];
              echo "<li class='one_third'>
                      <article>
                        <footer><a href='answer_form.php?question_id=".$question_id."&question_number=".$index."'><i class='fas fa-question'></i></a></footer>
                        <h6 class='heading'>Question ".$index."</h6>
                        <p>".$description."</p>
                      </article>
                    </li>";
            }
          }    
    ?>
      
      </ul>
    </section>
    <div class="clear"></div>
  </main>
</div>


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