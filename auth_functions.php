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
            $query->execute(array($login, $password));
        }
    }
    logIn($login, $password);
}

function logIn($login, $password)
{
    if (!empty($login) && !empty($password)) {
        $pdo = connectDB();
        $query = $pdo->prepare('select * from users where login = ? and password = ?');
        $query->execute(array($login, $password));
        if ($query != 0) {
            foreach ($query as $row) {
                $dblogin = $row['login'];
                $dbpassword = $row['password'];
            }
            if ($login == $dblogin && $password == $dbpassword) {
                session_start();
                $_SESSION['session_username'] = $login;

                header("Location: index.php");
            }
        } else {
            //  $message = "Invalid username or password!";

            echo "Invalid username or password!";
        }
    } else {
        $message = "All fields are required!";
    }
}

if (isset($_POST['register'])) {
    register(htmlspecialchars($_POST['login']), htmlspecialchars($_POST['password']));
}
if (isset($_POST['logIn'])) {
    logIn(htmlspecialchars($_POST['login']), htmlspecialchars($_POST['password']));
}

?>