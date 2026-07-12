<x-layout title="Career Plan — Gaply">

    <div class="h-full overflow-y-auto pr-3 pb-12 space-y-6">
        {{-- PAGE HEADER --}}
        <div class="mb-6 space-y-1 shrink-0">
            <h1 class="font-display font-bold text-2xl md:text-3xl text-white tracking-tight">Career Gap Analysis</h1>
            <p class="text-sm text-textSecondary font-sans">AI-powered analysis of your skills vs. the job market.</p>
        </div>

        {{-- NO TARGET JOB WARNING --}}
        @if (! $user->target_job)
            <div class="rounded-2xl border border-amber-500/20 bg-amber-500/5 p-6 flex items-start gap-4">
                <span class="material-symbols-outlined text-amber-400 text-2xl mt-0.5">warning</span>
                <div class="space-y-2">
                    <p class="font-bold text-white">No Target Job Set</p>
                    <p class="text-sm text-textSecondary">Please set your target job in your profile before running an analysis.</p>
                    <a href="{{ route('profile.edit') }}"
                        class="inline-flex items-center gap-2 text-sm font-bold text-amber-400 hover:text-white transition-colors mt-1">
                        <span class="material-symbols-outlined text-base">open_in_new</span>
                        Set Target Job
                    </a>
                </div>
            </div>

        @elseif (! $user->skills->count())
            {{-- NO SKILLS WARNING --}}
            <div class="rounded-2xl border border-amber-500/20 bg-amber-500/5 p-6 flex items-start gap-4">
                <span class="material-symbols-outlined text-amber-400 text-2xl mt-0.5">bolt</span>
                <div class="space-y-2">
                    <p class="font-bold text-white">No Skills Added</p>
                    <p class="text-sm text-textSecondary">Please add your current skills before running an analysis.</p>
                    <a href="{{ route('skills.index') }}"
                        class="inline-flex items-center gap-2 text-sm font-bold text-amber-400 hover:text-white transition-colors mt-1">
                        <span class="material-symbols-outlined text-base">open_in_new</span>
                        Add Skills
                    </a>
                </div>
            </div>

        @else
            {{-- GENERATE BUTTON + PLAN DISPLAY --}}
            <div class="space-y-6">

                {{-- TOP ACTION BAR --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 rounded-2xl border border-darkBorder/60 bg-darkCard p-5">
                    <div class="space-y-0.5">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-accentTeal">track_changes</span>
                            <p class="font-display font-bold text-white">Target: <span class="text-accentTeal">{{ $user->target_job }}</span></p>
                        </div>
                        @if ($careerPlan)
                            <p class="text-xs text-textSecondary font-mono pl-7">Last analyzed {{ $careerPlan->created_at->diffForHumans() }}</p>
                        @else
                            <p class="text-xs text-textSecondary pl-7">No analysis yet. Generate your first career plan!</p>
                        @endif
                    </div>

                    <form action="{{ route('career-plan.generate') }}" method="POST" id="generate-form">
                        @csrf
                        <button type="submit" id="generate-btn"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-accentTeal to-[#0284c7] text-white text-sm font-bold shadow-lg hover:opacity-90 active:scale-95 transition-all duration-200 disabled:opacity-50">
                            <span class="material-symbols-outlined text-base" id="generate-icon">auto_awesome</span>
                            <span id="generate-label">{{ $careerPlan ? 'Re-Analyze' : 'Generate Analysis' }}</span>
                        </button>
                    </form>
                </div>

                @if ($careerPlan)

                    {{-- READINESS SCORE --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        {{-- Score Card --}}
                        <div class="sm:col-span-1 rounded-2xl border border-darkBorder/60 bg-darkCard p-6 flex flex-col items-center justify-center text-center space-y-3">
                            @php
                                $score = $careerPlan->readiness_score ?? 0;
                                $scoreColor = $score >= 70 ? '#0ea5e9' : ($score >= 40 ? '#f59e0b' : '#ef4444');
                                $circumference = 2 * M_PI * 40;
                                $dashOffset = $circumference * (1 - $score / 100);
                            @endphp
                            <div class="relative w-28 h-28">
                                <svg class="w-28 h-28 -rotate-90" viewBox="0 0 100 100">
                                    <circle cx="50" cy="50" r="40" fill="none" stroke="#1f2937" stroke-width="10" />
                                    <circle cx="50" cy="50" r="40" fill="none"
                                        stroke="{{ $scoreColor }}"
                                        stroke-width="10"
                                        stroke-linecap="round"
                                        stroke-dasharray="{{ $circumference }}"
                                        stroke-dashoffset="{{ $dashOffset }}"
                                        style="transition: stroke-dashoffset 1s ease" />
                                </svg>
                                <div class="absolute inset-0 flex flex-col items-center justify-center">
                                    <span class="font-display font-black text-2xl text-white">{{ $score }}</span>
                                    <span class="text-[10px] font-mono text-textSecondary uppercase tracking-wider">/ 100</span>
                                </div>
                            </div>
                            <div>
                                <p class="font-bold text-white text-sm">Readiness Score</p>
                                <p class="text-xs text-textSecondary mt-0.5">
                                    @if ($score >= 70) You're well on track!
                                    @elseif ($score >= 40) Good progress, keep going!
                                    @else You have a lot to learn — great opportunity!
                                    @endif
                                </p>
                            </div>

                            @if ($careerPlan->status->value === 'active')
                                <form action="{{ route('career-plan.complete', $careerPlan) }}" method="POST" class="mt-1">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="text-xs font-bold text-accentTeal hover:text-white border border-accentTeal/30 hover:border-white/20 px-3 py-1.5 rounded-lg transition-all">
                                        Mark as Completed ✓
                                    </button>
                                </form>
                            @else
                                <span class="text-xs font-bold text-emerald-400 border border-emerald-400/30 px-3 py-1.5 rounded-lg">
                                    ✓ Completed
                                </span>
                            @endif
                        </div>

                        {{-- Gap Summary --}}
                        <div class="sm:col-span-2 rounded-2xl border border-darkBorder/60 bg-darkCard p-6 space-y-3">
                            <div class="flex items-center gap-2 border-b border-darkBorder/40 pb-3">
                                <span class="material-symbols-outlined text-oceanBlue text-lg">summarize</span>
                                <h2 class="font-display font-bold text-sm text-white">Gap Summary</h2>
                            </div>
                            <p class="text-sm text-textSecondary leading-relaxed whitespace-pre-line">{{ $careerPlan->gap_summary }}</p>
                        </div>
                    </div>

                    {{-- SKILLS COLUMNS --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- Missing Skills --}}
                        <div class="rounded-2xl border border-red-500/20 bg-darkCard p-6 space-y-4">
                            <div class="flex items-center gap-2 border-b border-darkBorder/40 pb-3">
                                <span class="material-symbols-outlined text-red-400 text-lg">warning</span>
                                <h2 class="font-display font-bold text-sm text-white">Missing Skills</h2>
                                <span class="ml-auto text-xs font-mono text-textSecondary/65 bg-darkBg px-2 py-0.5 rounded border border-darkBorder/40">
                                    {{ count($careerPlan->missing_skills ?? []) }}
                                </span>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($careerPlan->missing_skills ?? [] as $skill)
                                    <span class="px-3 py-1.5 rounded-lg border border-red-500/20 bg-red-500/5 text-xs font-semibold text-red-300 flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>
                                        {{ $skill }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        {{-- Market Requirements --}}
                        <div class="rounded-2xl border border-accentTeal/20 bg-darkCard p-6 space-y-4">
                            <div class="flex items-center gap-2 border-b border-darkBorder/40 pb-3">
                                <span class="material-symbols-outlined text-accentTeal text-lg">workspace_premium</span>
                                <h2 class="font-display font-bold text-sm text-white">Market Requirements</h2>
                                <span class="ml-auto text-xs font-mono text-textSecondary/65 bg-darkBg px-2 py-0.5 rounded border border-darkBorder/40">
                                    {{ count($careerPlan->market_requirements ?? []) }}
                                </span>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($careerPlan->market_requirements ?? [] as $req)
                                    @php
                                        $hasSkill = $user->skills->contains(fn ($s) => stripos($s->name, $req) !== false || stripos($req, $s->name) !== false);
                                    @endphp
                                    <span class="px-3 py-1.5 rounded-lg border text-xs font-semibold flex items-center gap-1.5
                                        {{ $hasSkill
                                            ? 'border-accentTeal/30 bg-accentTeal/5 text-accentTeal'
                                            : 'border-darkBorder bg-darkBg/30 text-textSecondary' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $hasSkill ? 'bg-accentTeal' : 'bg-textSecondary/40' }}"></span>
                                        {{ $req }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- IMPROVEMENT PLAN --}}
                    <div class="rounded-2xl border border-darkBorder/60 bg-darkCard p-6 space-y-6">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-darkBorder/40 pb-4">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-accentTeal text-lg">rocket_launch</span>
                                <h2 class="font-display font-bold text-sm text-white">Your Improvement Plan</h2>
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-mono font-bold uppercase tracking-wider text-accentTeal bg-accentTeal/10 border border-accentTeal/20">
                                    AI Generated
                                </span>
                            </div>
                            
                            <!-- Toggle Button -->
                            <button type="button" id="toggle-plan-view" class="text-xs font-bold text-oceanBlue hover:text-white px-3 py-1.5 rounded-xl border border-darkBorder/60 hover:bg-darkBg/50 transition-all flex items-center justify-center gap-1.5 self-start sm:self-auto">
                                <span class="material-symbols-outlined text-[16px]" id="toggle-view-icon">article</span>
                                <span id="toggle-view-label">Show Raw Text</span>
                            </button>
                        </div>

                        <!-- Timeline View -->
                        <div id="timeline-view-container" class="space-y-6">
                            <!-- Tabs dynamic -->
                            <div id="month-tabs" class="flex flex-wrap gap-2"></div>
                            
                            <!-- Timeline dynamic -->
                            <div id="timeline-content" class="border-l-2 border-darkBorder/40 pl-6 ml-3.5 space-y-8 relative py-2"></div>
                        </div>

                        <!-- Raw View -->
                        <div id="raw-view-container" class="hidden prose-content text-sm text-textSecondary leading-relaxed">
                            {!! nl2br(e($careerPlan->improvement_plan)) !!}
                        </div>
                    </div>

                @else
                    {{-- EMPTY STATE --}}
                    <div class="rounded-2xl border border-dashed border-darkBorder/60 bg-darkCard/50 p-12 flex flex-col items-center justify-center text-center space-y-4">
                        <div class="w-16 h-16 rounded-2xl bg-accentTeal/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-accentTeal text-3xl">analytics</span>
                        </div>
                        <div class="space-y-1">
                            <p class="font-display font-bold text-white text-lg">No Analysis Yet</p>
                            <p class="text-sm text-textSecondary max-w-md">Click "Generate Analysis" above to get your personalized career gap analysis powered by AI.</p>
                        </div>
                    </div>
                @endif

            </div>
        @endif
    </div>

    {{-- Loading overlay --}}
    <div id="loading-overlay"
        class="fixed inset-0 bg-darkBg/90 backdrop-blur-sm z-50 hidden flex-col items-center justify-center gap-4">
        <div class="w-16 h-16 rounded-2xl bg-accentTeal/10 flex items-center justify-center animate-pulse">
            <span class="material-symbols-outlined text-accentTeal text-3xl">auto_awesome</span>
        </div>
        <div class="text-center space-y-1">
            <p class="font-display font-bold text-white text-lg">Analyzing your profile...</p>
            <p class="text-sm text-textSecondary">This may take 15-30 seconds. Please wait.</p>
        </div>
        <div class="flex gap-1.5 mt-2">
            <div class="w-2 h-2 rounded-full bg-accentTeal animate-bounce" style="animation-delay: 0ms"></div>
            <div class="w-2 h-2 rounded-full bg-accentTeal animate-bounce" style="animation-delay: 150ms"></div>
            <div class="w-2 h-2 rounded-full bg-accentTeal animate-bounce" style="animation-delay: 300ms"></div>
        </div>
    </div>

    <style>
        .prose-content {
            white-space: pre-line;
            font-family: 'Inter', sans-serif;
            color: #cbd5e1;
            line-height: 1.8;
        }
    </style>

    <script>
        // Form Loading Logic
        const form = document.getElementById('generate-form');
        const overlay = document.getElementById('loading-overlay');
        const btn = document.getElementById('generate-btn');
        const icon = document.getElementById('generate-icon');
        const label = document.getElementById('generate-label');

        if (form) {
            form.addEventListener('submit', function () {
                overlay.classList.remove('hidden');
                overlay.classList.add('flex');
                btn.disabled = true;
                icon.textContent = 'hourglass_top';
                label.textContent = 'Analyzing...';
            });
        }

        // Timeline Parser and Renderer
        @if ($careerPlan)
        (function() {
            try {
                // Safely fetch and decode plan content using base64 to avoid syntax errors
                const planText = atob(`{{ base64_encode($careerPlan->improvement_plan) }}`);

                function parseImprovementPlan(text) {
                    const lines = text.split('\n');
                    const months = [];
                    let currentMonth = null;
                    let currentWeek = null;

                    for (let line of lines) {
                        line = line.trim();
                        if (!line) continue;

                        // Month Detection
                        const monthMatch = line.match(/^(?:###|#|##|\*\*)\s*Month\s*(\d+)[:\-]?\s*(.*)$/i) || line.match(/^Month\s*(\d+)[:\-]?\s*(.*)$/i);
                        if (monthMatch) {
                            currentMonth = {
                                number: monthMatch[1],
                                title: monthMatch[2].replace(/\*\*|#/g, '').trim(),
                                weeks: []
                            };
                            months.push(currentMonth);
                            currentWeek = null;
                            continue;
                        }

                        // Week Detection
                        const weekMatch = line.match(/^(?:-|-\s*\*\*|\*\*|###)\s*Week\s*(\d+)[:\-]?\s*(.*)$/i) || line.match(/^Week\s*(\d+)[:\-]?\s*(.*)$/i);
                        if (weekMatch) {
                            if (!currentMonth) {
                                currentMonth = { number: "1", title: "General Path", weeks: [] };
                                months.push(currentMonth);
                            }
                            currentWeek = {
                                number: weekMatch[1],
                                title: weekMatch[2].replace(/\*\*|#/g, '').trim(),
                                items: []
                            };
                            currentMonth.weeks.push(currentWeek);
                            continue;
                        }

                        // Item Detection
                        const itemMatch = line.match(/^(?:-|\*)\s*\*\*(.*?)\*\*[:\-]?\s*(.*)$/) || line.match(/^\*\*(.*?)\*\*[:\-]?\s*(.*)$/);
                        if (itemMatch && currentWeek) {
                            currentWeek.items.push({
                                type: itemMatch[1].trim(),
                                content: itemMatch[2].trim()
                            });
                            continue;
                        }

                        // Text continuation fallback
                        if (currentWeek) {
                            if (currentWeek.items.length > 0) {
                                currentWeek.items[currentWeek.items.length - 1].content += ' ' + line.replace(/^-|^\*/, '').trim();
                            } else {
                                currentWeek.items.push({
                                    type: 'Note',
                                    content: line.replace(/^-|^\*/, '').trim()
                                });
                            }
                        } else if (currentMonth) {
                            if (!currentMonth.description) currentMonth.description = '';
                            currentMonth.description += line + '\n';
                        }
                    }
                    return months;
                }

                const parsedMonths = parseImprovementPlan(planText);
                
                const monthTabsContainer = document.getElementById('month-tabs');
                const timelineContent = document.getElementById('timeline-content');
                const timelineView = document.getElementById('timeline-view-container');
                const rawView = document.getElementById('raw-view-container');
                const toggleBtn = document.getElementById('toggle-plan-view');
                const toggleIcon = document.getElementById('toggle-view-icon');
                const toggleLabel = document.getElementById('toggle-view-label');

                let showRaw = false;

                if (!toggleBtn) return;

                toggleBtn.addEventListener('click', () => {
                    showRaw = !showRaw;
                    if (showRaw) {
                        timelineView.classList.add('hidden');
                        rawView.classList.remove('hidden');
                        toggleIcon.textContent = 'grid_view';
                        toggleLabel.textContent = 'Show Timeline';
                    } else {
                        timelineView.classList.remove('hidden');
                        rawView.classList.add('hidden');
                        toggleIcon.textContent = 'article';
                        toggleLabel.textContent = 'Show Raw Text';
                    }
                });

                function getIconForType(type) {
                    const t = type.toLowerCase();
                    if (t.includes('course') || t.includes('resource') || t.includes('read') || t.includes('book')) {
                        return { icon: 'menu_book', color: 'text-sky-400', badge: 'bg-sky-500/10 text-sky-400 border-sky-500/20' };
                    }
                    if (t.includes('project') || t.includes('practice') || t.includes('build') || t.includes('code')) {
                        return { icon: 'terminal', color: 'text-purple-400', badge: 'bg-purple-500/10 text-purple-400 border-purple-500/20' };
                    }
                    if (t.includes('milestone') || t.includes('checkpoint') || t.includes('goal') || t.includes('test')) {
                        return { icon: 'check_circle', color: 'text-emerald-400', badge: 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20' };
                    }
                    if (t.includes('networking') || t.includes('share') || t.includes('community') || t.includes('connect')) {
                        return { icon: 'groups', color: 'text-amber-400', badge: 'bg-amber-500/10 text-amber-400 border-amber-500/20' };
                    }
                    return { icon: 'rocket_launch', color: 'text-oceanBlue', badge: 'bg-oceanBlue/10 text-oceanBlue border-oceanBlue/20' };
                }

                window.renderMonth = function(monthIndex) {
                    const month = parsedMonths[monthIndex];
                    if (!month) return;

                    // Highlight active tab
                    document.querySelectorAll('.month-tab').forEach((tab, index) => {
                        if (index === monthIndex) {
                            tab.className = 'month-tab px-4 py-2.5 rounded-xl text-xs font-bold bg-oceanBlue text-white shadow-premium transition-all duration-200';
                        } else {
                            tab.className = 'month-tab px-4 py-2.5 rounded-xl text-xs font-bold border border-darkBorder text-textSecondary hover:text-white hover:bg-darkBg/50 transition-all duration-200';
                        }
                    });

                    // Render weeks timeline
                    if (month.weeks.length === 0) {
                        timelineContent.innerHTML = `
                            <div class="py-8 text-center text-textSecondary text-xs">
                                No weekly breakdown available for this phase.
                            </div>`;
                        return;
                    }

                    let html = '';
                    month.weeks.forEach(week => {
                        let itemsHtml = '';
                        week.items.forEach(item => {
                            const style = getIconForType(item.type);
                            itemsHtml += `
                                <div class="flex flex-col sm:flex-row sm:items-start gap-2.5 sm:gap-4 text-sm leading-relaxed">
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold uppercase tracking-wider ${style.badge} shrink-0 self-start">
                                        <span class="material-symbols-outlined text-[14px]">${style.icon}</span>
                                        ${item.type}
                                    </span>
                                    <p class="text-textSecondary text-xs md:text-sm pt-0.5">${item.content}</p>
                                </div>`;
                        });

                        html += `
                            <div class="relative group">
                                <!-- Left Dot -->
                                <span class="absolute -left-[33px] top-2.5 w-3.5 h-3.5 rounded-full bg-darkBg border-2 border-oceanBlue shadow-glowBlue transition-all duration-300 group-hover:scale-110"></span>
                                
                                <!-- Week Card -->
                                <div class="rounded-2xl border border-darkBorder/60 bg-darkBg/30 p-5 shadow-xl hover:border-oceanBlue/30 hover:bg-darkBg/60 transition-all duration-300 space-y-4">
                                    <div class="flex items-center justify-between border-b border-darkBorder/20 pb-2">
                                        <h4 class="font-display font-black text-sm md:text-base text-white">Week ${week.number}</h4>
                                        ${week.title ? `<span class="text-xs text-textSecondary/85 font-medium font-sans">${week.title}</span>` : ''}
                                    </div>
                                    <div class="space-y-4">
                                        ${itemsHtml || '<p class="text-xs text-textSecondary italic">No tasks specified for this week.</p>'}
                                    </div>
                                </div>
                            </div>`;
                    });

                    timelineContent.innerHTML = html;
                };

                // Initialize tabs
                if (parsedMonths.length > 0) {
                    let tabsHtml = '';
                    parsedMonths.forEach((month, index) => {
                        tabsHtml += `
                            <button type="button" onclick="renderMonth(${index})" class="month-tab">
                                Month ${month.number}: ${month.title || 'Phase ' + month.number}
                            </button>`;
                    });
                    monthTabsContainer.innerHTML = tabsHtml;
                    renderMonth(0);
                } else {
                    // Fallback to raw markdown if no structural phases detected
                    toggleBtn.click();
                    toggleBtn.style.display = 'none';
                }

            } catch (e) {
                console.error("Failed to parse timeline, falling back to raw view.", e);
                const toggleBtn = document.getElementById('toggle-plan-view');
                if (toggleBtn) {
                    toggleBtn.click();
                    toggleBtn.style.display = 'none';
                }
            }
        })();
        @endif
    </script>
</x-layout>
