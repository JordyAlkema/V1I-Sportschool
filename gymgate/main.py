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

red = LED(GPIO, 12)

# Welcome message
print("Welcome to the MFRC522 data read example")
print("Press Ctrl-C to stop.")

# This loop keeps checking for chips. If one is near it will get the UID and authenticate
while continue_reading:
    # Scan for cards
    (status, TagType) = MIFAREReader.MFRC522_Request(MIFAREReader.PICC_REQIDL)

    # Get two buffered cursors
    cursor_query_user = cnx.cursor(buffered=True)
    cursor_insert_activity = cnx.cursor(buffered=True)

    # # Iterate through the result of curA
    # for (emp_no, salary, from_date, to_date) in curA:
    #     # Update the old and insert the new salary
    #     new_salary = int(round(salary * Decimal('1.15')))
    #     curB.execute(update_old_salary, (tomorrow, emp_no, from_date))
    #     curB.execute(insert_new_salary,
    #                  (emp_no, tomorrow, date(9999, 1, 1, ), new_salary))
    #
    #     # Commit the changes
    #     cnx.commit()

    # If a card is found
    if status == MIFAREReader.MI_OK:
        print("Card detected")

    # Get the UID of the card
    (status, uid) = MIFAREReader.MFRC522_Anticoll()

    # If we have the UID, continue
    if status == MIFAREReader.MI_OK:
        red.turn_on()
        
	number = str(uid[0]) + "." + str(uid[1]) + "." + str(uid[2]) + "." + str(uid[3])
        print(number)
        query_user = (
            "SELECT * FROM gebruikers WHERE pasnummer = %s"
        )

        cursor_query_user.execute(query_user, (str(uid[0]) + "." + str(uid[1]) + "." + str(uid[2]) + "." + str(uid[3])))

        data_query_user = cursor_query_user.fetchall()

        print(data_query_user[0])


        # insert_activity = (
        #     "INSERT INTO activiteiten(`user_id`, `automaat_id`, `begin_datum`) VALUES(%s, %s, NOW());"
        # )
        # cursor_insert_activity.execute(insert_activity, (AUTOMAAT_ID, ))

    else:
        red.turn_off()

    time.sleep(5)
