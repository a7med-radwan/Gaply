<x-layout title="Edit Skill — Gaply">

    <!-- PAGE HEADER -->
    <div class="mb-6 space-y-1 shrink-0">
        <h1 class="font-display font-bold text-2xl md:text-3xl text-white tracking-tight">Edit Skill</h1>
        <p class="text-sm text-textSecondary font-sans">Change your skill name and level.</p>
    </div>

    <!-- MAIN FORM GRID -->
    <div class="max-w-md mx-auto my-8">
        <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-6 shadow-xl space-y-4">
            <div class="flex items-center gap-2 border-b border-darkBorder/40 pb-3">
                <span class="material-symbols-outlined text-oceanBlue text-lg">edit</span>
                <h3 class="font-display font-bold text-sm text-white">Edit Skill Details</h3>
            </div>

            <form action="{{ route('skills.update', $skill) }}" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')

                <!-- Skill Name -->
                <div class="space-y-1.5">
                    <label for="skill_name" class="block text-xs font-semibold text-textSecondary">Skill Name</label>
                    <input type="text" id="skill_name" name="skill_name" 
                           placeholder="e.g. Laravel, React..." 
                           value="{{ old('skill_name', $skill->name) }}" required
                           class="w-full px-3.5 py-2.5 rounded-xl border border-darkBorder bg-darkBg text-sm outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all">
                    @error('skill_name')
                        <p class="text-xs text-red-400 mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Skill Level -->
                <div class="space-y-1.5">
                    <label for="level" class="block text-xs font-semibold text-textSecondary">Skill Level</label>
                    <select id="level" name="level" required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-darkBorder bg-darkBg text-sm outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all">
                        <option value="beginner" class="bg-darkCard text-white" {{ old('level', $skill->level->value) === 'beginner' ? 'selected' : '' }}>Beginner</option>
                        <option value="intermediate" class="bg-darkCard text-white" {{ old('level', $skill->level->value) === 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                        <option value="advanced" class="bg-darkCard text-white" {{ old('level', $skill->level->value) === 'advanced' ? 'selected' : '' }}>Advanced</option>
                    </select>
                    @error('level')
                        <p class="text-xs text-red-400 mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-2">
                    <a href="{{ route('skills.index') }}" 
                       class="flex-1 py-3 rounded-xl text-sm font-bold border border-darkBorder text-textSecondary hover:text-white transition-colors text-center flex items-center justify-center">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="flex-1 py-3 rounded-xl text-sm font-bold text-white bg-oceanBlue hover:bg-oceanHover shadow-premium transition-all active:scale-[0.98]">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-layout>
