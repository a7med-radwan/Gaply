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
                    <img src="{{ $user->profile_image ? Storage::url($user->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=38bdf8&color=fff&size=128' }}" 
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

            <!-- Password Card (As a third card in the left column) -->
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
                        <input id="current_password" name="current_password" type="password" required placeholder="Enter current password"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-darkBorder bg-darkBg text-xs outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all">
                    </div>

                    <div class="space-y-1">
                        <label for="update_password" class="block text-xs font-semibold text-textSecondary">New Password</label>
                        <input id="update_password" name="password" type="password" required placeholder="Min. 8 characters"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-darkBorder bg-darkBg text-xs outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all">
                    </div>

                    <div class="space-y-1">
                        <label for="update_password_confirmation" class="block text-xs font-semibold text-textSecondary">Confirm New Password</label>
                        <input id="update_password_confirmation" name="password_confirmation" type="password" required placeholder="Confirm new password"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-darkBorder bg-darkBg text-xs outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all">
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
