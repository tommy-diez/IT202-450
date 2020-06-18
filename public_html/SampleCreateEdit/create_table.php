<?php
?>
<html>
    <head>
    </head>
    <body>
        <form>
            <label for="product_name">Product Name</label>
            <input type="text" name="product_name" required>
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity">
            <label for="price"></label>
            <input type="text" name="price" required>
            <label for="description"></label>
            <input type="text" name="description">
        </form>
    </body>
</html>

<?php
require("common.inc.php");
$db = getDB();
//example usage, change/move as needed
$stmt = $db->prepare("SELECT * FROM Things");
$stmt->execute();
?>


