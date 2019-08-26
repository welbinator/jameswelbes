<?php

$db['db_name'] = 'jameswelbes_portfolio';
$db['db_user'] = 'jameswelbes_portfolio';
$db['db_pass'] = 'h~Sv+0J9&HNN';
$db['db_host'] = 'localhost';

foreach($db as $key => $value) {
  
  define(strtoupper($key), $value);
  
  
  
}


$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);


?>