#!/usr/bin/env python3 
#-*- coding: utf-8 -*- 

from sense_hat import SenseHat
import json

sense = SenseHat()

pixel_colors = sense.get_pixels()

pixel_colors_json = json.dumps(pixel_colors)
#print(pixel_colors_json)
#print("\n\r")
print(pixel_colors)
