#!/usr/bin/env python3 
#-*- coding: utf-8 -*- 

from sense_hat import SenseHat
import json

sense = SenseHat()

read_pressure = sense.get_pressure()

pressure = {
  "pressure": read_pressure,
  "sensor": "LPS25h",
  "unit": "hPa"
}

read_pressure_json = json.dumps(pressure)
#print(pixel_colors_json)
#print("\n\r")
print(read_pressure_json)
