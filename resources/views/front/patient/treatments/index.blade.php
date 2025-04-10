<x-front-layouts>
    <div class="container mt-4">
        <h2 class="mb-4 text-primary text-center">Treatment List for {{ $patient->user->name }}</h2>

        @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (Auth::user()->type == 'doctor')
            <div class="text-end mb-3">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTreatmentModal">
                    Add New Treatment
                </button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-bordered table-striped text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Due Date</th>
                            <th>Due Time</th>
                            @if(Auth::user()->type == 'doctor')
                            <th>Result</th>
                            <th>File</th>
                            @endif
                            <th>Status</th>
                            <th>Actions</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($treatments as $treatment)
                            <tr>
                                <td>{{ $treatment->name }}</td>

                                <td>{{ $treatment->description }}</td>

                                <td>{{ \Carbon\Carbon::parse($treatment->due_date)->format('d M, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($treatment->due_time)->format('h:i A') }}</td>

                                @if(Auth::user()->type == 'doctor')
                                <td>{{ $treatment->result ?? 'No result provided' }}</td>
                
                                <td>
                                    @if($treatment->file_path)
                                        <a href="{{ asset($treatment->file_path) }}" class="btn btn-info btn-sm" target="">View File</a>
                                    @else
                                        <span class="text-muted">No File</span>
                                    @endif
                                </td>
                                @endif

                                <td>
                                    <span class="badge bg-{{ $treatment->status == 'completed' ? 'success' : 'warning' }}">
                                        {{ ucfirst($treatment->status) }}
                                    </span>
                                </td>
                                <td>
                                    @if (Auth::user()->type == 'doctor')
                                        <form action="{{ route('treatments.destroy', $treatment) }}" method="POST"
                                              style="display:inline;"
                                              onsubmit="return confirm('Are you sure you want to delete the treatment: {{ $treatment->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    @endif

                                    @if (Auth::user()->type == 'nurse' && $treatment->status !== 'completed')
                                        <form action="{{ route('treatments.update', $treatment->id) }}" method="POST" enctype="multipart/form-data"
                                              style="display:inline;">
                                            @csrf
                                            @method('PUT')

                                            <input type="hidden" name="status" value="completed">

                                            <div class="mb-2">
                                                <label for="result_{{ $treatment->id }}" class="form-label">Result</label>
                                                <textarea name="result" id="result_{{ $treatment->id }}" class="form-control" rows="2" required></textarea>
                                            </div>

                                            <div class="mb-2">
                                                <label for="file_{{ $treatment->id }}" class="form-label">Upload File (Optional)</label>
                                                <input type="file" name="file" id="file_{{ $treatment->id }}" class="form-control">
                                            </div>

                                            <button type="submit" class="btn btn-success btn-sm mt-2">
                                                Mark as Completed
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    No treatments available.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if (Auth::user()->type == 'doctor')
        <div class="modal fade" id="createTreatmentModal" tabindex="-1" aria-labelledby="createTreatmentModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-name" id="createTreatmentModalLabel">Create New Treatment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('treatments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="patient_id" value="{{ $patient->id }}">

                            <div class="mb-3">
                                <label for="name" class="form-label">Treatment Title</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="due_date" class="form-label">Due Date</label>
                                <input type="date" name="due_date" id="due_date" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="due_time" class="form-label">Due Time</label>
                                <input type="time" name="due_time" id="due_time" class="form-control" required>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save Treatment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-front-layouts>

