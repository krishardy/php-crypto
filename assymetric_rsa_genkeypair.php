<?php
// RSA
// Generate a keypair

$privkey_path = "./key.pem";
$pubkey_path = "./key.pub";

$config = array(
	"digest_alg" => "sha512",
	"private_key_bits" => 4096,
	"private_key_type" => OPENSSL_KEYTYPE_RSA
);
$res = openssl_pkey_new($config);

// Get private key
openssl_pkey_export($res, $private_key);

// Get public key
$key = openssl_pkey_get_details($res);
$pub_key = $key['key'];

// Save the private key
openssl_pkey_export_to_file($private_key, $privkey_path);

// Save the public key
$fh = fopen($pubkey_path, "w");
fwrite($fh, $pub_key);
fclose($fh);

// Post the public key to Slack for someone else to download

