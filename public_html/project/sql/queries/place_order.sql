INSERT INTO Orders (OrderID, productID, quantity, userID, paidTotal)
VALUES (:OrderID, :productID, :quantity, :userID, :paidTotal);

UPDATE Products
SET quantity = quantity - :quantity
WHERE id = :productID

