<x-layout title="Missing Skills — Gaply">

    <div class="h-full overflow-y-auto pr-3 pb-12 space-y-6">
        {{-- PAGE HEADER --}}
        <div class="mb-6 space-y-1">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-oceanBlue text-3xl">running_with_errors</span>
                <h1 class="font-display font-bold text-2xl md:text-3xl text-white tracking-tight">Missing Skills</h1>
            </div>
            <p class="text-sm text-textSecondary font-sans">
                @if ($user->target_job)
                    Skills you need to learn to become a <span class="text-white font-semibold">{{ $user->target_job }}</span>.
                @else
                    Skills you are missing based on your target job.
                @endif
            </p>
        </div>

        {{-- EMPTY STATE: NO TARGET JOB OR SKILLS AT ALL --}}
        @if (! $user->target_job)
            <div class="rounded-2xl border border-amber-500/20 bg-amber-500/5 p-6 flex items-start gap-4 max-w-xl">
                <span class="material-symbols-outlined text-amber-400 text-2xl mt-0.5">warning</span>
                <div class="space-y-2">
                    <p class="font-bold text-white">No Target Job Set</p>
                    <p class="text-sm text-textSecondary">Please set your target job in your profile before analyzing missing skills.</p>
                    <a href="{{ route('profile.edit') }}"
                        class="inline-flex items-center gap-2 text-sm font-bold text-amber-400 hover:text-white transition-colors mt-1">
                        <span class="material-symbols-outlined text-base">open_in_new</span>
                        Set Target Job
                    </a>
                </div>
            </div>

        @elseif (! $careerPlan)
            {{-- EMPTY STATE: NO CAREER PLAN GENERATED --}}
            <div class="rounded-2xl border border-dashed border-darkBorder/60 bg-darkCard/50 p-12 flex flex-col items-center justify-center text-center space-y-4 max-w-xl">
                <div class="w-16 h-16 rounded-2xl bg-oceanBlue/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-oceanBlue text-3xl">analytics</span>
                </div>
                <div class="space-y-1">
                    <p class="font-display font-bold text-white text-lg">No Analysis Generated Yet</p>
                    <p class="text-sm text-textSecondary">Please generate a career gap analysis first to determine your missing skills.</p>
                </div>
                <a href="{{ route('career-plan.index') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-oceanBlue text-white text-sm font-bold hover:opacity-90 transition-all">
                    <span class="material-symbols-outlined text-base">auto_awesome</span>
                    Go to Career Plan
                </a>
            </div>

        @elseif (empty($missingSkills))
            {{-- EMPTY STATE: NO MISSING SKILLS --}}
            <div class="rounded-2xl border border-emerald-500/20 bg-emerald-500/5 p-8 flex flex-col items-center justify-center text-center space-y-4 max-w-xl">
                <div class="w-16 h-16 rounded-2xl bg-emerald-500/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-emerald-400 text-3xl">check_circle</span>
                </div>
                <div class="space-y-1">
                    <p class="font-display font-bold text-white text-lg">Congratulations!</p>
                    <p class="text-sm text-textSecondary">You have all the required skills for the <span class="text-white font-semibold">{{ $user->target_job }}</span> role in today's job market.</p>
                </div>
            </div>

        @else
            {{-- MISSING SKILLS LIST --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-4xl">
                @foreach ($missingSkills as $skill)
                    <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-5 flex items-center justify-between gap-4 hover:border-oceanBlue/30 transition-all duration-300">
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-red-400 animate-pulse"></span>
                                <h3 class="font-display font-bold text-white text-sm md:text-base">{{ $skill }}</h3>
                            </div>
                            <p class="text-xs text-textSecondary font-sans">Identified as missing for {{ $user->target_job }}</p>
                        </div>

                        <a href="{{ route('career-plan.interview-questions', ['skill_name' => $skill]) }}"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-darkBg border border-darkBorder/80 hover:border-oceanBlue text-xs font-bold text-oceanBlue hover:text-white hover:bg-oceanBlue/5 transition-all duration-200 shrink-0"
                            title="Generate Interview Questions">
                            <span class="material-symbols-outlined text-sm">quiz</span>
                            Interview Qs
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</x-layout>
