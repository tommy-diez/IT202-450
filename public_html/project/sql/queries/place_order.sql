INSERT INTO Orders (OrderID, productID, quantity, price,  userID, paidTotal)
VALUES (:OrderID, :productID, :quantity, :price, :userID, :paidTotal);

UPDATE Products
SET quantity = quantity - :quantity
WHERE id = :productID

UPDATE Products
SET amount_purchased = amount_purchased + :quantity
WHERE id = :productID