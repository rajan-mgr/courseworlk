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
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileExtension, $allowedExtensions)) {
            // Sanitize the title to create a valid filename
            $sanitizedTitle = preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($title));
            $newFileName = $sanitizedTitle . '.' . $fileExtension;
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
