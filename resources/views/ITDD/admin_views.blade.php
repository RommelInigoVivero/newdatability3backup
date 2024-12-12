<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicants Data</title>
    <link rel="stylesheet" href="/CSS/adminviewstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>

<style>
    

</style>
<body>

<nav class="navbar navbar-expand-lg" style="background-color: #333;"> 
    <div class="container">
        <a class="navbar-brand text-white" href="#"> 
            PDAO DATABASE MANAGEMENT
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center" href="{{ route('ITDD.dashboard') }}">
                        <span class="material-symbols-outlined me-1">home</span>Home
                    </a>
                </li>

            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" id="settingsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
        <h1 class="mb-0">Clients Data</h1>
        <div class="d-flex align-items-center">
            <div class="input-group me-3">
                <input type="text" id="search" class="form-control rounded" placeholder="Search by Name or PWD ID" aria-label="Search Clients">
            </div>
        </div>
    </div>
</div>


<div class="container mt-5">
    <form action="{{route('admin-views')}}" method="GET">
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
    <div class="container mt-4"> <!-- Top margin for spacing -->
    <table class="table table-bordered table-striped table-hover table-sm mx-1" id="dataTable"> <!-- Added horizontal margins -->
        <thead class="thead-light" style="text-align:center">
            <tr>

                <th scope="col">PWD ID</th>
                <th scope="col">Print</th>
                <th scope="col">Applicant Type</th>
                <th scope="col">Full Name</th>
                <th scope="col">Age</th>
                <th scope="col">Date Applied</th>
                <th scope="col">Date Renewed</th>
                <th scope="col">Expiry Date</th>
                <th scope="col">View</th>

            </tr>
        </thead>
        <tbody style="text-align:center">
        @foreach($dataForms as $form)
            @php
                $expiryDate = $form->Date_renewed 
                    ? \Carbon\Carbon::parse($form->Date_renewed)->addYears(5) 
                    : \Carbon\Carbon::parse($form->Date_applied)->addYears(5);
                $isExpired = $expiryDate->isPast();
                $isActive = $form->Applicant_type === 'Active';
            @endphp
            <tr class="{{ ($isExpired && !$isActive) ? 'expired-row' : '' }}">
                <td>{{ $form->PWD_id }}</td>
                <td>
                    <a href="{{ route('form.preview', $form->id) }}" title="Print Preview">
                        <span class="material-symbols-outlined">print</span>
                    </a>
                </td>
                <td>{{ $form->Applicant_type }}</td>
                <td>{{ $form->FN }} {{ $form->MN }} {{ $form->LN }}</td>
                <td>{{ (int)\Carbon\Carbon::parse($form->Date_of_birth)->diffInYears(\Carbon\Carbon::now()) }}</td>
                <td>{{ \Carbon\Carbon::parse($form->Date_applied)->format('Y-m-d') }}</td>
                <td>{{ $form->Date_renewed ? \Carbon\Carbon::parse($form->Date_renewed)->format('Y-m-d') : 'NONE' }}</td>
                <td>{{ $expiryDate->format('Y-m-d') }}</td>
                <td>
                    <button class="btn btn-info btn-sm view-details custom-button" data-id="{{ $form->id }}" title="View Details">Details</button>
                    <button class="btn btn-secondary btn-sm view-diseases custom-button" data-id="{{ $form->id }}" title="View Disabilities">Disabilities</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3">
        {{ $dataForms->links('vendor.pagination.bootstrap-5') }} <!-- This will generate pagination links -->
    </div>
</div>




<div class="modal fade" id="userDetailsModal" tabindex="-1" aria-labelledby="userDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title" id="userDetailsModalLabel">User Details</h5>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="card-title">Personal Information</h6>
                                <p><strong>PWD ID:</strong> <span id="modalPWD_id"></span></p>
                                <p><strong>Date of Birth:</strong> <span id="modalDate_of_birth"></span></p>
                                <p><strong>Sex:</strong> <span id="modalSex"></span></p>
                                <p><strong>Civil Status:</strong> <span id="modalCivil_status"></span></p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="card-title">Contact Information:</h6>
                                <p><strong>Landline:</strong> <span id="modalLandline"></span></p>
                                <p><strong>Mobile:</strong> <span id="modalMobile"></span></p>
                                <p><strong>Email:</strong> <span id="modalEmail"></span></p>
                            </div>
                        </div>

                        <h6 class="card-title mt-4">Address Information</h6>
                        <p><strong>Address:</strong> <span id="modalAddress"></span></p>

                        <h6 class="card-title mt-4">Employment Information</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Educational Attainment:</strong> <span id="modalEducational_Attainment"></span></p>
                                <p><strong>Status of Employment:</strong> <span id="modalStatus_of_Employment"></span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Category of Employment:</strong> <span id="modalCategory_of_Employment"></span></p>
                                <p><strong>Type of Employment:</strong> <span id="modalType_of_Employment"></span></p>
                                <p><strong>Occupation:</strong> <span id="modalOccupation"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <!-- Fix for Close Button -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Diseases Modal -->
