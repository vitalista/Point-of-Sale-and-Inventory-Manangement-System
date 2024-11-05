<?php include('includes/header.php'); ?>

<div class="container-fluid px-4 main-cards">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Users/Staff
                <a href="users-create.php" class="btn btn-primary float-end">Add User</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <!-- <th>ID</th> -->
                            <th>Name</th>
                            <th>Contact Number</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thread>
                    <tbody>
                        <?php
                        $users = getAll('users'); //// need to change in database
                        if (mysqli_num_rows($users) > 0) {
                        ?>
                            <?php foreach ($users as $user) : /////////////
                            ?>
                                <tr>
                                    <!-- <td class="fw-<?= $user['user_role'] == 'ADMIN' ? 'bold' : 'normal'; ?>"><?= $user['id'] ?></td> -->
                                    <input type="hidden" value="<?= $user['id'] ?>">
                                    <td class="fw-<?= $user['user_role'] == 'ADMIN' ? 'bold' : 'normal'; ?>"><?= $user['name'] ?></td>
                                    <td class="fw-<?= $user['user_role'] == 'ADMIN' ? 'bold' : 'normal'; ?>"><?= $user['phone'] ?></td>
                                    <td class="fw-<?= $user['user_role'] == 'ADMIN' ? 'bold' : 'normal'; ?>"><?= $user['email'] ?></td>

                                    <td>

                                        <?php if ($user['is_ban'] == 1) : ?>
                                            <span class="badge bg-warning text-dark">Banned</span>
                                        <?php else : ?>
                                            <span class="badge bg-<?= $user['user_role'] == 'ADMIN' ? 'success' : 'primary'; ?>">
                                                <?= $user['user_role'] == 'ADMIN' ? 'admin' : 'allowed'; ?></span>
                                        <?php endif; ?>

                                    </td>

                                    <td>

                                        <a href="users-edit.php?id=<?= $user['id'] ?>" class="btn btn-success btn-sm">Edit</a>
                                        <?php if ($user['user_role'] != 'ADMIN') : ?>
                                            <a href="users-delete.php?id=<?= $user['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete it?')">Delete</a>
                                        <?php else : ?>
                                        <?php endif; ?>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php
                        } else {
                        ?>
                            <tr>
                                <td colspan="4"> No Record Found</td>
                            </tr>
                        <?php

                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>