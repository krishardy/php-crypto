<?php
// Get a message from a friend that they encrypted with your public key, and get their public key.  Put the message into message.txt, and their public key into sender.pub.  Decrypt the message with your public key.  (Think about how would exchange public keys and how you would protect private keys)

// Your private key
$privkey_path = "./key.pem";
// Your public key
$pubkey_path = "./key.pub";
// The sender's public key
$sender_pubkey_path = "./sender.pub";
// The location of the message
$message_path = "./message.txt";

// Read the message
$fh = fopen($message_path, "rb");
$signed_message = fread($fh, filesize($message_path));
fclose($fh);

// Split the message into its parts (separated by '$')
$split_pos = strpos($signed_message, '$');
$b64message = substr($signed_message, 0, $split_pos);
$b64signature = substr($signed_message, $split_pos);
$signature = base64_decode($b64signature);

// Get the sender's public key

$sender_pubkey = openssl_pkey_get_public("file://".$sender_pubkey_path);

// Verify the signature
if (!openssl_public_decrypt($signature, $message_hash, $sender_pubkey, OPENSSL_PKCS1_PADDING)) {
	throw new Exception("Decryption failed.  Aborting.");
}

// Calculate the hash of the message
$hash = hash("sha256", $b64message);
if (!hash_equals($hash, $message_hash)) {
	throw new Exception("The decrypted signature doesn't match the message hash.  Authentication failed.  Aborting.");
}

$ciphertext = base64_decode($b64message);

// Decrypt with your private key
$privkey = openssl_pkey_get_private("file://".$privkey_path);
if (!openssl_private_decrypt($ciphertext, $plaintext, $privkey, OPENSSL_PKCS1_PADDING)) {
	throw new Exception("Signature passed but decryption failed.  Aborting.");
}
print($plaintext."\n");

// Have someone else verify the signature with your public key.  What does it mean if the signature is valid?  What does it mean if it is invalid?
