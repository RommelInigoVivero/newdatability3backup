<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PWD ONLINE APPLICATION</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="/CSS/applicants.css">
</head>
<body>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Modal -->
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

    <div class="container">
        <div class="form-container">
            <div class="card form-card shadow-lg">
                <div class="card-body">
                <div class="card-body" style="background-color: #1b7402; color: white;">
                    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <img src="/CSS/PQUE-LOGO.png" id="PQUE_LOGO" class="logo mb-3 mb-md-0" style="max-width: 150px;">

                        <div class="text-center mb-3 mb-md-0">
                            <h1>DEPARTMENT OF HEALTH</h1>
                            <h6 class="mb-4">Philippine Registry for Persons with Disabilities</h6>
                            <h1 class="mb-3">Application Forms</h1>
                        </div>

                        <img src="/CSS/PDAOLOGO.png" id="PDAOLOGO" class="logo mb-3 mb-md-0" style="max-width: 150px;">
                    </div>
                </div>

                    <!-- Modal for Validation Errors -->
                    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #1b7402; color: white;">
                                    <h5 class="modal-title" id="errorModalLabel">Notification</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" id="errorModalBody">
                                    <!-- Error messages will be injected here -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form id="multiStepForm" action={{route('create.applicants')}} method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="step active" id="step1">
                            <div class="form-step applicant-section" style="display: flex; flex-direction: column; align-items: center; background-color: #e1f5e3;">
                                <div class="applicant-content" style="text-align: center;">
                                <h3 class="step-header" style="font-size: 40px;">Applicant Type*</h3> <!-- Increased font size -->
                                    <div class="mb-3">
                                        <select id="Applicant_type" name="Applicant_type" class="form-control" required style="width: 350px;" onchange="toggleOldCityID()">
                                            <option value="" disabled selected>-- Select Application Type --</option>
                                            <option value="New Applicant">New Applicant</option>
                                            <option value="Transferee">Transferee</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="button-group">
                            <button type="button" class="btn btn-danger" onclick="window.location.href='https://paranaquecity.gov.ph/'">Return</button>
                            <button type="button" class="btn btn-success btn-step" onclick="nextStep(2)">Next</button>
                            </div>
                        </div>



                        <!-- Step 2: Personal Information -->
                        <div class="step" id="step2">
                            <div class="form-step applicant-section" style="background-color: #e1f5e3;">
                                <div class="applicant-content col-12 col-md-6">
                                    <h3 class="step-header">Personal Information</h3>
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Last Name:*</label>
                                        <input type="text" class="form-control" id="last_name" name="LN" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">First Name:*</label>
                                        <input type="text" class="form-control" id="first_name" name="FN" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="middle_name" class="form-label">Middle Name:*</label>
                                        <input type="text" class="form-control" id="middle_name" name="MN" >
                                    </div>
                                    <div class="mb-3">
                                        <label for="suffix" class="form-label">Suffix:*</label>
                                        <input type="text" class="form-control" id="suffix" name="suffix">
                                    </div>
                                    <div class="row">
                                        <div class="applicant-content col-12 col-md-6">
                                            <div class="mb-3">
                                                <label for="dateofbirth">Date of Birth:*</label>
                                                <input type="date" class="form-control" id="Date_of_birth" name="Date_of_birth" required max="{{ date('Y-m-d') }}">
                                            </div>
                                        </div>
                                        <div class="applicant-content col-12 col-md-6">
                                            <div class="mb-3">
                                                <label for="gender">Sex:*</label>
                                                <select id="gender" name="Sex" class="form-control" required>
                                                    <option value=""disabled selected>-- Select Gender --</option>
                                                    <option value="MALE">MALE</option>
                                                    <option value="FEMALE">FEMALE</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="applicant-content col-12 col-md-6">
                                            <div class="mb-3">
                                                <label for="civil_status">Civil Status:*</label>
                                                <select id="civil_status" name="Civil_status" class="form-control" required>
                                                    <option value=""disabled selected>-- Select Civil Status --</option>
                                                    <option value="SINGLE">SINGLE</option>
                                                    <option value="SEPARATED">SEPARATED</option>
                                                    <option value="COHABITATION">COHABITATION</option>
                                                    <option value="MARRIED">MARRIED</option>
                                                    <option value="WIDOW/ER">WIDOW/ER</option>
                                                </select>
                                            </div>
                                        </div> 
                                    </div>
                                </div>

                                <!-- ID Picture Upload Section -->
                                <div class="id-picture">
                                    <h6 class="step-header">ID Picture (1x1)*</h6>
                                    <img id="preview1" src="https://via.placeholder.com/150" alt="Preview 1" style="width: 150px; height: 150px;">
                                    <input type="file" class="form-control file-upload" name="IDpicture" accept="image/*" onchange="previewImage(event, 'preview1')" required>
                                </div>
                            </div>

                            <div class="button-group">
                                <button type="button" class="btn btn-primary btn-step" onclick="nextStep(1)">Back</button>
                                <button type="button" class="btn btn-success btn-step" onclick="nextStep(3)">Next</button>
                            </div>
                        </div>

                        <!-- Step 3: Address Information -->
                        <div class="step" id="step3">
                            <div class="form-step applicant-section"style="background-color: #e1f5e3;">
                                <div class="applicant-content col-12 col-md-6">
                                    <h3 class="step-header">Residence Address</h3>
                                    <div class="mb-3">
                                        <label for="street">House No.:*</label>
                                        <input type="text" class="form-control" id="street" name="HouseNo_Street" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="barangay">Barangay:*</label>
                                        <select name="Barangay" id="Brgy" class="form-control" required>
                                        <option value=""disabled selected>-- Select Barangay --</option>
                                            <option value="Baclaran">Baclaran</option >
                                            <option value="BF Homes">BF Homes</option >
                                            <option value="Don Bosco">Don Bosco</option >
                                            <option value="Don Galo">Don Galo</option >
                                            <option value="La Huerta">La Huerta</option >
                                            <option value="Marcelo Green">Marcelo Green</option >
                                            <option value="Merville">Merville</option >
                                            <option value="Moonwalk">Moonwalk</option >
                                            <option value="San Antonio">San Antonio</option >
                                            <option value="San Dionisio">San Dionisio</option >
                                            <option value="San Isidro">San Isidro</option >
                                            <option value="San Martin de Porres">San Martin de Porres</option >
                                            <option value="Santo Niño">Santo Niño</option >
                                            <option value="Sun Valley">Sun Valley</option >
                                            <option value="Tambo">Tambo</option >
                                            <option value="Vitalez">Vitalez</option >
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Municipality*</label>
                                        <input type="text" class="form-control" name="Municipality" value="Parañaque" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label>Province*</label>
                                        <input type="text" class="form-control" name="Province" value="Metro Manila" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label>Region*</label>
                                        <input type="text" class="form-control" name="Region" value="NCR" readonly>
                                    </div>
                                </div>

                                <div class="applicant-content col-12 col-md-6">
                                    <h3 class="step-header">Contact Details</h3>
                                    <div class="mb-3">
                                        <label >Landline Number:</label>
                                        <input type="text" class="form-control" id="Landline_No" name="Landline_No" >
                                    </div>

                                    <div class="mb-3">
                                        <label >Mobile Number:</label>
                                        <input type="text" class="form-control" id="Mobile_No" name="Mobile_No" maxlength="11" oninput="this.value=this.value.replace(/[^0-9]/g, '')">
                                    </div>

                                    <div class="mb-3">
                                        <label >Email Address:</label>
                                        <input type="text" class="form-control" id="Email_address" name="Email_address" >
                                    </div>
                                </div>
                            </div>

                            <div class="button-group">
                                <button type="button" class="btn btn-primary btn-step" onclick="nextStep(2)">Back</button>
                                <button type="button" class="btn btn-success btn-step" onclick="nextStep(4)">Next</button>
                            </div>
                        </div>

                        <!-- Step 4 -->
                        <div class="step" id="step4">
                            <div class="form-step applicant-section"style="background-color: #e1f5e3;">
                                <h3 class="step-header">TYPES OF DISABILITY</h3>
                                <div class="row w-100"> <!-- Ensures the row takes full width -->
                                    <div class="col-12 col-md-6 applicant-content">
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="Deaf" value="1">
                                                <label class="form-check-label">Deaf or Hard of Hearing</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="Intellectual" value="1">
                                                <label class="form-check-label">Intellectual Disability</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="Learning" value="1">
                                                <label class="form-check-label">Learning Disability</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="Mental" value="1">
                                                <label class="form-check-label">Mental Disability</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="Physical" value="1">
                                                <label class="form-check-label">Physical Disability (Orthopedic)</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 applicant-content">
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="Psychosocial" value="1">
                                                <label class="form-check-label">Psychosocial Disability</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="Speech_and_Language" value="1">
                                                <label class="form-check-label">Speech and Language Impairment</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="Visual" value="1">
                                                <label class="form-check-label">Visual Disability</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="Cancer" value="1">
                                                <label class="form-check-label">Cancer (RA11215)</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="Rare_Disease" value="1">
                                                <label class="form-check-label">Rare Disease (RA10747)</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h3 class="step-header">CAUSE OF DISABILITY</h3>
                                <div class="row w-100"> <!-- New row for causes -->
                                    <div class="col-12 col-md-6 applicant-content">
                                        <div class="form-check">
                                            <h3 class="step-header">Congenital/Inborn</h3>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="Congenital_ADHD" value="1">
                                            <label class="form-check-label">ADHD</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="Congenital_Cerebral" value="1">
                                            <label class="form-check-label">Cerebral Palsy</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="Congenital_Down" value="1">
                                            <label class="form-check-label">Down Syndrome</label>
                                        </div>

                                        <div class="form-check">
                                            <label class="form-check-label" for="disability-others">Others, Specify:</label>
                                            <div class="d-flex align-items-center"> <!-- Flexbox for layout -->
                                                <input type="text" class="custom-input flex-grow-1" name="Congenital_Others" placeholder="Specify here">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 applicant-content">
                                        <div class="form-check">
                                            <h3 class="step-header">Acquired</h3>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="Acquired_Chronic" value="1">
                                            <label class="form-check-label">Chronic Illness</label>
                                        </div>

                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="Acquired_Cerebral" value="1">
                                            <label class="form-check-label">Cerebral Palsy</label>
                                        </div>

                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="Acquired_Injury" value="1">
                                            <label class="form-check-label">Injury</label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label" for="disability-others">Others, Specify:</label>
                                            <div class="d-flex align-items-center"> <!-- Flexbox for layout -->
                                                <input type="text" class="custom-input flex-grow-1" name="Acquired_Others" placeholder="Specify here">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-group">
                                <button type="button" class="btn btn-primary btn-step" onclick="nextStep(3)">Back</button>
                                <button type="button" class="btn btn-success btn-step" onclick="nextStep(5)">Next</button>
                            </div>
                        </div>

                        <!-- step 5 -->
                         <div class="step" id="step5">
                            <div class="form-step applicant-section"style="background-color: #e1f5e3;">
                                <div class="applicant-content col-12 col-md-6">
                                    <h3 class="step-header">Educational Attainment*</h3>
                                    <label for="Educational Attainment">Educational Attainment</label>
                                    <select name="Educational_Attainment" class="form-control" required>
                                        <option value="" disabled selected>Select your educational attainment</option>
                                        <option value="NONE">None</option>
                                        <option value="KINDERGARTEN">Kindergarten</option>
                                        <option value="ELEMENTARY">Elementary</option>
                                        <option value="JUNIOR HIGH SCHOOL">Junior High School</option>
                                        <option value="SENIOR HIGH SCHOOL">Senior High School</option>
                                        <option value="COLLEGE">College</option>
                                        <option value="VOCATIONAL">Vocational</option>
                                        <option value="POST GRADUATE">Post Graduate</option>
                                    </select>
                                </div>

                                <div class="applicant-content col-12 col-md-6">
                                    <h3 class="step-header">Status Of Emplyment*</h3>
                                    <label for="Educational Attainment">Status Of Emplyment</label>
                                    <select name="Status_of_Employment" class="form-control" required>
                                        <option value="" disabled selected>Select your employment status</option>
                                        <option value="EMPLOYED">Employed</option>
                                        <option value="UNEMPLOYED">Unemployed</option>
                                        <option value="SELF-EMPLOYED">Self-Employed</option>
                                    </select>
                                </div>

                                <div class="row w-100 mt-4">
                                    <div class="col-12 col-md-6 applicant-content">
                                    <h3 class="step-header">Types of Employment*</h3>
                                    <label for="Type_of_Employment">Types of Employment</label>
                                        <select name="Type_of_Employment" class="form-control" required>
                                            <option value="" disabled selected>Select type of employment</option>
                                            <option value="PERMANENT">Permanent</option>
                                            <option value="SEASONAL">Seasonal</option>
                                            <option value="CASUAL">Casual</option>
                                            <option value="EMERGENCY">Emergency</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-6 applicant-content">
                                    <h3 class="step-header">Category of Employement*</h3>
                                    <label for="Category_of_Employment ">Category of Employement</label>
                                        <select name="Category_of_Employment" class="form-control" required>
                                            <option value="" disabled selected>Select category of employment</option>
                                            <option value="GOVERNMENT">Government</option>
                                            <option value="PRIVATE">Private</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 applicant-content">
                                    <h3 class="step-header">Occupation*</h3>
                                    <label for="Occupation">Occupation</label>
                                    <select name="Occupation" class="form-control" id="OccupationSelect" required>
                                        <option value="" disabled selected>Select your occupation</option>
                                        <option value="MANAGER">Managers</option>
                                        <option value="PROFESSIONALS">Professionals</option>
                                        <option value="TECHNICAL AND ASSOCIATIVE PROFESSIONALS">Technical and Associative Professionals</option>
                                        <option value="CLERICAL SUPPORT WORKERS">Clerical Support Workers</option>
                                        <option value="SERVICE AND SALES WORKERS">Service and Sales Workers</option>
                                        <option value="SKILLED AGRICULTURAL, FORESTRY AND FISHERY WORKERS">Skilled Agricultural, Forestry and Fishery Workers</option>
                                        <option value="CRAFT AND TRADE WORKERS">Craft and Related Trade Workers</option>
                                        <option value="ELEMENTARY OCCUPATIONS">Elementary Occupations</option>
                                        <option value="ARMED FORCES OCCUPATIONS">Armed Forces Occupations</option>
                                        <option value="Others">Others, Specify</option>
                                    </select>

                                    <div id="otherOccupationInput" style="display: none;">
                                        <label>Others, Specify</label>
                                        <input type="text" style="margin-bottom: 15px;" class="form-control" id="JobOthersInput" placeholder="Specify your occupation">
                                    </div>
                                </div>

                            </div>
                            <div class="button-group">
                                <button type="button" class="btn btn-primary btn-step" onclick="nextStep(4)">Back</button>
                                <button type="button" class="btn btn-success btn-step" onclick="nextStep(6)">Next</button>
                            </div>
                         </div>
                         <div class="step" id="step6">
                            <div class="form-step applicant-section" style="background-color: #e1f5e3;">
                                <div class="row">
                                    <!-- Organization Information Section (Two Columns) -->
                                    <div class="col-12 col-md-6">
                                        <h3 class="step-header">Additional Information (OPTIONAL)</h3>
                                        <div class="mb-3">
                                            <strong>Organization Information</strong>
                                            <input type="text" class="form-control" id="Org_Affiliation" name="Org_Affiliation" placeholder="Organization Affiliated:">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="Org_Contact" name="Org_Contact" placeholder="Contact Person:">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="Org_Office" name="Org_Office" placeholder="Office Address:">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="Org_Tel" name="Org_Tel" placeholder="Tel Nos.:">
                                        </div>
                                    </div>

                                    <!-- ID Reference Section (Two Columns) -->
                                    <div class="col-12 col-md-6">
                                        <div class="mb-3">
                                            <br>
                                            <br>
                                            <strong>ID Reference No.:</strong>
                                            <input type="text" class="form-control" id="SSS_No" name="SSS_No" placeholder="SSS No:">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="GSIS_No" name="GSIS_No" placeholder="GSIS No:">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="Pagibig_No" name="Pagibig_No" placeholder="Pagibig No:">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="PSN_No" name="PSN_No" placeholder="PSN No:">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="Philhealth_No" name="Philhealth_No" placeholder="Philhealth No:">
                                        </div>
                                    </div>

                                    <!-- Family Background Section (Two Columns) -->
                                    <div class="col-12 col-md-6">
                                        <div class="mb-3">
                                            <strong>Family background</strong>
                                            <br>
                                            <label>Father's Name</label>
                                            <input type="text" class="form-control" id="Father_LN" name="Father_LN" placeholder="Last Name">
                                            <input type="text" class="form-control" id="Father_FN" name="Father_FN" placeholder="First Name">
                                            <input type="text" class="form-control" id="Father_MN" name="Father_MN" placeholder="Middle Name">
                                        </div>
                                        <div class="mb-3">
                                            <label>Mother's Name</label>
                                            <input type="text" class="form-control" id="Mother_LN" name="Mother_LN" placeholder="Last Name">
                                            <input type="text" class="form-control" id="Mother_FN" name="Mother_FN" placeholder="First Name">
                                            <input type="text" class="form-control" id="Mother_MN" name="Mother_MN" placeholder="Middle Name">
                                        </div>
                                    </div>

                                    <!-- Guardian's Name Section (Two Columns) -->
                                    <div class="col-12 col-md-6">
                                        <div class="mb-3">
                                            <br>
                                            <label>Guardians's Name</label>
                                            <input type="text" class="form-control" id="Guardian_LN" name="Guardian_LN" placeholder="Last Name">
                                            <input type="text" class="form-control" id="Guardian_FN" name="Guardian_FN" placeholder="First Name">
                                            <input type="text" class="form-control" id="Guardian_MN" name="Guardian_MN" placeholder="Middle Name">
                                        </div>
                                    </div>

                                    <!-- Accomplishment by Section (Radio Buttons and Input Fields) -->
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <strong>Accomplishment by</strong>
                                            <br>
                                            <!-- Making the radio buttons align vertically -->
                                            <div class="form-check">
                                                <input type="radio" class="form-radio-input form-check-input" id="NA" name="Accomplished_By" value="applicant" required>
                                                <label class="form-check-label" for="NA">Applicant</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="form-radio-input form-check-input" id="NA" name="Accomplished_By" value="guardian" required>
                                                <label class="form-check-label" for="NA">Guardian</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="form-radio-input form-check-input" id="NA" name="Accomplished_By" value="representative" required>
                                                <label class="form-check-label" for="NA">Representative</label>
                                            </div>

                                            <div id="applicantFields" style="display: none;">
                                                <input type="text" class="custom-input" name="A_LN" id="A_LN" placeholder="Last Name">
                                                <input type="text" class="custom-input" name="A_FN" id="A_FN" placeholder="First Name">
                                                <input type="text" class="custom-input" name="A_MN" id="A_MN" placeholder="Middle Name">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Certifying Physician Section (Two Columns) -->
                                    <div class="col-12 col-md-6">
                                        <div class="mb-3">
                                            <strong>Name of Certifying physician</strong>
                                            <input type="text" class="form-control" name="Cert_Physician" id="Cert_Physician" placeholder="Name of Certifying physician">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="mb-3">
                                            <br>
                                            <strong>Physician License No.</strong>
                                            <input type="text" class="form-control" name="Physician_License" id="Physician_License" placeholder="Physician License No.">
                                        </div>
                                    </div>

                                    <div class="button-group">
                                        <button type="button" class="btn btn-primary btn-step" onclick="nextStep(5)">Back</button>
                                        <button type="button" class="btn btn-success btn-step" onclick="nextStep(7)">Next</button>
                                    </div>

                                </div>
                            </div>
                        </div>




                        <!-- Step 7: attachments -->
                        <div class="step" id="step7">
                            <div class="form-step applicant-section"style="background-color: #e1f5e3;">
                                <div class="applicant-content col-12 col-md-6">
                                    <h3 class="step-header">Attachments</h3>
                                    <div class="mb-3">
                                        <label>Birth Certificate*</label>
                                        <input type="file" name="Birth_Cert" id="preview2" alt="Preview 2" class="form-control" accept=".png, .jpg, .jpeg, .gif" onchange="previewImage(event, 'preview2')" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Barangay Clearance*</label>
                                        <input type="file" name="Brgy_Clearance" id="preview3" alt="Preview 3" class="form-control" accept=".png, .jpg, .jpeg, .gif" onchange="previewImage(event, 'preview3')" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Valid ID Picture*</label>
                                        <input type="file" name="Valid_id" id="preview4" alt="Preview 4" class="form-control" accept=".png, .jpg, .jpeg, .gif" onchange="previewImage(event, 'preview4')" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Medical Assesment*</label>
                                        <input type="file" name="Medical_Assesment" id="preview5" alt="Preview 5" class="form-control" accept=".png, .jpg, .jpeg, .gif" onchange="previewImage(event, 'preview5')" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Old City ID *for Transferee </label>
                                        <input type="file" name="old_city_id" id="preview6" alt="Preview 6" class="form-control" accept=".png, .jpg, .jpeg, .gif" onchange="previewImage(event, 'preview6')" disabled>
                                        <small class="form-text text-muted">Upload your Old City ID only if you are a transferee.</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="ContactEmergency" class="form-label">Contact Person In Case of Emergeny & Number::</label>
                                        <input type="text" class="form-control" id="Contact_Emergency" name="Contact_Emergency" required>
                                    </div>
                                </div>
                            </div>
                                <div class="button-group">
                                        <button type="button" class="btn btn-primary btn-step" onclick="nextStep(6)">Back</button>
                                        <button type="button" class="btn btn-success btn-step" onclick="nextStep(8)">Next</button>
                                </div>
                        </div>
                        
                        <!-- Step 7: Review Information -->
                        <div class="step" id="step8">
                            <div class="form-step applicant-section"style="background-color: #e1f5e3;">
                                <h3 class="step-header">Review Your Information</h3>
                                <div id="reviewSection"></div>
                            </div>
                            <div class="button-group">
                                <button type="button" class="btn btn-primary btn-step" onclick="nextStep(6)">Back</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="footer">
                    <p>&copy; 2024 City Government of Parañaque City. All rights reserved</p>
                </div>
            </div>
        </div>
    </div>

