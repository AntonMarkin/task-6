<?php
function connectDB()
{
    $dsn = 'mysql:dbname=tasklist;host=127.0.0.1';
    $pdo = new PDO($dsn, 'root', '');
    return $pdo;
}