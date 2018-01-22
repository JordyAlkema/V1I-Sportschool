import mysql.connector

from src import config


class GymgateRepository:
    def __init__(self):
        self.connection = mysql.connector.connect(**config.database_config)

    def get_user_id_by_card_uid(self, card_uid):
        cursor = self.connection.cursor(buffered=True)
        cursor.execute("SELECT id FROM gebruikers WHERE pasnummer = %s", (card_uid,))
        return cursor.fetchone()

    def get_running_activity_by_user_id(self, user_id):
        cursor = self.connection.cursor(buffered=True)
        cursor.execute('SELECT * FROM activiteiten WHERE `user_id` = %s and `eind_datum` is NULL', (user_id,))
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

    def close_database(self):
        self.connection.close()
