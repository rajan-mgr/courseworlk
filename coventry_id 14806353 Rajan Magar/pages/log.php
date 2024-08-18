<?php

include('../includes/db.php'); 
include('../includes/auth_session.php'); 


$error = '';
$username = '';
$password = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    
    if (empty($username) || empty($password)) {
        $error = 'Username and password are required.';
    } else {
        
        $stmt = $conn->prepare("SELECT id, password, roles FROM user_reg WHERE Username = ?");
        if ($stmt === false) {
            $error = 'Prepare statement failed: ' . $conn->error;
        } else {
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $hashedPassword, $roles);
            
            if ($stmt->fetch()) {
                
                if (password_verify($password, $hashedPassword)) {
                    
                    session_start(); 
                    $_SESSION['user_id'] = $id; 
                    $_SESSION['roles'] = $roles; 
                    $_SESSION['username'] = $username;
                    
                    
                    if ($roles === 'admin') {
                        header('Location: ../users/admin_panel.php'); 
                    } elseif ($roles === 'user') {
                        header('Location: ../users/profile.php'); 
                    } else {
                        $error = 'Invalid role assigned to the user.';
                    }
                    exit();
                } else {
                    $error = 'Invalid username or password.';
                }
            } else {
                $error = 'Invalid username or password.';
            }

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
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/log.css">
</head>
<body>
    <section class="login-section">
        <div class="form-container login-container">
            <form action="log.php" method="POST">
                <h2>Login</h2>
                <?php if (!empty($error)): ?>
                    <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
                <?php endif; ?>
                <input type="text" placeholder="Username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                <input type="password" placeholder="Password" name="password" required>
                <button type="submit">Login</button>
                <p>Don't have an account? <a href="signup.php" class="toggle-form">Sign Up</a></p>
            </form>
        </div>
    </section>
    <script src="../assets/js/log.js"></script>
</body>
</html>
