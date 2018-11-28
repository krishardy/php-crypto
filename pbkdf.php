<?php
// You need to store a password, but you never what to store what the password is.  You just need to know if the password that the user provided was the same.
// Assuming that a hash can only be brute forced, what is the thing that controls how difficult a hash is to break?
// Can your algorithm make the calculation more difficult as computers get faster?

// Using a PBKDF (PBKDF2, scrypt, bcrypt, libsodium, etc.)

// Comparing a password to a PBKDF stored key
