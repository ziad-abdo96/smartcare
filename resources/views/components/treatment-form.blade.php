@props(['action', 'method' => 'POST', 'treatment' => null])

<form action="{{ $action }}" method="POST" class="mb-4">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Treatment Name</label>
            <input type="text" class="form-control" name="treatment_name" value="{{ old('treatment_name', $treatment->treatment_name ?? '') }}" required>
        </div>
        <div class="col-md-3 mb-3">
            <label class="form-label">Dosage</label>
            <input type="text" class="form-control" name="dosage" value="{{ old('dosage', $treatment->dosage ?? '') }}" required>
        </div>
        <div class="col-md-3 mb-3">
            <label class="form-label">Frequency (per day)</label>
            <input type="number" class="form-control" name="frequency" value="{{ old('frequency', $treatment->frequency ?? '') }}" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Start Date</label>
            <input type="date" class="form-control" name="start_date" value="{{ old('start_date', $treatment->start_date ?? '') }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">End Date</label>
            <input type="date" class="form-control" name="end_date" value="{{ old('end_date', $treatment->end_date ?? '') }}" required>
        </div>
    </div>

    <button type="submit" class="btn btn-success">{{ $method === 'POST' ? 'Add Treatment' : 'Update Treatment' }}</button>
</form>
