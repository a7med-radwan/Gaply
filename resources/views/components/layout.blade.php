<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Gaply' }}</title>

    {{-- Premium Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap"
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
                        darkBg: '#050811',
                        darkCard: '#0c1220',
                        darkBorder: '#1f2937',
                        oceanBlue: '#38bdf8',
                        oceanHover: '#0ea5e9',
                        accentTeal: '#0ea5e9',
                        textPrimary: '#ffffff',
                        textSecondary: '#94a3b8'
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
        body {
            font-family: 'Inter', sans-serif;
            background-color: #050811;
            color: #ffffff;
        }

        .font-display {
            font-family: 'Outfit', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 500, 'GRAD' 0, 'opsz' 22;
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

        <button id="mobile-menu-toggle" class="p-2 rounded-xl text-textSecondary hover:text-white transition-colors">
            <span class="material-symbols-outlined text-2xl" id="menu-icon">menu</span>
        </button>
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
            </div>

            <!-- Nav List -->
            <nav class="space-y-1.5">
                <p class="text-xs font-mono font-bold uppercase tracking-widest text-textSecondary/40 mb-3 px-3">
                    Navigation</p>

                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-oceanBlue text-white shadow-premium' : 'text-textSecondary hover:text-white hover:bg-darkBg/50' }}">
                    <span class="material-symbols-outlined text-lg">space_dashboard</span>
                    Dashboard
                </a>

                <a href="{{ route('profile.show') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 group {{ request()->routeIs('profile.*') ? 'bg-oceanBlue text-white shadow-premium' : 'text-textSecondary hover:text-white hover:bg-darkBg/50' }}">
                    <span class="material-symbols-outlined text-lg">person</span>
                    My Profile
                </a>

                <a href="{{ route('skills.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 group {{ request()->routeIs('skills.*') ? 'bg-oceanBlue text-white shadow-premium' : 'text-textSecondary hover:text-white hover:bg-darkBg/50' }}">
                    <span class="material-symbols-outlined text-lg">bolt</span>
                    My Skills
                </a>

            </nav>
        </div>

        <!-- User profile summary & logout -->
        <div class="p-4 border-t border-darkBorder/40 bg-darkBg/20 space-y-4">
            <div class="flex items-center gap-3 px-2">
                <img id="sidebar-avatar" src="{{ auth()->user()->profile_image ? Storage::url(auth()->user()->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=38bdf8&color=fff&size=100' }}"
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
    <main class="flex-1 min-w-0 flex flex-col min-h-screen lg:min-h-0 lg:h-screen lg:overflow-hidden">
        <div class="flex-1 p-4 md:p-6 lg:p-8 max-w-7xl w-full mx-auto lg:h-full lg:overflow-hidden">
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
    </script>
</body>

</html>