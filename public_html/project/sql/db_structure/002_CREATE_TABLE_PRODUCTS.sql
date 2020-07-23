CREATE TABLE if not exists `Products`(
`id` int NOT NULL,
`user_id` int,
`name` varchar NOT NULL UNIQUE,
`quantity` int NOT NULL,
`price` decimal(12, 2),
`created` timestamp default current_timestamp,
`modified` timestamp default current_timestamp on update current_timestamp,
PRIMARY KEY(`id`),
FOREIGN KEY(`user_id`) REFERENCES Users(id)
)
