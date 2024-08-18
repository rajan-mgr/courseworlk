<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Club</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    
    <section>
        <nav>
            <div class="logo">
                <img src="image/logo.png">
            </div>

            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="pages/book.php">Books</a></li>
                <li><a href="pages/about.php">About</a></li>
                <li><a href="pages/log.php">SignIn</a></li>
                <li><a href="pages/signup.php">SignUp</a></li>  
            </ul>

            <div class="social_icon">
                <form action="pages/search.php" method="GET">
                    <input type="text" name="query" placeholder="Search for books..." required>
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </nav>
        

        <div class="main">
            <div class="main_tag">
                <h1>WELCOME TO<br><span>BOOK CLUB</span></h1>
                <p>"That's the thing about books. They let you travel without moving your feet"</p>
             
            </div>

            <div class="main_img">
                <img src="image/bookclub.png">
            </div>
        </div>
    </section>

    <!-- Services -->
    <div class="services">
        <div class="services_box">
            <div class="services_card">
                <i class="fa-solid fa-truck-fast"></i>
                <h3>User Friendly</h3>
                <p>Our website is designed with user experience in mind, making it easy to navigate and find the books you love.</p>
            </div>
    
            <div class="services_card">
                <i class="fa-solid fa-headset"></i>
                <h3>24 x 7 Services</h3>
                <p>We provide round-the-clock customer support to assist you with any inquiries or issues you might have.</p>
            </div>
    
            <div class="services_card">
                <i class="fa-solid fa-tag"></i>
                <h3>Best Deal</h3>
                <p>Enjoy competitive prices and exclusive discounts on a wide range of books, making reading affordable for everyone.</p>
            </div>
    
            <div class="services_card">
                <i class="fa-solid fa-lock"></i>
                <h3>Secure Payment</h3>
                <p>Your transactions are protected with top-notch security measures to ensure a safe and secure shopping experience.</p>
            </div>
        </div>
    </div>
    
    <!-- About -->
    <div class="about">
        <div class="about_image">
            <img src="image/about.png">
        </div>
        <div class="about_tag">
            <h1>About Us</h1>
            <p>
                Welcome to our Book Store, your go-to destination for all things literary. We pride ourselves on offering a wide range of books across various genres, including thrillers, romance, and horror. Our mission is to make reading accessible and enjoyable for everyone. Whether you're a book enthusiast or a casual reader, you'll find something that piques your interest in our collection.
            </p>
            <p>
                At our store, we value customer satisfaction and strive to provide exceptional service. Our team is passionate about books and dedicated to helping you find your next great read. We offer fast delivery, secure payment options, and 24/7 customer support to ensure a seamless shopping experience.
            </p>
            <p>
                Thank you for choosing our Book Store. We look forward to serving you and helping you discover your next favorite book.
            </p>
            <a href="pages/about.php" class="about_btn">Learn More</a>
        </div>
    </div>

    <!-- Featured Books -->
    <div class="featured_boks">
        <h1>Featured Books</h1>
        <div class="featured_book_box">
            <div class="featured_book_card">
                <div class="featurde_book_img">
                    <img src="image/oldmanandthesea.png">
                </div>
                <div class="featurde_book_tag">
                    <h3>The Old Man and The Sea</h3>
                    <p class="writer">Ernest Hemingway</p>
                    <div class="categories">Adventure</div>
                    <p class="book_price">Free<sub><del>$5</del></sub></p>
                   
                    
                </div>               
            </div>

            <div class="featured_book_card">
                <div class="featurde_book_img">
                    <img src="image/HauntingOfHillHouse.png">
                </div>
                <div class="featurde_book_tag">
                    <h3>Haunting of Hill House</h3>
                    <p class="writer">Shirley Jackson</p>
                    <div class="categories">Horror</div>
                    <p class="book_price">Free<sub><del>$10</del></sub></p>
                    
                    
                </div>               
            </div>

            <div class="featured_book_card">
                <div class="featurde_book_img">
                    <img src="image/Outlander.png">
                </div>
                <div class="featurde_book_tag">
                    <h3>Outlander</h3>
                    <p class="writer">Diana Gabaldon</p>
                    <div class="categories">Romance</div>
                    <p class="book_price">Free<sub><del>$10</del></sub></p>
                    
                </div>               
            </div>

            <div class="featured_book_card">
                <div class="featurde_book_img">
                    <img src="image/timetraveler.png">
                </div>
                <div class="featurde_book_tag">
                    <h3>The Time Traveler's Wife</h3>
                    <p class="writer">Audrey Niffenegger</p>
                    <div class="categories">Action</div>
                    <p class="book_price">Free<sub><del>$6</del></sub></p>
                   
                </div>               
            </div>

            <div class="featured_book_card">
                <div class="featurde_book_img">
                    <img src="image/Theroad.png">
                </div>
                <div class="featurde_book_tag">
                    <h3>The Road</h3>
                    <p class="writer">Cormac McCarthy</p>
                    <div class="categories">Adventure</div>
                    <p class="book_price">Free<sub><del>$20</del></sub></p>
                  
                </div>               
            </div>

            <div class="featured_book_card">
                <div class="featurde_book_img">
                    <img src="image/thenightcircus.png">
                </div>
                <div class="featurde_book_tag">
                    <h3>The Night Circus</h3>
                    <p class="writer">Erin Morgenstern</p>
                    <div class="categories">Romance</div>
                    <p class="book_price">Free<sub><del>$10</del></sub></p>
                    
                </div>               
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer_main">
            <div class="tag">
                <img src="image/logo.png">
                <p>"Think before you speak. Read before you think." – Fran Lebowitz</p>
            </div>

            <div class="tag">
                <h1>Quick Link</h1>
                <a href="index.html">Home</a>
                <a href="pages/about.php">About</a>
                <a href="pages/book.php">Featured</a>
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
        <div class="footer_bottom">
            <p>&copy; 2024 Book Club. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
