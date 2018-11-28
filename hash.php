<?php
// Get the list of hash algorithms
var_dump(hash_algos());

// Hash a string  https://secure.php.net/manual/en/function.hash.php
$plaintext = "test string";
$hex_hash = hash("sha256", $plaintext);
echo "hash('sha256', $plaintext) => $hex_hash\n";

$bin_hash = hash("sha256", $plaintext, TRUE);
echo "hash('sha256', $plaintext, TRUE) => $bin_hash\n";
echo implode(unpack("H*", $bin_hash))."\n";
echo base64_encode($bin_hash)."\n";



// Hash input - Note: We'll be going through a better password comparison and storage process soon, so use this as a learning tool, but do not do this in production!
$password = $_POST['password'] ?? '';
$hashed_password = hash("sha256", $password);
echo "$password => $hashed_password\n";



// Comparing input to a previously hashed value (the naive way)
$stored_hash = "5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8";
if ($hashed_password === $stored_hash) {
	echo "Passwords match\n";
} else {
	echo "Passwords don't match\n";
}



// Comparing hashed input to a previously hashed value (avoiding timing attacks)
if (hash_equals($stored_password, $hashed_password)) {
	echo "The password is correct.";
} else {
	echo "The password is incorrect.";
}

