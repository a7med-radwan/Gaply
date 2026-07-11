<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaply — Sign In</title>

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

        /* Dev-tool style Grid Background */
        .bg-grid-pattern {
            background-size: 40px 40px;
            background-image: 
                linear-gradient(to right, rgba(255, 255, 255, 0.02) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
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

        @keyframes fillProgress {
            from { stroke-dashoffset: 390; }
            to { stroke-dashoffset: 117; } /* 70% readiness */
        }
        .animate-fill-progress {
            animation: fillProgress 2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes float-slower {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-12px) rotate(1deg); }
        }
        .animate-float {
            animation: float-slower 6s ease-in-out infinite;
        }
    </style>
</head>
<body class="min-h-screen flex items-stretch overflow-x-hidden selection:bg-oceanBlue selection:text-white">

    <!-- LEFT HALF: Form Section (50%) -->
    <div class="w-full lg:w-1/2 flex flex-col justify-between p-8 md:p-12 lg:p-16 bg-[#050811] relative z-10">
        
        <!-- Logo Header -->
        <div class="flex items-center justify-between logo-transition">
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center text-white font-black text-lg bg-gradient-to-br from-oceanBlue to-[#0ea5e9] shadow-md shadow-oceanBlue/20">
                    G
                </div>
                <span class="font-display font-black text-2xl tracking-tight text-white group-hover:text-oceanBlue transition-colors duration-300">Gaply</span>
            </a>
        </div>

        <!-- Form Container -->
        <div class="my-auto max-w-[380px] w-full mx-auto py-12 space-y-8">
            <div class="space-y-2">
                <h2 class="font-display font-black text-4xl tracking-tight text-white">Welcome Back</h2>
                <p class="text-textSecondary text-sm">Sign in to resume tracking your skill development.</p>
            </div>

            {{-- Alert Status --}}
            @if (session('status'))
                <div class="p-4 rounded-xl border border-accentTeal/20 bg-accentTeal/10 text-xs font-semibold text-accentTeal flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">check_circle</span>
                    {{ session('status') }}
                </div>
            @endif

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

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <div class="space-y-1.5">
                    <label for="email" class="block text-[10px] font-bold uppercase tracking-wider text-textSecondary">Email Address</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-[18px] text-textSecondary">mail</span>
                        <input id="email" type="email" name="{{ config('fortify.username') }}"
                            value="{{ old(config('fortify.username')) }}"
                            class="w-full pl-11 pr-4 py-3 rounded-xl border border-darkBorder bg-darkCard/30 text-sm outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all"
                            placeholder="you@example.com" required autofocus>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <div class="flex justify-between items-center">
                        <label for="password" class="text-[10px] font-bold uppercase tracking-wider text-textSecondary">Password</label>
                        <a href="{{ route('password.request') }}" class="text-[10px] font-bold uppercase tracking-wider text-oceanBlue hover:text-oceanHover transition-colors">Forgot?</a>
                    </div>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-[18px] text-textSecondary">lock</span>
                        <input id="password" type="password" name="password"
                            class="w-full pl-11 pr-11 py-3 rounded-xl border border-darkBorder bg-darkCard/30 text-sm outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all"
                            placeholder="••••••••" required>
                        <button type="button" id="toggle-password" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-textSecondary hover:text-white transition-colors">
                            <span class="material-symbols-outlined text-[18px]" id="password-icon">visibility</span>
                        </button>
                    </div>
                </div>

                <div class="flex items-center gap-2.5 py-1">
                    <input type="checkbox" name="remember" id="remember" class="rounded border-darkBorder text-oceanBlue focus:ring-oceanBlue bg-darkCard/30 cursor-pointer">
                    <label for="remember" class="text-xs text-textSecondary cursor-pointer select-none">Remember my session</label>
                </div>

                <button type="submit" class="w-full py-3.5 rounded-xl text-white font-bold text-sm bg-oceanBlue hover:bg-oceanHover shadow-premium hover:shadow-glowBlue transition-all active:scale-[0.98]">
                    Sign In
                </button>
            </form>
        </div>

        <!-- Footer Switcher -->
        <div class="text-center lg:text-left text-xs text-textSecondary">
            Don't have an account?
            <a href="{{ route('register') }}" class="font-bold text-oceanBlue hover:text-oceanHover transition-colors ml-1">Create account</a>
        </div>
    </div>

    <!-- RIGHT HALF: Showcase Panel (50%) -->
    <div class="hidden lg:flex w-1/2 items-center justify-center p-16 relative overflow-hidden bg-[#050811] border-l border-darkBorder/40 showcase-transition">
        <!-- Background elements -->
        <div class="absolute inset-0 bg-grid-pattern radial-fade-mask opacity-40 pointer-events-none"></div>
        <div class="absolute top-[30%] left-[30%] w-[500px] h-[500px] rounded-full opacity-[0.06] blur-[100px] pointer-events-none bg-oceanBlue"></div>

        <!-- Professional Showcase Component -->
        <div class="max-w-[400px] w-full space-y-12 text-center relative z-10">
            <!-- Mockup Widget -->
            <div class="rounded-3xl border border-darkBorder/70 bg-darkCard/90 p-6 shadow-2xl text-left animate-float">
                <div class="flex items-center justify-between pb-4 border-b border-darkBorder/40 mb-6">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-red-500/80"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-yellow-500/80"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-green-500/80"></span>
                    </div>
                    <span class="text-[9px] font-mono text-textSecondary/40 uppercase tracking-widest">Live Assessment</span>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <p class="text-[10px] uppercase font-mono font-bold tracking-wider text-textSecondary">Target Role</p>
                        <h4 class="text-base font-bold text-white mt-0.5">Senior DevOps Specialist</h4>
                    </div>

                    <div class="flex items-center gap-6 py-2">
                        <div class="relative flex items-center justify-center shrink-0">
                            <svg class="w-24 h-24 transform -rotate-90">
                                <circle cx="48" cy="48" r="40" stroke="#1c2538" stroke-width="6" fill="transparent" />
                                <circle cx="48" cy="48" r="40" stroke="#38bdf8" stroke-width="6" fill="transparent"
                                    stroke-dasharray="251" 
                                    stroke-dashoffset="251"
                                    stroke-linecap="round"
                                    class="animate-fill-progress"
                                    style="stroke-dashoffset: 75;" />
                            </svg>
                            <span class="absolute text-lg font-black font-mono text-white">70%</span>
                        </div>
                        <div class="space-y-1 text-xs">
                            <p class="font-bold text-white">CI/CD & Cloud Orchestration</p>
                            <p class="text-textSecondary leading-relaxed">Required: Kubernetes, AWS, GitLab Pipelines.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Showcase Hook -->
            <div class="space-y-4">
                <h3 class="font-display text-2xl font-bold text-white">Assess & Calibrate</h3>
                <p class="text-sm text-textSecondary leading-relaxed max-w-sm mx-auto">
                    Declare your skill levels, calculate your current readiness index, and let our engine map out exactly what is missing.
                </p>
            </div>
        </div>
    </div>

    <!-- Toggle Password Visibility JS -->
    <script>
        const togglePassword = document.getElementById('toggle-password');
        const pwInput = document.getElementById('password');
        const pwIcon = document.getElementById('password-icon');
        if (togglePassword) {
            togglePassword.addEventListener('click', () => {
                const isText = pwInput.type === 'text';
                pwInput.type = isText ? 'password' : 'text';
                pwIcon.textContent = isText ? 'visibility' : 'visibility_off';
            });
        }
    </script>
</body>
</html>