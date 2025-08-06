<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Kantinku')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/lucide@0.263.1/dist/umd/lucide.js" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <style>
        :root {
            /* Core Colors */
            --color-white: #ffffff;
            --color-black: #0a0a0a;
            --color-gray-50: #fafafa;
            --color-gray-100: #f5f5f5;
            --color-gray-200: #e5e5e5;
            --color-gray-300: #d4d4d4;
            --color-gray-400: #a3a3a3;
            --color-gray-500: #737373;
            --color-gray-600: #525252;
            --color-gray-700: #404040;
            --color-gray-800: #262626;
            --color-gray-900: #171717;

            /* Brand Colors */
            --color-primary: #18181b;
            --color-accent: #f97316;
            --color-accent-hover: #ea580c;

            /* Status Colors */
            --color-success: #10b981;
            --color-warning: #f59e0b;
            --color-error: #ef4444;
            --color-info: #3b82f6;

            /* Typography */
            --font-sans: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;

            /* Spacing */
            --space-1: 0.25rem;
            --space-2: 0.5rem;
            --space-3: 0.75rem;
            --space-4: 1rem;
            --space-5: 1.25rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-10: 2.5rem;
            --space-12: 3rem;

            /* Radius */
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;

            /* Shadows */
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            font-size: 16px;
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-sans);
            font-weight: 400;
            line-height: 1.6;
            color: var(--color-gray-800);
            background-color: var(--color-gray-50);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Navigation */
        .navbar {
            background: var(--color-white);
            border-bottom: 1px solid var(--color-gray-200);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 50;
            backdrop-filter: blur(8px);
            background-color: rgba(255, 255, 255, 0.95);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: var(--space-4) var(--space-6);
            gap: var(--space-8);
        }

        .nav-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--color-primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: var(--space-2);
        }

        .nav-brand:hover {
            color: var(--color-accent);
            text-decoration: none;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: var(--space-6);
            list-style: none;
        }

        .nav-link {
            color: var(--color-gray-600);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.875rem;
            padding: var(--space-2) var(--space-3);
            border-radius: var(--radius-md);
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: var(--space-2);
        }

        .nav-link:hover {
            color: var(--color-primary);
            background-color: var(--color-gray-100);
            text-decoration: none;
        }

        .nav-link.active {
            color: var(--color-accent);
            background-color: rgba(249, 115, 22, 0.1);
        }

        .search-form {
            display: flex;
            gap: var(--space-2);
            max-width: 320px;
            width: 100%;
        }

        .search-input {
            flex: 1;
            padding: var(--space-3) var(--space-4);
            border: 1px solid var(--color-gray-300);
            border-radius: var(--radius-md);
            font-size: 0.875rem;
            background: var(--color-white);
            transition: all 0.2s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--color-accent);
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
        }

        .search-input::placeholder {
            color: var(--color-gray-400);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: var(--space-4);
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: var(--space-2);
            padding: var(--space-3) var(--space-4);
            border: none;
            border-radius: var(--radius-md);
            font-weight: 500;
            font-size: 0.875rem;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .btn-primary {
            background-color: var(--color-accent);
            color: var(--color-white);
        }

        .btn-primary:hover {
            background-color: var(--color-accent-hover);
            color: var(--color-white);
            text-decoration: none;
        }

        .btn-secondary {
            background-color: var(--color-white);
            color: var(--color-gray-700);
            border: 1px solid var(--color-gray-300);
        }

        .btn-secondary:hover {
            background-color: var(--color-gray-50);
            color: var(--color-gray-800);
            text-decoration: none;
        }

        .btn-ghost {
            background-color: transparent;
            color: var(--color-gray-600);
            border: 1px solid transparent;
        }

        .btn-ghost:hover {
            background-color: var(--color-gray-100);
            color: var(--color-gray-700);
            text-decoration: none;
        }

        .btn-sm {
            padding: var(--space-2) var(--space-3);
            font-size: 0.8125rem;
        }

        /* Main Content */
        .main-container {
            flex: 1;
            max-width: 1200px;
            margin: 0 auto;
            padding: var(--space-8) var(--space-6);
            width: 100%;
        }

        .page-header {
            margin-bottom: var(--space-8);
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--color-primary);
            margin-bottom: var(--space-2);
        }

        .page-subtitle {
            color: var(--color-gray-600);
            font-size: 1rem;
        }

        /* Cards */
        .card {
            background: var(--color-white);
            border: 1px solid var(--color-gray-200);
            border-radius: var(--radius-lg);
            padding: var(--space-6);
            box-shadow: var(--shadow-sm);
            transition: all 0.2s ease;
        }

        .card:hover {
            box-shadow: var(--shadow-md);
            border-color: var(--color-gray-300);
        }

        .card-header {
            margin-bottom: var(--space-4);
            padding-bottom: var(--space-4);
            border-bottom: 1px solid var(--color-gray-200);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--color-primary);
            margin-bottom: var(--space-1);
        }

        .card-description {
            color: var(--color-gray-600);
            font-size: 0.875rem;
        }

        /* Alerts */
        .alert {
            padding: var(--space-4);
            border-radius: var(--radius-md);
            border: 1px solid transparent;
            margin-bottom: var(--space-4);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: var(--space-3);
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            color: #065f46;
            border-color: rgba(16, 185, 129, 0.2);
        }

        .alert-error {
            background-color: rgba(239, 68, 68, 0.1);
            color: #991b1b;
            border-color: rgba(239, 68, 68, 0.2);
        }

        .alert-warning {
            background-color: rgba(245, 158, 11, 0.1);
            color: #92400e;
            border-color: rgba(245, 158, 11, 0.2);
        }

        .alert-info {
            background-color: rgba(59, 130, 246, 0.1);
            color: #1e3a8a;
            border-color: rgba(59, 130, 246, 0.2);
        }

        /* Tables */
        .table-container {
            background: var(--color-white);
            border-radius: var(--radius-lg);
            border: 1px solid var(--color-gray-200);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            background: var(--color-gray-50);
            padding: var(--space-4);
            text-align: left;
            font-weight: 600;
            color: var(--color-gray-700);
            font-size: 0.875rem;
            border-bottom: 1px solid var(--color-gray-200);
        }

        .table td {
            padding: var(--space-4);
            border-bottom: 1px solid var(--color-gray-100);
            font-size: 0.875rem;
        }

        .table tbody tr:hover {
            background-color: var(--color-gray-50);
        }

        /* Forms */
        .form-group {
            margin-bottom: var(--space-6);
        }

        .form-label {
            display: block;
            font-weight: 500;
            color: var(--color-gray-700);
            margin-bottom: var(--space-2);
            font-size: 0.875rem;
        }

        .form-input {
            width: 100%;
            padding: var(--space-3) var(--space-4);
            border: 1px solid var(--color-gray-300);
            border-radius: var(--radius-md);
            font-size: 0.875rem;
            background: var(--color-white);
            transition: all 0.2s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--color-accent);
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
        }

        /* Footer */
        .footer {
            background: var(--color-white);
            border-top: 1px solid var(--color-gray-200);
            padding: var(--space-8) 0;
            margin-top: auto;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--space-6);
            text-align: center;
        }

        .footer-text {
            color: var(--color-gray-600);
            font-size: 0.875rem;
        }

        /* Bootstrap Modal Overrides */
        .modal {
            z-index: 1050;
        }

        .modal-backdrop {
            z-index: 1040;
        }

        .modal-content {
            border: none;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-xl);
        }

        .modal-header {
            border-bottom: 1px solid var(--color-gray-200);
            padding: var(--space-6);
        }

        .modal-body {
            padding: var(--space-6);
        }

        .modal-footer {
            border-top: 1px solid var(--color-gray-200);
            padding: var(--space-6);
        }

        .modal-title {
            color: var(--color-primary);
            font-weight: 600;
        }

        /* Mobile Menu */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: var(--color-gray-600);
            cursor: pointer;
            padding: var(--space-2);
        }

        .mobile-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: var(--color-white);
            border-top: 1px solid var(--color-gray-200);
            box-shadow: var(--shadow-lg);
        }

        .mobile-menu.active {
            display: block;
        }

        .mobile-nav-menu {
            list-style: none;
            padding: var(--space-4);
        }

        .mobile-nav-menu li {
            margin-bottom: var(--space-2);
        }

        .mobile-nav-link {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            padding: var(--space-3);
            color: var(--color-gray-700);
            text-decoration: none;
            border-radius: var(--radius-md);
            transition: all 0.2s ease;
        }

        .mobile-nav-link:hover {
            background-color: var(--color-gray-100);
            color: var(--color-primary);
            text-decoration: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-container {
                padding: var(--space-4);
                position: relative;
            }

            .nav-menu {
                display: none;
            }

            .search-form {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .main-container {
                padding: var(--space-6) var(--space-4);
            }

            .page-title {
                font-size: 1.5rem;
            }

            .card {
                padding: var(--space-4);
            }

            .table-container {
                overflow-x: auto;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.3s ease-out;
        }

        /* Utility Classes */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .text-right { text-align: right; }

        .mb-0 { margin-bottom: 0; }
        .mb-2 { margin-bottom: var(--space-2); }
        .mb-4 { margin-bottom: var(--space-4); }
        .mb-6 { margin-bottom: var(--space-6); }
        .mb-8 { margin-bottom: var(--space-8); }

        .flex { display: flex; }
        .flex-col { flex-direction: column; }
        .items-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .gap-2 { gap: var(--space-2); }
        .gap-4 { gap: var(--space-4); }
        .gap-6 { gap: var(--space-6); }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <!-- Brand -->
            <a href="/" class="nav-brand">
                <i data-lucide="utensils" size="24"></i>
                Kantinku
            </a>

            <!-- Desktop Menu -->
            <ul class="nav-menu">
                @if(auth()->check())
                    <li>
                        @php
                            $dashboard = match(auth()->user()->role) {
                                'administrator' => '/admin/dashboard',
                                'toko' => '/toko/dashboard',
                                'siswa' => '/siswa/dashboard',
                                'bankmini' => '/bankmini/dashboard',
                                default => '/'
                            };
                        @endphp
                        <a href="{{ $dashboard }}" class="nav-link">
                            <i data-lucide="layout-dashboard" size="16"></i>
                            Dashboard
                        </a>
                    </li>
                @endif
            </ul>

            <!-- Search Form -->
            <form class="search-form" method="GET" action="/">
                <input
                    type="search"
                    name="q"
                    class="search-input"
                    placeholder="Cari makanan favorit..."
                    value="{{ request('q') }}"
                >
                <button type="submit" class="btn btn-primary btn-sm">
                    <i data-lucide="search" size="16"></i>
                </button>
            </form>

            <!-- Actions -->
            <div class="nav-actions">
                @if(auth()->check())
                    <form action="/logout" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="btn btn-ghost btn-sm">
                            <i data-lucide="log-out" size="16"></i>
                            Keluar
                        </button>
                    </form>
                @else
                    <a href="/login" class="btn btn-primary btn-sm">
                        <i data-lucide="log-in" size="16"></i>
                        Masuk
                    </a>
                @endif
            </div>

            <!-- Mobile Menu Button -->
            <button class="mobile-menu-btn" onclick="toggleMobileMenu()">
                <i data-lucide="menu" size="24"></i>
            </button>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="mobile-menu">
                <ul class="mobile-nav-menu">
                    @if(auth()->check())
                        <li>
                            <a href="{{ $dashboard }}" class="mobile-nav-link">
                                <i data-lucide="layout-dashboard" size="18"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <form action="/logout" method="POST" class="block">
                                @csrf
                                <button type="submit" class="mobile-nav-link w-full text-left">
                                    <i data-lucide="log-out" size="18"></i>
                                    Keluar
                                </button>
                            </form>
                        </li>
                    @else
                        <li>
                            <a href="/login" class="mobile-nav-link">
                                <i data-lucide="log-in" size="18"></i>
                                Masuk
                            </a>
                        </li>
                    @endif
                </ul>
                <!-- Mobile Search -->
                <div style="padding: var(--space-4); border-top: 1px solid var(--color-gray-200);">
                    <form method="GET" action="/">
                        <div class="flex gap-2">
                            <input
                                type="search"
                                name="q"
                                class="form-input"
                                placeholder="Cari makanan..."
                                value="{{ request('q') }}"
                            >
                            <button type="submit" class="btn btn-primary">
                                <i data-lucide="search" size="16"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-container fade-in">
        @if(request()->path() !== '/')
            <button class="btn btn-secondary mb-6" onclick="history.back()">
                <i data-lucide="arrow-left" size="16"></i>
                Kembali
            </button>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <p class="footer-text">
                &copy; {{ date('Y') }} Kantinku. Semua hak dilindungi.
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Mobile menu toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('active');
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const menu = document.getElementById('mobileMenu');
            const button = document.querySelector('.mobile-menu-btn');

            if (!menu.contains(event.target) && !button.contains(event.target)) {
                menu.classList.remove('active');
            }
        });

        // Fix modal accessibility issues
        document.addEventListener('DOMContentLoaded', function() {
            // Handle modal focus management
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                modal.addEventListener('shown.bs.modal', function() {
                    // Remove aria-hidden when modal is shown
                    this.removeAttribute('aria-hidden');
                });

                modal.addEventListener('hidden.bs.modal', function() {
                    // Add aria-hidden when modal is hidden
                    this.setAttribute('aria-hidden', 'true');
                });

                // Initial state
                if (!modal.classList.contains('show')) {
                    modal.setAttribute('aria-hidden', 'true');
                }
            });
        });

        // Smooth scroll for internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
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
    </script>
</body>
</html>
