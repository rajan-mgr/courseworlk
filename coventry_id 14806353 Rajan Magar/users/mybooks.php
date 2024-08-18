<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "project"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


session_start();
$user_id = $_SESSION['user_id']; 


$sql = "
    SELECT b.id, b.title, b.author, b.genre, b.price, b.cover_image
    FROM books b
    INNER JOIN user_books ub ON b.id = ub.book_id
    WHERE ub.user_id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$books = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Books - Book Club</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/profile.css">
    <link rel="stylesheet" href="https:
</head>
<body>

    <!-- Header with profile icon -->
    <header>
        <div class="logo">
            <img src="../image/logo.png" alt="Book Club Logo">
        </div>
        <div class="profile-icon">
            <img src="../image/profile.png" alt="Profile Icon">
            <div class="profile-menu">
                <a href="profile.html">Profile</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </header>

    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>Navigation</h2>
            <a href="profile.html">Home</a>
            <a href="mybook.php">My Books</a>
            <a href="about.php">About</a>
        </aside>

        <!-- Main content -->
        <main class="main-content">
            <h1>My Books</h1>

            <?php if (count($books) > 0): ?>
                <div class="book-list">
                    <?php foreach ($books as $book): ?>
                        <div class="book-card">
                            <img src="../image/<?php echo htmlspecialchars($book['cover_image']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>">
                            <div class="book-info">
                                <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                                <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
                                <p><strong>Genre:</strong> <?php echo htmlspecialchars($book['genre']); ?></p>
                                <p><strong>Price:</strong> <?php echo htmlspecialchars($book['price']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No books found.</p>
            <?php endif; ?>
        </main>
    </div>

</body>
</html>
