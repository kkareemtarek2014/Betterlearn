import sys
import socket
import RSA
from shared import sendMsg, recvMsg, sendEncrypted, recvEncrypted
import AES
from AES import createMAC, MACdata, NumToSeq, SeqToNum
from secrets import randbits
import mysql.connector
import base64



class Server:
	def __init__(self):
		# the secret key/MAC key are shared - helps confirm that the client is who they say they are
		# IRL, this would probably be some hash keyed to a user/password login
		# these are not known by attackers.
		self.__secretKey = '\x1a\xf4\xd5\x26\x67\xd4\x6b\xef\xc7\x25\x41\xeb\x81\xc5\x5a\x73' + \
							'\xb1\xfc\xa9\x06\x1c\xd3\xd2\x83\xe7\x15\x4c\xc3\x41\xa2\x8d\xc7'
		self.__MAC = MACdata('\x17\xb7\x3b\xb7\x7a\xdc\xae\xaf\x68\x2f\x51\x1d\x91\x61\xc5\x14' + \
							'\xcf\x46\xb1\xc8\x0d\xe0\xd5\xb1\xfb\xf9\x76\xa2\xd4\x07\xaa\x34')
		# sessionID and timeStamp are both 64 bit values that get prepended to a message during MAC
		# they are additionally unique to each session.
		self.__MAC.sessionID = 0
		# incremented before every recv
		self.__MAC.timeStamp = 0

	# helper function to check MAC address - if the original message was encrypted
	def checkMAC(self, msg, MAC):
		if createMAC(msg, self.__MAC) == MAC:
			return True
		return False

	def SSLHandShake(self, sock):
		print('[ Server] Waiting For Connection From User...')
		connection, client_address = sock.accept()

		# Phase 1 - server receives an initial message and timestamp from a client,
		#           then sends a sessionID to the client to use
		ret, MAC = recvMsg(connection)
		if not self.checkMAC(ret, MAC):
			print('[ Server] Failed Phase 1!')
			return False, connection
		# extract the timestamp from the sent message
		toks = ret.split(" Timestamp:")
		ret, self.__MAC.timeStamp = toks[0], int(toks[1], 16)
		print('[ Client]', ret, 'Timestamp:', hex(self.__MAC.timeStamp))
		# create and send a sessionID
		temp = randbits(64)
		self.__MAC.timeStamp += 1
		sendMsg(connection, 'Secure Payment ! sessionID:' + hex(temp), self.__MAC)
		print("[ Server] Passed Phase 1")
		self.__MAC.sessionID = temp
		
		# Phase 2 - server sends a public RSA key to the client
		# Public Key = (e, n), Private Key = (d, n)
		# e, n, d, n = generateKeys()

		# # To Encrypt
		# cipher = encrypt(msg, e, n)

		# # To Decrypt
		# plainTxt = decrypt(cipher, d, n)
		e, n, d, p = None, None, None, None
		# Get a valid public and private keys
		while (True):
			e,n,d,p = RSA.generateKeys()
			test = RSA.encrypt("Test", e, n)
			test2 = RSA.decrypt(test, d, n)
			if (test2 == "Test"): break
		#str change value to string 
		pub_key = (str(e) + ' ' + str(n))
		ret, MAC = recvMsg(connection)
		if not self.checkMAC(ret, MAC):
			print('[ Server] Failed Phase 2!')
			return False, connection
		self.__MAC.timeStamp += 1
		sendMsg(connection, pub_key, self.__MAC)
		print("[ Server] Passed Phase 2")

		# Phase 3 - server receives the shared secret key encrypted with the public key
		msg, MAC = recvMsg(connection)
		ret = msg.split()
		#map change ret = ["11","23"]
		#to ret =  [11,23]
		ret = map(int, ret)

		# check if the received key is the same as the shared secret key
		tempKey = RSA.decrypt(ret,d,n)
		if tempKey != self.__secretKey or not self.checkMAC(msg, MAC):
			print('[ Server] Failed Phase 3!')
			return False, connection
		self.__MAC.timeStamp += 1
		sendMsg(connection, 'KeyAck', self.__MAC)
		print("[ Server] Passed Phase 3")

		# Phase 4 - client/server send finish messages to each other encrypted with the shared secret key.
		# client sends it first.
		cipher, plainTxt, MAC = recvEncrypted(connection, self.__secretKey)

		# if the client's finish message is not "clientPhase4", then die.
		if plainTxt != "clientPhase4" or not self.checkMAC(cipher, MAC):
			print('[ Server] Failed Phase 4!')
			return False, connection

		# send a finish message back encrypted with the shared secret key.
		self.__MAC.timeStamp += 1
		sendEncrypted(connection, 'serverPhase4', self.__secretKey, self.__MAC)

		print("[ Server] Passed Phase 4")

		# begin processing requests
		return True, connection

	def processRequests(self, connection):
		# receive encrypted  operations from Client
		data_dct = None
		resp= ""
		IV = AES.genInitVec()
		while (True):
			# initial message
			cipher, msg, MAC = recvEncrypted(connection, self.__secretKey)
			if not self.checkMAC(cipher, MAC):
				print('[Server] Invalid MAC...')
				break

			# every message should be in the format "<command> <values>"
			msg = msg.lower()
			tokens = msg.split()

			# if there is no message, then the client must have disconnected
			if msg == None:
				print("[Server] Connection lost...")
				break
			# terminate the connection
			elif msg == 'e':
				print("[ Client] Sent Command: " + msg)
				print('[ Server] Exiting Operations Successful. Exiting...')
				break
			else:
				print("[Client] Sent Command: " + msg)
				if data_dct==None:
					data_dct = {"number":None,"ownername":None,"expire":None,"cvv":None}
				k,v=msg.split(":")
				if k in data_dct:
					
					ciphertxt = AES.encryptMsg(v, self.__secretKey, IV)
					# decrypted = AES.decryptMsg(ciphertxt, self.__secretKey, IV)
					# data_dct[k] = decrypted
					data_dct[k] = ciphertxt
	
				done = True
				for value in data_dct.values():
					if value==None:
						done=False
				print(data_dct)
				if done:
					resp = "Transaction Successful"
					db_connection = mysql.connector.connect(
					host='127.0.0.1',
					database='kareem',
					user='root',
					password=''
					)
					db_cursor = db_connection.cursor()
					article_sql_query = f"INSERT INTO Mastercard(number ,ownername,expire,cvv) VALUES('{data_dct['number']}' , '{data_dct['ownername']}','{data_dct['expire']}','{data_dct['cvv']}')"
					
					print(article_sql_query)
					# Execute cursor and pass query as well as student data
					db_cursor.execute(article_sql_query)
					db_connection.commit()
					print(db_cursor.rowcount, "Record Inserted")
					resp = "Record Inserted"
				self.__MAC.timeStamp += 1
				sendEncrypted(connection, resp, self.__secretKey, self.__MAC)

	def openingServer(self):
		# Establish listening from port
		sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
		sock.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)
		server_address = ('localhost', 65432)
		# server_address = ('26.145.46.82', 11111)
		print('[ Server] Starting Up On:', server_address[0], 'Port:', server_address[1])
		sock.bind(server_address)
		sock.listen(1)

		# perform an SSL Handshake with the client
		successful, connection = self.SSLHandShake(sock) 

		# begin listening for requests
		if successful:
			print('[Server] Handshake Protocol Success. Accepting  Operations')
			self.processRequests(connection)
		else:
			connection.close()
			print('[Server] Handshake Protocol Failed. Exiting...')
			return

def startingUp():
	server = Server()
	server.openingServer()
	print('[Server] Shutting Down...')

if __name__ == '__main__': startingUp()
#Python interpreter reads source file and define few special 
# variables/global variables. If the python interpreter is running that 
# module (the source file) as the main program, it sets the special __name__ variable
#  to have a value “__main__”