<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h2>Upload Document</h2>
    <?php if(session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <?= implode('<br>', session()->getFlashdata('errors')) ?>
        </div>
    <?php endif; ?>
    <form action="<?= site_url('documents/store') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Category</label>
            <select name="category" id="category" class="form-control" required>
                <option value="">Select Category</option>
                <option value="Tech">Tech</option>
                <option value="Business">Business</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Subcategory</label>
            <select name="sub_category" id="sub_category" class="form-control" required>
                <option value="">Select Subcategory</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Upload PDF</label>
            <input type="file" name="file" class="form-control" accept="application/pdf" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('#category').change(function() {
            let category = $(this).val();
            let subcategory = $('#sub_category');
            subcategory.empty();

            if (category === "Tech") {
                subcategory.append('<option value="Web">Web Development</option>');
                subcategory.append('<option value="AI">Artificial Intelligence</option>');
            } else if (category === "Business") {
                subcategory.append('<option value="Marketing">Marketing</option>');
                subcategory.append('<option value="Finance">Finance</option>');
            }
        });
    });
</script>

</body>
</html>
