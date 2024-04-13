#!/usr/bin/env python3 
#-*- coding: utf-8 -*- 

from sense_hat import SenseHat
import json
import argparse
import math

sense = SenseHat()

parser = argparse.ArgumentParser(description="Read data from sensors on Sense HAT")
parser.add_argument("-r", action='store_const', help="Add if you want to read roll", default=False, const=True)
parser.add_argument("-p", action='store_const', help="Add if you want to read pitch", default=False, const=True)
parser.add_argument("-y", action='store_const', help="Add if you want to read yaw", default=False, const=True)
parser.add_argument("-u", action='store', choices=['deg','rad'],help="Choose unit for roll/pitch/yaw", default="deg")
parser.add_argument("-P", action='store_const', help="Add if you want to read pressure", default=False, const=True)
parser.add_argument("-uP", action='store', choices=['hPa','mmHg'],help="Choose unit for pressure", default="hPa")
parser.add_argument("-T", action='store_const', help="Add if you want to read temperature", default=False, const=True)
parser.add_argument("-uT", action='store', choices=['C','F'],help="Choose unit for temperature", default="C")
parser.add_argument("-H", action='store_const', help="Add if you want to read humidity", default=False, const=True)
parser.add_argument("-uH", action='store', choices=['%','val'],help="Choose unit for humidity", default="%")
args = parser.parse_args()

message={}

if args.r:
	message['roll']={}
	message['roll']['unit']=args.u
	message['roll']['sensor']='LSM9DS1'
	if args.u == 'rad':
		message['roll']['val']=sense.get_orientation()['roll']*math.pi/180
	else:
		message['roll']['val']=sense.get_orientation()['roll']
if args.p:
	message['pitch']={}
	message['pitch']['unit']=args.u
	message['pitch']['sensor']='LSM9DS1'
	if args.u == 'rad':
		message['pitch']['val']=sense.get_orientation()['pitch']*math.pi/180
	else:	
		message['pitch']['val']=sense.get_orientation()['pitch']
if args.y:
	message['yaw']={}
	message['yaw']['unit']=args.u
	message['yaw']['sensor']='LSM9DS1'
	if args.u == 'rad':
		message['yaw']['val']=sense.get_orientation()['yaw']*math.pi/180
	else:	
		message['yaw']['val']=sense.get_orientation()['yaw']

if args.P:
	message['pressure']={}
	message['pressure']['unit']=args.uP
	message['pressure']['sensor']='LPS25HB'
	if args.uP == 'mmHg':
		message['pressure']['val']=sense.get_pressure()*0.75006157584566
	else:
		message['pressure']['val']=sense.get_pressure()
		
if args.T:
	message['temperature']={}
	message['temperature']['unit']=args.uT
	message['temperature']['sensor']='LPS25HB'
	if args.uT == 'F':
		message['temperature']['val']=sense.get_temperature_from_pressure()*9/5 + 32
	else:
		message['temperature']['val']=sense.get_temperature_from_pressure()	

if args.H:
	message['humidity']={}
	message['humidity']['unit']=args.uH
	message['humidity']['sensor']='HTS221'
	if args.uH == 'val':
		message['humidity']['val']=sense.get_humidity()/100
	else:
		message['humidity']['val']=sense.get_humidity()		

print(json.dumps(message))
