<?php

function naive_compare($stored_hash, $test_hash)
{
	return $stored_hash === $test_hash;
}

function naive_compare_strcmp($stored_hash, $test_hash)
{
	return strcmp($stored_hash, $test_hash) == 0;
}

$count = 10000000;

$stored_hash = "5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8";
$good_password = "password";
$wrong_password = "wrongpassword";

$good_hash = hash("sha256", $good_password);
$wrong_hash = hash("sha256", $wrong_password);

$naive_time_good = 0;
$naive_time_wrong = 0;

$strcmp_time_good = 0;
$strcmp_time_wrong = 0;

$fixed_time_good = 0;
$fixed_time_wrong = 0;


// Do a naive comparison (hash1 === hash2)
$start = microtime(TRUE);
for ($i = 0; $i < $count; $i++) {
	naive_compare($stored_hash, $good_hash);
}
$end = microtime(TRUE);
$naive_time_good = $end - $start;
print("Good hash (Naive): time=$naive_time_good\n");

$start = microtime(TRUE);
for ($i = 0; $i < $count; $i++) {
	naive_compare($stored_hash, $wrong_hash);
}
$end = microtime(TRUE);
$naive_time_bad = $end - $start;
print("Wrong hash (Naive): time=$naive_time_bad\n");
print("Time Difference: ".($naive_time_good - $naive_time_bad)."\n");


// Do a naive strcmp comparison (strcmp(hash1, hash2) == 0)
$start = microtime(TRUE);
for ($i = 0; $i < $count; $i++) {
	naive_compare_strcmp($stored_hash, $good_hash);
}
$end = microtime(TRUE);
$strcmp_time_good = $end - $start;
print("Good hash (Naive strcmp): time=$strcmp_time_good\n");

$start = microtime(TRUE);
for ($i = 0; $i < $count; $i++) {
	naive_compare_strcmp($stored_hash, $wrong_hash);
}
$end = microtime(TRUE);
$strcmp_time_wrong = $end - $start;
print("Wrong hash (Naive strcmp): time=$strcmp_time_wrong\n");
print("Time Difference: ".($strcmp_time_good - $strcmp_time_wrong)."\n");


// Do a fixed time comparison
$start = microtime(TRUE);
for ($i = 0; $i < $count; $i++) {
	hash_equals($stored_hash, $good_hash);
}
$end = microtime(TRUE);
$fixed_time_good = $end - $start;
print("Good hash (hash_equals): time=$fixed_time_good\n");

$start = microtime(TRUE);
for ($i = 0; $i < $count; $i++) {
	hash_equals($stored_hash, $wrong_hash);
}
$end = microtime(TRUE);
$fixed_time_wrong = $end - $start;
print("Wrong hash (hash_equals): time=$fixed_time_wrong\n");
print("Time Difference: ".($fixed_time_good - $fixed_time_wrong)."\n");


