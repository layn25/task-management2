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
                    {{-- Project --}}
                    

                    <div class="mb-3">
                        <label class="form-label">Judul Task</label>
                        <input type="text" name="title" class="form-control" value="{{ $task->title }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3">{{ $task->description }}</textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" name="start_date" class="form-control" value="{{ $task->start_date }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" name="end_date" class="form-control" value="{{ $task->end_date }}" required>
                        </div>
                    </div>

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
                        <div class="col-md-6">
                            <label class="form-label">Prioritas</label>
                            <select name="priority" class="form-select" required>
                                <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
                                <option value="urgent" {{ $task->priority == 'urgent' ? 'selected' : '' }}>Urgent</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Assignee</label>
                            <select name="assignee_id" class="form-select" required>
                                <option value="">Pilih Staff...</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $task->assignee_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Reporter</label>
                            <select name="reporter_id" class="form-select" disabled>
                                <option value="">Pilih Staff...</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $task->reporter_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Progress (%)</label>
                        <input type="number" name="percentage" class="form-control" value="{{ $task->percentage }}" min="0" max="100" required>
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

