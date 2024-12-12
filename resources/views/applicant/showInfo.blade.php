<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant Profile</title>
    <link rel="stylesheet" href="/CSS/viewstyle.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@400;700&display=swap">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .card {
            border: 1px solid #007bff;
            border-radius: 8px;
            background-color: #ffffff;
        }
        .profile-photo {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #007bff;
            margin-bottom: 20px;
        }
        .section-title {
            font-weight: bold;
            margin-top: 20px;
            color: #007bff;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
        }
        .field-label {
            font-weight: bold;
        }
        .bordered-section {
            border: 2px solid #007bff;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #ffffff;
        }
        .documents img {
            width: 100px;
            margin-right: 15px;
        }
        .doc-label {
            text-align: center; /* Center align text and images */
            margin-bottom: 20px; /* Space between document labels */
        }

        .modal img {
            max-width: 100%;
            height: auto;
        }
        .d-flex {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .profile-info {
            flex: 1;
        }
        .photo-container {
            flex-shrink: 0;
            text-align: center;
        }
        .doc-label img {
            width: 100px; /* Adjust width as needed */
            height: auto; /* Maintain aspect ratio */
        }

        .navbar-brand {
            font-weight: bold;
            color: #ffffff !important;
        }
        .navbar {
            background-color: #008080; /* Teal color */
        }
        .documents {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
    </style>
</head>
<body>

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

<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center">
            <h2 class="mb-0">Applicant Profile</h2>
        </div>
        <div class="card-body">
            <div class="bordered-section">
                <div class="section-title">Personal Information</div>
                <div class="d-flex">
                    <div class="profile-info">
                        <h3>{{ $applicant->LN . ' ' . $applicant->FN . ' ' . $applicant->MN }}</h3>
                        <p><span class="field-label">Track ID:</span> {{ $applicant->Track_id }}</p>
                        <p><span class="field-label">Applicant Type:</span> {{ $applicant->Applicant_type }}</p>
                        <p><span class="field-label">Date Applied:</span> {{ $applicant->Date_applied }}</p>
                        <p><span class="field-label">Date of Birth:</span> {{ $applicant->Date_of_birth }}</p>
                        <p><span class="field-label">Sex:</span> {{ $applicant->Sex }}</p>
                        <p><span class="field-label">Civil Status:</span> {{ $applicant->Civil_status }}</p>
                    </div>
                    <div class="photo-container mt-3">
                        <img src="{{ asset('storage/' . $applicant->IDpicture) }}" alt="ID Picture" class="profile-photo">
                    </div>
                </div>
            </div>

            <div class="bordered-section">
                <div class="section-title">Contact Information</div>
                <p>
                    <span class="field-label">Landline No:</span> {{ $applicant->Landline_No }} <br>
                    <span class="field-label">Mobile No:</span> {{ $applicant->Mobile_No }} <br>
                    <span class="field-label">Email Address:</span> {{ $applicant->Email_address }}
                </p>
            </div>

            <div class="bordered-section">
                <div class="section-title">Address</div>
                <p>
                    <span class="field-label">House No/Street:</span> {{ $applicant->HouseNo_Street }} <br>
                    <span class="field-label">Barangay:</span> {{ $applicant->Barangay }} <br>
                    <span class="field-label">Municipality:</span> {{ $applicant->Municipality }} <br>
                    <span class="field-label">Province:</span> {{ $applicant->Province }} <br>
                    <span class="field-label">Region:</span> {{ $applicant->Region }}
                </p>
            </div>

            <div class="bordered-section">
                <div class="section-title">Employment Information</div>
                <p>
                    <span class="field-label">Educational Attainment:</span> {{ $applicant->Educational_Attainment }} <br>
                    <span class="field-label">Status of Employment:</span> {{ $applicant->Status_of_Employment }} <br>
                    <span class="field-label">Category of Employment:</span> {{ $applicant->Category_of_Employment }} <br>
                    <span class="field-label">Type of Employment:</span> {{ $applicant->Type_of_Employment }} <br>
                    <span class="field-label">Occupation:</span> {{ $applicant->Occupation ?? 'N/A' }}
                </p>
            </div>

        <div class="bordered-section">
            <div class="section-title">Types of Disabilities</div>
                @if(count($diseases['disabilities']) > 0)
                    <ul>
                        @foreach($diseases['disabilities'] as $disability)
                            <li>{{ $disability }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>N/A</p>
                @endif
            </div>

        <div class="bordered-section">
            <div class="section-title">Congenital</div>
                @if(count($diseases['congenital']) > 0)
                    <ul>
                        @foreach($diseases['congenital'] as $congenital)
                            <li>{{ $congenital }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>N/A</p>
                @endif
            </div>

        <div class="bordered-section">
            <div class="section-title">Acquired</div>
                @if(count($diseases['acquired']) > 0)
                    <ul>
                        @foreach($diseases['acquired'] as $acquired)
                            <li>{{ $acquired }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>N/A</p>
                @endif
            </div>

            <div class="bordered-section">
                    <div class="section-title">Person In Contact</div>
                    <p>
                    <span class="field-label">Contact Person In Case of Emergeny & Number:</span> {{ $applicant->Contact_Emergency }} <br>
                    </p>
            </div>
            
            <div class="bordered-section">
                <div class="section-title">Documents</div>
                <div class="documents row">
                    <div class="doc-label col-md-3 text-center">
                        <span class="field-label">Birth Certificate:</span><br>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#birthCertModal">
                            <img src="{{ asset('storage/' . $applicant->Birth_Cert) }}" alt="Birth Certificate">
                        </a>
                    </div>
                    <div class="doc-label col-md-3 text-center">
                        <span class="field-label">Barangay Clearance:</span><br>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#brgyClearanceModal">
                            <img src="{{ asset('storage/' . $applicant->Brgy_Clearance) }}" alt="Barangay Clearance">
                        </a>
                    </div>
                    <div class="doc-label col-md-3 text-center">
                        <span class="field-label">Valid ID:</span><br>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#validIdModal">
                            <img src="{{ asset('storage/' . $applicant->Valid_id) }}" alt="Valid ID">
                        </a>
                    </div>
                    <div class="doc-label col-md-3 text-center">
                        <span class="field-label">Medical Assessment:</span><br>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#medicalAssessmentModal">
                            <img src="{{ asset('storage/' . $applicant->Medical_Assesment) }}" alt="Medical Assessment">
                        </a>
                    </div>
                    <div class="doc-label col-md-3 text-center">
                        <span class="field-label">Old City ID:</span><br>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#oldcityidModal">
                            <img src="{{ asset('storage/' . $applicant->old_city_id) }}" alt="Old City ID">
                        </a>
                    </div>
                </div>
            </div>
            <a href="{{ route('applicants.index') }}" class="btn btn-primary mt-3">Back to Applicants List</a>
            <!-- Approve Button -->
            <button type="button" class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#approveModal">
                Approve
            </button>

            <button type="button" class="btn btn-warning mt-3" data-bs-toggle="modal" data-bs-target="#pendingModal">
                Mark as Pending
            </button>
    </div>
</div>

<!-- Modals for documents -->
<div class="modal fade" id="birthCertModal" tabindex="-1" aria-labelledby="birthCertModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="birthCertModalLabel">Birth Certificate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="{{ asset('storage/' . $applicant->Birth_Cert) }}" alt="Birth Certificate" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="brgyClearanceModal" tabindex="-1" aria-labelledby="brgyClearanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="brgyClearanceModalLabel">Barangay Clearance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="{{ asset('storage/' . $applicant->Brgy_Clearance) }}" alt="Barangay Clearance" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="validIdModal" tabindex="-1" aria-labelledby="validIdModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="validIdModalLabel">Valid ID</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="{{ asset('storage/' . $applicant->Valid_id) }}" alt="Valid ID" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="medicalAssessmentModal" tabindex="-1" aria-labelledby="medicalAssessmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="medicalAssessmentModalLabel">Medical Assessment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="{{ asset('storage/' . $applicant->Medical_Assesment) }}" alt="Medical Assessment" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="oldcityidModal" tabindex="-1" aria-labelledby="oldcityidModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="oldcityidModalLabel">Old City ID</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="{{ asset('storage/' . $applicant->old_city_id) }}" alt="old_city_id" class="img-fluid">
            </div>
        </div>
    </div>
</div>


<!-- Modal for Approval -->
<div class="modal fade" id="pendingModal" tabindex="-1" aria-labelledby="pendingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pendingModalLabel">Mark as pending</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pending', $applicant->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="Remarks" class="form-label">Remarks/Reason for pending:</label>
                        <input type="text" class="form-control" id="Remarks" name="remarks">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>






<!-- Modal for Pending -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveModalLabel">Approve Applicant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="approveForm" action="{{ route('approve.applicant', $applicant->id) }}" method="POST" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label for="processingOfficer" class="form-label">Processing Officer</label>
                        <input type="text" class="form-control" id="processingOfficer" name="Process_Officer" required>
                    </div>
                    <div class="mb-3">
                        <label for="approvingOfficer" class="form-label">Approving Officer</label>
                        <input type="text" class="form-control" id="approvingOfficer" name="Approve_Officer" required>
                    </div>
                    <div class="mb-3">
                        <label for="encoder" class="form-label">Encoder</label>
                        <input type="text" class="form-control" id="encoder" name="Encoder" required>
                    </div>
                    <div class="mb-3">
                        <label for="reportingUnit" class="form-label">Name of Reporting Unit</label>
                        <input type="text" class="form-control" id="reportingUnit" name="Reporting_Unit" required>
                    </div>
                    <div class="mb-3">
                        <label for="reportingOffice" class="form-label">Name of Reporting Office</label>
                        <input type="text" class="form-control" id="reportingOffice" name="Reporting_Office" required>
                    </div>
                    <div class="mb-3">
                        <label for="controlNo" class="form-label">Control No</label>
                        <input type="text" class="form-control" id="controlNo" name="Control_No" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Error Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="errorModalLabel">Validation Errors</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul id="errorList" class="text-danger"></ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('approveForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent form submission

        let form = e.target;
        let fields = form.querySelectorAll('[required]');
        let errors = [];
        let firstInvalidField = null;

        // Validate each required field
        fields.forEach(function (field) {
            if (!field.value.trim()) {
                errors.push(field.previousElementSibling.textContent + ' is required.');
                field.classList.add('is-invalid');
                if (!firstInvalidField) {
                    firstInvalidField = field;
                }
            } else {
                field.classList.remove('is-invalid');
            }
        });

        if (errors.length > 0) {
            // Display errors in the modal
            let errorList = document.getElementById('errorList');
            errorList.innerHTML = errors.map(error => `<li>${error}</li>`).join('');
            new bootstrap.Modal(document.getElementById('errorModal')).show();

            // Focus on the first invalid field
            if (firstInvalidField) {
                firstInvalidField.focus();
            }
        } else {
            form.submit(); // If no errors, proceed with form submission
        }
    });
</script>
</body>
</html>
