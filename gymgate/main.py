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

    # Get the UID of the card
    (status, uid) = MIFAREReader.MFRC522_Anticoll()

    # If we have the UID, continue
    if status == MIFAREReader.MI_OK:
        # Turn on the light
        # @todo: make function of this to toggle
        LED_red.turn_on()

        card_uid = str(uid[0]) + "." + str(uid[1]) + "." + str(uid[2]) + "." + str(uid[3])

        # MySQL
        cursor_query_user = cnx.cursor(buffered=True)
        cursor_insert_activity = cnx.cursor(buffered=True)
        cursor_query_for_running_activity_by_user_id = cnx.cursor(buffered=True)

        # Request user
        query_user = (
            "SELECT id FROM gebruikers WHERE pasnummer = %s"
        )
        cursor_query_user.execute(query_user, (card_uid,))
        data_query_user = cursor_query_user.fetchone()
        user_id = data_query_user[0]

        query_for_running_activity_by_user_id = (
            "SELECT * FROM activiteiten WHERE `user_id` = %s and `eind_datum` is NULL"
        )

        cursor_query_for_running_activity_by_user_id.execute(query_for_running_activity_by_user_id, (user_id,))

        data_query_for_running_activity_by_user_id = cursor_query_for_running_activity_by_user_id.fetchall()

        amount_of_activities = len(data_query_for_running_activity_by_user_id)
        print("amount of activity: " + str(amount_of_activities))
        print(user_id)



        # insert_activity = (
        #     "INSERT INTO activiteiten(`user_id`, `automaat_id`, `begin_datum`) VALUES(%s, %s, NOW());"
        # )
        # cursor_insert_activity.execute(insert_activity, (AUTOMAAT_ID, ))
    else:
        LED_red.turn_off()

    time.sleep(5)
