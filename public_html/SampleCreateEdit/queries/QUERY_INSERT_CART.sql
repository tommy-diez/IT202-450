SELECT * FROM Products
where id= :id;

UPDATE Products
SET quantity = quantity-:quantity
WHERE id = :id;

INSERT INTO Cart (productID, quantity, price, userID)
VALUES(:id, :quantity, :price, :userID);


