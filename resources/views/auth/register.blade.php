<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Focus - Register</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#3525cd",
                        "on-surface": "#0b1c30",
                        "on-surface-variant": "#464555",
                        "outline-variant": "#c7c4d8",
                        background: "#f8f9ff",
                        surface: "#f8f9ff",
                    }
                }
            }
        }
    </script>
    <style>
        body {font-family: 'Geist', sans-serif; background-color: #f8f9ff;}
    </style>
</head>

<body class="text-on-surface min-h-screen flex items-center justify-center relative overflow-hidden px-4">
    <!-- Decorative background blobs -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-primary/10 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-secondary-container/30 rounded-full blur-3xl"></div>

    <div class="w-full max-w-[460px] bg-white border border-outline-variant rounded-2xl shadow-xl p-8 md:p-10 relative z-10 animate-in fade-in slide-in-from-bottom-4 duration-500">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-headline-lg font-black text-primary tracking-tight text-[36px]">Focus</h1>
            <p class="text-body-lg text-on-surface-variant mt-2">Create your account to start managing tasks</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 text-body-md rounded-xl flex items-start gap-2">
                <span class="material-symbols-outlined shrink-0 text-red-500">error</span>
                <div>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form action="{{ route('register.store') }}" method="POST" class="space-y-5">
            @csrf
            <!-- Name -->
            <div>
                <label class="font-label-md text-label-md text-on-surface-variant block mb-1.5 uppercase tracking-wider text-[11px]" for="name">Full Name</label>
                <div class="relative group">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant/60 group-focus-within:text-primary transition-colors">person</span>
                    <input class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary font-body-md text-body-md bg-white outline-none transition-all"
                           id="name" type="text" name="name" placeholder="Alexander Wright" value="{{ old('name') }}" required />
                </div>
            </div>

            <!-- Email -->
            <div>
                <label class="font-label-md text-label-md text-on-surface-variant block mb-1.5 uppercase tracking-wider text-[11px]" for="email">Email Address</label>
                <div class="relative group">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant/60 group-focus-within:text-primary transition-colors">mail</span>
                    <input class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary font-body-md text-body-md bg-white outline-none transition-all"
                           id="email" type="email" name="email" placeholder="alexander.w@focus.com" value="{{ old('email') }}" required />
                </div>
            </div>

            <!-- Password -->
            <div>
                <label class="font-label-md text-label-md text-on-surface-variant block mb-1.5 uppercase tracking-wider text-[11px]" for="password">Password</label>
                <div class="relative group">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant/60 group-focus-within:text-primary transition-colors">lock</span>
                    <input class="w-full pl-10 pr-12 py-2.5 rounded-xl border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary font-body-md text-body-md bg-white outline-none transition-all"
                           id="password" type="password" name="password" placeholder="••••••••" required autocomplete="new-password" />
                    <button type="button" id="toggle-password" class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant/60 hover:text-on-surface focus:outline-none">
                        <span class="material-symbols-outlined" id="password-icon">visibility</span>
                    </button>
                </div>
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="font-label-md text-label-md text-on-surface-variant block mb-1.5 uppercase tracking-wider text-[11px]" for="password_confirmation">Confirm Password</label>
                <div class="relative group">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant/60 group-focus-within:text-primary transition-colors">lock</span>
                    <input class="w-full pl-10 pr-12 py-2.5 rounded-xl border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary font-body-md text-body-md bg-white outline-none transition-all"
                           id="password_confirmation" type="password" name="password_confirmation" placeholder="••••••••" required autocomplete="new-password" />
                    <button type="button" id="toggle-confirm" class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant/60 hover:text-on-surface focus:outline-none">
                        <span class="material-symbols-outlined" id="confirm-icon">visibility</span>
                    </button>
                </div>
            </div>

            <!-- Submit -->
            <button class="w-full py-3 bg-primary text-white hover:opacity-90 active:scale-95 transition-all rounded-xl font-bold text-body-lg shadow-md flex items-center justify-center gap-2 mt-2"
                    type="submit">
                Register
                <span class="material-symbols-outlined text-[18px]">person_add</span>
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-outline-variant text-center">
            <p class="text-body-md text-on-surface-variant">Already have an account? <a href="{{ route('login') }}" class="text-primary font-bold hover:underline">Sign In</a></p>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('toggle-password');
        const pwdInput = document.getElementById('password');
        const pwdIcon = document.getElementById('password-icon');
        if (togglePassword && pwdInput && pwdIcon) {
            togglePassword.addEventListener('click', () => {
                const type = pwdInput.getAttribute('type') === 'password' ? 'text' : 'password';
                pwdInput.setAttribute('type', type);
                pwdIcon.textContent = type === 'password' ? 'visibility' : 'visibility_off';
            });
        }
        const toggleConfirm = document.getElementById('toggle-confirm');
        const confirmInput = document.getElementById('password_confirmation');
        const confirmIcon = document.getElementById('confirm-icon');
        if (toggleConfirm && confirmInput && confirmIcon) {
            toggleConfirm.addEventListener('click', () => {
                const type = confirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmInput.setAttribute('type', type);
                confirmIcon.textContent = type === 'password' ? 'visibility' : 'visibility_off';
            });
        }
    </script>
</body>
</html>
