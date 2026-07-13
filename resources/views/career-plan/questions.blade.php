<x-layout title="Interview Prep: {{ $skillName }} — Gaply">

    <div class="h-full overflow-y-auto pr-3 pb-12 space-y-6">
        {{-- BACK BUTTON --}}
        <div>
            <a href="{{ route('career-plan.index') }}"
                class="inline-flex items-center gap-2 text-sm font-bold text-accentTeal hover:text-white transition-colors">
                <span class="material-symbols-outlined text-base">arrow_back</span>
                Back to Career Analysis
            </a>
        </div>

        {{-- PAGE HEADER --}}
        <div class="mb-6 space-y-1">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-accentTeal text-3xl">quiz</span>
                <h1 class="font-display font-bold text-2xl md:text-3xl text-white tracking-tight">Interview Prep: <span class="text-accentTeal">{{ $skillName }}</span></h1>
            </div>
            <p class="text-sm text-textSecondary font-sans">Common questions and model answers for a <span class="text-white font-medium">{{ $user->target_job }}</span> candidate.</p>
        </div>

        {{-- QUESTIONS LIST --}}
        <div class="space-y-4 max-w-3xl">
            @forelse ($questions as $q)
                @php
                    $difficulty = $q['difficulty'] ?? 'Medium';
                    $diffClass = strtolower($difficulty) === 'hard' 
                        ? 'text-red-400 bg-red-500/10 border-red-500/20' 
                        : (strtolower($difficulty) === 'medium' 
                            ? 'text-amber-400 bg-amber-500/10 border-amber-500/20' 
                            : 'text-emerald-400 bg-emerald-500/10 border-emerald-500/20');
                @endphp

                <details class="group rounded-2xl border border-darkBorder/60 bg-darkCard p-5 [&_summary::-webkit-details-marker]:hidden transition-all duration-300 open:border-accentTeal/30 open:bg-darkBg/60">
                    <summary class="flex items-start justify-between gap-4 cursor-pointer list-none select-none">
                        <div class="flex gap-3">
                            <span class="text-accentTeal font-mono font-bold">{{ $loop->iteration }}.</span>
                            <h3 class="text-sm md:text-base font-bold text-white font-sans group-open:text-accentTeal transition-colors">
                                {{ $q['question'] }}
                            </h3>
                        </div>
                        <div class="flex items-center gap-2 shrink-0">
                            <span class="px-2 py-0.5 rounded text-[9px] font-bold uppercase tracking-wider border {{ $diffClass }}">
                                {{ $difficulty }}
                            </span>
                            <span class="material-symbols-outlined text-textSecondary group-open:rotate-180 transition-transform duration-300">
                                expand_more
                            </span>
                        </div>
                    </summary>
                    
                    <div class="border-t border-darkBorder/20 pt-4 mt-4 space-y-3">
                        <div class="flex items-center gap-1.5 text-xs text-accentTeal font-bold">
                            <span class="material-symbols-outlined text-sm">assignment_turned_in</span>
                            Model Answer & Explanation
                        </div>
                        <div class="text-xs md:text-sm text-textSecondary leading-relaxed bg-[#050811]/40 border border-darkBorder/30 p-4 rounded-xl whitespace-pre-line font-sans">
                            {{ $q['answer'] }}
                        </div>
                    </div>
                </details>
            @empty
                <div class="rounded-2xl border border-dashed border-darkBorder/60 bg-darkCard/50 p-12 flex flex-col items-center justify-center text-center space-y-4">
                    <div class="w-16 h-16 rounded-2xl bg-red-500/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-red-400 text-3xl">error</span>
                    </div>
                    <div class="space-y-1">
                        <p class="font-display font-bold text-white text-lg">No Questions Generated</p>
                        <p class="text-sm text-textSecondary max-w-sm">We couldn't generate interview questions for this skill right now. Please try again.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

</x-layout>
