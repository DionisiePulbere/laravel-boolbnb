
<!DOCTYPE html>
<html>
<head>
    <title>Pagamento Braintree</title>
    <script src="https://js.braintreegateway.com/web/dropin/1.30.1/js/dropin.min.js"></script>
</head>
<body>
    <div id="dropin-container"></div>
    <button id="submit-button">Paga</button>

    <script>
        fetch('/payment/token')
            .then(response => response.json())
            .then(data => {
                braintree.dropin.create({
                    authorization: data.token,
                    container: '#dropin-container'
                }, function (err, dropinInstance) {
                    if (err) {
                        console.error(err);
                        return;
                    }
                    document.getElementById('submit-button').addEventListener('click', function () {
                        dropinInstance.requestPaymentMethod(function (err, payload) {
                            if (err) {
                                console.error(err);
                                return;
                            }

                            fetch('/payment/checkout', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    payment_method_nonce: payload.nonce,
                                    amount: '10.00' // L'importo del pagamento
                                })
                            }).then(response => response.json()).then(data => {
                                if (data.success) {
                                    alert('Pagamento effettuato con successo!');
                                } else {
                                    alert('Errore nel pagamento: ' + data.message);
                                }
                            });
                        });
                    });
                });
            });
    </script>
</body>
</html>