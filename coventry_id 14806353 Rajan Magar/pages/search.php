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


$query = isset($_GET['query']) ? trim($conn->real_escape_string($_GET['query'])) : '';


$sql = "SELECT * FROM books WHERE title LIKE ? OR author LIKE ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}


$searchTerm = "%$query%";
$stmt->bind_param("ss", $searchTerm, $searchTerm);


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
    <title>Search Results</title>
    <link rel="stylesheet" href="assets/css/style.css"> <!-- Main stylesheet -->
    <link rel="stylesheet" href="assets/css/search.css"> <!-- Search results stylesheet -->
    <link rel="stylesheet" href="https:
</head>
<body>

<div class="search-results">
    <h1>Search Results for "<?php echo htmlspecialchars($query); ?>"</h1>

    <?php if (count($books) > 0): ?>
        <?php foreach ($books as $book): ?>
            <div class="book-card">
                <?php if (!empty($book['cover_image'])): ?>
                    <img src="../uploads/?php echo htmlspecialchars($book['cover_image']); ?>" alt="Book Cover">
                <?php else: ?>
                    <img src="image/default-book-cover.png" alt="Default Book Cover">
                <?php endif; ?>
                <div>
                    <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                    <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
                    <p><strong>Genre:</strong> <?php echo htmlspecialchars($book['genre']); ?></p>
                    <p class="price">$<?php echo htmlspecialchars($book['price']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="no-results">No books found matching your query.</p>
    <?php endif; ?>
</div>

</body>
</html>
