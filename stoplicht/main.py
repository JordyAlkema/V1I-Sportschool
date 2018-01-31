# -*- coding: utf8 -*-
import signal
import time
import sys

import RPi.GPIO as GPIO

from src import config
from src.LED import LED
from src.config import LOCATION
from src.repository import gymgate_repository


class GymGate:
    def __init__(self):
        self.gymgate_repository = gymgate_repository.GymgateRepository()
        self.is_running = True

        # TODO: Change pins to correct ones, according to GPIO.BOARD
        self.LED_green = LED(GPIO, 40)
        self.LED_orange = LED(GPIO, 12)
        self.LED_red = LED(GPIO, 12)

        signal.signal(signal.SIGINT, self.close_program)

        print("Sportschool stoplicht")
        print("Press Ctrl-C to stop.")

        self.start_program()

    def start_program(self):
        while self.is_running:
            self.LED_green.turn_off()
            self.LED_orange.turn_off()
            self.LED_red.turn_off()

            data = self.gymgate_repository.get_indicator_data_by_location(LOCATION)

            if data['indicator'] is "green":
                self.LED_green.turn_on()
            if data['indicator'] is "orange":
                self.LED_orange.turn_on()
            if data['indicator'] is "red":
                self.LED_red.turn_on()

            time.sleep(4)

    def close_program(self, signal, frame):
        print("Ctrl+C captured, ending read.")
        self.is_running = False
        GPIO.cleanup()
        sys.exit()


GPIO.setmode(GPIO.BOARD)

GymGate()
