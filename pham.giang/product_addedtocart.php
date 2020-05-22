<?
	require_once "library/php/functions.php";

    $p = array_find(
    getCart(),
    function($o) { return $o->id==$_GET['id']; }
);

    $o = getRows(makeConn(),
    "SELECT * FROM `products` WHERE `id` = {$_GET['id']}")[0];

/*	$totalCartItems = getCartTotalItems();
	$totalCartPrice = getCartTotalPrice(); */

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cart Confirmation</title>
	<? include "partials/head.html"; ?>
</head>
<body>
	<? include "partials/header.php"; ?>

    <div class="content">
        <div class="container pad">
            <hr class="spacer">
            <div class="push-down">
                <div class="confirmation display-flex flex-center">
                    <div class="confirm-box flex-none display-flex flex-center">
                        <div class="confirm-icon">
                            <img src="images/general/confirm.png">
                        </div>
                    </div>
                    <div class="flex-stretch">
                        <h4><?= $o->title?> added to cart!</h4>
                    </div>
                </div>
                <hr class="dark">
                <div class="grid gap xs-medium md-large">
                    <div class="col-xs-12 col-md-6">
                        <a href="product_item.php?id=<?= $o->id ?>" class="form-button">Back to Item</a>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <a href="product_list.php" class="form-button secondary">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "partials/footer.php"; ?>

</body>
</html>