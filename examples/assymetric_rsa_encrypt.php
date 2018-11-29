<?php
// Get a friend's public key, and put it into the target.pub file (or put the contents into $target_pubkey_path).  Encrypt a message with your private key and post it to Slack.  Have them decrypt the message with your public key.  (Think about how would exchange public keys and how you would protect private keys)

// Your private key
$privkey_path = "./key.pem";
// Your public key
$pubkey_path = "./key.pub";
// The target's public key
$target_pubkey_path = "./target.pub";

// Encrypt with the target's public key
$message = "This is my message.";

$target_pubkey = openssl_pkey_get_public("file://".$target_pubkey_path);

if (!openssl_public_encrypt($message, $ciphertext, $target_pubkey, OPENSSL_PKCS1_PADDING)) {
	throw new Exception("Encryption failed.  Aborting.");
}
$ciphertext = base64_encode($ciphertext);

// Sign with your private key
$privkey = openssl_pkey_get_private("file://".$privkey_path);

$hash = hash("sha256", $ciphertext);
print("Hash: $hash");
if (!openssl_private_encrypt($hash, $signed_hash, $privkey, OPENSSL_PKCS1_PADDING)) {
	throw new Exception("Signing failed.  Aborting.");
}
$signed_hash = base64_encode($signed_hash);

$message = $ciphertext."$".$signed_hash;

print("Encrypted and signed message:\n$message\n");

// Post the message and signature to Slack

// Have someone else verify the signature with your public key.  What does it mean if the signature is valid?  What does it mean if it is invalid?
