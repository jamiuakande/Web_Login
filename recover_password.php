<?php
include('functions.php');
$errors = array();
$error = "";
include('db_con.php');
if (isset($_POST['email'])) {  
      if (!empty($_POST['email'])) {
        $email =(md5($_POST['email']));
        $email_hash = $email; 
        //$email_code = md5($_POST['email'] + microtime());
        $query = ("SELECT `email` FROM `users` WHERE `email` ='$email_hash'");
          if($query_run = mysql_query($query)){
            $query_num_rows = mysql_num_rows($query_run);
              if ($query_num_rows == 0) {
                $errors[] = "Enter a Registered Email Address";
                  }else if ($query_num_rows == 1){
                    $email = $_POST['email'];
                    //$email_hash = $email;
                    $email_code = md5($_POST['email'] + microtime());
                    $title = "Deenquiz!";
                    $body = "Click on the link below to reset your password"." "."http://localhost/php/update.php?email='".md5($email)."'&email_code=".$email_code."";
                    $header = "From Deenquiz";
                      if (mail($email, $title, $body, $header)) {
                        $errors [] = "A link to reset your password has been sent to your email, login to reset your password!";
                      header( "refresh:5;url=index.php" );
                          }else{
                            $errors [] = "Error!/No Internet Access";
            }

            //header("Location: main.php");
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

    <title>Recover Password</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    
    <form class="form-signin" method="POST" action="recover_password.php">
      <?php echo form_errors($errors);?>
      <!-- <p><i><b>NOTE:</b></i> enter a Registered Email Address</p> -->
      <!-- <h5 class="h3 mb-3 font-weight-normal">Enter a registered Email Address</h5> -->
      <h2 class="h3 mb-3 font-weight-normal">Recover Password:</h2>
      <label for="inputEmail" class="sr-only">Email address:</label>
      <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Enter Email address"  required autofocus><br>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Recover</button><br>
      <a href="register.php">I don't Have an account yet, Click here to register</a><br><br>
      <a href="index.php">BACK</a>
      <p class="mt-5 mb-3 text-muted">&copy;  <?php echo date("Y");  ?> Deenquiz team</p>
    </form>
  </body>
</html>
