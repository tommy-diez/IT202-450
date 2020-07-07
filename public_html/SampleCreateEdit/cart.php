<?php
if (isset ($_SESSION['user_cart']) && !empty($_SESSION['user_cart'])) {
    $cart = $_SESSION['user_cart'];
    echo "within";
}
else{
    echo "invalid request 403";
}
?>
<?php if(isset($cart)): ?>
<html>
<h1>My Cart</h1>
<?php foreach ($results as $row): ?>
<br>
<ol>
     <li>
         <?php echo get($row, "id"); ?>
         <?php echo get($row, "name"); ?>
         <?php echo get($row, "quantity"); ?>
         <?php echo get($row, "price"); ?>
         <?php echo get($row, "description");?>
     </li>
    <?php endforeach; ?>
</ol>

</html>
<?php endif ?>