<div class="modal fade" id="diseasesModal" tabindex="-1" aria-labelledby="diseasesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="diseasesModalLabel">List of Diseases</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header bg-primary text-white">
                                <h6>Types of Disabilities</h6>
                            </div>
                            <div class="card-body">
                                <div id="disabilityList" class="disease-content"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header bg-warning text-white">
                                <h6>Congenital Diseases</h6>
                            </div>
                            <div class="card-body">
                                <div id="congenitalDiseasesList" class="disease-content"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header bg-success text-white">
                                <h6>Acquired Diseases</h6>
                            </div>
                            <div class="card-body">
                                <div id="acquiredDiseasesList" class="disease-content"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap JS and dependencies -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS and Popper -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>


    $(document).ready(function() {
        // Select all checkboxes
        $('#selectAll').change(function() {
            $('.record-checkbox').prop('checked', this.checked);
        });

        // Live search functionality
        $('#search').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('#dataTable tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });


        // View Details button click handler
        $(document).on('click', '.view-details', function() {
            var id = $(this).data('id');
            
            // Fetch user details
            $.ajax({
                url: '{{ route("getUserDetails", ":id") }}'.replace(':id', id),
                method: 'GET',
                success: function(response) {
                    // Populate the modal fields
                    $('#modalPWD_id').text(response.PWD_id);
                    $('#modalDate_of_birth').text(response.Date_of_birth);
                    $('#modalSex').text(response.Sex);
                    $('#modalCivil_status').text(response.Civil_status);
                    $('#modalAddress').text(response.HouseNo_Street + ', ' + response.Barangay + ', ' + response.Municipality + ', ' + response.Province + ', ' + response.Region);
                    $('#modalLandline').text(response.Landline_No || 'NONE');
                    $('#modalMobile').text(response.Mobile_No || 'NONE');
                    $('#modalEmail').text(response.Email_address || 'NONE');
                    $('#modalEducational_Attainment').text(response.Educational_Attainment);
                    $('#modalStatus_of_Employment').text(response.Status_of_Employment);
                    $('#modalCategory_of_Employment').text(response.Category_of_Employment);
                    $('#modalType_of_Employment').text(response.Type_of_Employment);
                    $('#modalOccupation').text(response.Occupation);

                    // Show the user details modal
                    $('#userDetailsModal').modal('show');
                },
                error: function(xhr) {
                    console.error(xhr);
                }
            });
        });

        // View Diseases button
        $(document).on('click', '.view-diseases', function() {
            var id = $(this).data('id');

            // Fetch 
            $.ajax({
                url: '{{ route("getDiseases", ":id") }}'.replace(':id', id),
                method: 'GET',
                success: function(response) {
                    // Populate the modal lists
                    $('#disabilityList').empty();
                    $.each(response.disabilities, function(key, value) {
                        $('#disabilityList').append('<li>' + key + '</li>'); 
                    });
                    $('#congenitalDiseasesList').empty();
                    $.each(response.congenital, function(key, value) {
                        if (value) {
                            $('#congenitalDiseasesList').append('<li>' + value + '</li>'); 
                        }
                    });
                    $('#acquiredDiseasesList').empty();
                    $.each(response.acquired, function(key, value) {
                        if (value) {
                            $('#acquiredDiseasesList').append('<li>' + value + '</li>'); 
                        }
                    });

                    // Show the diseases modal
                    $('#diseasesModal').modal('show');
                },
                error: function(xhr) {
                    console.error(xhr);
                }
            });
        });

        // Prevent checkbox click from triggering the row click
        $(document).on('click', '.record-checkbox', function(event) {
            event.stopPropagation(); // Prevent the row click event from firing
        });

        // Delete selected records
        $('#deleteSelected').click(function() {
            var selected = $('.record-checkbox:checked');
            if (selected.length > 0) {
                $('#deleteModal').modal('show');
            } else {
                $('#noSelectionModal').modal('show');
            }
        });

        // Confirm delete action
        $('#confirmDelete').click(function() {
            var ids = $('.record-checkbox:checked').map(function() {
                return $(this).val();
            }).get();

            // Perform AJAX delete operation here
            $.ajax({
                url: '{{ route("dataforms.bulkDelete") }}',
                method: 'POST',
                data: { ids: ids, _token: '{{ csrf_token() }}' },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    console.error(xhr);
                }
            });
        });
    });
</script>
</body>
</html>
