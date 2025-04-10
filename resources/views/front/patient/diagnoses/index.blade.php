<x-front-layouts>
    <div class="container mt-4">
        <h2 class="text-primary text-center">Diagnoses for {{ $patient->user->name }}</h2>

        @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-bordered table-striped text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>Diagnosis</th>
                            <th>Notes</th>
                            <th>Doctor</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($diagnoses as $diagnosis)
                            <tr>
                                <td>{{ $diagnosis->diagnosis }}</td>
                                <td>{{ $diagnosis->notes ?? 'N/A' }}</td>
                                <td>{{ $diagnosis->doctor->name }}</td>
                                <td>{{ $diagnosis->created_at->format('d M, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">No Diagnoses Available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if (Auth::user()->type == 'doctor')
            <div class="mt-4">
                <h4 class="text-primary">Add New Diagnosis</h4>
                <form action="{{ route('diagnoses.store', $patient->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="diagnosis" class="form-label">Diagnosis</label>
                        <textarea name="diagnosis" id="diagnosis" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes (Optional)</label>
                        <textarea name="notes" id="notes" class="form-control" rows="2"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Diagnosis</button>
                </form>
            </div>
        @endif
    </div>
</x-front-layouts>
