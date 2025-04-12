<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Cafe</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container navbar-container">
            <input type="checkbox" id="nav-toggle">
            <div class="hamburger-lines" id="hamburger">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </div>
            <ul class="menu-items">
                <li><a href="home.php">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="registration.php">Reservation</a></li>
                <li><a href="menu.html">Menu</a></li>
                <li><a href="promotion.html">Promotion</a></li>
                <li><a href="events.html">Special events</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <h1 class="logo">The<span>Gallery Cafe </span></h1> </br> 
            <a href="admin.php" class="btn-primary">Admin & Staff Login</a>
        </div>

        
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-container">
            <h1>Welcome to The<span>Gallery Cafe</span></h1>
            <p>Delicious & Healthy Meals for a Better Lifestyle</p>
            <a href="registration.php" class="btn-primary">Sign In</a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container about-container">
            <div class="about-text">
                <h2>About Us</h2>
                <p>The Gallery Cafe offers a unique blend of Sri Lankan, Chinese, and Italian cuisine, providing a cozy atmosphere where art and flavors meet for an unforgettable dining experience.</p>
                <a href="menu.html" class="btn-primary">See Our Menu</a>
            </div>
            <div class="about-img">
                <img src="about us.png" alt="About Us">
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section id="food" class="food-category">
        <h2>Our Food Categories</h2>
        <div class="food-container container">
            <div class="food-card">
                <img src="italian.jpg" alt="Fruits">
                <div class="card-content">
                    <h3>Italian</h3>
                    <a href="menu.html" class="btn-primary">Learn More</a>
                </div>
            </div>
            <div class="food-card">
                <img src="chhinese.jpg" alt="Vegetables">
                <div class="card-content">
                    <h3>Chinese</h3>
                    <a href="menu.html" class="btn-primary">Learn More</a>
                </div>
            </div>
            <div class="food-card">
                <img src="./images/rice combo.png" alt="Grains">
                <div class="card-content">
                    <h3>Sri lankan</h3>
                    <a href="menu.html" class="btn-primary">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container contact-container">
            <div class="contact-text">
                <h2>Contact Us</h2>
                <p>We'd love to hear from you! Drop us a message below.</p>
                <form id="contactForm">
                    <input type="text" placeholder="Your Name" required>
                    <input type="email" placeholder="Your Email" required>
                    <textarea rows="5" placeholder="Your Message" required></textarea>
                    <button type="submit" class="btn-primary">Submit</button>
                </form>
            </div>
            <div class="contact-img">
                <img src="https://i.postimg.cc/1XvYM67V/restraunt2.jpg" alt="Contact">
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        
    © The Gallery Cafe. All rights reserved.
                
    </footer>

    <script src="script.js"></script>
</body>
</html>
