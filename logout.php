<?php
	include "header.php";		
	session_unset();		/*this function, removed the values from $_SESSION .*/
	header("location: index.php");		/*so after logout , we are redirecting the user in index page . from where user can either login or register .*/
?>	