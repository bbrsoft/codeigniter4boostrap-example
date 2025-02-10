<table class="table table-bordered">
    <thead>
        <tr>
            <th><a href="#" class="sortable <?= ($sort == 'id') ? 'active' : '' ?>" data-sort="id" data-order="<?= ($sort == 'id' && $order == 'asc') ? 'desc' : 'asc' ?>">ID</a></th>
            <th><a href="#" class="sortable <?= ($sort == 'username') ? 'active' : '' ?>" data-sort="username" data-order="<?= ($sort == 'username' && $order == 'asc') ? 'desc' : 'asc' ?>">Username</a></th>
            <th><a href="#" class="sortable <?= ($sort == 'email') ? 'active' : '' ?>" data-sort="email" data-order="<?= ($sort == 'email' && $order == 'asc') ? 'desc' : 'asc' ?>">Email</a></th>
            <th><a href="#" class="sortable <?= ($sort == 'city') ? 'active' : '' ?>" data-sort="city" data-order="<?= ($sort == 'city' && $order == 'asc') ? 'desc' : 'asc' ?>">City</a></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['username'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['city'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $pager->links('group1', 'default_full') ?>
