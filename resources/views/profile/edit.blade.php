<x-layout title="My Profile — Gaply">

    {{-- Flash --}}
    @if (session('success'))
        <div id="flash-msg" class="mb-6 flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium"
            style="background:var(--color-success-bg);color:var(--color-success-text);">
            <span class="material-symbols-outlined" style="font-size:18px;">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-8">
        <h1 class="font-display font-black" style="font-size:32px;color:var(--color-text-primary);">My Profile</h1>
        <p class="mt-1 text-sm" style="color:var(--color-text-secondary);">Manage your professional info and career goals.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ── LEFT COLUMN ── --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Section A: Basic Info --}}
            <div class="rounded-xl border p-6" style="background:var(--color-surface);border-color:var(--color-border);">
                <div class="flex items-center gap-2 mb-6">
                    <span class="material-symbols-outlined text-[20px]" style="color:var(--color-primary);">badge</span>
                    <h2 class="text-lg font-semibold" style="color:var(--color-text-primary);">Professional Info</h2>
                </div>

                @if ($errors->has('specialization') || $errors->has('bio') || $errors->has('profile_image'))
                    <div class="mb-4 flex items-start gap-2 p-4 rounded-xl text-sm"
                        style="background:var(--color-danger-bg);color:var(--color-danger-text);">
                        <span class="material-symbols-outlined shrink-0" style="font-size:18px;">error</span>
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach ($errors->only(['specialization','bio','profile_image']) as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    {{-- Profile photo --}}
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider mb-2" style="color:var(--color-text-secondary);">Profile Photo</p>
                        <div class="flex items-center gap-4">
                            <img id="img-preview"
                                src="{{ $user->profile_image ? Storage::url($user->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=232A5C&color=fff&size=128' }}"
                                alt="{{ $user->name }}"
                                class="w-20 h-20 rounded-full object-cover"
                                style="border:2px solid var(--color-border);">
                            <div>
                                <label for="profile_image"
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border text-sm font-medium cursor-pointer"
                                    style="border-color:var(--color-border);color:var(--color-text-primary);background:var(--color-bg);">
                                    <span class="material-symbols-outlined" style="font-size:18px;">upload</span>
                                    Choose Photo
                                </label>
                                <input id="profile_image" type="file" name="profile_image"
                                    accept="image/jpg,image/jpeg,image/png" class="hidden"
                                    onchange="document.getElementById('img-preview').src=URL.createObjectURL(event.target.files[0])">
                                <p class="text-xs mt-1.5" style="color:var(--color-text-secondary);">JPG or PNG · max 2 MB</p>
                            </div>
                        </div>
                    </div>

                    {{-- Specialization --}}
                    <div>
                        <label for="specialization" class="block text-xs font-semibold uppercase tracking-wider mb-1.5"
                            style="color:var(--color-text-secondary);">Specialization</label>
                        <input id="specialization" name="specialization" type="text"
                            value="{{ old('specialization', $user->specialization) }}"
                            placeholder="e.g. Computer Science, Information Technology…"
                            class="w-full px-4 py-2.5 rounded-lg border text-sm outline-none transition-all"
                            style="background:var(--color-surface);border-color:var(--color-border);color:var(--color-text-primary);"
                            onfocus="this.style.borderColor='var(--color-primary)'"
                            onblur="this.style.borderColor='var(--color-border)'">
                        @error('specialization')
                            <p class="text-xs mt-1" style="color:var(--color-danger-text);">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Bio --}}
                    <div>
                        <label for="bio" class="block text-xs font-semibold uppercase tracking-wider mb-1.5"
                            style="color:var(--color-text-secondary);">Bio</label>
                        <textarea id="bio" name="bio" rows="4"
                            placeholder="Your experience, skills you're proud of, career aspirations…"
                            class="w-full px-4 py-2.5 rounded-lg border text-sm outline-none transition-all resize-none"
                            style="background:var(--color-surface);border-color:var(--color-border);color:var(--color-text-primary);"
                            onfocus="this.style.borderColor='var(--color-primary)'"
                            onblur="this.style.borderColor='var(--color-border)'">{{ old('bio', $user->bio) }}</textarea>
                        @error('bio')
                            <p class="text-xs mt-1" style="color:var(--color-danger-text);">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold transition-all active:scale-95"
                            style="background:var(--color-primary);color:#fff;">
                            <span class="material-symbols-outlined" style="font-size:18px;">save</span>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>

            {{-- Section B: Skills --}}
            <div class="rounded-xl border p-6" style="background:var(--color-surface);border-color:var(--color-border);">
                <div class="flex items-center gap-2 mb-6">
                    <span class="material-symbols-outlined text-[20px]" style="color:var(--color-primary);">bolt</span>
                    <h2 class="text-lg font-semibold" style="color:var(--color-text-primary);">My Skills</h2>
                </div>

                @if ($errors->has('skill_id') || $errors->has('level'))
                    <div class="mb-4 flex items-start gap-2 p-4 rounded-xl text-sm"
                        style="background:var(--color-danger-bg);color:var(--color-danger-text);">
                        <span class="material-symbols-outlined shrink-0" style="font-size:18px;">error</span>
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach ($errors->only(['skill_id','level']) as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Skills list --}}
                @if ($userSkills->isEmpty())
                    <div class="py-10 text-center">
                        <span class="material-symbols-outlined" style="font-size:40px;color:var(--color-border);">psychology</span>
                        <p class="text-sm mt-2" style="color:var(--color-text-secondary);">No skills yet. Add your first one below.</p>
                    </div>
                @else
                    <div class="space-y-2 mb-6">
                        @foreach ($userSkills as $us)
                            <div class="flex items-center justify-between px-4 py-3 rounded-xl border"
                                style="background:var(--color-bg);border-color:var(--color-border);">
                                <div class="flex items-center gap-3 min-w-0">
                                    <span class="material-symbols-outlined" style="font-size:18px;color:var(--color-success);">check_circle</span>
                                    <div class="min-w-0">
                                        <p class="text-sm font-semibold truncate" style="color:var(--color-text-primary);">{{ $us->skill->name }}</p>
                                        @if ($us->skill->category)
                                            <p class="text-xs" style="color:var(--color-text-secondary);">{{ $us->skill->category }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 shrink-0">
                                    {{-- Level badge --}}
                                    <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full"
                                        style="{{ match($us->level->value) {
                                            'beginner'     => 'background:var(--color-warning-bg);color:var(--color-warning-text)',
                                            'intermediate' => 'background:var(--color-coral-bg);color:var(--color-coral-text)',
                                            default        => 'background:var(--color-success-bg);color:var(--color-success-text)',
                                        } }}">
                                        {{ ucfirst($us->level->value) }}
                                    </span>
                                    {{-- Edit --}}
                                    <button type="button"
                                        onclick="openEditModal({{ $us->id }}, '{{ $us->level->value }}')"
                                        class="p-1.5 rounded-lg transition-colors"
                                        style="color:var(--color-text-secondary);">
                                        <span class="material-symbols-outlined" style="font-size:18px;">edit</span>
                                    </button>
                                    {{-- Delete --}}
                                    <form action="{{ route('profile.skills.destroy', $us) }}" method="POST"
                                        onsubmit="return confirm('Remove {{ addslashes($us->skill->name) }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-lg transition-colors"
                                            style="color:var(--color-text-secondary);">
                                            <span class="material-symbols-outlined" style="font-size:18px;">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Add skill --}}
                <div class="pt-4 border-t" style="border-color:var(--color-border);">
                    <p class="text-xs font-semibold uppercase tracking-wider mb-3" style="color:var(--color-text-secondary);">Add a Skill</p>
                    <form action="{{ route('profile.skills.store') }}" method="POST" class="flex flex-wrap gap-3 items-end">
                        @csrf
                        <div class="flex-1 min-w-[180px]">
                            <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color:var(--color-text-secondary);">Skill</label>
                            <select name="skill_id"
                                class="w-full px-4 py-2.5 rounded-lg border text-sm outline-none appearance-none"
                                style="background:var(--color-surface);border-color:var(--color-border);color:var(--color-text-primary);"
                                onfocus="this.style.borderColor='var(--color-primary)'"
                                onblur="this.style.borderColor='var(--color-border)'">
                                <option value="">Select skill…</option>
                                @foreach ($allSkills as $skill)
                                    <option value="{{ $skill->id }}" {{ old('skill_id') == $skill->id ? 'selected' : '' }}>
                                        {{ $skill->name }}{{ $skill->category ? ' — '.$skill->category : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="min-w-[150px]">
                            <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color:var(--color-text-secondary);">Level</label>
                            <select name="level"
                                class="w-full px-4 py-2.5 rounded-lg border text-sm outline-none appearance-none"
                                style="background:var(--color-surface);border-color:var(--color-border);color:var(--color-text-primary);"
                                onfocus="this.style.borderColor='var(--color-primary)'"
                                onblur="this.style.borderColor='var(--color-border)'">
                                <option value="">Level…</option>
                                <option value="beginner"     {{ old('level') === 'beginner'     ? 'selected' : '' }}>Beginner</option>
                                <option value="intermediate" {{ old('level') === 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                <option value="advanced"     {{ old('level') === 'advanced'     ? 'selected' : '' }}>Advanced</option>
                            </select>
                        </div>
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold transition-all active:scale-95"
                            style="background:var(--color-accent);color:#fff;">
                            <span class="material-symbols-outlined" style="font-size:18px;">add</span>
                            Add
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- ── RIGHT COLUMN ── --}}
        <div class="space-y-6">

            {{-- Target Job --}}
            <div class="rounded-xl border p-6" style="background:var(--color-surface);border-color:var(--color-border);">
                <div class="flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-[20px]" style="color:var(--color-primary);">track_changes</span>
                    <h2 class="text-lg font-semibold" style="color:var(--color-text-primary);">Target Job</h2>
                </div>
                <p class="text-sm mb-4" style="color:var(--color-text-secondary);">
                    The role you're working towards — used to analyse your skill gap.
                </p>
                @error('target_job')
                    <div class="mb-3 p-3 rounded-xl text-sm" style="background:var(--color-danger-bg);color:var(--color-danger-text);">{{ $message }}</div>
                @enderror
                <form action="{{ route('profile.target-job.update') }}" method="POST" class="space-y-3">
                    @csrf
                    <select name="target_job"
                        class="w-full px-4 py-2.5 rounded-lg border text-sm outline-none appearance-none"
                        style="background:var(--color-surface);border-color:var(--color-border);color:var(--color-text-primary);"
                        onfocus="this.style.borderColor='var(--color-primary)'"
                        onblur="this.style.borderColor='var(--color-border)'">
                        <option value="">Select a job title…</option>
                        @foreach ($jobTitles as $title)
                            <option value="{{ $title }}" {{ $user->target_job === $title ? 'selected' : '' }}>{{ $title }}</option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold transition-all active:scale-95"
                        style="background:var(--color-primary);color:#fff;">
                        <span class="material-symbols-outlined" style="font-size:18px;">check</span>
                        Set Target Job
                    </button>
                </form>
                @if ($user->target_job)
                    <div class="mt-4 flex items-center gap-2 px-3 py-2.5 rounded-xl"
                        style="background:var(--color-coral-bg);">
                        <span class="material-symbols-outlined" style="font-size:18px;color:var(--color-coral-text);">work</span>
                        <span class="text-sm font-semibold" style="color:var(--color-coral-text);">{{ $user->target_job }}</span>
                    </div>
                @endif
            </div>

            {{-- Account Summary --}}
            <div class="rounded-xl border p-6" style="background:var(--color-surface);border-color:var(--color-border);">
                <div class="flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-[20px]" style="color:var(--color-primary);">manage_accounts</span>
                    <h2 class="text-lg font-semibold" style="color:var(--color-text-primary);">Account</h2>
                </div>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider" style="color:var(--color-text-secondary);">Name</p>
                        <p class="text-sm font-semibold mt-0.5" style="color:var(--color-text-primary);">{{ $user->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider" style="color:var(--color-text-secondary);">Email</p>
                        <p class="text-sm mt-0.5 truncate" style="color:var(--color-text-primary);">{{ $user->email }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider" style="color:var(--color-text-secondary);">Member Since</p>
                        <p class="text-sm mt-0.5 font-mono" style="color:var(--color-text-primary);">{{ $user->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit skill modal --}}
    <div id="edit-modal" class="fixed inset-0 z-50 hidden items-center justify-center"
        style="background:rgba(0,0,0,0.5);">
        <div class="rounded-2xl border shadow-2xl p-8 w-full max-w-sm"
            style="background:var(--color-surface);border-color:var(--color-border);">
            <h3 class="text-lg font-semibold mb-5" style="color:var(--color-text-primary);">Update Skill Level</h3>
            <form id="edit-form" method="POST" class="space-y-4">
                @csrf @method('PATCH')
                <select name="level" id="edit-level"
                    class="w-full px-4 py-2.5 rounded-lg border text-sm outline-none appearance-none"
                    style="background:var(--color-surface);border-color:var(--color-border);color:var(--color-text-primary);">
                    <option value="beginner">Beginner</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="advanced">Advanced</option>
                </select>
                <button type="submit"
                    class="w-full inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold active:scale-95"
                    style="background:var(--color-primary);color:#fff;">
                    <span class="material-symbols-outlined" style="font-size:18px;">save</span>
                    Save
                </button>
                <button type="button" onclick="closeEditModal()"
                    class="w-full inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg border text-sm font-semibold"
                    style="border-color:var(--color-border);color:var(--color-text-secondary);background:transparent;">
                    Cancel
                </button>
            </form>
        </div>
    </div>

    <script>
        const editModal = document.getElementById('edit-modal');
        const editForm  = document.getElementById('edit-form');

        function openEditModal(id, level) {
            editForm.action = `/profile/skills/${id}`;
            document.getElementById('edit-level').value = level;
            editModal.style.display = 'flex';
        }
        function closeEditModal() { editModal.style.display = 'none'; }
        editModal.addEventListener('click', e => { if (e.target === editModal) closeEditModal(); });

        const flash = document.getElementById('flash-msg');
        if (flash) {
            setTimeout(() => { flash.style.transition = 'opacity 0.5s'; flash.style.opacity = '0'; }, 3500);
            setTimeout(() => flash.remove(), 4000);
        }
    </script>
</x-layout>
