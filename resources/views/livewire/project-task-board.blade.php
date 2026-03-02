@use('App\Enums\TaskStatus')
@use('App\Enums\TaskPriority')

<div>
    {{-- Project Progress Header --}}
    @php
        $totalTasks = $project->tasks()->count();
        $completedTasks = $project->tasks()->where('status', 'completed')->count();
        $taskPercent = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
        $totalEst = $project->totalEstimatedHours();
        $totalActual = $project->totalActualHours();
        $startDate = $project->start_date;
        $endDate = $project->end_date;
        $daysTotal = $startDate && $endDate ? $startDate->diffInDays($endDate) : 0;
        $daysElapsed = $startDate ? $startDate->diffInDays(now()) : 0;
        $daysRemaining = $endDate ? max(0, (int) now()->diffInDays($endDate, false)) : null;
        $timePercent = $daysTotal > 0 ? min(100, round(($daysElapsed / $daysTotal) * 100)) : 0;
        $isOverdue = $daysRemaining !== null && $daysRemaining === 0 && $endDate?->isPast();
    @endphp

    <div style="margin-bottom:1.5rem; background:#fff; border:1px solid #e2e8f0; border-radius:1rem; padding:1.25rem 1.5rem; box-shadow:0 1px 3px rgba(0,0,0,0.04);">
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:1.25rem; align-items:start;">
            {{-- Timeline --}}
            <div>
                <div style="font-size:0.6875rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#94a3b8; margin-bottom:0.5rem;">Timeline</div>
                <div style="display:flex; align-items:center; gap:0.75rem; margin-bottom:0.5rem;">
                    <span style="font-size:0.8125rem; color:#1e293b; font-weight:600;">
                        {{ $startDate?->format('M j') ?? '—' }}
                    </span>
                    <div style="flex:1; height:6px; background:#f1f5f9; border-radius:3px; overflow:hidden; position:relative;">
                        <div style="height:100%; width:{{ $timePercent }}%; background:linear-gradient(90deg, #6366f1, #818cf8); border-radius:3px; transition:width 0.3s;"></div>
                    </div>
                    <span style="font-size:0.8125rem; color:#1e293b; font-weight:600;">
                        {{ $endDate?->format('M j') ?? '—' }}
                    </span>
                </div>
                @if($daysRemaining !== null)
                    <span style="font-size:0.75rem; font-weight:600; color:{{ $isOverdue ? '#ef4444' : ($daysRemaining <= 7 ? '#f59e0b' : '#10b981') }};">
                        {{ $isOverdue ? 'Overdue' : ($daysRemaining === 0 ? 'Due today' : $daysRemaining . ' day' . ($daysRemaining !== 1 ? 's' : '') . ' remaining') }}
                    </span>
                @endif
            </div>

            {{-- Task Progress --}}
            <div>
                <div style="font-size:0.6875rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#94a3b8; margin-bottom:0.5rem;">Tasks</div>
                <div style="display:flex; align-items:baseline; gap:0.375rem; margin-bottom:0.375rem;">
                    <span style="font-family:'Syne',sans-serif; font-size:1.5rem; font-weight:800; color:#1e293b;">{{ $completedTasks }}</span>
                    <span style="font-size:0.8125rem; color:#94a3b8;">/ {{ $totalTasks }} completed</span>
                </div>
                <div style="height:6px; background:#f1f5f9; border-radius:3px; overflow:hidden;">
                    <div style="height:100%; width:{{ $taskPercent }}%; background:linear-gradient(90deg, #10b981, #34d399); border-radius:3px; transition:width 0.3s;"></div>
                </div>
            </div>

            {{-- Hours --}}
            <div>
                <div style="font-size:0.6875rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#94a3b8; margin-bottom:0.5rem;">Hours</div>
                <div style="display:flex; align-items:baseline; gap:0.375rem; margin-bottom:0.375rem;">
                    <span style="font-family:'Syne',sans-serif; font-size:1.5rem; font-weight:800; color:#1e293b;">{{ number_format($totalActual, 1) }}h</span>
                    @if($totalEst > 0)
                        <span style="font-size:0.8125rem; color:#94a3b8;">/ {{ number_format($totalEst, 1) }}h est.</span>
                    @endif
                </div>
                @if($totalEst > 0)
                    @php $hoursPercent = min(100, round(($totalActual / $totalEst) * 100)); @endphp
                    <div style="height:6px; background:#f1f5f9; border-radius:3px; overflow:hidden;">
                        <div style="height:100%; width:{{ $hoursPercent }}%; background:linear-gradient(90deg, {{ $totalActual > $totalEst ? '#ef4444, #f87171' : '#6366f1, #818cf8' }}); border-radius:3px;"></div>
                    </div>
                @endif
            </div>

            {{-- Budget --}}
            @if($project->budget)
            <div>
                <div style="font-size:0.6875rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#94a3b8; margin-bottom:0.5rem;">Budget</div>
                <div style="display:flex; align-items:baseline; gap:0.25rem;">
                    <span style="font-family:'Syne',sans-serif; font-size:1.5rem; font-weight:800; color:#1e293b;">
                        {{ ($project->currency ?? \App\Enums\Currency::USD)->symbol() }}{{ number_format($project->budget, 0) }}
                    </span>
                </div>
                <span style="font-size:0.75rem; color:#94a3b8;">{{ $project->status->getLabel() }}</span>
            </div>
            @endif
        </div>
    </div>

    {{-- Kanban Board --}}
    <div style="display:flex; gap:0.75rem; overflow-x:auto; padding-bottom:1rem; min-height:400px;" x-data="taskBoard()">
        @foreach($columns as $status)
            @php
                $tasks = $tasksByStatus[$status->value] ?? collect();
                $columnColors = match($status) {
                    TaskStatus::Todo => ['bg' => '#f8fafc', 'border' => '#e2e8f0', 'dot' => '#94a3b8', 'header' => '#64748b'],
                    TaskStatus::InProgress => ['bg' => '#eff6ff', 'border' => '#bfdbfe', 'dot' => '#3b82f6', 'header' => '#1d4ed8'],
                    TaskStatus::InReview => ['bg' => '#fffbeb', 'border' => '#fde68a', 'dot' => '#f59e0b', 'header' => '#b45309'],
                    TaskStatus::Completed => ['bg' => '#f0fdf4', 'border' => '#bbf7d0', 'dot' => '#22c55e', 'header' => '#15803d'],
                    TaskStatus::Blocked => ['bg' => '#fef2f2', 'border' => '#fecaca', 'dot' => '#ef4444', 'header' => '#b91c1c'],
                };
            @endphp

            <div
                style="flex:1; min-width:240px; max-width:320px; background:{{ $columnColors['bg'] }}; border:1px solid {{ $columnColors['border'] }}; border-radius:0.875rem; display:flex; flex-direction:column; overflow:hidden;"
                x-on:dragover.prevent="dragOver($event)"
                x-on:drop="dropTask($event, '{{ $status->value }}')"
            >
                {{-- Column Header --}}
                <div style="padding:0.875rem 1rem 0.625rem; display:flex; align-items:center; justify-content:space-between;">
                    <div style="display:flex; align-items:center; gap:0.5rem;">
                        <div style="width:8px; height:8px; border-radius:50%; background:{{ $columnColors['dot'] }};"></div>
                        <span style="font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:{{ $columnColors['header'] }};">
                            {{ $status->getLabel() }}
                        </span>
                    </div>
                    <span style="font-size:0.6875rem; font-weight:700; color:{{ $columnColors['header'] }}; background:{{ $columnColors['border'] }}; border-radius:1rem; padding:0.125rem 0.5rem;">
                        {{ $tasks->count() }}
                    </span>
                </div>

                {{-- Cards Container --}}
                <div style="flex:1; padding:0 0.625rem 0.625rem; display:flex; flex-direction:column; gap:0.5rem; overflow-y:auto; max-height:60vh;">
                    @forelse($tasks as $task)
                        @php
                            $priorityColors = match($task->priority) {
                                TaskPriority::Urgent => ['bg' => '#fef2f2', 'text' => '#dc2626', 'border' => '#fecaca'],
                                TaskPriority::High => ['bg' => '#fffbeb', 'text' => '#d97706', 'border' => '#fde68a'],
                                TaskPriority::Medium => ['bg' => '#eff6ff', 'text' => '#2563eb', 'border' => '#bfdbfe'],
                                TaskPriority::Low => ['bg' => '#f8fafc', 'text' => '#64748b', 'border' => '#e2e8f0'],
                                default => ['bg' => '#f8fafc', 'text' => '#64748b', 'border' => '#e2e8f0'],
                            };
                            $hoursPercent = $task->timeSpentPercentage();
                            $overtime = $task->isOvertime();
                        @endphp

                        <div
                            draggable="true"
                            x-on:dragstart="dragStart($event, {{ $task->id }})"
                            x-on:dragend="dragEnd($event)"
                            style="background:#fff; border:1px solid #e2e8f0; border-radius:0.625rem; padding:0.75rem; cursor:grab; transition:all 0.15s ease; box-shadow:0 1px 2px rgba(0,0,0,0.04);"
                            onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.08)'; this.style.borderColor='rgba(99,102,241,0.3)'; this.style.transform='translateY(-1px)'"
                            onmouseout="this.style.boxShadow='0 1px 2px rgba(0,0,0,0.04)'; this.style.borderColor='#e2e8f0'; this.style.transform='translateY(0)'"
                        >
                            {{-- Priority + ID --}}
                            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:0.5rem;">
                                <span style="font-size:0.625rem; font-weight:700; text-transform:uppercase; letter-spacing:0.04em; color:{{ $priorityColors['text'] }}; background:{{ $priorityColors['bg'] }}; border:1px solid {{ $priorityColors['border'] }}; padding:0.125rem 0.375rem; border-radius:0.25rem;">
                                    {{ $task->priority->getLabel() }}
                                </span>
                                @if($task->due_date)
                                    <span style="font-size:0.625rem; color:{{ $task->due_date->isPast() && $task->status !== TaskStatus::Completed ? '#ef4444' : '#94a3b8' }}; font-weight:500;">
                                        {{ $task->due_date->format('M j') }}
                                    </span>
                                @endif
                            </div>

                            {{-- Title --}}
                            <div style="font-size:0.8125rem; font-weight:600; color:#1e293b; line-height:1.4; margin-bottom:0.5rem;">
                                {{ $task->title }}
                            </div>

                            {{-- Hours Bar --}}
                            @if($task->estimated_hours > 0)
                                <div style="margin-bottom:0.5rem;">
                                    <div style="display:flex; justify-content:space-between; margin-bottom:0.25rem;">
                                        <span style="font-size:0.625rem; color:#94a3b8;">{{ number_format($task->actual_hours, 1) }}h / {{ number_format($task->estimated_hours, 1) }}h</span>
                                        <span style="font-size:0.625rem; font-weight:600; color:{{ $overtime ? '#ef4444' : '#64748b' }};">{{ $hoursPercent }}%</span>
                                    </div>
                                    <div style="height:3px; background:#f1f5f9; border-radius:2px; overflow:hidden;">
                                        <div style="height:100%; width:{{ min($hoursPercent, 100) }}%; background:{{ $overtime ? '#ef4444' : '#6366f1' }}; border-radius:2px;"></div>
                                    </div>
                                </div>
                            @endif

                            {{-- Footer: Assignee + Actions --}}
                            <div style="display:flex; align-items:center; justify-content:space-between;">
                                <div x-data="{ open: false }" style="position:relative;">
                                    <button
                                        type="button"
                                        @click.stop="open = !open"
                                        style="display:flex; align-items:center; gap:0.375rem; background:none; border:1px solid transparent; border-radius:0.375rem; padding:0.125rem 0.375rem; cursor:pointer; transition:all 0.15s;"
                                        onmouseover="this.style.background='#f8fafc'; this.style.borderColor='#e2e8f0'"
                                        onmouseout="if(!this.classList.contains('active')){this.style.background='none'; this.style.borderColor='transparent'}"
                                        title="Click to assign"
                                    >
                                        @if($task->assignee)
                                            @php $initials = collect(explode(' ', $task->assignee->name))->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))->take(2)->join(''); @endphp
                                            <div style="width:1.375rem; height:1.375rem; border-radius:50%; background:linear-gradient(135deg, #4f46e5, #818cf8); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                                <span style="font-size:0.5rem; font-weight:700; color:#fff;">{{ $initials }}</span>
                                            </div>
                                            <span style="font-size:0.6875rem; color:#64748b; max-width:80px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">{{ $task->assignee->name }}</span>
                                        @else
                                            <div style="width:1.375rem; height:1.375rem; border-radius:50%; border:1px dashed #cbd5e1; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#cbd5e1"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0"/></svg>
                                            </div>
                                            <span style="font-size:0.6875rem; color:#cbd5e1; font-style:italic;">Assign</span>
                                        @endif
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#94a3b8"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                                    </button>

                                    {{-- Assignee Dropdown --}}
                                    <div
                                        x-show="open"
                                        @click.away="open = false"
                                        x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95"
                                        style="position:absolute; bottom:100%; left:0; margin-bottom:0.25rem; min-width:180px; background:#fff; border:1px solid #e2e8f0; border-radius:0.5rem; box-shadow:0 10px 25px rgba(0,0,0,0.1); z-index:50; overflow:hidden;"
                                    >
                                        <div style="padding:0.375rem 0.625rem; font-size:0.625rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#94a3b8; border-bottom:1px solid #f1f5f9;">
                                            Assign to
                                        </div>
                                        <div style="max-height:180px; overflow-y:auto;">
                                            @if($task->assigned_to)
                                                <button
                                                    type="button"
                                                    wire:click.prevent="assignTask({{ $task->id }}, null)"
                                                    @click.stop="open = false"
                                                    style="width:100%; display:flex; align-items:center; gap:0.5rem; padding:0.5rem 0.625rem; border:none; background:none; cursor:pointer; font-size:0.75rem; color:#ef4444; transition:background 0.1s;"
                                                    onmouseover="this.style.background='#fef2f2'"
                                                    onmouseout="this.style.background='none'"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                                                    Unassign
                                                </button>
                                                <div style="height:1px; background:#f1f5f9;"></div>
                                            @endif
                                            @foreach($teamMembers as $member)
                                                @php $memberInitials = collect(explode(' ', $member->name))->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))->take(2)->join(''); @endphp
                                                <button
                                                    type="button"
                                                    wire:click.prevent="assignTask({{ $task->id }}, {{ $member->id }})"
                                                    @click.stop="open = false"
                                                    style="width:100%; display:flex; align-items:center; gap:0.5rem; padding:0.5rem 0.625rem; border:none; background:{{ $task->assigned_to === $member->id ? '#eff6ff' : 'none' }}; cursor:pointer; font-size:0.75rem; color:#374151; transition:background 0.1s;"
                                                    onmouseover="this.style.background='{{ $task->assigned_to === $member->id ? '#dbeafe' : '#f8fafc' }}'"
                                                    onmouseout="this.style.background='{{ $task->assigned_to === $member->id ? '#eff6ff' : 'none' }}'"
                                                >
                                                    <div style="width:1.25rem; height:1.25rem; border-radius:50%; background:linear-gradient(135deg, #4f46e5, #818cf8); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                                        <span style="font-size:0.5rem; font-weight:700; color:#fff;">{{ $memberInitials }}</span>
                                                    </div>
                                                    <span style="flex:1; text-align:left; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">{{ $member->name }}</span>
                                                    @if($task->assigned_to === $member->id)
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="#4f46e5"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                                    @endif
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                {{-- Quick Actions --}}
                                <div style="display:flex; gap:0.25rem;">
                                    @if($task->status === TaskStatus::Todo)
                                        <button
                                            wire:click="moveTask({{ $task->id }}, 'in_progress')"
                                            title="Start"
                                            style="width:1.5rem; height:1.5rem; border-radius:0.25rem; border:1px solid #e2e8f0; background:#fff; color:#3b82f6; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:all 0.15s;"
                                            onmouseover="this.style.background='#eff6ff'; this.style.borderColor='#3b82f6'"
                                            onmouseout="this.style.background='#fff'; this.style.borderColor='#e2e8f0'"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z"/></svg>
                                        </button>
                                    @endif
                                    @if($task->status === TaskStatus::InProgress)
                                        <button
                                            wire:click="moveTask({{ $task->id }}, 'in_review')"
                                            title="Send for Review"
                                            style="width:1.5rem; height:1.5rem; border-radius:0.25rem; border:1px solid #e2e8f0; background:#fff; color:#f59e0b; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:all 0.15s;"
                                            onmouseover="this.style.background='#fffbeb'; this.style.borderColor='#f59e0b'"
                                            onmouseout="this.style.background='#fff'; this.style.borderColor='#e2e8f0'"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                                        </button>
                                    @endif
                                    @if(in_array($task->status, [TaskStatus::InProgress, TaskStatus::InReview]))
                                        <button
                                            wire:click="moveTask({{ $task->id }}, 'completed')"
                                            title="Complete"
                                            style="width:1.5rem; height:1.5rem; border-radius:0.25rem; border:1px solid #e2e8f0; background:#fff; color:#22c55e; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:all 0.15s;"
                                            onmouseover="this.style.background='#f0fdf4'; this.style.borderColor='#22c55e'"
                                            onmouseout="this.style.background='#fff'; this.style.borderColor='#e2e8f0'"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                        </button>
                                    @endif
                                </div>
                            </div>

                            {{-- Milestone tag --}}
                            @if($task->milestone)
                                <div style="margin-top:0.5rem; padding-top:0.375rem; border-top:1px solid #f1f5f9;">
                                    <span style="font-size:0.625rem; color:#6366f1; background:rgba(99,102,241,0.06); border:1px solid rgba(99,102,241,0.12); padding:0.0625rem 0.375rem; border-radius:0.25rem;">
                                        {{ $task->milestone->title }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div style="text-align:center; padding:2rem 0.5rem; color:#cbd5e1; font-size:0.75rem;">
                            No tasks
                        </div>
                    @endforelse
                </div>

                {{-- Quick Add --}}
                @if($status === TaskStatus::Todo)
                    @if($showCreateForm)
                        <div style="padding:0.625rem;">
                            <div style="background:#fff; border:1px solid #e2e8f0; border-radius:0.5rem; padding:0.625rem;">
                                <input
                                    type="text"
                                    wire:model="newTaskTitle"
                                    wire:keydown.enter="createTask"
                                    placeholder="Task title..."
                                    autofocus
                                    style="width:100%; border:1px solid #e2e8f0; border-radius:0.375rem; padding:0.375rem 0.625rem; font-size:0.8125rem; color:#1e293b; outline:none; margin-bottom:0.5rem;"
                                    onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 2px rgba(99,102,241,0.1)'"
                                    onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'"
                                >
                                <div style="display:flex; gap:0.375rem;">
                                    <button
                                        wire:click="createTask"
                                        style="flex:1; background:#6366f1; color:#fff; border:none; border-radius:0.375rem; padding:0.375rem; font-size:0.75rem; font-weight:600; cursor:pointer;"
                                    >Add Task</button>
                                    <button
                                        wire:click="$set('showCreateForm', false)"
                                        style="background:#f1f5f9; color:#64748b; border:1px solid #e2e8f0; border-radius:0.375rem; padding:0.375rem 0.75rem; font-size:0.75rem; cursor:pointer;"
                                    >Cancel</button>
                                </div>
                            </div>
                        </div>
                    @else
                        <div style="padding:0.375rem 0.625rem 0.625rem;">
                            <button
                                wire:click="$set('showCreateForm', true)"
                                style="width:100%; background:transparent; border:1px dashed {{ $columnColors['border'] }}; border-radius:0.5rem; padding:0.5rem; font-size:0.75rem; color:{{ $columnColors['header'] }}; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:0.25rem; transition:all 0.15s;"
                                onmouseover="this.style.background='rgba(255,255,255,0.5)'; this.style.borderStyle='solid'"
                                onmouseout="this.style.background='transparent'; this.style.borderStyle='dashed'"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                Add task
                            </button>
                        </div>
                    @endif
                @endif
            </div>
        @endforeach
    </div>
</div>

<script>
    function taskBoard() {
        return {
            draggedTaskId: null,
            dragStart(event, taskId) {
                this.draggedTaskId = taskId;
                event.target.style.opacity = '0.5';
                event.dataTransfer.effectAllowed = 'move';
                event.dataTransfer.setData('text/plain', taskId);
            },
            dragEnd(event) {
                event.target.style.opacity = '1';
                this.draggedTaskId = null;
            },
            dragOver(event) {
                event.preventDefault();
                event.dataTransfer.dropEffect = 'move';
            },
            dropTask(event, newStatus) {
                event.preventDefault();
                const taskId = event.dataTransfer.getData('text/plain');
                if (taskId) {
                    @this.call('moveTask', parseInt(taskId), newStatus);
                }
            }
        }
    }
</script>
