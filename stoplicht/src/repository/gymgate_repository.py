from datetime import datetime

import requests

from src import config


class GymgateRepository:
    def __init__(self):
        self.host = 'http://' + config.SERVER_HOST

    def get_indicator_data_by_location(self, gymname):
        req = requests.get(self.host + '/api/trafficIndicator', data={'gym': gymname})
        return req.json()

