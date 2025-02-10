<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Manager</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>File Manager</h2>
    <h5>Folder: <?= $currentFolder ?: 'Root' ?></h5>

    <form action="<?= site_url('file-manager/upload') ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="folder" value="<?= $currentFolder ?>">
        <input type="file" name="file" class="form-control mb-2">
        <button type="submit" class="btn btn-success">Upload</button>
    </form>

<!-- Breadcrumb Navigation -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?= site_url('file-manager') ?>">Home</a>
        </li>
        <?php 
        $path = ''; 
        $parts = explode('/', $currentFolder);
        foreach ($parts as $part): 
            if ($part) {
                $path .= '/' . $part;
        ?>
            <li class="breadcrumb-item">
                <a href="<?= site_url('file-manager/folder' . $path) ?>"><?= $part ?></a>
            </li>
        <?php } endforeach; ?>
    </ol>
</nav>
<h3 class="mt-4">Folders</h3>
<ul>
    <?php foreach ($folders as $folder): ?>
        <li>
            <a href="<?= site_url('file-manager/folder' . ($currentFolder ? '/' . $currentFolder : '') . '/' . $folder) ?>">
                <?= $folder ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>


    <h3>Files</h3>
    <ul>
        <?php foreach ($files as $file): ?>
            <li>
                <?= $file ?> 

                <!-- Form Hapus -->
                <form action="<?= site_url('file-manager/delete') ?>" method="post" class="d-inline">
                    <input type="hidden" name="file" value="<?= $file ?>">
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>

                <!-- Form Rename -->
                <form action="<?= site_url('file-manager/rename') ?>" method="post" class="d-inline">
                    <input type="hidden" name="old_name" value="<?= $file ?>">
                    <input type="text" name="new_name" placeholder="Rename" required class="form-control d-inline w-auto">
                    <button type="submit" class="btn btn-primary btn-sm">Rename</button>
                </form>

                <!-- Form Copy -->
                <form action="<?= site_url('file-manager/copy') ?>" method="post" class="d-inline">
                    <input type="hidden" name="file" value="<?= $file ?>">
                    <input type="text" name="to_folder" placeholder="/(main/sub/subfolder)" class="form-control d-inline w-auto">
                    <button type="submit" class="btn btn-warning btn-sm">Copy</button>
                </form>

                <form action="<?= site_url('file-manager/move') ?>" method="post" class="d-inline">
                    <input type="hidden" name="file" value="<?= $file ?>">
                    <input type="hidden" name="from_folder" value="<?= $currentFolder ?>">
                    <input type="text" name="to_folder" placeholder="/(main/sub/subfolder)" class="form-control d-inline w-auto">
                    <button type="submit" class="btn btn-secondary btn-sm">Move</button>
                </form>


            </li>
        <?php endforeach; ?>
    </ul>

</div>
</body>
</html>
