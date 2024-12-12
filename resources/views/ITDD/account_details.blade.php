<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #212121;
            color: #fff;
            min-height: 100vh; /* Ensure the body takes at least full screen height */
            display: flex;
            flex-direction: column;
        }
        .navbar, .footer {
            background-color: #333;
        }
        .navbar-brand {
            color: #fff !important;
        }
        .container {
            margin-top: 40px;
            flex-grow: 1; /* Ensure the container grows to take available space */
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
            width: 100%; /* Makes the footer span the full width */
            background-color: #333; /* Optional: dark background */
            color: white; /* Optional: text color */
            padding: 10px 0; /* Optional: vertical padding */
            text-align: center; /* Center the text */
            position: fixed; /* Sticks the footer at the bottom */
            bottom: 0; /* Aligns it to the bottom of the page */
            left: 0; /* Aligns it to the left side */
            z-index: 1000; /* Ensures it stays above other elements if necessary */
        }

        /* Added spacing between tables */
        .table-container {
            margin-bottom: 30px; /* Adjust the margin for spacing between tables */
        }

        /* Remove the border between modal sections */
        .modal-header, .modal-body, .modal-footer {
            border: none !important;
        }



        /* Modal custom styling */
        .modal-content {
            background-color: #333; /* Dark background for the modal */
            color: #fff; /* Light text for visibility */
            border-radius: 8px; /* Rounded corners for the modal */
        }

        /* Modal Header */
        .modal-header {
            border-bottom: 1px solid #444; /* Slightly lighter border */
        }

        /* Modal Footer */
        .modal-footer {
            border-top: 1px solid #444; /* Slightly lighter border */
        }

        /* Custom close button */
        .btn-close {
            color: #fff; /* Make the close button white */
            opacity: 1; /* Ensure it's fully visible */
        }

        /* Center the modal */
        .modal-dialog-centered {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Button styles */
        .btn-secondary {
            background-color: #666; /* Darker background for the cancel button */
            color: #fff;
        }

        .btn-primary {
            background-color: #1a73e8; /* Button color matches your theme */
            border: none;
        }

        .btn-primary:hover {
            background-color: #1565c0; /* Hover effect for primary button */
        }



        /* Ensure that action buttons have consistent width */
        .btn-sm {
            white-space: nowrap; /* Prevent button text from wrapping */
        }

        /* Adding more space between Status and Actions */
        .status {
            padding-right: 20px; /* Add padding to the right of the Status column */
        }

        /* Ensuring there's enough space between action buttons */
        .d-flex {
            display: flex;
            flex-wrap: wrap;
            gap: 10px; /* Adds space between buttons */
        }
    </style>
</head>
<body>

<!-- Error Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: #333; color: #fff;">
            <div class="modal-header" style="border-bottom: 1px solid #444; background-color: #ff4d4d; color: white;">
                <h5 class="modal-title" id="errorModalLabel">Validation Errors</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: brightness(0) invert(1);"></button>
            </div>
            <div class="modal-body" style="background-color: #444; color: #fff;">
                @if($errors->any())
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="modal-footer" style="background-color: #444; color: white; border-top: 1px solid #555;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #555; border: none;">Close</button>
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


<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href={{route('ITDD.dashboard')}}>ITDD Portal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<!-- Admin Accounts Table -->
<div class="container">
    <h2 class="text-center mb-2">Account Details</h2>

    <div class="row justify-content-center table-container">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h4>Admin Accounts</h4>
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th class="status-column">Status</th> <!-- Added a class for status column -->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admins as $admin)
                                <tr data-admin-id="{{ $admin->id }}">
                                    <td>{{ $admin->Fname }} {{ $admin->Lname }}</td>
                                    <td>{{ $admin->username }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td class="status">
                                        <span class="badge status-badge 
                                            {{ $admin->status === 'ACTIVE' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $admin->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-2">
                                            <!-- Change Password Button -->
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#changePasswordModal" data-email="{{ $admin->email }}">
                                                Change Password
                                            </button>

                                            <!-- View Logs Button -->
                                            <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#logsModalAdmin" data-admin-id="{{ $admin->id }}">
                                                View Logs
                                            </button>

                                            <!-- Activate Account Button -->
                                            <button class="btn btn-success btn-sm activate-btn" data-admin-id="{{ $admin->id }}">
                                                Activate
                                            </button>

                                            <!-- Suspend Account Button -->
                                            <button class="btn btn-danger btn-sm suspend-btn" data-admin-id="{{ $admin->id }}">
                                                Suspend
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PDAO Accounts Table -->
<div class="container mb-5">
    <div class="row justify-content-center table-container">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h4>PDAO Accounts</h4>
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr data-user-id="{{ $user->id }}">
                            <td>{{ $user->Fname }} {{ $user->Lname }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge Pdao-status-badge 
                                        {{ $user->status === 'ACTIVE' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $user->status }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex flex-wrap gap-2">
                                    <!-- Change Password Button -->
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#changePasswordModal" data-email="{{ $user->email }}">
                                        Change Password
                                    </button>

                                    <!-- View Logs Button -->
                                    <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#logsModalUser" data-user-id="{{ $user->id }}">
                                        View Logs
                                    </button>

                                    <!-- Activate Account Button -->
                                    <button class="btn btn-success btn-sm Pdao-activate-btn" data-user-id="{{ $user->id }}">
                                        Activate
                                    </button>

                                    <!-- Suspend Account Button -->
                                    <button class="btn btn-danger btn-sm Pdao-suspend-btn" data-user-id="{{ $user->id }}">
                                        Suspend
                                    </button>
                                </div>
                            </td>
                        </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="footer mt-4 pt-3">
        <p>&copy; 2024 City Government of Parañaque City. All rights reserved</p>
    </div>

    <!-- Modal for success message -->
    <div class="modal fade" id="successMessageModal" tabindex="-1" role="dialog" aria-labelledby="successMessageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #008080; color: white;">
                    <h5 class="modal-title" id="messageModalLabel">Notification</h5>
                </div>
                <div class="modal-body">
                    {{ session('success') }}
                </div>
                <div class="modal-footer" style="background-color: #008080; color: white;">
                    <h6>Click anywhere to close</h6>
                </div>
            </div>
        </div>
    </div>

<!-- Modal for Admin Logs -->
    <div class="modal fade" id="logsModalAdmin" tabindex="-1" aria-labelledby="logsModalAdminLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="background-color: #333; color: #fff;">
                <div class="modal-header" style="border-bottom: 1px solid #444;">
                    <h5 class="modal-title" id="logsModalAdminLabel">Admin Activity Logs</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: brightness(0) invert(1);"></button>
                </div>
                <div class="modal-body" style="background-color: #444; color: #fff;">
                    <!-- Dropdown for Dates -->
                    <div class="mb-3">
                        <label for="adminActivityDateSelect" class="form-label">Select Date:</label>
                        <select id="adminActivityDateSelect" class="form-select" style="background-color: #555; color: #fff;">
                            <option value="">-- Select a Date --</option>
                        </select>
                    </div>

                    <!-- Table for Logs -->
                    <div class="table-responsive">
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Activity</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody id="adminLogsTableBody">
                                <!-- Logs will be dynamically added here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer" style="background-color: #444; color: white; border-top: 1px solid #555;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<!-- User Logs Modal -->
    <div class="modal fade" id="logsModalUser" tabindex="-1" aria-labelledby="logsModalUserLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="background-color: #333; color: #fff;">
                <div class="modal-header" style="border-bottom: 1px solid #444;">
                    <h5 class="modal-title" id="logsModalUserLabel">User Activity Logs</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: brightness(0) invert(1);"></button>
                </div>
                <div class="modal-body" style="background-color: #444; color: #fff;">
                    <!-- Dropdown for Dates -->
                    <div class="mb-3">
                        <label for="activityDateSelect" class="form-label">Select Date:</label>
                        <select id="activityDateSelect" class="form-select" style="background-color: #555; color: #fff;">
                            <option value="">-- Select a Date --</option>
                        </select>
                    </div>
                    <!-- Table for Logs -->
                    <div class="table-responsive">
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Activity</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody id="logsTableBody">
                                <!-- Logs will be dynamically added here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer" style="background-color: #444; color: white; border-top: 1px solid #555;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="background-color: #333; color: #fff;">
                    <div class="modal-header" style="border-bottom: 1px solid #444;">
                        <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: #fff;"></button>
                    </div>
                    <div class="modal-body" style="background-color: #444;">
                        <form method="POST" action={{route('changepass')}}>
                            @csrf
                            <input type="hidden" id="email" name="email" value="">
                            <div class="mb-3">
                                <label for="newPassword" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="newPassword" name="newPassword" required style="background-color: #555; color: #fff; border: 1px solid #666;">
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required style="background-color: #555; color: #fff; border: 1px solid #666;">
                            </div>
                            <button type="submit" class="btn btn-primary" style="background-color: #1a73e8; border: none;">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>

<!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirm Action</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to <span id="modalAction"></span> this admin account?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmAction">Yes, Proceed</button>
                </div>
            </div>
        </div>
    </div>




    <!-- PDA0 Confirmation Modal -->
    <div class="modal fade" id="PdaoconfirmationModal" tabindex="-1" aria-labelledby="PdaoconfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="PdaoconfirmationModalLabel">Confirm Action</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to <span id="PdaomodalAction"></span> this PDAO account?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="PdaoconfirmAction">Yes, Proceed</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
    var changePasswordModal = document.getElementById('changePasswordModal');
    changePasswordModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var email = button.getAttribute('data-email');
        var modalEmailInput = changePasswordModal.querySelector('#email');
        modalEmailInput.value = email;
    });

    // Show error modal if there are validation errors
    $(document).ready(function() {
        @if($errors->any())
            $('#errorModal').modal('show');
        @endif
    });

    // Show success message modal if there's a success message in session
    $(document).ready(function() {
        @if(session('success'))
            $('#messageModal').modal('show');
        @endif
    });
    document.addEventListener('DOMContentLoaded', function () {

// Helper function to reset dropdown and table content
function resetDropdownAndTable(selectElement, tableBody) {
    selectElement.innerHTML = '<option value="">-- Select a Date --</option>';
    tableBody.innerHTML = '<tr><td colspan="4">No logs to display.</td></tr>';
}

// Helper function to fetch and populate dates in a dropdown
function fetchDates(url, selectElement) {
    fetch(url)
        .then(response => response.json())
        .then(dates => {
            if (dates.length > 0) {
                dates.forEach(date => {
                    selectElement.innerHTML += `<option value="${date}">${date}</option>`;
                });
            } else {
                selectElement.innerHTML = '<option value="">No dates available</option>';
            }
        })
        .catch(error => {
            console.error('Error fetching dates:', error);
            selectElement.innerHTML = '<option value="">Error loading dates</option>';
        });
}

// Helper function to fetch logs and populate the table
function fetchLogs(url, tableBody) {
    tableBody.innerHTML = '<tr><td colspan="4">Loading...</td></tr>';
    fetch(url)
        .then(response => response.json())
        .then(logs => {
            tableBody.innerHTML = '';
            if (logs.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="4">No logs found for this date.</td></tr>';
            } else {
                logs.forEach((log, index) => {
                    let logDate = new Date(log.created_at); // Assuming UTC timestamp
                    let localDate = new Date(logDate.toLocaleString()); // Local time conversion
                    let formattedDate = localDate.toLocaleDateString();
                    let formattedTime = localDate.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true });

                    tableBody.innerHTML += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${log.activity}</td>
                            <td>${formattedDate}</td>
                            <td>${formattedTime}</td>
                        </tr>`;
                });
            }
        })
        .catch(error => {
            console.error('Error fetching logs:', error);
            tableBody.innerHTML = '<tr><td colspan="4">Error loading logs.</td></tr>';
        });
}

// Admin Logs Modal (Admin)
var logsModalAdmin = document.getElementById('logsModalAdmin');
var adminActivityDateSelect = document.getElementById('adminActivityDateSelect');
var adminLogsTableBody = document.getElementById('adminLogsTableBody');
var adminId; // Will be set dynamically when modal opens

logsModalAdmin.addEventListener('show.bs.modal', function (event) {
    adminId = event.relatedTarget.getAttribute('data-admin-id');
    resetDropdownAndTable(adminActivityDateSelect, adminLogsTableBody);
    fetchDates(`/admin-activity-dates/${adminId}`, adminActivityDateSelect);
});

adminActivityDateSelect.addEventListener('change', function () {
    const selectedDate = this.value;
    fetchLogs(`/admin-activity-logs/${adminId}?date=${selectedDate}`, adminLogsTableBody);
});

// User Logs Modal (User)
const logsModalUser = document.getElementById('logsModalUser');
const dateSelect = document.getElementById('activityDateSelect');
const tableBody = document.getElementById('logsTableBody');
let userId; // Set dynamically when modal opens

logsModalUser.addEventListener('show.bs.modal', function (event) {
    userId = event.relatedTarget.getAttribute('data-user-id');
    resetDropdownAndTable(dateSelect, tableBody);
    fetchDates(`/user-activity-dates/${userId}`, dateSelect);
});

dateSelect.addEventListener('change', function () {
    const selectedDate = this.value;
    if (selectedDate) {
        fetchLogs(`/user/${userId}/activity-logs?date=${selectedDate}`, tableBody);
    } else {
        resetDropdownAndTable(dateSelect, tableBody);
    }
});
});


// Disable or enable buttons based on current status
function updateButtons(userId, status, isAdmin = false) {
    const row = $('tr[data-' + (isAdmin ? 'admin' : 'user') + '-id="' + userId + '"]');
    const activateBtn = row.find(isAdmin ? '.activate-btn' : '.Pdao-activate-btn');
    const suspendBtn = row.find(isAdmin ? '.suspend-btn' : '.Pdao-suspend-btn');

    if (status === 'ACTIVE') {
        // Disable "Activate" button and enable "Suspend" button
        activateBtn.prop('disabled', true).addClass('disabled');
        suspendBtn.prop('disabled', false).removeClass('disabled');
    } else if (status === 'SUSPENDED') {
        // Disable "Suspend" button and enable "Activate" button
        suspendBtn.prop('disabled', true).addClass('disabled');
        activateBtn.prop('disabled', false).removeClass('disabled');
    }
}

$(document).ready(function() {
    // Disable/Enable buttons based on the status of each account
    $('tr').each(function() {
        const adminStatus = $(this).find('.status-badge').text().trim().toUpperCase();
        const userStatus = $(this).find('.Pdao-status-badge').text().trim().toUpperCase();

        const adminId = $(this).data('admin-id');
        const userId = $(this).data('user-id');

        // Update the buttons based on the current status
        if (adminId) {
            updateButtons(adminId, adminStatus, true); // Admin
        } else if (userId) {
            updateButtons(userId, userStatus, false); // User
        }
    });
});

let adminIdToChange;
let userIdToChange;
let actionToTake;
let actionToTakePdao;

// Activate button (with confirmation) for admin
$('.activate-btn').click(function() {
    adminIdToChange = $(this).data('admin-id');
    actionToTake = 'activate';
    $('#modalAction').text('activate');
    $('#confirmationModal').modal('show');
});

// Suspend button (with confirmation) for admin
$('.suspend-btn').click(function() {
    adminIdToChange = $(this).data('admin-id');
    actionToTake = 'suspend';
    $('#confirmationModal').modal('show');
});

// Activate button (with confirmation) for user
$('.Pdao-activate-btn').click(function() {
    userIdToChange = $(this).data('user-id');
    actionToTakePdao = 'activate';
    $('#modalAction').text('activate');
    $('#PdaoconfirmationModal').modal('show');
});

// Suspend button (with confirmation) for user
$('.Pdao-suspend-btn').click(function() {
    userIdToChange = $(this).data('user-id');
    actionToTakePdao = 'suspend';
    $('#PdaoconfirmationModal').modal('show');
});

// Confirm the action from the modal for admin
$('#confirmAction').click(function() {
    let url = (actionToTake === 'activate') ? '/admin/activate/' + adminIdToChange : '/admin/suspend/' + adminIdToChange;

    $.ajax({
        url: url,
        method: 'POST',
        data: { _token: '{{ csrf_token() }}' },
        success: function(response) {
            if (response.status === 'ACTIVE' || response.status === 'SUSPENDED') {
                let statusBadge = $('tr[data-admin-id="' + adminIdToChange + '"] .status-badge');
                statusBadge.text(response.status).removeClass('bg-danger bg-success').addClass(response.status === 'ACTIVE' ? 'bg-success' : 'bg-danger');
                
                // Update buttons based on status
                updateButtons(adminIdToChange, response.status, true);

                // Hide the confirmation modal after successful action
                $('#confirmationModal').modal('hide');
            }
        },
        error: function(xhr, status, error) {
            alert("An error occurred. Please try again.");
            console.error("Error:", error);
        }
    });
});

// Confirm the action from the modal for user
$('#PdaoconfirmAction').click(function() {
    let url = (actionToTakePdao === 'activate') ? '/user/activate/' + userIdToChange : '/user/suspend/' + userIdToChange;

    $.ajax({
        url: url,
        method: 'POST',
        data: { _token: '{{ csrf_token() }}' },
        success: function(response) {
            if (response.status === 'ACTIVE' || response.status === 'SUSPENDED') {
                let statusBadge = $('tr[data-user-id="' + userIdToChange + '"] .Pdao-status-badge');
                statusBadge.text(response.status).removeClass('bg-danger bg-success').addClass(response.status === 'ACTIVE' ? 'bg-success' : 'bg-danger');

                // Update buttons based on the new status
                updateButtons(userIdToChange, response.status, false);

                // Hide the confirmation modal after successful action
                $('#PdaoconfirmationModal').modal('hide');
            }
        },
        error: function(xhr, status, error) {
            alert("An error occurred. Please try again.");
            console.error("Error:", error);
        }
    });
});

    </script>

    </body>
    </html>
