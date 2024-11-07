<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Online Bookstore</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<link rel="stylesheet" href="userMainPage.css">
</head>
<body>

<div class="top-header bg-light py-2">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <small class="text-dark">Contact: +1 234 567 890 | Email: info@bookstore.com</small>
            </div>
            <div class="col-md-6 text-end">
                <a href="#" class="me-3"><i class="bi bi-facebook"></i></a>
                <a href="#" class="me-3"><i class="bi bi-twitter"></i></a>
                <a href="#" class="me-3"><i class="bi bi-linkedin"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
            </div>
        </div>
    </div>
</div>

<header class="main-header py-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3">
                <h1 class="logo">BookStore</h1>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control rounded-pill" placeholder="Search books...">
                    <button class="btn btn-primary rounded-pill ms-2">Search</button>
                </div>
            </div>
            <div class="col-md-3 text-end">
                <div class="user-profile">
                    <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d" alt="User" class="rounded-circle border-purple">
                    <div class="dropdown d-inline-block">
                        <button class="btn btn-link dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown">
                            Account
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Login</a></li>
                            <li><a class="dropdown-item" href="#">Register</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<nav class="navbar navbar-expand-lg navbar-dark bg-navy">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Books</a></li>
                <li class="nav-item"><a class="nav-link" href="#">New Release</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
            </ul>
        </div>
    </div>
</nav>

<section class="banner py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="banner-content gradient-box p-4">
                    <h2>Discover Your Next Favorite Book</h2>
                    <p>Explore our vast collection of books across all genres</p>
                    <button class="btn btn-primary rounded-pill">Read More</button>
                </div>
            </div>
            <div class="col-md-6">
                <div id="bookCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f" class="d-block w-100" alt="Book 1">
                        </div>
                        <div class="carousel-item">
                            <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794" class="d-block w-100" alt="Book 2">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#bookCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#bookCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="categories py-5">
    <div class="container">
        <h3 class="text-center mb-4">Book Categories</h3>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1516979187457-637abb4f9353" alt="Fiction" class="img-fluid">
                    <h4 class="mt-3">Fiction</h4>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1457369804613-52c61a468e7d" alt="Non-Fiction" class="img-fluid">
                    <h4 class="mt-3">Non-Fiction</h4>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8" alt="Children" class="img-fluid">
                    <h4 class="mt-3">Children</h4>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button class="btn btn-outline-primary">View All Categories</button>
        </div>
    </div>
</section>

<section class="featured-book gradient-bg py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f" alt="Featured Book" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h3>Featured Book of the Month</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <button class="btn btn-primary">View More</button>
            </div>
        </div>
    </div>
</section>

<section class="new-releases py-5">
    <div class="container">
        <h3 class="text-center mb-4">New Releases</h3>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="book-card">
                    <img src="https://images.unsplash.com/photo-1543002588-bfa74002ed7e" alt="New Book 1" class="img-fluid">
                    <div class="book-info">
                        <h5>Book Title 1</h5>
                        <div class="rating">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Repeat for other new releases -->
        </div>
        <div class="text-center">
            <a href="#" class="btn btn-link">View All Products</a>
        </div>
    </div>
</section>

<section class="coming-soon bg-light py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f" alt="Coming Soon" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h3>Coming Soon</h3>
                <p>Stay tuned for exciting new releases coming to our bookstore!</p>
            </div>
        </div>
    </div>
</section>

<section class="latest-articles py-5">
    <div class="container">
        <h3 class="text-center mb-4">Latest Articles</h3>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="article-card">
                    <img src="https://images.unsplash.com/photo-1532012197267-da84d127e765" alt="Article 1" class="img-fluid">
                    <div class="article-info p-3">
                        <small class="text-muted">Jan 1, 2024</small>
                        <h5>Article Title 1</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                    </div>
                </div>
            </div>
            <!-- Repeat for other articles -->
        </div>
    </div>
</section>

<footer class="bg-navy text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h4>About BookStore</h4>
                <p>Your one-stop destination for all types of books.</p>
            </div>
            <div class="col-md-4 mb-4">
                <h4>Quick Links</h4>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white">Privacy Policy</a></li>
                    <li><a href="#" class="text-white">Terms & Conditions</a></li>
                    <li><a href="#" class="text-white">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-4">
                <h4>Connect With Us</h4>
                <div class="social-icons">
                    <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>