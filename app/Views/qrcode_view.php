<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg p-4 border-0 rounded-4 text-center">
                    <h2 class="text-primary">📌 QR Code Generator</h2>
                    <button id="generateQR" class="btn btn-success w-100 my-3">🔄 Generate QR Code</button>
                    <div class="d-flex justify-content-center">
                        <img id="qrImage" src="" alt="QR Code akan muncul di sini" class="img-fluid border p-2" style="max-width: 250px; display: none;">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#generateQR").click(function() {
                $.getJSON("<?= base_url('qrcode/generate') ?>", function(data) {
                    if (data.file_url) {
                        $("#qrImage").attr("src", data.file_url).fadeIn();
                    } else {
                        alert("❌ Gagal membuat QR Code");
                    }
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
