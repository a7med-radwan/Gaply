<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Gaply' }}</title>

    {{-- Prevent theme flash --}}
    <script>
        const savedTheme = localStorage.getItem('theme') || 'dark';
        if (savedTheme === 'light') {
            document.documentElement.classList.add('light');
        } else {
            document.documentElement.classList.remove('light');
        }
    </script>

    {{-- Premium Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap&font-display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        rel="stylesheet">

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        darkBg: '#080d1a',
                        darkCard: '#111a2e',
                        darkBorder: '#25334d',
                        oceanBlue: '#38bdf8',
                        oceanHover: '#0ea5e9',
                        accentTeal: '#0ea5e9',
                        textPrimary: '#ffffff',
                        textSecondary: '#cbd5e1'
                    },
                    fontFamily: {
                        sans: ['"Inter"', 'sans-serif'],
                        display: ['"Outfit"', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace']
                    },
                    boxShadow: {
                        premium: '0 0 50px -12px rgba(56, 189, 248, 0.2)',
                        glowBlue: '0 0 20px rgba(56, 189, 248, 0.25)'
                    }
                }
            }
        }
    </script>

    <style>
        :root {
            --bg-primary: #080d1a;
            --bg-card: #111a2e;
            --bg-darkBg: #080d1a;
            --border-primary: #25334d;
            --text-primary: #ffffff;
            --text-secondary: #cbd5e1;
        }

        html.light {
            --bg-primary: #f8fafc;
            --bg-card: #ffffff;
            --bg-darkBg: #f1f5f9;
            --border-primary: #cbd5e1;
            --text-primary: #0f172a;
            --text-secondary: #475569;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at 15% 15%, rgba(14, 165, 233, 0.08) 0%, transparent 45%),
                        radial-gradient(circle at 85% 85%, rgba(14, 165, 233, 0.05) 0%, transparent 55%),
                        var(--bg-primary);
            background-attachment: fixed;
            color: var(--text-primary);
            transition: background 0.3s ease, color 0.2s ease;
        }

        .font-display {
            font-family: 'Outfit', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 500, 'GRAD' 0, 'opsz' 22;
        }

        /* Light Mode Specific Overrides */
        html.light body {
            background: var(--bg-primary) !important;
            color: var(--text-primary) !important;
        }

        html.light .text-white {
            color: var(--text-primary) !important;
        }

        html.light .bg-darkBg {
            background-color: var(--bg-darkBg) !important;
        }

        html.light .bg-darkCard {
            background-color: var(--bg-card) !important;
        }

        html.light .border-darkBorder {
            border-color: var(--border-primary) !important;
        }

        html.light .text-textSecondary {
            color: var(--text-secondary) !important;
        }

        /* Opacities & Hover Overrides */
        html.light [class*="border-darkBorder/"] {
            border-color: var(--border-primary) !important;
        }
        html.light [class*="bg-darkBg/"] {
            background-color: var(--bg-darkBg) !important;
        }
        html.light [class*="bg-darkCard/"] {
            background-color: var(--bg-card) !important;
        }

        /* Gradient variables override for Light Mode */
        html.light .from-darkCard {
            --tw-gradient-from: var(--bg-card) var(--tw-gradient-from-position) !important;
            --tw-gradient-to: rgba(241, 245, 249, 0) var(--tw-gradient-to-position) !important;
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to) !important;
        }
        html.light .to-darkCard\/30 {
            --tw-gradient-to: rgba(241, 245, 249, 0.3) var(--tw-gradient-to-position) !important;
        }

        html.light .hover\:text-white:hover {
            color: var(--text-primary) !important;
        }
        html.light .hover\:bg-darkBg\/50:hover {
            background-color: rgba(241, 245, 249, 0.6) !important;
        }

        /* Input / Select / Textarea style overrides for Light Mode */
        html.light input, 
        html.light select, 
        html.light textarea {
            background-color: var(--bg-card) !important;
            color: var(--text-primary) !important;
            border-color: var(--border-primary) !important;
        }

        html.light input::placeholder,
        html.light textarea::placeholder {
            color: #94a3b8 !important;
        }

        /* SVG Circle progress override */
        html.light svg circle[stroke="#1c2538"],
        html.light svg circle[stroke="#111827"] {
            stroke: var(--border-primary) !important;
        }
        html.light svg circle[stroke="#38bdf8"] {
            stroke: #0284c7 !important;
        }

        /* Shadow overrides for light mode cards */
        html.light .shadow-xl {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -4px rgba(0, 0, 0, 0.05) !important;
        }

        html.light .text-white\/50 {
            color: rgba(15, 23, 42, 0.6) !important;
        }
        html.light .text-textSecondary\/70 {
            color: rgba(71, 85, 105, 0.7) !important;
        }
        html.light .text-textSecondary\/65 {
            color: rgba(71, 85, 105, 0.65) !important;
        }
        html.light .text-textSecondary\/50 {
            color: rgba(71, 85, 105, 0.5) !important;
        }
        html.light .text-textSecondary\/60 {
            color: rgba(71, 85, 105, 0.6) !important;
        }
    </style>
