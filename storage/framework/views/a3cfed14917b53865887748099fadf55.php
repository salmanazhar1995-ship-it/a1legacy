<section
    id="chat-agent-panel"
    x-ref="chatPanel"
    x-show="activePanel === 'chat'"
    x-cloak
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="translate-y-4 scale-95 opacity-0"
    x-transition:enter-end="translate-y-0 scale-100 opacity-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="translate-y-0 scale-100 opacity-100"
    x-transition:leave-end="translate-y-4 scale-95 opacity-0"
    @keydown.tab="trapFocus($event, $refs.chatPanel)"
    role="dialog"
    aria-modal="true"
    aria-labelledby="chat-agent-title"
    class="fixed bottom-20 right-3 z-50 flex h-[calc(100dvh-6rem)] max-h-[600px] w-[calc(100vw-1.5rem)] origin-bottom-right flex-col overflow-hidden rounded-2xl border border-white/10 bg-neutron-900 shadow-2xl shadow-black/50 sm:bottom-24 sm:right-6 sm:h-[min(600px,calc(100dvh-8rem))] sm:w-[390px]"
>
    <header class="flex items-center justify-between gap-4 border-b border-white/10 bg-white/[0.035] px-4 py-3.5">
        <div class="flex min-w-0 items-center gap-3">
            <div class="relative flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-neutron-300/20 bg-neutron-500/15 text-neutron-300">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><rect x="5" y="7" width="14" height="11" rx="3" /><path stroke-linecap="round" d="M9 11h.01M15 11h.01M9 15h6M12 7V4" /><circle cx="12" cy="3" r="1" fill="currentColor" stroke="none" /></svg>
                <span class="absolute -bottom-0.5 -right-0.5 h-3 w-3 rounded-full border-2 border-neutron-900 bg-neutron-300"></span>
            </div>
            <div class="min-w-0"><h2 id="chat-agent-title" class="truncate text-sm font-semibold text-white">Chat Agent</h2><p class="mt-0.5 font-mono text-[10px] uppercase tracking-wider text-neutron-300" x-text="chatStatus"></p></div>
        </div>
        <button type="button" @click="closeActivePanel()" class="rounded-lg p-2 text-white/45 transition hover:bg-white/[0.06] hover:text-white focus:outline-none focus:ring-2 focus:ring-neutron-300" aria-label="Close Chat Agent"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" d="m6 6 12 12M18 6 6 18" /></svg></button>
    </header>

    <div x-ref="chatHistory" role="log" aria-live="polite" aria-relevant="additions" class="flex flex-1 flex-col gap-4 overflow-y-auto px-4 py-5">
        <template x-for="message in messages" :key="message.id">
            <div class="flex flex-col gap-1" :class="message.sender === 'visitor' ? 'items-end' : 'items-start'">
                <div class="max-w-[85%] whitespace-pre-wrap break-words rounded-2xl px-3.5 py-2.5 text-sm leading-6" :class="message.sender === 'visitor' ? 'rounded-br-md bg-neutron-500 text-white' : 'rounded-bl-md border border-white/10 bg-white/[0.055] text-white/80'" x-text="message.text"></div>
                <time class="px-1 font-mono text-[9px] uppercase tracking-wider text-white/25" x-text="message.time"></time>
            </div>
        </template>
        <div x-show="isSending" class="flex flex-col items-start gap-1">
            <div class="flex items-center gap-1.5 rounded-2xl rounded-bl-md border border-white/10 bg-white/[0.055] px-4 py-3" aria-label="Agent is typing"><span class="h-1.5 w-1.5 animate-pulse rounded-full bg-neutron-300"></span><span class="h-1.5 w-1.5 animate-pulse rounded-full bg-neutron-300 delay-75"></span><span class="h-1.5 w-1.5 animate-pulse rounded-full bg-neutron-300 delay-150"></span></div>
            <span class="px-1 text-[10px] text-white/30">Agent is typing...</span>
        </div>
    </div>

    <div class="border-t border-white/10 bg-neutron-950/70 p-3">
        <p x-show="chatError" x-text="chatError" role="alert" class="mb-2 rounded-lg border border-red-300/15 bg-red-400/10 px-3 py-2 text-xs text-red-200"></p>
        <div class="flex items-end gap-2 rounded-xl border border-white/10 bg-white/[0.045] p-2 focus-within:border-neutron-500/70 focus-within:ring-1 focus-within:ring-neutron-500/40">
            <textarea x-ref="chatInput" x-model="draft" @keydown.enter="handleChatKeydown($event)" @input="resizeChatInput($event.target)" rows="1" maxlength="1000" placeholder="Type your message..." aria-label="Message for Chat Agent" class="max-h-28 min-h-[42px] flex-1 resize-none border-0 bg-transparent px-2 py-2.5 text-sm text-white placeholder:text-white/25 focus:ring-0"></textarea>
            <button type="button" @click="sendMessage()" :disabled="isSending || !draft.trim()" class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-neutron-300 text-neutron-950 transition hover:bg-white focus:outline-none focus:ring-2 focus:ring-neutron-300 focus:ring-offset-2 focus:ring-offset-neutron-950 disabled:cursor-not-allowed disabled:opacity-30" aria-label="Send message">
                <svg x-show="!isSending" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m5 12 14-7-4 14-3-5-7-2Zm7 2 3-3" /></svg>
                <svg x-show="isSending" class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle class="opacity-25" cx="12" cy="12" r="9" stroke="currentColor" stroke-width="3" /><path class="opacity-75" fill="currentColor" d="M21 12a9 9 0 0 0-9-9v3a6 6 0 0 1 6 6h3Z" /></svg>
            </button>
        </div>
        <p class="mt-2 px-1 text-[10px] text-white/25">Enter to send · Shift+Enter for a new line</p>
    </div>
</section>
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\components\chat-agent.blade.php ENDPATH**/ ?>