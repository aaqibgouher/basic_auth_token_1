<?php
	include "database.php";			/*included database file here, so now the connection with DB is done .*/

	function is_login(){		/*in this function, we are checking that , user is login or not using $_SESSION var.*/
		// if user is login then do nothing
		// else redirect to login page

		if($_SESSION["token"]){		
			return true;
		}else{
			return false;
		}
		
	}

	function get_login_user(){		/*this function is called from home page to retrieve the users data.*/
		global $con;		/*we are using the $con var , that we have alreadt defined in the dataabse php file, so we are using it here , so we have defined it in global keyword*/
		// $user = [];
		// logic
		$session_token = $_SESSION["token"];		

		if($session_token){		
			$result = mysqli_query($con,"select users_id from tokens where token = '$session_token'");
			$user_id = mysqli_fetch_assoc($result);
			$user_id = $user_id['users_id'];

			// echo $user_id;
			$result = mysqli_query($con, "select * from users where id = '$user_id'");
					
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;		/*we are just returning that object .*/
		}else{
			header("location: index.php");
		}
		
	}

	

?>