CREATE TABLE `Orders` (
    `id` int NOT NULL auto_increment,
    `order_id` int NOT NULL UNIQUE,
    `quantity` int NOT NULL,
    `price` decimal(12,2),
    `user_id` int,
    `paid_total` decimal (12,2),
    `created` timestamp default current_timestamp,
    `modified` timestamp default current_timestamp on update current_timestamp,
    PRIMARY KEY(`id`),
    FOREIGN KEY (`user_id`) REFERENCES Users(id)
)
