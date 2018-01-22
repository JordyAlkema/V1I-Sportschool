# -*- coding: utf8 -*-
import RPi.GPIO as GPIO
import time

import MFRC522
import signal
from src.LED import LED
import mysql.connector

config = {
    'user': 'root',
    'password': '',
    'host': '192.168.42.7',
    'database': 'sportschool',
    'raise_on_warnings': True,
}

AUTOMAAT_ID = 1

cnx = mysql.connector.connect(**config)
continue_reading = True


# Capture SIGINT for cleanup when the script is aborted
def end_read(signal, frame):
    global continue_reading
    print("Ctrl+C captured, ending read.")
    continue_reading = False

    cnx.close()
    GPIO.cleanup()


# Hook the SIGINT
signal.signal(signal.SIGINT, end_read)

# Create an object of the class MFRC522
MIFAREReader = MFRC522.MFRC522()

GPIO.setmode(GPIO.BOARD)

LED_red = LED(GPIO, 12)

print("Gymgate scanner")
print("Press Ctrl-C to stop.")

while continue_reading:
    # Scan for cards
    (status, TagType) = MIFAREReader.MFRC522_Request(MIFAREReader.PICC_REQIDL)

    if status == MIFAREReader.MI_OK:
        print("Card detected")

    cursor_query_user = cnx.cursor(buffered=True)
    cursor_insert_activity = cnx.cursor(buffered=True)

    # Get the UID of the card
    (status, uid) = MIFAREReader.MFRC522_Anticoll()

    # If we have the UID, continue
    if status == MIFAREReader.MI_OK:
        LED_red.turn_on()

        number = str(uid[0]) + "." + str(uid[1]) + "." + str(uid[2]) + "." + str(uid[3])

        query_user = (
            "SELECT id FROM gebruikers WHERE pasnummer = %s"
        )

        cursor_query_user.execute(query_user, (number,))
        data_query_user = cursor_query_user.fetchall()

        user_id = data_query_user[0][0]


        # insert_activity = (
        #     "INSERT INTO activiteiten(`user_id`, `automaat_id`, `begin_datum`) VALUES(%s, %s, NOW());"
        # )
        # cursor_insert_activity.execute(insert_activity, (AUTOMAAT_ID, ))
    else:
        red.turn_off()

    time.sleep(5)
