<x-layout title="Missing Skills — Gaply">

    <div class="mb-5 shrink-0">
        <div class="flex items-center gap-2">
            <h1 class="font-display font-bold text-2xl md:text-3xl text-white tracking-tight">Missing Skills</h1>
            @if ($careerPlan && count($missingSkills ?? []) > 0)
                <span class="text-xs font-mono font-bold text-red-400 bg-red-500/10 border border-red-500/20 px-2 py-0.5 rounded-full">
                    {{ count($missingSkills) }}
                </span>
            @endif
        </div>
        @if ($user->target_job)
            <p class="text-xs text-textSecondary/60 font-mono mt-0.5">For: {{ $user->target_job }}</p>
        @endif
    </div>

    @if (! $user->target_job)
        <div class="rounded-2xl border border-amber-500/20 bg-amber-500/5 p-5 flex items-center gap-4 max-w-lg">
            <span class="material-symbols-outlined text-amber-400 text-xl shrink-0">warning</span>
            <div class="min-w-0">
                <p class="text-sm font-bold text-white">No target job set</p>
                <a href="{{ route('profile.edit') }}" class="text-xs font-bold text-amber-400 hover:text-white transition-colors mt-0.5 inline-block">Set Target Job →</a>
            </div>
        </div>

    @elseif (! $careerPlan)
        <div class="rounded-2xl border border-dashed border-darkBorder/60 bg-darkCard/50 p-12 flex flex-col items-center gap-4 text-center max-w-lg">
            <span class="material-symbols-outlined text-4xl text-textSecondary/20">analytics</span>
            <p class="text-sm font-bold text-white">No analysis generated yet</p>
            <a href="{{ route('career-plan.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-oceanBlue text-white text-xs font-bold hover:opacity-90 transition-all">
                <span class="material-symbols-outlined text-sm">auto_awesome</span> Generate Analysis
            </a>
        </div>

    @elseif (empty($missingSkills))
        <div class="rounded-2xl border border-emerald-500/20 bg-emerald-500/5 p-8 flex flex-col items-center gap-3 text-center max-w-lg">
            <span class="material-symbols-outlined text-4xl text-emerald-400">check_circle</span>
            <p class="text-sm font-bold text-white">You have all required skills!</p>
            <p class="text-xs text-textSecondary">No gaps identified for {{ $user->target_job }}.</p>
        </div>

    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 max-w-4xl">
            @foreach ($missingSkills as $index => $skill)
                <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-4 flex items-center justify-between gap-3 hover:border-darkBorder transition-all">
                    <div class="flex items-center gap-3 min-w-0">
                        <span class="w-2 h-2 rounded-full bg-red-400 shrink-0"></span>
                        <div class="min-w-0">
                            <p class="text-sm font-bold text-white truncate">{{ $skill }}</p>
                            <span class="text-[10px] font-mono text-textSecondary/40">
                                {{ $index < 3 ? 'High priority' : 'Recommended' }}
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('career-plan.interview-questions', ['skill_name' => $skill]) }}"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-darkBg border border-darkBorder/80 hover:border-oceanBlue text-xs font-bold text-textSecondary hover:text-oceanBlue transition-all shrink-0">
                        <span class="material-symbols-outlined text-sm">quiz</span>
                        Practice
                    </a>
                </div>
            @endforeach
        </div>
    @endif

</x-layout>
