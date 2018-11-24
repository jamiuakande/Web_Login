<?php
include("db_con.php");
include("functions.php");
ob_start();
session_start();






 if(loggedin()){
 	 $email = get_field('email');
 	echo "You are truly logged in."." ".$email."<br>";
 	
 }else{
 	dn_redirect('index.php');
 }
	
?>