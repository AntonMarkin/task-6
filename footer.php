<div class="container">
    <footer class="py-3 my-4">
        <?php
        if (isset($_SESSION['session_username'])) {
            echo '<ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="" class="nav-link px-2 text-muted">' . getUser()['login'] . '</a></li>
            <li class="nav-item"><a href="/logout.php" class="nav-link px-2 text-muted">Выход</a></li>
        </ul>';
        } else {
            echo '<ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="/" class="nav-link px-2 text-muted">Home</a></li>
            <li class="nav-item"><a href="/auth_page.php" class="nav-link px-2 text-muted">Вход</a></li>
            <li class="nav-item"><a href="/registration_page.php" class="nav-link px-2 text-muted">Регистрация</a></li>
        </ul>';
        }
        ?>
        <p class="text-center text-muted">Task 6</p>
    </footer>
</div>
</body>
</html>