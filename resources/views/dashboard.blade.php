<x-layout title="Dashboard — Gaply">

    {{-- Welcome Header with User Target Job --}}
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="font-display font-black text-3xl tracking-tight" style="color: var(--color-text-primary);">
                Welcome back, {{ explode(' ', $user->name)[0] }}!
            </h1>
            <p class="text-sm mt-1" style="color: var(--color-text-secondary);">
                Analyzing your skills for <strong class="font-semibold" style="color: var(--color-primary);">{{ $targetJob }}</strong>.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('profile') }}" 
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold border transition-all active:scale-95 cursor-pointer shadow-premium"
                style="background: var(--color-surface); border-color: var(--color-border); color: var(--color-text-primary);"
                onmouseover="this.style.backgroundColor='var(--color-bg)'"
                onmouseout="this.style.backgroundColor='var(--color-surface)'">
                <span class="material-symbols-outlined" style="font-size: 18px;">manage_accounts</span>
                Configure Profile
            </a>
        </div>
    </div>

    {{-- Main Dashboard Layout Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

        {{-- WIDGET 1: Skill Gap Analysis --}}
        <div class="lg:col-span-2 rounded-2xl border p-6 flex flex-col justify-between shadow-premium" 
            style="background: var(--color-surface); border-color: var(--color-border);">
            <div>
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-[20px] text-primary" style="color: var(--color-primary);">insights</span>
                        <h2 class="text-base font-bold tracking-tight text-textPrimary">Skill Gap Analysis</h2>
                    </div>
                    <span class="text-xs font-mono font-bold px-2.5 py-1 rounded-lg" 
                        style="background: var(--color-bg); color: var(--color-text-secondary);">
                        {{ count($acquired) }} / {{ count($requiredSkills) }} Skills Acquired
                    </span>
                </div>

                {{-- Visual Comparison Lists --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Acquired Skills Column --}}
                    <div>
                        <h3 class="text-xs font-bold uppercase tracking-wider mb-4 flex items-center gap-2" 
                            style="color: var(--color-success);">
                            <span class="w-1.5 h-1.5 rounded-full" style="background: var(--color-success);"></span>
                            Acquired Skills
                        </h3>
                        @if(count($acquired) > 0)
                            <div class="space-y-2">
                                @foreach($acquired as $skill)
                                    <div class="flex items-center justify-between px-3 py-2.5 rounded-xl border text-sm"
                                        style="background: var(--color-success-bg); border-color: rgba(16, 185, 129, 0.15); color: var(--color-success-text);">
                                        <span class="font-semibold">{{ $skill }}</span>
                                        <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-xs italic" style="color: var(--color-text-secondary);">No acquired skills added. Set them in your profile.</p>
                        @endif
                    </div>

                    {{-- Missing Gaps Column --}}
                    <div>
                        <h3 class="text-xs font-bold uppercase tracking-wider mb-4 flex items-center gap-2" 
                            style="color: var(--color-text-secondary);">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                            Missing Gaps
                        </h3>
                        @if(count($missing) > 0)
                            <div class="space-y-2">
                                @foreach($missing as $skill)
                                    <div class="flex items-center justify-between px-3 py-2.5 rounded-xl border text-sm"
                                        style="background: var(--color-bg); border-color: var(--color-border); color: var(--color-text-secondary);">
                                        <span class="font-medium">{{ $skill }}</span>
                                        <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded"
                                            style="background: rgba(239, 68, 68, 0.08); color: #EF4444;">
                                            Missing
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-4 rounded-xl border flex items-start gap-2.5 text-xs font-medium" 
                                style="background: var(--color-success-bg); border-color: rgba(16, 185, 129, 0.15); color: var(--color-success-text);">
                                <span class="material-symbols-outlined" style="font-size:18px;">verified</span>
                                <div>
                                    <p class="font-bold">100% Aligned</p>
                                    <p class="opacity-90 mt-0.5">You have acquired all required skills for this role.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="pt-5 mt-6 border-t flex items-center justify-between text-xs" style="border-color: var(--color-border); color: var(--color-text-secondary);">
                <span>Automated skill gap comparison engine</span>
                <a href="{{ route('profile') }}" class="text-primary font-bold hover:underline" style="color: var(--color-primary);">Configure skills →</a>
            </div>
        </div>

        {{-- WIDGET 2: Job Readiness (Circular Progress Bar) --}}
        <div class="rounded-2xl border p-6 flex flex-col items-center justify-between text-center shadow-premium" 
            style="background: var(--color-surface); border-color: var(--color-border);">
            
            <div class="w-full flex items-center gap-2.5 mb-4 text-left">
                <span class="material-symbols-outlined text-[20px]" style="color: var(--color-success);">check_circle</span>
                <h2 class="text-base font-bold tracking-tight text-textPrimary">Job Readiness</h2>
            </div>

            {{-- SVG Circular Progress Bar --}}
            <div class="relative my-6 flex items-center justify-center">
                {{-- SVG Circle drawing --}}
                <svg class="w-40 h-40 transform -rotate-90">
                    {{-- Track --}}
                    <circle cx="80" cy="80" r="68" stroke="var(--color-border)" stroke-width="8" fill="transparent" />
                    {{-- Active Fill --}}
                    <circle cx="80" cy="80" r="68" stroke="var(--color-success)" stroke-width="8" fill="transparent"
                        stroke-dasharray="427" 
                        stroke-dashoffset="{{ 427 - (427 * ($user->target_job ? $readiness : 64)) / 100 }}"
                        stroke-linecap="round"
                        class="transition-all duration-1000 ease-out" />
                </svg>
                
                {{-- Inside circle details --}}
                <div class="absolute flex flex-col items-center justify-center font-mono">
                    <span class="text-3xl font-black text-textPrimary">
                        {{ $user->target_job ? $readiness : 64 }}%
                    </span>
                    <span class="text-[10px] uppercase tracking-wider font-sans font-bold mt-0.5 text-textSecondary">
                        Readiness
                    </span>
                </div>
            </div>

            <div class="w-full">
                <p class="text-sm font-semibold text-textPrimary">
                    {{ $user->target_job ? "Target: $targetJob" : "Set Target Job to begin" }}
                </p>
                <p class="text-xs mt-1 text-textSecondary">
                    Acquire {{ count($missing) }} missing skills to reach full readiness.
                </p>
            </div>
        </div>
    </div>

    {{-- WIDGET 3: Step-by-Step Roadmap Component --}}
    <div class="rounded-2xl border p-6 shadow-premium" style="background: var(--color-surface); border-color: var(--color-border);">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-2.5">
                <span class="material-symbols-outlined text-[20px]" style="color: var(--color-primary);">route</span>
                <h2 class="text-base font-bold tracking-tight text-textPrimary">Your Smart Roadmap</h2>
            </div>
            <div class="flex items-center gap-2 text-xs font-bold font-mono px-3 py-1 rounded-full text-primary" 
                 style="background: rgba(79, 70, 229, 0.08); color: var(--color-primary);">
                <span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse" style="background-color: var(--color-primary);"></span>
                Active Learning Plan
            </div>
        </div>

        {{-- Premium Step Timeline --}}
        <div class="relative pl-8 border-l-2 space-y-6 ml-4" style="border-color: var(--color-border);">
            @foreach($roadmapTasks as $task)
                <div class="relative">
                    {{-- Customized Timeline Node Indicator --}}
                    <span class="absolute -left-[41px] top-1.5 w-6 h-6 rounded-full border-2 flex items-center justify-center bg-surface"
                        style="
                            border-color: {{
                                $task['status'] === 'completed' ? 'var(--color-success)' : (
                                $task['status'] === 'in_progress' ? 'var(--color-warning-text)' : 'var(--color-border)'
                                )
                            }};
                        ">
                        <span class="w-2 h-2 rounded-full"
                            style="
                                background: {{
                                    $task['status'] === 'completed' ? 'var(--color-success)' : (
                                    $task['status'] === 'in_progress' ? 'var(--color-warning-text)' : 'transparent'
                                    )
                                }};
                            "></span>
                    </span>

                    {{-- Roadmap Task Card --}}
                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 p-5 rounded-2xl border transition-all hover:scale-[1.005]"
                        style="background: var(--color-bg); border-color: var(--color-border);">
                        <div class="space-y-1">
                            <div class="flex items-center gap-3 flex-wrap">
                                <h3 class="text-sm font-bold text-textPrimary">
                                    {{ $task['title'] }}
                                </h3>
                                
                                {{-- Status Badges --}}
                                @if($task['status'] === 'completed')
                                    <span class="text-[9px] font-black uppercase tracking-wider px-2 py-0.5 rounded-full"
                                        style="background: var(--color-success-bg); color: var(--color-success-text);">
                                        Completed
                                    </span>
                                @elseif($task['status'] === 'in_progress')
                                    <span class="text-[9px] font-black uppercase tracking-wider px-2 py-0.5 rounded-full"
                                        style="background: var(--color-warning-bg); color: var(--color-warning-text);">
                                        In Progress
                                    </span>
                                @else
                                    <span class="text-[9px] font-black uppercase tracking-wider px-2 py-0.5 rounded-full"
                                        style="background: var(--color-border); color: var(--color-text-secondary);">
                                        Not Started
                                    </span>
                                @endif
                            </div>
                            <p class="text-xs text-textSecondary leading-relaxed">
                                {{ $task['desc'] }}
                            </p>
                        </div>
                        
                        <div class="flex items-center gap-1.5 shrink-0 px-2.5 py-1 rounded-lg border text-[11px] font-mono font-bold"
                             style="border-color: var(--color-border); color: var(--color-text-secondary); background: var(--color-surface);">
                            <span class="material-symbols-outlined text-[14px]">schedule</span>
                            {{ $task['duration'] }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-layout>
