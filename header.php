<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>TaskList</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <span class="fs-4">TaskList</span>
        </a>
        <?php
        if (isset($_SESSION['session_username'])){
            echo '        <ul class="nav nav-pills">
            <li class="nav-item"><a href="" class="nav-link text-muted">'.$_SESSION['session_username'].'</a></li>
            <li class="nav-item"><a href="/logout.php" class="nav-link">Выход</a></li>
        </ul>';
        }
        else{
            echo '        <ul class="nav nav-pills">
            <li class="nav-item"><a href="/auth_page.php" class="nav-link">Вход</a></li>
            <li class="nav-item"><a href="/registration_page.php" class="nav-link">Регистрация</a></li>
        </ul>';
        }
        ?>
    </header>
</div>