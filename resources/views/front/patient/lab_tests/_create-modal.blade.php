<div class="modal fade" id="addLabTestModal" tabindex="-1" aria-labelledby="addLabTestModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-primary">Add New Lab Test</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('lab-tests.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="status" value="Penning">
                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                    <x-lab-test-form />
                    <button type="submit" class="btn btn-primary">Save Test</button>
                </form>
            </div>
        </div>
    </div>
</div>
