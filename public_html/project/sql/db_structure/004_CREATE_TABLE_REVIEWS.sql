CREATE TABLE if not exists `Reviews`(
    `id` int not null auto_increment,
    `productID` int not null,
    `rating` int not null,
    `description` varchar(60),
    `created` timestamp default current_timestamp,
    `modified` timestamp default current_timestamp on update current_timestamp,
    PRIMARY KEY(`id`),
    FOREIGN KEY (`productID`) REFERENCES Products(id)
);


