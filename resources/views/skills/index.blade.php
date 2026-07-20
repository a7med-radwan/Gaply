<x-layout title="My Skills — Gaply">

    <div class="mb-5 flex items-center justify-between shrink-0">
        <div>
            <h1 class="font-display font-black text-2xl md:text-3xl text-white tracking-tight">Skills</h1>
            <p class="text-xs text-textSecondary/60 font-mono mt-0.5">{{ count($userSkills) }} skill{{ count($userSkills) !== 1 ? 's' : '' }} listed</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 items-start">

        {{-- LEFT: Skills Grid --}}
        <div class="lg:col-span-8">
            <div class="rounded-2xl border border-darkBorder/60 bg-darkCard shadow-xl overflow-hidden">
                @if ($userSkills->isEmpty())
                    <div class="py-20 flex flex-col items-center gap-3 text-center">
                        <span class="material-symbols-outlined text-4xl text-textSecondary/20">psychology</span>
                        <p class="text-sm font-bold text-white">No skills yet</p>
                        <p class="text-xs text-textSecondary">Add your first skill using the form →</p>
                    </div>
                @else
                    <div class="divide-y divide-darkBorder/30">
                        @foreach ($userSkills as $us)
                            <div class="flex items-center justify-between px-5 py-3.5 hover:bg-darkBg/30 transition-colors group" id="skill-row-{{ $us->id }}">
                                <div class="flex items-center gap-3 min-w-0">
                                    {{-- Level indicator dot --}}
                                    <span class="w-2 h-2 rounded-full shrink-0
                                        {{ $us->level->value === 'advanced' ? 'bg-accentTeal' : ($us->level->value === 'intermediate' ? 'bg-amber-400' : 'bg-textSecondary/30') }}">
                                    </span>
                                    <span class="text-sm font-bold text-white truncate">{{ $us->name }}</span>
                                    <span class="text-[10px] font-mono text-textSecondary/50 hidden sm:inline">{{ ucfirst($us->level->value) }}</span>
                                </div>

                                {{-- Actions --}}
                                <div class="flex items-center gap-1 shrink-0">
                                    <a href="{{ route('skills.edit', $us) }}"
                                       class="p-1.5 rounded-lg text-textSecondary/50 hover:text-oceanBlue hover:bg-oceanBlue/10 transition-all">
                                        <span class="material-symbols-outlined text-[16px]">edit</span>
                                    </a>

                                    {{-- Inline delete confirm --}}
                                    <div class="relative" x-data="{ confirm: false }">
                                        <button @click="confirm = true" x-show="!confirm"
                                                class="p-1.5 rounded-lg text-textSecondary/50 hover:text-red-400 hover:bg-red-500/10 transition-all">
                                            <span class="material-symbols-outlined text-[16px]">delete</span>
                                        </button>
                                        <div x-show="confirm" x-transition class="flex items-center gap-1">
                                            <form action="{{ route('skills.destroy', $us) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-2.5 py-1 rounded-lg bg-red-500 hover:bg-red-600 text-white text-[10px] font-bold transition-colors">
                                                    Delete
                                                </button>
                                            </form>
                                            <button @click="confirm = false" class="px-2 py-1 rounded-lg text-textSecondary/70 hover:text-white text-[10px] font-bold transition-colors">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        {{-- RIGHT: Add Skill --}}
        <div class="lg:col-span-4">
            <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-5 shadow-xl space-y-4">
                <div class="flex items-center gap-2 border-b border-darkBorder/40 pb-3">
                    <span class="material-symbols-outlined text-oceanBlue text-base">add_circle</span>
                    <h3 class="font-display font-bold text-sm text-white">Add Skill</h3>
                </div>

                <form action="{{ route('skills.store') }}" method="POST" class="space-y-3">
                    @csrf

                    <div class="space-y-1">
                        <label for="skill_name" class="block text-[10px] font-mono font-bold uppercase tracking-wider text-textSecondary/60">Skill Name</label>
                        <input type="text" id="skill_name" name="skill_name"
                               placeholder="e.g. Laravel, React, Docker"
                               value="{{ old('skill_name') }}" required
                               class="w-full px-3.5 py-2.5 rounded-xl border border-darkBorder bg-darkBg text-sm outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all placeholder:text-textSecondary/30">
                        @error('skill_name')
                            <p class="text-xs text-red-400 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="level" class="block text-[10px] font-mono font-bold uppercase tracking-wider text-textSecondary/60">Level</label>
                        <select id="level" name="level" required
                                class="w-full px-3.5 py-2.5 rounded-xl border border-darkBorder bg-darkBg text-sm outline-none text-white focus:border-oceanBlue focus:ring-1 focus:ring-oceanBlue transition-all">
                            <option value="">Select level…</option>
                            <option value="beginner" {{ old('level') === 'beginner' ? 'selected' : '' }}>Beginner</option>
                            <option value="intermediate" {{ old('level') === 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                            <option value="advanced" {{ old('level') === 'advanced' ? 'selected' : '' }}>Advanced</option>
                        </select>
                        @error('level')
                            <p class="text-xs text-red-400 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="w-full py-3 rounded-xl text-sm font-bold text-white bg-oceanBlue hover:bg-oceanHover shadow-premium transition-all active:scale-[0.98]">
                        Add Skill
                    </button>
                </form>
            </div>
        </div>

    </div>

    {{-- Alpine.js for inline confirm --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</x-layout>
