<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartCare - @yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Custom CSS -->
{{-- 
    <link  href="{{ asset('build/assets/app-12744582.css') }}" rel="stylesheet"> --}}
    <script>
        const userID = {{ Auth::id() }} 
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #007bff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand,
        .navbar-text,
        .nav-link {
            color: white !important;
        }

        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 8px 12px;
        }

        .profile-section,
        .details-section {
            background-color: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #007bff;
        }

        .footer {
            background-color: #007bff;
            color: white;
            padding: 15px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .nav-icons {
            font-size: 1.5rem;
        }

        .patient-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .patient-info {
            flex-grow: 1;
            margin-left: 15px;
        }

        .patient-info h6 {
            margin: 0;
            color: #007bff;
        }

        .patient-info p {
            margin: 0;
            color: #6c757d;
        }

        .card-hover {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .btn-outline-primary:hover {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">SmartCare</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="fas fa-home nav-icons"></i> Home</a>
                    </li>
                    <h1>
                    </h1>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ route(Auth::user()->type === 'nurse' ? 'nurse.profile' : 'doctor.profile') }}">
                            <i class="fas fa-user-md nav-icons"></i> Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ route(Auth::user()->type === 'nurse' ? 'nurse.patients' : 'doctor.patients') }}">
                            <i class="fas fa-procedures nav-icons"></i> Patients
                        </a>
                    </li>

                    <x-front.notification-menu />

                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline ">
                            @csrf
                            <button type="submit" class="nav-link btn  btn-link p-0 m-0 mt-2 text-white">
                                <i class="fas fa-sign-in-alt nav-icons"></i> Logout
                            </button>
                        </form>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        {{ $slot }}
    </div>

    
    {{-- <script>
        const userID = {{  }} 
    </script>
    <script src="{{ asset('build/assets/app-d79f4e4e.js') }}"></script> --}}
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
<script>
    function navigateTo(section) {
        window.location.href = `/${section}`;
    }
</script>