<!-- Modal Structure -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()"></button>
            </div>
            <div class="modal-body">
                <img id="modalImage" src="" alt="Preview" style="width: 100%;">
            </div>
        </div>
    </div>
</div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

<script>
$('#NA').on('change', function() {
    if (this.checked) {
        $('#applicantFields').show();  // Show input fields
    } else {
        $('#applicantFields').hide();  // Hide input fields
    }
});







 let currentStep = 1;

 function toggleOldCityID() {
        const applicationType = document.getElementById('Applicant_type').value;
        const oldCityIDInput = document.getElementById('preview6');

        if (applicationType === 'Transferee') {
            oldCityIDInput.disabled = false; // Enable input
            oldCityIDInput.required = true; // Set as required
        } else {
            oldCityIDInput.disabled = true; // Disable input
            oldCityIDInput.required = false; // Remove required
            oldCityIDInput.value = ''; // Clear the input if disabled
        }
    }

    function handleStepActivation() {
        // Check the selected application type when the step becomes active
        toggleOldCityID();
    }

    function calculateAge(Date_of_birth) {
    const birthDate = new Date(Date_of_birth);
    const today = new Date();
    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDifference = today.getMonth() - birthDate.getMonth();

    if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}


$(document).ready(function() {
        @if(session('success'))
            $('#messageModal').modal('show');
        @endif
    });



    function nextStep(step) {
    const totalSteps = document.querySelectorAll('.step').length;
    const previousStepElement = document.getElementById(`step${currentStep}`);
    const nextStepElement = document.getElementById(`step${step}`);

    // Perform error checking only when moving to the next step
    if (step !== currentStep && step > currentStep) {
        const invalidFields = [];
        const inputs = previousStepElement.querySelectorAll('input, select');

        inputs.forEach(input => {
            if (input.value.trim() === '' && input.hasAttribute('required')) {
                input.classList.add('is-invalid'); // Add error class
                input.classList.remove('is-valid'); // Remove valid class
                invalidFields.push(input);
            } else {
                input.classList.remove('is-invalid'); // Remove error class if valid
                input.classList.add('is-valid'); // Add valid class
            }
        });

        if (invalidFields.length > 0) {
            // Show error modal with message
            const errorModalBody = document.getElementById('errorModalBody');
            errorModalBody.innerHTML = 'Please fill in all required fields.';
            const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
            return; // Prevent moving to the next step if there are errors
        }
        if (step === 8) {
            displayReview();
        }
    }

    // Navigate to the previous or next step
    previousStepElement.classList.remove('active');
    nextStepElement.classList.add('active');
    currentStep = step;
}


