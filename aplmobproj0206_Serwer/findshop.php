<?php
	//donajduje sklep w bazie danych 
    session_start();

    if( (!isset($_POST['shopName'])) || (!isset($_POST['shopAddress'])) )
	{
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
        $shopName = $_POST['shopName'];
        $shopAddress = $_POST['shopAddress'];

        if( $rezultat = @$polaczenie->query("SELECT * FROM sklepy WHERE sklep = '$shopName' AND address = '$shopAddress'"))
		{
			$ilu_userow = $rezultat->num_rows;

			if($ilu_userow > 0)
			{
				$wiersz = $rezultat->fetch_assoc();
				$_SESSION['id'] = $wiersz['id'];
				$_SESSION['shopName'] = $wiersz['sklep'];
				$_SESSION['shopaddress'] = $wiersz['address'];
				$_SESSION['along'] = $wiersz['along'];
				$_SESSION['alat'] = $wiersz['alat'];
				$_SESSION['blong'] = $wiersz['blong'];
				$_SESSION['blat'] = $wiersz['blat'];
				$_SESSION['clong'] = $wiersz['clong'];
				$_SESSION['clat'] = $wiersz['clat'];
				$_SESSION['dlong'] = $wiersz['dlong'];
				$_SESSION['dlat'] = $wiersz['dlat'];
				$_SESSION['numOfClients'] = $wiersz['klienci'];
				
				unset($_SESSION['blad']);
			}
			else
			{
				$_SESSION['blad'] = '<span style="color:red;">Nieprawidłowa nazwa sklepu lub adres.</span>';
				unset($_SESSION['id']);
			}
        }
	}
	$polaczenie->close();
	header('location: shopfollow.php');
?>