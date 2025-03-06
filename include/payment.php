<script src="https://www.paypal.com/sdk/js?client-id=AQfAeIbwBEwlhXqIbD8EjsaNnn8h53yNV-pz0IG707-iD42l8rjUET8bTPrBWHGtDhd99Q8ZRSVFRhwG&components=buttons&currency=USD"></script>
<script>
    // Ensure the PayPal SDK is loaded before using it
    if (typeof paypal !== 'undefined') {
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?=$sub_total?>' // Amount to be charged
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    alert('Transaction completed by ' + details.payer.name.given_name);

                    <?php

                    ?>

                    localStorage.clear();
                    window.location.reload();
                });
            },
        }).render('#paypal-button-container'); // Display the PayPal button
    } else {
        console.error('PayPal SDK not loaded.');
    }
</script>