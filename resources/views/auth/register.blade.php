<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaply — Create Account</title>

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
                        darkBg: '#030712',
                        darkCard: '#0b0f19',
                        darkBorder: '#1f2937',
                        oceanBlue: '#38bdf8',
                        oceanHover: '#0ea5e9',
                        accentTeal: '#0ea5e9',
                        textPrimary: '#ffffff',
                        textSecondary: '#9ca3af'
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
            --bg-primary: #030712;
            --bg-card: #0b0f19;
            --border-primary: #1f2937;
            --text-primary: #ffffff;
            --text-secondary: #9ca3af;
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
            background-color: var(--bg-primary);
            color: var(--text-primary);
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        html.light body {
            background-color: var(--bg-primary) !important;
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

        html.light .from-darkCard {
            --tw-gradient-from: var(--bg-card) var(--tw-gradient-from-position) !important;
            --tw-gradient-to: rgba(241, 245, 249, 0) var(--tw-gradient-to-position) !important;
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to) !important;
        }
        html.light .to-darkCard\/30 {
            --tw-gradient-to: rgba(241, 245, 249, 0.3) var(--tw-gradient-to-position) !important;
        }

        html.light .bg-grid-pattern {
            background-image:
                linear-gradient(to right, rgba(15, 23, 42, 0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(15, 23, 42, 0.03) 1px, transparent 1px) !important;
        }

        html.light svg circle:first-child {
            stroke: var(--border-primary) !important;
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
        html.light .text-textSecondary\/40 {
            color: rgba(71, 85, 105, 0.4) !important;
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

        /* Native Cross-document View Transitions */
        @view-transition {
            navigation: auto;
        }

        /* Define transition elements */
        .logo-transition {
            view-transition-name: brand-logo;
        }
        .showcase-transition {
            view-transition-name: auth-showcase;
        }

        @keyframes float-slower {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-12px) rotate(-1deg); }
        }
        .animate-float {
            animation: float-slower 6s ease-in-out infinite;
        }
    </style>
</head>
<body class="min-h-screen flex items-stretch overflow-x-hidden selection:bg-oceanBlue selection:text-white">

    <!-- LEFT HALF: Showcase Panel (50%) -->
    <div class="hidden lg:flex w-1/2 items-center justify-center p-16 relative overflow-hidden bg-darkBg border-r border-darkBorder/40 showcase-transition">
        <!-- Background elements -->
        <div class="absolute inset-0 bg-grid-pattern radial-fade-mask opacity-40 pointer-events-none"></div>
        <div class="absolute top-[30%] right-[30%] w-[500px] h-[500px] rounded-full opacity-[0.08] blur-[110px] pointer-events-none bg-oceanBlue animate-pulse-slow"></div>

        <!-- Professional Showcase Component -->
        <div class="max-w-[400px] w-full space-y-12 text-center relative z-10">
            <!-- Mockup Widget (Personalized Roadmap Timeline) -->
            <div class="rounded-3xl border border-darkBorder/70 bg-darkCard/90 p-6 shadow-2xl text-left animate-float">
                <div class="flex items-center justify-between pb-4 border-b border-darkBorder/40 mb-6">
                    <div class="flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-accentTeal animate-pulse"></span>
                        <span class="text-[9px] font-mono text-accentTeal uppercase tracking-widest font-bold">Active Path</span>
                    </div>
                    <span class="text-[9px] font-mono text-textSecondary/40 uppercase tracking-widest">Roadmap Tasks</span>
                </div>
                
                <div class="space-y-4">
                    <!-- Task 1 -->
                    <div class="p-3.5 rounded-xl border border-darkBorder bg-darkBg/60 text-xs flex justify-between gap-4">
                        <div class="space-y-1">
                            <p class="font-bold text-white">Docker & Dev Environments</p>
                            <p class="text-[10px] text-textSecondary">Build custom docker-compose environments.</p>
                        </div>
                        <span class="text-[9px] font-mono font-bold text-accentTeal bg-accentTeal/10 px-2 py-0.5 rounded h-fit shrink-0">In Progress</span>
                    </div>

                    <!-- Task 2 -->
                    <div class="p-3.5 rounded-xl border border-darkBorder bg-darkBg/60 text-xs flex justify-between gap-4">
                        <div class="space-y-1">
                            <p class="font-bold text-white">Redis Queue Configuration</p>
                            <p class="text-[10px] text-textSecondary">Set up dynamic asynchronous workers.</p>
                        </div>
                        <span class="text-[9px] font-mono font-bold text-textSecondary/50 bg-darkBorder px-2 py-0.5 rounded h-fit shrink-0">Pending</span>
                    </div>
                </div>
            </div>

            <!-- Showcase Hook -->
            <div class="space-y-4">
                <h3 class="font-display text-2xl font-bold text-white">Generate Your Path</h3>
                <p class="text-sm text-textSecondary leading-relaxed max-w-sm mx-auto">
                    Receive a chronological, step-by-step curriculum generated to bridge your skillset matrix with career targets.
                </p>
            </div>
        </div>
    </div>

    <!-- RIGHT HALF: Form Section (50%) -->
    <div class="w-full lg:w-1/2 flex flex-col justify-between p-8 md:p-12 lg:p-16 bg-darkBg relative z-10">
        
        <!-- Background grid overlay -->
        <div class="absolute inset-0 z-0 bg-grid-pattern radial-fade-mask opacity-30 pointer-events-none"></div>

        <!-- Logo Header -->
        <div class="flex items-center justify-between logo-transition relative z-10">
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white font-black text-lg bg-gradient-to-br from-oceanBlue to-[#0ea5e9] shadow-premium group-hover:scale-105 transition-all duration-300">
                    G
                </div>
                <span class="font-display font-black text-2xl tracking-tight text-white group-hover:text-oceanBlue transition-colors duration-300">Gaply</span>
            </a>

            <!-- Theme Toggler Button -->
            <button id="theme-toggle" class="p-2 rounded-xl text-textSecondary hover:text-white transition-colors">
                <span class="material-symbols-outlined text-xl" id="theme-icon">light_mode</span>
            </button>
        </div>

        <!-- Form Container -->
        <div class="my-auto max-w-[390px] w-full mx-auto py-8 space-y-8 relative z-10">
            <div class="space-y-2">
                <h2 class="font-display font-black text-4xl tracking-tight text-white leading-tight">Create Account</h2>
                <p class="text-textSecondary text-sm">Build your professional profile to analyze gaps.</p>
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

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                <div class="space-y-1.5">
                    <label for="name" class="block text-[10px] font-mono font-bold uppercase tracking-wider text-textSecondary/70">Full Name</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-[18px] text-textSecondary">person</span>
                        <input id="name" type="text" name="name" value="{{ old('name') }}"
                            class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-darkBorder bg-darkCard/30 text-sm outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all"
                            placeholder="Ahmed Radwan" required autofocus>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label for="email" class="block text-[10px] font-mono font-bold uppercase tracking-wider text-textSecondary/70">Email Address</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-[18px] text-textSecondary">mail</span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                            class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-darkBorder bg-darkCard/30 text-sm outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all"
                            placeholder="you@example.com" required>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label for="password" class="block text-[10px] font-mono font-bold uppercase tracking-wider text-textSecondary/70">Password</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-[18px] text-textSecondary">lock</span>
                        <input id="password" type="password" name="password"
                            class="w-full pl-11 pr-11 py-2.5 rounded-xl border border-darkBorder bg-darkCard/30 text-sm outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all"
                            placeholder="Min. 8 characters" required autocomplete="new-password">
                        <button type="button" id="toggle-password" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-textSecondary hover:text-white transition-colors">
                            <span class="material-symbols-outlined text-[18px]" id="password-icon">visibility</span>
                        </button>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label for="password_confirmation" class="block text-[10px] font-mono font-bold uppercase tracking-wider text-textSecondary/70">Confirm Password</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-[18px] text-textSecondary">lock</span>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            class="w-full pl-11 pr-11 py-2.5 rounded-xl border border-darkBorder bg-darkCard/30 text-sm outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all"
                            placeholder="Repeat password" required autocomplete="new-password">
                        <button type="button" id="toggle-confirm" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-textSecondary hover:text-white transition-colors">
                            <span class="material-symbols-outlined text-[18px]" id="confirm-icon">visibility</span>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full py-3.5 rounded-xl text-white font-bold text-sm bg-oceanBlue hover:bg-oceanHover shadow-premium hover:shadow-glowBlue transition-all duration-200 active:scale-[0.98] mt-2">
                    Create Account
                </button>
            </form>
        </div>

        <!-- Footer Switcher -->
        <div class="text-center lg:text-left text-xs text-textSecondary relative z-10">
            Already have an account?
            <a href="{{ route('login') }}" class="font-bold text-oceanBlue hover:text-oceanHover transition-colors ml-1">Sign In</a>
        </div>
    </div>

    <!-- Toggle Password Visibility JS -->
    <script>
        function makeToggle(btnId, inputId, iconId) {
            const btn = document.getElementById(btnId);
            const inp = document.getElementById(inputId);
            const ico = document.getElementById(iconId);
            if (btn && inp && ico) {
                btn.addEventListener('click', () => {
                    const isText = inp.type === 'text';
                    inp.type = isText ? 'password' : 'text';
                    ico.textContent = isText ? 'visibility' : 'visibility_off';
                });
            }
        }
        makeToggle('toggle-password', 'password', 'password-icon');
        makeToggle('toggle-confirm', 'password_confirmation', 'confirm-icon');

        // Theme Toggle Script
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