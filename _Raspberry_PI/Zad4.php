<?php
header('Content-type: application/json'); //naglowek do obslugi jsona
header('Access-Control-Allow-Origin: *');

$method = $_SERVER['REQUEST_METHOD'] ?? "GET";

switch($method)
{
    case 'GET':
        $command="python /home/RPI_Marcin/Desktop/Sense_hat/read_matrix.py";
        $message=shell_exec($command);
        echo($message);
        break;
    
    case 'POST':
        if(isset($_POST['x']) && isset($_POST['y'])) //sprawdz czy uzytkownik podal koordynator x i y
        {
            if($_POST['x']>=0 && $_POST['x']<=7 && $_POST['y']>=0 && $_POST['y']<=7) //sprawdz czy x i y sa w zakresie matrycy
            {
                //print_r($_POST);
                $x=(int) $_POST['x']; //przypisz wartosc wczytanego parametru x do wektora w miejsce "x"
                $y=(int) $_POST['y']; //przypisz wartosc wczytanego parametru y do wektora w miejsce "y"
                $command = "python /home/RPI_Marcin/Desktop/Sense_hat/set_ledmatrix_cli.py -x $x -y $y";
                $index=$wczytane_dane['x']+$wczytane_dane['y']*8; 
                if(isset($_POST['R'])) //sprawdz czy uzytkownik podal wartosc dla koloru R
                {
                    $r = $_POST['R'];
                    $command = $command . " -r $r";
                }
                if(isset($_POST['G']))
                {
                    $g = $_POST['G'];
                    $command = $command . " -g $g";
                }
                if(isset($_POST['B']))
                {
                    $b = $_POST['B'];
                    $command = $command . " -b $b";
                }

                $message=shell_exec($command);
                //echo($message);
                print_r($message);
            }
            else
            {
                $message['error'] = "x or y coordinate is out of range \r\n";
                echo(json_encode($message)); 
            }
        }
        else
        {
            $message['error']  = "Please provide coordinate x and y \r\n"; 
            echo(json_encode($message));
        }
}
//echo(json_encode($message));
