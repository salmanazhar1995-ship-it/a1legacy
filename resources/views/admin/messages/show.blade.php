<x-app-layout>
    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <a href="{{ route('admin.messages.index') }}" class="text-sm text-white/35 transition hover:text-white">← Consultation inbox</a>

        @if(session('success'))
            <div class="mt-6 rounded-xl border border-emerald-300/20 bg-emerald-300/10 p-4 text-sm text-emerald-100">{{ session('success') }}</div>
        @endif

        <div class="mt-6 grid gap-5 lg:grid-cols-[minmax(0,1fr)_280px]">
            <article class="space-y-5">
                <section class="neutron-panel rounded-2xl p-6 sm:p-8">
                    <div class="flex flex-col justify-between gap-4 border-b border-white/10 pb-6 sm:flex-row sm:items-start">
                        <div>
                            <p class="neutron-kicker">AI & Automation Consultation</p>
                            <h1 class="mt-2 text-2xl font-medium text-white">{{ $message->name }}</h1>
                            <div class="mt-2 flex flex-wrap gap-x-4 gap-y-1 text-sm text-white/45">
                                <a class="hover:text-white" href="mailto:{{ $message->email }}">{{ $message->email }}</a>
                                @if($message->phone)<a class="hover:text-white" href="tel:{{ $message->phone }}">{{ $message->phone }}</a>@endif
                            </div>
                        </div>
                        <p class="font-mono text-[10px] uppercase tracking-wider text-white/30">{{ $message->created_at->format('M j, Y · H:i') }}</p>
                    </div>

                    <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                        @foreach([
                            ['Company', $message->company],
                            ['Website', $message->website_url],
                            ['Role', $message->displayRole()],
                            ['Decision maker', $message->decision_maker],
                            ['Country', $message->displayCountry()],
                            ['Industry', $message->displayIndustry()],
                        ] as [$label, $value])
                            @if($value)
                                <div class="rounded-xl border border-white/10 bg-white/[0.025] p-4">
                                    <p class="font-mono text-[9px] uppercase tracking-[.16em] text-neutron-300/70">{{ $label }}</p>
                                    @if($label === 'Website')
                                        <a href="{{ $value }}" target="_blank" rel="noopener" class="mt-2 block break-all text-sm text-white/65 transition hover:text-neutron-200">{{ $value }}</a>
                                    @else
                                        <p class="mt-2 text-sm text-white/65">{{ $value }}</p>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>
                </section>

                <section class="neutron-panel rounded-2xl p-6 sm:p-8">
                    <div class="mb-5">
                        <p class="neutron-kicker">Business profile</p>
                        <h2 class="mt-2 text-xl font-medium text-white">Current setup</h2>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                        @foreach([
                            ['Company size', $message->company_size],
                            ['Annual turnover', $message->annual_turnover],
                            ['Monthly leads', $message->monthly_leads],
                            ['Current CRM / platform', $message->displayCrm()],
                        ] as [$label, $value])
                            <div class="rounded-xl border border-white/10 bg-white/[0.025] p-4">
                                <p class="font-mono text-[9px] uppercase tracking-[.16em] text-white/30">{{ $label }}</p>
                                <p class="mt-2 text-sm text-white/65">{{ $value ?: 'Not provided' }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>

                <section class="neutron-panel rounded-2xl p-6 sm:p-8">
                    <p class="neutron-kicker">Requirements</p>
                    <div class="mt-5 grid gap-4 md:grid-cols-2">
                        <div class="rounded-xl border border-neutron-300/10 bg-neutron-500/[0.04] p-5">
                            <p class="font-mono text-[9px] uppercase tracking-[.16em] text-neutron-200">What they need help with</p>
                            <p class="mt-3 text-sm leading-6 text-white/70">{{ $message->displayServiceInterest() ?: 'Not provided' }}</p>
                        </div>
                        <div class="rounded-xl border border-neutron-300/10 bg-neutron-500/[0.04] p-5">
                            <p class="font-mono text-[9px] uppercase tracking-[.16em] text-neutron-200">Main business challenge</p>
                            <p class="mt-3 text-sm leading-6 text-white/70">{{ $message->displayBusinessChallenge() ?: 'Not provided' }}</p>
                        </div>
                    </div>

                    @if($message->message)
                        <div class="mt-4 rounded-xl border border-white/10 bg-white/[0.025] p-5">
                            <p class="font-mono text-[9px] uppercase tracking-[.16em] text-white/30">What they want to automate</p>
                            <div class="mt-3 whitespace-pre-line text-sm leading-7 text-white/65">{{ $message->message }}</div>
                        </div>
                    @endif
                </section>

                <section class="neutron-panel rounded-2xl p-6 sm:p-8">
                    <p class="neutron-kicker">Contact preferences</p>
                    <div class="mt-5 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                        @foreach([
                            ['Method', $message->preferred_contact_method],
                            ['Time zone', $message->displayTimeZone()],
                            ['Project timeline', $message->project_timeline],
                            ['Consent', $message->contact_consent ? 'Yes' : 'No'],
                        ] as [$label, $value])
                            <div class="rounded-xl border border-white/10 bg-white/[0.025] p-4">
                                <p class="font-mono text-[9px] uppercase tracking-[.16em] text-white/30">{{ $label }}</p>
                                <p class="mt-2 text-sm text-white/65">{{ $value ?: 'Not provided' }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>
            </article>

            <aside class="flex flex-col gap-4">
                <form method="POST" action="{{ route('admin.messages.update',$message) }}" class="neutron-panel rounded-2xl p-5">
                    @csrf @method('PUT')
                    <x-input-label for="status" value="Request status"/>
                    <select id="status" name="status" class="mt-2 block w-full rounded-lg border-white/10 bg-neutron-900 text-white">
                        @foreach(['new','in_progress','resolved','spam'] as $option)
                            <option value="{{ $option }}" @selected($message->status===$option)>{{ str($option)->replace('_',' ')->title() }}</option>
                        @endforeach
                    </select>
                    <x-primary-button class="mt-4">Update status</x-primary-button>
                </form>

                <div class="neutron-panel rounded-2xl p-5 text-sm leading-6 text-white/45">
                    <p class="font-medium text-white/70">Quick contact</p>
                    <div class="mt-3 flex flex-col gap-2">
                        <a href="mailto:{{ $message->email }}" class="transition hover:text-white">Email client →</a>
                        @if($message->phone)<a href="tel:{{ $message->phone }}" class="transition hover:text-white">Call client →</a>@endif
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.messages.destroy',$message) }}" onsubmit="return confirm('Delete this consultation request permanently?')">
                    @csrf @method('DELETE')
                    <x-danger-button class="w-full justify-center">Delete request</x-danger-button>
                </form>
            </aside>
        </div>
    </main>
</x-app-layout>
