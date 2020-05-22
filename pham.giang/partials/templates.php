<?

function featuredTemplate($r,$o) {
return $r.<<<HTML
    <div class="col-xs-12 col-md-4">
        <div class="product-figure overlay soft">
            <img class="image-contain" src="images/products/$o->image">
            <figcaption>$o->title</figcaption>
            <a href="product_item.php/?id=$o->id" class="form-button">View</a>
        </div>
    </div>
HTML;
}

function recommendationTemplate($r,$o) {
return $r.<<<HTML
    <div class="col-xs-12 col-md-6 col-lg-3">
        <a href="product_item.php?id=$o->id" class="product-item card card-soft card-light card-flat">
            <div class="image-square">
                <img src="images/products/$o->image" alt="">
            </div>
            <div class="list-description">
                <h4>$o->title</h4>
                <h6>&dollar;$o->price</h6> 
            </div>
        </a>
    </div>
HTML;
}


function cartListTemplate($r,$o) {
$pricefixed = number_format($o->price, 2, '.', '');
$selectamount = selectAmount($o->amount,10);
return $r.<<<HTML

    <div class='card-soft card-light card-section display-flex cart-item'>
        <div class="flex-none image-thumbnail">
             <img src="images/products/$o->image">
        </div>
        <div class="item-info display-flex">
            <div class="flex-stretch position-relative">
                <h4>$o->title</h4>
                <h6>&dollar;$pricefixed</h6>
                <hr class="spacer">
                <nav class="nav-crumbs item-modification bottom">
                    <ul>
                        <li><a href="product_item.php?id=$o->id">View</a></li>
                        <li>
                            <form method="get" class="display-inlineblock" action="form_actions.php">
                                <input type="hidden" name="action" value="delete-cart-item">
                                <input type="hidden" name="id" value="$o->id">
                                <input type="submit" class="modification" value="Delete">
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="flex-spacer"></div>
            <div class="flex-none">
                <form method="get" action="form_actions.php" onchange="this.submit()">
                    <input type="hidden" name="action" value="update-cart-amount">
                    <input type="hidden" name="id" value="$o->id">
                    <div class="form-select quantity-select">$selectamount</div>
                </form>
            </div>
        </div>
    </div>
HTML;
}

function confirmListTemplate($r,$o) {
$pricefixed = number_format($o->price, 2, '.', '');
$selectamount = selectAmount($o->amount,10);
return $r.<<<HTML

    <div class='card-soft card-light card-section display-flex cart-item'>
        <div class="flex-none image-thumbnail">
             <img src="images/products/$o->image">
        </div>
        <div class="item-info display-flex">
            <div class="flex-stretch position-relative">
                <h4>$o->title</h4>
                <h6>&dollar;$pricefixed</h6>
            </div>
            <div class="flex-spacer"></div>
            <div class="flex-none" style="font-weight:500">
                Quantity $o->amount
            </div>
        </div>
    </div>
HTML;
}


function selectAmount($amount=1,$total=10) {
    $output = "<select name='amount'>";
    for($i=1;$i<=$total;$i++){
        $output .= "<option ".($i==$amount?"selected":"").">$i</option>";
    }
    $output .= "</select>";
    return $output;
}



function cartTotals() {
$cart = getCart();

$cartprice = array_reduce($cart,function($r,$o){return $r + ($o->amount*$o->price);},0);


$pricefixed = number_format($cartprice, 2, '.', '');
$taxfixed = number_format($cartprice*0.0725, 2, '.', '');
$taxedfixed = number_format($cartprice*1.0725, 2, '.', '');


return <<<HTML
<div class="card-section">
    <div class="display-flex">
        <div class="flex-stretch">
            <strong>Sub-Total</strong>
        </div>
        <div class="flex-none">&dollar;$pricefixed</div>
    </div>
    <div class="display-flex">
        <div class="flex-stretch">
            <strong>Taxes</strong>
        </div>
        <div class="flex-none">&dollar;$taxfixed</div>
    </div>
</div>
<div class="card-section">
    <div class="display-flex">
        <div class="flex-stretch">
            <strong>TOTAL</strong>
        </div>
        <div class="flex-none"><strong>&dollar;$taxedfixed</strong></div>
    </div>
</div>
HTML;
}


?>