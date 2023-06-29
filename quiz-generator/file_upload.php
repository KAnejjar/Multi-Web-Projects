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
<?php
#connection to the database
$conn = mysqli_connect("localhost:3306","root","") or die("Erreur: Connection Issue");
$bd = mysqli_select_db($conn,"plagiarism_tester") or die("Errreur: Database Issue");


if(isset($_GET['continue_to_upload'])){
  $success_coutner = 0;

  $student_name = $_GET['student_name'];
  $student_id = $_GET['student_id'];
  $student_mail = $_GET['student_mail'];
  
  $course_name = $_GET['course_name'];
  $unit_name = $_GET['unit_name'];
  $assignment_name = $_GET['assignment_name'];
  
  $store_student_request = "insert into student (name,email,password) values ('".$student_name."','".$student_mail."','default_pwd')";
  $store_student_execution = mysqli_query($conn,$store_student_request);
  if($store_student_execution){
    $last_inserted_student = mysqli_insert_id($conn);
    $success_coutner+=1;
    $_SESSION["student_id"] = $last_inserted_student;
  }
  else{
    $_SESSION["student_id"] = 1;
  }

  $store_course_request = "insert into course(name,description,convenor) values('".$course_name."','".$course_name."',1)";
  $store_course_execution = mysqli_query($conn,$store_course_request);
  if($store_course_execution){
    $success_coutner+=1;
    $last_inserted_course = mysqli_insert_id($conn);
    $store_assignment_request = "insert into assignment(course,description) values(".$last_inserted_course.",'".$assignment_name."')";
    $store_assignment_execution = mysqli_query($conn,$store_assignment_request);
    if($store_assignment_execution){
      $success_coutner+=1;
      $last_inserted_assignment= mysqli_insert_id($conn);
      $_SESSION["assignment_id"] = $last_inserted_assignment;
    }
  }
  else{
    $_SESSION["assignment_id"] = 1;
  }

  if($success_coutner >2){
    echo "<script type=\"text/javascript\">alert('Success : Continue to upload your assignment')</script>";
  }
  else{
    echo "<script type=\"text/javascript\">alert('Error : An error has Occurred')</script>";
  }


}
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
      </article>
    </div>
  </div>

<?php

?>
  <div class="wrapper coloured">
    <article id="cta" class="hoc container clear"> 
        <form method="post" action="questions.php" enctype="multipart/form-data">
          <p>File upload</p>
          <h6 class="heading"><span>&ldquo;</span>Upload a file and continue<span>&bdquo;</span></h6>
          <input type="file" name="file_up" id="file" class="btn file"/>
          <br></br><!-- <br></br>
          <p style="left:80px; background-color:yellow;">
          <label class="bcontainer" >Hello U
            <input type="radio" name="radio" value="Hello U" >
            <span class="bcheckmark"></span>
          </label>
          </p>
          <br></br><br></br><br></br> -->
          <p><input type="submit" class="white_transparent" name="upload" value="Continue"></input></p>

        </form>
    </article>
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