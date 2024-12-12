<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/mystyles.Design.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Application Form</title>
</head>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<body>

<nav id="sidebar">  
    <ul>
        <li>
            <span class="logo">PDAO</span>
            <button onclick="toggleSidebar()" id="toggle-btn">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg>
            </button>
        </li>
        <li>
            <button onclick="toggleSubmenu(this)" class="dropdown-btn">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z"/></svg>
                <span>Home</span>
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="m280-400 200-200 200 200H280Z"/></svg>
            </button>
            <ul class="sub-menu">
                <div>
                    <li><a href={{route('home')}}>Dashboard</a></li>
                    <li class="active"><a href={{ route('create') }}>Walk In Applicant</a></li>
                    <li><a href={{route('applicants.index')}}>Online Applicant</a></li>
                </div>
            </ul>

        </li>

        <li>
            <a href={{ route('views') }}>
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm240-240H200v160h240v-160Zm80 0v160h240v-160H520Zm-80-80v-160H200v160h240Zm80 0h240v-160H520v160ZM200-680h560v-80H200v80Z"/></svg>
                <span>PWD Database</span>
            </a>
        </li>
        
        <li>
            <button onclick="toggleSubmenu(this)" class="dropdown-btn">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="m370-80-16-128q-13-5-24.5-12T307-235l-119 50L78-375l103-78q-1-7-1-13.5v-27q0-6.5 1-13.5L78-585l110-190 119 50q11-8 23-15t24-12l16-128h220l16 128q13 5 24.5 12t22.5 15l119-50 110 190-103 78q1 7 1 13.5v27q0 6.5-2 13.5l103 78-110 190-118-50q-11 8-23 15t-24 12L590-80H370Zm70-80h79l14-106q31-8 57.5-23.5T639-327l99 41 39-68-86-65q5-14 7-29.5t2-31.5q0-16-2-31.5t-7-29.5l86-65-39-68-99 42q-22-23-48.5-38.5T533-694l-13-106h-79l-14 106q-31 8-57.5 23.5T321-633l-99-41-39 68 86 64q-5 15-7 30t-2 32q0 16 2 31t7 30l-86 65 39 68 99-42q22 23 48.5 38.5T427-266l13 106Zm42-180q58 0 99-41t41-99q0-58-41-99t-99-41q-59 0-99.5 41T342-480q0 58 40.5 99t99.5 41Zm-2-140Z"/></svg>
                <span>Settings</span>
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="m280-400 200-200 200 200H280Z"/></svg>
            </button>
            <ul class="sub-menu">
                <div>
                    <li>
                        <a href={{ route('logout') }}>
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>
                            <span>Logout</span>
                        </a>
                    </li>
                </div>
            </ul>
        </li>
    </ul>
</nav>




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



