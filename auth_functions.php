<?php
session_start();

include('connection.php');

if(isset($_SESSION["session_username"])){
    header("Location: intropage.php");
}

function register()
{
    if (!empty($_POST['login']) && !empty($_POST['password'])) {
        $pdo = connectDB();
        $query = $pdo->prepare('select * from users where login = ?');
        $query->execute(array($_POST['login']));

        if ($query == null) {
            $query = $pdo->prepare('insert into users(login, password) values(?, ?)');
            $query->execute(array($_POST['login'], $_POST['password']));
            if ($query) {
                $message = "Account Successfully Created";
            } else {
                $message = "Failed to insert data information!";
            }
        } else {
            $message = "That username already exists! Please try another one!";
        }
    } else {
        $message = "All fields are required!";
    }
}

function auth()
{
    if (!empty($_POST['login']) && !empty($_POST['password'])) {
        $pdo = connectDB();

        $query = $pdo->prepare('select * from users where login = ? and password = ?');

        if ($query != 0) {
            while ($row = mysql_fetch_assoc($query)) {
                $dbusername = $row['username'];
                $dbpassword = $row['password'];
            }
            if ( == $dbusername && $password == $dbpassword) {
                // старое место расположения
                //  session_start();
                $_SESSION['session_username'] = $username;
                /* Перенаправление браузера */
                header("Location: intropage.php");
            }
        } else {
            //  $message = "Invalid username or password!";

            echo "Invalid username or password!";
        }
    } else {
        $message = "All fields are required!";
    }
}

if (isset($_POST["register"])) {
    register();
}
if (isset($_POST["login"])) {
    auth();
}
?>