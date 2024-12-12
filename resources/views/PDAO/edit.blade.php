<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Details</title>
    <link rel="stylesheet" href="/CSS/edit.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap">
</head>
<body>

<nav class="navbar navbar-expand-lg" style="background-color: #1b7402;">
    <div class="container">
        <a class="navbar-brand text-white" href="#"> <!-- Text color white for contrast -->
            PDAO DATABASE MANAGEMENT
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item ">
                    <a class="nav-link text-white d-flex align-items-center" href="{{ route('home') }}">
                        <span class="material-symbols-outlined me-1">home</span>Home
                    </a>
                </li>


                <li class="nav-item {{ request()->is('views') ? 'active' : '' }}">
                    <a class="nav-link text-white d-flex align-items-center" href="{{ route('views') }}">
                        <span class="material-symbols-outlined me-1">view_list</span>View Database
                    </a>
                </li>
                <li class="nav-item">
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




    <div class="container-edit">
        <div class="section-header">
            Edit User Details
        </div>
        <form action="{{ route('data-forms.update', $dataForm->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Personal Information Section -->
            <div class="mb-4">
                <h5 class="text-primary">Personal Information</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="PWD_id">PWD ID</label>
                            <input type="text" class="form-control" id="PWD_id" name="PWD_id" value="{{ old('PWD_id', $dataForm->PWD_id) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="FN">First Name</label>
                            <input type="text" class="form-control" id="FN" name="FN" value="{{ old('FN', $dataForm->FN) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="FN">Last Name</label>
                            <input type="text" class="form-control" id="LN" name="LN" value="{{ old('LN', $dataForm->LN) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="MN">Middle Name</label>
                            <input type="text" class="form-control" id="MN" name="MN" value="{{ old('MN', $dataForm->MN) }}">
                        </div>
                        <div class="form-group">
                            <label for="Suffix">Suffix</label>
                            <input type="text" class="form-control" id="Suffix" name="Suffix" value="{{ old('Suffix', $dataForm->Suffix) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Date_of_birth">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="Date_of_birth" value="{{ old('Date_of_birth', $dataForm->Date_of_birth) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="text" class="form-control" id="age" name="Age" value="{{ old('Age', \Carbon\Carbon::parse($dataForm->Date_of_birth)->age) }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Sex">Sex</label>
                            <select class="form-control" id="Sex" name="Sex" required>
                                <option value="MALE" {{ $dataForm->Sex == 'MALE' ? 'selected' : '' }}>Male</option>
                                <option value="FEMALE" {{ $dataForm->Sex == 'FEMALE' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Civil_status">Civil Status</label>
                            <select class="form-control" id="Civil_status" name="Civil_status" required>
                                <option value="SINGLE" {{ $dataForm->Civil_status == 'SINGLE' ? 'selected' : '' }}>Single</option>
                                <option value="MARRIED" {{ $dataForm->Civil_status == 'MARRIED' ? 'selected' : '' }}>Married</option>
                                <option value="SEPARATED" {{ $dataForm->Civil_status == 'SEPARATED' ? 'selected' : '' }}>Separated</option>
                                <option value="WIDOW/ER" {{ $dataForm->Civil_status == 'WIDOW/ER' ? 'selected' : '' }}>Widow/er</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Address Section -->
            <div class="mb-4">
                <h5 class="text-primary">Address</h5>
                <div class="form-group">
                    <label for="HouseNo_Street">House No/Street</label>
                    <input type="text" class="form-control" id="HouseNo_Street" name="HouseNo_Street" value="{{ old('HouseNo_Street', $dataForm->HouseNo_Street) }}" required>
                </div>
                <div class="form-group">
                    <label for="Brgy">Barangay</label>
                    <select name="Barangay" id="Brgy" class="form-control">
                        <option value="Baclaran" {{ old('Barangay', $dataForm->Barangay) == 'Baclaran' ? 'selected' : '' }}>Baclaran</option>
                        <option value="BF Homes" {{ old('Barangay', $dataForm->Barangay) == 'BF Homes' ? 'selected' : '' }}>BF Homes</option>
                        <option value="Don Bosco" {{ old('Barangay', $dataForm->Barangay) == 'Don Bosco' ? 'selected' : '' }}>Don Bosco</option>
                        <option value="Don Galo" {{ old('Barangay', $dataForm->Barangay) == 'Don Galo' ? 'selected' : '' }}>Don Galo</option>
                        <option value="La Huerta" {{ old('Barangay', $dataForm->Barangay) == 'La Huerta' ? 'selected' : '' }}>La Huerta</option>
                        <option value="Marcelo Green" {{ old('Barangay', $dataForm->Barangay) == 'Marcelo Green' ? 'selected' : '' }}>Marcelo Green</option>
                        <option value="Merville" {{ old('Barangay', $dataForm->Barangay) == 'Merville' ? 'selected' : '' }}>Merville</option>
                        <option value="Moonwalk" {{ old('Barangay', $dataForm->Barangay) == 'Moonwalk' ? 'selected' : '' }}>Moonwalk</option>
                        <option value="San Antonio" {{ old('Barangay', $dataForm->Barangay) == 'San Antonio' ? 'selected' : '' }}>San Antonio</option>
                        <option value="San Dionisio" {{ old('Barangay', $dataForm->Barangay) == 'San Dionisio' ? 'selected' : '' }}>San Dionisio</option>
                        <option value="San Isidro" {{ old('Barangay', $dataForm->Barangay) == 'San Isidro' ? 'selected' : '' }}>San Isidro</option>
                        <option value="San Martin de Porres" {{ old('Barangay', $dataForm->Barangay) == 'San Martin de Porres' ? 'selected' : '' }}>San Martin de Porres</option>
                        <option value="Santo Niño" {{ old('Barangay', $dataForm->Barangay) == 'Santo Niño' ? 'selected' : '' }}>Santo Niño</option>
                        <option value="Sun Valley" {{ old('Barangay', $dataForm->Barangay) == 'Sun Valley' ? 'selected' : '' }}>Sun Valley</option>
                         <option value="Tambo" {{ old('Barangay', $dataForm->Barangay) == 'Tambo' ? 'selected' : '' }}>Tambo</option>
                        <option value="Vitalez" {{ old('Barangay', $dataForm->Barangay) == 'Vitalez' ? 'selected' : '' }}>Vitalez</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="Municipality">Municipality</label>
                    <input type="text" class="form-control" id="Municipality" name="Municipality" value="{{ old('Municipality', $dataForm->Municipality) }}" readonly>
                </div>

                <div class="form-group">
                    <label for="Province">Province</label>
                    <input type="text" class="form-control" id="Province" name="Province" value="{{ old('Province', $dataForm->Province) }}" readonly>
                </div>

                <div class="form-group">
                    <label for="Region">Region</label>
                    <input type="text" class="form-control" id="Region" name="Region" value="{{ old('Region', $dataForm->Region) }}" readonly>
                </div>
            </div>

            <div class="mb-4">
                <h5 class="text-primary">Contact Details</h5>
                <div class="form-group">
                    <label>Landline Number</label>
                    <input type="text" class="form-control" name="Landline_No" value="{{old('Landline_No', $dataForm->Landline_No)}}">
                </div>

                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" class="form-control" name="Mobile_No" maxlength="11" oninput="this.value=this.value.replace(/[^0-9]/g, '')" value="{{old('Mobile_No', $dataForm->Mobile_No)}}">
                </div>

                <div class="form-group">
                    <label>Email_address</label>
                    <input type="text" class="form-control" id="Email_address" name="Email_address" value="{{old('Email_address', $dataForm->Email_address)}}">
                </div>
            </div>

            <div class="mb-4">
                <h5 class="text-primary">Types of disabilities</h5>

                <div class="row w-100">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="Deaf" value="1"{{ $dataForm->Deaf ? 'checked' : '' }}>
                                <label class="form-check-label">Deaf or Hard of Hearing</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="Intellectual" value="1"{{ $dataForm->Intellectual ? 'checked' : '' }}>
                                <label class="form-check-label">Intellectual Disability</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="Learning" value="1"{{ $dataForm->Learning ? 'checked' : '' }}>
                                <label class="form-check-label">Learning Disability</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="Mental" value="1"{{ $dataForm->Mental ? 'checked' : '' }}>
                                <label class="form-check-label">Mental Disability</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="Physical" value="1"{{ $dataForm->Physical ? 'checked' : '' }}>
                                <label class="form-check-label">Physical Disability (Orthopedic)</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="Psychosocial" value="1"{{ $dataForm->Psychosocial ? 'checked' : '' }}>
                            <label class="form-check-label">Psychosocial Disability</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="Speech_and_Language" value="1"{{ $dataForm->Speech_and_Language ? 'checked' : '' }}>
                            <label class="form-check-label">Speech and Language Impairment</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="Visual" value="1"{{ $dataForm->Visual ? 'checked' : '' }}>
                            <label class="form-check-label">Visual Disability</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="Cancer" value="1"{{ $dataForm->Cancer ? 'checked' : '' }}>
                            <label class="form-check-label">Cancer (RA11215)</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="Rare_Disease" value="1"{{ $dataForm->Rare_Disease ? 'checked' : '' }}>
                            <label class="form-check-label">Rare Disease (RA10747)</label>
                        </div>
                    </div>
                </div>  
            </div>

            <div class="mb-4">
                <h5 class="text-primary">Cause of disabilities</h5>
                
                <div class="row w-100">
                    <div class="col-12 col-md-6">

                        <div class="form-check">
                            <h3 class="step-header">Congenital/Inborn</h3>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="Congenital_ADHD" value="1"{{ $dataForm->Congenital_ADHD ? 'checked' : '' }}>
                            <label class="form-check-label">ADHD</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="Congenital_Cerebral" value="1"{{ $dataForm->Congenital_Cerebral ? 'checked' : '' }}>
                            <label class="form-check-label">Cerebral Palsy</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="Congenital_Down" value="1"{{ $dataForm->Congenital_Down ? 'checked' : '' }}>
                            <label class="form-check-label">Down Syndrome</label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label">Others, Specify:</label>
                            <input type="text" name="Congenital_Others" class="custom-input" style="border: none; border-bottom: 1px solid #000;"value="{{ $dataForm->Congenital_Others }}">
                        </div>
                    </div>


                    <div class="col-12 col-md-6">

                        <div class="form-check">
                            <h3 class="step-header">Acquired</h3>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="Acquired_Chronic" value="1"{{ $dataForm->Acquired_Chronic ? 'checked' : '' }}>
                            <label class="form-check-label">Chronic Illness</label>
                        </div>


                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="Acquired_Cerebral" value="1"{{ $dataForm->Acquired_Cerebral ? 'checked' : '' }}>
                            <label class="form-check-label">Cerebral Palsy</label>
                        </div>


                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="Acquired_Injury" value="1"{{ $dataForm->Acquired_Injury ? 'checked' : '' }}>
                            <label class="form-check-label">Injury</label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label">Others, Specify:</label>
                            <input type="text" name="Acquired_Others" class="custom-input" style="border: none; border-bottom: 1px solid #000;"value="{{ $dataForm->Acquired_Others }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <div class="container">
                    <div class="row">
                        <!-- Educational Attainment -->
                        <div class="col-12 col-md-6">
                            <h5 class="text-primary">Educational Attainment</h5>
                            <label for="Educational_Attainment">Educational Attainment</label>
                            <select name="Educational_Attainment" class="form-control" required>
                                <option value="" disabled selected>Select your educational attainment</option>
                                <option value="NONE" {{ old('Educational_Attainment', $dataForm->Educational_Attainment) == 'NONE' ? 'selected' : '' }}>None</option>
                                <option value="KINDERGARTEN" {{ old('Educational_Attainment', $dataForm->Educational_Attainment) == 'KINDERGARTEN' ? 'selected' : '' }}>Kindergarten</option>
                                <option value="ELEMENTARY" {{ old('Educational_Attainment', $dataForm->Educational_Attainment) == 'ELEMENTARY' ? 'selected' : '' }}>Elementary</option>
                                <option value="JUNIOR HIGH SCHOOL" {{ old('Educational_Attainment', $dataForm->Educational_Attainment) == 'JUNIOR HIGH SCHOOL' ? 'selected' : '' }}>Junior High School</option>
                                <option value="SENIOR HIGH SCHOOL" {{ old('Educational_Attainment', $dataForm->Educational_Attainment) == 'SENIOR HIGH SCHOOL' ? 'selected' : '' }}>Senior High School</option>
                                <option value="COLLEGE" {{ old('Educational_Attainment', $dataForm->Educational_Attainment) == 'COLLEGE' ? 'selected' : '' }}>College</option>
                                <option value="VOCATIONAL" {{ old('Educational_Attainment', $dataForm->Educational_Attainment) == 'VOCATIONAL' ? 'selected' : '' }}>Vocational</option>
                                <option value="POST GRADUATE" {{ old('Educational_Attainment', $dataForm->Educational_Attainment) == 'POST GRADUATE' ? 'selected' : '' }}>Post Graduate</option>
                            </select>
                        </div>

                        <!-- Status of Employment -->
                        <div class="col-12 col-md-6">
                            <h5 class="text-primary">Status of Employment</h5>
                            <label for="Status_of_Employment">Status of Employment</label>
                            <select name="Status_of_Employment" class="form-control" required>
                                <option value="" disabled selected>Select your employment status</option>
                                <option value="EMPLOYED" {{ old('Status_of_Employment', $dataForm->Status_of_Employment) == 'EMPLOYED' ? 'selected' : '' }}>Employed</option>
                                <option value="UNEMPLOYED" {{ old('Status_of_Employment', $dataForm->Status_of_Employment) == 'UNEMPLOYED' ? 'selected' : '' }}>Unemployed</option>
                                <option value="SELF-EMPLOYED" {{ old('Status_of_Employment', $dataForm->Status_of_Employment) == 'SELF-EMPLOYED' ? 'selected' : '' }}>Self-Employed</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <!-- Type of Employment -->
                        <div class="col-12 col-md-6">
                            <h5 class="text-primary">Types of Employment</h5>
                            <label for="Type_of_Employment">Type of Employment</label>
                            <select name="Type_of_Employment" class="form-control" required>
                                <option value="" disabled selected>Select type of employment</option>
                                <option value="PERMANENT" {{ old('Type_of_Employment', $dataForm->Type_of_Employment) == 'PERMANENT' ? 'selected' : '' }}>Permanent</option>
                                <option value="SEASONAL" {{ old('Type_of_Employment', $dataForm->Type_of_Employment) == 'SEASONAL' ? 'selected' : '' }}>Seasonal</option>
                                <option value="CASUAL" {{ old('Type_of_Employment', $dataForm->Type_of_Employment) == 'CASUAL' ? 'selected' : '' }}>Casual</option>
                                <option value="EMERGENCY" {{ old('Type_of_Employment', $dataForm->Type_of_Employment) == 'EMERGENCY' ? 'selected' : '' }}>Emergency</option>
                            </select>
                        </div>

                        <!-- Category of Employment -->
                        <div class="col-12 col-md-6">
                            <h5 class="text-primary">Category of Employment</h5>
                            <label for="Category_of_Employment">Category of Employment</label>
                            <select name="Category_of_Employment" class="form-control" required>
                                <option value="" disabled selected>Select category of employment</option>
                                <option value="GOVERNMENT" {{ old('Category_of_Employment', $dataForm->Category_of_Employment) == 'GOVERNMENT' ? 'selected' : '' }}>Government</option>
                                <option value="PRIVATE" {{ old('Category_of_Employment', $dataForm->Category_of_Employment) == 'PRIVATE' ? 'selected' : '' }}>Private</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6">
                        <h5 class="text-primary">Occupation</h5>
                            <label for="Occupation">Occupation</label>
                            <div class="form-radio">
                                <input type="radio" class="form-radio-input" id="Manager" name="Occupation" value="MANAGER" 
                                    {{ old('Occupation', $dataForm->Occupation) == 'MANAGER' ? 'checked' : '' }} >
                                <label for="Manager">Managers</label>
                            </div>

                            <div class="form-radio">
                                <input type="radio" class="form-radio-input" id="Professionals" name="Occupation" value="PROFESSIONALS"
                                    {{ old('Occupation', $dataForm->Occupation) == 'PROFESSIONALS' ? 'checked' : '' }} >
                                <label for="Professionals">Professionals</label>
                            </div>

                            <div class="form-radio">
                                <input type="radio" class="form-radio-input" id="TechProf" name="Occupation" value="TECHNICAL AND ASSOCIATIVE PROFESSIONALS"
                                    {{ old('Occupation', $dataForm->Occupation) == 'TECHNICAL AND ASSOCIATIVE PROFESSIONALS' ? 'checked' : '' }} >
                                <label for="TechProf">Technical and Associative Professionals</label>
                            </div>

                            <div class="form-radio">
                                <input type="radio" class="form-radio-input" id="Cleric" name="Occupation" value="CLERICAL SUPPORT WORKERS"
                                    {{ old('Occupation', $dataForm->Occupation) == 'CLERICAL SUPPORT WORKERS' ? 'checked' : '' }} >
                                <label for="Cleric">Clerical Support Workers</label>
                            </div>

                            <div class="form-radio">
                                <input type="radio" class="form-radio-input" id="Service" name="Occupation" value="SERVICE AND SALES WORKERS"
                                    {{ old('Occupation', $dataForm->Occupation) == 'SERVICE AND SALES WORKERS' ? 'checked' : '' }} >
                                <label for="Service">Service and Sales Workers</label>
                            </div>

                            <div class="form-radio">
                                <input type="radio" class="form-radio-input" id="SkiledAgri" name="Occupation" value="SKILLED AGRICULTURAL, FORESTRY AND FISHERY WORKERS"
                                    {{ old('Occupation', $dataForm->Occupation) == 'SKILLED AGRICULTURAL, FORESTRY AND FISHERY WORKERS' ? 'checked' : '' }} >
                                <label for="SkiledAgri">Skilled Agricultural, Forestry and Fishery Workers</label>
                            </div>

                            <div class="form-radio">
                                <input type="radio" class="form-radio-input" id="CraftTrade" name="Occupation" value="CRAFT AND TRADE WORKERS"
                                    {{ old('Occupation', $dataForm->Occupation) == 'CRAFT AND TRADE WORKERS' ? 'checked' : '' }} >
                                <label for="CraftTrade">Craft and Related Trade Workers</label>
                            </div>

                            <div class="form-radio">
                                <input type="radio" class="form-radio-input" id="ElementaryJob" name="Occupation" value="ELEMENTARY OCCUPATIONS"
                                    {{ old('Occupation', $dataForm->Occupation) == 'ELEMENTARY OCCUPATIONS' ? 'checked' : '' }} >
                                <label for="ElementaryJob">Elementary Occupations</label>
                            </div>

                            <div class="form-radio">
                                <input type="radio" class="form-radio-input" id="Army" name="Occupation" value="ARMED FORCES OCCUPATIONS"
                                    {{ old('Occupation', $dataForm->Occupation) == 'ARMED FORCES OCCUPATIONS' ? 'checked' : '' }} >
                                <label for="Army">Armed Forces Occupations</label>
                            </div>

                            <div class="form-radio">
                                <input type="radio" class="form-radio-input" id="JobOthers" name = "Occupation">
                                <label for="Others">Others, Specify</label>
                                <input type="text" style="margin-bottom: 15px;" class="underline-input" id="JobOthersInput" value= "{{ old('Occupation', $dataForm->Occupation) }}">
                                <input type="hidden" id="HiddenOccupationInput" name="Occupation" value="{{ old('Occupation', $dataForm->Occupation) }}">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-12 border">
                    <label><h6>ATTACHMENTS</h6></label>

                    <div class="row col-md-12 mb-3">
                        <label>Birth Certificate</label>
                        <input type="file" name="Birth_Cert" id="Birth_Cert" class="form-control" accept=".png, .jpg, .jpeg, .gif">
                        <small>Current file: 
                            <a href="{{ asset('storage/app/public' . $dataForm->Birth_Cert) }}" target="_blank">View File</a>
                        </small>
                    </div>

                    <div class="row col-md-12 mb-3">
                        <label>Barangay Clearance</label>
                        <input type="file" name="Brgy_Clearance" id="Brgy_Clearance" class="form-control" accept=".png, .jpg, .jpeg, .gif">
                        <small>Current file: 
                            <a href="{{ asset('storage/app/public' . $dataForm->Brgy_Clearance) }}" target="_blank">View File</a>
                        </small>
                    </div>

                    <div class="row col-md-12 mb-3">
                        <label>Valid ID Picture</label>
                        <input type="file" name="Valid_id" id="Valid_id" class="form-control" accept=".png, .jpg, .jpeg, .gif">
                        <small>Current file: 
                            <a href="{{ asset('storage/app/public' . $dataForm->Valid_id) }}" target="_blank">View File</a>
                        </small>
                    </div>

                    <div class="row col-md-12 mb-3">
                        <label>Medical Assessment</label>
                        <input type="file" name="Medical_Assesment" id="Medical_Assesment" class="form-control" accept=".png, .jpg, .jpeg, .gif">
                        <small>Current file: 
                            <a href="{{ asset('storage/app/public' . $dataForm->Medical_Assesment) }}" target="_blank">View File</a>
                        </small>
                    </div>

                    <div class="row col-md-12 mb-3">
                        <label>Old City ID (for Transferee)</label>
                        <input type="file" name="old_city_id" id="old_city_id" class="form-control" accept=".png, .jpg, .jpeg, .gif">
                        @if ($dataForm->old_city_id)
                            <small>Current file: 
                                <a href="{{ asset('storage/app/public' . $dataForm->old_city_id) }}" target="_blank">View File</a>
                            </small>
                        @else
                            <small>No file uploaded yet.</small>
                        @endif
                    </div>
                </div>
            </div>




            <!-- Submit Section -->
            <div class="text-center">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('views') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS and Popper -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

<script>
    //ROMMEL OCCUPATION OTHERS SCRIPTS
    document.addEventListener('DOMContentLoaded', function () {
    const occupationRadios = document.querySelectorAll('input[name="Occupation"]');
    const othersRadio = document.getElementById('JobOthers');
    const othersInput = document.getElementById('JobOthersInput');
    const hiddenOccupationInput = document.getElementById('HiddenOccupationInput');

    // Predefined occupation values
    const predefinedOccupations = [
        'MANAGER',
        'PROFESSIONALS',
        'TECHNICAL AND ASSOCIATIVE PROFESSIONALS',
        'CLERICAL SUPPORT WORKERS',
        'SERVICE AND SALES WORKERS',
        'SKILLED AGRICULTURAL, FORESTRY AND FISHERY WORKERS',
        'CRAFT AND TRADE WORKERS',
        'ELEMENTARY OCCUPATIONS',
        'ARMED FORCES OCCUPATIONS'
    ];

    // Function to initialize the "Others, Specify" radio and input
    function initializeOthersSpecify() {
        const occupationValue = document.querySelector('input[name="Occupation"]:checked')?.value || '';

        // Check if the selected occupation is one of the predefined ones or not
        if (!predefinedOccupations.includes(occupationValue)) {
            // If not a predefined occupation, "Others, Specify" radio should be checked
            othersRadio.checked = true;
            //othersInput.value = occupationValue;  // THIS CAN NEVER WORK!
            othersInput.removeAttribute('readonly');  // Allow editing the input field
            hiddenOccupationInput.value = occupationValue;  // Set hidden input value to custom occupation
        } else {
            // If one of the predefined occupations is selected, uncheck "Others, Specify" and clear the input
            othersRadio.checked = false;
            othersInput.value = '';  // Clear the input field
            othersInput.setAttribute('readonly', true);  // Make the input readonly
            hiddenOccupationInput.value = occupationValue;  // Set hidden input value to the selected predefined occupation
        }
    }

    // Initialize on page load based on current occupation value
    initializeOthersSpecify();

    // Listen for changes in the occupation radio buttons
    occupationRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            initializeOthersSpecify();  // Reinitialize when occupation changes
        });
    });

    // Listen for changes in the "Others, Specify" input
    othersInput.addEventListener('input', function () {
        if (othersRadio.checked) {
            hiddenOccupationInput.value = othersInput.value;  // Update hidden input value with custom occupation
        }
    });
});
//END OF ROMMEL OCCUPATION OTHER SCRIPT
</script>