<body>
    <div class="form-container mt-3">
        <div class="container" id="logo">
            <img src="https://upload.wikimedia.org/wikipedia/commons/3/33/Department_of_Health_%28DOH%29_PHL.svg" alt="logo">
            <div class="headers">
                <h2>DEPARTMENT OF HEALTH</h2>
                <h5>Philippine Registry for Persons with Disabilities Version 4.0</h5>
                <h2>Application Form</h2>
            </div>
        </div>
            <form id="walkin" action="{{route('create')}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="container-xl" id="form-section">
                <div class="row" stborder-top: 0px style="border: none;">
                    <div class="col-md-11" style="margin-left:-0px;">
                        <div class="form-group row" style="margin-right: 49px;">
                            <div class="col-md-12">
                                <input type="radio" id="new_applicant" name="Applicant_type" value="New Applicant" required> New Applicant
                                <input type="radio" id="Transferee" name="Applicant_type" value="Transferee" style="margin-left: 50px;" required> Transferee
                            </div>
                        </div>

                        <div class="form-group row" style="border-top: 0px; border-bottom: 0px; margin-right: 49px;">
                            <div class="col-md-8">
                                <label for="pwd_number" style="margin-top: 10px;">2. Persons with Disability Number (RR-PPMM-BBB-NNNNNNN):</label>
                                <input type="text" style=" border: none; border-bottom: 1px solid #000;  margin-bottom: 10px;" class="form-control custom-input" id="pwd_number" name="PWD_id" value="{{ $nextPWD_id }}" required>
                            </div>
                            <div class="form-group row col-md-4" style=" border-right: 0px; border-bottom: 0px; border-top: 0px;">
                                <label for="date_applied" style="margin-left: 15px; margin-top: 7px;"> 3. Date Applied (mm/dd/yyyy)</label>
                                <input type="date" style=" border: none; border-bottom: 1px solid #000; width: 270px; margin-left: 10px; margin-bottom: 7px" class="form-control" id="date_applied" name="Date_applied" required>
                            </div>
                        </div>

                        <div class="form-group row" style="border-bottom: 0px; margin-right: 49px;">
                            <div class="col-md-12 border">
                                <strong>4. PERSONAL INFORMATION</strong>
                            </div>
                        </div>

                        <div class="form-group row" style="border: 0px; ">
                            <div class="col" style="border-right: 0px; ">
                                <label for="last_name " style="margin-top: 10px">LAST NAME:</label>
                                <input type="text" style=" border: none; border-bottom: 1px solid #000; margin-bottom: 10px;" class="form-control" id="last_name" name="LN" required>
                            </div>
                            <div class="col" style="border-right: 0px;">
                                <label for="first_name" style="margin-top: 10px;">FIRST NAME:</label>
                                <input type="text" style="border: none; border-bottom: 1px solid #000; margin-bottom: 10px; " class="form-control" id="first_name" name="FN" required>
                            </div>
                            <div class="col" style="border-right: 0px;">
                                <label for="middle_name" style="margin-top: 10px;">MIDDLE NAME:</label>
                                <input type="text" style="border: none; border-bottom: 1px solid #000; margin-bottom: 10px; " class="form-control" id="middle_name" name="MN" required>
                            </div>
                            <div class="col" style="margin-right: 49px; ">
                                <label for="suffix" style="margin-top: 10px;">SUFFIX:</label>
                                <input type="text " style="border: none; border-bottom: 1px solid #000; margin-bottom: 10px;" class="form-control" id="suffix" name="Suffix" >
                            </div>
                        </div>
                    </div>
                    <div style="border-bottom: 0px; border-left: 0px; border-right: 0px; width: 102px; height: 143px; text-align: center; margin-left: -40px;">
                    <div style="margin-left:-24px ;border-right: 1px solid; border-top: 1px solid; height: 240px; width: 150px; display: flex; justify-content: center; align-items: center;">
 
                    <div class="photo-container" style="border-right: 1px;">
                            
                            <img id="photoPreview" class="photo-preview" src="" alt="Photo Preview" style="margin-left: 5px;">
                            <input type="file" name="IDpicture" id="IDpicture" class="form-control" accept=".png, .jpg, .jpeg" style="padding-left: 25px; height: 50px" required>
                        </div>
                    </div>   
                    </div>


                </div>

                <div class="form-group row" style="border: none">
                    <div class="col" style="border-right: 0px; border-bottom: 0px; border-top: 0px;">
                        <label for="dateofbirth" style="margin-top: 10px">5. DATE OF BIRTH</label>
                        <input type="date" style="border: none; border-bottom: 1px solid #000; margin-bottom: 10px;" class="form-control" id="dateofbirth" name="Date_of_birth" required onchange="calculateAge()">
                    </div>
                    <div class="col" style="border-right: 0px; border-bottom: 0px; border-top: 0px;">
                        <label style="margin-top: 10px;">6. SEX</label><br>
                        <input type="radio" name="Sex" value="MALE" style="margin-left: 90px;" required> MALE
                        <input type="radio" name="Sex" value="FEMALE" style="margin-left: 20px;" required> FEMALE
                    </div>
                    <div class="col" style="border-bottom: 0px; border-top: 1px solid; margin-top:-1px;">
                        <label style="margin-top: 10px;">AGE</label>
                        <input type="text" class="form-control" id="age" name="Age" style="border: none; border-bottom: 1px solid #000;"readonly>
                    </div>
                </div>

                <div class="container" id="universal">
                    <label>7. CIVIL STATUS</label>
                    <div class="row" style="border-bottom: 0px; border: top 0px; margin-left: 120px; border: none;">
                        <div class="col-md-2" style="border-bottom: 0px;">
                            <input type="radio" id="single" name="Civil_status" value="SINGLE"required>
                            <label for="single" class="ml-2">SINGLE</label>
                        </div>
                        
                        <div class="col-md-2">
                            <input type="radio" id="separated" name="Civil_status" value="SEPARATED"required>
                            <label for="separated" class="ml-2">SEPARATED</label>
                        </div>

                        <div class="col-md-2">
                            <input type="radio" id="cohabitation" name="Civil_status" value="COHABITATION"required>
                            <label for="cohabitation" class="ml-2">COHABITATION</label>
                        </div>

                        <div class="col-md-2">
                            <input type="radio" id="married" name="Civil_status" value="MARRIED"required>
                            <label for="married" class="ml-2">MARRIED</label>
                        </div>

                        <div class="col-md-2">
                            <input type="radio" id="widow" name="Civil_status" value="WIDOW/ER"required>
                            <label for="widow" class="ml-2">WIDOW/ER</label>
                        </div>
                    </div>
                </div>

                <div class="container" id="universal" style="border-top: 0px;">
                    <div class="row" style="border-top: 0px; border-left: 0px; border-right: 0px;">
                        <div class="col-sm">
                            <label>8. TYPES OF DISABILITY</label>
                        </div>


                        <div class="col-sm-6" style="border-left: 1px solid #000;margin-right: -117px ;">
                            <label style="margin-top:5px;">9. CAUSE OF DISABILITY</label>
                        </div>
                    </div>
                    <div class="row" id="disability-section" style="border:none;">
                        <div class="col-sm-3">
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

                        <div class="col-sm-4">
                            <div class="form-check  border-right">
                                <input type="checkbox" class="form-check-input" name="Psychosocial" value="1">
                                <label class="form-check-label">Psychosocial Disability</label>
                            </div>

                            <div class="form-check border-right">
                                <input type="checkbox" class="form-check-input" name="Speech_and_Language" value="1">
                                <label class="form-check-label">Speech and Language Impairment</label>
                            </div>

                            <div class="form-check border-right">
                                <input type="checkbox" class="form-check-input" name="Visual" value="1">
                                <label class="form-check-label">Visual Disability</label>
                            </div>

                            <div class="form-check border-right">
                                <input type="checkbox" class="form-check-input" name="Cancer" value="1">
                                <label class="form-check-label">Cancer (RA11215)</label>
                            </div>

                            <div class="form-check  ">
                                <input type="checkbox" class="form-check-input" name="Rare_Disease" value="1">
                                <label class="form-check-label">Rare Disease (RA10747)</label>
                            </div>
                        </div>

                        <div class="col" style="border-right: none; border-bottom: none; border-top: 0px;">
                            <div class="form-check" style="padding-left:32px ;">
                                <input type="checkbox" class="form-check-input" name="" value="">
                                <label class="form-check-label" style="font-weight: bold;">Congenital/Inborn</label>
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

                            <div class="form-check ">
                                <input type="checkbox" class="form-check-input" name="" value="">
                                <label class="form-check-label">Others, Specify:</label>
                                <input type="text" class="custom-input" name="Congenital_Others" style="margin-left: 10px ; margin-bottom: 10px ; border: none ;border-bottom: 1px solid #000;">
                            </div>

                        </div>

                        <div class="col" style="border-right: none; border-bottom: none; border-top: 0px;">
                            <div class="form-check" style="padding-left:32px ;">
                                <input type="checkbox" class="form-check-input" name="" value="">
                                <label class="form-check-label " style="font-weight: bold;">Acquired</label>
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
                                <input type="checkbox" class="form-check-input" name="" value="1">
                                <label class="form-check-label">Others, Specify:</label>
                                <input type="text" name="Acquired_Others" class="custom-input" style="border: none; border-bottom: 1px solid #000;">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="form-group row" style="border-top: none;">
                    <div class="col-md-12 border">
                        <strong>10. RESIDENCE ADDRESS</strong>
                    </div>
                </div>

                <div class="form-group row" style="border: 0px;">
                    <div class="row" style="margin-left: 0px; margin-top: 0px ; border: none;">
                        <div class="col" style="border: none; border-left: 1px solid;">
                            <label style="margin-top: 1px;">House No. and Street</label>
                            <input type="text" name="HouseNo_Street" style="border: none; border-bottom: 1px solid #000; margin-bottom: 18px;" required>
                        </div>

                        <div class="col" style="border: none; border-left: 1px solid;">
                            <label style="margin-right: 20px;">Barangay</label>
                            <select name="Barangay" id="Brgy" style="border: none; border-bottom: 1px solid #000; margin-top: 3px;">
                                <option value="Baclaran">Baclaran</option>
                                <option value="BF Homes">BF Homes</option>
                                <option value="Don Bosco">Don Bosco</option>
                                <option value="Don Galo">Don Galo</option>
                                <option value="La Huerta">La Huerta</option>
                                <option value="Marcelo Green">Marcelo Green</option>
                                <option value="Merville">Merville</option>
                                <option value="Moonwalk">Moonwalk</option>
                                <option value="San Antonio">San Antonio</option>
                                <option value="San Dionisio">San Dionisio</option>
                                <option value="San Isidro">San Isidro</option>
                                <option value="San Martin de Porres">San Martin de Porres</option>
                                <option value="Santo Niño">Santo Niño</option>
                                <option value="Sun Valley">Sun Valley</option>
                                <option value="Tambo">Tambo</option>
                                <option value="Vitalez">Vitalez</option>
                            </select>
                        </div>

                        <div class="col" style="border: none; border-left: 1px solid;">
                            <label>Municipality</label>
                            <input type="text" value="Parañaque City" name="Municipality" readonly style="border: none; border-bottom: 1px solid #000;">
                        </div>

                        <div class="col" style=" border: none; border-left: 1px solid;">
                            <label style="margin-right: 20px;">Province</label>
                            <input type="text" name="Province" value="Metro Manila" readonly style="border: none; border-bottom: 1px solid #000;">
                        </div>

                        <div class="col" style=" border: none; border-left: 1px solid; border-right: 1px solid; margin-right:15px">
                            <label style="margin-right: 20px;" >Region</label>
                            <input type="text" value="NCR" name="Region" readonly style="border: none; border-bottom: 1px solid #000;">
                        </div>
                    </div>
                </div>

                <div class="form-group row" style="border-bottom: 0px;">
                    <div class="col-md-12 border">
                        <strong>11. CONTACT DETAILS</strong>
                    </div>
                </div>

                <div class="form-group row" style="border: none;">
                    <div class="col" style="margin-top:0px; border-right: 0px; border-bottom: 0px;">
                        <label>Landline No.:</label><br>
                        <input type="text" inputmode="numeric" name="Landline_No" style="border: none; border-bottom: 1px solid #000; margin-bottom: 10px">
                    </div>

                    <div class="col" style="margin-top:0px; border-right: 0px; border-bottom: 0px;">
                        <label>Mobile No.:</label><br>
                        <input type="text" inputmode="numeric"  name="Mobile_No" maxlength="11" style="border: none; border-bottom: 1px solid #000;">
                    </div>

                    <div class="col" style="margin-top:0px; border-bottom: 0px;">
                        <label>Email Address</label><br>
                        <input type="text" name="Email_address" style="border: none; border-bottom: 1px solid #000;">
                    </div>

                </div>

                <div class="form-group row" style="border-bottom: none;">
                    <div class="col-md-12 border">
                        <strong>12. Educational Attainment</strong>
                    </div>
                </div>

                <div class="form-group row" style="border: none;">
                    <div class="col" id="form-group row" style="border-right: 0px; border-bottom: none; width: 0px;">
                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" name="Educational_Attainment" value="NONE"required>
                            <label>None</label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" name="Educational_Attainment" value="KINDERGARDEN"required>
                            <label>Kindergarden</label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" name="Educational_Attainment" value="ELEMENTARY"required>
                            <label>Elementary</label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" name="Educational_Attainment" value="JUNIOR HIGH SCHOOL"required>
                            <label>Junior High School</label>
                        </div>
                        <div style="border: 1px solid; border-bottom:none ;border-right:none; border-left:none; margin-left:-15px; margin-right: -15px;">
                            <div class="col-sm">
                                <strong>13. STATUS OF EMPLOYMENT</strong>
                            </div>

                            <div class="form-radio" style="margin-left: 15px;">
                                <input type="radio" class="form-radio-input" id="Employed" name="Status_of_Employment" value="EMPLOYED"required>
                                <label>Employed</label>
                            </div>

                            <div class="form-radio" style="margin-left: 15px;">
                                <input type="radio" class="form-radio-input" id="Unemployed" name="Status_of_Employment" value="UNEMPLOYED"required>
                                <label>Unemployed</label>
                            </div>

                            <div class="form-radio" style="margin-left: 15px;">
                                <input type="radio" class="form-radio-input" id="SelfEmployed" name="Status_of_Employment" value="SELF-EMPLOYED"required>
                                <label>Self-Employed</label>
                            </div>

                            <div class="container" id="universal" style="border:none; ">
                                <div class="col-sm" style="margin-left: -15px; border-top:1px solid; width:420px; ">
                                    <strong>13.a CATEGORY OF EMPLOYMENT</strong>

                                    <div class="form-radio" style="border:none ;">
                                        <input type="radio" class="form-radio-input" name="Category_of_Employment" value="GOVERNMENT"required>
                                        <label>Government</label>
                                    </div>

                                    <div class="form-radio" style="border: none;">
                                        <input type="radio" class="form-radio-input" name="Category_of_Employment" value="PRIVATE"required>
                                        <label>Private</label>
                                    </div>
                                </div>

                            </div>


                        </div>

                    </div>

                    <div class="col" style="border-right:none; border-bottom: none;">
                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" name="Educational_Attainment" value="SENIOR HIGH SCHOOL"required>
                            <label>Senior High School</label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" name="Educational_Attainment" value="COLLEGE"required>
                            <label>College</label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" id="Vocational" name="Educational_Attainment" value="VOCATIONAL"required>
                            <label>Vocational</label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" id="PostGrad" name="Educational_Attainment" value="POST GRADUATE"required>
                            <label>Post Graduate</label>
                        </div>
                        <div style="border: 1px solid; border-right:none; border-left:none; border-bottom: none; margin-left:-15px; margin-right: 65px;">
                            <div class="col-sm">
                                <strong>13.b TYPES OF EMPLOYMENT</strong>
                            </div>

                            <div class="form-radio" style="margin-left: 15px;">
                                <input type="radio" class="form-radio-input" name="Type_of_Employment" value="PERMANENT"required>
                                <label>Permanent</label>
                            </div>

                            <div class="form-radio" style="margin-left: 15px;">
                                <input type="radio" class="form-radio-input" name="Type_of_Employment" value="SEASONAL"required>
                                <label>Seasonal</label>
                            </div>

                            <div class="form-radio" style="margin-left: 15px;">
                                <input type="radio" class="form-radio-input" name="Type_of_Employment" value="CASUAL"required>
                                <label>Casual</label>
                            </div>

                            <div class="form-radio" style="margin-left: 15px;">
                                <input type="radio" class="form-radio-input" name="Type_of_Employment" value="EMERGENCY"required>
                                <label>Emergency</label>
                            </div>

                        </div>
                    </div>

                    <div class="col" style="border-bottom: none; margin-left:-80px;">
                        <div class="col-sm" style="margin-left:-18px">
                            <strong>14. Occupation</strong>
                        </div>
                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" id="Manager" name="Occupation" value="MANAGER"required>
                            <label>Managers</label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" id="Professionals" name="Occupation" value="PROFESSIONALS"required>
                            <label>Professionals</label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" id="TechProf" name="Occupation" value="TECHNICAL AND ASSOCIATIVE PROFESSIONALS"required>
                            <label>Technical and Associative Professionals</label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" id="Cleric" name="Occupation" value="CLERICAL SUPPORT WORKERS"required>
                            <label>Clerical Support Workers</label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" id="Service" name="Occupation" value="SERVICE AND SALES WORKERS"required>
                            <label>Service and Sales Workers</label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" id="SkiledAgri" name="Occupation" value="SKILLED AGRICULTURAL, FORESTRY AND FISHERY WORKERS"required>
                            <label>Skilled Agricultural,Forestry and Fishery Workers </label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" id="CraftTrade" name="Occupation" value="CRAFT AND TRADE WORKERS"required>
                            <label>Craft and Related Trade Workers</label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" id="ElementaryJob" name="Occupation" value="ELEMENTARY OCCUPATIONS"required>
                            <label>Elementary Occupations</label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" id="Army" name="Occupation" value="ARMED FORCES OCCUPATIONS"required>
                            <label>Armed Forced Occupations</label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" id="Others" name="Occupation" value="OTHERS" required>
                            <label for="Others">Others, Specify</label>
                        </div>

                        <!-- Text Input (hidden initially) -->
                        <div class="form-radion" id="jobOtherInputContainer" style="display:none;">
                            <input type="text" style="margin-bottom: 15px;" class="underline-input" id="JobOthersInput" placeholder="Please specify your occupation">
                        </div>
                    </div>
                </div>

                <div class="form-group row" style="border-bottom: 0px;">
                    <div class="col-md-12 border">
                        <strong>15. ORGANIZATION INFORMATION</strong>
                    </div>
                </div>

                <div class="form-group row" style="border: none;">
                    <div class="row" style=" border:none ;margin-left: 0px; margin-top: 0; margin-right: 0px">
                        <div class="col" style="width: 430px;">
                            <label>Organization Affiliated</label>
                            <input type="text" style="border: none; border-bottom: 1px solid #000; height: 25px; " class="underline-input">
                        </div>

                        <div class="col" style="border-left: 0px; border-right: 0px;">
                            <label>Contact Person</label>
                            <input type="text" class="underline-input">
                        </div>

                        <div class="col" style="border-right: 0px;">
                            <label>Office Address</label>
                            <input type="text" class="underline-input">
                        </div>

                        <div class="col">
                            <label>Tel No.:</label><br>
                            <input type="text" class="underline-input">
                        </div>
                    </div>
                </div>

                <div class="form-group row" style="border-bottom: none;border-top: none;">
                    <div class="col-md-12 border">
                        <strong>16. ID REFERENCE NO.:</strong>
                    </div>
                </div>

                <div class="form-group-row">
                    <div class="row" style="margin-left: 0px; margin-top: 0; margin-right: 0px ; border:none;">
                        <div class="col" style="border-bottom: 0px; border-right: 0px;">
                            <input type="text" class="underline-input" placeholder="SSS NO.:" style="margin-top: 3px;">
                        </div>

                        <div class="col" style="border-bottom: 0px;border-right: 0px;">
                            <input type="text" class="underline-input" placeholder="GSIS NO.:" style="margin-top: 3px;">
                        </div>

                        <div class="col" style="border-bottom: 0px;border-right: 0px;">
                            <input type="text" class="underline-input" placeholder="PAG-IBIG NO.:" style="margin-top: 3px;">
                        </div>

                        <div class="col" style="border-bottom: 0px;border-right: 0px;">
                            <input type="text" class="underline-input" placeholder="PSN NO.:" style="margin-top: 3px;">
                        </div>

                        <div class="col" style="border-bottom: 0px;">
                            <input type="text" class="underline-input" placeholder="PhilHealth NO.:" style="margin-top: 3px;">
                        </div>
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-3" style="border-right: 1px solid;">
                        <strong>17. FAMILY BACKGROUND</strong>
                    </div>
                    <div class="col-sm-3 text-center" style="border-right: 1px solid;">
                        <strong>LAST NAME</strong>
                    </div>
                    <div class="col-sm-3 text-center" style="border-right: 1px solid;">
                        <strong>FIRST NAME</strong>
                    </div>
                    <div class="col-sm-3 text-center">
                        <strong>MIDDLE NAME</strong>
                    </div>
                </div>

                <div class="form-group row" style="border-top: 0px;">
                    <div class="col-sm-3 text-center" style="border-right: 1px solid ;">
                        <strong>FATHER'S NAME</strong>
                    </div>

                    <div class="col-sm-3 " style="border-right: 1px solid;">
                        <input type="text" class="underline-input" style="margin-top: 3px;" >
                    </div>

                    <div class="col-sm-3" style="border-right: 1px solid;">
                        <input type="text" class="underline-input" style="margin-top: 3px;">
                    </div>

                    <div class="col-sm-3">
                        <input type="text" class="underline-input" style="margin-top: 3px;">
                    </div>
                </div>

                <div class="form-group row" style="border-top: 0px;">
                    <div class="col-sm-3 text-center" style="border-right: 1px solid;">
                        <strong>MOTHER'S NAME</strong>
                    </div>

                    <div class="col-sm-3" style="border-right: 1px solid;">
                        <input type="text" class="underline-input" style="margin-top: 3px;">
                    </div>

                    <div class="col-sm-3" style="border-right: 1px solid;">
                        <input type="text" class="underline-input" style="margin-top: 3px;">
                    </div>

                    <div class="col-sm-3">
                        <input type="text" class="underline-input" style="margin-top: 3px;">
                    </div>
                </div>

                <div class="form-group row" style="border-top: 0px;border-bottom: 0px;">
                    <div class="col-sm-3 text-center" style="border-right: 1px solid;">
                        <strong>GUARDIAN'S NAME</strong>
                    </div>

                    <div class="col-sm-3" style="border-right: 1px solid;">
                        <input type="text" class="underline-input" style="margin-top: 3px;">
                    </div>

                    <div class="col-sm-3" style="border-right: 1px solid;">
                        <input type="text" class="underline-input" style="margin-top: 3px;">
                    </div>

                    <div class="col-sm-3">
                        <input type="text" class="underline-input" style="margin-top: 3px;">
                    </div>
                </div>

                <div class="form-group row">                    
                            <div class="col-sm-3" style="border-right: 1px solid;">
                                <strong>18. ACCOMPLISHMENT BY</strong>
                            </div>    
                            <div class="col-sm-3 text-center" style="border-right: 1px solid;">
                                <strong>LAST NAME</strong>
                            </div>
                            <div class="col-sm-3 text-center" style="border-right: 1px solid;">
                                <strong>FIRST NAME</strong>
                            </div>
                            <div class="col-sm-3 text-center">
                                <strong>MIDDLE NAME</strong>
                            </div>
                        </div>

                        <div class="form-group row" style="border-top: 0px;">
                            <div class="col-sm-3 text-center" style="border-right: 1px solid ;">
                                <input type="radio" class="form-radio-input" name="CategoryEmployment" value="Government" style="margin-left:-60px;">
                                <label style="padding-left: 33px; margin-top:5px; ">APPLICANT</label>
                            </div>

                        <div class="col-sm-3 " style="border-right: 1px solid;">
                                <input type="text" class="underline-input" style="margin-top: 3px;">
                            </div>

                            <div class="col-sm-3" style="border-right: 1px solid;">
                                <input type="text" class="underline-input" style="margin-top: 3px;">
                            </div>

                            <div class="col-sm-3">
                                <input type="text" class="underline-input" style="margin-top: 3px;">
                            </div>
                        </div>

                        <div class="form-group row" style="border-top: 0px;">
                            <div class="col-sm-3 text-center" style="border-right: 1px solid ;">
                                <input type="radio" class="form-radio-input" name="CategoryEmployment" value="Private" style="margin-left:-60px;">
                                <label style="padding-left: 35px; margin-top:5px; ">GUARDIAN</label>
                            </div>

                        <div class="col-sm-3 " style="border-right: 1px solid;">
                                <input type="text" class="underline-input" style="margin-top: 3px;">
                            </div>

                            <div class="col-sm-3" style="border-right: 1px solid;">
                                <input type="text" class="underline-input" style="margin-top: 3px;">
                            </div>

                            <div class="col-sm-3">
                                <input type="text" class="underline-input" style="margin-top: 3px;">
                            </div>
                        </div>

                        <div class="form-group row" style="border-top: 0px; border-bottom:0px;">
                            <div class="col-sm-3 text-center" style="border-right: 1px solid ;">
                                <input type="radio" class="form-radio-input" name="CategoryEmployment" value="Private" style="margin-left:-32px;">
                                <label style="padding-left:30px; margin-top:5px;">REPRESENTATIVE</label>
                            </div>

                        <div class="col-sm-3 " style="border-right: 1px solid;">
                                <input type="text" class="underline-input" style="margin-top: 3px;">
                            </div>

                            <div class="col-sm-3" style="border-right: 1px solid;">
                                <input type="text" class="underline-input" style="margin-top: 3px;">
                            </div>

                            <div class="col-sm-3">
                                <input type="text" class="underline-input" style="margin-top: 3px;">
                            </div>
                        </div>

                <div class="form-group row" style="border-bottom: 0px;">
                    <div class="col-md-12 border" style="padding-right: 310px;">
                        <strong class="col-sm-4" style="font-size: 14.35px ; padding-top: 5px ;padding-bottom: 5px;border-right: 1px solid; margin-left: -16px;">19. NAME OF CERTIFYING PHYSICIAN</strong>

                        <div class="row" style="border:none;">
                            <div class="col-sm-4" style="border-right: 1px solid;">
                                <label>License NO.:</label>
                            </div>

                            <div class="col-sm-8">
                                <input type="text" class="underline-input" style="width: 150%; margin-top: 3px;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row" style="border-bottom: 0px;">
                    <div class="col-md-12 border" style="padding-right: 310px;">
                        <div class="row" style="border:none;">
                            <div class="col-sm-4" style="border-right: 1px solid;">
                                <strong>20. PROCESSING OFFICER</strong>
                            </div>

                            <div class="col-sm-8">
                                <input type="text" class="underline-input" style="width: 150%; margin-top: 3px;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row" style="border-bottom: 0px;">
                    <div class="col-md-12 border" style="padding-right: 310px;">
                        <div class="row" style="border:none;">
                            <div class="col-sm-4" style="border-right: 1px solid;">
                                <strong>21. APPROVING OFFICER</strong>
                            </div>

                            <div class="col-sm-8">
                                <input type="text" class="underline-input" style="width: 150%; margin-top: 3px;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row" style="border-bottom: 0px;">
                    <div class="col-md-12 border" style="padding-right: 310px;">
                        <div class="row" style="border:none;">
                            <div class="col-sm-4" style="border-right: 1px solid;">
                                <strong>22. ENCODER</strong>
                            </div>

                            <div class="col-sm-8">
                                <input type="text" class="underline-input" style="width: 150%; margin-top: 3px;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row" style="border-bottom: 0px;">
                    <div class="col-md-12 border" style="padding-right: 310px;">
                        <div class="row" style="border:none;">
                            <div class="col-sm-4" style="border-right: 1px solid;">
                                <strong>23. NAME OF REPORTING UNIT (OFFICE/SECTION)</strong>
                            </div>

                            <div class="col-sm-8">
                                <input type="text" class="underline-input" style="width: 150%; margin-top: 3px;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12 border" style="padding-right: 310px;">
                        <div class="row" style="border:none;">
                            <div class="col-sm-4" style="border-right: 1px solid;">
                                <strong>24. CONTROL NO.:</strong>
                            </div>

                            <div class="col-sm-8">
                                <input type="text" class="underline-input" style="width: 150%; margin-top: 3px;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12 border" style="padding-right 310px">
                        <label><h6>ATTACHMENTS</h6></label>

                        <div class="row col-md-12 mb-3"style="padding-right 310px border:none;">
                            <label>Birth Certificate</label>
                            <input type="file" name="Birth_Cert" id="Birth_Cert" class="form-control" accept=".png, .jpg, .jpeg, .gif" required>
                        </div>

                        <div class="row col-md-12 mb-3"style="padding-right 310px border:none;">
                            <label>Barangay Clearance</label>
                            <input type="file" name="Brgy_Clearance" id="Brgy_Clearance" class="form-control" accept=".png, .jpg, .jpeg, .gif" required>
                        </div>

                        <div class="row col-md-12 mb-3"style="padding-right 310px border:none;">
                            <label>Valid ID Picture</label>
                            <input type="file" name="Valid_id" id="Valid_id" class="form-control" accept=".png, .jpg, .jpeg, .gif" required>
                        </div>

                        <div class="row col-md-12 mb-3"style="padding-right 310px border:none;">
                            <label>Medical Assesment</label>
                            <input type="file" name="Medical_Assesment" id="Medical_Assesment" class="form-control" accept=".png, .jpg, .jpeg, .gif" required>
                        </div>

                        <div class="row col-md-12 mb-3"style="padding-right 310px border:none;">
                            <label>Old City ID *for Transferee </label>
                            <input type="file" name="old_city_id" id="old_city_id" class="form-control" accept=".png, .jpg, .jpeg, .gif">
                        </div>
                    </div>
                </div>

                <div>
                    <strong>CONTACT PERSON IN CASE OF EMERGENCY & NUMBER : </strong>
                    <input type="text" class="underline-input" name="Contact_Emergency" style="width: 60%; margin-top: 3px;" required>
                </div>


                <div class="button-container">
                    <input type="submit" value="Save">
                    <a href="{{ route('home') }}">Back</a>
                </div>
        </form>
    </div>
    <script>


