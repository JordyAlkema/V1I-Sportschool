import mysql.connector

from src import config


class GymgateRepository:
    connection: mysql.connector

    def __init__(self):
        self.connection = mysql.connector.connect(**config.database_config)

    def get_user_id_by_card_uid(self, card_uid: str) -> str:
        cursor = self.connection.cursor(buffered=True)
        cursor.execute("SELECT id FROM gebruikers WHERE pasnummer = %s", (card_uid,))
        return cursor.fetchone()

    def get_running_activities_by_user_id(self, user_id: str) -> list:
        cursor = self.connection.cursor(buffered=True)
        cursor.execute('SELECT * FROM activiteiten WHERE `user_id` = %s and `eind_datum` is NULL')
        return cursor.fetchall()

    def add_activity(self, user_id: str, automaat_id: int):
        cursor = self.connection.cursor(buffered=True)
        cursor.execute("INSERT INTO activiteiten(`user_id`, `automaat_id`, `begin_datum`) VALUES(%s, %s, NOW());",
                       (user_id, automaat_id,))
        self.connection.commit()

    def update_activity(self, user_id: str, automaat_id: int):
        cursor = self.connection.cursor(buffered=True)
        cursor.execute("UPDATE `activiteiten` SET `eind_datum` = NOW() WHERE user_id = %s AND automaat_id = %s ORDER BY `begin_datum` DESC LIMIT 1",
                       (user_id, automaat_id,))
        self.connection.commit()

    def close_database(self):
        self.connection.close()
