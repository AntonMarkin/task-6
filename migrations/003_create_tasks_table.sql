-- Таблица задач --
create table if not exists `tasks` (
    `id` int(10) unsigned not null auto_increment,
    constraint `user_id`
    foreign key(user_id)  REFERENCES users (id)
    `description` varchar(255) not null,
    `status` varchar(255) not null,
    `created_at` timestamp default current_timestamp,
    primary key (id)
    )
    engine = innodb
    auto_increment = 1
    character set utf8
    collate utf8_general_ci;