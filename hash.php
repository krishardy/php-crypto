<?php
// Hash a string  https://secure.php.net/manual/en/function.hash.php
$hex_hash = hash("sha3-256", "test string");
echo $hex_hash."\n";

$bin_hash = hash("sha3-256", "test string", TRUE);
echo $bin_hash."\n";

// Hash input - Note: We'll be going through a better password comparison and storage process soon, so use this as a learning tool, but do not do this in production!
$password = $_POST['password'] ?? '';
$hashed_password = hash("sha3-256", "test string");

// Comparing input to a previously hashed value (the naive way)
$stored_password = "aaa";
if ($hashed_password === $stored_password) {
	echo "Passwords match";
} else {
	echo "Passwords don't match";
}


// Comparing hashed input to a previously hashed value (avoiding timing attacks)
$correct = 0
$incorrect = 0
# The hashes must be the same length!
if (len($stored_password) != len($hashed_password)) {
	echo "Different hash algorithms were used!  Refusing to compare the hashes."
} else {
	foreach ($i = 0; $i < max(len($stored_password), len($hashed_password)); $i++) {
		if ($stored_password[$i] == $hashed_password[$i]) {
			correct++;
		} else {
			incorrect++;
		}
	}

	if (incorrect == 0) {
		echo "The password is correct."
	} else {
		echo "The password is incorrect."
	}
}
