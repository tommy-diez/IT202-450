INSERT INTO Cart (name, quantity, price)
VALUES( :name, :quantity, :price);

SELECT id
FROM Products
INNER JOIN Cart
ON Products.id = Cart.productID;

SELECT id
FROM Users
INNER JOIN Cart
ON Users.id = Cart.userID;

