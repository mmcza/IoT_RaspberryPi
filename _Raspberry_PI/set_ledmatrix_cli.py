#!/usr/bin/env python3 
#-*- coding: utf-8 -*- 

from sense_hat import SenseHat
import json
import argparse

sense = SenseHat()

parser = argparse.ArgumentParser(description="Set pixels LED matrix")
parser.add_argument("-x", action='store', type=int, choices=range(0, 8), help="X coordinate of LED (0-7)", default=0)
parser.add_argument("-y", action='store', type=int, choices=range(0, 8), help="Y coordinate of LED (0-7)", default=0)
parser.add_argument("-r", action='store', type=int, choices=range(0, 256), help="Red (0-255)", default=0)
parser.add_argument("-g", action='store', type=int, choices=range(0, 256), help="Green (0-255)", default=0)
parser.add_argument("-b", action='store', type=int, choices=range(0, 256), help="Blue (0-255)", default=0)
parser.add_argument("-f", action='store', type=bool, help="Set all pixels to one color", default=False)
args = parser.parse_args()

r = args.r
g = args.g
b = args.b
color = (r, g, b)
message = {}

if args.f:
	sense.clear(color)
	message['LED_matrix'] = "Cleared matrix"
else:
	x = args.x
	y = args.y
	message['position']={}
	message['position']['x'] = x
	message['position']['y'] = y
	sense.set_pixel(x, y, color)

message['color']=color

print(json.dumps(message))
