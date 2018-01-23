import mysql.connector

from datetime import datetime

from src import config


class GymgateRepository:
    def __init__(self):
        self.connection = mysql.connector.connect(**config.database_config)

    def get_price_per_minute_of_automaat(self, automaat_id):
        cursor = self.connection.cursor(buffered=True)
        cursor.execute(
            "SELECT bedrag_per_minuut FROM `automaten` WHERE id = %s",
            (automaat_id,))
        return cursor.fetchone()

    def get_user_id_by_card_uid(self, card_uid):
        cursor = self.connection.cursor(buffered=True)
        cursor.execute("SELECT id FROM gebruikers WHERE pasnummer = %s", (card_uid,))
        return cursor.fetchone()

    def get_running_activity_by_user_id(self, user_id):
        cursor = self.connection.cursor(buffered=True)
        cursor.execute("SELECT * FROM activiteiten WHERE `user_id` = %s and `eind_datum` is NULL;", (user_id,))
        return cursor.fetchone()

    def get_activity_by_id(self, activity_id):
        cursor = self.connection.cursor(buffered=True)
        cursor.execute(
            "SELECT * FROM `activiteiten` WHERE id = %s",
            (activity_id,))
        return cursor.fetchone()

    def add_activity(self, user_id, automaat_id):
        cursor = self.connection.cursor(buffered=True)
        print((user_id, automaat_id,))
        cursor.execute("INSERT INTO activiteiten(`user_id`, `automaat_id`, `begin_datum`) VALUES(%s, %s, NOW());",
                       (user_id, automaat_id,))
        self.connection.commit()

    def finish_activity(self, activity_id):
        cursor = self.connection.cursor(buffered=True)
        cursor.execute(
            "UPDATE `activiteiten` SET `eind_datum` = NOW() WHERE id = %s ORDER BY `begin_datum` DESC LIMIT 1",
            (activity_id,))
        self.connection.commit()

    def get_price_of_activity(self, activity_id, price_per_minute):
        activity = self.get_activity_by_id(activity_id)
        date_start = datetime.strptime(activity[3])
        date_end = datetime.strptime(activity[4])

        return (date_start - date_end) * price_per_minute

    def add_transaction(self, user_id, price, activity_id):
        cursor = self.connection.cursor(buffered=True)
        cursor.execute(
            "INSERT INTO `transactie` (`user_id`, `transactieType_id`, `bedrag`, `datum`, `activiteit_id`) VALUES (?, 1, ?, NOW(), %s)",
            (user_id, price, activity_id)
        )
        self.connection.commit()

    def close_database(self):
        self.connection.close()
