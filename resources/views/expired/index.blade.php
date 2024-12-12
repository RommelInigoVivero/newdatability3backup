<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicants Data</title>
    
    <link rel="stylesheet" href="/CSS/viewstyle.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

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
                <li class="nav-item {{ request()->is('expired-records') ? 'active' : '' }}">
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

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Archived Data</h1>
    <div class="d-flex align-items-center">
        <form action="" method="GET" class="d-flex align-items-center" style="margin-right: 15px;">
            <div class="input-group">
                <input type="text" id="search" class="form-control" placeholder="Search by Name or PWD ID">
                <button type="submit" class="input-group-text btn btn-outline-secondary material-symbols-outlined" style="border: none;">
                    search
                </button>
            </div>
        </form>

        <!-- Existing Buttons -->
        
        <!-- <button id="deleteSelected" class="btn btn-danger" style="margin-right: 15px; white-space: nowrap;">Delete</button> -->

        <form id="exportForm" action="{{ route('expired.export') }}" method="POST">
            @csrf
            <input type="hidden" id="selectedIds" name="ids" value="[]">
            <button type="submit" class="btn btn-warning" style="margin-right: 15px; white-space: nowrap;">Export</button>
        </form>
            <button id="restore" class="btn btn-primary">Restore to Database</button>
    </div>
</div>


<div class="container mt-5">
<form action="{{route('filter.expire')}}" method="GET">
    <div class="dropdown">
    <div class="dropdown-label">Select Applicant Types</div>
    <div class="checkboxes">

        <label>
            <input type="checkbox" name="applicant_types[]" value="New Applicant" style="margin-right: 10px;" 
                   {{ (in_array('New Applicant', $applicantTypes ?? []) ? 'checked' : '') }}>
            NEW APPLICANT
        </label>

        <label>
            <input type="checkbox" name="applicant_types[]" value="Active" style="margin-right: 10px;" 
                   {{ (in_array('Active', $applicantTypes ?? []) ? 'checked' : '') }}>
            Active
        </label>

        <label>
            <input type="checkbox" name="applicant_types[]" value="Transferee" style="margin-right: 10px;" 
                   {{ (in_array('Transferee', $applicantTypes ?? []) ? 'checked' : '') }}>
            Transferee
        </label>

        <label>
            <input type="checkbox" name="applicant_types[]" value="Active Transferee" style="margin-right: 10px;" 
                   {{ (in_array('Active Transferee', $applicantTypes ?? []) ? 'checked' : '') }}>
            Active Transferee
        </label>

        <label>
            <input type="checkbox" name="applicant_types[]" value="Expired" style="margin-right: 10px;" 
                   {{ (in_array('Expired', $applicantTypes ?? []) ? 'checked' : '') }}>
                Expired
        </label>

        <label>
            <input type="checkbox" name="applicant_types[]" value="Expired Transferee" style="margin-right: 10px;" 
                   {{ (in_array('Expired Transferee', $applicantTypes ?? []) ? 'checked' : '') }}>
                Expired Transferee
        </label>
    </div>
</div>

        <label>Barangay</label>
            <select name="Barangay" style="border: none; border-bottom: 1px solid #000;">
                <option value="">None</option>
            
                <option value="Baclaran"{{request()->get('Barangay')=='Baclaran'? 'selected':''}}>Baclaran</option>
                <option value="BF Homes"{{request()->get('Barangay')=='BF Homes'? 'selected':''}}>BF Homes</option>
                <option value="Don Bosco"{{request()->get('Barangay')=='Don Bosco'? 'selected':''}}>Don Bosco</option>
                <option value="Don Galo"{{request()->get('Barangay')=='Don Galo'? 'selected':''}}>Don Galo</option>
                <option value="La Huerta"{{request()->get('Barangay')=='La Huerta'? 'selected':''}}>La Huerta</option>
                <option value="Marcelo Green"{{request()->get('Barangay')=='Marcelo Green'? 'selected':''}}>Marcelo Green</option>
                <option value="Merville"{{request()->get('Barangay')=='Merville'? 'selected':''}}>Merville</option>
                <option value="Moonwalk"{{request()->get('Barangay')=='Moonwalk'? 'selected':''}}>Moonwalk</option>
                <option value="San Antonio"{{request()->get('Barangay')=='San Antonio'? 'selected':''}}>San Antonio</option>
                <option value="San Dionisio"{{request()->get('Barangay')=='San Dionisio'? 'selected':''}}>San Dionisio</option>
                <option value="San Isidro"{{request()->get('Barangay')=='San Isidro'? 'selected':''}}>San Isidro</option>
                <option value="San Martin de Porres"{{request()->get('Barangay')=='San Martin de Porres'? 'selected':''}}>San Martin de Porres</option>
                <option value="Santo Niño"{{request()->get('Barangay')=='Santo Niño'? 'selected':''}}>Santo Niño</option>
                <option value="Sun Valley"{{request()->get('Barangay')=='Sun Valley'? 'selected':''}}>Sun Valley</option>
                <option value="Tambo"{{request()->get('Barangay')=='Tambo'? 'selected':''}}>Tambo</option>
                <option value="Vitalez" {{request()->get('Barangay')=='Vitalez'? 'selected':''}}>Vitalez</option>
                
            </select>
        <label>Disabilities</label>
            <select name="Disabilities"style="border: none; border-bottom: 1px solid #000;">
                <option value="">All Disabilities</option>

                <optgroup label="TYPE OF DISABILITY">
                    <option value="deaf" {{ request()->get('Disabilities') == 'deaf' ? 'selected' : '' }}>Deaf or Hard of Hearing</option>
                    <option value="intellectual" {{ request()->get('Disabilities') == 'intellectual' ? 'selected' : '' }}>Intellectual Disability</option>
                    <option value="learning" {{ request()->get('Disabilities') == 'learning' ? 'selected' : '' }}>Learning Disability</option>
                    <option value="mental" {{ request()->get('Disabilities') == 'mental' ? 'selected' : '' }}>Mental Disability</option>
                    <option value="physical" {{ request()->get('Disabilities') == 'physical' ? 'selected' : '' }}>Physical Disability</option>
                    <option value="psychosocial" {{ request()->get('Disabilities') == 'psychosocial' ? 'selected' : '' }}>Psychosocial Disability</option>
                    <option value="speech" {{ request()->get('Disabilities') == 'speech' ? 'selected' : '' }}>Speech and Language Impairment</option>
                    <option value="visual" {{ request()->get('Disabilities') == 'visual' ? 'selected' : '' }}>Visual Disability</option>
                    <option value="cancer" {{ request()->get('Disabilities') == 'cancer' ? 'selected' : '' }}>Cancer</option>
                    <option value="rare" {{ request()->get('Disabilities') == 'rare' ? 'selected' : '' }}>Rare Disease</option>
                </optgroup>
                
                <optgroup label="Congenital">
                    <option value="adhd" {{ request()->get('Disabilities') == 'adhd' ? 'selected' : '' }}>ADHD</option>
                    <option value="cp" {{ request()->get('Disabilities') == 'cp' ? 'selected' : '' }}>Cerebral Palsy</option>
                    <option value="down" {{ request()->get('Disabilities') == 'down' ? 'selected' : '' }}>Down Syndrome</option>
                    <option value="others" {{ request()->get('Disabilities') == 'others' ? 'selected' : '' }}>Others</option>
                </optgroup>

                <optgroup label="Acquired">
                    <option value="chronic" {{ request()->get('Disabilities') == 'chronic' ? 'selected' : '' }}>Chronic Illness</option>
                    <option value="cp2" {{ request()->get('Disabilities') == 'cp' ? 'selected' : '' }}>Cerebral Palsy</option>
                    <option value="injury" {{ request()->get('Disabilities') == 'injury' ? 'selected' : '' }}>Injury</option>
                    <option value="others2" {{ request()->get('Disabilities') == 'others' ? 'selected' : '' }}>Others</option>
                </optgroup>
            </select>
        <button type="submit">Filter</button>
    </form>
