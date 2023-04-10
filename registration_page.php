<?php

include_once('header.php');
include('task_functions.php');

?>
    <div class="container">
        <div>
            <h1>Регистрация</h1>
            <form action="/registration_page.php" id="registerform" method="post" name="registerform">
                <p><label for="user_pass">Логин<br>
                        <input class="input" id="login" name="login" size="32" type="text" value=""></label></p>
                <p><label for="user_pass">Пароль<br>
                        <input class="input" id="password" name="password" size="32" type="password" value=""></label>
                </p>
                <p class="submit"><input class="button" id="register" name="register" type="submit"
                                         value="Зарегистрироваться"></p>
                <p class="regtext">Уже зарегистрированы? <a href="/auth_page.php">Введите имя пользователя</a>!</p>
            </form>
        </div>
<?php

include_once('footer.php');

?>