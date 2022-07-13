import mysql.connector
db_connection = mysql.connector.connect(
  host='127.0.0.1',
  database='kareem',
  user='root',
  password=''
)


db_cursor = db_connection.cursor()
# Here creating database table as student'
db_cursor.execute("CREATE TABLE Mastercard(Number INT, ownername VARCHAR(50),expire nvarchar(5),cvv int)")
# Get database table'
db_cursor.execute("SHOW TABLES")
for table in db_cursor:
  print(table)