# -*- coding: utf8 -*-
import signal
import time
import sys

import RPi.GPIO as GPIO

from src.LED import LED
from src.config import AUTOMAAT
from src.display import Display
from src.repository import gymgate_repository
from pirc522 import RFID


def format_card_uid(uid):
    return str(uid[0]) + "." + str(uid[1]) + "." + str(uid[2]) + "." + str(uid[3])


class GymGate:
    def __init__(self):
        self.gymgate_repository = gymgate_repository.GymgateRepository()
        self.is_running = True
        self.RFID = RFID(bus=0, device=1)
        self.display = Display()
#        self.LED_green = LED(GPIO, 21)
#        self.LED_red = LED(GPIO, 12)

        signal.signal(signal.SIGINT, self.close_program)

        print("Gymgate scanner")
        print("Press Ctrl-C to stop.")

        self.start_program()

    def start_program(self):
        while self.is_running:
            self.RFID.wait_for_tag()
            (error, tag_type) = self.RFID.request()
            if not error:
                print("Tag detected")
                (error, uid) = self.RFID.anticoll()
                if not error:
                    print("UID: " + str(uid))
                    # Turn on the light
#                    self.LED_red.turn_on()
#                    self.LED_green.turn_on()
                    self.display.show_message(u"\rKaart gevonden")
                    time.sleep(1)
                    self.display.show_message(u"\rKaart gevonden")
                    card_uid = format_card_uid(uid)
                    print(card_uid)

                    user_data = self.gymgate_repository.get_user_status_by_card_uid(card_uid)
#                    if user_data.status_code == 404:
#                        continue
                    user_id = user_data['user']['id']

                    self.display.show_message(u"\rHallo " + user_data['user']['voornaam'])
                    time.sleep(2)

                    if user_data['activeActiviteit'] is not None:
                        self.gymgate_repository.do_check_out(user_id, AUTOMAAT[0]["id"], AUTOMAAT[0]["api_key"])
                        self.display.show_message(u"\rUitgecheckt")
                    else:
                        self.gymgate_repository.do_check_in(user_id, AUTOMAAT[0]["id"], AUTOMAAT[0]["api_key"])
                        self.display.show_message(u"\rIngecheckt")

                    time.sleep(5)

#            else:
#                self.LED_red.turn_off()

    def close_program(self, signal, frame):
        print("Ctrl+C captured, ending read.")
        self.is_running = False
        self.RFID.cleanup()
        self.display.close()
        GPIO.cleanup()
        sys.exit()


GPIO.setmode(GPIO.BOARD)

GymGate()
