#!/usr/bin/env python

import crypt

def main():

	passwords = []
	with open("justpasswords.txt", "r") as f:
		passwords = f.readlines()

	print ("cracking password...")

	dict_file = open("100000passwords.txt")
	encrypted_password = passwords[1].rstrip()

	print ("encrypted password looks to be... " + encrypted_password)

	for password in dict_file.readlines():
		password = password.rstrip()
		new_password = crypt.crypt(password, encrypted_password)

		print ("Trying password " + password)
		print (encrypted_password + " % " + new_password)

		if (encrypted_password == new_password):
			print("Password found!")
			print("The cracked password is " + password)
			exit()
	print("NO password was found.")

if ( __name__ == "__main__" ):
	main()
