import time
import RPi.GPIO as GPIO
from RPLCD.gpio import CharLCD

class Display:
    def __init__(self):
        self.lcd = CharLCD(cols=16, rows=2, pin_rs=16, pin_e=36, pins_data=[38, 32, 11, 37], numbering_mode=GPIO.BOARD)

    def show_message(self, text):
        self.lcd.crlf()
        self.lcd.write_string(text)

    def clear(self):
        self.lcd.clear()

    def close(self):
        self.lcd.close(clear=True)

