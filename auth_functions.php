<?php


include_once('connection.php');

function register($login, $password)
{
    if (!empty($login) && !empty($password)) {
        $pdo = connectDB();
        $query = $pdo->prepare('select * from users where login = ?');
        $query->execute(array($login));
        if ($query->rowCount() == 0) {
            $query = $pdo->prepare('insert into users(login, password) values(?, ?)');
            $query->execute([$login, password_hash($password, PASSWORD_BCRYPT)]);
        }
    }
    logIn($login, $password);
}

function logIn($login, $password)
{
    if (!empty($login) && !empty($password)) {
        $pdo = connectDB();
        $query = $pdo->prepare('select * from users where login = ?');
        $userExist = $query->execute(array($login));
        $user = $query->fetch();
        if ($userExist && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['session_username'] = $user['id'];
            header('Location: index.php');
        } else {
            echo 'Invalid username or password!';
        }
    } else {
        echo 'All fields are required!';
    }
}

if (isset($_POST['register'])) {
    register(htmlspecialchars($_POST['login']), htmlspecialchars($_POST['password']));
}
if (isset($_POST['logIn'])) {
    logIn(htmlspecialchars($_POST['login']), htmlspecialchars($_POST['password']));
}

?>