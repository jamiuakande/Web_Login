<?php
ob_start();
session_start();
include('db_con.php');
include('functions.php');


 if (isset($_SESSION['user_id'])) {
   dn_redirect('conv.php');
 }




$errors = array();
$error = "";


if (isset($_POST['email']) && isset($_POST['password'])) {  
      if (!empty($_POST['email']) && !empty($_POST['password'])) {
           

            $email =trim(md5($_POST['email']));
            $email_hash = $email;
            $password = trim($_POST['password']);
        
        $query = ("SELECT `id` FROM `users` WHERE `email` ='$email_hash' AND `password` = '$password'");
        if($query_run = mysql_query($query)){
          $query_num_rows = mysql_num_rows($query_run);
         
          if ($query_num_rows == 0) {
            
            $errors[] = "Invalid Username/Password";
          }else if ($query_num_rows == 1){
            $user_id = mysql_result($query_run, 0, `id`);
            $_SESSION['user_id'] = $user_id;
            //header("Location: main.php");
            header( "refresh:3;url=main.php" );
            $errors[]= "Login successful, Redirecting....";
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
<!-- <script>
    alert("Welcome to the newly improved Dawah Nigeria Quiz app, its the same app you have been used to, we've only improved the authentication and other features to make it easier to use. Click Ok to start login process");
</script> -->
    <title>Signin</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  <body class="text-center">

    <form class="form-signin" method="POST" action="index.php">
      <img src="dn.png" alt="Avatar"  style="width:200px">
      <?php echo form_errors($errors);?>
      <!-- <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->
      <h1 class="h4 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address"  required autofocus><br>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button><br>
      <a href="register.php">I don't Have an account yet, Click here to register</a><br><br>
      <a href="recover_password.php">Forget Password</a>
      <p class="mt-5 mb-3 text-muted">&copy;  <?php echo date("Y");  ?> Deenquiz team</p>
    </form>

  </body>
</html>
