<x-front-layouts>
    <div class="container mt-4">
        <div class="card shadow rounded-4">
            <div class="card-header bg-success text-white text-center rounded-top-4">
                <h2>Edit Treatment for {{ $patient->user->name }}</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('treatments.update', [$patient->id, $treatment->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="treatment_name" class="form-label">Treatment Name</label>
                            <input type="text" class="form-control" id="treatment_name" name="treatment_name" value="{{ $treatment->treatment_name }}" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="dosage" class="form-label">Dosage</label>
                            <input type="text" class="form-control" id="dosage" name="dosage" value="{{ $treatment->dosage }}" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="frequency" class="form-label">Frequency (per day)</label>
                            <input type="number" class="form-control" id="frequency" name="frequency" value="{{ $treatment->frequency }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $treatment->start_date }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $treatment->end_date }}" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Update Treatment</button>
                </form>
            </div>
        </div>
    </div>
</x-front-layouts>