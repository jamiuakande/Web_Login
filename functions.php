<?php
				function dn_redirect($new_location){
					header("Location:". $new_location);
						exit;
				}




				function form_errors($errors=array()){
						$output = " ";
						if (!empty($errors)) {
							$output .= "<div class=\"error\">";
							$output .= "Notice:";
							$output .= "<ul>";
							foreach($errors as  $error) {
								$output .= "<li>".$error."</li>";
							}
							$output .="</ul>";
							$output .="</div>";
						}
						return $output;
				}

		function loggedin(){
			if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
				return true;
			}else{
				return false;
			}
		}

			function get_field($field){
				$query = "SELECT `$field` FROM `users` WHERE `id` = '".$_SESSION['user_id']."' ";
						if($query_run = mysql_query($query)){
								if($result = mysql_result($query_run, 0, $field)){
									return $result;
								}
						}
							}

			function matched_password($password, $confirm_password){
			return ($password != $confirm_password);
          }

          function email_exist($email){

          	$query = "SELECT `email` FROM `users` WHERE `email` ='".$email_hash."'";
          	if($query_run = mysql_query($query)){
          		return (mysql_num_rows($query_run) == 1);
          		
          	}
          }




?>