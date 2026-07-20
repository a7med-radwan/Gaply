<x-layout title="Dashboard — Gaply">

    {{-- TOP BAR: greeting + status --}}
    <div class="mb-6 flex items-center justify-between shrink-0">
        <div>
            <h1 class="font-display font-black text-2xl md:text-3xl text-white tracking-tight">
                {{ now()->hour < 12 ? 'Good morning' : (now()->hour < 18 ? 'Good afternoon' : 'Good evening') }}, {{ explode(' ', $user->name)[0] }}
            </h1>
            <p class="text-xs text-textSecondary/70 font-mono mt-0.5">{{ now()->format('l, F j') }}</p>
        </div>
        @if ($careerPlan && $careerPlan->isActive())
            @php
                $score = $careerPlan->readiness_score;
                $scoreLabel = $score >= 70 ? 'Strong Match' : ($score >= 40 ? 'Moderate Gap' : 'Critical Gap');
                $scoreColor = $score >= 70 ? 'text-emerald-400 bg-emerald-500/10 border-emerald-500/20' : ($score >= 40 ? 'text-amber-400 bg-amber-500/10 border-amber-500/20' : 'text-red-400 bg-red-500/10 border-red-500/20');
            @endphp
            <span class="hidden sm:inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-mono font-bold border {{ $scoreColor }}">
                <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                {{ $score }}% · {{ $scoreLabel }}
            </span>
        @endif
    </div>

    {{-- STATS ROW --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-6">

        {{-- Readiness Score --}}
        <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-4 flex items-center gap-3">
            @if ($careerPlan && $careerPlan->isActive())
                @php
                    $score = $careerPlan->readiness_score;
                    $ring = $score >= 70 ? '#10b981' : ($score >= 40 ? '#f59e0b' : '#ef4444');
                @endphp
                <div class="relative shrink-0 w-12 h-12">
                    <svg class="w-12 h-12 -rotate-90" viewBox="0 0 44 44">
                        <circle cx="22" cy="22" r="18" fill="none" stroke="rgba(255,255,255,0.06)" stroke-width="4"/>
                        <circle cx="22" cy="22" r="18" fill="none" stroke="{{ $ring }}" stroke-width="4"
                            stroke-dasharray="{{ 2 * M_PI * 18 }}"
                            stroke-dashoffset="{{ 2 * M_PI * 18 * (1 - $score / 100) }}"
                            stroke-linecap="round"/>
                    </svg>
                    <span class="absolute inset-0 flex items-center justify-center text-[10px] font-black font-mono text-white">{{ $score }}%</span>
                </div>
            @elseif ($careerPlan && $careerPlan->isPending())
                <div class="w-12 h-12 rounded-full bg-oceanBlue/10 border border-oceanBlue/20 flex items-center justify-center text-oceanBlue shrink-0 animate-pulse">
                    <span class="material-symbols-outlined text-xl">sync</span>
                </div>
            @else
                <div class="w-12 h-12 rounded-full bg-darkBg border border-darkBorder/60 flex items-center justify-center text-textSecondary/30 shrink-0">
                    <span class="material-symbols-outlined text-xl">query_stats</span>
                </div>
            @endif
            <div class="min-w-0">
                <p class="text-[9px] font-mono font-bold text-textSecondary/50 uppercase tracking-widest">Readiness</p>
                <p class="text-sm font-bold text-white truncate">
                    @if ($careerPlan && $careerPlan->isActive())
                        {{ $score >= 70 ? 'Strong' : ($score >= 40 ? 'Moderate' : 'Critical') }}
                    @elseif ($careerPlan && $careerPlan->isPending())
                        <span class="text-oceanBlue animate-pulse text-xs">Analyzing…</span>
                    @else
                        No data
                    @endif
                </p>
            </div>
        </div>

        {{-- Target Job --}}
        <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-4 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-oceanBlue/10 border border-oceanBlue/20 flex items-center justify-center text-oceanBlue shrink-0">
                <span class="material-symbols-outlined text-lg">target</span>
            </div>
            <div class="min-w-0">
                <p class="text-[9px] font-mono font-bold text-textSecondary/50 uppercase tracking-widest">Target</p>
                <p class="text-sm font-bold text-white truncate">{{ $targetJob ?? '—' }}</p>
            </div>
        </div>

        {{-- Skills --}}
        <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-4 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 shrink-0">
                <span class="material-symbols-outlined text-lg">verified</span>
            </div>
            <div class="min-w-0">
                <p class="text-[9px] font-mono font-bold text-textSecondary/50 uppercase tracking-widest">Skills</p>
                <p class="text-sm font-bold text-white">{{ $userSkills->count() }}</p>
            </div>
        </div>

        {{-- Gaps --}}
        <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-4 flex items-center gap-3">
            @php $gapCount = $careerPlan && $careerPlan->isActive() ? count($careerPlan->missing_skills ?? []) : null; @endphp
            <div class="w-10 h-10 rounded-xl {{ $gapCount > 0 ? 'bg-red-500/10 border-red-500/20 text-red-400' : 'bg-darkBg border-darkBorder/60 text-textSecondary/30' }} flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-lg">warning</span>
            </div>
            <div class="min-w-0">
                <p class="text-[9px] font-mono font-bold text-textSecondary/50 uppercase tracking-widest">Gaps</p>
                <p class="text-sm font-bold text-white">{{ $gapCount !== null ? $gapCount : '—' }}</p>
            </div>
        </div>

    </div>

    {{-- MAIN GRID --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

        {{-- LEFT: Target Analysis + Skills --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Target Analysis --}}
            <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-5 shadow-xl space-y-4">
                <div class="flex items-center justify-between border-b border-darkBorder/40 pb-3">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-oceanBlue text-base">track_changes</span>
                        <h3 class="font-display font-bold text-sm text-white">Gap Analysis</h3>
                    </div>
                    @if ($targetJob)
                        <span class="text-[10px] font-mono text-oceanBlue bg-oceanBlue/10 px-2 py-0.5 rounded border border-oceanBlue/20">{{ $targetJob }}</span>
                    @endif
                </div>

                @if (! $targetJob)
                    <div class="py-6 flex flex-col items-center gap-3 text-center">
                        <span class="material-symbols-outlined text-3xl text-textSecondary/20">work_off</span>
                        <p class="text-sm font-bold text-white">No target role set</p>
                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-oceanBlue hover:bg-oceanHover text-white text-xs font-bold transition-all">
                            <span class="material-symbols-outlined text-sm">add</span> Set Target Job
                        </a>
                    </div>
                @elseif ($careerPlan && $careerPlan->isActive())
                    <p class="text-xs text-textSecondary leading-relaxed">{{ $careerPlan->gap_summary }}</p>
                    <div class="flex items-center justify-between pt-2 border-t border-darkBorder/30">
                        <span class="text-[10px] font-mono text-textSecondary/40">{{ $careerPlan->created_at->diffForHumans() }}</span>
                        <form action="{{ route('career-plan.generate') }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-darkBg border border-darkBorder hover:border-oceanBlue text-xs font-bold text-textSecondary hover:text-oceanBlue transition-all">
                                <span class="material-symbols-outlined text-sm">refresh</span> Re-Analyze
                            </button>
                        </form>
                    </div>
                @elseif ($careerPlan && $careerPlan->isPending())
                    <div class="py-6 flex items-center justify-center gap-2 text-oceanBlue">
                        <span class="material-symbols-outlined text-base animate-spin">sync</span>
                        <span class="text-xs font-mono animate-pulse">AI is generating your analysis…</span>
                    </div>
                @else
                    <div class="py-5 flex flex-col items-center gap-3 text-center rounded-xl border border-dashed border-darkBorder/50">
                        <p class="text-xs text-textSecondary">No analysis generated yet.</p>
                        <form action="{{ route('career-plan.generate') }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-gradient-to-r from-accentTeal to-oceanBlue text-white text-xs font-bold shadow-premium hover:opacity-90 transition-all">
                                <span class="material-symbols-outlined text-sm">auto_awesome</span> Run Analysis
                            </button>
                        </form>
                    </div>
                @endif
            </div>

            {{-- Skills Inventory --}}
            <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-5 shadow-xl space-y-4">
                <div class="flex items-center justify-between border-b border-darkBorder/40 pb-3">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-accentTeal text-base">bolt</span>
                        <h3 class="font-display font-bold text-sm text-white">Skills</h3>
                    </div>
                    <a href="{{ route('skills.index') }}" class="text-xs font-bold text-textSecondary hover:text-white transition-colors">Manage →</a>
                </div>

                @if ($userSkills->isEmpty())
                    <div class="py-8 flex flex-col items-center gap-3 text-center rounded-xl border border-dashed border-darkBorder/40">
                        <span class="material-symbols-outlined text-3xl text-textSecondary/20">psychology</span>
                        <a href="{{ route('skills.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl border border-darkBorder hover:bg-darkBg text-white text-xs font-bold transition-all">
                            <span class="material-symbols-outlined text-sm">add</span> Add Skills
                        </a>
                    </div>
                @else
                    <div class="flex flex-wrap gap-2">
                        @foreach ($userSkills as $skill)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-darkBg border border-darkBorder/60 text-xs font-semibold text-white hover:border-accentTeal/40 transition-colors">
                                <span class="w-1.5 h-1.5 rounded-full {{ $skill->level?->value === 'advanced' ? 'bg-accentTeal' : ($skill->level?->value === 'intermediate' ? 'bg-amber-400' : 'bg-textSecondary/40') }} shrink-0"></span>
                                {{ $skill->name }}
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>

        {{-- RIGHT: Checklist --}}
        <div class="space-y-5">
            <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-5 shadow-xl space-y-1">
                <div class="flex items-center gap-2 border-b border-darkBorder/40 pb-3 mb-4">
                    <span class="material-symbols-outlined text-oceanBlue text-base">checklist</span>
                    <h3 class="font-display font-bold text-sm text-white">Setup</h3>
                </div>

                @php
                    $steps = [
                        ['done' => (bool) $targetJob,            'label' => 'Set target job',       'href' => route('profile.edit')],
                        ['done' => $userSkills->isNotEmpty(),    'label' => 'Add skills',            'href' => route('skills.index')],
                        ['done' => $careerPlan && $careerPlan->isActive(), 'label' => 'Run gap analysis', 'href' => route('career-plan.index')],
                        ['done' => $careerPlan && count($careerPlan->missing_skills ?? []) > 0, 'label' => 'Review missing skills', 'href' => route('career-plan.missing-skills')],
                        ['done' => (bool) $user->experience,    'label' => 'Write experience bio',  'href' => route('profile.edit')],
                    ];
                @endphp

                @foreach ($steps as $step)
                    <a href="{{ $step['href'] }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-darkBg/40 transition-colors group">
                        <span class="w-5 h-5 rounded-full flex items-center justify-center shrink-0 text-xs
                            {{ $step['done'] ? 'bg-emerald-500/15 text-emerald-400 border border-emerald-500/20' : 'bg-darkBg border border-darkBorder/60 text-textSecondary/30' }}">
                            <span class="material-symbols-outlined text-[13px]">{{ $step['done'] ? 'check' : 'radio_button_unchecked' }}</span>
                        </span>
                        <span class="text-xs font-semibold {{ $step['done'] ? 'text-textSecondary/50 line-through' : 'text-white group-hover:text-oceanBlue' }} transition-colors">
                            {{ $step['label'] }}
                        </span>
                    </a>
                @endforeach
            </div>

            @if ($careerPlan && count($careerPlan->missing_skills ?? []) > 0)
            <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-5 shadow-xl space-y-3">
                <div class="flex items-center justify-between border-b border-darkBorder/40 pb-3">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-red-400 text-base">running_with_errors</span>
                        <h3 class="font-display font-bold text-sm text-white">Top Gaps</h3>
                    </div>
                    <a href="{{ route('career-plan.missing-skills') }}" class="text-xs font-bold text-textSecondary hover:text-white transition-colors">All →</a>
                </div>
                @foreach (array_slice($careerPlan->missing_skills ?? [], 0, 4) as $gap)
                    <div class="flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2 min-w-0">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-400 shrink-0"></span>
                            <span class="text-xs font-semibold text-white truncate">{{ $gap }}</span>
                        </div>
                        <a href="{{ route('career-plan.interview-questions', ['skill_name' => $gap]) }}"
                           class="text-[10px] font-bold text-textSecondary hover:text-oceanBlue transition-colors shrink-0">Practice →</a>
                    </div>
                @endforeach
            </div>
            @endif
        </div>

    </div>

</x-layout>