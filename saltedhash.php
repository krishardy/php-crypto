<?php
// Hash without salt (do a google search for the hash result)
$password = "password";
$hash = hash('sha256', $password);
print("UNSALTED HASH: $password => $hash\n");

// What happens in the database is compromised by an SQLI attack?
// What can you learn from the database?
// -- Are all the passwords different?  What does that tell you?
// -- If you break one password, does that help you break others?

// Hash with per-user salt
$salt = openssl_random_pseudo_bytes(32, $crypto_strong);  // Create a random salt for each user
// OR use random_bytes (a cryptographically secure PRNG API for PHP)
$salt = random_bytes(32);
$password = 'password';
$salted_password = $salt . $password;
$hash = hash('sha256', $salted_password);
print("PER-USER SALTED HASH: $password => $hash\n");
print("  crypto_strong prng used: ".($crypto_strong?'Y':'N')."\n");


// Hash with system salt
$system_salt = "randomdata...";
$password = 'password';
$salted_password = $system_salt . $password;
$hash = hash('sha256', $salted_password);
print("SYSTEM SALTED HASH: $password => $hash\n");


// Hash with both system and per-user salt
$user_salt = openssl_random_pseudo_bytes(32, $crypto_strong);  // Create a salt for each user
$system_salt = "randomdata...";
$password = 'password';
$salted_password = $user_salt . $system_salt . $password;
$hash = hash('sha256', $salted_password);
print("SYSTEM & PER-USER SALTED HASH: $password => $hash\n");

