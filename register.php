<?php
ob_start();
session_start();
include('db_con.php');
include('functions.php');


$errors = array();
$error = "";


if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['first_name']) && isset($_POST['surname'])) { 
    if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['first_name']) && !empty($_POST['surname'])) {
        
        $email = md5($_POST['email']);
        $email_hash = $email;
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];      
        $first_name = $_POST['first_name'];
        $surname = $_POST['surname'];
        $email_code = md5($_POST['email'] + microtime());


          if (loggedin()) {
            $first_name = get_field('first_name');
            $surname = get_field('surname');
            $errors[]= "You are already Registered loggedin"." ". $first_name." ". $surname;
          }else{
            
       

          if (matched_password($password, $confirm_password)) {
            $errors[] = "Password do not matched!";
          }

          if (strlen($_POST['password'] < 6)) {
            $errors[] = "Password's length must be at least 6 ";
          }



          if (email_exist($email)) {
            $errors[] = "Email Address Already exist";
          }else{


              $query = "INSERT INTO `users` VALUES('', '".$email_hash."', '".$password."', '".$first_name."', '".$surname."','".$email_code."');";
              if ($query_run=mysql_query($query)) {
                
                 //header("Refresh = '5' url=index.php");
                 header( "refresh:5;url=index.php" );
                $errors[] = "Your account has been registered You will be redirected shortly";
              }
          }

        }
}

   }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Register</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  <body class="text-center">



    <form class="form-signin" method="POST" action="register.php">
      <?php echo form_errors($errors);?>
      <!-- <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->
      <h1 class="h3 mb-3 font-weight-normal">Please Register:</h1>
      <label for="inputEmail" class="sr-only">Email address:</label>
      <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address"  required autofocus><br>
      <label for="inputPassword" class="sr-only">Password:</label>
      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
      <label for="inputPassword" class="sr-only">Confirm Password:</label>
      <input type="password" id="inputPassword" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
      <label for="inputPassword" class="sr-only">First Name:</label>
      <input type="text" id="inputPassword" name="first_name" class="form-control" placeholder="First Name" required>
      <label for="inputPassword" class="sr-only">Surname:</label><br>
      <input type="text" id="inputPassword" name="surname" class="form-control" placeholder="Surname" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Register</button><br>
      <a href="index.php">Already Register? Click here to Login</a>
      <p class="mt-5 mb-3 text-muted">&copy;  <?php echo date("Y");  ?> Deenquiz team</p>
    </form>
  </body>
</html>
