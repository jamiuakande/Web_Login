<?php
include("functions.php");
session_start();




if (loggedin()) {
	echo "you are already loggedin";
echo "You are signed in already <a href='sign_out.php'>Sign Out!</a></br>";
echo "<a href='main.php'>Main  Area!</a></br>";
}else{
	dn_redirect('index.php');
}
?>