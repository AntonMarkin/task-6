-- Таблица пользователей --
create table if not exists `users` (
    `id` int(10) unsigned not null auto_increment,
    `login` varchar(255) not null unique,
    `password` varchar(255) not null,
    `created_at` timestamp default current_timestamp,
    primary key (id)
    )
    engine = innodb
    auto_increment = 1
    character set utf8
    collate utf8_general_ci;