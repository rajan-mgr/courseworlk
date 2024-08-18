<?php
include("../includes/db.php"); // Include the database connection file

// Check if the 'id' parameter is present in the URL
if (isset($_GET['id'])) {
    $book_id = intval($_GET['id']);
    
    // Prepare and execute the SQL query to fetch book details
    $sql = "SELECT * FROM books WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the book exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo htmlspecialchars($row['title']); ?> - Book Details</title>
            <link rel="stylesheet" href="../assets/css/book.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer">
        </head>
        <body>
           
            <main>
                <div class="book-details">
                    <h1><?php echo htmlspecialchars($row['title']); ?></h1>
                    <div class="book-image">
                        <img src="../image/<?php echo htmlspecialchars($row['cover_image']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                    </div>
                    <div class="book-info">
                        <p><strong>Author:</strong> <?php echo htmlspecialchars($row['author']); ?></p>
                        <p><strong>Genre:</strong> <?php echo htmlspecialchars($row['genre']); ?></p>
                        <p><strong>Price:</strong> $<?php echo htmlspecialchars($row['price']); ?></p>
                        <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
                    </div>
                </div>
            </main>
            <footer>
                <div class="footer_main">
                    <div class="tag">
                        <img src="../image/logo.png" alt="Book Store Logo">
                        <p>"Think before you speak. Read before you think." – Fran Lebowitz</p>
                    </div>
                    <div class="tag">
                        <h1>Quick Links</h1>
                        <a href="../index.php">Home</a>
                        <a href="about.php">About</a>
                        <a href="book.php">Featured</a>
                    </div>
                    <div class="tag">
                        <h1>Contact Info</h1>
                        <a href="#"><i class="fa-solid fa-phone"></i>+977 9749355567</a>
                        <a href="#"><i class="fa-solid fa-phone"></i>+977 9861616483</a>
                        <a href="#"><i class="fa-solid fa-envelope"></i>magarrajan605@gmail.com</a>
                    </div>
                    <div class="tag">
                        <h1>Follow Us</h1>
                        <div class="social_link">
                            <a href="https://www.facebook.com/rajan.magar.5076798/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="https://www.instagram.com/magarrrajan/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <p class="end">Design By <span><i class="fa-solid fa-face-grin"></i> Rajan Magar</span></p>
            </footer>
        </body>
        </html>
        <?php
    } else {
        echo '<p>Book not found</p>';
    }

    $stmt->close();
} else {
    echo '<p>No book ID provided</p>';
}

$conn->close();
?>
