<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - I Found</title>
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

        .input-error {
            border-color: #ef4444 !important;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-md fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="index.php" class="flex items-center space-x-2">
                        <i class="fas fa-search-location text-3xl text-purple-600"></i>
                        <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">I Found</span>
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.php" class="nav-link text-gray-700 font-medium transition">Home</a>
                    <a href="index.php#items" class="nav-link text-gray-700 font-medium transition">Browse Items</a>
                    <a href="index.php#how-it-works" class="nav-link text-gray-700 font-medium transition">How It Works</a>
                    <a href="contact.php" class="nav-link text-purple-600 font-medium transition">Contact</a>
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
                <a href="index.php" class="block text-gray-700 font-medium">Home</a>
                <a href="index.php#items" class="block text-gray-700 font-medium">Browse Items</a>
                <a href="index.php#how-it-works" class="block text-gray-700 font-medium">How It Works</a>
                <a href="contact.php" class="block text-purple-600 font-medium">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-gradient pt-24 pb-16 md:pt-32 md:pb-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">Get In Touch</h1>
            <p class="text-white/90 text-lg md:text-xl max-w-2xl mx-auto">
                Have questions or need help? We're here for you!
            </p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Contact Information</h2>
                    <p class="text-gray-600 mb-8">Fill out the form and our team will get back to you within 24 hours.</p>

                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-purple-600"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-semibold text-gray-800">Address</h4>
                                <p class="text-gray-600">Kathmandu, Nepal</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-envelope text-blue-600"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-semibold text-gray-800">Email</h4>
                                <p class="text-gray-600">support@ifound.com</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-phone text-green-600"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-semibold text-gray-800">Phone</h4>
                                <p class="text-gray-600">9761791235</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="font-semibold text-gray-800 mb-4">Follow Us</h4>
                        <div class="flex space-x-4">
                            <a target="_blank" href="https://www.facebook.com/share/1DJKYkUuh3/" class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 hover:bg-purple-600 hover:text-white transition">
                                <i class="fab fa-facebook"></i>
                            </a>
                            <a target="_blank" href="https://x.com/" class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a target="_blank" href="https://www.instagram.com/soni_yathapa18" class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center text-pink-600 hover:bg-pink-600 hover:text-white transition">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a target="_blank" href="https://www.linkedin.com/feed/" class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-700 hover:bg-blue-700 hover:text-white transition">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="bg-gray-50 rounded-2xl p-8 shadow-lg">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">Send Us a Message</h3>
                        <form id="contactForm" onsubmit="submitContactForm(event)">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Your Name <span class="text-red-500">*</span></label>
                                    <input type="text" name="name" placeholder="John Doe" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none" required oninput="validateReviewName(this)">
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Your Email <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" placeholder="john@example.com" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 font-medium mb-2">Subject <span class="text-red-500">*</span></label>
                                <input type="text" name="subject" placeholder="How can we help you?" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none" required>
                            </div>
                            <div class="mb-6">
                                <label class="block text-gray-700 font-medium mb-2">Message <span class="text-red-500">*</span></label>
                                <textarea name="message" placeholder="Your message..." rows="5" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none resize-none" required minlength="20"></textarea>
                                <p class="text-xs text-gray-500 mt-1">Minimum 20 characters</p>
                            </div>
                            <button type="submit" class="btn-primary text-white px-8 py-3 rounded-xl font-semibold w-full transition transform hover:scale-105">
                                <i class="fas fa-paper-plane mr-2"></i>Send Message
                            </button>
                        </form>
                    </div>
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
                        <a href="#" class="text-gray-400 hover:text-purple-400 transition"><i class="fab fa-facebook text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-purple-400 transition"><i class="fab fa-twitter text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-purple-400 transition"><i class="fab fa-instagram text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-purple-400 transition"><i class="fab fa-linkedin text-xl"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="font-semibold text-lg mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Home</a></li>
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
        <div class="bg-white rounded-2xl p-8 w-full max-w-md mx-4">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800">Welcome Back!</h3>
                <button onclick="closeModal('loginModal')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form onsubmit="login(event)">
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Email <span class="text-red-500">*</span></label>
                    <input type="email" placeholder="your.email@example.com" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Password <span class="text-red-500">*</span></label>
                    <input type="password" placeholder="Enter your password" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none" required>
                </div>
                <div class="flex justify-between items-center mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" class="mr-2">
                        <span class="text-gray-600">Remember me</span>
                    </label>
                </div>
                <button type="submit" class="btn-primary text-white w-full py-3 rounded-xl font-semibold">Login</button>
                <p class="text-center text-gray-600 mt-4">
                    Don't have an account?
                    <a href="#" onclick="switchModal('loginModal', 'registerModal')" class="text-purple-600 font-medium hover:underline">Sign Up</a>
                </p>
            </form>
        </div>
    </div>

    <!-- Register Modal -->
    <div id="registerModal" class="modal fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-8 w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800">Create Account</h3>
                <button onclick="closeModal('registerModal')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form onsubmit="register(event)">
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">First Name <span class="text-red-500">*</span></label>
                        <input type="text" id="registerFirstName" placeholder="John" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Last Name <span class="text-red-500">*</span></label>
                        <input type="text" id="registerLastName" placeholder="Doe" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Email <span class="text-red-500">*</span></label>
                    <input type="email" id="registerEmail" placeholder="john@example.com" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Phone</label>
                    <input type="tel" id="registerPhone" placeholder="9800000000" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Password <span class="text-red-500">*</span></label>
                    <input type="password" id="registerPassword" placeholder="Min 6 characters" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none" required minlength="6">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Confirm Password <span class="text-red-500">*</span></label>
                    <input type="password" id="registerConfirmPassword" placeholder="Confirm password" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none" required minlength="6">
                </div>
                <button type="submit" class="btn-primary text-white w-full py-3 rounded-xl font-semibold">Create Account</button>
                <p class="text-center text-gray-600 mt-4">
                    Already have an account?
                    <a href="#" onclick="switchModal('registerModal', 'loginModal')" class="text-purple-600 font-medium hover:underline">Login</a>
                </p>
            </form>
        </div>
    </div>

    <script>
        const API_BASE = 'api/';
        let currentUser = null;

        async function apiCall(endpoint, data = {}) {
            try {
                const formData = new FormData();
                for (const key in data) {
                    formData.append(key, data[key]);
                }
                const response = await fetch(API_BASE + endpoint, {
                    method: 'POST',
                    body: formData
                });
                return await response.json();
            } catch (error) {
                return {
                    success: false,
                    message: 'Something occurred. Please try again.'
                };
            }
        }

        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `fixed top-20 right-4 px-6 py-3 rounded-lg shadow-lg z-50 transition-all transform translate-x-full ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            } text-white`;
            toast.innerHTML = `<i class="fas fa-${type === 'success' ? 'check' : 'exclamation'}-circle mr-2"></i>${message}`;
            document.body.appendChild(toast);
            setTimeout(() => toast.classList.remove('translate-x-full'), 100);
            setTimeout(() => {
                toast.classList.add('translate-x-full');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

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

        async function checkSession() {
            const result = await apiCall('auth.php', {
                action: 'check_session'
            });
            if (result.success && result.logged_in) {
                currentUser = result.user;
                document.getElementById('authButtons').innerHTML = `
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-700">${currentUser.name}</span>
                        <button onclick="logout()" class="text-red-600 hover:text-red-700">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </div>
                `;
            }
        }

        async function login(event) {
            event.preventDefault();
            const form = event.target;
            const result = await apiCall('auth.php', {
                action: 'login',
                email: form.querySelector('input[type="email"]').value,
                password: form.querySelector('input[type="password"]').value
            });
            if (result.success) {
                showToast('Login successful!');
                closeModal('loginModal');
                location.reload();
            } else {
                showToast(result.message, 'error');
            }
        }

        async function register(event) {
            event.preventDefault();
            const password = document.getElementById('registerPassword').value;
            const confirmPassword = document.getElementById('registerConfirmPassword').value;
            if (password !== confirmPassword) {
                showToast('Passwords do not match', 'error');
                return;
            }
            const result = await apiCall('auth.php', {
                action: 'register',
                first_name: document.getElementById('registerFirstName').value,
                last_name: document.getElementById('registerLastName').value,
                email: document.getElementById('registerEmail').value,
                phone: document.getElementById('registerPhone').value,
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
            await apiCall('auth.php', {
                action: 'logout'
            });
            location.reload();
        }

        async function submitContactForm(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            const result = await apiCall('contact.php', {
                action: 'send',
                name: formData.get('name'),
                email: formData.get('email'),
                subject: formData.get('subject'),
                message: formData.get('message')
            });
            if (result.success) {
                showToast('Message sent successfully!');
                event.target.reset();
            } else {
                showToast(result.message || 'Failed to send message', 'error');
            }
        }

        async function subscribeNewsletter(event) {
            event.preventDefault();
            const email = event.target.querySelector('input[type="email"]').value;
            const result = await apiCall('contact.php', {
                action: 'subscribe',
                email: email
            });
            if (result.success) {
                showToast('Subscribed successfully!');
                event.target.reset();
            } else {
                showToast(result.message || 'Subscription failed', 'error');
            }
        }

        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.getElementById(modalId).classList.add('flex');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.getElementById(modalId).classList.remove('flex');
        }

        function switchModal(from, to) {
            closeModal(from);
            setTimeout(() => openModal(to), 200);
        }

        function toggleMobileMenu() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        }

        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeModal(modal.id);
            });
        });

        document.addEventListener('DOMContentLoaded', checkSession);
    </script>
</body>

</html>