const occupationSelect = document.querySelector('#OccupationSelect');
    const othersInputContainer = document.getElementById('otherOccupationInput');
    const jobOthersInput = document.getElementById('JobOthersInput');

    // Show/Hide input field based on "Others" selection
    occupationSelect.addEventListener('change', function () {
        if (occupationSelect.value === "Others") {
            othersInputContainer.style.display = 'block';
            jobOthersInput.required = true; // Make input required
            occupationSelect.required = false; // Disable requirement on the select
        } else {
            othersInputContainer.style.display = 'none';
            jobOthersInput.required = false; // Remove requirement from input
            occupationSelect.required = true; // Enable requirement on the select
            jobOthersInput.value = ''; // Clear the input field
        }
    });

    // Update form validation on input field
    jobOthersInput.addEventListener('input', function () {
        if (occupationSelect.value === "Others" && jobOthersInput.value.trim() !== "") {
            // Remove "required" from the select if "Others" is filled
            occupationSelect.required = false;
        } else if (occupationSelect.value === "Others" && jobOthersInput.value.trim() === "") {
            // Re-enable "required" on the select if input is empty
            occupationSelect.required = true;
        }
    });

    // Function to display the review section
    function displayReview() {
        const reviewSection = document.getElementById('reviewSection');
        reviewSection.innerHTML = ''; // Clear previous review content

        // Collect data from the form
        const formData = new FormData(document.getElementById('multiStepForm'));
        const data = {};

        for (const [key, value] of formData.entries()) {
            data[key] = value;
        }

        const today = new Date();
        const formattedDate = today.toISOString().split('T')[0]; // Format as YYYY-MM-DD
        data['date_applied'] = formattedDate; // Assign to data object

        // Collect checked disabilities categorized
        const congenitalDisabilities = [];
        const acquiredDisabilities = [];
        const disabilityCheckboxes = document.querySelectorAll('input[type="checkbox"].form-check-input');

        disabilityCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const label = checkbox.nextElementSibling.innerText; // Get the label text of the checked checkbox
                // Check the name attribute to categorize
                if (checkbox.name.startsWith("Congenital")) {
                    congenitalDisabilities.push(label);
                } else if (checkbox.name.startsWith("Acquired")) {
                    acquiredDisabilities.push(label);
                }
            }
        });


