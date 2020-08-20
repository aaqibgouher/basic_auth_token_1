<?php include "header.php";?>		<!--imported the header file here, see how much advantage it has. If we dont do like that , then for every page , either it is register , login , index or home , for every page we have write its header. but here , no needed ! -->
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){		/*$_SERVER[] is one of the superglobals, it stored the information related with our files, root, etc. so there is a key , which is called REQUEST_METHOD, it checks that user is passing POST or GET method from that html. so we are checking it , if it is POST , then only it will go further.*/
	try{

		$user_email = trim($_REQUEST['email']);		/*we are just taking the email and pass while login*/
		$user_pass = trim($_REQUEST['pass']);

		if(!$user_email) throw new Exception("Email is required !");	/*checking that email and pass is there or not .*/
		if(!$user_pass) throw new Exception("Password is required !");
		
    	$result = mysqli_query($con,"select * from users where email = '$user_email' and password = '$user_pass'");			/*we are checking that the email and pass that user has entered , is matching with the users table data or not . */
    	$user = mysqli_fetch_assoc($result);		/*it will store the matched array.*/

    	if(!$user) throw new Exception("Correct Email and Password is required !");		/*if user array is true means email or pass both are true.*/

    	$user_token = bin2hex(random_bytes(20));		/*here we are generating the tokens,random bytes function generates token , it takes total number of size that the string that you want. But if we will write only random_bytes func , then it will give us value in binary , then to convert it into readable form i.e hexadecimal, we use that function. Every time , when we will call this function, the value will change.*/
    	$login_user_id = $user["id"];		/*if there is user, then using that user array, we are taking its ID, and storing it into a variable.*/

    	$result_new = mysqli_query($con,"insert into tokens values (null,'$login_user_id','$user_token')");		/*now we are storing id, that matched id, and token into the Tokens table. I have created that table in my Db.*/

    	$_SESSION["token"] = $user_token;		/*One thing , i wanna tell is that, before that we havent stored any kind tokens in our $_SESSION array, we are storing only if, all of the our login criteria is satisfied. Then , If there is value in $_SESSION , means what are the things we concluded here is : 1) user is already registered. 2) users email or pass is correctly matched with that what we have stored in our DB during registration time. 3) if there is value in $_SESSION means user is login, .. also in this project , same user can login from different devices . because , In Tokens table, we are taking the id of the user from users table, and storing it into tokens table . SO , now user can login !*/

    	
		if($result){		/*if result is true then storing the msg in var else storing the error in other varible.*/
			$message = "Successfully Logged-In !";
			
			header("location: home.php");		/*after all that, we are redirecting the user to home page of our website .*/

		}else{
			$error = "Error : ".mysqli_error($con);
		}

	}catch(Exception $e){
		$error = $e->getMessage();
	}
}

?>

<div class="container">
	<h1 style="text-align: center;">Login form </h1>
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4 my-div">
			<?php if($error){
				echo '<div class="alert alert-danger">'.$error.'</div>';
			}?>
			<?php if($message):?>
				<div class="alert alert-success"><?php echo $message;?></div>

			<?php endif;?>

			<form action="login.php" method="post">
				
				<div class="form-input">
				    <label for="email">Email :</label><br>
				    <input type="email" class="form-control" id="email" placeholder="Enter Your Email" name="email" required><br>
			  	</div>
				<div class="form-input">
					<label for="pass">Password:</label><br>
				    <input type="password" class="form-control" id="password" placeholder="Enter Your Password" name="pass" required>
				</div><br>
				<p>If You have not registered then <a href="register.php" style="color: rgb(153, 255, 102);">Click to Register</a></p>
				<button class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</div>
<?php include "footer.php";?>