<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #212121;
            color: #fff;
            height: 100vh;
            margin: 0;
        }
        .navbar, .footer {
            background-color: #333;
        }
        .navbar-brand {
            color: #fff !important;
        }
        .container {
            margin-top: 40px;
        }
        .card {
            background-color: #333;
            color: #fff;
            border-radius: 8px;
        }
        .card-body {
            padding: 30px;
        }
        .btn-custom {
            background-color: #1a73e8;
            color: #fff;
            border: none;
            font-weight: 500;
        }
        .btn-custom:hover {
            background-color: #1565c0;
        }
        .footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
        .dashboard-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 100px); /* Adjust height to fill screen minus navbar and footer */
            flex-direction: column;
        }
        .card-container {
            display: flex;
            justify-content: space-between;
            gap: 40px; /* Increased space between cards */
            width: 80%; /* Take up 80% of the container's width */
        }
        .card-container .card {
            width: 45%; /* Increased card width */
        }
        @media (max-width: 768px) {
            .card-container {
                flex-direction: column; /* Stack cards on smaller screens */
                width: 90%; /* Take up more space on smaller screens */
            }
            .card-container .card {
                width: 100%; /* Make cards full width on small screens */
                margin-bottom: 20px; /* Add some space between stacked cards */
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">ITDD Portal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>



        <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" id="settingsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="material-symbols-outlined me-1">settings</span>Settings
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="settingsDropdown">
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('HEAD.logout') }}">
                            <span class="material-symbols-outlined me-1">logout</span>Logout
                        </a>
                    </div>
                </li>
            </ul>
    </div>
</nav>

<!-- Dashboard Container -->
<div class="dashboard-container">
    <h2 class="text-center mb-4">Admin Dashboard</h2>
    <div class="card-container">
        <div class="card shadow-lg">
            <div class="card-body text-center">
                <h4>Manage Account Details</h4>
                <p>Access and manage all account details</p>
                <button class="btn btn-custom w-100" data-bs-toggle="modal" data-bs-target="#confirmModal">View Account Details</button>
            </div>
        </div>
        <div class="card shadow-lg">
            <div class="card-body text-center">
                <h4>View Database</h4>
                <p>Access PDAO database</p>
                <a href={{route('HEAD.index')}} class="btn btn-custom w-100">View Database</a>
            </div>
        </div>
    </div>
</div>


<!-- Footer -->
<div class="footer">
    <p>&copy; 2024 City Government of Parañaque City. All rights reserved</p>
</div>


<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background-color: #333; color: #fff;">
      <div class="modal-header" style="border-bottom: 1px solid #444;">
        <h5 class="modal-title" id="confirmModalLabel">Confirm Your Identity</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="confirmForm" action="{{ route('HEAD.account.verify') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required style="background-color: #555; color: #fff; border: 1px solid #666;">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required style="background-color: #555; color: #fff; border: 1px solid #666;">
          </div>
          <!-- Error Message -->
          <div id="errorMessage" class="text-danger" style="display: none; font-weight: bold; text-align: center;">
            Unauthorized access. Please check your credentials!
          </div>
        </div>
        <div class="modal-footer" style="border-top: 1px solid #444;">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Confirm</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="logsModal" tabindex="-1" aria-labelledby="logsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: #333; color: #fff;">
            <div class="modal-header" style="background-color: #444;">
                <h5 class="modal-title" id="logsModalLabel">Activity Logs</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: brightness(0) invert(1);"></button>
            </div>
            <div class="modal-body" id="logsModalBody" style="background-color: #555;">
                <!-- Log content will be filled via JavaScript -->
            </div>
            <div class="modal-footer" style="background-color: #444;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Success Message Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: #333; color: #fff;">
            <div class="modal-header" style="background-color: #008080; color: white; border-bottom: 1px solid #555;">
                <h5 class="modal-title" id="messageModalLabel">Notification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: brightness(0) invert(1);"></button>
            </div>
            <div class="modal-body" style="background-color: #444; color: #fff;">
                {{ session('success') }}
            </div>
            <div class="modal-footer" style="background-color: #444; color: white; border-top: 1px solid #555;">
                <h6 style="margin: 0;">Click anywhere to close</h6>
            </div>
        </div>
    </div>
</div>










<!-- Error Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background-color: #333; color: #fff;">
      <div class="modal-header" style="border-bottom: 1px solid #444; background-color: red;"> <!-- Red background for header -->
        <h5 class="modal-title" id="errorModalLabel">Unauthorized Access</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <!-- Display Custom Login Error -->
        @if ($errors->has('login_error'))
          <p style="color: red; font-weight: bold;">{{ $errors->first('login_error') }}</p>
        @endif

        <!-- Display Other Validation Errors -->
        @if ($errors->any() && !$errors->has('login_error'))
          <div style="color: red; font-weight: bold;">
            <ul style="list-style-type: none; padding-left: 0;">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
      </div>
      <div class="modal-footer" style="border-top: 1px solid #444;">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<script>
    @if ($errors->any())
        // Trigger the error modal when there are validation errors
        var myModal = new bootstrap.Modal(document.getElementById('errorModal'), {
            keyboard: false
        });
        myModal.show();
    @endif

    $(document).ready(function() {
        @if(session('success'))
            $('#messageModal').modal('show');
        @endif
    });

    
</script>
</body>
</html>
