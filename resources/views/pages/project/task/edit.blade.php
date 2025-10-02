@foreach($tasks as $task)
<div class="modal fade" id="editTaskModal-{{ $task->task_id }}" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('project.editTask', $task->task_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">

                    {{-- Judul Task --}}
                    <div class="mb-3">
                        <label class="form-label">Judul Task</label>
                        <input type="text" name="title" class="form-control"
                            value="{{ $task->title }}" required
                            @if (Auth::id() != $data->owner_id) disabled @endif>
                        @if (Auth::id() != $data->owner_id)
                            <input type="hidden" name="title" value="{{ $task->title }}">
                        @endif
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3"
                        @if (Auth::id() != $data->owner_id) disabled @endif>{{ $task->description }}</textarea>
                        @if (Auth::id() != $data->owner_id)
                            <input type="hidden" name="description" value="{{ $task->description }}">
                        @endif
                    </div>

                    {{-- Tanggal --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" name="start_date" class="form-control"
                                value="{{ $task->start_date }}" required
                                @if (Auth::id() != $data->owner_id) disabled @endif>
                            @if (Auth::id() != $data->owner_id)
                                <input type="hidden" name="start_date" value="{{ $task->start_date }}">
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" name="end_date" class="form-control"
                                value="{{ $task->end_date }}" required
                                @if (Auth::id() != $data->owner_id) disabled @endif>
                            @if (Auth::id() != $data->owner_id)
                                <input type="hidden" name="end_date" value="{{ $task->end_date }}">
                            @endif
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="todo" {{ $task->status == 'todo' ? 'selected' : '' }}>Todo</option>
                                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="review" {{ $task->status == 'review' ? 'selected' : '' }}>Review</option>
                                <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Done</option>
                            </select>
                        </div>

                        {{-- Prioritas --}}
                        <div class="col-md-6">
                            <label class="form-label">Prioritas</label>
                            <select name="priority" class="form-select" required
                                    @if (Auth::id() != $data->owner_id) disabled @endif>
                                <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
                                <option value="urgent" {{ $task->priority == 'urgent' ? 'selected' : '' }}>Urgent</option>
                            </select>
                            @if (Auth::id() != $data->owner_id)
                                <input type="hidden" name="priority" value="{{ $task->priority }}">
                            @endif
                        </div>
                    </div>

                    {{-- Assignee & Reporter --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Assignee</label>
                            <select name="assignee_id" class="form-select" required
                                    @if (Auth::id() != $data->owner_id) disabled @endif>
                                <option value="">Pilih Staff...</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $task->assignee_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @if (Auth::id() != $data->owner_id)
                                <input type="hidden" name="assignee_id" value="{{ $task->assignee_id }}">
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Reporter</label>
                            <select class="form-select" disabled>
                                <option value="">Pilih Staff...</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $task->reporter_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="reporter_id" value="{{ $task->reporter_id }}">
                        </div>
                    </div>

                    {{-- Progress --}}
                    <div class="mb-3">
                        <label class="form-label">Progress (%)</label>
                        <input type="number" name="percentage" class="form-control"
                               value="{{ $task->percentage }}" min="0" max="100" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endforeach
