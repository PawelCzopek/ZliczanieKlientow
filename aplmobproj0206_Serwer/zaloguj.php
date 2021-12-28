<?php
	//logowanie do serwisu
	//
	session_start();
	
	if( (isset($_GET['login'])) || (isset($_GET['haslo'])) )
	{
		$login = $_GET['login'];
		$haslo = $_GET['haslo'];
	}
	elseif( (isset($_POST['login'])) || (isset($_POST['haslo'])) )
	{
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];
	}
	else
	{
		header('location: index.php');
		exit();
	}
	
	require_once "connect.php";
	
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if($polaczenie->connect_errno != 0)
	{
		echo "Error".$polaczenie->connect_errno;
	}
	else
	{
		$login = htmlentities($login, ENT_QUOTES, "uft-8");
		$haslo = htmlentities($haslo, ENT_QUOTES, "uft-8");
		
		if( $rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM users WHERE login = '%s' AND haslo = '%s'", 
		mysqli_real_escape_string($polaczenie,$login),
		mysqli_real_escape_string($polaczenie,$haslo)) ))
		{
			$ilu_userow = $rezultat->num_rows;
			
			if($ilu_userow > 0)
			{
				$_SESSION['zalogowany'] = "1, 2";
				
				//$wiersz = $rezultat->fetch_assoc();
				
				unset($_SESSION['blad']);
				
				$rezultat->free_result();
				
				if( (isset($_GET['login'])) )
				{
					print $_SESSION['zalogowany']."\n";
				}
				elseif( (isset($_POST['login'])) )
				{
					header('location: shopfollow.php');
				}
				//wysłanie informacji o zalogowaniu
				//echo "ok";
			}
			else
			{
				if( (isset($_GET['login'])) )
				{
					$_SESSION['zalogowany'] = "";
					print $_SESSION['zalogowany']."\n";
				}
				elseif( (isset($_POST['login'])) )
				{
					$_SESSION['blad'] = '<span style="color:red;">Nieprawidłowy login lub hasło</span>';
					header('location: index.php');
				}
				//wysłanie ingormacji o błędzie logowania
			}
		}
		
		$polaczenie->close();
	}
	
?>
