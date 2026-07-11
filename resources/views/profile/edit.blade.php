<x-layout title="My Profile — Gaply">

    <!-- HEADER -->
    <div class="mb-10 space-y-2">
        <h1 class="font-display font-black text-4xl text-white tracking-tight">My Profile</h1>
        <p class="text-sm text-textSecondary">Manage your professional credentials, target role, and technical competencies.</p>
    </div>

    <!-- MAIN TWO-COLUMN LAYOUT -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- LEFT COLUMN: Professional Info & Skills (2/3 width) -->
        <div class="lg:col-span-8 space-y-8">
            
            <!-- SECTION 1: Professional Info Form -->
            <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-6 md:p-8 shadow-xl space-y-6">
                <div class="flex items-center gap-3 border-b border-darkBorder/40 pb-4">
                    <span class="material-symbols-outlined text-oceanBlue text-2xl">badge</span>
                    <h3 class="font-display font-bold text-lg text-white">Professional Details</h3>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Profile Photo with JS Preview -->
                    <div class="flex flex-col sm:flex-row items-center gap-6">
                        <div class="relative group">
                            <img id="profile-preview" 
                                 src="{{ $user->profile_image ? Storage::url($user->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=2d74b3&color=fff&size=128' }}" 
                                 alt="{{ $user->name }}" 
                                 class="w-24 h-24 rounded-full object-cover border-2 border-darkBorder group-hover:border-oceanBlue/50 transition-all duration-300">
                            
                            <label for="profile_image" class="absolute inset-0 rounded-full bg-black/60 flex items-center justify-center cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <span class="material-symbols-outlined text-white text-xl">upload</span>
                            </label>
                            <input id="profile_image" type="file" name="profile_image" accept="image/jpg,image/jpeg,image/png" class="hidden"
                                   onchange="document.getElementById('profile-preview').src=URL.createObjectURL(event.target.files[0])">
                        </div>
                        <div class="text-center sm:text-left space-y-1">
                            <p class="text-sm font-bold text-white">Avatar Profile Image</p>
                            <p class="text-xs text-textSecondary">JPG or PNG. Max size 2MB. Click on the image to upload a new one.</p>
                        </div>
                    </div>

                    <!-- Specialization Input -->
                    <div class="space-y-1.5">
                        <label for="specialization" class="block text-[10px] font-bold uppercase tracking-wider text-textSecondary">Professional Specialization</label>
                        <input id="specialization" name="specialization" type="text" 
                               value="{{ old('specialization', $user->specialization) }}" 
                               placeholder="e.g. Fullstack Engineer, Laravel Backend Specialist..." 
                               class="w-full px-4 py-3 rounded-xl border border-darkBorder bg-darkBg/30 text-sm outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all">
                    </div>

                    <!-- Bio Textarea -->
                    <div class="space-y-1.5">
                        <label for="bio" class="block text-[10px] font-bold uppercase tracking-wider text-textSecondary">Professional Biography</label>
                        <textarea id="bio" name="bio" rows="4" 
                                  placeholder="Summarize your years of experience, core technical achievements, or career roadmap goals..." 
                                  class="w-full px-4 py-3 rounded-xl border border-darkBorder bg-darkBg/30 text-sm outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all resize-none">{{ old('bio', $user->bio) }}</textarea>
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" class="px-6 py-3 rounded-xl text-sm font-bold text-white bg-oceanBlue hover:bg-oceanHover shadow-premium hover:shadow-glowBlue transition-all active:scale-[0.98] flex items-center gap-2">
                            <span class="material-symbols-outlined text-base">save</span>
                            Save Details
                        </button>
                    </div>
                </form>
            </div>

            <!-- SECTION 2: Skills Management Card -->
            <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-6 md:p-8 shadow-xl space-y-8">
                <div class="flex items-center gap-3 border-b border-darkBorder/40 pb-4">
                    <span class="material-symbols-outlined text-oceanBlue text-2xl">bolt</span>
                    <h3 class="font-display font-bold text-lg text-white">My Technical Skills</h3>
                </div>

                <!-- Acquired Skills list -->
                @if ($userSkills->isEmpty())
                    <div class="py-12 text-center space-y-4 rounded-xl border border-dashed border-darkBorder/50 bg-darkBg/10">
                        <span class="material-symbols-outlined text-5xl text-textSecondary/20">psychology</span>
                        <div class="space-y-1">
                            <p class="text-sm font-bold text-white">No skills added yet</p>
                            <p class="text-xs text-textSecondary max-w-xs mx-auto">Select a skill from the list below and configure its master level to initialize your analysis profile.</p>
                        </div>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach ($userSkills as $us)
                            <div class="p-4 rounded-xl border border-darkBorder bg-darkBg/40 hover:border-oceanBlue/30 hover:bg-darkBg/80 transition-all duration-300 flex items-center justify-between group">
                                <div class="space-y-1.5 min-w-0">
                                    <div class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-accentTeal shadow-glowBlue"></span>
                                        <p class="text-sm font-bold text-white truncate">{{ $us->skill->name }}</p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        @if ($us->skill->category)
                                            <span class="text-[9px] font-semibold uppercase tracking-wider text-textSecondary bg-darkCard px-2 py-0.5 rounded border border-darkBorder/40">
                                                {{ $us->skill->category }}
                                            </span>
                                        @endif
                                        
                                        <!-- Skill Level Tag color-coded -->
                                        @if ($us->level->value === 'advanced')
                                            <span class="text-[9px] font-bold uppercase tracking-wider text-accentTeal bg-accentTeal/10 px-2 py-0.5 rounded">
                                                Advanced
                                            </span>
                                        @elseif ($us->level->value === 'intermediate')
                                            <span class="text-[9px] font-bold uppercase tracking-wider text-amber-400 bg-amber-400/10 px-2 py-0.5 rounded">
                                                Intermediate
                                            </span>
                                        @else
                                            <span class="text-[9px] font-bold uppercase tracking-wider text-textSecondary/70 bg-darkCard px-2 py-0.5 rounded">
                                                Beginner
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="flex items-center gap-1 opacity-80 group-hover:opacity-100 transition-opacity">
                                    <!-- Edit Trigger -->
                                    <button type="button" onclick="openEditModal({{ $us->id }}, '{{ $us->level->value }}')" class="p-2 rounded-lg hover:bg-darkCard hover:text-oceanBlue text-textSecondary transition-colors" title="Edit Level">
                                        <span class="material-symbols-outlined text-lg">edit</span>
                                    </button>

                                    <!-- Delete action -->
                                    <form action="{{ route('profile.skills.destroy', $us) }}" method="POST" onsubmit="return confirm('Remove {{ $us->skill->name }} from profile?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg hover:bg-red-500/10 hover:text-red-400 text-textSecondary transition-colors" title="Remove Skill">
                                            <span class="material-symbols-outlined text-lg">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <hr class="border-darkBorder/40">

                <!-- Add Skill Form Inline -->
                <div class="space-y-4">
                    <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-textSecondary">Add New Skill Capability</h4>
                    <form action="{{ route('profile.skills.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-end bg-darkBg/20 p-5 rounded-2xl border border-darkBorder/40">
                        @csrf
                        
                        <div class="sm:col-span-6 space-y-1.5">
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-textSecondary">Select Skill</label>
                            <select name="skill_id" class="w-full px-4 py-2.5 rounded-xl border border-darkBorder bg-darkCard text-sm outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all">
                                <option value="">Choose skill...</option>
                                @foreach ($allSkills as $skill)
                                    <option value="{{ $skill->id }}" {{ old('skill_id') == $skill->id ? 'selected' : '' }}>
                                        {{ $skill->name }}{{ $skill->category ? ' ('.$skill->category.')' : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="sm:col-span-4 space-y-1.5">
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-textSecondary">Expertise Level</label>
                            <select name="level" class="w-full px-4 py-2.5 rounded-xl border border-darkBorder bg-darkCard text-sm outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all">
                                <option value="">Level...</option>
                                <option value="beginner" {{ old('level') === 'beginner' ? 'selected' : '' }}>Beginner</option>
                                <option value="intermediate" {{ old('level') === 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                <option value="advanced" {{ old('level') === 'advanced' ? 'selected' : '' }}>Advanced</option>
                            </select>
                        </div>

                        <div class="sm:col-span-2">
                            <button type="submit" class="w-full py-3.5 rounded-xl text-xs font-bold text-white bg-oceanBlue hover:bg-oceanHover shadow-premium transition-all active:scale-[0.98] flex items-center justify-center gap-1.5">
                                <span class="material-symbols-outlined text-sm">add</span>
                                Add
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: Target Job & Account Details (1/3 width) -->
        <div class="lg:col-span-4 space-y-8">
            
            <!-- Target Job update Form -->
            <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-6 md:p-8 shadow-xl space-y-6">
                <div class="flex items-center gap-3 border-b border-darkBorder/40 pb-4">
                    <span class="material-symbols-outlined text-oceanBlue text-2xl">track_changes</span>
                    <h3 class="font-display font-bold text-lg text-white">Target Job</h3>
                </div>

                <p class="text-xs text-textSecondary leading-relaxed">
                    Set the specific engineering profile or career you are targeting. This is dynamically calculated to output your job readiness index.
                </p>

                <form action="{{ route('profile.target-job.update') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="space-y-1.5">
                        <select name="target_job" class="w-full px-4 py-2.5 rounded-xl border border-darkBorder bg-darkBg/30 text-sm outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all">
                            <option value="">Select target role...</option>
                            @foreach ($jobTitles as $title)
                                <option value="{{ $title }}" {{ $user->target_job === $title ? 'selected' : '' }}>{{ $title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="w-full py-3.5 rounded-xl text-xs font-bold text-white bg-oceanBlue hover:bg-oceanHover shadow-premium transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm">check</span>
                        Update Target Role
                    </button>
                </form>

                @if ($user->target_job)
                    <div class="flex items-center gap-3 p-4 rounded-xl border border-oceanBlue/20 bg-oceanBlue/5">
                        <div class="w-8 h-8 rounded-lg bg-oceanBlue/10 flex items-center justify-center text-oceanBlue shrink-0">
                            <span class="material-symbols-outlined text-lg">work</span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-[9px] font-mono font-bold text-oceanBlue uppercase tracking-wider">Active Target</p>
                            <p class="text-sm font-bold text-white truncate">{{ $user->target_job }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Account Details summary -->
            <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-6 md:p-8 shadow-xl space-y-6">
                <div class="flex items-center gap-3 border-b border-darkBorder/40 pb-4">
                    <span class="material-symbols-outlined text-oceanBlue text-2xl">manage_accounts</span>
                    <h3 class="font-display font-bold text-lg text-white">Account Details</h3>
                </div>

                <div class="space-y-4 text-xs">
                    <div class="flex justify-between items-center py-2 border-b border-darkBorder/20">
                        <span class="text-textSecondary font-semibold">User Name</span>
                        <span class="font-bold text-white">{{ $user->name }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-darkBorder/20">
                        <span class="text-textSecondary font-semibold">Email Address</span>
                        <span class="font-bold text-white truncate max-w-[150px]">{{ $user->email }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="text-textSecondary font-semibold">Registered Since</span>
                        <span class="font-mono text-white">{{ $user->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- EDIT SKILL MODAL DIALOG (BLUR BACKDROP GLASSMORPHISM) -->
    <div id="edit-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/75 backdrop-blur-sm" onclick="closeEditModal()"></div>
        
        <!-- Modal Card -->
        <div class="rounded-2xl border border-darkBorder bg-darkCard p-8 w-full max-w-sm relative z-10 shadow-2xl space-y-6">
            <div class="space-y-1">
                <h3 class="font-display font-bold text-lg text-white">Update Skill Mastery</h3>
                <p class="text-xs text-textSecondary">Update your estimated master level for this skill.</p>
            </div>
            
            <form id="edit-form" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')
                <select name="level" id="edit-level" class="w-full px-4 py-3 rounded-xl border border-darkBorder bg-darkBg text-sm outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all">
                    <option value="beginner">Beginner</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="advanced">Advanced</option>
                </select>
                
                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeEditModal()" class="flex-1 py-3 rounded-xl text-xs font-bold border border-darkBorder text-textSecondary hover:text-white transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 py-3 rounded-xl text-xs font-bold text-white bg-oceanBlue hover:bg-oceanHover shadow-premium transition-all">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Event Handler -->
    <script>
        const editModal = document.getElementById('edit-modal');
        const editForm  = document.getElementById('edit-form');

        function openEditModal(id, level) {
            editForm.action = `/profile/skills/${id}`;
            document.getElementById('edit-level').value = level;
            editModal.style.display = 'flex';
        }
        function closeEditModal() { 
            editModal.style.display = 'none'; 
        }
    </script>
</x-layout>
