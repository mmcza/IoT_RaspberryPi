<?php
header('Content-type: application/json'); //naglowek do obslugi jsona
header('Access-Control-Allow-Origin: *');

$method = $_SERVER['REQUEST_METHOD'] ?? "GET";

switch($method)
{
    case 'GET':
        $command="python /home/RPI_Marcin/Desktop/Sense_hat/read_sensors/read_value_from_sensors.py -r -p -y -P -T -H";
        $message=shell_exec($command);
        echo($message);
        break;
    
    case 'POST':
        $command="python /home/RPI_Marcin/Desktop/Sense_hat/read_sensors/read_value_from_sensors.py";
        if(isset($_POST['r']))
        {
            $command = $command . " -r";
        }
        if(isset($_POST['p']))
        {
            $command = $command . " -p";
        }
        if(isset($_POST['y']))
        {
            $command = $command . " -y";
        }
        if(isset($_POST['u']))
        {
            if($_POST['u']=='rad')
            {
               $command = $command . " -u rad"; 
            }
            elseif($_POST['u']=='deg')
            {
               $command = $command . " -u deg"; 
            }
            else
            {
                echo('Wrong unit, value of roll/pitch/yaw will be displayed with default unit \n\r');
            }
        }
        if(isset($_POST['P']))
        {
            $command = $command . " -y";
        }
        if(isset($_POST['uP']))
        {
            if($_POST['uP']=='hPa')
            {
               $command = $command . " -uP hPa"; 
            }
            elseif($_POST['uP']=='mmHg')
            {
               $command = $command . " -uP mmHg"; 
            }
            else
            {
                echo('Wrong unit, value of pressure will be displayed with default unit \n\r');
            }
        }
        if(isset($_POST['T']))
        {
            $command = $command . " -T";
        }
        if(isset($_POST['uT']))
        {
            if($_POST['uT']=='C')
            {
               $command = $command . " -uT C"; 
            }
            elseif($_POST['uT']=='F')
            {
               $command = $command . " -uT F"; 
            }
            else
            {
                echo('Wrong unit, value of temperature will be displayed with default unit \n\r');
            }
        }        
        if(isset($_POST['H']))
        {
            $command = $command . " -H";
        }
        if(isset($_POST['uH']))
        {
            if($_POST['uH']=='%')
            {
               $command = $command . " -uH %"; 
            }
            elseif($_POST['uH']=='val')
            {
               $command = $command . " -uH val"; 
            }
            else
            {
                echo('Wrong unit, value of humidity will be displayed with default unit \n\r');
            }
        } 
        $message=shell_exec($command);
        echo($message);
}
