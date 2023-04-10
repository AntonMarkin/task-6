<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'tasklist');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_TABLE_VERSIONS', 'versions');

function connectDB()
{
    $dsn = 'mysql:dbname=tasklist;host=127.0.0.1';
    $pdo = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    return $pdo;

}

function getMigrationFiles($pdo)
{
    $sqlFolder = str_replace('\\', '/', realpath(dirname(__FILE__)) . '/');
    $allFiles = glob($sqlFolder . '*.sql');


    $query = sprintf('show tables from `%s` like "%s"', DB_NAME, DB_TABLE_VERSIONS);
    echo $query;
    $data = $pdo->query($query);
    $firstMigration = !$data->num_rows;

    if ($firstMigration) {
        return $allFiles;
    }

    $versionsFiles = array();

    $query = sprintf('select `name` from `%s`', DB_TABLE_VERSIONS);
    $data = $pdo->query($query)->fetch_all(MYSQLI_ASSOC);

    foreach ($data as $row) {
        array_push($versionsFiles, $sqlFolder . $row['name']);
    }

    return array_diff($allFiles, $versionsFiles);
}

function migrate($pdo, $file)
{

    $command = sprintf('mysql -u%s -p%s -h %s -D %s < %s', DB_USER, DB_PASSWORD, DB_HOST, DB_NAME, $file);
    shell_exec($command);

    $baseName = basename($file);
    $query = sprintf('insert into `%s` (`name`) values("%s")', DB_TABLE_VERSIONS, $baseName);
    // Выполняем запрос
    $pdo->query($query);
}

$conn = connectDB();

// Получаем список файлов для миграций за исключением тех, которые уже есть в таблице versions

$files = getMigrationFiles($conn);

// Проверяем, есть ли новые миграции
if (empty($files)) {
    echo 'Ваша база данных в актуальном состоянии.';
} else {
    echo 'Начинаем миграцию...<br><br>';

    // Накатываем миграцию для каждого файла
    foreach ($files as $file) {
        migrate($conn, $file);
        // Выводим название выполненного файла
        echo basename($file) . '<br>';
    }

    echo '<br>Миграция завершена.';
}
