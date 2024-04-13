<?php
header('Content-type: application/json'); //naglowek do obslugi jsona

if(isset($_GET['v']))
{
	if($_GET['v']=='1')
	{
		$command="php /home/RPI_Marcin/Desktop/Sense_hat/i2c_sensor_read/read_LPS25H.php";
		$message=shell_exec($command);
		echo($message);
	}
	elseif($_GET['v']=='2')
	{
		$command="python /home/RPI_Marcin/Desktop/Sense_hat/read_sensors/read_LPS25h.py";
		$message['value']=str_replace("\n","",shell_exec($command));
		$message['unit']='hPa';
		$message['sensor']='LPS25h';
		echo(json_encode($message));
	}
}
