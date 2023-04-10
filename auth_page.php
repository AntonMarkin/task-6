<?php

include_once('header.php');
include('task_functions.php');

?>
    <div class="container mlogin">
        <div id="login">
            <h1>Вход</h1>
            <form action="" id="loginform" method="post" name="loginform">
                <p><label for="user_login">Логин<br>
                        <input class="input" id="login" name="login" size="20"
                               type="text" value=""></label></p>
                <p><label for="user_pass">Пароль<br>
                        <input class="input" id="password" name="password" size="20"
                               type="password" value=""></label></p>
                <p class="submit"><input class="button" name="login" type="submit" value="Log In"></p>
                <p class="regtext">Еще не зарегистрированы? <a href="/registration_page.php">Регистрация</a>!</p>
            </form>
        </div>
    </div>
<?php

include_once('footer.php');

?>