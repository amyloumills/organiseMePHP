<?php

$databaseFile = __DIR__ . '/organiseMeDB.db';

try {
    $pdo = new PDO('sqlite:' . $databaseFile);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Opened database successfully";
} catch (PDOException $e) {
    die($e->getMessage());
}