@if ($errors->any())
<!-- Modal Trigger -->
<script>

document.querySelectorAll('input[name="Occupation"]').forEach(function(input) {
        input.addEventListener('change', function() {
            var othersRadio = document.getElementById('Others');
            var jobOtherInputContainer = document.getElementById('jobOtherInputContainer');
            if (othersRadio.checked) {
                jobOtherInputContainer.style.display = 'block';
            } else {
                jobOtherInputContainer.style.display = 'none';
            }
        });
    });
    document.addEventListener("DOMContentLoaded", function () {
        var errorModal = new bootstrap.Modal(document.getElementById("errorModal"));
        errorModal.show();
    });


    document.getElementById("dob").addEventListener("change", function () {
        const dob = new Date(this.value);
        const today = new Date();
        let age = today.getFullYear() - dob.getFullYear();
        const monthDifference = today.getMonth() - dob.getMonth();

        // Adjust age if the birthday hasn't occurred yet this year
        if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < dob.getDate())) {
            age--;
        }

        document.getElementById("age").value = age >= 0 ? age : ""; // Ensure no negative age
    });

/* HANS OCCUPATION COMMENT    
     // If the "Others" option is selected, show the input field.
    document.addEventListener("DOMContentLoaded", function() {
        const occupationSelect = document.getElementById('OccupationSelect');
        const otherOccupationInput = document.getElementById('otherOccupationInput');
        
        // Check if the current selected value is "Others"
        if (occupationSelect.value === "Others") {
            otherOccupationInput.style.display = 'block';
        }

        // Add event listener to toggle the input field when selecting "Others"
        occupationSelect.addEventListener('change', function() {
            if (occupationSelect.value === "Others") {
                otherOccupationInput.style.display = 'block';
            } else {
                otherOccupationInput.style.display = 'none';
            }
        });
    }); */



</script>

<!-- Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="text-danger">
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
@endif
</body>
</html>
