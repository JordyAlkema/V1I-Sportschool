class Servo:
    def __init__(self, GPIO):
        GPIO.setup(7, GPIO.OUT)
        self.servo = GPIO.PWM(7, 50)
        self.servo.start(6)

    def rotate_open(self):
        self.servo.ChangeDutyCycle(12.5)

    def rotate_close(self):
        self.servo.ChangeDutyCycle(7.5)
