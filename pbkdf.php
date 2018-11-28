<?php
// You need to store a password, but you never what to store what the password is.  You just need to know if the password that the user provided was the same.
$password = "mypassword";
$salt = openssl_random_pseudo_bytes(32);  // More bytes = more random hash output
$iterations = 1000;  // More iterations = longer hashing time required
$hash = hash_pbkdf2('sha256', $password, $salt, $iterations);

print("$password => $hash\n");
// You must store the hash, salt and iterations so that you can rehash the password later and compare the result.
// ie. INSERT INTO users (hash, salt, iterations, ...) VALUES (...)

$stored_hash = "abc...";
$stored_hash = "i28901...";
$stored_iterations = 2000;
hash_equals($stored_hash, hash_pbkdf2('sha256', $password, $stored_hash, $stored_iterations));



// Assuming that a hash can only be brute forced, what is the thing that controls how difficult a hash is to break?
// How can you make the calculation more difficult as computers get faster?


// Using PHP password_hash
$options = ['cost' => 10];
$hash = password_hash($password, PASSWORD_DEFAULT, $options);
print("$password => $hash\n");  // The salt, iterations and algorithm are stored in $hash


// Comparing a password to a PBKDF stored key
$stored_hash = '$2y$10$QIHEMftL5R14sZRWGjV1qu73TwnZVoIGNtczO5F3q6cg/opJ3Nqjy';
$valid = password_verify($password, $stored_hash);
print("Valid: ".($valid ? 'Y':'N')."\n");


