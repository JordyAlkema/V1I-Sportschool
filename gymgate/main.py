# -*- coding: utf8 -*-
import RPi.GPIO as GPIO
import time

import MFRC522
import signal
from src.LED import LED
from src.repository import gymgate_repository

AUTOMAAT_ID = 1


class GymGate:
    gymgate_repository: gymgate_repository.GymgateRepository
    is_running: bool
    MIFAREReader: MFRC522.MFRC522
    LED_red: LED

    def __init__(self):
        GPIO.setmode(GPIO.BOARD)

        self.gymgate_repository = gymgate_repository.GymgateRepository()
        self.is_running = True
        self.MIFAREReader = MFRC522.MFRC522()
        self.LED_red = LED(GPIO, 12)

        signal.signal(signal.SIGINT, self.close_program)

        print("Gymgate scanner")
        print("Press Ctrl-C to stop.")

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
                # @todo: make function of this to toggle
                self.LED_red.turn_on()

                card_uid = str(uid[0]) + "." + str(uid[1]) + "." + str(uid[2]) + "." + str(uid[3])

                user_id = self.gymgate_repository.get_user_id_by_card_uid(card_uid)

                running_activities = self.gymgate_repository.get_running_activities_by_user_id(user_id)
                amount_of_activities = len(running_activities)

                print("amount of activity: " + str(amount_of_activities))
                print(user_id)

                if amount_of_activities == 0:
                    self.gymgate_repository.add_activity(user_id, AUTOMAAT_ID)

            else:
                self.LED_red.turn_off()

            time.sleep(5)

    def close_program(self, signal, frame):
        print("Ctrl+C captured, ending read.")
        self.is_running = False
        self.gymgate_repository.close_database()
        GPIO.cleanup()


GymGate()
