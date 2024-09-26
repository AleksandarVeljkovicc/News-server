<?php
require_once("inc/sessionStart.php")
?>

<?php

if(login())
{
	header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Log in</title>
	<link rel="stylesheet" href="css/logsingin_css.css"/>
	<link type="text/css" rel="stylesheet" href="css/mainpage_css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"/>  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

</head>
<body>

	<?php
	require_once("inc/header.php");
	?>

	<br></br>
	<br></br>

	<div id="singin_div">
	<form action="" method="POST">
		<h1>Log in</h1>

		<input  class="controls" id="username" type="text" name="username" placeholder="Username"> <br> 
		<input  class="controls" id="password" type="password" name="password" placeholder="Password">

		<input type="checkbox" id="cBox" name="cBox">
		<label for="cBox"><span style="color: white;">Remember me</span></label>

		<input class="controls" id="submit" type="submit" name="login" value="SING IN">
		<p><span style="color: white;">Don't have an account?</span><a href="singuppage.php" style="text-decoration: none;"> <span style="color: #d01729;">Sing up<span></a></p>
	</form>
	</div>

	<br>

	<div id="message_div">
		<?php
			require_once("inc/login.php");
		?>
	</div>

	<br></br>
		
	<?php
	require_once("inc/footer.php");
	?>

</body>
</html>