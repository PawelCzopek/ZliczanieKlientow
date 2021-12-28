<?php
	//strona glowna - logowanie w przegladarce internetowej
	//
	session_start();
	
	if( (isset($_SESSION['zalogowany'])) && ($SESSION['zalogowany']=true) )
	{
		header('location: shopfollow.php');
		exit();
	}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title></title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initialscale=1">
		
	<link rel="stylesheet" href="style.css" type="text/css" />
	
</head>

<body>

	<div id="container">
		<form action="zaloguj.php" method="post">
			
			<input type="text" name="login" placeholder="Login" onfocus="this.placeholder=''" onblur="this.placeholder='Login'">
			
			<input type="password" name="haslo" placeholder="Hasło" onfocus="this.placeholder=''" onblur="this.placeholder='Hasło'">
			
			<input type="submit"value="Zaloguj się">
			
		</form>

		<?php
			if( isset($_SESSION['blad']) )
			{
				echo $_SESSION['blad'];
			}
		?>
	</div>
	
</body>
</html>