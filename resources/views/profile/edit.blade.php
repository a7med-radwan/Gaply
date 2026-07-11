<x-layout title="My Profile — Gaply">

    <!-- HEADER (COMPACT) -->
    <div class="mb-4 space-y-0.5 shrink-0">
        <h1 class="font-display font-bold text-xl md:text-2xl text-white tracking-tight">My Profile</h1>
        <p class="text-[11px] text-textSecondary">Manage your professional credentials, target role, and technical competencies.</p>
    </div>

    <!-- MAIN TWO-COLUMN LAYOUT (FIXED HEIGHT ON DESKTOP) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 items-stretch lg:h-[calc(100vh-120px)] lg:overflow-hidden">
        
        <!-- LEFT COLUMN: Professional Info & Skills (2/3 width) -->
        <div class="lg:col-span-8 flex flex-col gap-5 lg:h-full lg:overflow-hidden">
            
            <!-- SECTION 1: Professional Info Form -->
            <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-4 md:p-5 shadow-xl space-y-4 shrink-0">
                <div class="flex items-center gap-2 border-b border-darkBorder/40 pb-2.5">
                    <span class="material-symbols-outlined text-oceanBlue text-lg">badge</span>
                    <h3 class="font-display font-bold text-xs uppercase tracking-wider text-white">Professional Details</h3>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div class="flex items-center gap-4 bg-darkBg/30 p-2.5 rounded-xl border border-darkBorder/40">
                        <div class="relative group shrink-0">
                            <img id="profile-preview" 
                                 src="{{ $user->profile_image ? Storage::url($user->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=38bdf8&color=fff&size=80' }}" 
                                 alt="{{ $user->name }}" 
                                 class="w-11 h-11 rounded-full object-cover border border-darkBorder group-hover:border-oceanBlue/50 transition-all duration-300">
                            
                            <label for="profile_image" class="absolute inset-0 rounded-full bg-black/75 flex items-center justify-center cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <span class="material-symbols-outlined text-white text-[14px]">upload</span>
                            </label>
                            <input id="profile_image" type="file" name="profile_image" accept="image/jpg,image/jpeg,image/png" class="hidden"
                                   onchange="document.getElementById('profile-preview').src=URL.createObjectURL(event.target.files[0])">
                        </div>
                        <div class="space-y-0.5">
                            <p class="text-[11px] font-bold text-white">Profile Photo</p>
                            <p class="text-[9px] text-textSecondary leading-relaxed">Click image to upload JPG/PNG (Max 2MB).</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label for="specialization" class="block text-[9px] font-bold uppercase tracking-wider text-textSecondary">Specialization</label>
                            <input id="specialization" name="specialization" type="text" 
                                   value="{{ old('specialization', $user->specialization) }}" 
                                   placeholder="e.g. Fullstack Engineer, Laravel Backend..." 
                                   class="w-full px-3 py-1.5 rounded-xl border border-darkBorder bg-darkBg/20 text-xs outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all">
                        </div>

                        <div class="space-y-1">
                            <label for="bio" class="block text-[9px] font-bold uppercase tracking-wider text-textSecondary">Biography</label>
                            <input id="bio" name="bio" type="text" 
                                   value="{{ old('bio', $user->bio) }}" 
                                   placeholder="Your experience, core technical achievements..." 
                                   class="w-full px-3 py-1.5 rounded-xl border border-darkBorder bg-darkBg/20 text-xs outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all">
                        </div>
                    </div>

                    <div class="flex justify-end pt-1 border-t border-darkBorder/40">
                        <button type="submit" class="px-3.5 py-1.5 rounded-xl text-xs font-bold text-white bg-oceanBlue hover:bg-oceanHover shadow-premium transition-all active:scale-[0.98] flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">save</span>
                            Save Details
                        </button>
                    </div>
                </form>
            </div>

            <!-- SECTION 2: Skills Management Card (SCROLLABLE INSIDE IF LARGE) -->
            <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-4 md:p-5 shadow-xl flex-1 min-h-0 flex flex-col gap-4 overflow-hidden">
                <div class="flex items-center justify-between border-b border-darkBorder/40 pb-2.5 shrink-0">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-oceanBlue text-lg">bolt</span>
                        <h3 class="font-display font-bold text-xs uppercase tracking-wider text-white">Technical Skillset</h3>
                    </div>
                    <span class="text-[9px] font-mono text-textSecondary/50 bg-darkBg px-2 py-0.5 rounded">
                        {{ count($userSkills) }} Skills Added
                    </span>
                </div>

                <!-- Scrollable Skills List wrapper -->
                <div class="flex-1 min-h-0 overflow-y-auto pr-1">
                    @if ($userSkills->isEmpty())
                        <div class="h-full flex flex-col items-center justify-center py-6 space-y-2 rounded-xl border border-dashed border-darkBorder/40 bg-darkBg/10">
                            <span class="material-symbols-outlined text-3xl text-textSecondary/20">psychology</span>
                            <div class="space-y-0.5 text-center">
                                <p class="text-xs font-bold text-white">No skills added yet</p>
                                <p class="text-[9px] text-textSecondary max-w-xs px-4">Select a skill below to begin your analysis profile.</p>
                            </div>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 pb-2">
                            @foreach ($userSkills as $us)
                                <div class="p-2.5 rounded-xl border border-darkBorder bg-darkBg/20 hover:border-oceanBlue/30 hover:bg-darkBg/60 transition-all duration-200 flex items-center justify-between group">
                                    <div class="space-y-1 min-w-0 pr-3">
                                        <div class="flex items-center gap-1.5">
                                            <span class="w-1 h-1 rounded-full bg-accentTeal shrink-0"></span>
                                            <p class="text-xs font-bold text-white truncate">{{ $us->skill->name }}</p>
                                        </div>
                                        <div class="flex items-center gap-1.5">
                                            @if ($us->skill->category)
                                                <span class="text-[8px] font-semibold uppercase tracking-wider text-textSecondary bg-darkCard px-1.5 py-0.5 rounded border border-darkBorder/40">
                                                    {{ $us->skill->category }}
                                                </span>
                                            @endif
                                            
                                            @if ($us->level->value === 'advanced')
                                                <span class="text-[8px] font-bold uppercase tracking-wider text-accentTeal bg-accentTeal/10 px-1.5 py-0.5 rounded">Advanced</span>
                                            @elseif ($us->level->value === 'intermediate')
                                                <span class="text-[8px] font-bold uppercase tracking-wider text-amber-400 bg-amber-400/10 px-1.5 py-0.5 rounded">Intermediate</span>
                                            @else
                                                <span class="text-[8px] font-bold uppercase tracking-wider text-textSecondary/65 bg-darkCard px-1.5 py-0.5 rounded border border-darkBorder/20">Beginner</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-0.5 opacity-80 group-hover:opacity-100 transition-opacity shrink-0">
                                        <button type="button" onclick="openEditModal({{ $us->id }}, '{{ $us->level->value }}')" class="p-1.5 rounded-lg hover:bg-darkCard hover:text-oceanBlue text-textSecondary transition-colors" title="Edit Level">
                                            <span class="material-symbols-outlined text-[15px]">edit</span>
                                        </button>
                                        <form action="{{ route('profile.skills.destroy', $us) }}" method="POST" onsubmit="return confirm('Remove {{ $us->skill->name }}?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 rounded-lg hover:bg-red-500/10 hover:text-red-400 text-textSecondary transition-colors" title="Remove Skill">
                                                <span class="material-symbols-outlined text-[15px]">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Add Skill Form Inline (COMPACT, STAYS AT BOTTOM) -->
                <div class="pt-3.5 border-t border-darkBorder/40 shrink-0">
                    <form action="{{ route('profile.skills.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-end bg-darkBg/20 p-3 rounded-xl border border-darkBorder/40">
                        @csrf
                        
                        <div class="sm:col-span-6 space-y-1">
                            <label class="block text-[8px] font-bold uppercase tracking-wider text-textSecondary">Select Skill</label>
                            <select name="skill_id" class="w-full px-2.5 py-1.5 rounded-xl border border-darkBorder bg-darkCard text-xs outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all">
                                <option value="">Choose skill...</option>
                                @foreach ($allSkills as $skill)
                                    <option value="{{ $skill->id }}" {{ old('skill_id') == $skill->id ? 'selected' : '' }}>
                                        {{ $skill->name }}{{ $skill->category ? ' ('.$skill->category.')' : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="sm:col-span-4 space-y-1">
                            <label class="block text-[8px] font-bold uppercase tracking-wider text-textSecondary">Expertise Level</label>
                            <select name="level" class="w-full px-2.5 py-1.5 rounded-xl border border-darkBorder bg-darkCard text-xs outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all">
                                <option value="">Level...</option>
                                <option value="beginner" {{ old('level') === 'beginner' ? 'selected' : '' }}>Beginner</option>
                                <option value="intermediate" {{ old('level') === 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                <option value="advanced" {{ old('level') === 'advanced' ? 'selected' : '' }}>Advanced</option>
                            </select>
                        </div>

                        <div class="sm:col-span-2">
                            <button type="submit" class="w-full py-1.5 rounded-xl text-xs font-bold text-white bg-oceanBlue hover:bg-oceanHover shadow-premium transition-all active:scale-[0.98] flex items-center justify-center gap-1">
                                <span class="material-symbols-outlined text-sm">add</span>
                                Add
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: Target Job & Account Details (1/3 width) -->
        <div class="lg:col-span-4 flex flex-col gap-5 lg:h-full lg:overflow-hidden">
            
            <!-- Target Role form (COMPACT) -->
            <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-4 md:p-5 shadow-xl space-y-3.5 shrink-0">
                <div class="flex items-center gap-2 border-b border-darkBorder/40 pb-2">
                    <span class="material-symbols-outlined text-oceanBlue text-lg">track_changes</span>
                    <h3 class="font-display font-bold text-xs uppercase tracking-wider text-white">Target Role</h3>
                </div>

                <p class="text-[10px] text-textSecondary leading-relaxed">
                    Choose the target career role. This sets the reference requirements vector for AI alignment scoring.
                </p>

                <form action="{{ route('profile.target-job.update') }}" method="POST" class="space-y-3">
                    @csrf
                    <div>
                        <select name="target_job" class="w-full px-2.5 py-1.5 rounded-xl border border-darkBorder bg-darkBg/20 text-xs outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all">
                            <option value="">Select target role...</option>
                            @foreach ($jobTitles as $title)
                                <option value="{{ $title }}" {{ $user->target_job === $title ? 'selected' : '' }}>{{ $title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="w-full py-2 rounded-xl text-xs font-bold text-white bg-oceanBlue hover:bg-oceanHover shadow-premium transition-all active:scale-[0.98] flex items-center justify-center gap-1">
                        <span class="material-symbols-outlined text-sm">check</span>
                        Update Role
                    </button>
                </form>

                @if ($user->target_job)
                    <div class="flex items-center gap-2.5 p-2.5 rounded-xl border border-oceanBlue/20 bg-oceanBlue/5">
                        <div class="w-6 h-6 rounded-lg bg-oceanBlue/10 flex items-center justify-center text-oceanBlue shrink-0">
                            <span class="material-symbols-outlined text-sm">work</span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-[7px] font-mono font-bold text-oceanBlue uppercase tracking-wider">Active Target</p>
                            <p class="text-xs font-bold text-white truncate">{{ $user->target_job }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Account Details summary (COMPACT) -->
            <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-4 md:p-5 shadow-xl space-y-3.5 flex-1 min-h-0 overflow-y-auto">
                <div class="flex items-center gap-2 border-b border-darkBorder/40 pb-2">
                    <span class="material-symbols-outlined text-oceanBlue text-lg">manage_accounts</span>
                    <h3 class="font-display font-bold text-xs uppercase tracking-wider text-white">Account Details</h3>
                </div>

                <div class="space-y-3 text-[10px]">
                    <div class="flex justify-between items-center py-1.5 border-b border-darkBorder/20">
                        <span class="text-textSecondary font-semibold">User Name</span>
                        <span class="font-bold text-white truncate max-w-[110px]">{{ $user->name }}</span>
                    </div>
                    <div class="flex justify-between items-center py-1.5 border-b border-darkBorder/20">
                        <span class="text-textSecondary font-semibold">Email Address</span>
                        <span class="font-bold text-white truncate max-w-[110px]">{{ $user->email }}</span>
                    </div>
                    <div class="flex justify-between items-center py-1.5">
                        <span class="text-textSecondary font-semibold">Registered Since</span>
                        <span class="font-mono text-white">{{ $user->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- EDIT SKILL MODAL DIALOG (BLUR BACKDROP GLASSMORPHISM) -->
    <div id="edit-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/75 backdrop-blur-sm" onclick="closeEditModal()"></div>
        <div class="rounded-2xl border border-darkBorder bg-darkCard p-5 w-full max-w-xs relative z-10 shadow-2xl space-y-4">
            <div class="space-y-0.5">
                <h3 class="font-display font-bold text-sm text-white">Update Skill Mastery</h3>
                <p class="text-[10px] text-textSecondary">Update your estimated master level for this skill.</p>
            </div>
            
            <form id="edit-form" method="POST" class="space-y-3">
                @csrf
                @method('PATCH')
                <select name="level" id="edit-level" class="w-full px-2.5 py-1.5 rounded-xl border border-darkBorder bg-darkBg text-xs outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all">
                    <option value="beginner">Beginner</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="advanced">Advanced</option>
                </select>
                
                <div class="flex gap-3 pt-1">
                    <button type="button" onclick="closeEditModal()" class="flex-1 py-2 rounded-xl text-xs font-bold border border-darkBorder text-textSecondary hover:text-white transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 py-2 rounded-xl text-xs font-bold text-white bg-oceanBlue hover:bg-oceanHover shadow-premium transition-all">
                        Save
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
