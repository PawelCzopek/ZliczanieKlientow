<?php
    //aktualizacja informacji o ilosci klientow w sklepie (pobranie informacji z bazy danych)
    //
    session_start();

    if( (!isset($_GET['id'])) )
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
        $id = $_GET['id'];

        if( $rezultat = @$polaczenie->query("SELECT * FROM sklepy WHERE id = '$id'"))
        {
            $ilu_userow = $rezultat->num_rows;

            if($ilu_userow > 0)
            {
                $wiersz = $rezultat->fetch_assoc();
                
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
                $_SESSION['numOfClients'] = $wiersz['klienci'];
					
				$csv_output = $_SESSION['id'].", ".$_SESSION['shopName'].", ".$_SESSION['shopAddress'].", ".$_SESSION['along'].", ".$_SESSION['alat'].", ".$_SESSION['blong'].", ".$_SESSION['dlat'].", ".$_SESSION['numOfClients']."\n";
                print $csv_output;
                
                unset($_SESSION['blad']);
                		
				$rezultat->free_result();
            }
        }
        $polaczenie->close();
    }
?>
