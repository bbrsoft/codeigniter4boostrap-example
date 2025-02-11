<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Manager</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container mt-4">
    <h2 class="text-primary"><i class="fas fa-folder-open"></i> File Manager</h2>
    <h5 class="text-secondary">Folder: <?= $currentFolder ?: 'Root' ?></h5>

    <form action="<?= site_url('file-manager/upload') ?>" method="post" enctype="multipart/form-data" class="mb-4">
        <input type="hidden" name="folder" value="<?= $currentFolder ?>">
        <div class="input-group">
            <input type="file" name="file" class="form-control" required>
            <button type="submit" class="btn btn-success"><i class="fas fa-upload"></i> Upload</button>
        </div>
    </form>

    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2 rounded">
            <li class="breadcrumb-item"><a href="<?= site_url('file-manager') ?>">Home</a></li>
            <?php 
            $path = ''; 
            $parts = explode('/', $currentFolder);
            foreach ($parts as $part): 
                if ($part) {
                    $path .= '/' . $part;
            ?>
                <li class="breadcrumb-item"><a href="<?= site_url('file-manager/folder' . $path) ?>"><?= $part ?></a></li>
            <?php } endforeach; ?>
        </ol>
    </nav>

    <h3 class="mt-4 text-primary">📁 Folders</h3>
    <div class="row">
        <?php foreach ($folders as $folder): ?>
            <div class="col-md-3">
                <div class="card shadow-sm p-3 mb-3">
                    <a href="<?= site_url('file-manager/folder' . ($currentFolder ? '/' . $currentFolder : '') . '/' . $folder) ?>" class="text-decoration-none text-dark">
                        <i class="fas fa-folder text-warning"></i> <?= $folder ?>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <h3 class="mt-4 text-primary">📄 Files</h3>
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>File Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($files as $file): ?>
                <tr>
                    <td><?= $file ?></td>
                    <td>
                        <!-- Hapus -->
                        <form action="<?= site_url('file-manager/delete') ?>" method="post" class="d-inline">
                            <input type="hidden" name="file" value="<?= $file ?>">
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </form>
                        
                        <!-- Rename -->
                        <form action="<?= site_url('file-manager/rename') ?>" method="post" class="d-inline">
                            <input type="hidden" name="old_name" value="<?= $file ?>">
                            <input type="text" name="new_name" placeholder="Rename" required class="form-control d-inline w-auto">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                        </form>
                        
                        <!-- Copy -->
                        <form action="<?= site_url('file-manager/copy') ?>" method="post" class="d-inline">
                            <input type="hidden" name="file" value="<?= $file ?>">
                            <input type="text" name="to_folder" placeholder="Copy to" class="form-control d-inline w-auto">
                            <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-copy"></i></button>
                        </form>
                        
                        <!-- Move -->
                        <form action="<?= site_url('file-manager/move') ?>" method="post" class="d-inline">
                            <input type="hidden" name="file" value="<?= $file ?>">
                            <input type="hidden" name="from_folder" value="<?= $currentFolder ?>">
                            <input type="text" name="to_folder" placeholder="Move to" class="form-control d-inline w-auto">
                            <button type="submit" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-right"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
