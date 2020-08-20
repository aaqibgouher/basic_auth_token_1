 <?php include "function.php"; ?>       <!--if we are using php, then php should be the first line !-->
<!DOCTYPE html>
<html lang="en">
<head>

	<title>Registration-page</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">        <!--included bootstrap here-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>         /*some basic internal CSS*/
    	.my-div-1{
            text-align: center;
            font-size: 20px;

        }
        body {
            background-color: rgb(77, 0, 38);
        }
        p,h1,h2,h3,label{
            color: white;
        }
        a {
            color: rgb(77, 0, 38);
        }
       
    	
	</style>
</head>
<body>
    <nav class="navbar navbar-default">     <!--used navabr here-->
        <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="#">BASIC AUTH 2</a>
            </div>
            <?php if(is_login()): ?>    <!-- calling that is_login fucntion, that we have written in function.php file, so we have imported here, everything that is on that file will be present here. If the user is login , then this navbar details will show else other one !-->
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
            <?php else: ?>
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                  <li><a href="register.php"><span class="glyphicon glyphicon-book"></span> Register</a></li>
                </ul>
            <?php endif; ?>
        </div>
    </nav>
    