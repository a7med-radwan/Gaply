<x-layout title="Dashboard — Gaply">

    <!-- PAGE HEADER -->
    <div class="mb-6 space-y-1 shrink-0 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="font-display font-black text-2xl md:text-3xl text-white tracking-tight">Dashboard</h1>
            <p class="text-sm text-textSecondary font-sans">Track your career preparedness and skill readiness in real time.</p>
        </div>
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-mono font-bold uppercase tracking-wider text-accentTeal bg-accentTeal/10 border border-accentTeal/20 self-start sm:self-auto">
            <span class="w-2 h-2 rounded-full bg-accentTeal animate-pulse"></span>
            System Active
        </span>
    </div>

    <!-- MAIN DASHBOARD CONTENT -->
    <div class="space-y-6">

        <!-- WELCOME BANNER CARD -->
        <div class="rounded-2xl border border-darkBorder/60 bg-gradient-to-br from-darkCard to-darkCard/30 p-6 md:p-8 shadow-xl relative overflow-hidden group">
            {{-- Decorative Glows --}}
            <div class="absolute -right-20 -top-20 w-80 h-80 rounded-full bg-oceanBlue/10 blur-[100px] pointer-events-none group-hover:bg-oceanBlue/15 transition-all duration-500"></div>
            <div class="absolute -left-20 -bottom-20 w-80 h-80 rounded-full bg-accentTeal/5 blur-[120px] pointer-events-none"></div>

            <div class="relative z-10 space-y-3">
                <h2 class="font-display font-black text-2xl md:text-3xl text-white tracking-tight">
                    Welcome back, <span class="bg-clip-text text-transparent bg-gradient-to-r from-sky-400 to-oceanBlue">{{ $user->name }}</span>!
                </h2>
                <p class="text-sm text-textSecondary leading-relaxed max-w-xl font-sans">
                    Here is an overview of your current career positioning. Start analyzing missing skills and preparing for interview questions to land your target job.
                </p>
            </div>
        </div>

        <!-- 4-COLUMN QUICK STATS GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            <!-- STAT 1: READINESS SCORE -->
            <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-5 flex items-center gap-4 transition-all duration-300 hover:border-darkBorder">
                @if ($careerPlan && $careerPlan->isActive())
                    @php
                        $score = $careerPlan->readiness_score;
                        $colorClass = 'text-red-400 bg-red-500/10 border-red-500/20';
                        $glowColor = 'shadow-red-500/10';
                        if ($score >= 70) {
                            $colorClass = 'text-accentTeal bg-accentTeal/10 border-accentTeal/20';
                            $glowColor = 'shadow-accentTeal/10';
                        } elseif ($score >= 40) {
                            $colorClass = 'text-amber-400 bg-amber-500/10 border-amber-500/20';
                            $glowColor = 'shadow-amber-500/10';
                        }
                    @endphp
                    <div class="w-14 h-14 rounded-full border-2 border-dashed flex items-center justify-center font-display font-black text-lg {{ $colorClass }} {{ $glowColor }} shrink-0 shadow-lg">
                        {{ $score }}%
                    </div>
                    <div class="space-y-0.5">
                        <p class="text-[10px] font-mono font-bold text-textSecondary/60 uppercase tracking-wider">Readiness Score</p>
                        <h4 class="text-sm font-bold text-white leading-tight">
                            @if ($score >= 70) Excellent Match @elseif ($score >= 40) Moderate Gap @else High Gap @endif
                        </h4>
                    </div>
                @elseif ($careerPlan && $careerPlan->isPending())
                    <div class="w-14 h-14 rounded-full bg-oceanBlue/10 border border-oceanBlue/20 flex items-center justify-center text-oceanBlue shrink-0 animate-pulse">
                        <span class="material-symbols-outlined text-2xl animate-spin">sync</span>
                    </div>
                    <div class="space-y-0.5">
                        <p class="text-[10px] font-mono font-bold text-textSecondary/60 uppercase tracking-wider">Readiness Score</p>
                        <h4 class="text-sm font-bold text-oceanBlue leading-tight animate-pulse">Analyzing...</h4>
                    </div>
                @else
                    <div class="w-14 h-14 rounded-full bg-darkBg border border-darkBorder flex items-center justify-center text-textSecondary/50 shrink-0">
                        <span class="material-symbols-outlined text-2xl">query_stats</span>
                    </div>
                    <div class="space-y-0.5">
                        <p class="text-[10px] font-mono font-bold text-textSecondary/60 uppercase tracking-wider">Readiness Score</p>
                        <h4 class="text-sm font-bold text-textSecondary/70 leading-tight">Not Analyzed</h4>
                    </div>
                @endif
            </div>

            <!-- STAT 2: TARGET JOB -->
            <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-5 flex items-center gap-4 transition-all duration-300 hover:border-darkBorder">
                <div class="w-12 h-12 rounded-xl bg-oceanBlue/10 border border-oceanBlue/20 flex items-center justify-center text-oceanBlue shrink-0">
                    <span class="material-symbols-outlined text-2xl">target</span>
                </div>
                <div class="space-y-0.5 min-w-0">
                    <p class="text-[10px] font-mono font-bold text-textSecondary/60 uppercase tracking-wider">Target Job</p>
                    <h4 class="text-sm font-bold text-white truncate leading-tight">{{ $targetJob ?? 'Not Configured' }}</h4>
                </div>
            </div>

            <!-- STAT 3: ADDED SKILLS -->
            <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-5 flex items-center gap-4 transition-all duration-300 hover:border-darkBorder">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 shrink-0">
                    <span class="material-symbols-outlined text-2xl">verified</span>
                </div>
                <div class="space-y-0.5">
                    <p class="text-[10px] font-mono font-bold text-textSecondary/60 uppercase tracking-wider">My Skills</p>
                    <h4 class="text-sm font-bold text-white leading-tight">{{ $userSkills->count() }} Skills Listed</h4>
                </div>
            </div>

            <!-- STAT 4: MISSING SKILLS -->
            <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-5 flex items-center gap-4 transition-all duration-300 hover:border-darkBorder">
                <div class="w-12 h-12 rounded-xl @if ($careerPlan && count($careerPlan->missing_skills ?? []) > 0) bg-red-500/10 border-red-500/20 text-red-400 @else bg-darkBg border-darkBorder text-textSecondary/50 @endif flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-2xl">warning</span>
                </div>
                <div class="space-y-0.5">
                    <p class="text-[10px] font-mono font-bold text-textSecondary/60 uppercase tracking-wider">Gaps Identified</p>
                    <h4 class="text-sm font-bold text-white leading-tight">
                        @if ($careerPlan && $careerPlan->isActive())
                            {{ count($careerPlan->missing_skills ?? []) }} Skills Missing
                        @else
                            No analysis
                        @endif
                    </h4>
                </div>
            </div>

        </div>

        <!-- TWO-COLUMN DETAILED SECTION -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- LEFT/MAIN: SKILLS INVENTORY & TARGET PROFILE (SPAN 2) -->
            <div class="lg:col-span-2 space-y-6">
                
                {{-- TARGET JOB / STRATEGIC OVERVIEW --}}
                <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-6 shadow-xl space-y-4">
                    <div class="flex items-center gap-2 border-b border-darkBorder/40 pb-3">
                        <span class="material-symbols-outlined text-oceanBlue text-lg">track_changes</span>
                        <h3 class="font-display font-bold text-sm text-white">Target Job Analysis</h3>
                    </div>

                    @if ($targetJob)
                        <div class="space-y-4">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-xl bg-oceanBlue/10 border border-oceanBlue/20 flex items-center justify-center text-oceanBlue shrink-0 shadow-glowBlue/10">
                                    <span class="material-symbols-outlined text-2xl">work</span>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-xs font-mono font-bold text-oceanBlue uppercase tracking-wider">Current Target</p>
                                    <h4 class="text-base font-bold text-white font-display leading-tight">{{ $targetJob }}</h4>
                                </div>
                            </div>

                            @if ($careerPlan && $careerPlan->isActive())
                                <div class="bg-darkBg/30 border border-darkBorder/50 rounded-xl p-4 space-y-3">
                                    <h5 class="text-xs font-bold text-white flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-accentTeal text-base">analytics</span>
                                        Market Gap Summary
                                    </h5>
                                    <p class="text-xs text-textSecondary leading-relaxed">
                                        {{ $careerPlan->gap_summary }}
                                    </p>
                                </div>
                            @elseif ($careerPlan && $careerPlan->isPending())
                                <div class="py-6 text-center rounded-xl border border-dashed border-darkBorder/40 bg-darkBg/10">
                                    <p class="text-xs text-oceanBlue animate-pulse flex items-center justify-center gap-1.5">
                                        <span class="material-symbols-outlined text-sm animate-spin">sync</span>
                                        AI is currently generating your career path and gap analysis...
                                    </p>
                                </div>
                            @else
                                <div class="py-6 text-center rounded-xl border border-dashed border-darkBorder/45 bg-darkBg/20 space-y-3">
                                    <p class="text-xs text-textSecondary">You haven't run your gap analysis for this job yet.</p>
                                    <form action="{{ route('career-plan.generate') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-oceanBlue hover:bg-oceanHover text-white text-xs font-bold shadow-premium hover:shadow-glowBlue transition-all">
                                            <span class="material-symbols-outlined text-sm">auto_awesome</span>
                                            Run Gap Analysis
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-8 text-center space-y-3">
                            <div class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400">
                                <span class="material-symbols-outlined text-2xl">warning</span>
                            </div>
                            <div class="space-y-1">
                                <h4 class="text-sm font-bold text-white">No Target Role Configured</h4>
                                <p class="text-xs text-textSecondary max-w-sm">Please set your target job profile in your settings to analyze your skill gaps against market requirements.</p>
                            </div>
                            <a href="{{ route('profile.show') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-oceanBlue hover:bg-oceanHover text-white text-xs font-bold shadow-premium transition-all">
                                <span class="material-symbols-outlined text-sm">settings</span>
                                Set Target Job
                            </a>
                        </div>
                    @endif
                </div>

                {{-- MY SKILLS SUMMARY --}}
                <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-6 shadow-xl space-y-4">
                    <div class="flex items-center justify-between border-b border-darkBorder/40 pb-3">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-accentTeal text-lg">bolt</span>
                            <h3 class="font-display font-bold text-sm text-white">Skills Inventory</h3>
                        </div>
                        <a href="{{ route('skills.index') }}" class="text-xs font-bold text-accentTeal hover:text-white transition-colors">
                            Manage Skills &rarr;
                        </a>
                    </div>

                    @if ($userSkills->isEmpty())
                        <div class="py-10 text-center rounded-xl border border-dashed border-darkBorder/40 bg-darkBg/10 space-y-3">
                            <p class="text-xs text-textSecondary">You haven't listed any of your skills yet.</p>
                            <a href="{{ route('skills.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl border border-darkBorder hover:bg-darkBg/50 text-white text-xs font-bold transition-all">
                                <span class="material-symbols-outlined text-sm">add</span>
                                Add Skills
                            </a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach ($userSkills as $skill)
                                <div class="px-4 py-3 rounded-xl border border-darkBorder bg-darkBg/25 flex items-center justify-between gap-3 hover:border-darkBorder/80 transition-all">
                                    <div class="flex items-center gap-2 min-w-0">
                                        <span class="w-2 h-2 rounded-full bg-accentTeal shrink-0"></span>
                                        <span class="text-xs font-bold text-white truncate">{{ $skill->name }}</span>
                                    </div>
                                    @if ($skill->level)
                                        <span class="text-[9px] font-black uppercase tracking-wider text-textSecondary border border-darkBorder/40 bg-darkBg px-2 py-0.5 rounded shrink-0">
                                            {{ $skill->level->value }}
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>

            <!-- RIGHT: QUICK ACTIONS & ACTION STEPS CHECKLIST -->
            <div class="space-y-6">

                {{-- DEDICATED ACTION CENTER --}}
                <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-6 shadow-xl space-y-5">
                    <div class="flex items-center gap-2 border-b border-darkBorder/40 pb-3">
                        <span class="material-symbols-outlined text-oceanBlue text-lg">fact_check</span>
                        <h3 class="font-display font-bold text-sm text-white">Recommended Actions</h3>
                    </div>

                    <div class="space-y-4">
                        {{-- Step 1: Set Target Job --}}
                        <div class="flex items-start gap-3">
                            <div class="w-5 h-5 rounded-full flex items-center justify-center shrink-0 text-xs mt-0.5
                                @if ($targetJob) bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 @else bg-darkBg text-textSecondary/50 border border-darkBorder @endif">
                                <span class="material-symbols-outlined text-[14px]">@if ($targetJob) check @else horizontal_rule @endif</span>
                            </div>
                            <div class="space-y-0.5 min-w-0">
                                <h5 class="text-xs font-bold @if ($targetJob) text-white/50 line-through @else text-white @endif">Define Target Job</h5>
                                <p class="text-[10px] text-textSecondary">Set your career destination in profile.</p>
                            </div>
                        </div>

                        {{-- Step 2: Add Skills --}}
                        <div class="flex items-start gap-3">
                            @php $hasSkills = $userSkills->isNotEmpty(); @endphp
                            <div class="w-5 h-5 rounded-full flex items-center justify-center shrink-0 text-xs mt-0.5
                                @if ($hasSkills) bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 @else bg-darkBg text-textSecondary/50 border border-darkBorder @endif">
                                <span class="material-symbols-outlined text-[14px]">@if ($hasSkills) check @else horizontal_rule @endif</span>
                            </div>
                            <div class="space-y-0.5 min-w-0">
                                <h5 class="text-xs font-bold @if ($hasSkills) text-white/50 line-through @else text-white @endif">Add Current Skills</h5>
                                <p class="text-[10px] text-textSecondary">List your tech stack to compare gaps.</p>
                            </div>
                        </div>

                        {{-- Step 3: Run Gap Analysis --}}
                        <div class="flex items-start gap-3">
                            @php $hasPlan = $careerPlan && $careerPlan->isActive(); @endphp
                            <div class="w-5 h-5 rounded-full flex items-center justify-center shrink-0 text-xs mt-0.5
                                @if ($hasPlan) bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 @else bg-darkBg text-textSecondary/50 border border-darkBorder @endif">
                                <span class="material-symbols-outlined text-[14px]">@if ($hasPlan) check @else horizontal_rule @endif</span>
                            </div>
                            <div class="space-y-0.5 min-w-0">
                                <h5 class="text-xs font-bold @if ($hasPlan) text-white/50 line-through @else text-white @endif">Generate Career Plan</h5>
                                <p class="text-[10px] text-textSecondary">Compare skills against market demand.</p>
                            </div>
                        </div>

                        {{-- Step 4: Practice Interview Qs --}}
                        <div class="flex items-start gap-3">
                            @php $hasMissing = $careerPlan && count($careerPlan->missing_skills ?? []) > 0; @endphp
                            <div class="w-5 h-5 rounded-full flex items-center justify-center shrink-0 text-xs mt-0.5
                                @if ($hasMissing) bg-sky-500/10 text-sky-400 border border-sky-500/20 @else bg-darkBg text-textSecondary/50 border border-darkBorder @endif">
                                <span class="material-symbols-outlined text-[14px]">quiz</span>
                            </div>
                            <div class="space-y-0.5 min-w-0">
                                <h5 class="text-xs font-bold text-white">Practice Interview Questions</h5>
                                @if ($hasMissing)
                                    <a href="{{ route('career-plan.missing-skills') }}" class="text-[10px] text-sky-400 hover:text-white font-bold block mt-0.5 transition-colors">
                                        View missing skills &rarr;
                                    </a>
                                @else
                                    <p class="text-[10px] text-textSecondary">Available once gap analysis is done.</p>
                                @endif
                            </div>
                        </div>

                        {{-- Step 5: Optimize Professional Bio --}}
                        <div class="flex items-start gap-3">
                            <div class="w-5 h-5 rounded-full bg-accentTeal/10 text-accentTeal border border-accentTeal/20 flex items-center justify-center shrink-0 text-xs mt-0.5">
                                <span class="material-symbols-outlined text-[14px]">auto_awesome</span>
                            </div>
                            <div class="space-y-0.5 min-w-0">
                                <h5 class="text-xs font-bold text-white">Optimize Resume Bio</h5>
                                <p class="text-[10px] text-textSecondary">Make your experience stand out to hiring managers.</p>
                                <a href="{{ route('profile.edit') }}" class="text-[10px] text-accentTeal hover:text-white font-bold block mt-0.5 transition-colors">
                                    Improve Experience Bio &rarr;
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- AI ASSISTANT SUMMARY --}}
                <div class="rounded-2xl border border-darkBorder/60 bg-gradient-to-br from-[#0284c7]/10 to-transparent p-6 shadow-xl space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-oceanBlue text-lg">smart_toy</span>
                        <h4 class="font-display font-bold text-sm text-white">Need guidance?</h4>
                    </div>
                    <p class="text-xs text-textSecondary leading-relaxed">
                        Gaply compares your skills against live job listings to formulate custom study tasks, optimize your professional resume bios, and generate specialized interview preps in real time.
                    </p>
                    <div class="pt-2">
                        <a href="{{ route('career-plan.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-oceanBlue hover:text-white transition-colors">
                            Explore Career Plan &rarr;
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </div>

</x-layout>