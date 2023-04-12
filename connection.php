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
    $user = $pdo->prepare('select * from users where id = ?');
    $id = $_SESSION['session_username'];
    settype($id,'integer');
    $user->execute(array($id));
    return $user->fetch();
}