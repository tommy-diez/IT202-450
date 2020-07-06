SELECT * FROM Products
where id= :id;

UPDATE Products
SET quantity = quantity-1
WHERE id = :id;

INSERT INTO Cart (productID, quantity, price, userID)
VALUES(:id, :quantity, :price, :userID);


