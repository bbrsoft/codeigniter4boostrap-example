<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <h2>QR Code dengan Logo</h2>
    <button id="generateQR">Generate QR Code</button>
    <br><br>
    <img id="qrImage" src="" alt="QR Code akan muncul di sini">

    <script>
        $(document).ready(function() {
            $("#generateQR").click(function() {
                $.getJSON("<?= base_url('qrcode/generate') ?>", function(data) {
                    if (data.file_url) {
                        $("#qrImage").attr("src", data.file_url);
                    } else {
                        alert("Gagal membuat QR Code");
                    }
                });
            });
        });
    </script>

</body>
</html>
