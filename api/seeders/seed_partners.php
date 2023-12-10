<?php

require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/Faker/src/autoload.php';

$faker = Faker\Factory::create();

$db = _db();
$q = $db->prepare('SELECT user_id FROM users ORDER BY RAND() LIMIT 2');
$q->execute();
$ids = $q->fetchAll(PDO::FETCH_COLUMN); // [5,10]

$q = 'INSERT INTO partners VALUES ';
$values = '';
$array_length = count($ids);
for ($i = 0; $i < $array_length; $i++) {
  $index = array_rand($ids);
  $user_partner_fk = $ids[$index];
  unset($ids[$index]);
  $values .= "($user_partner_fk, '$faker->latitude,$faker->longitude'),";
}
$values = rtrim($values, ",");
$q .= $values;

echo $q;
$db = _db();
$sql = $db->prepare($q);
$sql->execute();








exit();




// $ids = [5,6,7,8,9,10]; // Pool
// $ids = ["a","b","c","d","e","f","g"]; // Pool
// $array_length = count($ids);
// // for($i=0; $i<6; $i++){
// for($i=0; $i< $array_length; $i++){
//   $index = array_rand($ids);
//   echo $ids[$index];
//   unset($ids[$index]);
// }

// exit();




require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/Faker/src/autoload.php';

// use the factory to create a Faker\Generator instance
$faker = Faker\Factory::create();

// Seed from ids 5 to 10
$ids = [5,6,7,8,9,10];

$q = 'INSERT INTO employees VALUES ';
$values = '';
$array_length = count($ids);
for ($i = 0; $i < $array_length; $i++) {
  $salary = rand(10000, 99999);
  $index = array_rand($ids);
  $user_employee_fk = $ids[$index];
  unset($ids[$index]);
  $values .= "($user_employee_fk, $salary),";
}
$values = rtrim($values, ",");
$q .= $values;

echo $q;
exit();
$db = _db();
$sql = $db->prepare($q);
$sql->execute();
