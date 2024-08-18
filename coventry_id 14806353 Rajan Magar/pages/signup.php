<?php



include('../includes/db.php');


$username = $email = $error = "";
$terms = false;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirmPassword = trim($_POST["confirm-password"]);
    $terms = isset($_POST["terms"]) && $_POST["terms"] === 'on';

    
    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        $error = "All fields are required.";
    } elseif ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    } elseif (!$terms) {
        $error = "You must agree to the terms and conditions.";
    } else {
        
        $stmt = $conn->prepare("SELECT id FROM user_reg WHERE Username = ? OR email = ?");
        if ($stmt === false) {
            $error = "Prepare statement failed: " . $conn->error;
        } else {
            $stmt->bind_param("ss", $username, $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $error = "Username or email already exists.";
            } else {
                
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $role = 'user'; 
                $stmt = $conn->prepare("INSERT INTO user_reg (Username, email, password, roles) VALUES (?, ?, ?, ?)");
                if ($stmt === false) {
                    $error = "Prepare statement failed: " . $conn->error;
                } else {
                    $stmt->bind_param("ssss", $username, $email, $passwordHash, $role);

                    if ($stmt->execute()) {
                        header("Location: log.php"); 
                        exit();
                    } else {
                        $error = "An error occurred while registering. Please try again.";
                    }
                }
            }

            $stmt->close();
        }
    }

    $conn->close();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../assets/css/log.css">
</head>
<body>
    <section class="signup-section">
        <div class="form-container signup-container">
            <form action="signup.php" method="POST">
                <h2>Sign Up</h2>
                <input type="text" placeholder="Username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                <input type="email" placeholder="Email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                <input type="password" placeholder="Password" name="password" required>
                <input type="password" placeholder="Confirm Password" name="confirm-password" required>
                <div class="terms">
                    <input type="checkbox" name="terms" <?php if ($terms) echo 'checked'; ?> required>
                    <label for="terms">I agree to the <a href="#">Terms and Conditions</a></label>
                </div>
                <?php if (!empty($error)): ?>
                    <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
                <?php endif; ?>
                <button type="submit">Sign Up</button>
                <p>Already have an account? <a href="log.php" class="toggle-form">Login</a></p>
            </form>
        </div>
    </section>
    <script src="../assets/js/log.js"></script>
</body>
</html>
