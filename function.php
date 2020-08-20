<?php
	include "database.php";			/*included database file here, so now the connection with DB is done .*/

	function is_login(){		/*in this function, we are checking that , user is login or not using $_SESSION var. IN $_SESSION var , we are storing the tokens actually , you will understand what is token later !*/

		if($_SESSION["token"]){			/*If there will be token in $_SESSION var , then return true else false*/
			return true;
		}else{
			return false;
		}
		
	}

	function get_login_user(){		/*this function is called from home page to retrieve the users data.*/
		global $con;		/*we are using the $con var , that we have alreadt defined in the dataabse php file, so we are using it here , so we have defined it in global keyword*/
		
		$session_token = $_SESSION["token"];	/*if there is token value in the $_SESSION either a value or null, both will store here .*/	

		if($session_token){			/*if it is true ,means there is token value in $_SESSION, means user is login .if any doubt here , go and checkout the login.php file.*/
			$result = mysqli_query($con,"select users_id from tokens where token = '$session_token'");		/*then we are connecting with our DB , and then we are selecting only user_id from token table , by comparing the token that already exist there and the token that stored in the $_SESSION . Any col, that will match stores in the $result var.*/
			$user_id = mysqli_fetch_assoc($result);			/*we are fetching all the results and storing it in user_id array.*/
			$user_id = $user_id['users_id'];		/*now in that array , we are taking only id , and storing it into a var . Dont confuse here , before when we fetched the data , $_user_id was an array , but now we have changed it to integer var.*/

			// echo $user_id;
			$result = mysqli_query($con, "select * from users where id = '$user_id'");		/*now here , simplt using that id , we are fetching all of the datas from user table , and storing it inot result*/
					
			$user_data = mysqli_fetch_assoc($result);		/*storing the data into an array .*/
			return $user_data;		/*we are just returning that object .*/
		}else{
			header("location: index.php");
		}
		
	}

	

?>