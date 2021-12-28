<?php
	//dodanie klienta do liczby klientów w sklepie
	//
	session_start();
	//error: nie otrzymano zmiennych	
	if( (!isset($_GET['id'])) || (!isset($_GET['addme'])) )
	{
		exit();
	}
	//pobranie informacji o bazie danych
	require_once "connect.php";
	
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if($polaczenie->connect_errno != 0)
	{
		echo "Error".$polaczenie->connect_errno;
	}
	else
	{
		$_SESSION['addme'] = $_GET['addme'];
		$_SESSION['id'] = $_GET['id'];
		
		if($_SESSION['addme'])
		{
			$id = $_SESSION['id'];
			if( $rezultat = @$polaczenie->query("SELECT * FROM sklepy WHERE id = '$id'"))
            {
                $ilu_userow = $rezultat->num_rows;

                if($ilu_userow > 0)
                {
					$wiersz = $rezultat->fetch_assoc();
					//odjęcie klienta
                    $numOfClients = $wiersz['klienci'] + 1;
					//aktualizacja bazy danych
					@$polaczenie->query("UPDATE sklepy SET klienci = '$numOfClients' WHERE id = '$id'");
					//potwierdzenie odjecia klienta
					$_SESSION['addme'] = false;
					
					unset($_SESSION['blad']);
					
                    $rezultat->free_result();
				}
            }
        }
	}
?>
