<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6fb;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background: #1e293b;
        }

        .navbar-brand {
            color: white;
            font-weight: bold;
        }

        .welcome-box {
            background: linear-gradient(120deg, #2563eb, #4f46e5);
            color: white;
            padding: 35px;
            border-radius: 12px;
            margin-top: 30px;
        }

        .dashboard-card {
            border: none;
            border-radius: 12px;
            transition: 0.3s;
            height: 100%;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        }

        .card-icon {
            font-size: 35px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">

            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                Mini Event Management
            </a>

            <div class="d-flex align-items-center gap-3">

                <span class="text-white">
                    {{ auth()->user()->name }}
                </span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit" class="btn btn-outline-light btn-sm">
                        Logout
                    </button>
                </form>

            </div>

        </div>
    </nav>


    <div class="container">

        <!-- Welcome Section -->
        <div class="welcome-box">

            <h1>Admin Dashboard</h1>

            <h5 class="mt-3">
                Welcome, {{ auth()->user()->name }}!
            </h5>

            <p class="mb-0">
                Manage your events, registrations and users from one place.
            </p>

        </div>


        <!-- Dashboard Cards -->
        <div class="row g-4 mt-3">

            <!-- Manage Events -->
            <div class="col-md-4">

                <div class="card dashboard-card shadow-sm">
                    <div class="card-body p-4">

                        <div class="card-icon">📅</div>

                        <h4>Manage Events</h4>

                        <p class="text-muted">
                            Add, edit, delete and manage all events.
                        </p>

                        <a href="{{ route('admin.events.index') }}"
                           class="btn btn-primary">
                            Manage Events
                        </a>

                    </div>
                </div>

            </div>


            <!-- Manage Registrations -->
            <div class="col-md-4">

                <div class="card dashboard-card shadow-sm">
                    <div class="card-body p-4">

                        <div class="card-icon">📝</div>

                        <h4>Registrations</h4>

                        <p class="text-muted">
                            View and search event registrations.
                        </p>

                        <a href="{{ route('admin.registrations.index') }}"
                           class="btn btn-success">
                            Manage Registrations
                        </a>

                    </div>
                </div>

            </div>


            <!-- Manage Users -->
            <div class="col-md-4">

                <div class="card dashboard-card shadow-sm">
                    <div class="card-body p-4">

                        <div class="card-icon">👥</div>

                        <h4>Manage Users</h4>

                        <p class="text-muted">
                            View, search, update and delete users.
                        </p>

                        <a href="{{ route('admin.users.index') }}"
                           class="btn btn-dark">
                            Manage Users
                        </a>

                    </div>
                </div>

            </div>

        </div>


        <!-- Footer -->
        <div class="text-center text-muted mt-5 mb-4">
            Mini Event Management System © 2026
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>