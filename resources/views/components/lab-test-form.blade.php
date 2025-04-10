@props(['labTest' => null])

<div>
    <div class="mb-3">
        <label class="form-label">Test Name</label>
        <input type="text" name="test_name" id="editTestName" class="form-control" value="{{ $labTest?->test_name ?? '' }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Test Date</label>
        <input type="date" name="test_date" id="editTestDate" class="form-control" value="{{ $labTest?->test_date ?? '' }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" id="editStatus" class="form-control">
            <option value="pending" {{ $labTest?->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="completed" {{ $labTest?->status == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="in-progress" {{ $labTest?->status == 'in-progress' ? 'selected' : '' }}>In Progress</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Result</label>
        <input type="text" name="result" id="editResult" class="form-control" value="{{ $labTest?->result ?? '' }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Upload File (Optional)</label>
        <input type="file" name="file" id="editFileLink" class="form-control">
        @if ($labTest?->file_path)
            <p class="mt-2"><a href="{{ asset($labTest->file_path) }}" target="_blank">View Current File</a></p>
        @endif
    </div>
</div>
