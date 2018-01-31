class LED:
    def __init__(self, GPIO, pin):
        self.GPIO = GPIO
        self.pin = pin
        self.GPIO.setup(pin, GPIO.OUT)

    def turn_on(self):
        """ Zet de LED aan """
        self.GPIO.output(self.pin, 1)

    def turn_off(self):
        """ Zet de LED uit """
        self.GPIO.output(self.pin, 0)

    def toggle(self):
        """ Zet de LED  """
        self.GPIO.output(self.pin, not self.GPIO.input(self.pin))