<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Manage Users</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6fb;
        }

        .main-card {
            border: none;
            border-radius: 12px;
        }

        .table th {
            background: #1e293b;
            color: white;
            white-space: nowrap;
        }

        .table td {
            vertical-align: middle;
        }

        .page-title {
            color: #1e293b;
            font-weight: bold;
        }

        .back-btn {
            text-decoration: none;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">
            Mini Event Management
        </a>

        <span class="text-white">
            Admin: {{ auth()->user()->name }}
        </span>
    </div>
</nav>

<div class="container py-5">

    <div class="card main-card shadow-sm">

        <div class="card-body p-4">

            <h2 class="page-title mb-2">Manage Users</h2>

            <p class="text-muted">
                View, search, update and delete registered users.
            </p>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p class="mb-1">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- Search -->
            <form method="GET"
                  action="{{ route('admin.users.index') }}"
                  class="row g-2 mb-4">

                <div class="col-md-5">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search name or email..."
                        value="{{ request('search') }}"
                    >
                </div>

                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">
                        Search
                    </button>
                </div>

                <div class="col-auto">
                    <a href="{{ route('admin.users.index') }}"
                       class="btn btn-secondary">
                        Reset
                    </a>
                </div>

            </form>

            <!-- Users Table -->
            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Current Role</th>
                            <th>Update Role</th>
                            <th>Joined Date</th>
                            <th>Delete User</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($users as $user)

                            <tr>

                                <td>{{ $user->id }}</td>

                                <td class="fw-semibold">
                                    {{ $user->name }}
                                </td>

                                <td>{{ $user->email }}</td>

                                <td>
                                    @if($user->role === 'admin')
                                        <span class="badge bg-success">Admin</span>
                                    @else
                                        <span class="badge bg-secondary">User</span>
                                    @endif
                                </td>

                                <td>

                                    @if($user->id !== auth()->id())

                                        <form method="POST"
                                              action="{{ route('admin.users.updateRole', $user->id) }}"
                                              class="d-flex gap-2">

                                            @csrf
                                            @method('PATCH')

                                            <select name="role"
                                                    class="form-select form-select-sm"
                                                    required>

                                                <option value="user"
                                                    {{ $user->role === 'user' ? 'selected' : '' }}>
                                                    User
                                                </option>

                                                <option value="admin"
                                                    {{ $user->role === 'admin' ? 'selected' : '' }}>
                                                    Admin
                                                </option>

                                            </select>

                                            <button type="submit"
                                                    class="btn btn-primary btn-sm">
                                                Update
                                            </button>

                                        </form>

                                    @else

                                        <span class="badge bg-info text-dark">
                                            Current Account
                                        </span>

                                    @endif

                                </td>

                                <td>
                                    {{ $user->created_at->format('d-m-Y') }}
                                </td>

                                <td>

                                    @if($user->id !== auth()->id())

                                        <form method="POST"
                                              action="{{ route('admin.users.destroy', $user->id) }}"
                                              onsubmit="return confirm('Are you sure you want to delete this user?');">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm">
                                                Delete
                                            </button>

                                        </form>

                                    @else

                                        <span class="badge bg-secondary">
                                            Protected
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    No users found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $users->links() }}
            </div>

            <a href="{{ route('admin.dashboard') }}"
               class="btn btn-dark mt-3 back-btn">
                ← Back to Admin Dashboard
            </a>

        </div>

    </div>

    <div class="text-center text-muted mt-4">
        Mini Event Management System © 2026
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>