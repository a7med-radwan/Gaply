<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Focus - Reset Password</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&amp;display=swap" rel="stylesheet">
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
        body {
            font-family: 'Geist', sans-serif;
            background-color: #f8f9ff;
        }
    </style>
</head>

<body class="text-on-surface min-h-screen flex items-center justify-center relative overflow-hidden px-4">
    <!-- Decorative background elements -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-primary/10 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-secondary-container/30 rounded-full blur-3xl"></div>

    <div
        class="w-full max-w-[460px] bg-white border border-outline-variant rounded-2xl shadow-xl p-8 md:p-10 relative z-10 animate-in fade-in slide-in-from-bottom-4 duration-500">
        <!-- Logo and header -->
        <div class="text-center mb-8">
            <h1 class="text-headline-lg font-black text-primary tracking-tight text-[36px]">Focus</h1>
            <h2 class="text-headline-md text-on-surface mt-4 font-bold">Forgot Password?</h2>
            <p class="text-body-md text-on-surface-variant mt-2">Enter your email address and we'll send you a link to
                reset your password.</p>
        </div>

        @if (session('status'))
            <div
                class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 text-body-md rounded-xl flex items-start gap-2">
                <span class="material-symbols-outlined shrink-0 text-green-500">check_circle</span>
                <p>{{ session('status') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div
                class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 text-body-md rounded-xl flex items-start gap-2">
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

        <form action="{{ route('password.email') }}" method="POST" class="space-y-5">
            @csrf
            <!-- Email -->
            <div>
                <label
                    class="font-label-md text-label-md text-on-surface-variant block mb-1.5 uppercase tracking-wider text-[11px]"
                    for="email">Email Address</label>
                <div class="relative group">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant/60 group-focus-within:text-primary transition-colors">mail</span>
                    <input
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary font-body-md text-body-md bg-white outline-none transition-all"
                        id="email" type="email" name="{{ config('fortify.email') }}" placeholder="alexander.w@focus.com"
                        required autofocus />
                </div>
            </div>

            <!-- Submit Button -->
            <button
                class="w-full py-3 bg-primary text-white hover:opacity-90 active:scale-95 transition-all rounded-xl font-bold text-body-lg shadow-md flex items-center justify-center gap-2 mt-2"
                type="submit">
                Send Reset Link
                <span class="material-symbols-outlined text-[18px]">send</span>
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-outline-variant text-center">
            <a href="{{ route('login') }}"
                class="inline-flex items-center gap-2 text-primary font-bold hover:underline">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                Back to Sign In
            </a>
        </div>
    </div>
</body>

</html>