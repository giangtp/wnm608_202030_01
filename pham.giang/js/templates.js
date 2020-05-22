const productListTemplate = templater((o,i,a) =>{
    return `
    <div class="col-xs-12 col-md-4 col-lg-3">
        <a href="product_item.php?id=${o.id}" class="product-item card card-soft card-light card-flat">
            <div class="image-square">
                <img src="images/products/${o.image}" alt="">
            </div>
            <div class="list-description">
                <h4>${o.title}</h4>
                <h6>&dollar;${Number(o.price).toFixed(2)}</h6> 
            </div>
        </a>
    </div>
    `
});