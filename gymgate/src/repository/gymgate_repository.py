from datetime import datetime

import requests

from src import config


class GymgateRepository:
    def __init__(self):
        self.host = 'http://' + config.SERVER_HOST

    def get_user_status_by_card_uid(self, card_uid):
        req = requests.post(self.host + '/api/user', data={'cardnumber': card_uid})
        return req.json()

    def do_check_in(self, user_id, automaat_id, api_key):
        req = requests.post(self.host + '/api/checkIn', data={'user_id': user_id, 'automaat_id': automaat_id, 'api_key': api_key})
	return req.status_code

    def do_check_out(self, user_id, automaat_id, api_key):
        req = requests.post(self.host + '/api/checkOut', data={'user_id': user_id, 'automaat_id': automaat_id, 'api_key': api_key})
	return req.status_code
