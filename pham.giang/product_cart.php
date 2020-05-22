<?
require_once "library/php/functions.php";
require_once "partials/templates.php";

$cartItems = getCartItems();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Shopping Cart</title>
	<?php include "partials/head.html"; ?>
</head>
<body>

	<?php include "partials/header.php"; ?>
    
    <div class="content">
        <div class="container pad push-down">
            <h2 class="spacer">Shopping Cart</h2>
            <div class="grid gap xs-medium md-medium lg-large">
                <div class="col-xs-12 col-md-8 col-lg-9">
                    <div class="card-flat item-list">
                    <?php
                    echo array_reduce($cartItems,'cartListTemplate');
                    ?>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4 col-lg-3">
                    <div class="card card-soft card-dark order-summary">
        				<h2>Order Summary</h2>
        				<hr>
                        <?= cartTotals() ?>
                        <div class="card-section">
                            <a href="product_checkout.php" class="form-button">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "partials/footer.php"; ?>
    
</body>
</html>