// SHOPPING CART PAGE COMPUTATIONS


var cartRows = document.getElementsByClassName('cart-item-row')
var totalcartprice = 0
for (var i = 0; i < cartRows.length; i++) {
    var cartRow = cartRows[i]

    var priceElement = cartRow.getElementsByClassName('cart-item-price')[0]
    var price = parseFloat(priceElement.innerText)

    var quantityElement = cartRow.getElementsByClassName('cart-quantity-text')[0]
    var quantity = parseFloat(quantityElement.innerText)

    document.getElementsByClassName('cart-item-total-price')[i].innerText = price * quantity

    var totalpriceElement = cartRow.getElementsByClassName('cart-item-total-price')[0]
    var totalprice = parseFloat(totalpriceElement.innerText)
    totalcartprice = totalcartprice + totalprice

}

document.getElementsByClassName('total-price-display')[0].innerText = "Total Cart Price: ₱" + totalcartprice;







// SINGLE ITEM PAGE FUNCTIONS


function addQuantity () {
    document.getElementById('add').stepUp();
    computation()

}

function subtractQuantity () {
    document.getElementById('minus').stepDown();
    computation()
}

function computation() {
    var checkoutPrice = parseFloat(document.getElementsByClassName('checkout-unit-price')[0].innerText)    
    var checkoutQuantity = parseFloat(document.getElementsByClassName('checkout-quantity')[0].value) 
    var checkouttotalitemprice = checkoutPrice * checkoutQuantity 
    document.getElementsByClassName('checkout-total-item-price')[0].innerText = checkouttotalitemprice
}

function disableexpress() {
    document.getElementById("btn-express").classList.remove('btn-success');
    document.getElementById("btn-express").classList.add('btn-secondary');
    document.getElementById("btn-cod").classList.remove('btn-secondary');
    document.getElementById("btn-cod").classList.add('btn-primary');
    document.getElementById("online").style.display="none";
    document.getElementById("cod").style.display="block";
    
}

function disablecod() {
    document.getElementById("btn-cod").classList.remove('btn-primary');
    document.getElementById("btn-cod").classList.add('btn-secondary');
    document.getElementById("btn-express").classList.remove('btn-secondary');
    document.getElementById("btn-express").classList.add('btn-success');
    document.getElementById("online").style.display="block";
    document.getElementById("cod").style.display="none";
   
}
function enablepayment(){
    document.getElementById("buy").style.display="none";
}






// FORM VALIDATIONS



