<x-layout title="Dashboard — Gaply">

    <!-- PAGE HEADER -->
    <div class="mb-6 space-y-1 shrink-0">
        <h1 class="font-display font-bold text-2xl md:text-3xl text-white tracking-tight">Dashboard</h1>
        <p class="text-sm text-textSecondary font-sans">Welcome back to your dashboard.</p>
    </div>

    <!-- MAIN DASHBOARD CONTENT -->
    <div class="space-y-6">

        <!-- WELCOME BANNER CARD -->
        <div
            class="rounded-2xl border border-darkBorder/60 bg-gradient-to-br from-darkCard to-darkCard/40 p-6 md:p-8 shadow-xl relative overflow-hidden group">
            <!-- Decorative Glow -->
            <div
                class="absolute -right-20 -top-20 w-80 h-80 rounded-full bg-oceanBlue/10 blur-[100px] pointer-events-none group-hover:bg-oceanBlue/15 transition-all duration-500">
            </div>

            <div class="relative z-10 space-y-3">
                <span
                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-mono font-bold uppercase tracking-wider text-accentTeal bg-accentTeal/10 border border-accentTeal/20">
                    System Active
                </span>
                <h2 class="font-display font-black text-2xl md:text-3xl text-white tracking-tight">
                    Welcome back, <span
                        class="bg-clip-text text-transparent bg-gradient-to-r from-[#38bdf8] to-[#0284c7]">{{ $user->name }}</span>!
                </h2>
                <p class="text-sm text-textSecondary leading-relaxed max-w-xl font-sans">
                    Update your profile and skills to see your progress.
                </p>
            </div>
        </div>

        <!-- TWO-COLUMN GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- CARD 1: CAREER TARGET (GOAL) -->
            <div
                class="rounded-2xl border border-darkBorder/60 bg-darkCard p-6 shadow-xl flex flex-col justify-between min-h-[240px] transition-all hover:border-darkBorder duration-300">
                <div class="space-y-4">
                    <div class="flex items-center gap-2 border-b border-darkBorder/40 pb-3">
                        <span class="material-symbols-outlined text-oceanBlue text-lg">track_changes</span>
                        <h3 class="font-display font-bold text-sm text-white">My Target Job</h3>
                    </div>

                    @if ($targetJob)
                        <div class="flex items-start gap-4 py-2">
                            <div
                                class="w-12 h-12 rounded-xl bg-oceanBlue/10 flex items-center justify-center text-oceanBlue shrink-0 shadow-glowBlue/10">
                                <span class="material-symbols-outlined text-2xl">work</span>
                            </div>
                            <div class="space-y-1">
                                <p class="text-xs font-mono font-bold text-oceanBlue uppercase tracking-wider">Target Job
                                </p>
                                <h4 class="text-base font-bold text-white font-display leading-tight">{{ $targetJob }}</h4>
                            </div>
                        </div>
                    @else
                        <div class="flex items-start gap-3 py-2">
                            <div
                                class="w-12 h-12 rounded-xl bg-amber-500/10 flex items-center justify-center text-amber-400 shrink-0">
                                <span class="material-symbols-outlined text-2xl">warning</span>
                            </div>
                            <div class="space-y-0.5">
                                <p class="text-sm font-bold text-white">No Target Role Set</p>
                                <p class="text-xs text-textSecondary leading-relaxed">Choose a target job profile to specify
                                    your career goals.</p>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="pt-4 border-t border-darkBorder/30">
                    <a href="{{ route('profile.show') }}"
                        class="inline-flex items-center gap-2 text-sm font-bold text-oceanBlue hover:text-white transition-colors duration-200">
                        <span class="material-symbols-outlined text-base">settings</span>
                        {{ $targetJob ? 'Change Target Job' : 'Select Target Job' }}
                    </a>
                </div>
            </div>

            <!-- CARD 2: MY SKILLS -->
            <div
                class="rounded-2xl border border-darkBorder/60 bg-darkCard p-6 shadow-xl flex flex-col justify-between min-h-[240px] transition-all hover:border-darkBorder duration-300">
                <div class="space-y-4">
                    <div class="flex items-center justify-between border-b border-darkBorder/40 pb-3">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-accentTeal text-lg">bolt</span>
                            <h3 class="font-display font-bold text-sm text-white">My Skills</h3>
                        </div>
                        <span
                            class="text-xs font-mono text-textSecondary/65 bg-darkBg px-2.5 py-0.5 rounded border border-darkBorder/40">
                            {{ $userSkills->count() }} Added
                        </span>
                    </div>

                    @if ($userSkills->isEmpty())
                        <div class="py-6 text-center rounded-xl border border-dashed border-darkBorder/40 bg-darkBg/10">
                            <p class="text-xs text-textSecondary">You haven't listed any skills yet.</p>
                        </div>
                    @else
                        <div class="flex flex-wrap gap-2 max-h-[120px] overflow-y-auto pr-1">
                            @foreach ($userSkills as $skill)
                                <div
                                    class="px-3 py-1.5 rounded-lg border border-darkBorder bg-darkBg/30 flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-accentTeal animate-pulse"></span>
                                    <span class="text-xs font-semibold text-white">{{ $skill->name }}</span>
                                    @if ($skill->level)
                                        <span
                                            class="text-[10px] font-bold uppercase tracking-wider text-textSecondary/70 border border-darkBorder/40 bg-darkBg/50 px-1.5 py-0.5 rounded">
                                            {{ $skill->level->value }}
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="pt-4 border-t border-darkBorder/30">
                    <a href="{{ route('skills.index') }}"
                        class="inline-flex items-center gap-2 text-sm font-bold text-accentTeal hover:text-white transition-colors duration-200">
                        <span class="material-symbols-outlined text-base">edit</span>
                        Manage Skills
                    </a>
                </div>
            </div>

        </div>
    </div>

</x-layout>