// Make sure that the "Others" input is correctly passed into the data object when displaying
    const occupationSelect = document.querySelector('select[name="Occupation"]');
    const jobOthersInput = document.getElementById('JobOthersInput');
    // Check if 'Others' is selected and use the JobOthersInput value if true
    if (occupationSelect.value === 'Others') {
        data['Occupation'] = jobOthersInput.value.trim();  // Use input value if "Others" is selected
    } else {
        data['Occupation'] = occupationSelect.value; // Use selected value if not "Others"
    }


    //Rommel Occupation fix

    // Check if the selected occupation is 'Others' and JobOthersInput has a value
    if (occupationSelect.value === 'Others' && jobOthersInput.value.trim() !== '') {
    const jobOthers = jobOthersInput.value.trim();
    
    // Create a new option dynamically with the value of JobOthersInput
    let newOption = document.createElement('option');
    newOption.value = jobOthers;
    newOption.textContent = jobOthers;
    
    // Add the new option to the select element
    occupationSelect.appendChild(newOption);
    
    // Now, set the occupationSelect value to the custom job title (JobOthersInput)
    occupationSelect.value = jobOthers;  // Select the newly added option
    }
    //end of rommel occupation fix */

    // Create a resume-like format without the 'resume' ID
    const age = calculateAge(data.Date_of_birth);

    reviewSection.innerHTML +=  `
        <div id="applicant" style="font-family: Arial, sans-serif; line-height: 1.6;">
            <h3 style="text-align: center;">Application Summary</h3>
            <!-- Applicant Information -->
            <div style="margin-bottom: 20px;">
                <h4 style="border-bottom: 1px solid #ccc; padding-bottom: 5px;">Applicant Information</h4>
                <p><strong>Application Type:</strong> ${data['Applicant_type']}</p>
                <p><strong>Date Applied:</strong> ${data['date_applied']}</p>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div style="flex: 1; padding-right: 20px;">
                    <h4 style="border-bottom: 1px solid #ccc; padding-bottom: 5px;">Personal Details</h4>
                    <p>
                        <strong>Full Name:</strong> 
                        ${data['FN']} ${data['MN']} ${data['LN']} ${data['suffix'] || ''}
                    </p>
                    <p>
                        <strong>Date of Birth:</strong> ${data['Date_of_birth']}
                        <strong>Age:</strong> ${age} years old 
                        <span style="margin-left: 20px;"><strong>Gender:</strong> ${data['Sex']}</span>
                    </p>
                    <p><strong>Civil Status:</strong> ${data['Civil_status']}</p>
                </div>
                <div style="flex: 0 0 auto; text-align: center;">
                    <h4 style="border-bottom: 1px solid #ccc; padding-bottom: 5px;">ID Picture</h4>
                    <img src="${document.getElementById('preview1').src}" alt="preview 1" 
                        style="width: 150px; height: 150px; border-radius: 5px; object-fit: cover;"
                        onclick="openModal(this.src)"/>
                </div>
            </div>

            <!-- Address Information -->
            <div style="margin-bottom: 20px;">
                <h4 style="border-bottom: 1px solid #ccc; padding-bottom: 5px;">Address Information</h4>
                <p>
                    <strong>House No:</strong> ${data['HouseNo_Street']}, 
                    <strong>Barangay:</strong> ${data['Barangay']}
                </p>
                <p>
                    <strong>Municipality:</strong> Parañaque, 
                    <strong>Province:</strong> Metro Manila, 
                    <strong>Region:</strong> NCR
                </p>
            </div>

            <!-- Contact Details -->
            <div style="margin-bottom: 20px;">
                <h4 style="border-bottom: 1px solid #ccc; padding-bottom: 5px;">Contact Details</h4>
                <p>
                    <strong>Landline:</strong> ${data['Landline_No'] || 'N/A'} 
                    <span style="margin-left: 20px;"><strong>Mobile:</strong> ${data['Mobile_No'] || 'N/A'}</span>
                </p>
                <p><strong>Email:</strong> ${data['Email_address'] || 'N/A'}</p>
                <p><strong>Person Contact In Case of Emergency:</strong> ${data['Contact_Emergency'] || 'N/A'}</p>
            </div>

            <!-- Disability Information -->
            <div style="margin-bottom: 20px;">
                <h4 style="border-bottom: 1px solid #ccc; padding-bottom: 5px;">Disability Information</h4>
                
                <h5>TYPES OF DISABILITY</h5>
                <p>
                    ${data['Deaf'] ? 'Deaf or Hard of Hearing' : ''}
                    ${data['Deaf'] && (data['Intellectual'] || data['Learning'] || data['Mental'] || data['Physical'] || data['Psychosocial'] || data['Speech_and_Language'] || data['Visual'] || data['Cancer'] || data['Rare_Disease']) ? ', ' : ''}
                    ${data['Intellectual'] ? 'Intellectual Disability' : ''}
                    ${data['Intellectual'] && (data['Learning'] || data['Mental'] || data['Physical'] || data['Psychosocial'] || data['Speech_and_Language'] || data['Visual'] || data['Cancer'] || data['Rare_Disease']) ? ', ' : ''}
                    ${data['Learning'] ? 'Learning Disability' : ''}
                    ${data['Learning'] && (data['Mental'] || data['Physical'] || data['Psychosocial'] || data['Speech_and_Language'] || data['Visual'] || data['Cancer'] || data['Rare_Disease']) ? ', ' : ''}
                    ${data['Mental'] ? 'Mental Disability' : ''}
                    ${data['Mental'] && (data['Physical'] || data['Psychosocial'] || data['Speech_and_Language'] || data['Visual'] || data['Cancer'] || data['Rare_Disease']) ? ', ' : ''}
                    ${data['Physical'] ? 'Physical Disability (Orthopedic)' : ''}
                    ${data['Physical'] && (data['Psychosocial'] || data['Speech_and_Language'] || data['Visual'] || data['Cancer'] || data['Rare_Disease']) ? ', ' : ''}
                    ${data['Psychosocial'] ? 'Psychosocial Disability' : ''}
                    ${data['Psychosocial'] && (data['Speech_and_Language'] || data['Visual'] || data['Cancer'] || data['Rare_Disease']) ? ', ' : ''}
                    ${data['Speech_and_Language'] ? 'Speech and Language Impairment' : ''}
                    ${data['Speech_and_Language'] && (data['Visual'] || data['Cancer'] || data['Rare_Disease']) ? ', ' : ''}
                    ${data['Visual'] ? 'Visual Disability' : ''}
                    ${data['Visual'] && (data['Cancer'] || data['Rare_Disease']) ? ', ' : ''}
                    ${data['Cancer'] ? 'Cancer (RA11215)' : ''}
                    ${data['Cancer'] && data['Rare_Disease'] ? ', ' : ''}
                    ${data['Rare_Disease'] ? 'Rare Disease (RA10747)' : ''}
                </p>
                <p>${(data['Deaf'] || data['Intellectual'] || data['Learning'] || data['Mental'] || data['Physical'] || data['Psychosocial'] || data['Speech_and_Language'] || data['Visual'] || data['Cancer'] || data['Rare_Disease']) ? '' : 'None'}</p>

                <h5 style="border-bottom: 1px solid #ccc;"border-bottom: 1px solid #ccc;>CONGENITAL/INBORN</h5>
                <p>${congenitalDisabilities.length > 0 ? congenitalDisabilities.join(', ') : 'None'}</p>
                <p><strong>Others:</strong> ${data['Congenital_Others']}</p>

                <h5 style="border-bottom: 1px solid #ccc;"border-bottom:>ACQUIRED</h5>
                <p>${acquiredDisabilities.length > 0 ? acquiredDisabilities.join(', ') : 'None'}</p>
                <p><strong>Others:</strong> ${data['Acquired_Others']}</p>
            </div>

            <!-- Contact Details -->
            
            <div style="margin-bottom: 20px;">
                <h4 style="border-bottom: 1px solid #ccc; padding-bottom: 5px;">Educational Attainment</h4>
                <p>
                    <strong>Educational Attainment:</strong> ${data['Educational_Attainment'] || 'N/A'} 
                </p>
            </div>
            
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div style="flex: 1; padding-right: 10px;">
                    <h4 style="border-bottom: 1px solid #ccc; padding-bottom: 5px;">Status of Employement</h4>
                    <p> 
                        <strong>Status of Employment:</strong> ${data['Status_of_Employment'] || 'N/A'} 
                    </p>
                </div>
                
                <div style="flex: 0 0 auto; text-align: center;">
                    <h4 style="border-bottom: 1px solid #ccc; padding-bottom: 5px;">Type of Employment</h4>
                    <p>
                        <strong>Type of Employment:</strong> ${data['Type_of_Employment'] || 'N/A'}
                    </p> 
                </div>
            </div>


            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div style="flex: 1; padding-right: 10px;">
                    <h4 style="border-bottom: 1px solid #ccc; padding-bottom: 5px;">Category of employment</h4>
                    <p> 
                        <strong>Category of employment:</strong> ${data['Category_of_Employment'] || 'N/A'} 
                    </p>
                </div>
                
                <div style="flex: 0 0 auto; text-align: center;">
                    <h4 style="border-bottom: 1px solid #ccc; padding-bottom: 5px;">Occupation</h4>
                    <p>
                        <strong>Occupation:</strong> ${data['Occupation'] !== 'Others' ? data['Occupation'] : data['Occupation_others'] || 'N/A'}

                    </p>

                </div>
            </div>

    <div style="display: flex; flex-wrap: wrap; justify-content: flex-start; align-items: flex-start; gap: 20px;">
        <h4 style="border-bottom: 1px solid #ccc; padding-bottom: 5px; margin-bottom: 10px; width: 100%;">Attachments</h4>
        <h5 style="width: 100%;">click to expand</h5>

        <div style="display: flex; flex-direction: column; align-items: center; text-align: center; margin-right: 20px;">
            <strong>Birth Certificate</strong>
            <img src="${document.getElementById('preview2').src}" alt="preview 2" 
                style="width: 150px; height: 150px; border-radius: 5px; object-fit: cover; margin-top: 5px; cursor: pointer;" 
                onclick="openModal(this.src)" />
        </div>

        <div style="display: flex; flex-direction: column; align-items: center; text-align: center; margin-right: 20px;">
            <strong>Barangay Clearance</strong>
            <img src="${document.getElementById('preview3').src}" alt="preview 3" 
                style="width: 150px; height: 150px; border-radius: 5px; object-fit: cover; margin-top: 5px; cursor: pointer;" 
                onclick="openModal(this.src)" />
        </div>

        <div style="display: flex; flex-direction: column; align-items: center; text-align: center; margin-right: 20px;">
            <strong>Valid ID Picture</strong>
            <img src="${document.getElementById('preview4').src}" alt="preview 4" 
                style="width: 150px; height: 150px; border-radius: 5px; object-fit: cover; margin-top: 5px; cursor: pointer;" 
                onclick="openModal(this.src)" />
        </div>

        <div style="display: flex; flex-direction: column; align-items: center; text-align: center; margin-right: 20px;">
            <strong>Medical Assessment</strong>
            <img src="${document.getElementById('preview5').src}" alt="preview 5" 
                style="width: 150px; height: 150px; border-radius: 5px; object-fit: cover; margin-top: 5px; cursor: pointer;" 
                onclick="openModal(this.src)" />
        </div>

        <div style="display: flex; flex-direction: column; align-items: center; text-align: center; margin-right: 20px;">
            <strong>Old City ID *for Transferee</strong>
            <img src="${document.getElementById('preview6').src}" alt="preview 6" 
                style="width: 150px; height: 150px; border-radius: 5px; object-fit: cover; margin-top: 5px; cursor: pointer;" 
                onclick="openModal(this.src)" />
        </div>
    </div>
            </div>
        </div>
    </div>
    `;
}





