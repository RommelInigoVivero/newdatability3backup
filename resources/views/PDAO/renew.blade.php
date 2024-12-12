<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renew PWD Record</title>
    <link rel="stylesheet" href="/CSS/viewstyle.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body>

<nav class="navbar navbar-expand-lg" style="background-color: #1b7402;"> <!-- Teal Color -->
    <div class="container">
        <a class="navbar-brand text-white" href="#"> <!-- Text color white for contrast -->
            PDAO DATABASE MANAGEMENT
        </a>
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

                <li class="nav-item {{ request()->is('views') ? 'active' : '' }}">
                    <a class="nav-link text-white d-flex align-items-center" href="{{ route('views') }}">
                        <span class="material-symbols-outlined me-1">view_list</span>View Database
                    </a>
                </li>

                <li class="nav-item {{ request()->is('renew') ? 'active' : '' }}">
                    <a class="nav-link text-white d-flex align-items-center" href="{{ route('renew') }}">
                        <span class="material-symbols-outlined me-1">source_notes</span>Renew
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center" href="{{ route('expired.records') }}">
                        <span class="material-symbols-outlined me-1">inventory_2</span>Archive
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="settingsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="material-symbols-outlined me-1">settings</span>Settings
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="settingsDropdown">
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                            <span class="material-symbols-outlined me-1">logout</span>Logout
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1>Renew PWD Record</h1>

    <input type="text" id="search" placeholder="Search by Name or PWD ID" class="form-control mb-3">

    <div id="search-results"></div>
</div>

<!-- Modal -->
<div class="modal fade" id="warningModal" tabindex="-1" role="dialog" aria-labelledby="warningModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="warningModalLabel">Invalid Date</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        You cannot renew a date in the past. Please select a valid renewal date.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search').on('input', function() {
            let query = $(this).val();
            if (query.length > 0) {
                $.ajax({
                    url: "{{ route('renew') }}",
                    method: 'GET',
                    data: { search: query },
                    success: function(data) {
                        let output = '';
                        if (data.length === 0) {
                            output += '<p>No records found.</p>';
                        } else {
                            data.forEach(function(dataForm) {
                                output += `
                                    <div class="card border-primary mb-3">
                                        <div class="card-header">
                                            <strong>Name:</strong> ${dataForm.FN} ${dataForm.MN} ${dataForm.LN}
                                        </div>
                                        <div class="card-body">
                                            <p><strong>PWD ID:</strong> ${dataForm.PWD_id}</p>
                                            <p><strong>Date Applied:</strong> ${dataForm.Date_applied}</p>
                                            <p><strong>Date Renewed:</strong> ${dataForm.Date_renewed || 'NONE'}</p>
                                            <form action="{{ route('renew.submit', '') }}/${dataForm.id}" method="POST" class="renew-form">
                                                @csrf
                                                <label for="Date_renewed">Renew Date:</label>
                                                <input type="date" name="Date_renewed" required class="form-control mb-2">
                                                <button type="submit" class="btn btn-success">Renew</button>
                                            </form>
                                        </div>
                                    </div>
                                `;
                            });
                        }
                        $('#search-results').html(output);
                    }
                });
            } else {
                $('#search-results').empty();
            }
        });

        // Handle form submission with validation
        $(document).on('submit', '.renew-form', function(e) {
            e.preventDefault(); // Prevent default form submission
            let renewalDate = $(this).find('input[name="Date_renewed"]').val();
            let currentDate = new Date().toISOString().split('T')[0]; // Get current date

            if (renewalDate < currentDate) {
                $('#warningModal').modal('show'); // Show modal if the date is invalid
                return;
            }

            this.submit(); // Submit the form if validation passes
        });
    });
</script>
</body>
</html>
