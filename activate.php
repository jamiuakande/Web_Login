<?php
ob_start();
include('functions.php');

if (isset($_GET['email'], $_GET['email_code']) ===true) {
	include('update.php');

}else{
	dn_redirect('index.php');
}



?>


<!DOCTYPE html>
<html>
<head>
	<title>Email Activate</title>
</head>
<body>

</body>
</html>