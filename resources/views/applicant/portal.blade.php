<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicants Data</title>
    <link rel="stylesheet" href="/CSS/viewstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@400;700&display=swap">
    <style>
        /* Custom Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
        }
        .navbar-brand {
            font-weight: bold;
            color: #ffffff !important;
        }
        .navbar {
            background-color: #008080; /* Teal color */
        }
        .modal-header, .modal-footer {
            background-color: #008080;
            color: white;
        }
        .modal-body {
            text-align: center;
            padding: 1.5rem;
        }
        .modal-footer h6 {
            margin: 0;
            font-size: 0.9rem;
        }
        .table-hover tbody tr:hover {
            background-color: #e9ecef; /* Light grey color on hover */
        }
    </style>
</head>

<body>

<!-- Notification Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Notification</h5>
            </div>
            <div class="modal-body">
                @if(session('success'))
                    <p>{{ session('success') }}</p>
                @endif
            </div>
            <div class="modal-footer">
                <h6>Click anywhere to close</h6>
            </div>
        </div>
    </div>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark"style="background-color: #1b7402;">
    <div class="container">
        <a class="navbar-brand" href="#">PDAO Database Management</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center" href="{{ route('home') }}">
                        <span class="material-symbols-outlined me-1">home</span>Home
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="settingsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="material-symbols-outlined me-1">settings</span> Settings
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="settingsDropdown">
                        <li><a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                            <span class="material-symbols-outlined me-1">logout</span> Logout
                        </a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Applicants Data</h2>
        <input type="text" id="searchInput" class="form-control w-25" placeholder="Search...">
    </div>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Track ID</th>
                <th>Applicant Type</th>
                <th>Full Name</th>
                <th>Date Applied</th>
                <th>Status</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody id="applicantsTable">
            @foreach($applicants as $applicant)
            <tr onclick="location.href='{{ route('applicants.show', $applicant->id) }}'" style="cursor: pointer;">
                <td>{{ $applicant->Track_id }}</td>
                <td>{{ $applicant->Applicant_type }}</td>
                <td>{{ $applicant->LN . ' ' . $applicant->FN . ' ' . $applicant->MN }}</td>
                <td>{{ $applicant->Date_applied }}</td>
                <td>{{ $applicant->status }}</td>
                <td>{{ $applicant->remarks }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>




<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #008080; color: white;"> <!-- Teal background color -->
                <h5 class="modal-title" id="messageModalLabel">Notification</h5>
            </div>
            <div class="modal-body">
                @if(session('success'))
                    {{ session('success') }}
                @endif
            </div>
            <div class="modal-footer" style="background-color: #008080; color: white;">
                <h6>Click anywhere to close</h6>
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS and Popper -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        // Check if the modal should be shown based on session data
        @if(session('success'))
            $('#messageModal').modal('show');
        @endif
    });


    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const tableRows = document.querySelectorAll('#applicantsTable tr');

        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase();

            tableRows.forEach(row => {
                const rowText = row.textContent.toLowerCase();
                if (rowText.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>
</body>
</html>
