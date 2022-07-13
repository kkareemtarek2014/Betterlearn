import mysql.connector


db_connection = mysql.connector.connect(
  host='127.0.0.1',
  database='kareem',
  user='root',
  password=''
)

db_cursor = db_connection.cursor()
article_sql_query = "INSERT INTO Mastercard(number ,ownername,expire,cvv) VALUES(111, 'omar','111',123)"
# Execute cursor and pass query as well as student data
db_cursor.execute(article_sql_query)

db_connection.commit()