document.querySelectorAll('input[name="Occupation"]').forEach(function(input) {
    input.addEventListener('change', function() {
        var othersRadio = document.getElementById('Others');
        var jobOtherInputContainer = document.getElementById('jobOtherInputContainer');
        var jobOthersInput = document.getElementById('JobOthersInput');
        
        if (othersRadio.checked) {
            jobOtherInputContainer.style.display = 'block';
            jobOthersInput.setAttribute('name', 'Occupation'); // Add name when visible
            jobOthersInput.required = true; // Ensure input is required
        } else {
            jobOtherInputContainer.style.display = 'none';
            jobOthersInput.removeAttribute('name'); // Remove name to avoid conflict
            jobOthersInput.required = false; // Remove required attribute
            jobOthersInput.value = ''; // Clear the input value
        }
    });
});

$(document).ready(function() {
        @if(session('success'))
            $('#messageModal').modal('show');
        @endif
    });


document.addEventListener('DOMContentLoaded', function () {
        const transfereeRadio = document.getElementById('Transferee');
        const oldCityIDInput = document.getElementById('old_city_id');

        // Function to toggle the required attribute
        function toggleOldCityIDRequirement() {
            if (transfereeRadio.checked) {
                oldCityIDInput.required = true;
                oldCityIDInput.disabled = false; // Enable input
            } else {
                oldCityIDInput.required = false;
                oldCityIDInput.disabled = true;  // Disable input
                oldCityIDInput.value = '';       // Clear value when disabled
            }
        }

        // Attach event listener to both radio buttons
        const applicantTypeRadios = document.querySelectorAll('input[name="Applicant_type"]');
        applicantTypeRadios.forEach(radio => {
            radio.addEventListener('change', toggleOldCityIDRequirement);
        });

        // Initialize the state on page load
        toggleOldCityIDRequirement();
    });


    document.getElementById('IDpicture').addEventListener('change', function(event) {
        const photoPreview = document.getElementById('photoPreview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                photoPreview.src = e.target.result;
                photoPreview.style.display = 'block'; // Show the preview
            };

            reader.readAsDataURL(file); // Convert the file into a base64 URL
        } else {
            photoPreview.src = '';
            photoPreview.style.display = 'none'; // Hide the preview if no file is selected
        }
    });
    function calculateAge() {
        console.log("calculateAge function called"); // Debug log
        const dobInput = document.getElementById('dateofbirth').value; // Get date of birth value
        console.log("Date of Birth:", dobInput); // Log date of birth

        if (dobInput) {
            const dob = new Date(dobInput); // Create a date object from the input
            const today = new Date(); // Get today's date
            
            let age = today.getFullYear() - dob.getFullYear(); // Calculate age
            const monthDifference = today.getMonth() - dob.getMonth();

            // Adjust age if the birth date hasn't occurred yet this year
            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < dob.getDate())) {
                age--;
            }

            console.log("Calculated Age:", age); // Log calculated age
            document.getElementById('age').value = age; // Set the age in the input field
        } else {
            document.getElementById('age').value = ''; // Clear the age if no date is selected
        }
    }

    const toggleButton =document.getElementById('toggle-btn')
const sidebar =document.getElementById('sidebar')

function toggleSidebar(){
    sidebar.classList.toggle('close')

    Array.from(sidebar.getElementsByClassName('show')).forEach(uL =>{
        uL.classList.remove('show')
        
    })
    
}

function toggleSubmenu(button) {
    button.nextElementSibling.classList.toggle('show')
    button.classList.toggle('rotate')

    if(sidebar.classList.contains('close')){
        sidebar.classList.toggle('close')
        toggleButton.classList.toggle('rotate')
    }
}


</script>
</body>
</html>