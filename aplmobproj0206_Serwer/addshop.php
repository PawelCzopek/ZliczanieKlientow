<?php
	//dodanie sklepu do bazy danych
	//
	//znajduje najmniejsza liczbe z 4 zmiennych
	function minimum($zm1, $zm2, $zm3, $zm4)
	{
		$min = $zm1;
		
		if($min > $zm2)
		{
			$min = $zm2;
		}
		if($min > $zm3)
		{
			$min = $zm3;
		}
		if($min > $zm4)
		{
			$min = $zm4;
		}
		
		return $min;
	}
	//znajduje majwieksza liczbe z 4 zmienych
	function maximum($zm1, $zm2, $zm3, $zm4)
	{
		$max = $zm1;
		
		if($max < $zm2)
		{
			$max = $zm2;
		}
		if($max < $zm3)
		{
			$max = $zm3;
		}
		if($max < $zm4)
		{
			$max = $zm4;
		}
		
		return $max;
	}
	//pobranie infirmacji o bazie danych
	require_once "connect.php";
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if($polaczenie->connect_erro != 0)
	{
		print "Błąd przy zapisywaniu\n";
		exit();
	}
	else
	{
		//wczytanie danych
		$shopName = $_GET['shopname'];
		$shopAddress = $_GET['shopaddress'];
		$aLong = $_GET['along'];//longitude
		$aLat = $_GET['alat'];//latitude
		$bLong = $_GET['blong'];
		$bLat = $_GET['blat'];
		$cLong = $_GET['clong'];
		$cLat = $_GET['clat'];
		$dLong = $_GET['dlong'];
		$dLat = $_GET['dlat'];
		//powieszchnia sklepu jest aproksymowana do prostokata, ktorego odpowiednie krawedzie sa rownolegle do rownoleznikiow i poludnikow
		//wybierane sa krytyczne, najbardziej odalone od siebie punkty
		$minlong = minimum($aLong, $bLong, $cLong, $dLong);
		$minlat = minimum($aLat, $bLat, $cLat, $dLat);
		
		$maxlong = maximum($aLong, $bLong, $cLong, $dLong);
		$maxlat = maximum($aLat, $bLat, $cLat, $dLat);
		//przypisanie nowych punktow/wspolrzednych
		$aLong = $minlong;
		$aLat = $maxlat;
		
		$bLong = $maxlong;
		$bLat = $maxlat;
		
		$cLong = $maxlong;
		$cLat = $minlat;
		
		$dLog = $minlong;
		$dLat = $minlat;
		
		@$polaczenie->query("INSERT INTO sklepy (sklep, address, along, alat, blong, blat, clong, clat, dlong, dlat) VALUES ('$shopName', '$shopAddress', '$aLong', '$aLat', '$bLong', '$bLat', '$cLong', '$cLat', '$dLong', '$dLat')");
		print "Zapisano\n";
		$polaczenie->close();
	}
?>
