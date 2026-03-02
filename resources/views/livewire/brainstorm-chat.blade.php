<div style="display: flex; gap: 1.25rem; min-height: calc(100vh - 12rem); font-family: 'Plus Jakarta Sans', sans-serif;">
    {{-- Sidebar --}}
    <aside style="width: 18rem; flex-shrink: 0; display: flex; flex-direction: column; gap: 1rem;">
        {{-- New Session Button --}}
        <button
            wire:click="newBrainstorm"
            style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 0.5rem;
                padding: 0.625rem 1rem; border-radius: 0.75rem; border: none; cursor: pointer;
                background: linear-gradient(to right, #2563eb, #4f46e5); color: white;
                font-weight: 600; font-size: 0.875rem;
                box-shadow: 0 10px 15px -3px rgba(37,99,235,0.25);"
            onmouseover="this.style.background='linear-gradient(to right, #3b82f6, #6366f1)'"
            onmouseout="this.style.background='linear-gradient(to right, #2563eb, #4f46e5)'"
        >
            <x-filament::icon icon="heroicon-o-plus" style="width: 1rem; height: 1rem;" />
            New Session
        </button>

        {{-- Saved Sessions --}}
        <div style="flex: 1; border-radius: 0.75rem; background: white; box-shadow: 0 1px 2px rgba(0,0,0,0.05); border: 1px solid #e5e7eb; overflow: hidden;">
            <div style="padding: 0.75rem 1rem; border-bottom: 1px solid #f3f4f6;">
                <h3 style="font-size: 0.6875rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">History</h3>
            </div>
            <div style="overflow-y: auto; max-height: calc(100vh - 22rem);">
                @forelse($savedBrainstorms as $saved)
                    <button
                        wire:click="loadBrainstorm({{ $saved->id }})"
                        style="width: 100%; text-align: left; padding: 0.75rem 1rem; border: none; cursor: pointer;
                            display: block;
                            background: {{ $brainstorm?->id === $saved->id ? '#eff6ff' : 'transparent' }};
                            border-left: 3px solid {{ $brainstorm?->id === $saved->id ? '#3b82f6' : 'transparent' }};"
                        onmouseover="if(!{{ $brainstorm?->id === $saved->id ? 'true' : 'false' }})this.style.background='#f9fafb'"
                        onmouseout="if(!{{ $brainstorm?->id === $saved->id ? 'true' : 'false' }})this.style.background='transparent'"
                    >
                        <div style="display: flex; align-items: start; gap: 0.5rem;">
                            <x-filament::icon icon="heroicon-o-light-bulb" style="width: 0.875rem; height: 0.875rem; margin-top: 0.125rem; flex-shrink: 0; color: {{ $brainstorm?->id === $saved->id ? '#3b82f6' : '#d1d5db' }};" />
                            <div style="min-width: 0; flex: 1;">
                                <div style="font-weight: 500; font-size: 0.8125rem; color: #111827; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $saved->title }}</div>
                                <div style="display: flex; align-items: center; gap: 0.375rem; margin-top: 0.25rem;">
                                    <span style="display: inline-block; width: 0.375rem; height: 0.375rem; border-radius: 50%;
                                        background: {{ match($saved->status->value) {
                                            'brainstorming' => '#fbbf24',
                                            'spec_generated' => '#60a5fa',
                                            'completed' => '#34d399',
                                            default => '#d1d5db',
                                        } }};"></span>
                                    <span style="font-size: 0.6875rem; color: #9ca3af;">{{ $saved->status->getLabel() }}</span>
                                    <span style="font-size: 0.6875rem; color: #d1d5db;">&middot;</span>
                                    <span style="font-size: 0.6875rem; color: #9ca3af;">{{ $saved->created_at->diffForHumans(short: true) }}</span>
                                </div>
                            </div>
                        </div>
                    </button>
                @empty
                    <div style="padding: 2rem 1rem; text-align: center;">
                        <x-filament::icon icon="heroicon-o-light-bulb" style="width: 2rem; height: 2rem; margin: 0 auto 0.5rem; color: #e5e7eb;" />
                        <p style="font-size: 0.75rem; color: #9ca3af; margin: 0;">No sessions yet</p>
                        <p style="font-size: 0.6875rem; color: #d1d5db; margin-top: 0.125rem;">Start your first brainstorm</p>
                    </div>
                @endforelse
            </div>
        </div>
    </aside>

    {{-- Main Content --}}
    <main style="flex: 1; min-width: 0; display: flex; flex-direction: column;">
        @if(!$brainstorm)
            {{-- ===== NEW BRAINSTORM FORM ===== --}}
            <div style="flex: 1; display: flex; align-items: start; justify-content: center; padding-top: 1rem;">
                <div style="width: 100%; max-width: 40rem;">
                    {{-- Hero --}}
                    <div style="text-align: center; margin-bottom: 2rem;">
                        <div style="display: inline-flex; align-items: center; justify-content: center; width: 3.5rem; height: 3.5rem;
                            border-radius: 1rem; background: linear-gradient(135deg, #3b82f6, #4f46e5);
                            box-shadow: 0 10px 15px -3px rgba(59,130,246,0.2); margin-bottom: 1rem;">
                            <x-filament::icon icon="heroicon-o-light-bulb" style="width: 1.75rem; height: 1.75rem; color: white;" />
                        </div>
                        <h1 style="font-size: 1.5rem; font-weight: 700; color: #111827; letter-spacing: -0.025em; margin: 0;">AI Brainstorm</h1>
                        <p style="font-size: 0.875rem; color: #6b7280; margin-top: 0.25rem; max-width: 28rem; margin-left: auto; margin-right: auto;">
                            Describe your idea and let AI research the market, suggest tech stacks based on your budget, and generate a full system spec.
                        </p>
                    </div>

                    {{-- Form Card --}}
                    <div style="border-radius: 1rem; background: white; box-shadow: 0 1px 2px rgba(0,0,0,0.05); border: 1px solid #e5e7eb; overflow: hidden;">
                        <div style="padding: 1.5rem; display: flex; flex-direction: column; gap: 1.25rem;">
                            {{-- Title --}}
                            <div>
                                <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.375rem;">Session Title</label>
                                <input type="text" wire:model="title" placeholder="e.g., SaaS for Beauty Salon Scheduling"
                                    style="width: 100%; border-radius: 0.75rem; border: 1px solid #e5e7eb; background: #f9fafb;
                                        padding: 0.625rem 1rem; font-size: 0.875rem; color: #111827;
                                        outline: none; transition: all 0.15s; font-family: inherit;"
                                    onfocus="this.style.borderColor='#93c5fd'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'; this.style.background='white';"
                                    onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'; this.style.background='#f9fafb';">
                                @error('title') <span style="font-size: 0.75rem; color: #ef4444; margin-top: 0.25rem;">{{ $message }}</span> @enderror
                            </div>

                            {{-- Topic --}}
                            <div>
                                <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.375rem;">Describe Your Idea</label>
                                <textarea wire:model="topic" rows="4" placeholder="What problem does it solve? Who is it for? What's the vision?"
                                    style="width: 100%; border-radius: 0.75rem; border: 1px solid #e5e7eb; background: #f9fafb;
                                        padding: 0.625rem 1rem; font-size: 0.875rem; color: #111827;
                                        outline: none; transition: all 0.15s; resize: none; font-family: inherit;"
                                    onfocus="this.style.borderColor='#93c5fd'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'; this.style.background='white';"
                                    onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'; this.style.background='#f9fafb';"></textarea>
                                @error('topic') <span style="font-size: 0.75rem; color: #ef4444; margin-top: 0.25rem;">{{ $message }}</span> @enderror
                            </div>

                            {{-- Project Link --}}
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                <div>
                                    <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.375rem;">Link to Project</label>
                                    <select wire:model.live="projectId"
                                        style="width: 100%; border-radius: 0.75rem; border: 1px solid #e5e7eb; background: #f9fafb;
                                            padding: 0.625rem 1rem; font-size: 0.875rem; color: #111827;
                                            outline: none; transition: all 0.15s; font-family: inherit;">
                                        <option value="">None (standalone)</option>
                                        @foreach($projects as $project)
                                            <option value="{{ $project->id }}">
                                                {{ $project->title }}
                                                @if($project->project_type) — {{ $project->project_type->getLabel() }} @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                @if($projectId)
                                    <div style="display: flex; align-items: end;">
                                        <label style="display: flex; align-items: center; gap: 0.625rem; cursor: pointer;">
                                            <input type="checkbox" wire:model="useProjectDocs"
                                                style="width: 1rem; height: 1rem; border-radius: 0.25rem; border: 1px solid #d1d5db; accent-color: #2563eb;">
                                            <span style="font-size: 0.875rem; color: #6b7280;">Include project docs & budget</span>
                                        </label>
                                    </div>
                                @endif
                            </div>

                            {{-- File Upload --}}
                            <div>
                                <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.375rem;">Reference Documents</label>
                                <div style="position: relative; border-radius: 0.75rem; border: 2px dashed #e5e7eb; padding: 1rem; transition: border-color 0.15s; text-align: center;"
                                    onmouseover="this.style.borderColor='#93c5fd'" onmouseout="this.style.borderColor='#e5e7eb'">
                                    <input type="file" wire:model="uploads" multiple
                                        accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.xls,.xlsx,.csv,.doc,.docx,.txt,.md"
                                        style="position: absolute; inset: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; z-index: 10;">
                                    <div style="pointer-events: none;">
                                        <x-filament::icon icon="heroicon-o-arrow-up-tray" style="width: 2rem; height: 2rem; margin: 0 auto 0.5rem; color: #d1d5db;" />
                                        <p style="font-size: 0.75rem; color: #6b7280; margin: 0;">Drop PDFs, images, spreadsheets, or docs here</p>
                                        <p style="font-size: 0.6875rem; color: #9ca3af; margin-top: 0.125rem;">Max 10MB per file</p>
                                    </div>
                                </div>

                                @if($uploads)
                                    <div style="margin-top: 0.625rem; display: flex; flex-direction: column; gap: 0.375rem;">
                                        @foreach($uploads as $index => $file)
                                            <div style="display: flex; align-items: center; gap: 0.5rem; padding: 0.375rem 0.75rem; border-radius: 0.5rem; background: #eff6ff;">
                                                <x-filament::icon icon="heroicon-o-document" style="width: 0.875rem; height: 0.875rem; color: #3b82f6; flex-shrink: 0;" />
                                                <span style="font-size: 0.75rem; color: #1d4ed8; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; flex: 1;">{{ $file->getClientOriginalName() }}</span>
                                                <span style="font-size: 0.6875rem; color: #60a5fa; flex-shrink: 0;">{{ round($file->getSize() / 1024) }}KB</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div style="padding: 1rem 1.5rem; background: #f9fafb; border-top: 1px solid #f3f4f6;">
                            <button wire:click="startBrainstorm" wire:loading.attr="disabled"
                                style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 0.5rem;
                                    padding: 0.625rem 1.25rem; border-radius: 0.75rem; border: none; cursor: pointer;
                                    background: linear-gradient(to right, #2563eb, #4f46e5); color: white;
                                    font-weight: 600; font-size: 0.875rem; font-family: inherit;
                                    box-shadow: 0 10px 15px -3px rgba(37,99,235,0.25); transition: all 0.2s;"
                                onmouseover="this.style.background='linear-gradient(to right, #3b82f6, #6366f1)'; this.style.boxShadow='0 10px 15px -3px rgba(37,99,235,0.4)'"
                                onmouseout="this.style.background='linear-gradient(to right, #2563eb, #4f46e5)'; this.style.boxShadow='0 10px 15px -3px rgba(37,99,235,0.25)'"
                                {{ $isLoading ? 'disabled' : '' }}>
                                <span wire:loading.remove wire:target="startBrainstorm">
                                    <x-filament::icon icon="heroicon-o-sparkles" style="width: 1rem; height: 1rem; display: inline; vertical-align: middle;" />
                                    Start Brainstorm
                                </span>
                                <span wire:loading wire:target="startBrainstorm">AI is researching...</span>
                            </button>
                        </div>
                    </div>

                    {{-- Feature Pills --}}
                    <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: center; gap: 0.5rem; margin-top: 1.5rem;">
                        @foreach(['Market Research', 'Competitor Analysis', 'Tech Stack by Budget', 'AI Integration Points', 'System Spec', 'Task Breakdown'] as $feature)
                            <span style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.25rem 0.625rem;
                                border-radius: 9999px; background: #f3f4f6; font-size: 0.6875rem; font-weight: 500; color: #6b7280;">
                                <x-filament::icon icon="heroicon-s-check" style="width: 0.75rem; height: 0.75rem; color: #60a5fa;" />
                                {{ $feature }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>

        @else
            {{-- ===== ACTIVE SESSION ===== --}}
            <div style="display: flex; flex-direction: column; flex: 1; gap: 1rem;">
                {{-- Session Header --}}
                <div style="border-radius: 1rem; background: white; box-shadow: 0 1px 2px rgba(0,0,0,0.05); border: 1px solid #e5e7eb; padding: 1rem;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="width: 2.5rem; height: 2.5rem; border-radius: 0.75rem; background: linear-gradient(135deg, #3b82f6, #4f46e5);
                            display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <x-filament::icon icon="heroicon-o-light-bulb" style="width: 1.25rem; height: 1.25rem; color: white;" />
                        </div>
                        <div style="flex: 1; min-width: 0;">
                            <h2 style="font-size: 1rem; font-weight: 700; color: #111827; margin: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $brainstorm->title }}</h2>
                            <p style="font-size: 0.75rem; color: #6b7280; margin: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ Str::limit($brainstorm->topic, 80) }}</p>
                        </div>
                        <span style="display: inline-flex; align-items: center; gap: 0.375rem; padding: 0.25rem 0.625rem;
                            border-radius: 9999px; font-size: 0.75rem; font-weight: 600; flex-shrink: 0;
                            background: {{ match($brainstorm->status->value) {
                                'brainstorming' => '#fef3c7',
                                'spec_generated' => '#dbeafe',
                                'completed' => '#d1fae5',
                                default => '#f3f4f6',
                            } }};
                            color: {{ match($brainstorm->status->value) {
                                'brainstorming' => '#b45309',
                                'spec_generated' => '#1d4ed8',
                                'completed' => '#047857',
                                default => '#374151',
                            } }};">
                            <span style="width: 0.375rem; height: 0.375rem; border-radius: 50%; display: inline-block;
                                background: {{ match($brainstorm->status->value) {
                                    'brainstorming' => '#f59e0b',
                                    'spec_generated' => '#3b82f6',
                                    'completed' => '#10b981',
                                    default => '#9ca3af',
                                } }};"></span>
                            {{ $brainstorm->status->getLabel() }}
                        </span>
                    </div>

                    {{-- Attached Documents --}}
                    @if($brainstorm->getMedia('documents')->count() > 0)
                        <div style="margin-top: 0.75rem; padding-top: 0.75rem; border-top: 1px solid #f3f4f6; display: flex; flex-wrap: wrap; gap: 0.375rem;">
                            @foreach($brainstorm->getMedia('documents') as $media)
                                <span style="display: inline-flex; align-items: center; gap: 0.25rem; border-radius: 0.5rem;
                                    background: #f3f4f6; padding: 0.25rem 0.5rem; font-size: 0.6875rem; color: #6b7280;">
                                    <x-filament::icon icon="heroicon-o-paper-clip" style="width: 0.75rem; height: 0.75rem;" />
                                    {{ $media->name }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Tab Navigation --}}
                <div style="display: flex; align-items: center; gap: 0.25rem; padding: 0 0.25rem;">
                    <button wire:click="setActiveTab('chat')"
                        style="display: flex; align-items: center; gap: 0.375rem; padding: 0.375rem 0.875rem;
                            border-radius: 0.5rem; font-size: 0.75rem; font-weight: 600; border: none; cursor: pointer;
                            background: {{ $activeTab === 'chat' ? '#dbeafe' : 'transparent' }};
                            color: {{ $activeTab === 'chat' ? '#1d4ed8' : '#6b7280' }};"
                        onmouseover="@if($activeTab !== 'chat')this.style.background='#f3f4f6'@endif"
                        onmouseout="@if($activeTab !== 'chat')this.style.background='transparent'@endif">
                        <x-filament::icon icon="heroicon-o-chat-bubble-left-right" style="width: 0.875rem; height: 0.875rem;" />
                        Chat
                    </button>
                    @if($brainstorm->spec_content)
                        <button wire:click="setActiveTab('spec')"
                            style="display: flex; align-items: center; gap: 0.375rem; padding: 0.375rem 0.875rem;
                                border-radius: 0.5rem; font-size: 0.75rem; font-weight: 600; border: none; cursor: pointer;
                                background: {{ $activeTab === 'spec' ? '#dbeafe' : 'transparent' }};
                                color: {{ $activeTab === 'spec' ? '#1d4ed8' : '#6b7280' }};"
                            onmouseover="@if($activeTab !== 'spec')this.style.background='#f3f4f6'@endif"
                            onmouseout="@if($activeTab !== 'spec')this.style.background='transparent'@endif">
                            <x-filament::icon icon="heroicon-o-document-text" style="width: 0.875rem; height: 0.875rem;" />
                            System Spec
                        </button>
                    @endif
                </div>

                {{-- Chat Tab --}}
                <div style="{{ $activeTab === 'chat' ? '' : 'display: none;' }} display: flex; flex-direction: column; flex: 1; gap: 1rem;">
                    {{-- Messages --}}
                    <div style="flex: 1; border-radius: 1rem; background: white; box-shadow: 0 1px 2px rgba(0,0,0,0.05); border: 1px solid #e5e7eb; overflow: hidden; display: flex; flex-direction: column;">
                        <div style="flex: 1; overflow-y: auto; padding: 1.25rem; max-height: 50vh;" id="chat-messages">
                            @foreach($brainstorm->messages ?? [] as $index => $message)
                                @if($message['role'] === 'user')
                                    <div style="display: flex; justify-content: flex-end; margin-bottom: 1rem;">
                                        <div style="max-width: 75%; border-radius: 1rem 1rem 0.25rem 1rem; padding: 0.625rem 1rem;
                                            background: linear-gradient(to right, #2563eb, #4f46e5); color: white; box-shadow: 0 1px 2px rgba(0,0,0,0.1);">
                                            <p style="font-size: 0.875rem; line-height: 1.5; margin: 0;">{{ $message['content'] }}</p>
                                        </div>
                                    </div>
                                @else
                                    <div style="display: flex; gap: 0.75rem; margin-bottom: 1rem;">
                                        <div style="width: 1.75rem; height: 1.75rem; border-radius: 0.5rem;
                                            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
                                            display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 0.125rem;">
                                            <x-filament::icon icon="heroicon-o-sparkles" style="width: 0.875rem; height: 0.875rem; color: white;" />
                                        </div>
                                        <div style="flex: 1; min-width: 0;">
                                            <div style="border-radius: 1rem 1rem 1rem 0.25rem; padding: 0.75rem 1rem;
                                                background: #f9fafb; border: 1px solid #f3f4f6;">
                                                <div class="prose prose-sm max-w-none" style="font-size: 0.875rem; line-height: 1.6; color: #374151;">
                                                    {!! Str::markdown($message['content']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                            @if($isLoading)
                                <div style="display: flex; gap: 0.75rem; margin-bottom: 1rem;">
                                    <div style="width: 1.75rem; height: 1.75rem; border-radius: 0.5rem;
                                        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
                                        display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <x-filament::icon icon="heroicon-o-sparkles" style="width: 0.875rem; height: 0.875rem; color: white;" />
                                    </div>
                                    <div style="border-radius: 1rem 1rem 1rem 0.25rem; padding: 0.75rem 1rem;
                                        background: #f9fafb; border: 1px solid #f3f4f6;">
                                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                                            <span style="display: flex; gap: 0.25rem;">
                                                <span style="width: 0.375rem; height: 0.375rem; border-radius: 50%; background: #9ca3af; animation: bounce 1s infinite;"></span>
                                                <span style="width: 0.375rem; height: 0.375rem; border-radius: 50%; background: #9ca3af; animation: bounce 1s infinite 0.15s;"></span>
                                                <span style="width: 0.375rem; height: 0.375rem; border-radius: 50%; background: #9ca3af; animation: bounce 1s infinite 0.3s;"></span>
                                            </span>
                                            <span style="font-size: 0.75rem; color: #9ca3af;">Thinking...</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- Chat Input --}}
                        <div style="border-top: 1px solid #f3f4f6; padding: 0.75rem;">
                            <div style="display: flex; gap: 0.5rem;">
                                <input type="text" wire:model="userMessage"
                                    wire:keydown.enter="sendMessage"
                                    placeholder="Ask a follow-up or refine the brainstorm..."
                                    style="flex: 1; border-radius: 0.75rem; border: 1px solid #e5e7eb; background: #f9fafb;
                                        padding: 0.5rem 1rem; font-size: 0.875rem; color: #111827;
                                        outline: none; transition: all 0.15s; font-family: inherit;"
                                    onfocus="this.style.borderColor='#93c5fd'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'; this.style.background='white';"
                                    onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'; this.style.background='#f9fafb';"
                                    {{ $isLoading ? 'disabled' : '' }}>
                                <button wire:click="sendMessage" wire:loading.attr="disabled"
                                    style="display: flex; align-items: center; justify-content: center; width: 2.5rem; height: 2.5rem;
                                        border-radius: 0.75rem; border: none; cursor: pointer;
                                        background: #2563eb; color: white; transition: all 0.15s;"
                                    onmouseover="this.style.background='#3b82f6'"
                                    onmouseout="this.style.background='#2563eb'"
                                    {{ $isLoading ? 'disabled' : '' }}>
                                    <x-filament::icon icon="heroicon-o-paper-airplane" style="width: 1rem; height: 1rem;" />
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 0.5rem;">
                        @if(!$brainstorm->spec_content)
                            <button wire:click="generateSpec" wire:loading.attr="disabled"
                                style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem;
                                    border-radius: 0.75rem; border: none; cursor: pointer; font-size: 0.875rem; font-weight: 600;
                                    font-family: inherit;
                                    background: linear-gradient(to right, #10b981, #0d9488); color: white;
                                    box-shadow: 0 10px 15px -3px rgba(16,185,129,0.25); transition: all 0.2s;"
                                {{ $isLoading ? 'disabled' : '' }}>
                                <span wire:loading.remove wire:target="generateSpec">
                                    <x-filament::icon icon="heroicon-o-document-text" style="width: 1rem; height: 1rem; display: inline; vertical-align: middle;" />
                                    Generate System Spec
                                </span>
                                <span wire:loading wire:target="generateSpec">Generating spec...</span>
                            </button>
                        @endif

                        @if($brainstorm->spec_content)
                            <button wire:click="downloadPdf"
                                style="display: flex; align-items: center; gap: 0.375rem; padding: 0.5rem 0.875rem;
                                    border-radius: 0.75rem; border: none; cursor: pointer; font-size: 0.75rem; font-weight: 600;
                                    font-family: inherit; background: #fef2f2; color: #dc2626; transition: all 0.15s;">
                                <x-filament::icon icon="heroicon-o-arrow-down-tray" style="width: 0.875rem; height: 0.875rem;" />
                                PDF
                            </button>
                            <button wire:click="downloadMarkdown"
                                style="display: flex; align-items: center; gap: 0.375rem; padding: 0.5rem 0.875rem;
                                    border-radius: 0.75rem; border: none; cursor: pointer; font-size: 0.75rem; font-weight: 600;
                                    font-family: inherit; background: #f3f4f6; color: #4b5563; transition: all 0.15s;">
                                <x-filament::icon icon="heroicon-o-arrow-down-tray" style="width: 0.875rem; height: 0.875rem;" />
                                Markdown
                            </button>
                            @if($brainstorm->project_id && $brainstorm->status !== \App\Enums\BrainstormStatus::Completed)
                                <button wire:click="generateTasks" wire:loading.attr="disabled"
                                    style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem;
                                        border-radius: 0.75rem; border: none; cursor: pointer; font-size: 0.875rem; font-weight: 600;
                                        font-family: inherit;
                                        background: linear-gradient(to right, #8b5cf6, #7c3aed); color: white;
                                        box-shadow: 0 10px 15px -3px rgba(139,92,246,0.25); transition: all 0.2s;"
                                    {{ $isLoading ? 'disabled' : '' }}>
                                    <span wire:loading.remove wire:target="generateTasks">
                                        <x-filament::icon icon="heroicon-o-queue-list" style="width: 1rem; height: 1rem; display: inline; vertical-align: middle;" />
                                        Break Into Tasks
                                    </span>
                                    <span wire:loading wire:target="generateTasks">Creating tasks...</span>
                                </button>
                            @endif
                        @endif
                    </div>
                </div>

                {{-- Spec Tab --}}
                @if($brainstorm->spec_content)
                    <div style="{{ $activeTab === 'spec' ? '' : 'display: none;' }} flex: 1;">
                        <div style="border-radius: 1rem; background: white; box-shadow: 0 1px 2px rgba(0,0,0,0.05); border: 1px solid #e5e7eb; overflow: hidden;">
                            <div style="padding: 1rem 1.5rem; border-bottom: 1px solid #f3f4f6; display: flex; align-items: center; justify-content: space-between;">
                                <h3 style="font-size: 0.875rem; font-weight: 700; color: #111827; margin: 0; display: flex; align-items: center; gap: 0.5rem;">
                                    <x-filament::icon icon="heroicon-o-document-text" style="width: 1rem; height: 1rem; color: #3b82f6;" />
                                    Generated System Specification
                                </h3>
                                <div style="display: flex; align-items: center; gap: 0.5rem;">
                                    <button wire:click="downloadPdf"
                                        style="display: flex; align-items: center; gap: 0.25rem; padding: 0.375rem 0.75rem;
                                            border-radius: 0.5rem; border: none; cursor: pointer; font-size: 0.75rem; font-weight: 500;
                                            font-family: inherit; background: #fef2f2; color: #dc2626;">
                                        <x-filament::icon icon="heroicon-o-arrow-down-tray" style="width: 0.75rem; height: 0.75rem;" />
                                        PDF
                                    </button>
                                    <button wire:click="downloadMarkdown"
                                        style="display: flex; align-items: center; gap: 0.25rem; padding: 0.375rem 0.75rem;
                                            border-radius: 0.5rem; border: none; cursor: pointer; font-size: 0.75rem; font-weight: 500;
                                            font-family: inherit; background: #f3f4f6; color: #4b5563;">
                                        <x-filament::icon icon="heroicon-o-arrow-down-tray" style="width: 0.75rem; height: 0.75rem;" />
                                        .md
                                    </button>
                                </div>
                            </div>
                            <div style="padding: 1.5rem; max-height: 60vh; overflow-y: auto;">
                                <div class="prose prose-sm max-w-none" style="font-size: 0.875rem; line-height: 1.6; color: #374151;">
                                    {!! Str::markdown($brainstorm->spec_content) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </main>
</div>

<style>
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-4px); }
    }
</style>
