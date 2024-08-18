<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books - Book Store</title>
    <link rel="stylesheet" href="../assets/css/book.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>

<body>
    <section>
        <nav>
            <div class="logo">
                <img src="../image/logo.png" alt="Book Store Logo">
            </div>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="book.php">Books</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="log.php">Sign In</a></li>
                <li><a href="signup.php">Sign Up</a></li>
            </ul>
            
        </nav>
    </section>

    <main>
        <div class="Book-menu">
            <?php
            include ("../includes/db.php  "); // Include the database connection file

            // SQL query to fetch books
            $sql = "SELECT * FROM books";
            $result = $conn->query($sql);

            // Check if there are results
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="featured_book_card">';
                    echo '<div class="featurde_book_img">';
                    echo '<img src="../image/' . htmlspecialchars($row['cover_image']) . '" alt="' . htmlspecialchars($row['title']) . '">';
                    echo '</div>';
                    echo '<div class="featurde_book_tag">';
                    echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
                    echo '<p class="writer">' . htmlspecialchars($row['author']) . '</p>';
                    echo '<div class="categories">' . htmlspecialchars($row['genre']) . '</div>';
                    echo '<p class="book_price">$' . htmlspecialchars($row['price']);
                    echo '</p>';
                    echo '<a href="book_details.php?id=' . htmlspecialchars($row['id']) . '" class="f_btn">Learn More</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No books found</p>';
            }

            // Close the connection
            $conn->close();
            ?>
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