</head>

<body class="h-full flex flex-col lg:flex-row bg-darkBg text-white antialiased">

    <!-- MOBILE TOP HEADER -->
    <header
        class="lg:hidden w-full flex items-center justify-between px-6 py-4 bg-darkCard border-b border-darkBorder sticky top-0 z-40">
        <a href="/" class="flex items-center gap-3">
            <div
                class="w-8 h-8 rounded-xl flex items-center justify-center text-white font-black text-sm bg-gradient-to-br from-oceanBlue to-[#1e40af]">
                G
            </div>
            <span class="font-display font-black text-xl tracking-tight text-white">Gaply</span>
        </a>

        <div class="flex items-center gap-2">
            <!-- Theme Toggler Button Mobile -->
            <button id="theme-toggle-mobile" class="p-2 rounded-xl text-textSecondary hover:text-white transition-colors">
                <span class="material-symbols-outlined text-xl" id="theme-icon-mobile">light_mode</span>
            </button>

            <button id="mobile-menu-toggle" class="p-2 rounded-xl text-textSecondary hover:text-white transition-colors">
                <span class="material-symbols-outlined text-2xl" id="menu-icon">menu</span>
            </button>
        </div>
    </header>

    <!-- SIDEBAR NAVIGATION -->
    <aside id="sidebar"
        class="w-64 bg-darkCard border-r border-darkBorder/40 flex flex-col justify-between fixed inset-y-0 left-0 z-30 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out lg:static lg:h-screen">

        <div class="flex flex-col gap-8 py-6 px-6">
            <!-- Brand Logo -->
            <div class="flex items-center justify-between">
                <a href="/" class="flex items-center gap-3 group">
                    <div
                        class="w-9 h-9 rounded-xl flex items-center justify-center text-white font-black text-base bg-gradient-to-br from-oceanBlue to-[#1e40af] shadow-md shadow-oceanBlue/20">
                        G
                    </div>
                    <span
                        class="font-display font-black text-2xl tracking-tight text-white group-hover:text-oceanBlue transition-colors duration-300">Gaply</span>
                </a>

                <!-- Theme Toggler Button Desktop -->
                <button id="theme-toggle" class="p-2 rounded-xl text-textSecondary hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-xl" id="theme-icon">light_mode</span>
                </button>
            </div>

            <!-- Nav List -->
            <nav class="space-y-1.5">
                <p class="text-xs font-mono font-bold uppercase tracking-widest text-textSecondary/40 mb-3 px-3">
                    Navigation</p>

                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-semibold transition-all duration-150
                        {{ request()->routeIs('dashboard') ? 'text-white bg-darkBg/60 border-l-2 border-oceanBlue' : 'text-textSecondary hover:text-white hover:bg-darkBg/40' }}">
                    <span class="material-symbols-outlined text-lg">space_dashboard</span>
                    Dashboard
                </a>

                <a href="{{ route('profile.show') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-semibold transition-all duration-150
                        {{ request()->routeIs('profile.*') ? 'text-white bg-darkBg/60 border-l-2 border-oceanBlue' : 'text-textSecondary hover:text-white hover:bg-darkBg/40' }}">
                    <span class="material-symbols-outlined text-lg">person</span>
                    My Profile
                </a>

                <a href="{{ route('skills.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-semibold transition-all duration-150
                        {{ request()->routeIs('skills.*') ? 'text-white bg-darkBg/60 border-l-2 border-oceanBlue' : 'text-textSecondary hover:text-white hover:bg-darkBg/40' }}">
                    <span class="material-symbols-outlined text-lg">bolt</span>
                    My Skills
                </a>

                <a href="{{ route('career-plan.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-semibold transition-all duration-150
                        {{ request()->routeIs('career-plan.index') ? 'text-white bg-darkBg/60 border-l-2 border-accentTeal' : 'text-textSecondary hover:text-white hover:bg-darkBg/40' }}">
                    <span class="material-symbols-outlined text-lg">analytics</span>
                    Career Plan
                </a>

                <a href="{{ route('career-plan.missing-skills') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-semibold transition-all duration-150
                        {{ request()->routeIs('career-plan.missing-skills') ? 'text-white bg-darkBg/60 border-l-2 border-oceanBlue' : 'text-textSecondary hover:text-white hover:bg-darkBg/40' }}">
                    <span class="material-symbols-outlined text-lg">running_with_errors</span>
                    Missing Skills
                </a>

            </nav>
        </div>

        <!-- User profile summary & logout -->
        <div class="p-4 border-t border-darkBorder/40 bg-darkBg/20 space-y-4">
            <div class="flex items-center gap-3 px-2">
                <img id="sidebar-avatar" src="{{ auth()->user()->profile_image ? (str_starts_with(auth()->user()->profile_image, 'http') ? auth()->user()->profile_image : Storage::url(auth()->user()->profile_image)) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=38bdf8&color=fff&size=100' }}"
                    alt="{{ auth()->user()->name }}" class="w-9 h-9 rounded-full object-cover border border-darkBorder">
                <div class="min-w-0">
                    <p class="text-xs font-bold text-white truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-textSecondary truncate">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl text-xs font-bold border border-darkBorder text-textSecondary hover:text-white hover:border-red-500/40 hover:bg-red-500/5 transition-all">
                    <span class="material-symbols-outlined text-base">logout</span>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- BACKDROP FOR MOBILE SIDEBAR -->
    <div id="sidebar-backdrop" class="fixed inset-0 bg-black/60 z-20 hidden lg:hidden"></div>

    <!-- MAIN CONTENT CONTAINER -->
    <main class="flex-1 min-w-0 flex flex-col min-h-screen lg:min-h-0 lg:h-screen lg:overflow-y-auto">
        <div class="flex-1 p-4 md:p-6 lg:p-8 max-w-7xl w-full mx-auto min-h-0">
            {{ $slot }}
        </div>
    </main>

    <!-- FLOATING TOAST ALERTS CONTAINER -->
    <div class="fixed bottom-6 right-6 z-50 flex flex-col gap-3 max-w-sm w-full pointer-events-none">

        {{-- Success Toast --}}
        @if (session('success'))
            <div id="toast-success"
                class="pointer-events-auto flex items-start gap-3 p-4 rounded-2xl border border-accentTeal/20 bg-darkCard/90 text-sm shadow-2xl shadow-accentTeal/5 border-l-4 border-l-accentTeal animate-slide-in">
                <span class="material-symbols-outlined text-accentTeal">check_circle</span>
                <div class="flex-1">
                    <p class="font-bold text-white">Success</p>
                    <p class="text-xs text-textSecondary mt-0.5">{{ session('success') }}</p>
                </div>
                <button onclick="document.getElementById('toast-success').remove()"
                    class="text-textSecondary hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-base">close</span>
                </button>
            </div>
        @endif

        {{-- Status Toast --}}
        @if (session('status'))
            <div id="toast-status"
                class="pointer-events-auto flex items-start gap-3 p-4 rounded-2xl border border-oceanBlue/20 bg-darkCard/90 text-sm shadow-2xl shadow-oceanBlue/5 border-l-4 border-l-oceanBlue animate-slide-in">
                <span class="material-symbols-outlined text-oceanBlue">info</span>
                <div class="flex-1">
                    <p class="font-bold text-white">Notification</p>
                    <p class="text-xs text-textSecondary mt-0.5">{{ session('status') }}</p>
                </div>
                <button onclick="document.getElementById('toast-status').remove()"
                    class="text-textSecondary hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-base">close</span>
                </button>
            </div>
        @endif

        {{-- Errors Toast --}}
        @if ($errors->any() && !request()->routeIs('login') && !request()->routeIs('register') && !request()->routeIs('password.*'))
            <div id="toast-error"
                class="pointer-events-auto flex items-start gap-3 p-4 rounded-2xl border border-red-500/20 bg-darkCard/90 text-sm shadow-2xl shadow-red-500/5 border-l-4 border-l-red-500 animate-slide-in">
                <span class="material-symbols-outlined text-red-400">error</span>
                <div class="flex-1">
                    <p class="font-bold text-white">Execution Error</p>
                    <ul class="text-xs text-textSecondary list-disc list-inside mt-1 space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button onclick="document.getElementById('toast-error').remove()"
                    class="text-textSecondary hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-base">close</span>
                </button>
            </div>
        @endif

    </div>

    <!-- RESPONSIVE SIDEBAR SCRIPTS -->
    <script>
        const menuToggle = document.getElementById('mobile-menu-toggle');
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');
        const menuIcon = document.getElementById('menu-icon');

        function toggleSidebar() {
            const isOpen = sidebar.classList.contains('translate-x-0');
            if (isOpen) {
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('hidden');
                menuIcon.textContent = 'menu';
            } else {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                backdrop.classList.remove('hidden');
                menuIcon.textContent = 'close';
            }
        }

        menuToggle.addEventListener('click', toggleSidebar);
        backdrop.addEventListener('click', toggleSidebar);

        // Auto-dismiss toasts after 4.5 seconds
        ['toast-success', 'toast-status', 'toast-error'].forEach(id => {
            const el = document.getElementById(id);
            if (el) {
                setTimeout(() => {
                    el.style.transition = 'all 0.5s ease';
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(10px)';
                    setTimeout(() => el.remove(), 500);
                }, 4500);
            }
        });

        // Theme Toggle Script
        const themeToggle = document.getElementById('theme-toggle');
        const themeToggleMobile = document.getElementById('theme-toggle-mobile');
        const themeIcon = document.getElementById('theme-icon');
        const themeIconMobile = document.getElementById('theme-icon-mobile');
        const html = document.documentElement;

        function updateTogglerUI(theme) {
            if (theme === 'light') {
                if (themeIcon) themeIcon.textContent = 'dark_mode';
                if (themeIconMobile) themeIconMobile.textContent = 'dark_mode';
            } else {
                if (themeIcon) themeIcon.textContent = 'light_mode';
                if (themeIconMobile) themeIconMobile.textContent = 'light_mode';
            }
        }

        // Apply theme initially to triggers
        updateTogglerUI(localStorage.getItem('theme') || 'dark');

        function toggleTheme() {
            const isLight = html.classList.contains('light');
            if (isLight) {
                html.classList.remove('light');
                localStorage.setItem('theme', 'dark');
                updateTogglerUI('dark');
            } else {
                html.classList.add('light');
                localStorage.setItem('theme', 'light');
                updateTogglerUI('light');
            }
        }

        if (themeToggle) themeToggle.addEventListener('click', toggleTheme);
        if (themeToggleMobile) themeToggleMobile.addEventListener('click', toggleTheme);
    </script>
</body>

</html>