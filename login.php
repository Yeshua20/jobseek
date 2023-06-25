<?php
session_start();
error_reporting(0);

    $err="";
    $fname="";
    $password="";

    $conn=mysqli_connect("localhost", "root","","login_db");

    if(isset($_POST['login'])){
      $fname=mysqli_real_escape_string($conn,$_POST['fname']);
      $password=mysqli_real_escape_string($conn,$_POST['password']);
    
      $sql="SELECT * FROM user WHERE firstname='".$fname."' and password='".$password."' ";

      $result=mysqli_query($conn,$sql);
      $row=mysqli_fetch_array($result);
    
      if($row["usertype"]=="applicant"){
    
        header('location:seekerLanding.php');

      } else if ($row["usertype"]=="employer"){
        header('location:employer.php');
      } else{
        if(empty($fname)){
          $err="Username is Required ";
        } else if(empty($password)){
          $err="Password is Required ";
      } else{
        $err="Incorrect Password or Username ";    
      }
      }}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/login.css">
    <title>Log In</title>
</head>
<body>
    

<div class="login-page">
  <div class="form">
    <!-- <form class="register-form">
      <input type="text" placeholder="name"/>
      <input type="password" placeholder="password"/>
      <input type="text" placeholder="email address"/>
      <button>create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form> -->

    <form class="login-form" action="login.php" method="post">
    <img src="./Accesories/assets/felagi-dark.PNG" alt="" width="50" height="50" id="form-logo">
    <p class="job-seeker">JOB SEEKER/EMPLOYER</p>

   <div class="err">
    <?php
        echo $err;
    ?>
   </div>

      <input type="text" placeholder="username" name="fname"/>
      <input type="password" placeholder="password" name="password"/>
      <input type="submit" value="LOGIN" name="login" class="button">
      <p class="message">Not registered? <a href="signup.php">Create an account</a></p>
    </form>
  </div>
</div>
</body>