<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Excel</title>
</head>
<body>
    <h2>Upload File Excel</h2>
    <form action="<?= base_url('excel/import') ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="file_excel" required>
        <button type="submit">Upload</button>
    </form>

    <br>
    <a href="<?= base_url('excel/export') ?>">Download Data Excel</a>
</body>
</html>
