# -*- coding: utf8 -*-
import RPi.GPIO as GPIO
import time

import MFRC522
import signal
from src.LED import LED
from src.repository import gymgate_repository

AUTOMAAT_ID = 1


def format_card_uid(uid):
    return str(uid[0]) + "." + str(uid[1]) + "." + str(uid[2]) + "." + str(uid[3])


class GymGate:
    def __init__(self):
        self.gymgate_repository = gymgate_repository.GymgateRepository()
        self.is_running = True
        self.MIFAREReader = MFRC522.MFRC522()
        self.LED_red = LED(GPIO, 12)
        self.AUTOMAAT_PRICE = self.gymgate_repository.get_price_per_minute_of_automaat(AUTOMAAT_ID)[0]

        signal.signal(signal.SIGINT, self.close_program)

        print("Gymgate scanner")
        print("Press Ctrl-C to stop.")

        self.start_program()

    def start_program(self):
        while self.is_running:
            # Scan for cards
            (status, TagType) = self.MIFAREReader.MFRC522_Request(self.MIFAREReader.PICC_REQIDL)

            if status == self.MIFAREReader.MI_OK:
                print("Card detected")

            # Get the UID of the card
            (status, uid) = self.MIFAREReader.MFRC522_Anticoll()

            # If we have the UID, continue
            if status == self.MIFAREReader.MI_OK:
                # Turn on the light
                self.LED_red.turn_on()

                card_uid = format_card_uid(uid)
                user_data = self.gymgate_repository.get_user_status_by_card_uid(card_uid)
                print(user_data)
                print(user_data.user.id)
                # # Check if card is not connected to any accounts
                # if user_id is None:
                #     continue
                #
                # running_activity = self.gymgate_repository.get_running_activity_by_user_id(user_id)
                #
                # # Check if has activity and is on the same machine.
                # if running_activity is not None and running_activity[2] == AUTOMAAT_ID:
                #     # Finish activity and add transaction
                #     self.gymgate_repository.finish_activity(running_activity[0])
                #     total_price = self.gymgate_repository.get_price_of_activity(running_activity[0], self.AUTOMAAT_PRICE)
                #     self.gymgate_repository.add_transaction(user_id, total_price, running_activity[0])
                #
                # elif running_activity is None:
                #     self.gymgate_repository.add_activity(user_id, AUTOMAAT_ID)

                time.sleep(5)

            else:
                self.LED_red.turn_off()

    def close_program(self, signal, frame):
        print("Ctrl+C captured, ending read.")
        self.is_running = False
        self.gymgate_repository.close_database()
        GPIO.cleanup()


GPIO.setmode(GPIO.BOARD)

GymGate()
