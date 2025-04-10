<x-front-layouts>
    <div class="container py-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary fw-bold">Patient Details</h2>
            <button class="btn btn-outline-primary" onclick="history.back()">
                <i class="fas fa-arrow-left"></i> Back
            </button>
        </div>

        <!-- Patient Info -->
        <div class="card mb-4 shadow-sm border-0 rounded-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title mb-1 fw-semibold">Name: <span class="text-dark">{{ $patient->user->name }}</span></h4>
                    <p class="card-text text-muted mb-0">Age: 21</p>
                </div>
                <span class="badge bg-primary fs-6 p-3 rounded-pill">Room: {{ $patient->room_number }}</span>
            </div>
        </div>

        <!-- Medical Details Section -->
        <h5 class="text-secondary mb-3 fw-semibold">Medical Details:</h5>
        <div class="row g-4 justify-content-center">
            <div class="col-12 col-md-4">
                <div class="card text-center p-4 shadow-sm border-0 rounded-4 card-hover">
                    <img src="https://news.ki.se/sites/nyheter/files/styles/article_full_width/public/qbank/patient-5691153_custom20221216140120.jpg" class="mx-auto mb-3" style="height: 180px; width: 100%; object-fit: cover;" alt="Condition">
                    <a href="{{ route('patient.info', $patient->id) }}" class="btn btn-info"><h6 class="text-primary fw-bold">Condition</h6></a>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card text-center p-4 shadow-sm border-0 rounded-4 card-hover">
                    <img src="https://www.venkateshwarhospitals.com/images/pathology-internal-img.jpg" style="height: 170px; width: 100%; object-fit: cover;" class="mx-auto mb-3" alt="Lab Test">
                    <a href="{{ route('lab-tests.index', $patient->id) }}" class="btn btn-info"><h6 class="text-primary fw-bold">Lab Test</h6></a>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card text-center p-4 shadow-sm border-0 rounded-4 card-hover">
                    <img src="https://cliniquelesoliviers.net/sites/default/files/field/image/tension-1200_0.jpg" style="height: 170px; width: 100%; object-fit: cover;" class="mx-auto mb-3" alt="Rays">
                    <a href="{{ route('tasks.index', $patient->id) }}" class="btn btn-info"><h6 class="text-primary fw-bold">Rays</h6></a>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card text-center p-4 shadow-sm border-0 rounded-4 card-hover">
                    <img src="https://images.theconversation.com/files/64151/original/xqdhycf7-1415638993.jpg?ixlib=rb-4.1.0&q=45&auto=format&w=926&fit=clip" style="height: 170px; width: 100%; object-fit: cover;" class="mx-auto mb-3" alt="Treatments">
                    <a href="{{ route('treatments.index', $patient->id) }}" class="btn btn-info"><h6 class="text-primary fw-bold">Treatments</h6></a>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card text-center p-4 shadow-sm border-0 rounded-4 card-hover">
                    <img src="https://www.alcimed.com/wp-content/uploads/2023/10/ai-medical-diagnosis-1-800x380.jpg" style="height: 170px; width: 100%; object-fit: cover;" class="mx-auto mb-3" alt="Diagnoses">
                    <a href="{{ route('diagnoses.index', $patient->id) }}" class="btn btn-info"><h6 class="text-primary fw-bold">Diagnoses</h6></a>
                </div>
            </div>
        </div>
    </div>
</x-front-layouts>
