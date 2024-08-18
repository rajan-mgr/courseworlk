<?php

include('../includes/db.php'); 
include('../includes/auth_session.php'); 

// Check if the user is an admin
if (!isset($_SESSION['roles']) || $_SESSION['roles'] !== 'admin') {
    header('Location: ../pages/log.php'); 
    exit();
}

$successMessage = '';
$errorMessage = '';

// Fetch distinct genres from the database
$genres = [];
$genreQuery = "SELECT DISTINCT genre FROM books WHERE genre IS NOT NULL AND genre != ''";
$genreResult = $conn->query($genreQuery);

if ($genreResult) {
    while ($row = $genreResult->fetch_assoc()) {
        $genres[] = $row['genre'];
    }
} else {
    $errorMessage = 'Failed to retrieve genres: ' . $conn->error;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $author = trim($_POST['author']);
    $title = trim($_POST['title']);
    $genre = trim($_POST['genre']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);

    $coverImagePath = null; 

    // Handle file upload
    if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['cover_image']['tmp_name'];
        $fileName = $_FILES['cover_image']['name'];
        $fileNameCmps = explode('.', $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileExtension, $allowedExtensions)) {
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $uploadFileDir = '../uploads/';
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $coverImagePath = $newFileName;
            } else {
                $errorMessage = 'There was an error uploading the image.';
            }
        } else {
            $errorMessage = 'Invalid file type. Only jpg, jpeg, png, and gif are allowed.';
        }
    }

    // Insert book details into the database
    if (empty($errorMessage)) {
        $stmt = $conn->prepare("INSERT INTO books (author, title, genre, price, description, cover_image) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            $errorMessage = 'Prepare statement failed: ' . $conn->error;
        } else {
            $stmt->bind_param('ssssss', $author, $title, $genre, $price, $description, $coverImagePath);
            if ($stmt->execute()) {
                $successMessage = 'Book added successfully!';
            } else {
                $errorMessage = 'Failed to add book: ' . $stmt->error;
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
    <title>Add Book</title>
    <link rel="stylesheet" href="../assets/css/add_books.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="../image/logo.png" alt="Book Club Logo">
        </div>
        <div class="profile-icon">
            <img src="../image/profile.png" alt="Profile Icon">
            <div class="profile-menu">
                <a href="admin_profile.php">Profile</a>
                <a href="../includes/logout.php">Logout</a>
            </div>
        </div>
    </header>

    <div class="container">
        <aside class="sidebar">
            <h2>Admin Dashboard</h2>
            <a href="admin_panel.php">Dashboard</a>
            <a href="manage_users.php">Manage Users</a>
            <a href="add_books.php">Add Books</a>
        </aside>

        <div class="main-content">
            <h1>Add New Book</h1>
            
            <?php if (!empty($successMessage)): ?>
                <p class="success-message"><?php echo htmlspecialchars($successMessage); ?></p>
            <?php endif; ?>

            <?php if (!empty($errorMessage)): ?>
                <p class="error-message"><?php echo htmlspecialchars($errorMessage); ?></p>
            <?php endif; ?>

            <form action="add_books.php" method="POST" enctype="multipart/form-data">
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" required>

                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>

                <label for="genre">Genre:</label>
                <select id="genre" name="genre" required>
                    <option value="">Select Genre</option>
                    <?php foreach ($genres as $genre): ?>
                        <option value="<?php echo htmlspecialchars($genre); ?>">
                            <?php echo htmlspecialchars($genre); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="price">Price:</label>
                <input type="text" id="price" name="price" required>

                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>

                <label for="cover_image">Cover Image:</label>
                <input type="file" id="cover_image" name="cover_image" accept="image/*">

                <button type="submit">Add Book</button>
            </form>
        </div>
    </div>
</body>
</html>
