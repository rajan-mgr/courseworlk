<?php
// Include database connection file and session management
include('../includes/db.php');
include('../includes/auth_session.php'); // Ensure user is logged in

// Check if user_id is set in the session
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if user_id is not set
    header("Location: ../pages/login.php"); // Adjust the path as needed
    exit();
}

// Initialize variables
$user_id = $_SESSION['user_id'];

// Fetch user details
$stmt = $conn->prepare("SELECT username, email FROM user_reg WHERE id = ?");
if ($stmt === false) {
    die('Prepare statement failed: ' . $conn->error);
}
$stmt->bind_param('i', $user_id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($username, $email);
$stmt->fetch();
$stmt->close();

// Fetch all books (adjust if needed)
$stmt = $conn->prepare("SELECT title, author, genre, price, description, cover_image FROM books");
if ($stmt === false) {
    die('Prepare statement failed: ' . $conn->error);
}
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../assets/css/profile.css">
</head>
<body>
    <section class="profile-section">
        <div class="profile-container">
            <h1>Profile</h1>
            <div class="profile-info">
                <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
                <p>Email: <?php echo htmlspecialchars($email); ?></p>
            </div>

            <div class="books-section">
                <h2>Books</h2>
                <?php if ($result->num_rows > 0): ?>
                    <ul>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <li>
                                <img src="../uploads/<?php echo htmlspecialchars($row['cover_image']); ?>" alt="Cover Image" class="book-cover"><br>
                                <strong><?php echo htmlspecialchars($row['title']); ?></strong><br>
                                Author: <?php echo htmlspecialchars($row['author']); ?><br>
                                Genre: <?php echo htmlspecialchars($row['genre']); ?><br>
                                Price: $<?php echo htmlspecialchars($row['price']); ?><br>
                                Description: <?php echo htmlspecialchars($row['description']); ?><br>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <p>No books available.</p>
                <?php endif; ?>
            </div>

            <div class="logout-section">
                <a href="../includes/logout.php" class="logout-button">Log Out</a>
            </div>
        </div>
    </section>
    <script src="../assets/js/profile.js"></script>
</body>
</html>
