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
             background: linear-gradient(135deg, #4d7fad 0%, #3777c0 100%);
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
             color: #667eea;
         }

         .btn-primary {
             background: linear-gradient(135deg, #667eea 0%, #3777c0 100%);
         }

         .btn-primary:hover {
             background: linear-gradient(135deg, #5a6fd6 0%, #6a4190 100%);
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
             background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
 </head>

 <body class="bg-gray-50">
     <!-- Navigation -->
     <nav class="bg-white shadow-md fixed w-full top-0 z-50">
         <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
             <div class="flex justify-between items-center h-16">
                 <div class="flex items-center">
                     <a href="#" class="flex items-center space-x-2">
                         <i class="fas fa-search-location text-3xl text-purple-600"></i>
                         <span class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">I Found</span>
                     </a>
                 </div>

                 <div class="hidden md:flex items-center space-x-8">
                     <a href="index.php" class="nav-link text-gray-700 font-medium transition">Home</a>
                     <a href="howitworks.php" class="nav-link text-gray-700 font-medium transition">How It Works</a>
                     <a href="contact.php" class="nav-link text-gray-700 font-medium transition">Contact</a>
                 </div>

                 <div id="authButtons" class="flex items-center space-x-4">
                     <button onclick="openModal('loginModal')" class="text-gray-700 font-medium hover:text-purple-600 transition">Login</button>
                     <button onclick="openModal('registerModal')" class="btn-primary text-white px-5 py-2 rounded-full font-medium transition transform hover:scale-105">Sign Up</button>
                 </div>
     </nav>
     <!-- Mobile menu button -->
     <button class="md:hidden" onclick="toggleMobileMenu()">
         <i class="fas fa-bars text-2xl text-gray-700"></i>
     </button>
     </div>
     </div>
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
                         <li><a href="#" class="text-gray-400 hover:text-white transition">Home</a></li>
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