<?php

$dbConfig = [
    'host' => 'organisemephp_mysql_1',
    'username' => 'amy',
    'password' => 'Int3ll1g3nc3',
    'dbname' => 'organiseme',
];

try {
    $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']}";
    $conn = new PDO($dsn, $dbConfig['username'], $dbConfig['password']);
    // set the PDO error mode to exception to throw exceptions
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}