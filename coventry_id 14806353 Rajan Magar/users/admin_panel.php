<?php

include('../includes/db.php'); 
include('../includes/auth_session.php'); 


if (!isset($_SESSION['roles']) || $_SESSION['roles'] !== 'admin') {
    header('Location: ../pages/log.php'); 
    exit();
}


$users = [];
$admin_count = 0;
$error = '';
$success = '';


$stmt = $conn->prepare("SELECT id, username, email, roles FROM user_reg");
if ($stmt === false) {
    die('Prepare statement failed: ' . $conn->error);
}

$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    if ($row['roles'] === 'admin') {
        $admin_count++;
    }
    $users[] = $row;
}

$stmt->close();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['make_admin'])) {
        $user_id = $_POST['user_id'];
        
        
        if ($admin_count >= 1) {
            $error = 'There is already one admin. You cannot make another user admin.';
        } else {
            
            $stmt = $conn->prepare("UPDATE user_reg SET roles = 'admin' WHERE id = ?");
            if ($stmt === false) {
                die('Prepare statement failed: ' . $conn->error);
            }
            $stmt->bind_param('i', $user_id);
            if ($stmt->execute()) {
                $success = 'User has been promoted to admin.';
            } else {
                $error = 'Error updating user role: ' . $stmt->error;
            }
            $stmt->close();
            
            
            $stmt = $conn->prepare("SELECT roles FROM user_reg WHERE roles = 'admin'");
            $stmt->execute();
            $result = $stmt->get_result();
            $admin_count = $result->num_rows;
            $stmt->close();
        }
    }
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Manage Users</title>
    <link rel="stylesheet" href="../assets/css/admin_panel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .user-info {
            border: 1px solid #ddd;
            padding: 20px;
            margin: 10px 0;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .user-info h2 {
            margin-top: 0;
        }
        .user-info .info-item {
            margin-bottom: 10px;
        }
        .user-info .info-item label {
            font-weight: bold;
        }
        .user-info .info-item span {
            margin-left: 10px;
        }
        .profile-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
        .profile-menu a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
        }
        .profile-menu a:hover {
            background-color: #f0f0f0;
        }
        .profile-icon {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="../image/logo.png" alt="Book Club Logo">
        </div>
        <div class="profile-icon" onclick="toggleOption()">
            <img src="../image/profile.png" alt="Profile Icon">
            <div class="profile-menu">
                <a href="profile.php">Profile</a>
                <a href="../includes/logout.php">Logout</a>
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

        <!-- Main Content -->
        <div class="main-content">
            
            <?php if ($error): ?>
                <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <?php if ($success): ?>
                <p class="success-message"><?php echo htmlspecialchars($success); ?></p>
            <?php endif; ?>

            <?php if (empty($users)): ?>
                <p>No users found.</p>
            <?php else: ?>
                <?php foreach ($users as $user): ?>
                    <div class="user-info">
                        <h2>User Information</h2>
                        <div class="info-item">
                            <label>ID:</label>
                            <span><?php echo htmlspecialchars($user['id']); ?></span>
                        </div>
                        <div class="info-item">
                            <label>Username:</label>
                            <span><?php echo htmlspecialchars($user['username']); ?></span>
                        </div>
                        <div class="info-item">
                            <label>Email:</label>
                            <span><?php echo htmlspecialchars($user['email']); ?></span>
                        </div>
                        <div class="info-item">
                            <label>Role:</label>
                            <span><?php echo htmlspecialchars($user['roles']); ?></span>
                        </div>
                        <?php if ($user['roles'] !== 'admin'): ?>
                            <form action="admin_panel.php" method="POST" style="margin-top: 10px;">
                                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['id']); ?>">
                                <button type="submit" name="make_admin">Make Admin</button>
                            </form>
                        <?php else: ?>
                            <span style="color: green;">Admin</span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <<script src="../assets/js/script.js"></script>
</body>
</html>