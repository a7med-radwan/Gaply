<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaply — Reset Password</title>

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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">

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
                        glowBlue: '0 0 25px rgba(56, 189, 248, 0.3)'
                    }
                }
            }
        }
    </script>

    <style>
        :root {
            --bg-primary: #080d1a;
            --bg-card: #111a2e;
            --border-primary: #25334d;
            --text-primary: #ffffff;
            --text-secondary: #cbd5e1;
        }

        html.light {
            --bg-primary: #f8fafc;
            --bg-card: #ffffff;
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

        html.light body {
            background: var(--bg-primary) !important;
            color: var(--text-primary) !important;
        }

        html.light .text-white {
            color: var(--text-primary) !important;
        }

        html.light .bg-darkBg {
            background-color: var(--bg-primary) !important;
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
            background-color: var(--bg-primary) !important;
        }
        html.light [class*="bg-darkCard/"] {
            background-color: var(--bg-card) !important;
        }

        html.light .hover\:text-white:hover {
            color: var(--text-primary) !important;
        }

        /* Input / Select / Textarea style overrides for Light Mode */
        html.light input {
            background-color: var(--bg-card) !important;
            color: var(--text-primary) !important;
            border-color: var(--border-primary) !important;
        }

        html.light input::placeholder {
            color: #94a3b8 !important;
        }

        /* Dev-tool style Grid Background */
        .bg-grid-pattern {
            background-size: 40px 40px;
            background-image: 
                linear-gradient(to right, rgba(255, 255, 255, 0.015) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.015) 1px, transparent 1px);
        }

        /* Radial mask to fade the grid out */
        .radial-fade-mask {
            mask-image: radial-gradient(circle at center, black 40%, transparent 90%);
            -webkit-mask-image: radial-gradient(circle at center, black 40%, transparent 90%);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6 relative overflow-hidden bg-darkBg selection:bg-oceanBlue selection:text-white">
    <!-- Background Elements -->
    <div class="absolute inset-0 bg-grid-pattern radial-fade-mask opacity-40 pointer-events-none"></div>
    <div class="absolute top-[20%] left-1/2 -translate-x-1/2 w-[500px] h-[500px] rounded-full opacity-[0.06] blur-[100px] pointer-events-none bg-oceanBlue"></div>

    <!-- Centered Card -->
    <div class="max-w-[420px] w-full bg-darkCard border border-darkBorder rounded-3xl p-8 shadow-2xl relative z-10 space-y-8">
        
        <!-- Logo Header -->
        <div class="flex flex-col items-center text-center space-y-3 relative">
            <!-- Theme Toggler Button -->
            <button id="theme-toggle" class="absolute right-0 top-0 p-2 rounded-xl text-textSecondary hover:text-white transition-colors">
                <span class="material-symbols-outlined text-xl" id="theme-icon">light_mode</span>
            </button>

            <a href="/" class="flex items-center gap-3 group">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center text-white font-black text-lg bg-gradient-to-br from-oceanBlue to-[#0ea5e9] shadow-md shadow-oceanBlue/20">
                    G
                </div>
                <span class="font-display font-black text-2xl tracking-tight text-white group-hover:text-oceanBlue transition-colors duration-300">Gaply</span>
            </a>
            <h2 class="font-display font-black text-3xl tracking-tight text-white mt-4">Reset Password</h2>
            <p class="text-textSecondary text-sm max-w-xs">Please set your new password below.</p>
        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="p-4 rounded-xl border border-red-500/20 bg-red-500/10 text-xs font-semibold text-red-400 flex items-start gap-2.5">
                <span class="material-symbols-outlined text-[18px] shrink-0">error</span>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST" class="space-y-5">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <input type="hidden" name="{{ config('fortify.email') }}" value="{{ $request->input('email') }}">

            <!-- New Password -->
            <div class="space-y-1.5">
                <label for="password" class="block text-[10px] font-mono font-bold uppercase tracking-wider text-textSecondary/70">New Password</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-[18px] text-textSecondary">lock</span>
                    <input id="password" type="password" name="password"
                        class="w-full pl-11 pr-4 py-3 rounded-xl border border-darkBorder bg-darkBg text-sm outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all"
                        placeholder="••••••••" required autofocus>
                </div>
            </div>

            <!-- Confirm New Password -->
            <div class="space-y-1.5">
                <label for="password_confirmation" class="block text-[10px] font-mono font-bold uppercase tracking-wider text-textSecondary/70">Confirm New Password</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-[18px] text-textSecondary">lock</span>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        class="w-full pl-11 pr-4 py-3 rounded-xl border border-darkBorder bg-darkBg text-sm outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all"
                        placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="w-full py-3.5 rounded-xl text-white font-bold text-sm bg-oceanBlue hover:bg-oceanHover shadow-premium hover:shadow-glowBlue transition-all active:scale-[0.98]">
                Reset Password
            </button>
        </form>

        <!-- Footer Link -->
        <div class="text-center text-xs">
            Want to go back?
            <a href="{{ route('login') }}" class="font-bold text-oceanBlue hover:text-oceanHover transition-colors ml-1">Sign In</a>
        </div>
    </div>

    <!-- Theme Toggle Script -->
    <script>
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const html = document.documentElement;

        function updateTogglerUI(theme) {
            if (theme === 'light') {
                if (themeIcon) themeIcon.textContent = 'dark_mode';
            } else {
                if (themeIcon) themeIcon.textContent = 'light_mode';
            }
        }

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
    </script>
</body>
</html>