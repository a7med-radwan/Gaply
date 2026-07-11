<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaply — Reset Password</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://api.fontshare.com/v2/css?f[]=cabinet-grotesk@700,800,900&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        rel="stylesheet">

    <script>
        (function () {
            const saved = localStorage.getItem('gaply-theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (saved === 'dark' || (!saved && prefersDark)) document.documentElement.classList.add('dark');
        })();
    </script>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>tailwind.config = { darkMode: 'class' }</script>

    <style>
        :root {
            --color-primary: #232A5C;
            --color-bg: #F5F7FB;
            --color-surface: #FFFFFF;
            --color-border: #E1E6EF;
            --color-text: #1A1D2E;
            --color-muted: #5B6172;
            --color-danger-bg: #FDEAE8;
            --color-danger-text: #B23026;
        }

        .dark {
            --color-primary: #4A54A8;
            --color-bg: #12142B;
            --color-surface: #1C2044;
            --color-border: #2A2F57;
            --color-text: #F1F2F8;
            --color-muted: #8B8FB0;
            --color-danger-bg: #4A1B16;
            --color-danger-text: #F0968A;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--color-bg);
            color: var(--color-text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            transition: background-color 0.2s;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
            line-height: 1;
        }

        .card {
            background: var(--color-surface);
            border: 1px solid var(--color-border);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 8px 40px rgba(35, 42, 92, 0.08);
        }

        input {
            width: 100%;
            padding: 10px 44px 10px 40px;
            border: 1px solid var(--color-border);
            border-radius: 10px;
            background: var(--color-surface);
            color: var(--color-text);
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        input:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(35, 42, 92, 0.10);
        }

        label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--color-muted);
            margin-bottom: 6px;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: var(--color-primary);
            color: #fff;
            font-weight: 600;
            font-size: 15px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: opacity 0.15s, transform 0.1s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-family: 'Inter', sans-serif;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn:active {
            transform: scale(0.98);
        }

        .blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
            z-index: 0;
        }
    </style>
</head>

<body>
    <div class="blob" style="width:300px;height:300px;background:rgba(35,42,92,0.07);bottom:-60px;right:-60px;"></div>

    <div class="card" style="position:relative;z-index:1;">
        <div style="text-align:center;margin-bottom:28px;">
            <h1
                style="font-family:'Cabinet Grotesk',sans-serif;font-size:36px;font-weight:900;color:var(--color-primary);letter-spacing:-0.02em;margin:0;">
                Gaply
            </h1>
            <p style="color:var(--color-muted);font-size:15px;margin-top:6px;">Set your new password</p>
        </div>

        @if ($errors->any())
            <div
                style="padding:12px 16px;border-radius:10px;background:var(--color-danger-bg);color:var(--color-danger-text);font-size:14px;margin-bottom:20px;display:flex;gap:8px;align-items:flex-start;">
                <span class="material-symbols-outlined" style="font-size:18px;flex-shrink:0;">error</span>
                <ul style="list-style:disc;padding-left:16px;margin:0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST"
            style="display:flex;flex-direction:column;gap:18px;">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <input type="hidden" name="{{ config('fortify.email') }}" value="{{ $request->input('email') }}">

            <div>
                <label for="password">New Password</label>
                <div style="position:relative;">
                    <span class="material-symbols-outlined"
                        style="position:absolute;left:12px;top:50%;transform:translateY(-50%);font-size:18px;color:var(--color-muted);pointer-events:none;">lock</span>
                    <input id="password" type="password" name="password" placeholder="Min. 8 characters" required
                        autofocus>
                    <button type="button" id="toggle-password"
                        style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--color-muted);display:flex;padding:0;">
                        <span class="material-symbols-outlined" id="pw-icon" style="font-size:18px;">visibility</span>
                    </button>
                </div>
            </div>

            <div>
                <label for="password_confirmation">Confirm New Password</label>
                <div style="position:relative;">
                    <span class="material-symbols-outlined"
                        style="position:absolute;left:12px;top:50%;transform:translateY(-50%);font-size:18px;color:var(--color-muted);pointer-events:none;">lock</span>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        placeholder="Repeat password" required>
                    <button type="button" id="toggle-confirm"
                        style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--color-muted);display:flex;padding:0;">
                        <span class="material-symbols-outlined" id="confirm-icon"
                            style="font-size:18px;">visibility</span>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn">
                Reset Password
                <span class="material-symbols-outlined" style="font-size:18px;">lock_reset</span>
            </button>
        </form>

        <div style="margin-top:24px;text-align:center;">
            <a href="{{ route('login') }}"
                style="font-size:14px;color:var(--color-primary);font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:4px;">
                <span class="material-symbols-outlined" style="font-size:16px;">arrow_back</span>
                Back to Sign In
            </a>
        </div>
    </div>

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
        makeToggle('toggle-password', 'password', 'pw-icon');
        makeToggle('toggle-confirm', 'password_confirmation', 'confirm-icon');
    </script>
</body>

</html>