const stripe = Stripe('pk_test_51ORaarSGSkuH5Oa1bbsPK4jYPD93dWFhR8BQ7l0grLGIiHBqHX7nv7ZmE1ygrjaV3nOhdnzZD5xrgC5BWwPw5cXR00lL3mBd8S');
const elements = stripe.elements();

// Create an instance of the card Element.
const card = elements.create('card');

// Add an instance of the card Element into the `card-element` div.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', ({error}) => {
    const displayError = document.getElementById('card-errors');
    displayError.textContent = error ? error.message : '';
});

// Handle form submission.
const form = document.getElementById('payment-form');
form.addEventListener('submit', async (event) => {
    event.preventDefault();

    const {token, error} = await stripe.createToken(card);

    if (error) {
        // Inform the user if there was an error.
        const errorElement = document.getElementById('card-errors');
        errorElement.textContent = error.message;
    } else {
        // Insert the token ID into the form so it gets submitted to the server.
        const hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'paymentMethod');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form.
        form.submit();
    }
});
