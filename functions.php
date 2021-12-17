<?php

function mysqliconnect(){

    session_start();

    define('URL', 'http://localhost/ustacky/');

    define("DBHOST", "localhost:3308");
    define('DBNAME', 'ustacky');
    define('USERNAME', 'root');
    define('PASSWORD', '');


    try{
        return mysqli_connect(DBHOST, USERNAME, PASSWORD, DBNAME);
    }

    catch( Exception $exception ){
        die("Failed to connect to database!");
    }
    
}

function topNav($title){

  echo  <<<EOT

    <!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>$title</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/ajax-script.js"></script>
</head>
<body>
	
<section class="background">
	<div class="header">
		<div class="name">
			<h1>Ustacky</h1>
		</div>

		<div class="navbar">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="portalForm.php">Get Started</a></li>
			</ul>
		</div>
	</div>


EOT;

}


function footer(){
    
    echo <<<EOT

    <footer class="footer">
		<p>All Rights Reserved &copy; 2021</p>
	</footer>

</body>
</html>


EOT;
}







?>
