from datetime import datetime

import requests

from src import config


class GymgateRepository:
    def __init__(self):
        self.host = 'http://' + config.SERVER_HOST

    def get_user_status_by_card_uid(self, card_uid):
        req = requests.post(self.host + '/api/user', data={'card_uid': card_uid})
        return req.json()

    def do_check_in(self, user_id, automaat_id):
        req = requests.post(self.host + '/api/check_in', data={'user_id': user_id, 'automaat_id': automaat_id})
        return req.json()

    def do_check_out(self, user_id, automaat_id):
        req = requests.post(self.host + '/api/check_out', data={'user_id': user_id, 'automaat_id': automaat_id})
        return req.json()
