<section
    id="voice-agent-panel"
    x-ref="voicePanel"
    x-show="activePanel === 'voice'"
    x-cloak
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="translate-y-4 scale-95 opacity-0"
    x-transition:enter-end="translate-y-0 scale-100 opacity-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="translate-y-0 scale-100 opacity-100"
    x-transition:leave-end="translate-y-4 scale-95 opacity-0"
    @keydown.tab="trapFocus($event, $refs.voicePanel)"
    role="dialog"
    aria-modal="true"
    aria-labelledby="voice-agent-title"
    class="fixed bottom-20 right-3 z-50 w-[calc(100vw-1.5rem)] origin-bottom-right overflow-hidden rounded-2xl border border-white/10 bg-neutron-900 shadow-2xl shadow-black/50 sm:bottom-24 sm:right-6 sm:w-[360px]"
>
    <header class="flex items-center justify-between gap-4 border-b border-white/10 bg-white/[0.035] px-4 py-3.5">
        <div class="flex items-center gap-3"><div class="flex h-10 w-10 items-center justify-center rounded-xl border border-neutron-300/20 bg-neutron-500/15 text-neutron-300"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="9" y="3" width="6" height="11" rx="3" /><path stroke-linecap="round" d="M6.5 10.5a5.5 5.5 0 0 0 11 0M12 16v4m-3 0h6" /></svg></div><div><h2 id="voice-agent-title" class="text-sm font-semibold text-white">Voice Agent</h2><p class="mt-0.5 font-mono text-[10px] uppercase tracking-wider text-neutron-300" x-text="voiceStatus"></p></div></div>
        <button type="button" @click="closeActivePanel()" class="rounded-lg p-2 text-white/45 transition hover:bg-white/[0.06] hover:text-white focus:outline-none focus:ring-2 focus:ring-neutron-300" aria-label="Close Voice Agent"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" d="m6 6 12 12M18 6 6 18" /></svg></button>
    </header>

    <div class="flex flex-col items-center gap-5 p-5">
        <div class="flex h-16 items-center justify-center gap-1" aria-hidden="true">
            <template x-for="height in [5, 8, 12, 16, 12, 8, 5]" :key="height"><span class="w-1 rounded-full bg-neutron-300 transition-all duration-300" :class="voiceStatus === 'Listening...' ? 'animate-pulse opacity-100' : 'opacity-30'" :style="`height: ${height * (voiceStatus === 'Listening...' ? 2 : 1)}px`"></span></template>
        </div>
        <div class="min-h-16 w-full rounded-xl border border-white/10 bg-white/[0.035] p-3 text-center text-sm leading-6 text-white/55" aria-live="polite"><p x-text="voiceTranscript || 'Press the microphone when you are ready to speak.'"></p></div>
        <p x-show="voiceError" x-text="voiceError" role="alert" class="w-full rounded-xl border border-red-300/15 bg-red-400/10 px-3 py-2.5 text-center text-xs leading-5 text-red-200"></p>
        <div class="flex items-center gap-3">
            <button x-ref="voiceButton" type="button" @click="toggleVoice()" :disabled="voiceStatus === 'Thinking...' || voiceStatus === 'Speaking...'" :aria-label="voiceStatus === 'Listening...' ? 'Stop listening' : 'Start listening'" class="flex h-14 w-14 items-center justify-center rounded-full border border-neutron-300/25 bg-neutron-500 text-white shadow-glow transition hover:bg-neutron-300 hover:text-neutron-950 focus:outline-none focus:ring-2 focus:ring-neutron-300 focus:ring-offset-2 focus:ring-offset-neutron-950 disabled:cursor-not-allowed disabled:opacity-40" :class="voiceStatus === 'Listening...' ? 'animate-pulse' : ''">
                <svg x-show="voiceStatus !== 'Listening...'" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="9" y="3" width="6" height="11" rx="3" /><path stroke-linecap="round" d="M6.5 10.5a5.5 5.5 0 0 0 11 0M12 16v4m-3 0h6" /></svg><svg x-show="voiceStatus === 'Listening...'" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><rect x="6" y="6" width="12" height="12" rx="2" /></svg>
            </button>
            <button type="button" @click="closeActivePanel()" class="flex h-12 w-12 items-center justify-center rounded-full border border-red-300/20 bg-red-400/10 text-red-200 transition hover:bg-red-400/20 focus:outline-none focus:ring-2 focus:ring-red-300" aria-label="End voice interaction"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m6 6 12 12M18 6 6 18" /></svg></button>
        </div>
    </div>
</section>
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\components\voice-agent.blade.php ENDPATH**/ ?>