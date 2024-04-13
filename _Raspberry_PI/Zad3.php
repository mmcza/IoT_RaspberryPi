<?php
header('Content-type: application/json'); //naglowek do obslugi jsona

$command="python /home/RPI_Marcin/Desktop/Sense_hat/read_matrix.py";
$message=shell_exec($command);
echo($message);
