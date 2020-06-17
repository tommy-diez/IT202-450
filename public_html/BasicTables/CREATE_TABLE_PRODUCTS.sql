CREATE TABLE Products (
    id int AUTO_INCREMENT,
    name varchar(60) NOT NULL unique,
    quantity int default 0,
    price decimal(10, 2) default 0.00,
    description TEXT,
    modified datetime default current_timestamp on update current_timestamp,
    created datetime default current_timestamp,
    primary key(id)

)

