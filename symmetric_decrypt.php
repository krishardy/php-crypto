<?php
// Decrypting data.
$b64cyphertext = "SdMhZQNEneJasQWm/QCmcN3epSXfAIi3RSU91L1i5YjvIjEXNoDDjKgXiTfDLw3t2hkzmJ2+xvN9WtkOW+BJoRf5szyrmYRi/kk=";
$password = "mypassword";

$cyphertext = base64_decode($b64cyphertext);

// You need to use the same salt, bytecount and password you used during encryption to derive the same key
$salt = substr($cyphertext, 0, SODIUM_CRYPTO_PWHASH_SALTBYTES);

// You must use the same nonce that you used to encrypt in order to decrypt.  That's why it was included in the message.
$nonce = substr($cyphertext, SODIUM_CRYPTO_PWHASH_SALTBYTES, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);

$encmsg = substr($cyphertext, SODIUM_CRYPTO_PWHASH_SALTBYTES+SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);

$key = sodium_crypto_pwhash(
	SODIUM_CRYPTO_SIGN_SEEDBYTES,
	$password,
	$salt,
	SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE,
	SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE
);

// Decrypt the message.
$plaintext = sodium_crypto_secretbox_open($encmsg, $nonce, $key);
if ($plaintext === false) {
	throw new Exception("Bad ciphertext or key");
}

print($plaintext."\n");

// Modify the cyphertext and try to decrypt the message.  What happened and why?
