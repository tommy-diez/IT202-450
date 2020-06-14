CREATE TABLE Products(
  ProductCode int PRIMARY KEY AUTO_INCREMENT,
  Product varchar(25) PRIMARY KEY,
  Price DECIMAL(13,2) NOT NULL,
  Stock int NOT NULL,
  Description varchar(255) int NOT NULL,

);
