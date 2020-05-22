<?
require_once "library/php/functions.php";

if(!isset($_GET['action'])) die("No Action Set");

switch($_GET['action']) {
    case "add-to-cart":
        $product = getRows(makeConn(),"SELECT `price` FROM `products` WHERE `id` = {$_GET['id']}");
        addToCart($_GET['id'],$_GET['amount'],$product[0]->price);
        header("location:product_addedtocart.php?id={$_GET['id']}");
        break;
    case "update-cart-amount":
        $p = array_find(
            $_SESSION['cart'],
            function($o){ return $o->id==$_GET['id']; }
        );
        $p->amount = $_GET['amount'];
        header("location:product_cart.php");
        break;
        // Quantity is originally amount
    case "delete-cart-item":
        $_SESSION['cart'] = array_filter($_SESSION['cart'], function($o){ return $o->id!=$_GET['id']; });
        
        header("location:product_cart.php");
        break;
    case "product-list-cart-reset":
        unset($_SESSION['cart']);

        header("location:product_list.php");
        break;
    case "home-cart-reset":
        unset($_SESSION['cart']);

        header("location:index.php");
        break;
}


?>
