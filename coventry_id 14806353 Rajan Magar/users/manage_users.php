<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="../assets/css/admin_panel.css">
    <link rel="stylesheet" href="../assets/css/manage_users.css">
</head>

<body>
    <header>
        <div class="logo">
            <img src="../image/logo.png" alt="Book Club Logo">
        </div>
        <div class="profile-icon">
            <img src="../image/profile.png" alt="Profile Icon">
            <div class="profile-menu">
                <a href="profile.php">Profile</a>
                <a href="log.php">Logout</a>
            </div>
        </div>
    </header>

    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>Admin Dashboard</h2>
            <a href="admin_panel.php">Dashboard</a>
            <a href="manage_users.php">Manage Users</a>
            <a href="add_books.php">Add Books</a>
        </aside>

        <div class="manage-user">
            <h2>Manage Users</h2>

            <!-- Your PHP code for fetching and displaying users will go here -->
            <?php
            
            include('../includes/db.php'); 

            
            $stmt = $conn->prepare("SELECT id, username, email, roles FROM user_reg");
            if ($stmt === false) {
                die('Prepare statement failed: ' . $conn->error);
            }
            $stmt->execute();
            $result = $stmt->get_result();
            $users = [];
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
            $stmt->close();
            ?>


            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($users)): ?>
                        <tr>
                            <td colspan="5">No users found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['id']); ?></td>
                                <td><?php echo htmlspecialchars($user['username']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td><?php echo htmlspecialchars($user['roles']); ?></td>
                                <td>
                                    <?php if ($user['roles'] !== 'admin'): ?>
                                        <form action="admin_panel.php" method="POST" style="display:inline;">
                                            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['id']); ?>">
                                            <button type="submit" name="make_admin">Make Admin</button>
                                        </form>
                                    <?php else: ?>
                                        <span>Admin</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <script src="../assets/js/script.js"></script>
</body>

</html>