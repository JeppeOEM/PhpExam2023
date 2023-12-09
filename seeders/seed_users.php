<?php

require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/Faker/src/autoload.php';

// use the factory to create a Faker\Generator instance
$faker = Faker\Factory::create();

$db = _db();


$q = 'INSERT INTO users2 VALUES ';
$values = '';
for ($i = 0; $i < 10; $i++) {
  // $user_id = bin2hex(random_bytes(16));
  $password = password_hash($faker->password, PASSWORD_DEFAULT);
  $blocked  = rand(0, 1);
  $created_at = time();
  $values .= "(null,
                '$faker->firstName', 
                '$faker->lastName', 
                '$faker->email',
                '$password', 
                'user',
                '2240',
                '$faker->address',
                '$faker->city',
                $blocked
              ),";
}
$values = rtrim($values, ",");
$q .= $values;
var_dump($values);
$db = _db();
$sql = $db->prepare($q);
$sql->execute();
