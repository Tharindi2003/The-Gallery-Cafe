// Function to handle checkout process
function checkout() {
    if (cart.length === 0) {
        alert('Your cart is empty!');
        return;
    }

    // Send the cart data to PHP using Fetch API
    fetch('checkout.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ items: cart }) // Sending cart data
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Order placed successfully!');
            // Clear the cart after a successful checkout
            cart = [];
            updateCart(); // Reset the cart display
            toggleCart(); // Close the cart display
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred during checkout.');
    });
}

// Example cart data structure for reference
let cart = [
    {
        name: 'Creamy Tomato and Spinach Pasta',
        price: 2000,
        quantity: 1
    },
    {
        name: 'Prawns Spaghetti',
        price: 2500,
        quantity: 10
    }
];
