<?
require_once "library/php/functions.php";
require_once "partials/templates.php";

$cartItems = getCartItems();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Checkout</title>
	<? include "partials/head.html"; ?>
</head>
<body>
	<? include "partials/checkout_header.php"; ?>

    <div class="content">
        <div class="container pad push-down">
            <h2 class="spacer">Payment Information</h2>
            <div class="grid gap xs-medium md-medium lg-large">
                <div class="col-xs-12 col-md-8 col-lg-9">

                    <form class="card card-light card-soft" style="height:auto;">

                        <div class="form-control">
                            <label class="form-label" for="card-name">Name on Card</label>
                            <input class="form-input" id="card-name" name="card-name" type="text" required>
                        </div>
                        <div class="form-control">
                            <label class="form-label" for="card-number">Card Number</label>
                            <input class="form-input" id="card-number" name="card-number" type="text" pattern="[0-9]{4} [0-9]{4} [0-9]{4} [0-9]{4}" placeholder="0000 0000 0000 0000" required>
                        </div>
                        
                        <div class="display-flex flex-bottom form-control">
                            <div class="form-half">
                                <label class="form-label" for="expiration-date">Exp. Date</label>
                                <input class="form-input" id="expiration-date" name="expiration-date" type="text" pattern="[0-9]{2}/[0-9]{2}" placeholder="MM/YY" required>
                            </div>
                            <hr class="vertical-spacer">
                            <div class="form-half">
                                <label class="form-label" for="cvv">CVV</label>
                                <input class="form-input" id="cvv" name="cvv" type="text" pattern="[0-9]{3}" placeholder="000" required>
                            </div>
                        </div>
                    
                    </form>

                    <hr class="spacer small">
                    <h2 class="spacer">Shipping Information</h2>
                    
                    <form class="card card-light card-soft" style="height:auto;" action="product_confirmation.php" method="post">

                        <div class="form-control">
                            <label class="form-label" for="name">Full Name</label>
                            <input class="form-input" id="name" name="name" type="text" required>
                        </div>
                        <div class="form-control">
                            <label class="form-label" for="address">Address</label>
                            <input class="form-input" id="address" name="address" type="text" required>
                        </div>
                        <div class="form-control">
                            <label class="form-label" for="city">City</label>
                            <input class="form-input" id="city" name="city" type="text" required>
                        </div>

                        <div class="display-flex flex-bottom form-control">
                            <div class="form-half">
                                <label class="form-label" for="state">State</label>
                                <input class="form-input" id="state" name="state" type="text" required>
                            </div>
                            <hr class="vertical-spacer">
                            <div class="form-half">
                                <label class="form-label" for="zip">Zip Code</label>
                                <input class="form-input" id="zip" name="zip" type="text" pattern="[0-9]{5}" placeholder="00000" required>
                            </div>
                        </div>
                        <div class="display-flex flex-bottom form-control">
                            <div class="form-half">
                                <label class="form-label" for="email">Email</label>
                                <input class="form-input" id="email" name="email" type="email" placeholder="email@gmail.com" required>
                            </div>
                            <hr class="vertical-spacer">
                            <div class="form-half">
                                <label class="form-label" for="phone">Phone</label>
                                <input class="form-input" id="phone" name="phone" type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="999-999-9999" required>
                            </div>
                        </div>

                        <hr class="spacer">

                        <div class="form-control">
                            <input class="form-button" type="submit" value="Confirm Order">
                        </div>

                    </form>

                </div>
                <div class="col-xs-12 col-md-4 col-lg-3">
                    <div class="card card-soft card-dark order-summary">
                        <h2>Order Summary</h2>
                        <hr>
                        <?= cartTotals() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <footer class="footer"></footer>
</body>
</html>