# -*- coding: utf8 -*-
import signal
import time

import RPi.GPIO as GPIO

from src.MFRC522 import MFRC522
from src.LED import LED
from src.config import AUTOMAAT
from src.repository import gymgate_repository


def format_card_uid(uid):
    return str(uid[0]) + "." + str(uid[1]) + "." + str(uid[2]) + "." + str(uid[3])


class GymGate:
    def __init__(self):
        self.gymgate_repository = gymgate_repository.GymgateRepository()
        self.is_running = True
        self.MIFAREReader = MFRC522()

        self.LED_green = LED(GPIO, 21)
        self.LED_red = LED(GPIO, 12)

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
                self.LED_green.turn_on()

                card_uid = format_card_uid(uid)

                user_data = self.gymgate_repository.get_user_status_by_card_uid(card_uid)
                if user_data.status_code == 404:
                    continue

                user_id = user_data['user']['id']

                if user_data['activeActiviteit'] is not None:
                    self.gymgate_repository.do_check_out(user_id, AUTOMAAT[0].id, AUTOMAAT[0].api_key)
                else:
                    self.gymgate_repository.do_check_in(user_id, AUTOMAAT[0].id, AUTOMAAT[0].api_key)

                time.sleep(5)

            else:
                self.LED_red.turn_off()

    def close_program(self, signal, frame):
        print("Ctrl+C captured, ending read.")
        self.is_running = False
        GPIO.cleanup()


GPIO.setmode(GPIO.BOARD)

GymGate()
