<?php
header('Content-type: application/json'); //naglowek do obslugi jsona

$check_if_set=hexdec(shell_exec("i2cget -y 1 0x5C 0x20"));
shell_exec("i2cset -y 1 0x5C 0x20 0xC0");
$PRESS_OUT_XL=shell_exec("i2cget -y 1 0x5C 0x28");
$PRESS_OUT_L=shell_exec("i2cget -y 1 0x5C 0x29");
$PRESS_OUT_H=shell_exec("i2cget -y 1 0x5C 0x2A");

$PRESS_OUT = (hexdec($PRESS_OUT_H)*(16**4)+hexdec($PRESS_OUT_L)*(16**2)+hexdec($PRESS_OUT_XL))/4096;

//$message={};
$message['value']=$PRESS_OUT;
$message['unit']='hPa';
$message['sensor']='LPS25h';

echo(json_encode($message));
