  
#!/usr/bin/env python

import crypt

def main():

	passwords = []

# Open the parsed passwords file.
	with open("justpasswords.txt", "r") as f:
		passwords = f.readlines()
# Iterating through the parsed passwords with user input choosing which password to use.
# rstrip strips off the very end invsiible space.
		encrypted_password = passwords[int(input("which line number?: "))].rstrip()
	print ("encrypted password is" + encrypted_password)

# Open the dictionary file of guesses.
	dict_file = open("100000passwords.txt")
	for guess in dict_file.readlines():

		guess = guess.rstrip()
		new_password = crypt.crypt(guess, encrypted_password)

		print ("Trying password " + guess)
		print (encrypted_password + " % " + new_password)

# if the passwords and guesses match do this
		if (encrypted_password == new_password):
			print("Password found!")
			print("The cracked password is " + guess)
			exit()
	print("NO password was found.")

if ( __name__ == "__main__" ):
	main()
