<?php
	// $con = mysql_connect("localhost","root","") or die(mysql_error());
	// mysql_select_db("one", $con) or die(mysql_error());
	if(mysql_connect("localhost","root","")){
		//echo "You are on the way!<br>";
	}else{
		echo "Error!";
	} 
	if(mysql_select_db("one")){
		//echo "Selection is ok<br>";
	}else{
		echo "Error!";
	}
?>