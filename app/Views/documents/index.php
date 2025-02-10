<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documents List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Documents List</h2>
    <a href="<?= site_url('documents/create') ?>" class="btn btn-primary mb-3">Upload New Document</a>
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Description</th>
                <th>File</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($documents as $doc): ?>
                <tr>
                    <td><?= $doc['title'] ?></td>
                    <td><?= $doc['category'] ?></td>
                    <td><?= $doc['subcategory'] ?></td>
                    <td><?= $doc['description'] ?></td>
                    <td><a href="<?= base_url('uploads/'.$doc['file_path']) ?>" target="_blank">View PDF</a></td>
                    <td>
                        <form action="<?= site_url('documents/delete/' . $doc['id']) ?>" method="post" onsubmit="return confirm('Are you sure?');">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
