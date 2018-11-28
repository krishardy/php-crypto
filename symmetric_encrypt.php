<?php
// NOTE: Sodium has replaced Mcrypt in the PHP 7.1+

$message = "This is my message";
$password = "mypassword";

$salt = random_bytes(SODIUM_CRYPTO_PWHASH_SALTBYTES);

$key = sodium_crypto_pwhash(
	SODIUM_CRYPTO_SIGN_SEEDBYTES,
	$password,
	$salt,
	SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE,
	SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE
);

$nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);

$cyphertext = sodium_crypto_secretbox($message, $nonce, $key);

print(base64_encode($salt.$nonce.$cyphertext)."\n");

// Encrypt a message and paste it to Slack.  Give the person next to you the password.  (Think about how you would share the password.  Would you post it to Slack?)


