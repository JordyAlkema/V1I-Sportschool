#!/usr/bin/python
# -*- coding: utf8 -*-
import RPi.GPIO as GPIO
import MFRC522
import signal
from src.LED import LED

#
# import mysql.connector
#
# config = {
#   'user': 'scott',
#   'password': 'password',
#   'host': '127.0.0.1',
#   'database': 'employees',
#   'raise_on_warnings': True,
#   'use_pure': False,
# }
#
# cnx = mysql.connector.connect(**config)
#
# cnx.close()

continue_reading = True

# Capture SIGINT for cleanup when the script is aborted
def end_read(signal,frame):
    global continue_reading
    print "Ctrl+C captured, ending read."
    continue_reading = False
    GPIO.cleanup()

# Hook the SIGINT
signal.signal(signal.SIGINT, end_read)

# Create an object of the class MFRC522
MIFAREReader = MFRC522.MFRC522()

GPIO.setmode(GPIO.BCM)

red = LED(GPIO, 18)


# Welcome message
print "Welcome to the MFRC522 data read example"
print "Press Ctrl-C to stop."

# This loop keeps checking for chips. If one is near it will get the UID and authenticate
while continue_reading:
    # Scan for cards
    (status,TagType) = MIFAREReader.MFRC522_Request(MIFAREReader.PICC_REQIDL)

    # If a card is found
    if status == MIFAREReader.MI_OK:
        print "Card detected"

    # Get the UID of the card
    (status,uid) = MIFAREReader.MFRC522_Anticoll()

    # If we have the UID, continue
    if status == MIFAREReader.MI_OK:
        red.turn_on()
        print str(uid[0])+"."+str(uid[1])+"."+str(uid[2])+"."+str(uid[3])
    else:
        red.turn_off()

