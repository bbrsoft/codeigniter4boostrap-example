<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Excel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg p-4">
                    <h2 class="text-center">Upload File Excel</h2>
                    <form action="<?= base_url('excel/import') ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="file_excel" class="form-label">Pilih File Excel</label>
                            <input class="form-control" type="file" name="file_excel" id="file_excel" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Upload</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="<?= base_url('excel/export') ?>" class="btn btn-success">Download Data Excel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
