<x-front-layouts route="nurse">
    <div class="container mt-4">
        <h2 class="mb-4 text-center">Patient List</h2>

        @if(auth()->user()->role === 'nurse')
            <div class="text-end mb-3">
                <a href="{{ route('patient.create') }}" class="btn btn-success">+ Add New Patient</a>
            </div>
        @endif
    
        <div class="row">
            @foreach ($patients as $patient)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $patient->user->name }}</h5>
                            <p class="card-text"><strong>Age:</strong> {{ $patient->user->date_of_birth }}</p>
                            <p class="card-text"><strong>Gender:</strong> {{ $patient->user->gender }}</p>
                            <a href="{{ route('patient.show', $patient->id) }}" class="btn btn-outline-primary btn-sm w-100">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-front-layouts>
