<?php
// Use an hmac to sign a message
$message = "This is my message";
$key = "mypassword";
$hmac = hash_hmac("sha256", $message, $key);
print("HMAC: $hmac\n");
$signed_message = $hmac.$message;
print("Signed message: $signed_message\n");

// Verify that the signature is correct.  What does it mean if the signature doesn't match?
$signed_message = 'b8c2e075a8dfa93a0f67458894bcf84c4262915c9127dbf98423a9bdb89e9f49This is my message';
$signature = substr($signed_message, 0, 64);  // The signature is at the beginning of the message.
$message = substr($signed_message, 64);  // The signature is at the end of the message
$hmac = hash_hmac("sha256", $message, $key);

print("Valid: ".(hash_equals($signature, $hmac) ? 'Y':'N')."\n");
