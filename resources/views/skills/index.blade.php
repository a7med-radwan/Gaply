<x-layout title="My Skills — Gaply">

    <!-- PAGE HEADER -->
    <div class="mb-6 space-y-1 shrink-0">
        <h1 class="font-display font-bold text-2xl md:text-3xl text-white tracking-tight">My Skills</h1>
        <p class="text-sm text-textSecondary font-sans">Add, edit, or delete your skills.</p>
    </div>

    <!-- MAIN TWO-COLUMN LAYOUT -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch lg:h-[calc(100vh-140px)] lg:overflow-hidden">
        
        <!-- LEFT COLUMN: Skills Grid (2/3 width, scrollable) -->
        <div class="lg:col-span-8 flex flex-col gap-4 lg:h-full lg:overflow-hidden">
            <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-5 shadow-xl flex-1 min-h-0 flex flex-col gap-4 overflow-hidden">
                
                <div class="flex items-center justify-between border-b border-darkBorder/40 pb-3 shrink-0">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-oceanBlue text-lg">bolt</span>
                        <h3 class="font-display font-bold text-sm text-white font-semibold">My Skills</h3>
                    </div>
                    <span class="text-xs font-mono text-textSecondary/65 bg-darkBg px-2.5 py-0.5 rounded border border-darkBorder/40">
                        {{ count($userSkills) }} Skills Added
                    </span>
                </div>

                <!-- Scrollable Skills List wrapper -->
                <div class="flex-1 min-h-0 overflow-y-auto pr-1">
                    @if ($userSkills->isEmpty())
                        <div class="h-full flex flex-col items-center justify-center py-12 space-y-3 rounded-xl border border-dashed border-darkBorder/40 bg-darkBg/10">
                            <span class="material-symbols-outlined text-4xl text-textSecondary/30">psychology</span>
                            <div class="space-y-1 text-center max-w-sm px-4">
                                <p class="text-base font-bold text-white">No skills added yet</p>
                                <p class="text-xs text-textSecondary leading-relaxed font-sans">Type your skills on the right side to add them.</p>
                            </div>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 pb-3">
                            @foreach ($userSkills as $us)
                                <div class="p-3.5 rounded-xl border border-darkBorder bg-darkBg/20 hover:border-oceanBlue/30 hover:bg-darkBg/55 transition-all duration-200 flex flex-col justify-between gap-3 group">
                                    <div class="space-y-1.5 min-w-0">
                                        <div class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-accentTeal shrink-0 animate-pulse"></span>
                                            <p class="text-sm font-bold text-white truncate" title="{{ $us->name }}">
                                                {{ $us->name }}
                                            </p>
                                        </div>
                                        
                                        <div class="flex flex-wrap items-center gap-1.5">
                                            @if ($us->level->value === 'advanced')
                                                <span class="text-[10px] font-bold uppercase tracking-wider text-accentTeal bg-accentTeal/10 px-2 py-0.5 rounded">Advanced</span>
                                            @elseif ($us->level->value === 'intermediate')
                                                <span class="text-[10px] font-bold uppercase tracking-wider text-amber-400 bg-amber-400/10 px-2 py-0.5 rounded">Intermediate</span>
                                            @else
                                                <span class="text-[10px] font-bold uppercase tracking-wider text-textSecondary/65 bg-darkCard px-2 py-0.5 rounded border border-darkBorder/20">Beginner</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-end gap-1 border-t border-darkBorder/30 pt-2 shrink-0">
                                        <a href="{{ route('skills.edit', $us) }}" 
                                                class="p-1.5 rounded-lg hover:bg-darkCard hover:text-oceanBlue text-textSecondary transition-colors flex items-center gap-1 text-xs font-semibold" title="Edit Skill">
                                            <span class="material-symbols-outlined text-sm">edit</span>
                                            Edit
                                        </a>
                                        
                                        <form action="{{ route('skills.destroy', $us) }}" method="POST" onsubmit="return confirm('Remove {{ $us->name }}?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="p-1.5 rounded-lg hover:bg-red-500/10 hover:text-red-400 text-textSecondary transition-colors flex items-center gap-1 text-xs font-semibold" title="Remove Skill">
                                                <span class="material-symbols-outlined text-sm">delete</span>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        </div>

        <!-- RIGHT COLUMN: Add Skill Panel (1/3 width) -->
        <div class="lg:col-span-4 flex flex-col gap-4 lg:h-full lg:overflow-hidden">
            <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-5 shadow-xl space-y-4 shrink-0">
                <div class="flex items-center gap-2 border-b border-darkBorder/40 pb-2.5">
                    <span class="material-symbols-outlined text-oceanBlue text-lg">add_circle</span>
                    <h3 class="font-display font-bold text-sm text-white">Add New Skill</h3>
                </div>

                <p class="text-xs text-textSecondary leading-relaxed font-sans">
                    Type a skill (like PHP, Figma, or Git) and select your level.
                </p>

                <form action="{{ route('skills.store') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div class="space-y-1.5">
                        <label for="skill_name" class="block text-xs font-semibold text-textSecondary">Skill Name</label>
                        <input type="text" id="skill_name" name="skill_name" placeholder="e.g. Laravel, React..." value="{{ old('skill_name') }}" required
                               class="w-full px-3.5 py-2.5 rounded-xl border border-darkBorder bg-darkBg text-sm outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all">
                        @error('skill_name')
                            <p class="text-xs text-red-400 mt-1 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label for="level" class="block text-xs font-semibold text-textSecondary">Skill Level</label>
                        <select id="level" name="level" required
                                class="w-full px-3.5 py-2.5 rounded-xl border border-darkBorder bg-darkBg text-sm outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all">
                            <option value="" class="bg-darkCard text-textSecondary">Select level...</option>
                            <option value="beginner" class="bg-darkCard text-white" {{ old('level') === 'beginner' ? 'selected' : '' }}>Beginner</option>
                            <option value="intermediate" class="bg-darkCard text-white" {{ old('level') === 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                            <option value="advanced" class="bg-darkCard text-white" {{ old('level') === 'advanced' ? 'selected' : '' }}>Advanced</option>
                        </select>
                        @error('level')
                            <p class="text-xs text-red-400 mt-1 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full py-3 rounded-xl text-sm font-bold text-white bg-oceanBlue hover:bg-oceanHover shadow-premium transition-all active:scale-[0.98] flex items-center justify-center gap-1.5">
                        <span class="material-symbols-outlined text-base">add</span>
                        Add Skill
                    </button>
                </form>
            </div>
        </div>

    </div>

</x-layout>
