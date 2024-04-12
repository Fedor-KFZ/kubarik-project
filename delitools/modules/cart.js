const ajaxcart = document.querySelector(".ajaxcart")
const ajaxcart_list = document.querySelector(".ajaxcart .ajaxcart-list")

ajaxcart.addEventListener("mouseenter", (e) => {
    const cartData = localStorage.getItem('cart')
    fetch("/modules/cart/list.php", {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'cartData='+encodeURIComponent(cartData)
    }).then(res=>res.text()).then(data => {
        ajaxcart_list.innerHTML = data;
    })
})


function addToCart(id) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let item = cart.find(item => item.id === id);

    if (item) {
        item.quantity += 1;
    } else {
        cart.push({ id: id, quantity: 1 });
    }

    localStorage.setItem('cart', JSON.stringify(cart));
}

// Function to set the quantity of an item in the cart
function setQuantity(id, quantity) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let item = cart.find(item => item.id === id);

    if (item) {
        item.quantity = quantity;
    }

    localStorage.setItem('cart', JSON.stringify(cart));
}

// Function to remove an item from the cart
function removeFromCart(id) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart = cart.filter(item => item.id !== id);

    localStorage.setItem('cart', JSON.stringify(cart));
}