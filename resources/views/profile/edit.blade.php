<x-layout title="My Profile — Gaply">

    <!-- PAGE HEADER -->
    <div class="mb-6 space-y-1 shrink-0">
        <h1 class="font-display font-bold text-2xl md:text-3xl text-white tracking-tight">My Profile</h1>
        <p class="text-sm text-textSecondary font-sans">Manage your personal information and target job.</p>
    </div>

    <!-- MAIN FORM WRAPPER -->
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">

            <!-- LEFT COLUMN: PHOTO & ACCOUNT METADATA (Col span 4) -->
            <div class="lg:col-span-4 flex flex-col gap-6">

                <!-- Avatar Upload Card -->
                <div
                    class="rounded-2xl border border-darkBorder/60 bg-darkCard p-6 shadow-xl flex flex-col items-center justify-center text-center space-y-5">
                    <div class="relative group">
                        <!-- Preview Image -->
                        @php
                            $editAvatarUrl = $user->profile_image
                                ? (str_starts_with($user->profile_image, 'http') ? $user->profile_image : Storage::url($user->profile_image))
                                : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=38bdf8&color=fff&size=128';
                        @endphp
                        <img id="profile-preview"
                            src="{{ $editAvatarUrl }}"
                            alt="{{ $user->name }}"
                            class="w-32 h-32 rounded-full object-cover border-2 border-darkBorder group-hover:border-oceanBlue/50 transition-all duration-300 shadow-glowBlue">

                        <!-- Upload Overlay -->
                        <label for="profile_image"
                            class="absolute inset-0 rounded-full bg-black/75 flex flex-col items-center justify-center cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="material-symbols-outlined text-white text-2xl">upload</span>
                            <span class="text-xs text-white font-bold mt-1 tracking-wider">Upload Photo</span>
                        </label>

                        <!-- File Input -->
                        <input id="profile_image" type="file" name="profile_image"
                            accept="image/jpg,image/jpeg,image/png" class="hidden">
                    </div>

                    <div class="space-y-1">
                        <h4 class="font-display font-bold text-base text-white tracking-tight">{{ $user->name }}</h4>
                        <p class="text-sm text-textSecondary font-mono">{{ $user->email }}</p>
                        <p class="text-xs text-textSecondary/50 font-sans pt-1">JPG or PNG. Max size: 2MB</p>
                    </div>
                </div>

                <!-- Account Metadata Summary Card -->
                <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-5 shadow-xl space-y-4">
                    <div class="flex items-center gap-2 border-b border-darkBorder/40 pb-2.5">
                        <span class="material-symbols-outlined text-oceanBlue text-lg">manage_accounts</span>
                        <h3 class="font-display font-bold text-sm text-white">Account Details</h3>
                    </div>

                    <div class="space-y-3.5 text-xs">
                        <div class="flex justify-between items-center py-1.5 border-b border-darkBorder/20">
                            <span class="text-textSecondary font-semibold font-sans">Username</span>
                            <span
                                class="font-bold text-white font-mono truncate max-w-[130px]">{{ $user->username }}</span>
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

            </div>

            <!-- RIGHT COLUMN: PROFILE DETAILS & BIO (Col span 8) -->
            <div class="lg:col-span-8 flex flex-col">

                <!-- Main Form Fields Card -->
                <div
                    class="rounded-2xl border border-darkBorder/60 bg-darkCard p-6 shadow-xl space-y-6 flex-1 flex flex-col justify-between">

                    <div class="space-y-6">
                        <div class="flex items-center gap-2 border-b border-darkBorder/40 pb-3">
                            <span class="material-symbols-outlined text-oceanBlue text-lg">badge</span>
                            <h3 class="font-display font-bold text-sm text-white">Profile Details</h3>
                        </div>

                        <!-- Grid: Name, Email & Target Job -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <!-- Full Name -->
                            <div class="space-y-1.5">
                                <label for="name" class="block text-xs font-semibold text-textSecondary">Full
                                    Name</label>
                                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required
                                    placeholder="Your full name"
                                    class="w-full px-3.5 py-2.5 rounded-xl border bg-darkBg text-sm outline-none text-white transition-all {{ $errors->has('name') ? 'border-red-500/80 focus:border-red-500 focus:ring-1 focus:ring-red-500' : 'border-darkBorder focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue' }}">
                            </div>

                            <!-- Email Address -->
                            <div class="space-y-1.5">
                                <label for="email" class="block text-xs font-semibold text-textSecondary">Email
                                    Address</label>
                                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}"
                                    required placeholder="your.email@example.com"
                                    class="w-full px-3.5 py-2.5 rounded-xl border bg-darkBg text-sm outline-none text-white transition-all {{ $errors->has('email') ? 'border-red-500/80 focus:border-red-500 focus:ring-1 focus:ring-red-500' : 'border-darkBorder focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue' }}">
                            </div>

                            <!-- Target Role (Select) -->
                            <div class="space-y-1.5 sm:col-span-2">
                                <label for="target_job" class="block text-xs font-semibold text-textSecondary">Target
                                    Job (Goal)</label>
                                <select id="target_job" name="target_job"
                                    class="w-full px-3.5 py-2.5 rounded-xl border bg-darkBg text-sm outline-none text-white transition-all {{ $errors->has('target_job') ? 'border-red-500/80 focus:border-red-500 focus:ring-1 focus:ring-red-500' : 'border-darkBorder focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue' }}">
                                    <option value="" class="bg-darkCard text-textSecondary">Select target job...
                                    </option>
                                    @foreach ($jobTitles as $title)
                                        <option value="{{ $title }}" class="bg-darkCard text-white" {{ old('target_job', $user->target_job) === $title ? 'selected' : '' }}>{{ $title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>                        <!-- Professional Experience -->
                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between">
                                <label for="experience" class="block text-xs font-semibold text-textSecondary font-sans">My Experience / Projects</label>
                                <button type="submit" formaction="{{ route('profile.optimize-bio') }}" class="text-xs font-bold text-oceanBlue hover:text-white transition-colors flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">auto_awesome</span>
                                    Optimize with AI
                                </button>
                            </div>
                            <textarea id="experience" name="experience" rows="5"
                                placeholder="Write about your previous jobs, projects, or studies..."
                                class="w-full px-3.5 py-3 rounded-xl border bg-darkBg text-sm outline-none text-white transition-all resize-none {{ $errors->has('experience') ? 'border-red-500/80 focus:border-red-500 focus:ring-1 focus:ring-red-500' : 'border-darkBorder focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue' }}">{{ session('optimized_experience') ?? old('experience', $user->experience) }}</textarea>
                        </div>
                    </div>

                    <!-- Submit Section -->
                    <div class="flex justify-end items-center gap-3 pt-4 border-t border-darkBorder/40">
                        <a href="{{ route('profile.show') }}"
                            class="px-5 py-3 rounded-xl text-sm font-bold border border-darkBorder text-textSecondary hover:text-white transition-all text-center">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-6 py-3 rounded-xl text-sm font-bold text-white bg-oceanBlue hover:bg-oceanHover shadow-premium transition-all active:scale-[0.98] flex items-center gap-2">
                            <span class="material-symbols-outlined text-base">save</span>
                            Save Changes
                        </button>
                    </div>

                </div>

            </div>

        </div>
    </form>



    <script>
        document.getElementById('profile_image').addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const url = URL.createObjectURL(this.files[0]);
                
                // Update main profile settings card image preview
                const preview = document.getElementById('profile-preview');
                if (preview) {
                    preview.src = url;
                }
                
                // Update sidebar navigation user avatar preview
                const sidebar = document.getElementById('sidebar-avatar');
                if (sidebar) {
                    sidebar.src = url;
                }
            }
        });
    </script>
</x-layout>