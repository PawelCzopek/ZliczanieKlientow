<?php
	//sprawdzenie czy klient znajduje sie na terenie sklepu
	//
	session_start();
	//error: nie otrzymano zmiennych	
	if( (!isset($_GET['longitude'])) || (!isset($_GET['latitude'])) )
	{
		exit();
	}
	//wczytanie zmiennych zawierających informacje o hoscie i bazie danych
	require_once "connect.php";
	//ustawienie polaczenia z baza danych	
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if($polaczenie->connect_errno != 0)
	{
		echo "Error".$polaczenie->connect_errno;
	}
	else
	{
		$longitude = $_GET['longitude'];
		$latitude = $_GET['latitude'];
		
		if((!isset($_SESSION['clientInShop'])) || (!$_SESSION['clientInShop']))
		{
			if( $rezultat = @$polaczenie->query("SELECT * FROM sklepy WHERE along <= '$longitude' AND blong >= '$longitude'  AND alat >= '$latitude' AND dlat <= '$latitude'"))
			{
				$ilu_userow = $rezultat->num_rows;

				if($ilu_userow > 0)
				{
					$wiersz = $rezultat->fetch_assoc();

					$_SESSION['clientInShop'] = true;
					$_SESSION['id'] = $wiersz['id'];
					$_SESSION['shopName'] = $wiersz['sklep'];
					$_SESSION['shopAddress'] = $wiersz['address'];
					$_SESSION['along'] = $wiersz['along'];
					$_SESSION['alat'] = $wiersz['alat'];
					$_SESSION['blong'] = $wiersz['blong'];
					$_SESSION['blat'] = $wiersz['blat'];
					$_SESSION['clong'] = $wiersz['clong'];
					$_SESSION['clat'] = $wiersz['clat'];
					$_SESSION['dlong'] = $wiersz['dlong'];
					$_SESSION['dlat'] = $wiersz['dlat'];
					$_SESSION['numOfClients'] = $wiersz['klienci']+1;

					$_SESSION['addme'] = true;
					
					$csv_output = $_SESSION['id'].", ".$_SESSION['shopName'].", ".$_SESSION['shopAddress'].", ".$_SESSION['along'].", ".$_SESSION['alat'].", ".$_SESSION['blong'].", ".$_SESSION['dlat'].", ".$_SESSION['numOfClients']."\n";
					print $csv_output;

					unset($_SESSION['blad']);
					
					$rezultat->free_result();
				}
				else
				{
					$_SESSION['clientInShop'] = false;
				}
			}
		}
		else
		{
			if( ($_SESSION['along'] <= $longitude) && ($_SESSION['blong'] >= $longitude) && ($_SESSION['alat'] >= $latitude) && ($_SESSION['dlat'] <= $latitude)  )
			{
				$_SESSION['clientInShop'] = true;

				$csv_output = $_SESSION['id'].", ".$_SESSION['shopName'].", ".$_SESSION['shopAddress'].", ".$_SESSION['along'].", ".$_SESSION['alat'].", ".$_SESSION['blong'].", ".$_SESSION['dlat'].", ".$_SESSION['numOfClients']."\n";
				print $csv_output;
			}
			else
			{
				$_SESSION['clientInShop'] = false;
			}
		}
	//aktualizanja ilosci klientow w sklepie
	//dodanie klienta
		if((isset($_SESSION['clientInShop']))  &&  ($_SESSION['clientInShop']))
		{
			if($_SESSION['addme'])
			{
				$id = $_SESSION['id'];
				if( $rezultat = @$polaczenie->query("SELECT * FROM sklepy WHERE id = '$id'"))
                {
					$ilu_userow = $rezultat->num_rows;
					
                    if($ilu_userow > 0)
                    {
						$wiersz = $rezultat->fetch_assoc();
						
						$numOfClients = $wiersz['klienci'] + 1;
						
						@$polaczenie->query("UPDATE sklepy SET klienci = '$numOfClients' WHERE id = '$id'");
						
						$_SESSION['addme'] = false;
				
						unset($_SESSION['blad']);

						$rezultat->free_result();
					}
                }
			}
		}
		$polaczenie->close();
	}
?>
