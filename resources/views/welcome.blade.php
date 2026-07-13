<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaply — AI Career Path Bridge</title>

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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
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
                        glowBlue: '0 0 30px rgba(56, 189, 248, 0.35)',
                        glowTeal: '0 0 35px rgba(14, 165, 233, 0.25)',
                        glowCard: '0 10px 40px -10px rgba(3, 7, 18, 0.8)'
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
            overflow-x: hidden;
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

        html.light footer {
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
            -webkit-mask-image: radial-gradient(circle at center, black 40%, transparent 90%);
        }

        /* Animations */
        @keyframes float-slower {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(1.5deg); }
        }

        @keyframes float-faster {
            0%, 100% { transform: translateY(0px) scale(1); }
            50% { transform: translateY(-12px) scale(1.03); }
        }

        @keyframes pulse-slow {
            0%, 100% { opacity: 0.12; transform: scale(1); }
            50% { opacity: 0.22; transform: scale(1.12); }
        }

        @keyframes fillProgress {
            from { stroke-dashoffset: 390; }
            to { stroke-dashoffset: 117; } /* 70% readiness */
        }

        .animate-float-slower {
            animation: float-slower 8s ease-in-out infinite;
        }

        .animate-float-faster {
            animation: float-faster 5s ease-in-out infinite;
        }

        .animate-pulse-slow {
            animation: pulse-slow 12s ease-in-out infinite;
        }

        .animate-fill-progress {
            animation: fillProgress 2.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Typewriter Cursor */
        .typewriter-cursor::after {
            content: '|';
            animation: blink 0.8s step-end infinite;
        }

        @keyframes blink {
            from, to { color: transparent }
            50% { color: #38bdf8; }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #030712;
        }

        ::-webkit-scrollbar-thumb {
            background: #1f2937;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #38bdf8;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col justify-between selection:bg-oceanBlue selection:text-white antialiased">

    <!-- GLOBAL BG OVERLAYS -->
    <div class="absolute inset-0 z-0 bg-grid-pattern radial-fade-mask pointer-events-none h-[1200px]"></div>

    <!-- STICKY HEADER -->
    <header class="border-b border-darkBorder/40 bg-darkBg/75 backdrop-blur-lg sticky top-0 z-50 transition-all">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <!-- Logo -->
            <a href="/" class="flex items-center gap-3 group">
                <div class="relative w-10 h-10 rounded-xl flex items-center justify-center text-white font-black text-lg bg-gradient-to-br from-oceanBlue to-[#0ea5e9] shadow-premium group-hover:scale-105 transition-all duration-300">
                    G
                    <span class="absolute -top-0.5 -right-0.5 w-2.5 h-2.5 rounded-full bg-accentTeal border-2 border-darkBg animate-ping"></span>
                    <span class="absolute -top-0.5 -right-0.5 w-2.5 h-2.5 rounded-full bg-accentTeal border-2 border-darkBg"></span>
                </div>
                <span class="font-display font-black text-2xl tracking-tight text-white group-hover:text-oceanBlue transition-colors duration-300">Gaply</span>
            </a>

            <!-- Nav links -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-semibold text-textSecondary">
                <a href="#features" class="hover:text-white transition-colors duration-200 relative group py-2">
                    Features
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-oceanBlue transition-all group-hover:w-full"></span>
                </a>
                <a href="#demo" class="hover:text-white transition-colors duration-200 relative group py-2">
                    Interactive Demo
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-oceanBlue transition-all group-hover:w-full"></span>
                </a>
                <a href="#how-it-works" class="hover:text-white transition-colors duration-200 relative group py-2">
                    How It Works
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-oceanBlue transition-all group-hover:w-full"></span>
                </a>
            </nav>

            <!-- Authentication Actions -->
            <div class="flex items-center gap-4">
                <!-- Theme Toggler Button Desktop -->
                <button id="theme-toggle" class="p-2 rounded-xl text-textSecondary hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-xl" id="theme-icon">light_mode</span>
                </button>

                <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-bold text-textSecondary hover:text-white transition-colors duration-200">
                    Log in
                </a>
                <a href="{{ route('register') }}" class="px-6 py-2.5 rounded-xl text-sm font-bold text-white bg-oceanBlue hover:bg-oceanHover shadow-premium hover:shadow-glowBlue transition-all duration-300 active:scale-[0.98]">
                    Get Started
                </a>
            </div>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section class="relative pt-20 pb-32 overflow-hidden">
        <!-- Floating Glow Blobs -->
        <div class="absolute top-[25%] left-1/4 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] rounded-full opacity-10 blur-[130px] pointer-events-none bg-oceanBlue animate-pulse-slow"></div>
        <div class="absolute top-[50%] right-1/4 translate-x-1/2 w-[500px] h-[500px] rounded-full opacity-5 blur-[120px] pointer-events-none bg-accentTeal animate-pulse-slow" style="animation-delay: -4s;"></div>

        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-16 items-center relative z-10">

            <!-- Left Side: Copywriter Hook -->
            <div class="lg:col-span-7 text-left space-y-8">
                <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full border border-darkBorder bg-darkCard/40 text-xs font-mono font-bold text-oceanBlue tracking-wider uppercase shadow-inner">
                    <span class="w-2 h-2 rounded-full bg-accentTeal animate-ping"></span>
                    Now Live: Next-Gen Career Mapping
                </div>

                <h1 class="font-display text-5xl md:text-7.5xl font-black tracking-tight text-white leading-[1.02] max-w-2xl">
                    Mind the Career Gap. <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-oceanBlue via-white to-accentTeal typewriter-cursor" id="typewriter-text">Align Your Future.</span>
                </h1>

                <p class="text-lg text-textSecondary leading-relaxed max-w-xl">
                    Stop guessing what skills you need. Gaply matches your profile against verified industry requirements, maps out your technical discrepancies, and builds a customized path to job readiness.
                </p>

                <div class="flex flex-col sm:flex-row items-center gap-4 pt-4">
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 rounded-xl text-base font-bold text-white bg-oceanBlue hover:bg-oceanHover shadow-premium hover:shadow-glowBlue transition-all duration-300 text-center active:scale-[0.98]">
                        Start Skill Assessment
                    </a>
                    <a href="#demo" class="w-full sm:w-auto px-8 py-4 rounded-xl text-base font-bold text-textSecondary border border-darkBorder bg-darkCard/10 hover:bg-darkCard hover:text-white transition-all duration-300 text-center">
                        View Interactive Demo
                    </a>
                </div>
            </div>

            <!-- Right Side: Beautiful Interactive UI Dashboard Mockup -->
            <div class="lg:col-span-5 relative w-full flex items-center justify-center">

                <!-- Glowing backdrop -->
                <div class="absolute inset-0 bg-gradient-to-tr from-oceanBlue/10 to-accentTeal/10 rounded-3xl blur-3xl opacity-30"></div>

                <!-- Main mockup card -->
                <div class="w-full max-w-[420px] rounded-3xl border border-darkBorder/80 bg-darkCard/95 p-6 shadow-glowBlue/10 shadow-2xl relative animate-float-slower backdrop-blur-xl">
                    
                    <!-- Top header -->
                    <div class="flex items-center justify-between pb-4 border-b border-darkBorder/40 mb-6">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-red-500/80"></span>
                            <span class="w-3 h-3 rounded-full bg-yellow-500/80"></span>
                            <span class="w-3 h-3 rounded-full bg-green-500/80"></span>
                        </div>
                        <span class="text-[9px] font-mono font-bold uppercase tracking-wider text-textSecondary/50 bg-darkBg border border-darkBorder px-2.5 py-0.5 rounded">
                            Gaply Engine v2.5
                        </span>
                    </div>

                    <!-- Target Job Spec -->
                    <div class="mb-6 space-y-1">
                        <p class="text-[9px] uppercase font-mono font-bold tracking-widest text-textSecondary/65">Target Job Profile</p>
                        <h3 class="text-xl font-black text-white font-display">Laravel Backend Architect</h3>
                    </div>

                    <!-- Circular progress readiness -->
                    <div class="flex items-center justify-center relative my-8">
                        <svg class="w-36 h-36 transform -rotate-90">
                            <!-- Track -->
                            <circle cx="72" cy="72" r="62" stroke="#111827" stroke-width="8" fill="transparent" />
                            <!-- Active Fill -->
                            <circle cx="72" cy="72" r="62" stroke="#38bdf8" stroke-width="8" fill="transparent"
                                stroke-dasharray="390" stroke-dashoffset="390" stroke-linecap="round"
                                class="animate-fill-progress" style="stroke-dashoffset: 117;" />
                        </svg>
                        <div class="absolute flex flex-col items-center justify-center font-mono">
                            <span class="text-3.5xl font-black text-white tracking-tighter">70%</span>
                            <span class="text-[8px] uppercase tracking-widest font-sans font-bold text-accentTeal mt-0.5">Readiness</span>
                        </div>
                    </div>

                    <!-- Mini status elements -->
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 rounded-xl border border-darkBorder bg-darkBg/60 text-xs">
                            <div class="flex items-center gap-2.5">
                                <span class="w-2 h-2 rounded-full bg-accentTeal"></span>
                                <span class="font-bold text-white">Acquired Skills</span>
                            </div>
                            <span class="font-semibold text-textSecondary">PHP, APIs, Eloquent</span>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-xl border border-darkBorder bg-darkBg/60 text-xs">
                            <div class="flex items-center gap-2.5">
                                <span class="w-2 h-2 rounded-full bg-red-400"></span>
                                <span class="font-bold text-white">Missing Gaps</span>
                            </div>
                            <span class="font-bold text-red-400">Redis, Docker, Testing</span>
                        </div>
                    </div>
                </div>

                <!-- Floating Decorator Badge 1 -->
                <div class="absolute -top-6 -right-4 bg-darkBg/90 border border-darkBorder rounded-2xl p-4 shadow-2xl flex items-center gap-3 animate-float-faster z-20 backdrop-blur-md">
                    <div class="w-8 h-8 rounded-lg bg-accentTeal/10 flex items-center justify-center text-accentTeal border border-accentTeal/20">
                        <span class="material-symbols-outlined text-lg">verified</span>
                    </div>
                    <div>
                        <p class="text-[9px] text-textSecondary uppercase font-bold tracking-wider">Analysis Status</p>
                        <p class="text-xs font-black text-white">Optimal Path Found</p>
                    </div>
                </div>

                <!-- Floating Decorator Badge 2 -->
                <div class="absolute -bottom-6 -left-6 bg-darkBg/90 border border-darkBorder rounded-2xl p-4 shadow-2xl flex items-center gap-3 animate-float-faster z-20 backdrop-blur-md" style="animation-delay: -2.5s;">
                    <div class="w-8 h-8 rounded-lg bg-oceanBlue/10 flex items-center justify-center text-oceanBlue border border-oceanBlue/20">
                        <span class="material-symbols-outlined text-lg">schedule</span>
                    </div>
                    <div>
                        <p class="text-[9px] text-textSecondary uppercase font-bold tracking-wider">Estimated Alignment</p>
                        <p class="text-xs font-black text-white">12 Weeks</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- KEY METRICS STATS BAR -->
    <section class="border-y border-darkBorder/40 bg-darkCard/20 backdrop-blur-sm py-12 relative overflow-hidden">
        <div class="absolute inset-0 bg-grid-pattern opacity-5 pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10 grid grid-cols-2 md:grid-cols-4 gap-y-6 md:gap-y-0 md:divide-x divide-darkBorder/50 text-center">
            <div>
                <h3 class="text-3xl md:text-4.5xl font-black font-display tracking-tight text-oceanBlue">100%</h3>
                <p class="text-[10px] md:text-xs font-bold uppercase tracking-wider text-textSecondary mt-2">Automated Skill Assessment</p>
            </div>
            <div>
                <h3 class="text-3xl md:text-4.5xl font-black font-display tracking-tight text-oceanBlue">AI</h3>
                <p class="text-[10px] md:text-xs font-bold uppercase tracking-wider text-textSecondary mt-2">Curated Roadmap Paths</p>
            </div>
            <div>
                <h3 class="text-3xl md:text-4.5xl font-black font-display tracking-tight text-oceanBlue">Real-time</h3>
                <p class="text-[10px] md:text-xs font-bold uppercase tracking-wider text-textSecondary mt-2">Job Readiness Score</p>
            </div>
            <div>
                <h3 class="text-3xl md:text-4.5xl font-black font-display tracking-tight text-oceanBlue">0%</h3>
                <p class="text-[10px] md:text-xs font-bold uppercase tracking-wider text-textSecondary mt-2">Placeholder Guesswork</p>
            </div>
        </div>
    </section>

    <!-- CORE FEATURES SECTION -->
    <section id="features" class="py-32 bg-darkBg relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-24 space-y-4">
                <h2 class="font-display text-4xl md:text-5xl font-black tracking-tight text-white leading-tight">
                    Engineered to Bridge the Tech Gap
                </h2>
                <p class="text-textSecondary text-base leading-relaxed">
                    Gaply integrates developer profiles directly with career requirements. Here is how we change the paradigm.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- feature card 1 -->
                <div class="p-8 rounded-2xl border border-darkBorder bg-darkCard/10 hover:bg-darkCard/50 hover:border-oceanBlue/40 hover:shadow-premium transition-all duration-300 group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-oceanBlue opacity-[0.02] rounded-bl-full pointer-events-none group-hover:opacity-[0.06] transition-all"></div>
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-oceanBlue/10 text-oceanBlue group-hover:bg-oceanBlue group-hover:text-white group-hover:shadow-glowBlue transition-all duration-300 mb-6">
                        <span class="material-symbols-outlined text-2xl">insights</span>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-3">Skill Discrepancy Matrix</h3>
                    <p class="text-sm text-textSecondary leading-relaxed">
                        Input your technical skillset and experience levels. Our matrix highlights the core requirements you are currently missing for your target career.
                    </p>
                </div>

                <!-- feature card 2 -->
                <div class="p-8 rounded-2xl border border-darkBorder bg-darkCard/10 hover:bg-darkCard/50 hover:border-oceanBlue/40 hover:shadow-premium transition-all duration-300 group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-oceanBlue opacity-[0.02] rounded-bl-full pointer-events-none group-hover:opacity-[0.06] transition-all"></div>
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-oceanBlue/10 text-oceanBlue group-hover:bg-oceanBlue group-hover:text-white group-hover:shadow-glowBlue transition-all duration-300 mb-6">
                        <span class="material-symbols-outlined text-2xl">route</span>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-3">AI Learning Roadmap</h3>
                    <p class="text-sm text-textSecondary leading-relaxed">
                        Get a detailed roadmap with specific tasks, duration estimates, and structural milestones. Learn step-by-step from zero to readiness.
                    </p>
                </div>

                <!-- feature card 3 -->
                <div class="p-8 rounded-2xl border border-darkBorder bg-darkCard/10 hover:bg-darkCard/50 hover:border-oceanBlue/40 hover:shadow-premium transition-all duration-300 group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-oceanBlue opacity-[0.02] rounded-bl-full pointer-events-none group-hover:opacity-[0.06] transition-all"></div>
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-oceanBlue/10 text-oceanBlue group-hover:bg-oceanBlue group-hover:text-white group-hover:shadow-glowBlue transition-all duration-300 mb-6">
                        <span class="material-symbols-outlined text-2xl">monitoring</span>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-3">Dynamic Readiness Scoring</h3>
                    <p class="text-sm text-textSecondary leading-relaxed">
                        Track your career readiness indicator. The readiness index changes dynamically as you acquire and check off skills, providing instant visual feedback.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- INTERACTIVE DEMO SIMULATOR -->
    <section id="demo" class="py-32 border-t border-darkBorder/40 bg-darkBg/40 relative">
        <div class="absolute top-[10%] right-10 w-96 h-96 rounded-full opacity-[0.03] blur-[100px] pointer-events-none bg-oceanBlue"></div>

        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-20 space-y-4">
                <div class="inline-block text-xs font-mono font-bold bg-darkCard border border-darkBorder text-oceanBlue px-3 py-1.5 rounded-full uppercase tracking-widest">
                    Try the Simulator
                </div>
                <h2 class="font-display text-4xl font-black tracking-tight text-white">
                    Interactive Roadmap Preview
                </h2>
                <p class="text-textSecondary text-sm">
                    Toggle roles below to simulate how Gaply generates custom career roadmaps instantly.
                </p>
            </div>

            <!-- Simulator Component -->
            <div class="rounded-3xl border border-darkBorder/80 bg-darkCard p-6 md:p-8 shadow-2xl space-y-8">
                <!-- Role selector buttons -->
                <div class="flex flex-wrap items-center justify-center gap-3 border-b border-darkBorder/40 pb-6">
                    <button type="button" onclick="switchDemoRole('laravel')" id="btn-laravel"
                        class="px-5 py-2.5 rounded-xl text-xs font-mono font-bold uppercase tracking-wider transition-all border border-oceanBlue bg-oceanBlue text-white shadow-premium">
                        Laravel Architect
                    </button>
                    <button type="button" onclick="switchDemoRole('frontend')" id="btn-frontend"
                        class="px-5 py-2.5 rounded-xl text-xs font-mono font-bold uppercase tracking-wider transition-all border border-darkBorder text-textSecondary hover:border-textSecondary/50">
                        Frontend Engineer
                    </button>
                    <button type="button" onclick="switchDemoRole('devops')" id="btn-devops"
                        class="px-5 py-2.5 rounded-xl text-xs font-mono font-bold uppercase tracking-wider transition-all border border-darkBorder text-textSecondary hover:border-textSecondary/50">
                        DevOps Specialist
                    </button>
                </div>

                <!-- Simulation content -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                    <!-- Left: Readiness index & status details -->
                    <div class="lg:col-span-4 space-y-6">
                        <div class="p-5 rounded-2xl border border-darkBorder bg-darkBg/60">
                            <p class="text-[9px] uppercase font-mono font-bold text-textSecondary/70 tracking-widest">
                                Computed Readiness</p>
                            <div class="flex items-baseline gap-2 mt-2">
                                <span id="demo-readiness" class="text-4xl font-black text-white">68%</span>
                                <span class="text-xs text-accentTeal font-bold">Aligning</span>
                            </div>
                            <div class="w-full bg-darkBorder rounded-full h-2 mt-3 overflow-hidden">
                                <div id="demo-bar" class="bg-oceanBlue h-full rounded-full transition-all duration-700" style="width: 68%;"></div>
                            </div>
                        </div>

                        <div class="p-5 rounded-2xl border border-darkBorder bg-darkBg/60 space-y-4">
                            <div>
                                <p class="text-[9px] font-mono text-textSecondary/50 uppercase tracking-widest">Skills You Have</p>
                                <div id="demo-acquired" class="flex flex-wrap gap-1.5 mt-2">
                                    <!-- Dynamic -->
                                </div>
                            </div>
                            <hr class="border-darkBorder/40">
                            <div>
                                <p class="text-[9px] font-mono text-textSecondary/50 uppercase tracking-widest">Missing Skills (Gaps)</p>
                                <div id="demo-missing" class="flex flex-wrap gap-1.5 mt-2">
                                    <!-- Dynamic -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Timeline tasks -->
                    <div class="lg:col-span-8 space-y-4" id="demo-tasks">
                        <!-- Dynamic task list -->
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- TIMELINE OF "HOW IT WORKS" -->
    <section id="how-it-works" class="py-32 border-t border-darkBorder/40 bg-darkBg/50 relative">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-24 space-y-4">
                <h2 class="font-display text-4xl font-black tracking-tight text-white">How It Works</h2>
                <p class="text-textSecondary text-base">Four steps to achieve complete technical alignment with your dream career.</p>
            </div>

            <div class="relative pl-8 border-l-2 border-darkBorder space-y-16 ml-4">
                <!-- STEP 1 -->
                <div class="relative group">
                    <span class="absolute -left-[46px] top-1.5 w-8 h-8 rounded-full border-2 border-oceanBlue flex items-center justify-center bg-darkBg text-xs font-black text-oceanBlue shadow-premium group-hover:scale-110 transition-transform">
                        1
                    </span>
                    <div class="p-6 rounded-2xl border border-darkBorder bg-darkCard/25 group-hover:border-oceanBlue/50 transition-all duration-300">
                        <h4 class="text-base font-bold text-white mb-2 group-hover:text-oceanBlue transition-colors">
                            Select Target Job Role</h4>
                        <p class="text-sm text-textSecondary leading-relaxed">
                            Pick the engineering or architect position you want to reach. Our engine configures the standard skillset matrix defined for that role.
                        </p>
                    </div>
                </div>

                <!-- STEP 2 -->
                <div class="relative group">
                    <span class="absolute -left-[46px] top-1.5 w-8 h-8 rounded-full border-2 border-oceanBlue flex items-center justify-center bg-darkBg text-xs font-black text-oceanBlue shadow-premium group-hover:scale-110 transition-transform">
                        2
                    </span>
                    <div class="p-6 rounded-2xl border border-darkBorder bg-darkCard/25 group-hover:border-oceanBlue/50 transition-all duration-300">
                        <h4 class="text-base font-bold text-white mb-2 group-hover:text-oceanBlue transition-colors">
                            Declare Your Skillset</h4>
                        <p class="text-sm text-textSecondary leading-relaxed">
                            Define the technical tools and frameworks you currently master, alongside your estimated levels (Beginner, Intermediate, Advanced).
                        </p>
                    </div>
                </div>

                <!-- STEP 3 -->
                <div class="relative group">
                    <span class="absolute -left-[46px] top-1.5 w-8 h-8 rounded-full border-2 border-oceanBlue flex items-center justify-center bg-darkBg text-xs font-black text-oceanBlue shadow-premium group-hover:scale-110 transition-transform">
                        3
                    </span>
                    <div class="p-6 rounded-2xl border border-darkBorder bg-darkCard/25 group-hover:border-oceanBlue/50 transition-all duration-300">
                        <h4 class="text-base font-bold text-white mb-2 group-hover:text-oceanBlue transition-colors">
                            Acquire Custom Learning Path</h4>
                        <p class="text-sm text-textSecondary leading-relaxed">
                            Gaply instantly outlines missing skills, computes your readiness, and organizes your learning tasks into a step-by-step roadmap.
                        </p>
                    </div>
                </div>

                <!-- STEP 4 -->
                <div class="relative group">
                    <span class="absolute -left-[46px] top-1.5 w-8 h-8 rounded-full border-2 border-oceanBlue flex items-center justify-center bg-darkBg text-xs font-black text-oceanBlue shadow-premium group-hover:scale-110 transition-transform">
                        4
                    </span>
                    <div class="p-6 rounded-2xl border border-darkBorder bg-darkCard/25 group-hover:border-oceanBlue/50 transition-all duration-300">
                        <h4 class="text-base font-bold text-white mb-2 group-hover:text-oceanBlue transition-colors">
                            Study, Check, and Align</h4>
                        <p class="text-sm text-textSecondary leading-relaxed">
                            Follow the timeline, check tasks as completed, watch your readiness score climb, and align your profile to land your dream job.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="border-t border-darkBorder/40 bg-darkCard py-16 text-xs text-textSecondary relative z-10">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white font-bold text-sm bg-oceanBlue">
                    G
                </div>
                <span class="font-display font-bold text-base text-white tracking-tight">Gaply</span>
            </div>

            <p class="text-center text-textSecondary/70">
                © 2026 Gaply. Designed with clean modular layouts. All rights reserved.
            </p>

            <div class="flex items-center gap-6 font-semibold">
                <a href="https://github.com/a7med-radwan/Roadmap" target="_blank" class="hover:text-white transition-colors">GitHub</a>
                <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
            </div>
        </div>
    </footer>

    <!-- INTERACTIVE SIMULATOR & TYPEWRITER JAVASCRIPT -->
    <script>
        // Typewriter Effect for Title
        const words = ["Align Your Future.", "Target Specific Gaps.", "Land Your Dream Job."];
        let i = 0;
        let timer;

        function typingEffect() {
            let word = words[i].split("");
            var loopTyping = function() {
                if (word.length > 0) {
                    document.getElementById('typewriter-text').innerHTML += word.shift();
                } else {
                    setTimeout(deletingEffect, 2000);
                    return false;
                }
                timer = setTimeout(loopTyping, 100);
            };
            loopTyping();
        }

        function deletingEffect() {
            let word = words[i].split("");
            var loopDeleting = function() {
                if (word.length > 0) {
                    word.pop();
                    document.getElementById('typewriter-text').innerHTML = word.join("");
                } else {
                    if (words.length > (i + 1)) {
                        i++;
                    } else {
                        i = 0;
                    }
                    setTimeout(typingEffect, 500);
                    return false;
                }
                timer = setTimeout(loopDeleting, 60);
            };
            loopDeleting();
        }

        // Run typewriter on load
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('typewriter-text').innerHTML = "";
            typingEffect();
        });

        // Simulator Data
        const rolesData = {
            laravel: {
                readiness: '68%',
                barWidth: '68%',
                acquired: ['PHP', 'Laravel APIs', 'Eloquent ORM', 'SQL Database'],
                missing: ['Redis Caching', 'Docker Containers', 'Feature Testing'],
                tasks: [
                    { title: 'Docker Orchestration', desc: 'Containerize local Laravel environments with docker-compose.', duration: '2 Weeks' },
                    { title: 'Redis Caching & Queues', desc: 'Optimize query throughput and set up background queues.', duration: '3 Weeks' },
                    { title: 'Feature and Unit Testing', desc: 'Write comprehensive integration tests using PHPUnit.', duration: '3 Weeks' }
                ]
            },
            frontend: {
                readiness: '55%',
                barWidth: '55%',
                acquired: ['HTML / CSS', 'JavaScript ES6', 'Git / Version Control'],
                missing: ['React Framework', 'TypeScript Basics', 'Tailwind & Flexbox'],
                tasks: [
                    { title: 'Tailwind CSS Layouts', desc: 'Master utility-first flexbox grids and responsive styling.', duration: '2 Weeks' },
                    { title: 'TypeScript Integration', desc: 'Implement static types and interface schemas.', duration: '3 Weeks' },
                    { title: 'React Core Concepts', desc: 'Build reactive user interfaces using Hooks and state management.', duration: '4 Weeks' }
                ]
            },
            devops: {
                readiness: '40%',
                barWidth: '40%',
                acquired: ['Linux Shell', 'Git Basics', 'Networking Fundamentals'],
                missing: ['CI/CD Pipelines', 'AWS Deployment', 'Kubernetes Clusters'],
                tasks: [
                    { title: 'GitHub Actions / Gitlab CI', desc: 'Automate build, lint, and test runner workflows.', duration: '3 Weeks' },
                    { title: 'AWS Cloud Architecture', desc: 'Configure EC2 instances, S3 buckets, and RDS databases.', duration: '4 Weeks' },
                    { title: 'Kubernetes Orchestration', desc: 'Deploy scaling container nodes with k8s.', duration: '5 Weeks' }
                ]
            }
        };

        function switchDemoRole(role) {
            // Update button styles
            const buttons = ['laravel', 'frontend', 'devops'];
            buttons.forEach(b => {
                const el = document.getElementById(`btn-${b}`);
                if (b === role) {
                    el.className = 'px-5 py-2.5 rounded-xl text-xs font-mono font-bold uppercase tracking-wider transition-all border border-oceanBlue bg-oceanBlue text-white shadow-premium';
                } else {
                    el.className = 'px-5 py-2.5 rounded-xl text-xs font-mono font-bold uppercase tracking-wider transition-all border border-darkBorder text-textSecondary hover:border-textSecondary/50';
                }
            });

            // Update display content
            const data = rolesData[role];
            document.getElementById('demo-readiness').textContent = data.readiness;
            document.getElementById('demo-bar').style.width = data.barWidth;

            // Render acquired badges
            const acquiredContainer = document.getElementById('demo-acquired');
            acquiredContainer.innerHTML = '';
            data.acquired.forEach(s => {
                const span = document.createElement('span');
                span.className = 'px-2.5 py-0.5 rounded-md text-[10px] font-semibold bg-accentTeal/10 text-accentTeal border border-accentTeal/20';
                span.textContent = s;
                acquiredContainer.appendChild(span);
            });

            // Render missing badges
            const missingContainer = document.getElementById('demo-missing');
            missingContainer.innerHTML = '';
            data.missing.forEach(s => {
                const span = document.createElement('span');
                span.className = 'px-2.5 py-0.5 rounded-md text-[10px] font-semibold bg-red-500/10 text-red-400 border border-red-500/20';
                span.textContent = s;
                missingContainer.appendChild(span);
            });

            // Render tasks list
            const tasksContainer = document.getElementById('demo-tasks');
            tasksContainer.innerHTML = '';
            data.tasks.forEach(t => {
                const card = document.createElement('div');
                card.className = 'flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-5 rounded-2xl border border-darkBorder bg-darkBg/60 hover:border-oceanBlue/30 hover:bg-darkBg transition-all duration-300';

                const info = document.createElement('div');
                info.className = 'space-y-1';
                info.innerHTML = `<h5 class="text-sm font-bold text-white">${t.title}</h5><p class="text-xs text-textSecondary leading-relaxed">${t.desc}</p>`;

                const duration = document.createElement('div');
                duration.className = 'shrink-0 px-2.5 py-1 rounded-lg border border-darkBorder text-[10px] font-mono font-bold text-textSecondary bg-darkCard/50 self-start sm:self-center';
                duration.textContent = t.duration;

                card.appendChild(info);
                card.appendChild(duration);
                tasksContainer.appendChild(card);
            });
        }

        // Initialize simulator with Laravel role
        switchDemoRole('laravel');

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