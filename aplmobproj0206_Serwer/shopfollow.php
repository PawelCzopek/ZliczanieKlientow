<?php
    //sledenie ilosci klientow w sklepie
    //
    session_start();

    require_once "connect.php";

    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <title>Page Title</title>

        <meta name="author" content="Paweł Czopek">

        <meta charset="UTF-8">
        <meta name="description" content="Kontriluj ilość klientów w sklepie">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="refresh" content="30"><!-- odswierza stronę co 30 sekund -->
        

        <link rel="stylesheet" href="style.css" type="text/css"/>
        <!-- <script src="scripts.js"> -->
    </head>
    <body>
        <div id="container">
            <header>
                Ilość klientów w twoim sklepie.
            </header>
            <nav>
                <a href="logout.php">Wyloguj się!</a>
            </nav>
            <div style="clear:both;"></div>
            <main>
                <form action="findshop.php" method="post">
                        <div class="label"><label for="shopName">Nazwa sklepu</label></div>
                        <input type="text" id="shopName" name="shopName" value="">
                        <div class="label"><label for="shopAddress">Adres sklepu</label></div>
                        <input type="text" id="shopAddress" name="shopAddress" value="">
                        <div style="clear:both;"></div>
                        <input type="submit" value="Znajdź"/>
                    </form>
            
            <?php
                //wyszukanie sklepu
                if(isset($_SESSION['id']))
                {
                    if($polaczenie->connect_errno != 0)
                    {
                        echo "Error".$polaczenie->connect_errno;
                    }
                    else
                    {
                        $id = $_SESSION['id'];
                
                        if( $rezultat = @$polaczenie->query("SELECT * FROM sklepy WHERE id = '$id'"))
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
                                
                                //wiadomosc - ilosc klientow w sklepie
                                $message='<div class="message">'.$_SESSION['shopName']." ".$_SESSION['shopaddress'].'</div><div class="message">'."Ilość klientów w sklepie: ".$_SESSION['numOfClients'].'</div>';
                                unset($_SESSION['blad']);

                                echo $message;

                            }
                            else
                            {
                                $_SESSION['blad'] = '<span style="color:red;">Nieprawidłowa nazwa sklepu lub aders.</span>';
                                unset($message);
                            }
                        }
                       
                    }
                    
                }
                if(isset($_SESSION['blad']))
                {
                    //wyswietlenie informacji
                    echo $_SESSION['blad'];
                }

                $polaczenie->close();
            ?>

            </main>
            <footer>
                <!--Paweł Czopek-->
            </footer>
        </div>
    </body>
</html>
