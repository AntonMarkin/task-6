<?php

function connectDB()
{
    $dsn = 'mysql:dbname=tasklist;host=127.0.0.1';
    $pdo = new PDO($dsn, 'root', '');
    return $pdo;
}
function getUser()
{
    $pdo = connectDB();
    $user = $pdo->prepare('select * from users where login = ?');
    $user->execute(array($_SESSION['session_username']));

    return $user->fetch();
}