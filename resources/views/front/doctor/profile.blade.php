<x-front-layout>
    <div class="container my-5">
        <!-- Card for Doctor Profile -->
        <div class="card shadow-lg border-0">
            <div class="card-body text-center">
                <!-- Profile Header -->
                <div class="d-flex flex-column align-items-center mb-3">
                    <!-- Profile Image -->
                    <img src="{{ Auth::user()->image ?? $doctor->image_url }}" alt="Doctor Profile"
                        class="rounded-circle border border-3 border-primary"
                        style="width: 150px; height: 150px; object-fit: cover;">

                    <!-- Doctor Name & Role -->
                    <h2 class="mt-3 fw-bold text-primary">{{ Auth::user()->name }}</h2>
                    <p class="text-muted mb-0">Medical Doctor</p>
                    <p class="text-muted">{{ $doctor->specialty ?? 'General Practitioner' }}</p>
                </div>

                <!-- Doctor Details -->
                <div class="row g-4 mt-3">
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="card-title fw-bold text-secondary border-bottom pb-2 text-center">Personal Information</h5>
                                <ul class="list-unstyled mt-3">
                                    <li class="mb-2"><i class="fas fa-user me-2 text-primary"></i><strong>Name:</strong> {{ Auth::user()->name }}</li>
                                    <li class="mb-2"><i class="fas fa-envelope me-2 text-primary"></i><strong>Email:</strong> {{ Auth::user()->email }}</li>
                                    <li class="mb-2"><i class="fas fa-map-marker-alt me-2 text-primary"></i><strong>Location:</strong> {{ $doctor->city ?? 'N/A' }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="card-title fw-bold text-secondary border-bottom pb-2 text-center">Professional Information</h5>
                                <ul class="list-unstyled mt-3">
                                    <li class="mb-2"><i class="fas fa-user-md me-2 text-primary"></i><strong>Specialty:</strong> {{ $doctor->specialty ?? 'N/A' }}</li>
                                    <li class="mb-2"><i class="fas fa-graduation-cap me-2 text-primary"></i><strong>Qualification:</strong> MD, PhD</li>
                                    <li class="mb-2"><i class="fas fa-hospital me-2 text-primary"></i><strong>Hospital:</strong> City Hospital</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-front-layout>
