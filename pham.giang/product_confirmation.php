<?
require_once "library/php/functions.php";
require_once "partials/templates.php";

$cartItems = getCartItems();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Order Confirmation</title>
	<? include "partials/head.html"; ?>
</head>
<body>
	<? include "partials/checkout_header.php"; ?>

    <div class="content">
    	<div class="container pad push-down">
    		<h2 class="spacer">Order Confirmation</h2>
            <div class="confirmation display-flex flex-center">
                <div class="confirm-box flex-none display-flex flex-center">
                    <div class="confirm-icon">
                        <img src="images/general/confirm.png">
                    </div>
                </div>
                <div class="flex-stretch">
                    <h4>Thank you for your order!</h4>
                    <span>A confirmation email has been sent to <?= $_POST["email"]; ?>.</span>
                </div>
            </div>
            <hr class="dark">
    		<div class="grid gap xs-small md-large">
                <div class="col-xs-12 col-md-3">
                    <div class="card-flat">
    					<strong>Delivery to</strong>
    					<ul>
    						<li><?= $_POST["name"]; ?></li>
    						<li><?= $_POST["address"]; ?></li>
    						<li><?= $_POST["city"]; ?>, <?= $_POST["state"];?> <?=$_POST["zip"]; ?></li>
    						<li><?= $_POST["phone"]; ?></li>
    					</ul>
                    </div>
                </div>
                <div class="col-xs-12 col-md-9">
    	            <div class="card-flat item-list">
                    	<strong>Items</strong>
    	                <?php
    	                echo array_reduce($cartItems,'confirmListTemplate');
    	                ?>
    	            </div>
    	        </div>
    		</div>
    	    <hr class="dark">
            <div class="grid gap xs-medium md-large">
                <div class="col-xs-12 col-md-6">
                    <form method="get" action="form_actions.php">
                        <input type="hidden" name="action" value="product-list-cart-reset">
                        <input type="submit" class="form-button" value="Continue Shopping">
                    </form>
                </div>
                <div class="col-xs-12 col-md-6">
                    <form method="get" action="form_actions.php">
                        <input type="hidden" name="action" value="home-cart-reset">
                        <input type="submit" class="form-button secondary" value="Back to Home">
                    </form>
                </div>
            </div>
    	</div>
    </div>

    <footer class="footer"></footer>
    
</body>
</html>