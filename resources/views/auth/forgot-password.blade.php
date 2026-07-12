<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaply — Reset Password</title>

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
        .bg-grid-pattern {
            background-size: 40px 40px;
            background-image: 
                linear-gradient(to right, rgba(255, 255, 255, 0.02) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
        }
        .radial-fade-mask {
            mask-image: radial-gradient(circle at center, black 40%, transparent 90%);
            -webkit-mask-image: radial-gradient(circle at center, black 40%, transparent 90%);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6 relative overflow-hidden bg-[#050811] selection:bg-oceanBlue selection:text-white">
    <!-- Background Elements -->
    <div class="absolute inset-0 bg-grid-pattern radial-fade-mask opacity-40 pointer-events-none"></div>
    <div class="absolute top-[20%] left-1/2 -translate-x-1/2 w-[500px] h-[500px] rounded-full opacity-[0.06] blur-[100px] pointer-events-none bg-oceanBlue"></div>

    <!-- Centered Card -->
    <div class="max-w-[420px] w-full bg-darkCard/90 border border-darkBorder/70 rounded-3xl p-8 shadow-2xl relative z-10 space-y-8">
        
        <!-- Logo Header -->
        <div class="flex flex-col items-center text-center space-y-3">
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center text-white font-black text-lg bg-gradient-to-br from-oceanBlue to-[#0ea5e9] shadow-md shadow-oceanBlue/20">
                    G
                </div>
                <span class="font-display font-black text-2xl tracking-tight text-white group-hover:text-oceanBlue transition-colors duration-300">Gaply</span>
            </a>
            <h2 class="font-display font-black text-3xl tracking-tight text-white mt-4">Forgot Password?</h2>
            <p class="text-textSecondary text-sm max-w-xs">Enter your email address and we'll send you a link to reset your password.</p>
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

        <form action="{{ route('password.email') }}" method="POST" class="space-y-5">
            @csrf

            <div class="space-y-1.5">
                <label for="email" class="block text-[10px] font-bold uppercase tracking-wider text-textSecondary">Email Address</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-[18px] text-textSecondary">mail</span>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        class="w-full pl-11 pr-4 py-3 rounded-xl border border-darkBorder bg-[#050811]/40 text-sm outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all"
                        placeholder="you@example.com" required autofocus>
                </div>
            </div>

            <button type="submit" class="w-full py-3.5 rounded-xl text-white font-bold text-sm bg-oceanBlue hover:bg-oceanHover shadow-premium hover:shadow-glowBlue transition-all active:scale-[0.98]">
                Send Reset Link
            </button>
        </form>

        <!-- Footer Link -->
        <div class="text-center text-xs">
            <a href="{{ route('login') }}" class="font-bold text-textSecondary hover:text-white transition-colors flex items-center justify-center gap-1.5">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Back to Sign In
            </a>
        </div>
    </div>
</body>
</html>