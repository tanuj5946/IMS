<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing - Scan QR</title>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
</head>
<body>
    <h2>Scan Product QR Code</h2>
    <video id="preview" width="300" height="300"></video>

    <form action="add-to-cart.php" method="POST">
        <input type="hidden" name="product_id" id="product_id">
        <button type="submit">Add to Cart</button>
    </form>

    <script>
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        scanner.addListener('scan', function (content) {
            let params = new URLSearchParams(content);
            let productId = params.get('product_id');
            document.getElementById('product_id').value = productId;
            alert("Product Added to Cart: " + productId);
        });

        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                alert("No cameras found.");
            }
        }).catch(function (e) {
            console.error(e);
        });
    </script>
</body>
</html>
