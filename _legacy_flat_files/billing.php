<!DOCTYPE html>
<html>
<head>
    <title>Billing</title>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
</head>
<body>
    <h2>Scan Product QR Code</h2>
    <video id="preview" width="300" height="300"></video>

    <form action="add-to-cart.php" method="POST">
        <input type="hidden" id="product_id" name="product_id">
        <button type="submit">Add to Cart</button>
    </form>

    <script>
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        scanner.addListener('scan', content => {
            let id = new URLSearchParams(content).get("product_id");
            document.getElementById("product_id").value = id;
            alert("Product scanned: " + id);
        });
        Instascan.Camera.getCameras().then(cameras => {
            if (cameras.length > 0) scanner.start(cameras[0]);
        });
    </script>
</body>
</html>