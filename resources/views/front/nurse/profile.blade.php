<x-front-layouts route="nurse">
    <div class="container my-5">
        <!-- Nurse Profile Card -->
        <div class="card shadow-lg border-0">
            <div class="card-body text-center">
                <!-- Profile Image -->
                <div class="d-flex justify-content-center mb-3">
                    <img src="{{ Auth::user()->image ?? $nurse->image_url }}" alt="Nurse Profile"
                        class="rounded-circle border border-3 border-primary"
                        style="width: 150px; height: 150px; object-fit: cover;">
                </div>

                <!-- Nurse Name & Birthday -->
                <h2 class="fw-bold text-primary mb-1">{{ Auth::user()->name }}</h2>
                <p class="text-muted fst-italic">{{ Auth::user()->date_of_birth ?? '-' }}</p>

                <!-- Nurse Details -->
                <div class="card mt-4 shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-secondary border-bottom pb-2 text-center">Profile Information</h5>
                        <div class="row g-4 mt-3">
                            <div class="col-md-6">
                                <p class="mb-2"><i class="fas fa-user text-primary me-2"></i><strong>Name:</strong> {{ Auth::user()->name }}</p>
                                <p class="mb-2"><i class="fas fa-envelope text-primary me-2"></i><strong>Email:</strong> {{ Auth::user()->email }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2"><i class="fas fa-birthday-cake text-primary me-2"></i><strong>Birthday:</strong> {{ Auth::user()->date_of_birth ?? '-' }}</p>
                                <p class="mb-2"><i class="fas fa-briefcase text-primary me-2"></i><strong>Experience:</strong> {{ $nurse->experience_of_years ?? '-' }} years</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-front-layouts>
