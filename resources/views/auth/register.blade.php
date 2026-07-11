<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaply — Create Account</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://api.fontshare.com/v2/css?f[]=cabinet-grotesk@800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">

    <script>
        (function () {
            const saved = localStorage.getItem('gaply-theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (saved === 'dark' || (!saved && prefersDark)) document.documentElement.classList.add('dark');
        })();
    </script>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: 'var(--color-primary)',
                        accent: 'var(--color-accent)',
                        bg: 'var(--color-bg)',
                        surface: 'var(--color-surface)',
                        border: 'var(--color-border)',
                        textMain: 'var(--color-text-primary)',
                        textMuted: 'var(--color-text-secondary)',
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        display: ['"Cabinet Grotesk"', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        :root {
            --color-primary:      #4F46E5; /* Deep Electric Indigo */
            --color-accent:       #10B981; /* Cyber Mint */
            --color-bg:           #F9FAFB; /* Cool Light Gray */
            --color-surface:      #FFFFFF;
            --color-border:       #E5E7EB;
            --color-text-primary:   #111827;
            --color-text-secondary: #4B5563;
            --color-danger-bg:    #FCE8E6;
            --color-danger-text:  #C5221F;
        }
        .dark {
            --color-primary:      #6366F1;
            --color-bg:           #0B0F19; /* Deep Elegant Navy-Black */
            --color-surface:      #161F30; /* Lighter Navy Card */
            --color-border:       #24324D;
            --color-text-primary:   #F9FAFB;
            --color-text-secondary: #9CA3AF;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--color-bg);
            color: var(--color-text-primary);
            transition: background-color 0.2s;
        }

        @keyframes slideInRight {
            from { transform: translateX(40px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .animate-form { animation: slideInRight 0.6s cubic-bezier(0.16, 1, 0.3, 1) both; }
        .animate-fade { animation: fadeIn 0.8s ease-out both; }
    </style>
</head>

<body class="min-h-screen flex overflow-hidden">

    <div class="w-full min-h-screen flex flex-col md:flex-row-reverse">

        {{-- RIGHT HALF: Form Section --}}
        <div class="w-full md:w-[45%] flex flex-col justify-between p-8 md:p-12 lg:p-16 bg-surface animate-form z-10"
            style="border-left: 1px solid var(--color-border); background-color: var(--color-surface);">
            
            {{-- Logo --}}
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white font-bold" 
                         style="background: linear-gradient(135deg, #4F46E5 0%, #6366F1 100%);">
                        G
                    </div>
                    <span class="font-display font-black text-2xl tracking-tight text-textMain" style="color: var(--color-text-primary);">Gaply</span>
                </div>
                <button onclick="toggleTheme()" class="p-2 rounded-xl text-textMuted hover:bg-black/5 dark:hover:bg-white/5 transition-colors">
                    <span class="material-symbols-outlined text-[20px]" id="theme-icon">light_mode</span>
                </button>
            </div>

            {{-- Form container --}}
            <div class="my-auto max-w-[360px] w-full mx-auto py-8">
                <h2 class="font-display font-black text-[32px] tracking-tight leading-none mb-2 text-textMain" style="color: var(--color-text-primary);">Create Account</h2>
                <p class="text-textMuted text-sm mb-6" style="color: var(--color-text-secondary);">Build your professional profile to analyze gaps.</p>

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="mb-5 p-3 rounded-lg flex items-start gap-2 text-sm" style="background:var(--color-danger-bg); color:var(--color-danger-text);">
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

                    <div>
                        <label for="name" class="block text-xs font-bold uppercase tracking-wider mb-1.5" style="color: var(--color-text-secondary);">Full Name</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[18px]" style="color: var(--color-text-secondary);">person</span>
                            <input id="name" type="text" name="name" value="{{ old('name') }}"
                                class="w-full pl-10 pr-4 py-2 rounded-xl border text-sm outline-none bg-surface text-textMain"
                                style="border-color:var(--color-border); color: var(--color-text-primary); background-color: var(--color-surface);"
                                onfocus="this.style.borderColor='var(--color-primary)'; this.style.boxShadow='0 0 0 3px rgba(79, 70, 229, 0.1)';"
                                onblur="this.style.borderColor='var(--color-border)'; this.style.boxShadow='none';"
                                placeholder="Ahmed Radwan" required>
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-bold uppercase tracking-wider mb-1.5" style="color: var(--color-text-secondary);">Email Address</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[18px]" style="color: var(--color-text-secondary);">mail</span>
                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                class="w-full pl-10 pr-4 py-2 rounded-xl border text-sm outline-none bg-surface text-textMain"
                                style="border-color:var(--color-border); color: var(--color-text-primary); background-color: var(--color-surface);"
                                onfocus="this.style.borderColor='var(--color-primary)'; this.style.boxShadow='0 0 0 3px rgba(79, 70, 229, 0.1)';"
                                onblur="this.style.borderColor='var(--color-border)'; this.style.boxShadow='none';"
                                placeholder="you@example.com" required>
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-bold uppercase tracking-wider mb-1.5" style="color: var(--color-text-secondary);">Password</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[18px]" style="color: var(--color-text-secondary);">lock</span>
                            <input id="password" type="password" name="password"
                                class="w-full pl-10 pr-10 py-2 rounded-xl border text-sm outline-none bg-surface text-textMain"
                                style="border-color:var(--color-border); color: var(--color-text-primary); background-color: var(--color-surface);"
                                onfocus="this.style.borderColor='var(--color-primary)'; this.style.boxShadow='0 0 0 3px rgba(79, 70, 229, 0.1)';"
                                onblur="this.style.borderColor='var(--color-border)'; this.style.boxShadow='none';"
                                placeholder="Min. 8 characters" required autocomplete="new-password">
                            <button type="button" id="toggle-password" class="absolute right-3 top-1/2 -translate-y-1/2 text-textMuted" style="color: var(--color-text-secondary);">
                                <span class="material-symbols-outlined text-[18px]" id="password-icon">visibility</span>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider mb-1.5" style="color: var(--color-text-secondary);">Confirm Password</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[18px]" style="color: var(--color-text-secondary);">lock</span>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                class="w-full pl-10 pr-10 py-2 rounded-xl border text-sm outline-none bg-surface text-textMain"
                                style="border-color:var(--color-border); color: var(--color-text-primary); background-color: var(--color-surface);"
                                onfocus="this.style.borderColor='var(--color-primary)'; this.style.boxShadow='0 0 0 3px rgba(79, 70, 229, 0.1)';"
                                onblur="this.style.borderColor='var(--color-border)'; this.style.boxShadow='none';"
                                placeholder="Repeat password" required autocomplete="new-password">
                            <button type="button" id="toggle-confirm" class="absolute right-3 top-1/2 -translate-y-1/2 text-textMuted" style="color: var(--color-text-secondary);">
                                <span class="material-symbols-outlined text-[18px]" id="confirm-icon">visibility</span>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3 rounded-xl text-white font-bold text-sm transition-all active:scale-[0.98] flex items-center justify-center gap-2 mt-2 shadow-premium"
                        style="background:var(--color-primary);">
                        Create Account
                        <span class="material-symbols-outlined text-[18px]">person_add</span>
                    </button>
                </form>
            </div>

            {{-- Footer switcher --}}
            <div class="text-center md:text-left text-xs font-semibold" style="color: var(--color-text-secondary);">
                Already have an account?
                <a href="{{ route('login') }}" class="font-bold hover:underline transition-all" style="color: var(--color-primary);">Sign In</a>
            </div>
        </div>

        {{-- LEFT HALF: Visual Showcase Section --}}
        <div class="hidden md:flex w-full md:w-[55%] flex-col justify-between p-12 lg:p-16 text-white relative overflow-hidden animate-fade"
            style="background:#0B0F19; border-right:1px solid #24324D;">

            {{-- Glowing radial backdrops --}}
            <div class="absolute -top-40 -left-40 w-[600px] h-[600px] rounded-full opacity-20 blur-[120px] pointer-events-none" 
                style="background: radial-gradient(circle, #4F46E5 0%, transparent 70%);"></div>
            <div class="absolute -bottom-40 -right-40 w-[600px] h-[600px] rounded-full opacity-20 blur-[120px] pointer-events-none" 
                style="background: radial-gradient(circle, #10B981 0%, transparent 70%);"></div>

            {{-- Top details --}}
            <div class="relative z-10 flex items-center justify-between font-mono">
                <span class="text-xs uppercase tracking-widest text-white/40">Gaply AI Platform</span>
                <span class="text-xs font-semibold px-2.5 py-0.5 rounded border border-white/10" style="background:rgba(255,255,255,0.03);">Active Analysis</span>
            </div>

            {{-- Large Headline --}}
            <div class="my-auto relative z-10 max-w-[500px]">
                <h1 class="font-display text-[44px] lg:text-[54px] font-black leading-[1.05] tracking-tight text-white mb-6">
                    MIND THE GAP. <br>
                    <span class="font-serif italic font-normal text-indigo-400" style="color: #818CF8;">build the</span> <span class="text-primary" style="color:#10B981;">BRIDGE.</span>
                </h1>
                <p class="text-white/60 text-sm leading-relaxed mb-10 max-w-[380px]">
                    Every career path has a gap. We identify the missing pieces and map your direct route to engineering excellence.
                </p>

                {{-- Interactive Map Mockup --}}
                <div class="p-6 rounded-2xl border border-white/10" style="background:#161F30; box-shadow: 0 10px 30px rgba(0,0,0,0.5); border-color: #24324D;">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs uppercase tracking-widest text-white/40 font-semibold font-mono">Active Development Roadmap</span>
                        <div class="flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                            <span class="text-[10px] text-emerald-400 font-semibold font-mono">Ready to Analyze</span>
                        </div>
                    </div>
                    
                    {{-- Progress Steps --}}
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 p-2.5 rounded-lg border border-white/5" style="background:rgba(255,255,255,0.01);">
                            <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold text-white" style="background:var(--color-primary);">1</span>
                            <div class="flex-1">
                                <p class="text-[10px] text-white/40 font-mono">STEP ONE</p>
                                <p class="text-xs font-semibold text-white/90">Add target job & current skillset</p>
                            </div>
                            <span class="material-symbols-outlined text-emerald-400 text-[18px]">check_circle</span>
                        </div>

                        <div class="flex items-center gap-3 p-2.5 rounded-lg border border-white/5 opacity-80" style="background:rgba(255,255,255,0.01);">
                            <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold text-white/60 border border-white/10">2</span>
                            <div class="flex-1">
                                <p class="text-[10px] text-white/40 font-mono">STEP TWO</p>
                                <p class="text-xs font-semibold text-white/75">Scan requirements & importance</p>
                            </div>
                            <span class="material-symbols-outlined text-white/20 text-[18px]">pending</span>
                        </div>

                        <div class="flex items-center gap-3 p-2.5 rounded-lg border border-white/5 opacity-80" style="background:rgba(255,255,255,0.01);">
                            <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold text-white/60 border border-white/10">3</span>
                            <div class="flex-1">
                                <p class="text-[10px] text-white/40 font-mono">STEP THREE</p>
                                <p class="text-xs font-semibold text-white/75">Execute targeted learning plan</p>
                            </div>
                            <span class="material-symbols-outlined text-white/20 text-[18px]">pending</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer detail --}}
            <div class="relative z-10 text-xs text-white/30 flex items-center justify-between font-mono">
                <span>© 2026 Gaply Corporation.</span>
                <span>Stripe & Linear Architectural Concept</span>
            </div>
        </div>

    </div>

    <script>
        function toggleTheme() {
            const html = document.documentElement;
            const isDark = html.classList.contains('dark');
            html.classList.toggle('dark', !isDark);
            localStorage.setItem('gaply-theme', isDark ? 'light' : 'dark');
            updateIcon();
        }
        function updateIcon() {
            const icon = document.getElementById('theme-icon');
            if (icon) icon.textContent = document.documentElement.classList.contains('dark') ? 'dark_mode' : 'light_mode';
        }
        updateIcon();

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
        makeToggle('toggle-password', 'password',              'password-icon');
        makeToggle('toggle-confirm',  'password_confirmation', 'confirm-icon');
    </script>
</body>

</html>