</div>
<table class="table table-bordered" id="expiredDataTable">
    <thead>
        <tr>
            <th><input type="checkbox" id="selectAll"></th> <!-- Checkbox for selecting all -->
            <th>PWD ID</th>
            <th>Applicant Type</th>
            <th>Full Name</th>
            <th>Age</th>
            <th>Date Applied</th>
           

        </tr>
    </thead>
    <tbody>
        @foreach($expiredRecords as $record)
            <tr>
            <td><input type="checkbox" class="record-checkbox" name="selected_ids[]" value="{{ $record->id }}"></td><!-- Individual checkbox for each record -->
                <td>{{ $record->PWD_id }}</td>
                <td>{{ $record->Applicant_type }}</td>
                <td>{{ $record->FN }} {{ $record->MN }} {{ $record->LN }}</td>
                <td>{{ (int)\Carbon\Carbon::parse($record->Date_of_birth)->diffInYears(\Carbon\Carbon::now()) }}</td>
                <td>{{ \Carbon\Carbon::parse($record->Date_applied)->format('Y-m-d') }}</td>

               
            </tr>
        @endforeach
    </tbody>
</table>
</div>
<div class="modal fade" id="noSelectionModal" tabindex="-1" aria-labelledby="noSelectionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noSelectionModalLabel">No Selection</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Please select at least one record to Restore.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal HTML -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul>
                    <!-- Loop through validation errors and display them -->
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Check if there are any errors and trigger the modal if so -->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>

document.getElementById('exportForm').addEventListener('submit', function(event) {
    // Collect the IDs of the selected checkboxes
    const selectedIds = [];
    const checkboxes = document.querySelectorAll('input[name="selected_ids[]"]:checked'); // Match the name attribute here

    checkboxes.forEach((checkbox) => {
        selectedIds.push(checkbox.value);
    });

    // If no checkbox is selected, prevent the form from submitting
    if (selectedIds.length === 0) {
        alert('Please select at least one record to export.'); // Changed alert message for clarity
        event.preventDefault(); // Prevent form submission
    } else {
        // Set the selected IDs to the hidden input
        document.getElementById('selectedIds').value = JSON.stringify(selectedIds); // Match the ID of the hidden input
    }
});

    // JavaScript to handle "Select All" checkbox functionality
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.record-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    $(document).ready(function() {
    $('#restore').click(function() {
        var selectedIds = [];
        $('.record-checkbox:checked').each(function() {
            selectedIds.push($(this).val());
        });

        if (selectedIds.length === 0) {
            $('#noSelectionModal').modal('show'); // Show alert if no selection
        } else {
            $.ajax({
                url: '{{ route("restore.records") }}', // Use named route for clarity
                method: 'POST',
                data: {
                    ids: selectedIds,
                    _token: '{{ csrf_token() }}' // Include CSRF token
                },
                success: function(response) {
                    // Redirect to the expired records page
                    window.location.href = '{{ route("views") }}'; // Change this to your expired records route
                },
                error: function(xhr) {
                    // Handle error response
                    var errorModalBody = $('#errorModal .modal-body ul');
                    errorModalBody.empty(); // Clear previous errors

                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var errorList = xhr.responseJSON.errors;
                        errorList.forEach(function(error) {
                            errorModalBody.append('<li>' + error + '</li>');
                        });
                        var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                        errorModal.show();
                    } else {
                        console.error(xhr.responseText); // Log for other errors
                    }
                }
            });
        }
    });
});

</script>



</body>
</html>
