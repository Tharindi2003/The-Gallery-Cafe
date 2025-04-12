document.addEventListener('DOMContentLoaded', function() {
    const cart = [];
    const cartItemsElement = document.getElementById('cart-items');
    const cartTotalElement = document.getElementById('cart-total');

    document.querySelectorAll('.cartbtn').forEach(button => {
        button.addEventListener('click', function() {
            const itemElement = this.parentElement;
            const itemName = itemElement.querySelector('h3').innerText;
            const itemPrice = parseFloat(itemElement.querySelector('span').innerText.replace('LKR.', '').trim());
            const itemImage = itemElement.querySelector('img').src; // Capture the image URL

            addItemToCart(itemName, itemPrice, itemImage);
        });
    });

    function addItemToCart(name, price, image) {
        const existingItem = cart.find(item => item.name === name);

        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({ name, price, image, quantity: 1 });
        }

        updateCart();
    }

    function updateCart() {
        cartItemsElement.innerHTML = '';
        let total = 0;

        cart.forEach((item, index) => {
            const itemTotal = item.price * item.quantity;
            total += itemTotal;

            const li = document.createElement('li');
            li.className = 'cart-item';
            li.innerHTML = `
                <img src="${item.image}" alt="${item.name}" class="cart-item-img">
                ${item.name} - LKR.${item.price} x ${item.quantity} = LKR.${itemTotal.toFixed(2)}
                <div class="quantity-control">
                    <button onclick="changeQuantity(${index}, -1)">-</button>
                    <button onclick="changeQuantity(${index}, 1)">+</button>
                    <button onclick="removeItem(${index})">Remove</button>
                </div>
            `;
            cartItemsElement.appendChild(li);
        });

        cartTotalElement.innerText = `Total: LKR.${total.toFixed(2)}`;
    }

    window.changeQuantity = function(index, delta) {
        if (cart[index].quantity + delta > 0) {
            cart[index].quantity += delta;
        } else {
            cart.splice(index, 1);
        }

        updateCart();
    };

    window.removeItem = function(index) {
        cart.splice(index, 1);
        updateCart();
    };

    window.toggleCart = function() {
        const cartElement = document.getElementById('cart');
        cartElement.style.display = cartElement.style.display === 'block' ? 'none' : 'block';
    };

    window.checkout = function() {
        alert('Proceeding to checkout with total: ' + cartTotalElement.innerText);
    };
});