// Function to handle navigation to the review step
function goToReviewStep() {
    displayReview(); // Ensure the review is updated when navigating to the review step
    // Your existing code for navigating to the review step
}

// Attach event listeners to the buttons for navigating steps
document.getElementById('nextButton').addEventListener('click', goToNextStep); // Assuming you have a next button
document.getElementById('backButton').addEventListener('click', goToPreviousStep); // Assuming you have a back button
document.getElementById('reviewButton').addEventListener('click', goToReviewStep); // Button for reviewing

// Optional: Call displayReview when any input changes in the form
const formInputs = document.querySelectorAll('#multiStepForm input, #multiStepForm select, #multiStepForm textarea');
formInputs.forEach(input => {
    input.addEventListener('change', displayReview);
});


        function cancelForm() {
            if (confirm('Are you sure you want to cancel? All data will be lost.')) {
                window.location.reload(); // Reload the page to reset form
            }
        }

        function previewImage(event, previewId) {
        const file = event.target.files[0];
        const reader = new FileReader();
        const preview = document.getElementById(previewId); // Use the passed ID

        reader.onload = function(e) {
            preview.src = e.target.result; // Set the source of the preview image
        }

        if (file) {
            reader.readAsDataURL(file); // Read the file as a data URL
        }
    }
        function openModal(imageSrc) {
        const modalImage = document.getElementById('modalImage');
        modalImage.src = imageSrc;
        $('#imageModal').modal('show'); // Show the modal using Bootstrap's jQuery method
    }

    function closeModal() {
        $('#imageModal').modal('hide'); // Hide the modal using Bootstrap's jQuery method
    }

    
    </script>
</body>
</html>
