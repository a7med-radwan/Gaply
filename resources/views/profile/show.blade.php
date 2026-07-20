<x-layout title="My Profile — Gaply">

    <!-- PAGE HEADER -->
    <div class="mb-6 space-y-1 shrink-0">
        <h1 class="font-display font-bold text-2xl md:text-3xl text-white tracking-tight">My Profile</h1>
        <p class="text-sm text-textSecondary font-sans">View your profile details and target job.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
        
        <!-- LEFT COLUMN: PHOTO & ACCOUNT METADATA (Col span 4) -->
        <div class="lg:col-span-4 flex flex-col gap-6">
            
            <!-- Avatar Card -->
            <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-6 shadow-xl flex flex-col items-center justify-center text-center space-y-5">
                <div class="relative">
                    @php
                        $avatarUrl = $user->profile_image
                            ? (str_starts_with($user->profile_image, 'http') ? $user->profile_image : Storage::url($user->profile_image))
                            : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=38bdf8&color=fff&size=128';
                    @endphp
                    <img src="{{ $avatarUrl }}"
                         alt="{{ $user->name }}"
                         class="w-32 h-32 rounded-full object-cover border-2 border-darkBorder shadow-glowBlue">
                </div>

                <div class="space-y-1">
                    <h4 class="font-display font-bold text-base text-white tracking-tight">{{ $user->name }}</h4>
                    <p class="text-sm text-textSecondary font-mono">{{ $user->email }}</p>
                </div>
            </div>

            <!-- Account Details Card -->
            <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-5 shadow-xl space-y-4">
                <div class="flex items-center gap-2 border-b border-darkBorder/40 pb-2.5">
                    <span class="material-symbols-outlined text-oceanBlue text-lg">manage_accounts</span>
                    <h3 class="font-display font-bold text-sm text-white">Account Details</h3>
                </div>

                <div class="space-y-3.5 text-xs">
                    <div class="flex justify-between items-center py-1.5 border-b border-darkBorder/20">
                        <span class="text-textSecondary font-semibold font-sans">Username</span>
                        <span class="font-bold text-white font-mono truncate max-w-[130px]">{{ $user->username }}</span>
                    </div>
                    <div class="flex justify-between items-center py-1.5 border-b border-darkBorder/20">
                        <span class="text-textSecondary font-semibold font-sans">Status</span>
                        <span class="font-bold text-emerald-400 font-sans flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            Active
                        </span>
                    </div>
                    <div class="flex justify-between items-center py-1.5">
                        <span class="text-textSecondary font-semibold font-sans">Joined Date</span>
                        <span class="font-mono text-white">{{ $user->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            {{-- Password Card: hidden for Google-only accounts --}}
            @if (!$user->google_id || $user->password)
            <form action="{{ route('user-password.update') }}" method="POST" class="rounded-2xl border border-darkBorder/60 bg-darkCard p-5 shadow-xl space-y-4">
                @csrf
                @method('PUT')
                
                <div class="flex items-center gap-2 border-b border-darkBorder/40 pb-2.5">
                    <span class="material-symbols-outlined text-oceanBlue text-lg">lock</span>
                    <h3 class="font-display font-bold text-sm text-white">Update Password</h3>
                </div>

                {{-- Password Status Alerts --}}
                @if (session('status') === 'password-updated')
                    <div class="p-3 rounded-xl border border-emerald-500/20 bg-emerald-500/10 text-xs font-semibold text-emerald-400 flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">check_circle</span>
                        Password updated!
                    </div>
                @endif

                @if ($errors->updatePassword->any())
                    <div class="p-3 rounded-xl border border-red-500/20 bg-red-500/10 text-[11px] font-semibold text-red-400 flex items-start gap-2">
                        <span class="material-symbols-outlined text-[18px] shrink-0">error</span>
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach ($errors->updatePassword->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Password Fields (Vertical stack for left column narrow container) -->
                <div class="space-y-3">
                    <div class="space-y-1">
                        <label for="current_password" class="block text-xs font-semibold text-textSecondary">Current Password</label>
                        <div class="relative">
                            <input id="current_password" name="current_password" type="password" required placeholder="Enter current password"
                                class="w-full pl-3.5 pr-10 py-2.5 rounded-xl border border-darkBorder bg-darkBg text-xs outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all">
                            <button type="button" id="toggle-current-password" class="absolute right-3 top-1/2 -translate-y-1/2 text-textSecondary hover:text-white transition-colors">
                                <span class="material-symbols-outlined text-[18px]" id="current-password-icon">visibility</span>
                            </button>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label for="update_password" class="block text-xs font-semibold text-textSecondary">New Password</label>
                        <div class="relative">
                            <input id="update_password" name="password" type="password" required placeholder="Min. 8 characters"
                                class="w-full pl-3.5 pr-10 py-2.5 rounded-xl border border-darkBorder bg-darkBg text-xs outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all">
                            <button type="button" id="toggle-update-password" class="absolute right-3 top-1/2 -translate-y-1/2 text-textSecondary hover:text-white transition-colors">
                                <span class="material-symbols-outlined text-[18px]" id="update-password-icon">visibility</span>
                            </button>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label for="update_password_confirmation" class="block text-xs font-semibold text-textSecondary">Confirm New Password</label>
                        <div class="relative">
                            <input id="update_password_confirmation" name="password_confirmation" type="password" required placeholder="Confirm new password"
                                class="w-full pl-3.5 pr-10 py-2.5 rounded-xl border border-darkBorder bg-darkBg text-xs outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all">
                            <button type="button" id="toggle-confirm-password" class="absolute right-3 top-1/2 -translate-y-1/2 text-textSecondary hover:text-white transition-colors">
                                <span class="material-symbols-outlined text-[18px]" id="confirm-password-icon">visibility</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-3 border-t border-darkBorder/40">
                    <button type="submit"
                        class="w-full px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-oceanBlue hover:bg-oceanHover shadow-premium transition-all active:scale-[0.98] flex items-center justify-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px]">vpn_key</span>
                        Update Password
                    </button>
                </div>
            </form>

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
                makeToggle('toggle-current-password', 'current_password', 'current-password-icon');
                makeToggle('toggle-update-password', 'update_password', 'update-password-icon');
                makeToggle('toggle-confirm-password', 'update_password_confirmation', 'confirm-password-icon');
            </script>

            @else
            {{-- Google account notice --}}
            <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-5 shadow-xl flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl bg-darkBg border border-darkBorder flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-bold text-white">Password managed by Google</p>
                    <p class="text-xs text-textSecondary mt-0.5">Your account uses Google Sign-In. Password changes are made via your Google account.</p>
                </div>
            </div>
            @endif

        </div>

        <!-- RIGHT COLUMN: PROFILE DETAILS & BIO (Col span 8) -->
        <div class="lg:col-span-8 flex flex-col">
            
            <!-- Profile Details Card -->
            <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-6 shadow-xl space-y-6 flex-1 flex flex-col justify-between">
                
                <div class="space-y-6">
                    <div class="flex items-center gap-2 border-b border-darkBorder/40 pb-3">
                        <span class="material-symbols-outlined text-oceanBlue text-lg">badge</span>
                        <h3 class="font-display font-bold text-sm text-white">Profile Details</h3>
                    </div>

                    <!-- Details Fields -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Full Name -->
                        <div class="space-y-1">
                            <p class="text-xs font-semibold text-textSecondary">Full Name</p>
                            <p class="text-sm font-bold text-white py-2 px-3.5 bg-darkBg/30 rounded-xl border border-darkBorder/40">{{ $user->name }}</p>
                        </div>

                        <!-- Email Address -->
                        <div class="space-y-1">
                            <p class="text-xs font-semibold text-textSecondary">Email Address</p>
                            <p class="text-sm font-bold text-white py-2 px-3.5 bg-darkBg/30 rounded-xl border border-darkBorder/40">{{ $user->email }}</p>
                        </div>

                        <!-- Target Job -->
                        <div class="space-y-1 sm:col-span-2">
                            <p class="text-xs font-semibold text-textSecondary">Target Job (Goal)</p>
                            <p class="text-sm font-bold text-white py-2 px-3.5 bg-darkBg/30 rounded-xl border border-darkBorder/40">
                                {{ $user->target_job ?? 'Not selected' }}
                            </p>
                        </div>
                    </div>

                    <!-- Experience -->
                    <div class="space-y-1">
                        <p class="text-xs font-semibold text-textSecondary">My Experience / Projects</p>
                        <div class="text-sm text-white py-3 px-3.5 bg-darkBg/30 rounded-xl border border-darkBorder/40 min-h-[120px] whitespace-pre-line leading-relaxed font-sans">
                            {!! $user->experience ? e($user->experience) : '<span class="text-textSecondary italic">No experience described yet.</span>' !!}
                        </div>
                    </div>
                </div>

                <!-- Edit Profile Button -->
                <div class="flex justify-end pt-4 border-t border-darkBorder/40">
                    <a href="{{ route('profile.edit') }}" class="px-6 py-3 rounded-xl text-sm font-bold text-white bg-oceanBlue hover:bg-oceanHover shadow-premium transition-all active:scale-[0.98] flex items-center gap-2">
                        <span class="material-symbols-outlined text-base">edit</span>
                        Edit Profile
                    </a>
                </div>

            </div>

        </div>

    </div>

</x-layout>
