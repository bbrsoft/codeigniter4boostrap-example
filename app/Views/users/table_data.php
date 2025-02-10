<?php foreach ($users as $user): ?>
    <tr>
        <td><?= $user['id'] ?></td>
        <td><?= $user['username'] ?></td>
        <td><?= $user['email'] ?></td>
        <td><?= $user['city'] ?></td>
    </tr>
<?php endforeach; ?>