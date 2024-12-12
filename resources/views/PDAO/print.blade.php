<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('CSS/mystyles.Design2.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Application Form</title>

    <style>
        @media print {
            @page {
                margin: 0; /* Set page margins to 0 */
            }

            body {
                margin: 0; /* Remove margins */
                padding: 0; /* Remove padding */
            }

            /* Hide buttons when printing */
            button,
            .btn {
                display: none; /* This hides buttons when printing */
            }
        }
    </style>
    
</head>

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

            <div class="container-xl" id="form-section">
                <div class="row" stborder-top: 0px style="border: none;">
                    <div class="col-md-11" style="margin-left:-0px;">
                        <div class="form-group row" style="margin-right: 49px;">
                            <div class="col-md-12">
                                <input type="radio" id="new_applicant" name="Applicant_type" value="New Applicant" {{ $dataForm->Applicant_type === 'New Applicant' ? 'checked' : '' }}> New Applicant
                                <input type="radio" id="Transferee" name="Applicant_type" value="Transferee" style="margin-left: 50px;" {{ $dataForm->Applicant_type === 'Transferee' ? 'checked' : '' }}> Transferee
                            </div>
                        </div>

                        <div class="form-group row" style="border-top: 0px; border-bottom: 0px; margin-right: 49px;">
                            <div class="col-md-8">
                                <label for="pwd_number" style="margin-top: 10px;">2. Persons with Disability Number (RR-PPMM-BBB-NNNNNNN):</label>
                                <input type="text" style=" border: none; border-bottom: 1px solid #000;  margin-bottom: 10px;" class="form-control custom-input" id="pwd_number" name="PWD_id" value="{{ old('PWD_id', $dataForm->PWD_id) }}" readonly>
                            </div>
                            <div class="form-group row col-md-4" style=" border-right: 0px; border-bottom: 0px; border-top: 0px;">
                                <label for="date_applied" style="margin-left: 15px; margin-top: 7px;"> 3. Date Applied (mm/dd/yyyy)</label>
                                <input type="date" style=" border: none; border-bottom: 1px solid #000; width: 270px; margin-left: 10px; margin-bottom: 7px" class="form-control" id="date_applied" name="Date_applied" value="{{ old('Date_applied', $dataForm->Date_applied) }}"readonly>
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
                                <input type="text" style=" border: none; border-bottom: 1px solid #000; margin-bottom: 10px;" class="form-control" id="last_name" name="LN" value="{{ old('LN', $dataForm->LN) }}" readonly>
                            </div>
                            <div class="col" style="border-right: 0px;">
                                <label for="first_name" style="margin-top: 10px;">FIRST NAME:</label>
                                <input type="text" style="border: none; border-bottom: 1px solid #000; margin-bottom: 10px; " class="form-control" id="first_name" name="FN" value="{{ old('FN', $dataForm->FN) }}" readonly>
                            </div>
                            <div class="col" style="border-right: 0px;">
                                <label for="middle_name" style="margin-top: 10px;">MIDDLE NAME:</label>
                                <input type="text" style="border: none; border-bottom: 1px solid #000; margin-bottom: 10px; " class="form-control" id="middle_name" name="MN" value="{{ old('MN', $dataForm->MN) }}" readonly>
                            </div>
                            <div class="col" style="margin-right: 49px; ">
                                <label for="suffix" style="margin-top: 10px;">SUFFIX:</label>
                                <input type="text " style="border: none; border-bottom: 1px solid #000; margin-bottom: 10px;" class="form-control" id="suffix" name="Suffix" value="{{ old('Suffix', $dataForm->Suffix) }}" readonly >
                            </div>
                        </div>
                    </div>
                    <div style="border-bottom: 0px; border-left: 0px; border-right: 0px; width: 102px; height: 143px; text-align: center; margin-left: -40px;">
                    <div style="margin-left:-24px ;border-right: 1px solid; border-top: 1px solid; height: 240px; width: 150px; display: flex; justify-content: center; align-items: center;">
 
                    <div class="photo-container" style="border-right: 1px;">
                            
                    <img id="photoPreview" class="photo-preview" src="{{ asset('storage/app/public/' . $dataForm->IDpicture) }}" alt="Photo Preview" style="width: 150px; height: 150px; object-fit: cover;">                            
                        </div>
                    </div>   
                    </div>


                </div>

                <div class="form-group row" style="border: none">
                    <div class="col" style="border-right: 0px; border-bottom: 0px; border-top: 0px;">
                        <label for="dateofbirth" style="margin-top: 10px">5. DATE OF BIRTH</label>
                        <input type="date" style="border: none; border-bottom: 1px solid #000; margin-bottom: 10px;" class="form-control" id="dob" name="Date_of_birth" value="{{ old('Date_of_birth', $dataForm->Date_of_birth) }}" readonly>
                    </div>
                    <div class="col" style="border-right: 0px; border-bottom: 0px; border-top: 0px;">
                        <label style="margin-top: 10px;">6. SEX</label><br>
                        <input type="radio" name="Sex" value="MALE" style="margin-left: 90px;" {{ $dataForm->Sex === 'MALE' ? 'checked' : '' }} > MALE
                        <input type="radio" name="Sex" value="FEMALE" style="margin-left: 20px;" {{ $dataForm->Sex === 'FEMALE' ? 'checked' : '' }}> FEMALE
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
                            <input type="radio" id="single" name="Civil_status" value="SINGLE"{{ $dataForm->Civil_status === 'Single' ? 'checked' : '' }}>
                            <label for="single" class="ml-2">SINGLE</label>
                        </div>
                        
                        <div class="col-md-2">
                            <input type="radio" id="separated" name="Civil_status" value="SEPARATED"{{ $dataForm->Civil_status === 'Separated' ? 'checked' : '' }}>
                            <label for="separated" class="ml-2">SEPARATED</label>
                        </div>

                        <div class="col-md-2">
                            <input type="radio" id="cohabitation" name="Civil_status" value="COHABITATION"{{ $dataForm->Civil_status === 'Cohabition' ? 'checked' : '' }}>
                            <label for="cohabitation" class="ml-2">COHABITATION</label>
                        </div>

                        <div class="col-md-2">
                            <input type="radio" id="married" name="Civil_status" value="MARRIED"{{ $dataForm->Civil_status === 'Married' ? 'checked' : '' }}>
                            <label for="married" class="ml-2">MARRIED</label>
                        </div>

                        <div class="col-md-2">
                            <input type="radio" id="widow" name="Civil_status" value="WIDOW/ER"{{ $dataForm->Civil_status === 'Widow/ER' ? 'checked' : '' }}>
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
                                <input type="checkbox" class="form-check-input" name="Deaf" value="1"{{ $dataForm->Deaf == '1' ? 'checked' : '' }}>
                                <label class="form-check-label">Deaf or Hard of Hearing</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="Intellectual" value="1"{{ $dataForm->Intellectual == '1' ? 'checked' : '' }}>
                                <label class="form-check-label">Intellectual Disability</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="Learning" value="1"{{ $dataForm->Learning == '1' ? 'checked' : '' }}>
                                <label class="form-check-label">Learning Disability</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="Mental" value="1"{{ $dataForm->Mental == '1' ? 'checked' : '' }}>
                                <label class="form-check-label">Mental Disability</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="Physical" value="1"{{ $dataForm->Physical == '1' ? 'checked' : '' }}>
                                <label class="form-check-label">Physical Disability (Orthopedic)</label>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-check  border-right">
                                <input type="checkbox" class="form-check-input" name="Psychosocial" value="1"{{ $dataForm->Psychosocial == '1' ? 'checked' : '' }}>
                                <label class="form-check-label">Psychosocial Disability</label>
                            </div>

                            <div class="form-check border-right">
                                <input type="checkbox" class="form-check-input" name="Speech_and_Language" value="1"{{ $dataForm->Speech_and_Language == '1' ? 'checked' : '' }}>
                                <label class="form-check-label">Speech and Language Impairment</label>
                            </div>

                            <div class="form-check border-right">
                                <input type="checkbox" class="form-check-input" name="Visual" value="1"{{ $dataForm->Visual == '1' ? 'checked' : '' }}>
                                <label class="form-check-label">Visual Disability</label>
                            </div>

                            <div class="form-check border-right">
                                <input type="checkbox" class="form-check-input" name="Cancer" value="1"{{ $dataForm->Cancer == '1' ? 'checked' : '' }}>
                                <label class="form-check-label">Cancer (RA11215)</label>
                            </div>

                            <div class="form-check  ">
                                <input type="checkbox" class="form-check-input" name="Rare_Disease" value="1"{{ $dataForm->Rare_Disease == '1' ? 'checked' : '' }}>
                                <label class="form-check-label">Rare Disease (RA10747)</label>
                            </div>
                        </div>

                        <div class="col" style="border-right: none; border-bottom: none; border-top: 0px;">
                            <div class="form-check" style="padding-left:32px ;">
                                <input type="checkbox" class="form-check-input" name="" value="">
                                <label class="form-check-label" style="font-weight: bold;">Congenital/Inborn</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="Congenital_ADHD" value="1"{{ $dataForm->Congenital_ADHD == '1' ? 'checked' : '' }}>
                                <label class="form-check-label">ADHD</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="Congenital_Cerebral" value="1"{{ $dataForm->Congenital_Cerebral == '1' ? 'checked' : '' }}>
                                <label class="form-check-label">Cerebral Palsy</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="Congenital_Down" value="1"{{ $dataForm->Congenital_Down == '1' ? 'checked' : '' }}>
                                <label class="form-check-label">Down Syndrome</label>
                            </div>

                            <div class="form-check ">
                                <input type="checkbox" class="form-check-input" name="" value="">
                                <label class="form-check-label">Others, Specify:</label>
                                <input type="text" class="custom-input" name="Congenital_Others" style="margin-left: 10px ; margin-bottom: 10px ; border: none ;border-bottom: 1px solid #000;"value="{{ old('Congenital_Others', $dataForm->Congenital_Others) }}" readonly>
                            </div>

                        </div>

                        <div class="col" style="border-right: none; border-bottom: none; border-top: 0px;">
                            <div class="form-check" style="padding-left:32px ;">
                                <input type="checkbox" class="form-check-input" name="" value="">
                                <label class="form-check-label " style="font-weight: bold;">Acquired</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="Acquired_Chronic" value="1"{{ $dataForm->Acquired_Chronic == '1' ? 'checked' : '' }}>
                                <label class="form-check-label">Chronic Illness</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="Acquired_Cerebral" value="1"{{ $dataForm->Acquired_Cerebral == '1' ? 'checked' : '' }}>
                                <label class="form-check-label">Cerebral Palsy</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="Acquired_Injury" value="1"{{ $dataForm->Acquired_Injury == '1' ? 'checked' : '' }}>
                                <label class="form-check-label">Injury</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="" value="1">
                                <label class="form-check-label">Others, Specify:</label>
                                <input type="text" name="Acquired_Others" class="custom-input" style="border: none; border-bottom: 1px solid #000;"value="{{ old('Acquired_Others', $dataForm->Acquired_Others) }}" readonly>
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
                            <input type="text" name="HouseNo_Street" style="border: none; border-bottom: 1px solid #000; margin-bottom: 18px;"value="{{ old('HouseNo_Street', $dataForm->HouseNo_Street) }}" readonly>
                        </div>

                        <div class="col" style="border: none; border-left: 1px solid;">
                            <label style="margin-right: 20px;">Barangay</label>
                            <select name="Barangay" id="Brgy" style="border: none; border-bottom: 1px solid #000;" >
                                <option value="Baclaran" {{$dataForm->Barangay == 'Baclaran' ? 'selected' : ''}} >Baclaran</option>
                                <option value="BF Homes"{{$dataForm->Barangay == 'BF Homes' ? 'selected' : ''}} >BF Homes</option>
                                <option value="Don Bosco"{{$dataForm->Barangay == 'Don Bosco' ? 'selected' : ''}} >Don Bosco</option>
                                <option value="Don Galo"{{$dataForm->Barangay == 'Don Galo' ? 'selected' : ''}} >Don Galo</option>
                                <option value="La Huerta"{{$dataForm->Barangay == 'La Huerta' ? 'selected' : ''}} >La Huerta</option>
                                <option value="Marcelo Green"{{$dataForm->Barangay == 'Marcelo Green' ? 'selected' : ''}} >Marcelo Green</option>
                                <option value="Merville"{{$dataForm->Barangay == 'Merville' ? 'selected' : ''}} >Merville</option>
                                <option value="Moonwalk"{{$dataForm->Barangay == 'Moonwalk' ? 'selected' : ''}} >Moonwalk</option>
                                <option value="San Antonio"{{$dataForm->Barangay == 'San Antonio' ? 'selected' : ''}} >San Antonio</option>
                                <option value="San Dionisio"{{$dataForm->Barangay == 'San Dionisio' ? 'selected' : ''}} >San Dionisio</option>
                                <option value="San Isidro"{{$dataForm->Barangay == 'San Isidro' ? 'selected' : ''}} >San Isidro</option>
                                <option value="San Martin de Porres"{{$dataForm->Barangay == 'San Martin de Porres' ? 'selected' : ''}} >San Martin de Porres</option>
                                <option value="Santo Niño"{{$dataForm->Barangay == 'Santo Niño' ? 'selected' : ''}} >Santo Niño</option>
                                <option value="Sun Valley"{{$dataForm->Barangay == 'Sun Valley' ? 'selected' : ''}} >Sun Valley</option>
                                <option value="Tambo"{{$dataForm->Barangay == 'Tambo' ? 'selected' : ''}} >Tambo</option>
                                <option value="Vitalez"{{$dataForm->Barangay == 'Vitalez' ? 'selected' : ''}} >Vitalez</option>
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
                        <input type="text" inputmode="numeric" name="Landline_No" style="border: none; border-bottom: 1px solid #000; margin-bottom: 10px" value="{{ old('Landline_No', $dataForm->Landline_No) }}" readonly>
                    </div>

                    <div class="col" style="margin-top:0px; border-right: 0px; border-bottom: 0px;">
                        <label>Mobile No.:</label><br>
                        <input type="text" inputmode="numeric"  name="Mobile_No" maxlength="11" style="border: none; border-bottom: 1px solid #000;" value="{{ old('Mobile_No', $dataForm->Mobile_No) }}" readonly>
                    </div>

                    <div class="col" style="margin-top:0px; border-bottom: 0px;">
                        <label>Email Address</label><br>
                        <input type="text" name="Email_address" style="border: none; border-bottom: 1px solid #000;" value="{{ old('Email_address', $dataForm->Email_address) }}" readonly>
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
                            <input type="radio" class="form-radio-input" name="Educational_Attainment" value="NONE"{{ $dataForm->Educational_Attainment === 'NONE' ? 'checked' : '' }}>
                            <label>None</label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" name="Educational_Attainment" value="KINDERGARTEN"{{ $dataForm->Educational_Attainment === 'KINDERGARTEN' ? 'checked' : '' }}>
                            <label>Kindergarten</label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" name="Educational_Attainment" value="ELEMENTARY"{{ $dataForm->Educational_Attainment === 'ELEMENTARY' ? 'checked' : '' }}>
                            <label>Elementary</label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" name="Educational_Attainment" value="JUNIOR HIGH SCHOOL"{{ $dataForm->Educational_Attainment === 'JUNIOR HIGH SCHOOL' ? 'checked' : '' }}>
                            <label>Junior High School</label>
                        </div>
                        <div style="border: 1px solid; border-bottom:none ;border-right:none; border-left:none; margin-left:-15px; margin-right: -15px;">
                            <div class="col-sm">
                                <strong>13. STATUS OF EMPLOYMENT</strong>
                            </div>

                            <div class="form-radio" style="margin-left: 15px;">
                                <input type="radio" class="form-radio-input" id="Employed" name="Status_of_Employment" value="EMPLOYED"{{$dataForm->Status_of_Employment === 'EMPLOYED' ? 'checked' : ''}}>
                                <label>Employed</label>
                            </div>

                            <div class="form-radio" style="margin-left: 15px;">
                                <input type="radio" class="form-radio-input" id="Unemployed" name="Status_of_Employment" value="UNEMPLOYED"{{$dataForm->Status_of_Employment === 'UNEMPLOYED' ? 'checked' : ''}}>
                                <label>Unemployed</label>
                            </div>

                            <div class="form-radio" style="margin-left: 15px;">
                                <input type="radio" class="form-radio-input" id="SelfEmployed" name="Status_of_Employment" value="SELF-EMPLOYED"{{$dataForm->Status_of_Employment === 'SELF-EMPLOYED' ? 'checked' : ''}}>
                                <label>Self-Employed</label>
                            </div>

                            <div class="container" id="universal" style="border:none; ">
                                <div class="col-sm" style="margin-left: -15px; border-top:1px solid; width:420px; ">
                                    <strong>13.a CATEGORY OF EMPLOYMENT</strong>

                                    <div class="form-radio" style="border:none ;">
                                        <input type="radio" class="form-radio-input" name="Category_of_Employment" value="GOVERNMENT"{{$dataForm->Category_of_Employment === 'GOVERNMENT' ? 'checked' : ''}}>
                                        <label>Government</label>
                                    </div>

                                    <div class="form-radio" style="border: none;">
                                        <input type="radio" class="form-radio-input" name="Category_of_Employment" value="PRIVATE"{{$dataForm->Category_of_Employment === 'PRIVATE' ? 'checked' : ''}}>
                                        <label>Private</label>
                                    </div>
                                </div>

                            </div>


                        </div>

                    </div>

                    <div class="col" style="border-right:none; border-bottom: none;">
                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" name="Educational_Attainment" value="SENIOR HIGH SCHOOL"{{$dataForm->Educational_Attainment === 'SENIOR HIGH SCHOOL' ? 'checked' : ''}}>
                            <label>Senior High School</label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" name="Educational_Attainment" value="COLLEGE"{{$dataForm->Educational_Attainment === 'COLLEGE' ? 'checked' : ''}}>
                            <label>College</label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" id="Vocational" name="Educational_Attainment" value="VOCATIONAL"{{$dataForm->Educational_Attainment === 'VOCATIONAL' ? 'checked' : ''}}>
                            <label>Vocational</label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" id="PostGrad" name="Educational_Attainment" value="POST GRADUATE"{{$dataForm->Educational_Attainment === 'POST GRADUATE' ? 'checked' : ''}}>
                            <label>Post Graduate</label>
                        </div>
                        <div style="border: 1px solid; border-right:none; border-left:none; border-bottom: none; margin-left:-15px; margin-right: 65px;">
                            <div class="col-sm">
                                <strong>13.b TYPES OF EMPLOYMENT</strong>
                            </div>

                            <div class="form-radio" style="margin-left: 15px;">
                                <input type="radio" class="form-radio-input" name="Type_of_Employment" value="PERMANENT"{{$dataForm->Type_of_Employment === 'PERMANENT' ? 'checked' : ''}}>
                                <label>Permanent</label>
                            </div>

                            <div class="form-radio" style="margin-left: 15px;">
                                <input type="radio" class="form-radio-input" name="Type_of_Employment" value="SEASONAL"{{$dataForm->Type_of_Employment === 'SEASONAL' ? 'checked' : ''}}>
                                <label>Seasonal</label>
                            </div>

                            <div class="form-radio" style="margin-left: 15px;">
                                <input type="radio" class="form-radio-input" name="Type_of_Employment" value="CASUAL"{{$dataForm->Type_of_Employment === 'CASUAL' ? 'checked' : ''}}>
                                <label>Casual</label>
                            </div>

                            <div class="form-radio" style="margin-left: 15px;">
                                <input type="radio" class="form-radio-input" name="Type_of_Employment" value="EMERGENCY"{{$dataForm->Type_of_Employment === 'EMERGENCY' ? 'checked' : ''}}>
                                <label>Emergency</label>
                            </div>

                        </div>
                    </div>
                
                    <div class="col" style="border-bottom: none; margin-left:-80px;">
                        <div class="col-sm" style="margin-left:-18px">
                            <strong>14. Occupation</strong>
                        </div>
                        <div class="form-radio">
                        <input type="radio" class="form-radio-input" id="Manager" name="Occupation" value="MANAGER" {{$dataForm->Occupation === 'MANAGER' ? 'checked' : ''}} >
                            <!--<input type="radio" class="form-radio-input" id="Manager" name="Occupation"  {{$dataForm->Occupation === 'MANAGER' ? 'checked' : ''}} >-->
                            <label>Managers</label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" id="Professionals" name="Occupation" value = "PROFESSIONALS"  {{$dataForm->Occupation === 'PROFESSIONALS' ? 'checked' : ''}} >
                            <label>Professionals</label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" id="TechProf" name="Occupation" value = "TECHNICAL AND ASSOCIATIVE PROFESSIONALS"  {{$dataForm->Occupation === 'TECHNICAL AND ASSOCIATIVE PROFESSIONALS' ? 'checked' : ''}} >
                            <label>Technical and Associative Professionals</label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" id="Cleric" name="Occupation" value = "CLERICAL SUPPORT WORKERS"  {{$dataForm->Occupation === 'CLERICAL SUPPORT WORKERS' ? 'checked' : ''}} >
                            <label>Clerical Support Workers</label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" id="Service" name="Occupation" value = "SERVICE AND SALES WORKERS"  {{$dataForm->Occupation === 'SERVICE AND SALES WORKERS' ? 'checked' : ''}} >
                            <label>Service and Sales Workers</label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" id="SkiledAgri" name="Occupation" value = "SKILLED AGRICULTURAL, FORESTRY AND FISHERY WORKERS"  {{$dataForm->Occupation === 'SKILLED AGRICULTURAL, FORESTRY AND FISHERY WORKERS' ? 'checked' : ''}}" >
                            <label>Skilled Agricultural,Forestry and Fishery Workers </label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" id="CraftTrade" name="Occupation" value = "CRAFT AND TRADE WORKERS"  {{$dataForm->Occupation === 'CRAFT AND TRADE WORKERS' ? 'checked' : ''}} >
                            <label>Craft and Related Trade Workers</label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" id="ElementaryJob" name="Occupation" value = "ELEMENTARY OCCUPATIONS"  {{$dataForm->Occupation === 'ELEMENTARY OCCUPATIONS' ? 'checked' : ''}} >
                            <label>Elementary Occupations</label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" id="Army" name="Occupation" value = "ARMED FORCES OCCUPATIONS"  {{$dataForm->Occupation === 'ARMED FORCES OCCUPATIONS' ? 'checked' : ''}} >
                            <label>Armed Forced Occupations</label>
                        </div>

                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" id="JobOthers" name = "Occupation">
                            <label>Others, Specify</label>
                            <input type="text" style="margin-bottom: 15px;" class="underline-input" id="JobOthersInput" value="{{ old('Occupation', $dataForm->Occupation) }}" readonly>
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

                <div>
                    <strong>CONTACT PERSON IN CASE OF EMERGENCY & NUMBER : </strong>
                    <input type="text" class="underline-input" style="width: 60%; margin-top: 3px;" value="{{ old('Contact_Emergency', $dataForm->Contact_Emergency) }}" readonly>
                </div>


                <div>
<!--                     <a href="{{ route('capture', ['id' => $dataForm->id]) }}" class="btn btn-primary">
                        Download PDF
                    </a> -->

                    <button class="btn btn-primary" onclick="window.print();">
                        Print
                    </button>

                    <a href="{{route('views')}}" class="btn btn-warning">
                        Back to View
                    </a>
                </div>

    </div>
    <script>
            function printDiv() {
            var printContents = document.getElementById('printableArea').innerHTML;
            var originalContents = document.body.innerHTML;

            // Create a new window for printing
            var printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>Print</title>');
            
            // Link to your CSS file
            printWindow.document.write('<link rel="stylesheet" href="path/to/your/styles.css">');
            
            printWindow.document.write('</head><body>');
            printWindow.document.write(printContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    // Image preview functionality
/*     document.getElementById('IDpicture').addEventListener('change', function(event) {
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
    }); */

    // Print functionality

    //OCCUPATION SCRIPTS
    document.addEventListener('DOMContentLoaded', function () {
    const occupationRadios = document.querySelectorAll('input[name="Occupation"]');
    const othersRadio = document.getElementById('JobOthers');
    const othersInput = document.getElementById('JobOthersInput');

    // Function to handle the "Others, Specify" field based on the selected occupation
    function initializeOthersSpecify() {
        // Get the value of the currently selected radio button
        const selectedRadio = document.querySelector('input[name="Occupation"]:checked');
        const occupationValue = selectedRadio ? selectedRadio.value : '';

        // Define the predefined occupation values
        const predefinedOccupations = [
            'MANAGER', 'PROFESSIONALS', 'TECHNICAL AND ASSOCIATIVE PROFESSIONALS', 
            'CLERICAL SUPPORT WORKERS', 'SERVICE AND SALES WORKERS', 
            'SKILLED AGRICULTURAL, FORESTRY AND FISHERY WORKERS', 'CRAFT AND TRADE WORKERS', 
            'ELEMENTARY OCCUPATIONS', 'ARMED FORCES OCCUPATIONS'
        ];

        // Check if the selected value is not in the predefined options
        if (!predefinedOccupations.includes(occupationValue)) {
            // If it's not in the predefined options, check "Others, Specify" radio
            othersRadio.checked = true;
            //othersInput.value = occupationValue; //do not input this code, it breaks it
            othersInput.removeAttribute('readonly'); // Make sure input is not readonly
        } else {
            // If a predefined occupation is selected, uncheck "Others, Specify" radio
            othersRadio.checked = false;
            othersInput.value = '';  // Clear the input field
            othersInput.setAttribute('readonly', true);  // Make the input readonly
        }
    }

    // Initialize on page load (so that we handle the initial state properly)
    setTimeout(initializeOthersSpecify, 200);

    // Listen for changes in the occupation radios
    occupationRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            initializeOthersSpecify(); // Reinitialize when occupation changes
        });
    });
});
    //end of occupation scripts


    // Age calculation functionality
    function calculateAge() {
        var dobInput = document.getElementById('dob');
        var ageInput = document.getElementById('age');

        // Get the value of the date of birth
        var dob = dobInput.value;

        // Debugging: Check the value of dob
        console.log('Date of Birth:', dob);

        // Check if the dob value is not empty
        if (dob) {
            var birthDate = new Date(dob);
            var today = new Date();

            // Debugging: Check if birthDate is valid
            console.log('Parsed Birth Date:', birthDate);

            // Check if birthDate is valid
            if (!isNaN(birthDate.getTime())) {
                var age = today.getFullYear() - birthDate.getFullYear();
                var month = today.getMonth() - birthDate.getMonth();

                // Adjust age if the birth date hasn't occurred yet this year
                if (month < 0 || (month === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }

                // Set the calculated age
                ageInput.value = age;
                console.log('Calculated Age:', age);
            } else {
                console.error('Invalid date:', dob);
                ageInput.value = 'Invalid DOB'; // Display an error message if the DOB is invalid
            }
        } else {
            ageInput.value = 'N/A'; // Handle case where DOB is not available
        }
    }

    // Calculate age on DOM content loaded and on date of birth change
    document.addEventListener('DOMContentLoaded', function() {
        calculateAge(); // Initial age calculation

        var dobInput = document.getElementById('dob');
        dobInput.addEventListener('change', calculateAge); // Update age on change
    });
    function printDiv() {
    var printContents = document.getElementById('form-section').innerHTML; // Replace 'printableArea' with your section ID
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents; // Restore original content after printing
}
</script>

</body>
</html>