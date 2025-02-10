<?php if (!empty($users)): ?>
    <?php foreach ($users as $user): ?>
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['username'] ?></h5>
                    <p class="card-text"><strong>Email:</strong> <?= $user['email'] ?></p>
                    <p class="card-text"><strong>Domisili:</strong> <?= $user['city'] ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="col-12">
        <p class="text-center text-muted">No users found.</p>
    </div>
<?php endif; ?>

<!-- Pagination Links -->
<div class="col-12">
    <?= $pager->links('group2', 'default_full') ?>
</div>
