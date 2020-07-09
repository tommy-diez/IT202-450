CREATE TABLE `Cart` (
    `orderID` int not null,
    `productID` int,
    `quantity` int,
    `userID` int,
    `created` timestamp default current_timestamp,
    `modified` timestamp default current_timestamp on update current_timestamp,
    PRIMARY KEY (`orderID`),
    FOREIGN KEY (`productID`) REFERENCES Products(`id`),
    FOREIGN KEY (`userID`) REFERENCES Users(`id`)

)
