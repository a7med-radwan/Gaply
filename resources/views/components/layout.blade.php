<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Gaply — AI Career Path Bridge' }}</title>

    {{-- Premium Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://api.fontshare.com/v2/css?f[]=cabinet-grotesk@800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: 'var(--color-primary)',
                        success: 'var(--color-success)',
                        accent: 'var(--color-accent)',
                        appBg: 'var(--color-bg)',
                        surface: 'var(--color-surface)',
                        borderLine: 'var(--color-border)',
                        textPrimary: 'var(--color-text-primary)',
                        textSecondary: 'var(--color-text-secondary)',
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'Inter', 'sans-serif'],
                        display: ['"Cabinet Grotesk"', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    },
                    boxShadow: {
                        premium: '0 1px 3px rgba(0,0,0,0.05), 0 10px 30px -5px rgba(0,0,0,0.02)',
                        softGlow: '0 0 20px rgba(79, 70, 229, 0.15)',
                    }
                }
            }
        }
    </script>

    {{-- CSS variables --}}
    <style>
        :root {
            --color-primary:        #4F46E5; /* Deep Electric Indigo */
            --color-success:        #10B981; /* Cyber Mint */
            --color-accent:         #10B981;
            --color-bg:             #F9FAFB; /* Cool Light Gray */
            --color-surface:        #FFFFFF; /* Pure White */
            --color-border:         #E5E7EB; /* Subtle Soft Border */
            --color-text-primary:   #111827; /* Deep Slate Gray */
            --color-text-secondary: #4B5563; /* Descriptions */
            /* States */
            --color-success-bg:     #E6F4EA;
            --color-success-text:   #137333;
            --color-warning-bg:     #FEF7E0;
            --color-warning-text:   #B06000;
            --color-danger-bg:      #FCE8E6;
            --color-danger-text:    #C5221F;
            /* Sidebar Light */
            --sidebar-bg:           #FFFFFF;
            --sidebar-border:       #E5E7EB;
            --sidebar-text:         #4B5563;
            --sidebar-active-bg:    #EEF2FF;
            --sidebar-active-text:  #4F46E5;
        }

        .dark {
            --color-primary:        #6366F1; /* Lighter Indigo for Dark BG */
            --color-success:        #10B981; /* Cyber Mint */
            --color-accent:         #10B981;
            --color-bg:             #0B0F19; /* Deep Navy-Black */
            --color-surface:        #161F30; /* 3D Depth Card */
            --color-border:         #24324D; /* High-contrast clean border */
            --color-text-primary:   #F9FAFB; /* Crisp Off-white */
            --color-text-secondary: #9CA3AF; /* Muted Silver-gray */
            /* States */
            --color-success-bg:     rgba(16, 185, 129, 0.15);
            --color-success-text:   #34D399;
            --color-warning-bg:     rgba(245, 158, 11, 0.15);
            --color-warning-text:   #FBBF24;
            --color-danger-bg:      rgba(239, 68, 68, 0.15);
            --color-danger-text:    #F87171;
            /* Sidebar Dark */
            --sidebar-bg:           #0B0F19;
            --sidebar-border:       #24324D;
            --sidebar-text:         #9CA3AF;
            --sidebar-active-bg:    #161F30;
            --sidebar-active-text:  #F9FAFB;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--color-bg);
            color: var(--color-text-primary);
            transition: background-color 0.25s ease, color 0.25s ease, border-color 0.25s ease;
        }

        /* Nav links styles */
        .sidebar-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            color: var(--sidebar-text);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            border: 1px solid transparent;
        }
        .sidebar-item:hover {
            color: var(--color-primary);
            background-color: var(--sidebar-active-bg);
            opacity: 0.85;
        }
        .sidebar-item.active {
            background-color: var(--sidebar-active-bg);
            color: var(--sidebar-active-text);
            font-weight: 600;
            border-color: rgba(79, 70, 229, 0.08);
        }
        .sidebar-item.disabled {
            opacity: 0.35;
            pointer-events: none;
        }

        /* Material icons override */
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 500, 'GRAD' 0, 'opsz' 22;
        }
    </style>

    <script>
        // Apply theme immediately to prevent flashing
        (function () {
            const savedTheme = localStorage.getItem('gaply-theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
</head>

<body class="min-h-screen flex flex-col">

    {{-- Mobile Overlay --}}
    <div id="mobile-overlay" class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden backdrop-blur-sm transition-opacity duration-300"></div>

    {{-- ── Sidebar Navigation (Linear Style) ── --}}
    <aside id="app-sidebar"
        class="h-screen w-64 fixed left-0 top-0 z-50 flex flex-col -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out border-r"
        style="background-color: var(--sidebar-bg); border-color: var(--sidebar-border);">

        {{-- Brand / Logo --}}
        <div class="h-16 px-6 flex items-center justify-between border-b" style="border-color: var(--sidebar-border);">
            <div class="flex items-center gap-2.5">
                {{-- Logo symbol --}}
                <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white font-bold" 
                     style="background: linear-gradient(135deg, #4F46E5 0%, #6366F1 100%);">
                    G
                </div>
                <div class="leading-none">
                    <span class="font-display font-black text-xl tracking-tight" style="color: var(--color-text-primary);">Gaply</span>
                    <span class="block text-[10px] tracking-wider uppercase font-semibold text-primary" style="color: var(--color-primary);">AI Platform</span>
                </div>
            </div>
            <button id="close-sidebar-btn" class="lg:hidden p-1 rounded-lg hover:bg-black/5 dark:hover:bg-white/5 transition-colors">
                <span class="material-symbols-outlined text-[20px]" style="color: var(--color-text-secondary);">close</span>
            </button>
        </div>

        {{-- Navigation Menu --}}
        <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
            <p class="text-[10px] uppercase font-bold tracking-widest px-3 mb-2" style="color: var(--color-text-secondary); opacity: 0.65;">General</p>
            <a href="{{ route('dashboard') }}" class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="material-symbols-outlined text-[20px]">dashboard</span>
                Dashboard
            </a>
            <a href="{{ route('profile') }}" class="sidebar-item {{ request()->routeIs('profile') ? 'active' : '' }}">
                <span class="material-symbols-outlined text-[20px]">person_outline</span>
                My Profile
            </a>

            <p class="text-[10px] uppercase font-bold tracking-widest px-3 pt-6 mb-2" style="color: var(--color-text-secondary); opacity: 0.65;">AI Engines</p>
            <a href="#" class="sidebar-item disabled">
                <span class="material-symbols-outlined text-[20px]">analytics</span>
                Gap Analysis
                <span class="ml-auto text-[9px] px-1.5 py-0.5 rounded-full font-bold uppercase tracking-wider" 
                      style="background: rgba(79, 70, 229, 0.1); color: var(--color-primary);">Soon</span>
            </a>
            <a href="#" class="sidebar-item disabled">
                <span class="material-symbols-outlined text-[20px]">route</span>
                Smart Roadmap
                <span class="ml-auto text-[9px] px-1.5 py-0.5 rounded-full font-bold uppercase tracking-wider" 
                      style="background: rgba(79, 70, 229, 0.1); color: var(--color-primary);">Soon</span>
            </a>
        </nav>

        {{-- User Summary & Logout --}}
        <div class="p-4 border-t" style="border-color: var(--sidebar-border);">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" 
                    class="sidebar-item w-full text-left" 
                    style="color: var(--color-danger-text); background: transparent;"
                    onmouseover="this.style.backgroundColor='var(--color-danger-bg)'"
                    onmouseout="this.style.backgroundColor='transparent'">
                    <span class="material-symbols-outlined text-[20px]">logout</span>
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    {{-- ── Main Layout Wrapper ── --}}
    <div class="flex-1 lg:pl-64 flex flex-col">

        {{-- Top Header --}}
        <header class="h-16 sticky top-0 z-30 flex items-center justify-between px-6 border-b backdrop-blur-md bg-white/80 dark:bg-[#0B0F19]/80"
            style="border-color: var(--color-border);">
            
            <button id="toggle-sidebar-btn" class="lg:hidden p-2 rounded-lg text-textSecondary hover:bg-black/5 dark:hover:bg-white/5 transition-colors">
                <span class="material-symbols-outlined">menu</span>
            </button>

            <div class="hidden md:flex items-center gap-2 text-xs font-semibold px-3 py-1.5 rounded-full border bg-surface/50" 
                 style="border-color: var(--color-border); color: var(--color-text-secondary);">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                System active: AI analysis ready
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-3">
                {{-- Theme Switcher Toggle --}}
                <button id="theme-switcher" class="p-2 rounded-xl text-textSecondary hover:bg-black/5 dark:hover:bg-white/5 transition-colors"
                        onclick="toggleTheme()" title="Toggle system theme">
                    <span class="material-symbols-outlined text-[20px]" id="theme-toggle-icon">light_mode</span>
                </button>

                <div class="h-6 w-px bg-borderLine" style="background-color: var(--color-border);"></div>

                {{-- User Avatar Dropdown --}}
                <div class="relative">
                    <button id="profile-dropdown-btn" class="flex items-center gap-2.5 focus:outline-none group">
                        <img src="{{ auth()->user()->profile_image ? Storage::url(auth()->user()->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=4F46E5&color=fff&size=64' }}" 
                             alt="{{ auth()->user()->name }}"
                             class="w-8 h-8 rounded-xl object-cover ring-2 ring-transparent group-hover:ring-primary/20 transition-all">
                        <div class="hidden sm:block text-left">
                            <p class="text-sm font-semibold leading-none text-textPrimary">{{ auth()->user()->name }}</p>
                            <p class="text-[10px] text-textSecondary leading-none mt-1">{{ auth()->user()->target_job ?? 'Setup target job' }}</p>
                        </div>
                        <span class="material-symbols-outlined text-[16px] text-textSecondary transition-transform group-hover:translate-y-0.5">keyboard_arrow_down</span>
                    </button>

                    {{-- Dropdown Card --}}
                    <div id="profile-dropdown-card" class="absolute right-0 mt-3 w-56 rounded-2xl border shadow-xl py-2 hidden z-50 bg-surface"
                        style="border-color: var(--color-border);">
                        <div class="px-4 py-3 border-b" style="border-color: var(--color-border);">
                            <p class="text-sm font-bold text-textPrimary truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-textSecondary truncate">{{ auth()->user()->email }}</p>
                        </div>
                        <a href="{{ route('profile') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-textPrimary hover:bg-primary/5 transition-colors">
                            <span class="material-symbols-outlined text-[18px]">person</span>
                            My Profile
                        </a>
                        <div class="border-t my-1.5" style="border-color: var(--color-border);"></div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-2.5 text-sm text-red-500 hover:bg-red-500/10 text-left transition-colors">
                                <span class="material-symbols-outlined text-[18px]">logout</span>
                                Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        {{-- Content Area --}}
        <main class="flex-1 px-6 py-8 max-w-6xl w-full mx-auto">
            {{ $slot }}
        </main>
    </div>

    {{-- Theme & Mobile Nav Scripts --}}
    <script>
        // Theme Switch
        function toggleTheme() {
            const html = document.documentElement;
            const isDark = html.classList.contains('dark');
            if (isDark) {
                html.classList.remove('dark');
                localStorage.setItem('gaply-theme', 'light');
            } else {
                html.classList.add('dark');
                localStorage.setItem('gaply-theme', 'dark');
            }
            updateThemeUI();
        }

        function updateThemeUI() {
            const isDark = document.documentElement.classList.contains('dark');
            const icon = document.getElementById('theme-toggle-icon');
            if (icon) {
                icon.textContent = isDark ? 'dark_mode' : 'light_mode';
            }
        }
        updateThemeUI();

        // Responsive Sidebar
        const sidebar = document.getElementById('app-sidebar');
        const overlay = document.getElementById('mobile-overlay');
        const toggleBtn = document.getElementById('toggle-sidebar-btn');
        const closeBtn = document.getElementById('close-sidebar-btn');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        }
        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }

        if (toggleBtn) toggleBtn.addEventListener('click', openSidebar);
        if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
        if (overlay) overlay.addEventListener('click', closeSidebar);

        // Profile Menu Dropdown
        const dropdownBtn = document.getElementById('profile-dropdown-btn');
        const dropdownCard = document.getElementById('profile-dropdown-card');

        if (dropdownBtn && dropdownCard) {
            dropdownBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdownCard.classList.toggle('hidden');
            });
            document.addEventListener('click', () => {
                dropdownCard.classList.add('hidden');
            });
        }
    </script>
</body>

</html>