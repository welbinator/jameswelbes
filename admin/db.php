<?php

$db['db_name'] = 'jameswel_8js8dj98d';
$db['db_user'] = 'jameswelbes_portfolio';
$db['db_pass'] = 'h~Sv+0J9&HNN';
$db['db_host'] = '67.227.174.185';

foreach ($db as $key => $value) {

  define(strtoupper($key), $value);
}


$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
