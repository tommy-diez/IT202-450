CREATE TABLE if not exists `Users`(
    `id` int auto_increment not null,
    `email` varchar(100) not null unique,
    `first_name` varchar(100),
    `last_name` varchar(100),
    `password` varchar(60),
    `roles` varchar(20),
    `created` timestamp default current_timestamp,
    `modified` timestamp default current_timestamp on update current_timestamp,
    PRIMARY KEY (`id`)
    ) CHARACTER SET utf8 COLLATE utf8_general_ci

