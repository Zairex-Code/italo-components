<?php
// We convert dir in an associative array
$env = parse_ini_file(__DIR__ . '/../.env');

//foreach($env as $env1){
    //echo $n++; 
    //cho $env1."\n";
//}
if ($env) {
    $DB_HOST = $env['DB_HOST'];
    $DB_NAME = $env['DB_NAME'];
    $DB_USER = $env['DB_USER'];
    $DB_PASSWORD = $env['DB_PASSWORD'];
}

try{
    $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
    echo "Connected successfully";
}catch(PDOException $e){
    echo "something wrong :(".$e->getMessage();
}


