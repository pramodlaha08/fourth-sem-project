<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I Found - Lost & Found Management System</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #4980d3 100%);
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .status-lost {
            background: linear-gradient(135deg, #ff6b6b, #ee5a5a);
        }

        .status-found {
            background: linear-gradient(135deg, #51cf66, #40c057);
        }

        .status-claimed {
            background: linear-gradient(135deg, #f05f33, #228be6);
        }

        .modal {
            backdrop-filter: blur(5px);
        }

        .nav-link:hover {
            color: #2da1e4;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #54c1f3 100%);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5a6fd6 0%, #4bb5f3 100%);
        }

        .category-card:hover {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.05);
        }

        .category-card.active {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.1);
        }

        .tab-btn.active {
            background: linear-gradient(135deg, #667eea 0%, #27b6f8 100%);
            color: white;
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        /* Star rating styles */
        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            cursor: pointer;
            font-size: 1.5rem;
            color: #d1d5db;
            transition: color 0.2s;
        }

        .star-rating label:hover,
        .star-rating label:hover~label,
        .star-rating input:checked~label {
            color: #fbbf24;
        }

        /* Input error styles */
        .input-error {
            border-color: #ef4444 !important;
        }

        .error-message {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }
    </style>
    <!--  -->
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-md fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="#" class="flex items-center space-x-2">
                        <i class="fas fa-search-location text-3xl text-purple-600"></i>
                        <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">I Found</span>
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.php" class="nav-link text-gray-700 font-medium transition">Home</a>
                    <a href="#items" class="nav-link text-gray-700 font-medium transition">Browse Items</a>
                    <a href="#how-it-works" class="nav-link text-gray-700 font-medium transition">How It Works</a>
                    <a href="contact.php" class="nav-link text-gray-700 font-medium transition">Contact</a>
                </div>

                <div id="authButtons" class="flex items-center space-x-4">
                    <button onclick="openModal('loginModal')" class="text-gray-700 font-medium hover:text-purple-600 transition">Login</button>
                    <button onclick="openModal('registerModal')" class="btn-primary text-white px-5 py-2 rounded-full font-medium transition transform hover:scale-105">Sign Up</button>
                </div>

                <!-- Mobile menu button -->
                <button class="md:hidden" onclick="toggleMobileMenu()">
                    <i class="fas fa-bars text-2xl text-gray-700"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden bg-white border-t">
            <div class="px-4 py-3 space-y-3">
                <a href="#home" class="block text-gray-700 font-medium">Home</a>
                <a href="#items" class="block text-gray-700 font-medium">Browse Items</a>
                <a href="#how-it-works" class="block text-gray-700 font-medium">How It Works</a>
                <a href="contact.php" class="block text-gray-700 font-medium">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-gradient pt-24 pb-16 md:pt-32 md:pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="md:w-1/2 text-white mb-10 md:mb-0">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                        Lost Something?<br>
                        <span class="text-white-300">We'll Help You Find It!</span>
                    </h1>
                    <p class="text-lg md:text-xl opacity-90 mb-8">
                        Connect with people who found your lost items or help others find theirs. Our community-driven platform makes reuniting lost items with their owners simple and fast.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button onclick="openModal('reportModal')" class="bg-white text-purple-600 px-8 py-3 rounded-full font-semibold hover:bg-yellow-300 hover:text-purple-700 transition transform hover:scale-105 flex items-center justify-center">
                            <i class="fas fa-flag mr-2"></i> Report Lost Item
                        </button>
                        <button onclick="openModal('foundModal')" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-purple-600 transition transform hover:scale-105 flex items-center justify-center">
                            <i class="fas fa-hand-holding-heart mr-2"></i> Report Found Item
                        </button>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <div class="relative animate-float">
                        <div class="w-72 h-72 md:w-96 md:h-96 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-search-location text-9xl md:text-[150px] text-white/80"></i>
                        </div>
                        <div class="absolute -top-4 -right-4 bg-yellow-400 text-purple-700 px-4 py-2 rounded-full font-bold shadow-lg">
                            <i class="fas fa-check-circle mr-1"></i> 234 Items Found!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Section -->
    <section class="py-8 -mt-8 relative z-10">
        <div class="max-w-4xl mx-auto px-4">
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="text" id="searchInput" placeholder="Search for lost or found items..."
                                class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none">
                        </div>
                    </div>
                    <select id="categoryFilter" class="px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none">
                        <option value="">All Categories</option>
                        <option value="electronics">Electronics</option>
                        <option value="documents">Documents</option>
                        <option value="accessories">Accessories</option>
                        <option value="bags">Bags</option>
                        <option value="keys">Keys</option>
                        <option value="pets">Pets</option>
                        <option value="other">Other</option>
                    </select>
                    <button onclick="searchItems()" class="btn-primary text-white px-8 py-3 rounded-xl font-semibold transition transform hover:scale-105">
                        Search
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="text-center p-6">
                    <div class="text-4xl md:text-5xl font-bold text-purple-600 mb-2">456</div>
                    <div class="text-gray-600">Items Reported</div>
                </div>
                <div class="text-center p-6">
                    <div class="text-4xl md:text-5xl font-bold text-green-500 mb-2">892</div>
                    <div class="text-gray-600">Items Returned</div>
                </div>
                <div class="text-center p-6">
                    <div class="text-4xl md:text-5xl font-bold text-blue-500 mb-2">234</div>
                    <div class="text-gray-600">Active Users</div>
                </div>
                <div class="text-center p-6">
                    <div class="text-4xl md:text-5xl font-bold text-yellow-500 mb-2">78%</div>
                    <div class="text-gray-600">Success Rate</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">Browse by Category</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4">
                <div class="category-card border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer transition" onclick="filterByCategory('electronics')">
                    <i class="fas fa-mobile-alt text-3xl text-purple-600 mb-2"></i>
                    <p class="font-medium text-gray-700">Electronics</p>
                </div>
                <div class="category-card border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer transition" onclick="filterByCategory('documents')">
                    <i class="fas fa-id-card text-3xl text-blue-600 mb-2"></i>
                    <p class="font-medium text-gray-700">Documents</p>
                </div>
                <div class="category-card border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer transition" onclick="filterByCategory('accessories')">
                    <i class="fas fa-glasses text-3xl text-pink-600 mb-2"></i>
                    <p class="font-medium text-gray-700">Accessories</p>
                </div>
                <div class="category-card border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer transition" onclick="filterByCategory('bags')">
                    <i class="fas fa-shopping-bag text-3xl text-green-600 mb-2"></i>
                    <p class="font-medium text-gray-700">Bags</p>
                </div>
                <div class="category-card border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer transition" onclick="filterByCategory('keys')">
                    <i class="fas fa-key text-3xl text-yellow-600 mb-2"></i>
                    <p class="font-medium text-gray-700">Keys</p>
                </div>
                <div class="category-card border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer transition" onclick="filterByCategory('pets')">
                    <i class="fas fa-paw text-3xl text-orange-600 mb-2"></i>
                    <p class="font-medium text-gray-700">Pets</p>
                </div>
                <div class="category-card border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer transition" onclick="filterByCategory('other')">
                    <i class="fas fa-box text-3xl text-gray-600 mb-2"></i>
                    <p class="font-medium text-gray-700">Other</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Items Section -->
    <section id="items" class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center mb-10">
                <h2 class="text-3xl font-bold text-gray-800 mb-4 md:mb-0">Recent Items</h2>
                <div class="flex gap-2">
                    <button onclick="filterItems('all')" class="tab-btn active px-6 py-2 rounded-full font-medium transition">All</button>
                    <button onclick="filterItems('lost')" class="tab-btn bg-gray-200 text-gray-700 px-6 py-2 rounded-full font-medium transition hover:bg-gray-300">Lost</button>
                    <button onclick="filterItems('found')" class="tab-btn bg-gray-200 text-gray-700 px-6 py-2 rounded-full font-medium transition hover:bg-gray-300">Found</button>
                </div>
            </div>

            <div id="itemsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <!-- Items will be dynamically inserted here -->
            </div>

            <div class="text-center mt-10">
                <button id="loadMoreBtn" onclick="loadMoreItems()" class="btn-primary text-white px-8 py-3 rounded-full font-semibold transition transform hover:scale-105" style="display: none;">
                    <i class="fas fa-chevron-down mr-2"></i>Load More Items
                </button>
                <button id="showLessBtn" onclick="showLessItems()" class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-full font-semibold transition transform hover:scale-105" style="display: none;">
                    <i class="fas fa-chevron-up mr-2"></i>Show Less
                </button>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-4">How It Works</h2>
            <p class="text-gray-600 text-center mb-12 max-w-2xl mx-auto">Our simple 4-step process makes it easy to report and find lost items</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user-plus text-3xl text-purple-600"></i>
                    </div>
                    <div class="w-8 h-8 bg-purple-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 font-bold">1</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Create Account</h3>
                    <p class="text-gray-600">Sign up for free and join our community</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-file-alt text-3xl text-blue-600"></i>
                    </div>
                    <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 font-bold">2</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Report Item</h3>
                    <p class="text-gray-600">Submit details about your lost or found item</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-search text-3xl text-green-600"></i>
                    </div>
                    <div class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 font-bold">3</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Match & Connect</h3>
                    <p class="text-gray-600">Our system matches items and connects users</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-handshake text-3xl text-yellow-600"></i>
                    </div>
                    <div class="w-8 h-8 bg-yellow-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 font-bold">4</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Reunite</h3>
                    <p class="text-gray-600">Arrange pickup and get your item back!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section - UPDATED WITH REVIEW SUBMISSION -->
    <section id="testimonials" class="py-16 hero-gradient">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-white mb-4">What Our Users Say</h2>
            <p class="text-white/80 text-center mb-12 max-w-2xl mx-auto">Share your experience with our community</p>

            <!-- Testimonials Grid -->
            <div id="testimonialsGrid" class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <!-- Default testimonials -->
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-purple-600"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-800">Kristina</h4>
                            <div class="text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600">"I lost my wallet at the mall and someone found it and posted here. Got it back within 2 days! Amazing platform!"</p>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-800">Sisham</h4>
                            <div class="text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600">"Found someone's laptop at the park. Posted it here and the owner contacted me the same day. Feels great to help!"</p>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-green-600"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-800">Barsha</h4>
                            <div class="text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600">"My cat went missing and I was devastated. Posted here and a kind neighbor had found her. Thank you I Found!"</p>
                </div>
            </div>

            <!-- User Reviews Container (dynamically added reviews will appear here) -->
            <div id="userReviewsGrid" class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <!-- User submitted reviews will be inserted here -->
            </div>

            <!-- Add Review Form -->
            <div class="max-w-2xl mx-auto">
                <div class="bg-white rounded-2xl p-8 shadow-lg">
                    <h3 class="text-xl font-bold text-gray-800 mb-6 text-center">
                        <i class="fas fa-comment-dots text-purple-600 mr-2"></i>Share Your Experience
                    </h3>
                    <form id="reviewForm" onsubmit="submitReview(event)" novalidate>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Your Name <span class="text-red-500">*</span></label>
                                <input type="text" id="reviewName" placeholder="Enter your name"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none"
                                    required pattern="^[A-Za-z\s]+$" title="Name should contain only alphabets"
                                    oninput="validateReviewName(this)">
                                <p class="text-xs text-gray-500 mt-1">Only alphabets and spaces allowed</p>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Your Email <span class="text-red-500">*</span></label>
                                <input type="email" id="reviewEmail" placeholder="Enter your email"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Your Rating <span class="text-red-500">*</span></label>
                            <div class="star-rating">
                                <input type="radio" id="star5" name="rating" value="5" required>
                                <label for="star5" title="5 stars"><i class="fas fa-star"></i></label>
                                <input type="radio" id="star4" name="rating" value="4">
                                <label for="star4" title="4 stars"><i class="fas fa-star"></i></label>
                                <input type="radio" id="star3" name="rating" value="3">
                                <label for="star3" title="3 stars"><i class="fas fa-star"></i></label>
                                <input type="radio" id="star2" name="rating" value="2">
                                <label for="star2" title="2 stars"><i class="fas fa-star"></i></label>
                                <input type="radio" id="star1" name="rating" value="1">
                                <label for="star1" title="1 star"><i class="fas fa-star"></i></label>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2">Your Review <span class="text-red-500">*</span></label>
                            <textarea id="reviewText" rows="4" placeholder="Share your experience with I Found..."
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none resize-none"
                                required minlength="20" maxlength="500"></textarea>
                            <p class="text-xs text-gray-500 mt-1">Minimum 20 characters, maximum 500 characters</p>
                        </div>
                        <button type="submit" class="btn-primary text-white w-full py-3 rounded-xl font-semibold transition transform hover:scale-105">
                            <i class="fas fa-paper-plane mr-2"></i>Submit Review
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-search-location text-3xl text-purple-400"></i>
                        <span class="text-2xl font-bold">I Found</span>
                    </div>
                    <p class="text-gray-400">Helping people reunite with their lost belongings since 2026.</p>
                    <div class="flex space-x-4 mt-4">
                        <a target="_blank" href="https://www.facebook.com/share/1DJKYkUuh3/" class="text-gray-400 hover:text-purple-400 transition"><i class="fab fa-facebook text-xl"></i></a>
                        <a target="_blank" href="https://x.com/" class="text-gray-400 hover:text-purple-400 transition"><i class="fab fa-twitter text-xl"></i></a>
                        <a target="_blank" href="https://www.instagram.com/soni_yathapa18" class="text-gray-400 hover:text-purple-400 transition"><i class="fab fa-instagram text-xl"></i></a>
                        <a target="_blank" href="https://www.linkedin.com/feed/" class="text-gray-400 hover:text-purple-400 transition"><i class="fab fa-linkedin text-xl"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="font-semibold text-lg mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="" class="text-gray-400 hover:text-white transition">Home</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Browse Items</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Report Lost</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Report Found</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-lg mb-4">Support</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">FAQ</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Contact Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Terms of Service</a></li>
                    </ul>

                </div>
                <div class="border-t border-gray-800 pt-8 text-center text-gray-400">
                    <p>&copy; 2026 I Found. All rights reserved.</p>
                </div>
            </div>
    </footer>

    <!-- Login Modal -->
    <div id="loginModal" class="modal fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-8 w-full max-w-md mx-4 transform transition">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800">Welcome Back!</h3>
                <button onclick="closeModal('loginModal')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form id="loginForm">
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Email <span class="text-red-500">*</span></label>
                    <input type="email" id="loginEmail" placeholder="soniya.thapa@example.com" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Password <span class="text-red-500">*</span></label>
                    <input type="password" id="loginPassword" placeholder="Enter your password" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none" required minlength="6">
                </div>
                <div class="flex justify-between items-center mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" id="loginRemember" class="mr-2">
                        <span class="text-gray-600">Remember me</span>
                    </label>
                    <a href="#" class="text-purple-600 hover:underline">Forgot Password?</a>
                </div>
                <button type="submit" class="btn-primary text-white w-full py-3 rounded-xl font-semibold transition transform hover:scale-105">
                    Login
                </button>
                <p class="text-center text-gray-600 mt-4">
                    Don't have an account?
                    <a href="#" onclick="switchModal('loginModal', 'registerModal')" class="text-purple-600 font-medium hover:underline">Sign Up</a>
                </p>
            </form>
        </div>
    </div>

    <!-- Register Modal - UPDATED WITH VALIDATION -->
    <div id="registerModal" class="modal fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-8 w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800">Create Account</h3>
                <button onclick="closeModal('registerModal')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form id="registerForm" onsubmit="register(event)">
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">First Name <span class="text-red-500">*</span></label>
                        <input type="text" id="registerFirstName" placeholder="Soniya"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none"
                            required minlength="2"
                            pattern="^[A-Za-z]+$"
                            title="First name should contain only alphabets (no numbers or special characters)"
                            oninput="validateNameInput(this)">
                        <p id="firstNameError" class="error-message hidden">Only alphabets allowed</p>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Last Name <span class="text-red-500">*</span></label>
                        <input type="text" id="registerLastName" placeholder="Thapa"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none"
                            required minlength="2"
                            pattern="^[A-Za-z]+$"
                            title="Last name should contain only alphabets (no numbers or special characters)"
                            oninput="validateNameInput(this)">
                        <p id="lastNameError" class="error-message hidden">Only alphabets allowed</p>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Email <span class="text-red-500">*</span></label>
                    <input type="email" oninput="ValidateEmail(this)" id="registerEmail" placeholder="soniya.thapa@example.com" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Phone <span class="text-red-500">*</span></label>
                    <input type="tel" id="registerPhone" ... oninput="ValidatePhone(this)" placeholder=" 9800000000" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none" required pattern="(\+977)?[9][0-9]{9}" title="Please enter a valid Nepali phone number (e.g., 9800000000)">
                    <p class="text-xs text-gray-500 mt-1">Format: 9800000000 </p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Password <span class="text-red-500">*</span></label>
                    <input type="password" id="registerPassword" placeholder="Create a password (min 6 characters)" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none" required minlength="6">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Confirm Password <span class="text-red-500">*</span></label>
                    <input type="password" id="registerConfirmPassword" placeholder="Confirm your password" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none" required minlength="6">
                </div>
                <label class="flex items-start mb-6">
                    <input type="checkbox" id="registerAgree" class="mr-2 mt-1" required>
                    <span class="text-gray-600 text-sm">I agree to the <a href="#" class="text-purple-600 hover:underline">Terms of Service</a> and <a href="#" class="text-purple-600 hover:underline">Privacy Policy</a> <span class="text-red-500">*</span></span>
                </label>
                <button type="submit" class="btn-primary text-white w-full py-3 rounded-xl font-semibold transition transform hover:scale-105">
                    Create Account
                </button>
                <p class="text-center text-gray-600 mt-4">
                    Already have an account?
                    <a href="#" onclick="switchModal('registerModal', 'loginModal')" class="text-purple-600 font-medium hover:underline">Login</a>
                </p>
            </form>
        </div>
    </div>

    <!-- Report Lost Item Modal -->
    <div id="reportModal" class="modal fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-8 w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800"><i class="fas fa-flag text-red-500 mr-2"></i>Report Lost Item</h3>
                <button onclick="closeModal('reportModal')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form id="lostItemForm">
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Item Name *</label>
                    <input type="text" id="lostItemName" placeholder="e.g., Black iPhone 13" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none" required pattern="^[A-Za-z\s]+$" title="Name should contain only alphabets">

                    <p class="text-xs text-gray-500 mt-1">Only alphabets allowed</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Category *</label>
                        <select id="lostItemCategory" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none" required>
                            <option value="">Select Category</option>
                            <option value="1">Electronics</option>
                            <option value="2">Documents</option>
                            <option value="3">Accessories</option>
                            <option value="4">Bags</option>
                            <option value="5">Keys</option>
                            <option value="6">Pets</option>
                            <option value="7">Other</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Date Lost *</label>
                        <input type="date" id="lostItemDate" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Location Lost *</label>
                    <input type="text" id="lostItemLocation" placeholder="e.g., Ratnapark, Kathmandu" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Description *</label>
                    <textarea id="lostItemDescription" rows="4" placeholder="Describe your item in detail (color, brand, distinguishing features...)" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none resize-none" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Upload Image</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center cursor-pointer hover:border-purple-500 transition" id="lostImageDropzone">
                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                        <p class="text-gray-500">Click to upload or drag and drop</p>
                        <p class="text-gray-400 text-sm">PNG, JPG up to 5MB</p>
                        <input type="file" id="lostItemImage" class="hidden" accept="image/*">
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Contact Phone</label>
                    <input type="tel" ... oninput="ValidatePhone(this)" required pattern="(\+977)?[9][0-9]{9}" name="phone" id="lostItemPhone" placeholder=" 9800000000" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none" pattern="(\+977)?[9][0-9]{9}" title="Please enter a valid Nepali phone number">
                    <p class="text-xs text-gray-500 mt-1">Format: 9800000000</p>
                </div>
                <button type="submit" class="status-lost text-white w-full py-3 rounded-xl font-semibold transition transform hover:scale-105">
                    <i class="fas fa-paper-plane mr-2"></i>Submit Report
                </button>
            </form>
        </div>
    </div>

    <!-- Report Found Item Modal -->
    <div id="foundModal" class="modal fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-8 w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800"><i class="fas fa-hand-holding-heart text-green-500 mr-2"></i>Report Found Item</h3>
                <button onclick="closeModal('foundModal')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form id="foundItemForm">
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Item Name *</label>
                    <input type="text" id="foundItemName" placeholder="e.g., Blue Wallet" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 outline-none" required>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Category *</label>
                        <select id="foundItemCategory" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 outline-none" required>
                            <option value="">Select Category</option>
                            <option value="1">Electronics</option>
                            <option value="2">Documents</option>
                            <option value="3">Accessories</option>
                            <option value="4">Bags</option>
                            <option value="5">Keys</option>
                            <option value="6">Pets</option>
                            <option value="7">Other</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Date Found *</label>
                        <input type="date" id="foundItemDate" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 outline-none" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Location Found *</label>
                    <input type="text" id="foundItemLocation" placeholder="e.g., New Road, Kathmandu" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 outline-none" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Description *</label>
                    <textarea id="foundItemDescription" rows="4" placeholder="Describe the item in detail (color, brand, distinguishing features...)" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 outline-none resize-none" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Upload Image</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center cursor-pointer hover:border-green-500 transition" id="foundImageDropzone">
                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                        <p class="text-gray-500">Click to upload or drag and drop</p>
                        <p class="text-gray-400 text-sm">PNG, JPG up to 5MB</p>
                        <input type="file" id="foundItemImage" class="hidden" accept="image/*">
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Contact Phone</label>
                    <input type="tel" id="foundItemPhone" ... oninput="ValidatePhone(this)" placeholder="+977 9800000000" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 outline-none" pattern="(\+977)?[9][0-9]{9}" title="Please enter a valid Nepali phone number">
                    <p class="text-xs text-gray-500 mt-1">Format: 9800000000 </p>
                </div>
                <button type="submit" class="status-found text-white w-full py-3 rounded-xl font-semibold transition transform hover:scale-105">
                    <i class="fas fa-paper-plane mr-2"></i>Submit Report
                </button>
            </form>
        </div>
    </div>

    <!-- Item Detail Modal -->
    <div id="itemDetailModal" class="modal fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl w-full max-w-3xl mx-4 max-h-[90vh] overflow-y-auto">
            <div id="itemDetailContent">
                <!-- Content will be dynamically inserted -->
            </div>
        </div>
    </div>

    <script>
        // ==========================================
        // CONFIGURATION & STATE
        // ==========================================
        const API_BASE = 'api/';
        let currentUser = null;
        let items = [];
        let categories = [];
        let currentFilter = 'all';
        let currentCategoryFilter = '';
        let userReviews = [];
        let itemsToShow = 6; // Initially show 6 items
        const itemsPerLoad = 6; // Load 6 more items each time

        document.addEventListener("DOMContentLoaded", () => {
            const today = new Date().toISOString().split("T")[0];

            document.querySelectorAll('input[type="date"]').forEach(input => {
                input.max = today;
            })
        })

        function ValidatePhone(input) {
            let value = input.value.replace(/\D/g, "");
            if (value.startsWith('+977') && value.length > 13) {
                value = value.substring(3);

            }
            value = value.substring(0, 10);
            input.value = value;

            if (value.length === 10 && value.startsWith('9')) {
                input.classList.remove("input-error");
                input.classList.add("border-green-500");
            } else {
                input.classList.remove("input-error");
                input.classList.remove("border-green-500");
            }
        }

        function ValidateEmail(input) {
            const email = input.value.trim();

            const pattern = "^(?=.{1,254}$)(?=.{1,64}@)[A-Za-z0-9!#$%&'*+/=?^_{|}~-]+(?:\\.[A-Za-z0-9!#$%&'*+/=?^_{|}~-]+)*@(?:(?:[A-Za-z0-9](?:[A-Za-z0-9-]*[A-Za-z0-9])?\\.)+[A-Za-z]{2,}|\\[(?:IPv6:[A-F0-9]{0,4}(?::[A-F0-9]{0,4}){2,7}|(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?\\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?))\\]$"
            const ErrorElement = input.parentElement.querySelector('.error-message-email');
            return new RegExp(pattern, 'i').test(email)
            const isValid = pattern.test(email);

            input.classList.remove("input-error");
            input.classList.remove("border-green-500")
            if (email === '') {
                return true;
            }

            if (ErrorElement) {
                errorElement.textContent = "";
                errorElement.classList.add('hidden');

            }

            if (!email.includes('@')) {
                input.classList.add("input-error");
                if (errorElement) {
                    errorElement.textContent = "Please include an '@' in email address";
                    errorElement.classList.remove('hidden');
                }
                return false;
            }

            if (isValid) {

                input.classList.add("border-green-500");
                return true;

            } else {
                input.classList.add('input-error');
                if (errorElement) {
                    errorElement.textContent = "Please Enter the Valid Email Address";
                    errorElement.classList.remove("hidden")
                }
            }
            return false;
        }


        // ==========================================
        // API HELPER FUNCTIONS
        // ==========================================
        async function apiCall(endpoint, data = {}, method = 'POST') {
            try {
                const formData = new FormData();
                for (const key in data) {
                    if (data[key] instanceof File) {
                        formData.append(key, data[key]);
                    } else {
                        formData.append(key, data[key]);
                    }
                }

                const response = await fetch(API_BASE + endpoint, {
                    method: method,
                    body: method === 'GET' ? null : formData
                });

                return await response.json();
            } catch (error) {
                console.error('API Error:', error);
                return {
                    success: false,
                    message: 'Something Occured. Please try again.'
                };
            }
        }

        async function apiGet(endpoint, params = {}) {
            const queryString = new URLSearchParams(params).toString();
            const url = API_BASE + endpoint + (queryString ? '?' + queryString : '');

            try {
                const response = await fetch(url);
                return await response.json();
            } catch (error) {
                console.error('API Error:', error);
                return {
                    success: false,
                    message: 'Something Occured. Please try again.'
                };
            }
        }

        // ==========================================
        // TOAST NOTIFICATIONS
        // ==========================================
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `fixed top-20 right-4 px-6 py-3 rounded-lg shadow-lg z-50 transition-all transform translate-x-full ${
                type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500'
            } text-white`;
            toast.innerHTML = `<i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'} mr-2"></i>${message}`;
            document.body.appendChild(toast);

            setTimeout(() => toast.classList.remove('translate-x-full'), 100);
            setTimeout(() => {
                toast.classList.add('translate-x-full');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // ==========================================
        // NAME VALIDATION FUNCTIONS
        // ==========================================
        function validateNameInput(input) {
            // Remove any non-alphabetic characters
            const originalValue = input.value;
            const cleanedValue = originalValue.replace(/[^A-Za-z]/g, '');

            if (originalValue !== cleanedValue) {
                input.value = cleanedValue;
                input.classList.add('input-error');

                // Show error message
                const errorId = input.id === 'registerFirstName' ? 'firstNameError' : 'lastNameError';
                const errorElement = document.getElementById(errorId);
                if (errorElement) {
                    errorElement.classList.remove('hidden');
                }

                // Remove error after 2 seconds
                setTimeout(() => {
                    input.classList.remove('input-error');
                    if (errorElement) {
                        errorElement.classList.add('hidden');
                    }
                }, 2000);
            }
        }

        function isValidName(name) {
            // Only allows alphabets (no numbers, no special characters)
            const nameRegex = /^[A-Za-z]+$/;
            return nameRegex.test(name);
        }

        // Validate review name input - prevent numbers and special characters
        function validateReviewName(input) {
            const originalValue = input.value;
            // Allow only alphabets and spaces
            const cleanedValue = originalValue.replace(/[^A-Za-z\s]/g, '');

            if (originalValue !== cleanedValue) {
                input.value = cleanedValue;
                input.classList.add('input-error');

                // Remove error styling after a moment
                setTimeout(() => {
                    input.classList.remove('input-error');
                }, 1000);
            }
        }

        // ==========================================
        // AUTHENTICATION FUNCTIONS
        // ==========================================
        async function checkSession() {
            const result = await apiCall('auth.php', {
                action: 'check_session'
            });
            if (result.success && result.logged_in) {
                currentUser = result.user;
                updateUIForLoggedInUser();
            }
        }

        function updateUIForLoggedInUser() {
            const authButtons = document.getElementById('authButtons');
            if (authButtons && currentUser) {
                authButtons.innerHTML = `
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center overflow-hidden">
                                ${currentUser.profile_image 
                                    ? `<img src="${currentUser.profile_image}" class="w-10 h-10 rounded-full object-cover">` 
                                    : `<i class="fas fa-user text-purple-600"></i>`
                                }
                            </div>
                            <span class="hidden md:block font-medium text-gray-700">${currentUser.name}</span>
                        </div>
                        <button onclick="logout()" class="text-gray-700 hover:text-red-600 transition" title="Logout">
                            <i class="fas fa-sign-out-alt text-xl"></i>
                        </button>
                    </div>
                `;
            }
        }

        async function login(event) {
            event.preventDefault();
            const form = event.target;
            const email = form.querySelector('input[type="email"]').value;
            const password = form.querySelector('input[type="password"]').value;
            const remember = form.querySelector('input[type="checkbox"]').checked;

            const result = await apiCall('auth.php', {
                action: 'login',
                email: email,
                password: password,
                remember: remember ? '1' : '0'
            });

            if (result.success) {
                currentUser = result.user;
                showToast('Login successful! Welcome back, ' + currentUser.name);
                closeModal('loginModal');
                updateUIForLoggedInUser();
                loadItems();
            } else {
                showToast(result.message, 'error');
            }
        }

        async function register(event) {
            event.preventDefault();

            const firstName = document.getElementById('registerFirstName').value.trim();
            const lastName = document.getElementById('registerLastName').value.trim();
            const email = document.getElementById('registerEmail').value.trim();
            const phone = document.getElementById('registerPhone').value.trim();
            const password = document.getElementById('registerPassword').value;
            const confirmPassword = document.getElementById('registerConfirmPassword').value;

            // Validate first name - only alphabets allowed
            if (!isValidName(firstName)) {
                showToast('First name should contain only alphabets (no numbers or special characters)', 'error');
                document.getElementById('registerFirstName').classList.add('input-error');
                document.getElementById('firstNameError').classList.remove('hidden');
                return;
            }

            // Validate last name - only alphabets allowed
            if (!isValidName(lastName)) {
                showToast('Last name should contain only alphabets (no numbers or special characters)', 'error');
                document.getElementById('registerLastName').classList.add('input-error');
                document.getElementById('lastNameError').classList.remove('hidden');
                return;
            }


            // Validate password match
            if (password !== confirmPassword) {
                showToast('Passwords do not match', 'error');
                return;
            }


            const result = await apiCall('auth.php', {
                action: 'register',
                first_name: firstName,
                last_name: lastName,
                email: email,
                phone: phone,
                password: password,
                confirm_password: confirmPassword
            });

            if (result.success) {
                showToast(result.message);
                closeModal('registerModal');
                setTimeout(() => openModal('loginModal'), 500);
            } else {
                showToast(result.message, 'error');
            }
        }

        async function logout() {
            const result = await apiCall('auth.php', {
                action: 'logout'
            });
            if (result.success) {
                currentUser = null;
                showToast('Logged out successfully');
                location.reload();
            }
        }

        // ==========================================
        // REVIEW/TESTIMONIAL FUNCTIONS
        // ==========================================
        function loadReviews() {
            // Load reviews from localStorage
            const savedReviews = localStorage.getItem('userReviews');
            if (savedReviews) {
                userReviews = JSON.parse(savedReviews);
                renderUserReviews();
            }
        }

        function saveReviews() {
            localStorage.setItem('userReviews', JSON.stringify(userReviews));
        }

        function renderUserReviews() {
            const grid = document.getElementById('userReviewsGrid');
            if (userReviews.length === 0) {
                grid.innerHTML = '';
                return;
            }

            const colors = ['purple', 'blue', 'green', 'orange', 'pink', 'indigo'];

            grid.innerHTML = userReviews.map((review, index) => {
                const color = colors[index % colors.length];
                const stars = generateStars(review.rating);
                return `
                    <div class="bg-white rounded-2xl p-6 shadow-lg relative">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-${color}-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-${color}-600"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-semibold text-gray-800">${escapeHtml(review.name)}</h4>
                                <div class="text-yellow-400">
                                    ${stars}
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600">"${escapeHtml(review.text)}"</p>
                        <p class="text-gray-400 text-xs mt-3">${formatReviewDate(review.date)}</p>
                    </div>
                `;
            }).join('');
        }

        function generateStars(rating) {
            let stars = '';
            for (let i = 1; i <= 5; i++) {
                if (i <= rating) {
                    stars += '<i class="fas fa-star"></i>';
                } else {
                    stars += '<i class="far fa-star"></i>';
                }
            }
            return stars;
        }

        function formatReviewDate(dateStr) {
            const date = new Date(dateStr);
            return date.toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            });
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        function submitReview(event) {
            event.preventDefault();

            const name = document.getElementById('reviewName').value.trim();
            const email = document.getElementById('reviewEmail').value.trim();
            const ratingInput = document.querySelector('input[name="rating"]:checked');
            const text = document.getElementById('reviewText').value.trim();

            // Validate name - only alphabets and spaces
            const nameRegex = /^[A-Za-z\s]+$/;
            if (!nameRegex.test(name)) {
                showToast('Name should contain only alphabets', 'error');
                return;
            }

            if (!ratingInput) {
                showToast('Please select a rating', 'error');
                return;
            }

            if (text.length < 20) {
                showToast('Review must be at least 20 characters long', 'error');
                return;
            }

            const review = {
                name: name,
                email: email,
                rating: parseInt(ratingInput.value),
                text: text,
                date: new Date().toISOString()
            };

            userReviews.unshift(review); // Add to beginning of array
            saveReviews();
            renderUserReviews();

            // Reset form
            document.getElementById('reviewForm').reset();
            showToast('Thank you for your review!');

            // Scroll to the reviews
            document.getElementById('userReviewsGrid').scrollIntoView({
                behavior: 'smooth'
            });
        }

        function deleteReview(index) {
            if (confirm('Are you sure you want to delete this review?')) {
                userReviews.splice(index, 1);
                saveReviews();
                renderUserReviews();
                showToast('Review deleted successfully');
            }
        }

        // ==========================================
        // ITEMS FUNCTIONS
        // ==========================================
        async function loadItems() {
            const params = {
                action: 'get_all'
            };
            if (currentFilter !== 'all') params.type = currentFilter;
            if (currentCategoryFilter) params.category_id = currentCategoryFilter;

            const result = await apiGet('items.php', params);
            if (result.success) {
                items = result.items;
                renderItems(items);
            }
        }

        async function loadCategories() {
            const result = await apiGet('items.php', {
                action: 'get_categories'
            });
            if (result.success) {
                categories = result.categories;
            }
        }

        async function loadStats() {
            const result = await apiGet('items.php', {
                action: 'get_stats'
            });
            if (result.success) {
                const stats = result.stats;
                document.querySelectorAll('.stat-value').forEach((el, index) => {
                    const values = [stats.total_items, stats.items_returned, stats.active_users, stats.success_rate + '%'];
                    if (values[index]) el.textContent = values[index];
                });
            }
        }

        function renderItems(itemsToRender) {
            const grid = document.getElementById('itemsGrid');
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            const showLessBtn = document.getElementById('showLessBtn');

            if (itemsToRender.length === 0) {
                grid.innerHTML = `
                    <div class="col-span-full text-center py-12">
                        <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 text-lg">No items found</p>
                        <p class="text-gray-400">Try adjusting your search or filters</p>
                    </div>
                `;
                if (loadMoreBtn) loadMoreBtn.style.display = 'none';
                if (showLessBtn) showLessBtn.style.display = 'none';
                return;
            }

            // Only show limited number of items
            const limitedItems = itemsToRender.slice(0, itemsToShow);

            grid.innerHTML = limitedItems.map(item => `
                <div class="bg-white rounded-2xl overflow-hidden shadow-md card-hover transition duration-300 cursor-pointer" onclick="showItemDetail(${item.id})">
                    <div class="relative">
                        <img src="${item.image || 'https://via.placeholder.com/400x300?text=No+Image'}" alt="${item.name}" class="w-full h-48 object-cover">
                        <span class="absolute top-3 left-3 ${item.type === 'lost' ? 'status-lost' : 'status-found'} text-white px-3 py-1 rounded-full text-sm font-medium">
                            ${item.type === 'lost' ? 'Lost' : 'Found'}
                        </span>
                        ${item.status === 'claimed' ? '<span class="absolute top-3 right-3 status-claimed text-white px-3 py-1 rounded-full text-sm font-medium">Claimed</span>' : ''}
                    </div>
                    <div class="p-5">
                        <h3 class="font-semibold text-lg text-gray-800 mb-2">${item.name}</h3>
                        <div class="flex items-center text-gray-500 text-sm mb-2">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span class="truncate">${item.location}</span>
                        </div>
                        <div class="flex items-center text-gray-500 text-sm mb-3">
                            <i class="fas fa-calendar mr-2"></i>
                            <span>${formatDate(item.date_lost_found)}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs capitalize">${item.category_name}</span>
                            <button class="text-purple-600 font-medium hover:underline">View Details</button>
                        </div>
                    </div>
                </div>
            `).join('');

            // Show or hide Load More and Show Less buttons
            if (loadMoreBtn && showLessBtn) {
                if (itemsToShow > 6) {
                    // User has loaded more items
                    showLessBtn.style.display = 'inline-block';
                    if (itemsToShow >= itemsToRender.length) {
                        loadMoreBtn.style.display = 'none';
                    } else {
                        loadMoreBtn.style.display = 'inline-block';
                    }
                } else {
                    // Default state - showing initial items
                    showLessBtn.style.display = 'none';
                    if (itemsToRender.length > 6) {
                        loadMoreBtn.style.display = 'inline-block';
                    } else {
                        loadMoreBtn.style.display = 'none';
                    }
                }
            }
        }

        // Load more items
        function loadMoreItems() {
            itemsToShow += itemsPerLoad;
            renderItems(items);

            // Smooth scroll to show new items
            setTimeout(() => {
                const grid = document.getElementById('itemsGrid');
                const newItems = grid.children[itemsToShow - itemsPerLoad];
                if (newItems) {
                    newItems.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            }, 100);
        }

        // Show less items - reset to default view
        function showLessItems() {
            itemsToShow = 6; // Reset to initial count
            renderItems(items);

            // Smooth scroll back to items section
            document.getElementById('items').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        // Format date
        function formatDate(dateStr) {
            if (!dateStr) return 'N/A';
            const date = new Date(dateStr);
            return date.toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            });
        }

        // Show item detail modal
        async function showItemDetail(id) {
            const result = await apiGet('items.php', {
                action: 'get',
                id: id
            });
            if (!result.success) {
                showToast(result.message, 'error');
                return;
            }

            const item = result.item;
            const content = document.getElementById('itemDetailContent');
            const isOwner = currentUser && currentUser.id == item.user_id;

            content.innerHTML = `
                <div class="relative">
                    <img src="${item.image || 'https://via.placeholder.com/800x400?text=No+Image'}" alt="${item.name}" class="w-full h-64 object-cover">
                    <button onclick="closeModal('itemDetailModal')" class="absolute top-4 right-4 bg-white/80 hover:bg-white w-10 h-10 rounded-full flex items-center justify-center transition">
                        <i class="fas fa-times text-gray-600"></i>
                    </button>
                    <span class="absolute bottom-4 left-4 ${item.type === 'lost' ? 'status-lost' : 'status-found'} text-white px-4 py-2 rounded-full font-medium">
                        <i class="fas ${item.type === 'lost' ? 'fa-exclamation-circle' : 'fa-check-circle'} mr-2"></i>
                        ${item.type === 'lost' ? 'Lost Item' : 'Found Item'}
                    </span>
                </div>
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">${item.name}</h2>
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-tag text-purple-600"></i>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Category</p>
                                <p class="font-medium text-gray-800 capitalize">${item.category_name}</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-calendar text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Date ${item.type === 'lost' ? 'Lost' : 'Found'}</p>
                                <p class="font-medium text-gray-800">${formatDate(item.date_lost_found)}</p>
                            </div>
                        </div>
                        <div class="flex items-center col-span-2">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-map-marker-alt text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Location</p>
                                <p class="font-medium text-gray-800">${item.location}</p>
                            </div>
                        </div>
                        <div class="flex items-center col-span-2">
                            <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user text-orange-600"></i>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Posted by</p>
                                <p class="font-medium text-gray-800">${item.first_name} ${item.last_name}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-800 mb-2">Description</h3>
                        <p class="text-gray-600">${item.description}</p>
                    </div>
                    ${isOwner ? `
                        <div class="flex gap-4">
                            <button onclick="editItem(${item.id})" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-xl font-semibold transition">
                                <i class="fas fa-edit mr-2"></i>Edit Item
                            </button>
                            <button onclick="deleteItem(${item.id})" class="px-6 py-3 bg-red-500 hover:bg-red-600 text-white rounded-xl font-semibold transition">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    ` : `
                        <div class="flex gap-4">
                            <button onclick="openClaimModal(${item.id})" class="flex-1 btn-primary text-white py-3 rounded-xl font-semibold transition transform hover:scale-105">
                                <i class="fas fa-envelope mr-2"></i>Contact ${item.type === 'lost' ? 'Owner' : 'Finder'}
                            </button>
                            <button onclick="shareItem(${item.id})" class="px-6 py-3 border-2 border-purple-600 text-purple-600 rounded-xl font-semibold hover:bg-purple-50 transition">
                                <i class="fas fa-share-alt"></i>
                            </button>
                        </div>
                    `}
                </div>
            `;
            openModal('itemDetailModal');
        }

        // Open claim modal
        function openClaimModal(itemId) {
            if (!currentUser) {
                showToast('Please login to contact the owner', 'error');
                closeModal('itemDetailModal');
                openModal('loginModal');
                return;
            }

            const claimModal = document.getElementById('claimModal');
            if (!claimModal) {
                // Create claim modal if not exists
                const modalHTML = `
                    <div id="claimModal" class="modal fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
                        <div class="bg-white rounded-2xl p-8 w-full max-w-md mx-4">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-2xl font-bold text-gray-800">Send Message</h3>
                                <button onclick="closeModal('claimModal')" class="text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-times text-xl"></i>
                                </button>
                            </div>
                            <form id="claimForm" onsubmit="submitClaim(event)">
                                <input type="hidden" id="claimItemId" value="${itemId}">
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">Your Message *</label>
                                    <textarea id="claimMessage" rows="4" placeholder="Describe why you think this is your item or how you can help..." class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none resize-none" required></textarea>
                                </div>
                                <button type="submit" class="btn-primary text-white w-full py-3 rounded-xl font-semibold transition transform hover:scale-105">
                                    <i class="fas fa-paper-plane mr-2"></i>Send Message
                                </button>
                            </form>
                        </div>
                    </div>
                `;
                document.body.insertAdjacentHTML('beforeend', modalHTML);
            } else {
                document.getElementById('claimItemId').value = itemId;
            }

            closeModal('itemDetailModal');
            openModal('claimModal');
        }

        // Submit claim
        async function submitClaim(event) {
            event.preventDefault();
            const itemId = document.getElementById('claimItemId').value;
            const message = document.getElementById('claimMessage').value;

            const result = await apiCall('items.php', {
                action: 'claim',
                item_id: itemId,
                message: message
            });

            if (result.success) {
                showToast(result.message);
                closeModal('claimModal');
            } else {
                showToast(result.message, 'error');
            }
        }

        // Share item
        function shareItem(itemId) {
            const url = window.location.href.split('?')[0] + '?item=' + itemId;
            if (navigator.share) {
                navigator.share({
                    title: 'Check this item on I Found',
                    url: url
                });
            } else {
                navigator.clipboard.writeText(url);
                showToast('Link copied to clipboard!');
            }
        }

        // Delete item
        async function deleteItem(itemId) {
            if (!confirm('Are you sure you want to delete this item?')) return;

            const result = await apiCall('items.php', {
                action: 'delete',
                item_id: itemId
            });

            if (result.success) {
                showToast(result.message);
                closeModal('itemDetailModal');
                loadItems();
            } else {
                showToast(result.message, 'error');
            }
        }

        // Edit item
        async function editItem(itemId) {
            const result = await apiGet('items.php', {
                action: 'get',
                id: itemId
            });
            if (!result.success) {
                showToast(result.message, 'error');
                return;
            }

            const item = result.item;

            let editModal = document.getElementById('editItemModal');
            if (!editModal) {
                const modalHTML = `
                    <div id="editItemModal" class="modal fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
                        <div class="bg-white rounded-2xl p-8 w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-2xl font-bold text-gray-800"><i class="fas fa-edit text-blue-500 mr-2"></i>Edit Item</h3>
                                <button onclick="closeModal('editItemModal')" class="text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-times text-xl"></i>
                                </button>
                            </div>
                            <form id="editItemForm" onsubmit="submitEditItem(event)">
                                <input type="hidden" id="editItemId">
                                <input type="hidden" id="editItemType">
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">Item Name *</label>
                                    <input type="text" id="editItemName" placeholder="e.g., Black iPhone 13" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none" required>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2">Category *</label>
                                        <select id="editItemCategory" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none" required>
                                            <option value="">Select Category</option>
                                            <option value="1">Electronics</option>
                                            <option value="2">Documents</option>
                                            <option value="3">Accessories</option>
                                            <option value="4">Bags</option>
                                            <option value="5">Keys</option>
                                            <option value="6">Pets</option>
                                            <option value="7">Other</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2">Date *</label>
                                        <input type="date" id="editItemDate" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none" required>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">Location *</label>
                                    <input type="text" id="editItemLocation" placeholder="e.g., Ratnapark, Kathmandu" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none" required>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">Description *</label>
                                    <textarea id="editItemDescription" rows="4" placeholder="Describe the item in detail..." class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none resize-none" required></textarea>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">Contact Phone</label>
                                    <input type="tel" id="editItemPhone" placeholder="9800000000" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none" pattern="(\\+977)?[9][0-9]{9}" title="Please enter a valid Nepali phone number">
                                    <p class="text-xs text-gray-500 mt-1">Format:  9800000000</p>
                                </div>
                                <div class="mb-6">
                                    <label class="block text-gray-700 font-medium mb-2">Status</label>
                                    <select id="editItemStatus" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                                        <option value="active">Active</option>
                                        <option value="claimed">Claimed</option>
                                        <option value="closed">Closed</option>
                                    </select>
                                </div>
                                <div class="flex gap-4">
                                    <button type="button" onclick="closeModal('editItemModal')" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 rounded-xl font-semibold transition">
                                        Cancel
                                    </button>
                                    <button type="submit" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-xl font-semibold transition">
                                        <i class="fas fa-save mr-2"></i>Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                `;
                document.body.insertAdjacentHTML('beforeend', modalHTML);
                editModal = document.getElementById('editItemModal');
            }

            document.getElementById('editItemId').value = item.id;
            document.getElementById('editItemType').value = item.type;
            document.getElementById('editItemName').value = item.name;
            document.getElementById('editItemCategory').value = item.category_id;
            document.getElementById('editItemDate').value = item.date_lost_found;
            document.getElementById('editItemLocation').value = item.location;
            document.getElementById('editItemDescription').value = item.description;
            document.getElementById('editItemPhone').value = item.contact_phone || '';
            document.getElementById('editItemStatus').value = item.status;

            closeModal('itemDetailModal');
            openModal('editItemModal');
        }

        // Submit edited item
        async function submitEditItem(event) {
            event.preventDefault();

            const itemId = document.getElementById('editItemId').value;
            const name = document.getElementById('editItemName').value.trim();
            const category_id = document.getElementById('editItemCategory').value;
            const date_lost_found = document.getElementById('editItemDate').value;
            const location = document.getElementById('editItemLocation').value.trim();
            const description = document.getElementById('editItemDescription').value.trim();
            const contact_phone = document.getElementById('editItemPhone').value.trim();
            const status = document.getElementById('editItemStatus').value;

            if (!name || !category_id || !date_lost_found || !location || !description) {
                showToast('Please fill in all required fields', 'error');
                return;
            }

            const result = await apiCall('items.php', {
                action: 'update',
                item_id: itemId,
                name: name,
                category_id: category_id,
                date_lost_found: date_lost_found,
                location: location,
                description: description,
                contact_phone: contact_phone,
                status: status
            });

            if (result.success) {
                showToast('Item updated successfully!');
                closeModal('editItemModal');
                loadItems();
            } else {
                showToast(result.message, 'error');
            }
        }

        // Filter items by type
        function filterItems(type) {
            const buttons = document.querySelectorAll('.tab-btn');
            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            currentFilter = type;
            itemsToShow = 6; // Reset to show initial items
            loadItems();
        }

        // Filter by category
        function filterByCategory(categoryId) {
            const cards = document.querySelectorAll('.category-card');
            cards.forEach(card => card.classList.remove('active'));
            event.currentTarget.classList.add('active');

            currentCategoryFilter = categoryId;
            itemsToShow = 6; // Reset to show initial items
            loadItems();
            document.getElementById('items').scrollIntoView({
                behavior: 'smooth'
            });
        }

        async function searchItems() {
            const query = document.getElementById('searchInput').value;
            const category = document.getElementById('categoryFilter').value;

            const params = {
                action: 'search',
                query: query
            };
            if (currentFilter !== 'all') params.type = currentFilter;
            if (category) params.category_id = category;

            const result = await apiGet('items.php', params);
            if (result.success) {
                items = result.items;
                itemsToShow = 6; // Reset to show initial items
                renderItems(items);
                document.getElementById('items').scrollIntoView({
                    behavior: 'smooth'
                });
            }
        }

        // ==========================================
        // REPORT ITEM FUNCTIONS
        // ==========================================
        async function submitLostItem(event) {
            event.preventDefault();
            if (!currentUser) {
                showToast('Please login to report an item', 'error');
                closeModal('reportModal');
                openModal('loginModal');
                return;
            }

            const name = document.getElementById('lostItemName').value.trim();
            const category_id = document.getElementById('lostItemCategory').value;
            const date_lost_found = document.getElementById('lostItemDate').value;
            const location = document.getElementById('lostItemLocation').value.trim();
            const description = document.getElementById('lostItemDescription').value.trim();
            const contact_phone = document.getElementById('lostItemPhone').value.trim();
            const fileInput = document.getElementById('lostItemImage');

            if (!name || !category_id || !date_lost_found || !location || !description) {
                showToast('Please fill in all required fields', 'error');
                return;
            }

            const formData = {
                action: 'create',
                type: 'lost',
                name: name,
                category_id: category_id,
                date_lost_found: date_lost_found,
                location: location,
                description: description,
                contact_phone: contact_phone
            };

            if (fileInput && fileInput.files[0]) {
                formData.image = fileInput.files[0];
            }

            const result = await apiCall('items.php', formData);
            if (result.success) {
                showToast('Lost item reported successfully!');
                closeModal('reportModal');
                document.getElementById('lostItemForm').reset();
                loadItems();
            } else {
                showToast(result.message, 'error');
            }
        }

        async function submitFoundItem(event) {
            event.preventDefault();
            if (!currentUser) {
                showToast('Please login to report an item', 'error');
                closeModal('foundModal');
                openModal('loginModal');
                return;
            }

            const name = document.getElementById('foundItemName').value.trim();
            const category_id = document.getElementById('foundItemCategory').value;
            const date_lost_found = document.getElementById('foundItemDate').value;
            const location = document.getElementById('foundItemLocation').value.trim();
            const description = document.getElementById('foundItemDescription').value.trim();
            const contact_phone = document.getElementById('foundItemPhone').value.trim();
            const fileInput = document.getElementById('foundItemImage');

            if (!name || !category_id || !date_lost_found || !location || !description) {
                showToast('Please fill in all required fields', 'error');
                return;
            }

            const formData = {
                action: 'create',
                type: 'found',
                name: name,
                category_id: category_id,
                date_lost_found: date_lost_found,
                location: location,
                description: description,
                contact_phone: contact_phone
            };

            if (fileInput && fileInput.files[0]) {
                formData.image = fileInput.files[0];
            }

            const result = await apiCall('items.php', formData);
            if (result.success) {
                showToast('Found item reported successfully!');
                closeModal('foundModal');
                document.getElementById('foundItemForm').reset();
                loadItems();
            } else {
                showToast(result.message, 'error');
            }
        }

        // ==========================================
        // CONTACT FORM
        // ==========================================
        async function submitContactForm(event) {
            event.preventDefault();
            const form = event.target;
            const inputs = form.querySelectorAll('input, textarea');

            const result = await apiCall('contact.php', {
                action: 'send',
                name: inputs[0].value,
                email: inputs[1].value,
                subject: inputs[2].value,
                message: inputs[3].value
            });

            if (result.success) {
                showToast(result.message);
                form.reset();
            } else {
                showToast(result.message, 'error');
            }
        }

        // Newsletter subscription
        async function subscribeNewsletter(event) {
            event.preventDefault();
            const form = event.target;
            const email = form.querySelector('input[type="email"]').value;

            const result = await apiCall('contact.php', {
                action: 'subscribe',
                email: email
            });

            if (result.success) {
                showToast(result.message);
                form.reset();
            } else {
                showToast(result.message, 'error');
            }
        }

        // ==========================================
        // MODAL FUNCTIONS
        // ==========================================
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.getElementById(modalId).classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.getElementById(modalId).classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        function switchModal(from, to) {
            closeModal(from);
            setTimeout(() => openModal(to), 200);
        }

        // Mobile menu toggle
        function toggleMobileMenu() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        }

        // Close modals on outside click
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    closeModal(modal.id);
                }
            });
        });

        // File upload handling
        document.querySelectorAll('.border-dashed').forEach(dropzone => {
            const input = dropzone.querySelector('input[type="file"]');

            dropzone.addEventListener('click', () => input.click());

            dropzone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropzone.classList.add('border-purple-500', 'bg-purple-50');
            });

            dropzone.addEventListener('dragleave', () => {
                dropzone.classList.remove('border-purple-500', 'bg-purple-50');
            });

            dropzone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropzone.classList.remove('border-purple-500', 'bg-purple-50');
                if (e.dataTransfer.files.length) {
                    input.files = e.dataTransfer.files;
                    dropzone.querySelector('p').textContent = e.dataTransfer.files[0].name;
                }
            });

            input.addEventListener('change', () => {
                if (input.files.length) {
                    dropzone.querySelector('p').textContent = input.files[0].name;
                }
            });
        });

        // ==========================================
        // INITIALIZATION
        // ==========================================
        document.addEventListener('DOMContentLoaded', async () => {
            // Check if user is logged in
            await checkSession();

            // Load categories and items
            await loadCategories();
            await loadItems();

            // Load stats
            loadStats();

            // Load user reviews
            loadReviews();

            // Attach form handlers
            const loginForm = document.querySelector('#loginModal form');
            if (loginForm) loginForm.onsubmit = login;

            const reportForm = document.querySelector('#reportModal form');
            if (reportForm) reportForm.onsubmit = submitLostItem;

            const foundForm = document.querySelector('#foundModal form');
            if (foundForm) foundForm.onsubmit = submitFoundItem;

            const contactForm = document.querySelector('#contact form');
            if (contactForm) contactForm.onsubmit = submitContactForm;

            // Newsletter form in footer
            const newsletterForm = document.querySelector('footer form');
            if (newsletterForm) newsletterForm.onsubmit = subscribeNewsletter;

            // Check for item in URL
            const urlParams = new URLSearchParams(window.location.search);
            const itemId = urlParams.get('item');
            if (itemId) {
                showItemDetail(parseInt(itemId));
            }
        });

        // Smooth scroll for navigation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Enter key search
        document.getElementById('searchInput')?.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') searchItems();
        });
    </script>
    <!-- Your HTML content above -->

    <!-- Live validation and form submission JS -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // Grab form and inputs
            const foundForm = document.getElementById('foundItemForm');
            const nameInput = document.getElementById('foundItemName');
            const categoryInput = document.getElementById('foundItemCategory');
            const dateInput = document.getElementById('foundItemDate');
            const locationInput = document.getElementById('foundItemLocation');
            const descInput = document.getElementById('foundItemDescription');
            const phoneInput = document.getElementById('foundItemPhone');
            const fileInput = document.getElementById('foundItemImage');

            // Helper functions
            function showError(input, message) {
                input.classList.add('border-red-500');
                input.classList.remove('border-green-500');
                if (!input.nextElementSibling || !input.nextElementSibling.classList.contains('error-msg')) {
                    const error = document.createElement('p');
                    error.className = 'text-red-500 text-sm error-msg';
                    error.innerText = message;
                    input.parentNode.appendChild(error);
                } else {
                    input.nextElementSibling.innerText = message;
                }
            }

            function clearError(input) {
                input.classList.remove('border-red-500');
                input.classList.add('border-green-500');
                if (input.nextElementSibling && input.nextElementSibling.classList.contains('error-msg')) {
                    input.nextElementSibling.remove();
                }
            }

            // Live input validation
            [nameInput, locationInput, descInput].forEach(input => {
                input.addEventListener('input', () => {
                    input.value.trim() === '' ? showError(input, 'This field is required') : clearError(input);
                });
            });

            [categoryInput, dateInput].forEach(input => {
                input.addEventListener('change', () => {
                    input.value === '' ? showError(input, 'This field is required') : clearError(input);
                });
            });

            // Form submission
            foundForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                // final check
                let valid = true;
                [nameInput, categoryInput, dateInput, locationInput, descInput, phoneInput].forEach(input => {
                    if (input.value.trim() === '' || (input === phoneInput && !/^(\+977)?9\d{9}$/.test(phoneInput.value.trim()))) {
                        showError(input, 'This field is required or invalid');
                        valid = false;
                    } else clearError(input);
                });

                if (!valid) return; // stop submission if invalid

                // Now you can do your API call or submit
                const formData = {
                    action: 'create',
                    type: 'found',
                    name: nameInput.value.trim(),
                    category_id: categoryInput.value,
                    date_lost_found: dateInput.value,
                    location: locationInput.value.trim(),
                    description: descInput.value.trim(),
                    contact_phone: phoneInput.value.trim()
                };

                if (fileInput.files[0]) formData.image = fileInput.files[0];

                const result = await apiCall('items.php', formData); // your function
                if (result.success) {
                    showToast('Found item reported successfully!');
                    foundForm.reset();
                    closeModal('foundModal');
                    loadItems();
                } else {
                    showToast(result.message, 'error');
                }
            });

        });
    </script>

</body>

</html>