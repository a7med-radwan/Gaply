<x-layout title="Analyzing Profile — Gaply">

    <div class="h-full flex flex-col items-center justify-center min-h-[60vh] text-center space-y-6">
        {{-- Loading Spinner & Icon --}}
        <div class="relative w-24 h-24">
            {{-- Outer spinning glow ring --}}
            <div class="absolute inset-0 rounded-3xl border-4 border-t-oceanBlue border-r-transparent border-b-oceanBlue border-l-transparent animate-spin"></div>
            
            {{-- Inner pulse card --}}
            <div class="absolute inset-2 rounded-2xl bg-darkCard border border-darkBorder flex items-center justify-center animate-pulse">
                <span class="material-symbols-outlined text-oceanBlue text-4xl animate-bounce">auto_awesome</span>
            </div>
        </div>

        {{-- Text Information --}}
        <div class="space-y-2 max-w-md">
            <h2 class="font-display font-black text-xl md:text-2xl text-white tracking-tight">Analyzing Your Profile...</h2>
            <p class="text-sm text-textSecondary leading-relaxed">
                We are currently performing a comprehensive gap analysis between your skills and the market requirements for your target job in the background.
            </p>
            <p class="text-xs text-textSecondary/70 pt-2">
                This process usually takes between 15 to 30 seconds.
            </p>
        </div>

        {{-- Manual Check Button --}}
        <div>
            <a href="{{ route('career-plan.processing') }}"
                class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-oceanBlue hover:bg-oceanHover text-white text-sm font-bold shadow-premium hover:shadow-glowBlue transition-all duration-200 active:scale-95">
                <span class="material-symbols-outlined text-base animate-spin">sync</span>
                Check Status & View Plan
            </a>
        </div>

        {{-- Additional status dots --}}
        <div class="flex gap-1.5 justify-center pt-2">
            <div class="w-2.5 h-2.5 rounded-full bg-oceanBlue/50 animate-bounce" style="animation-delay: 0ms"></div>
            <div class="w-2.5 h-2.5 rounded-full bg-oceanBlue/50 animate-bounce" style="animation-delay: 150ms"></div>
            <div class="w-2.5 h-2.5 rounded-full bg-oceanBlue/50 animate-bounce" style="animation-delay: 300ms"></div>
        </div>
    </div>
</x-layout>
