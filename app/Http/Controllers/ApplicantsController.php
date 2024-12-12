<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Applicants;
use App\Models\DataForms;
use App\Models\UserActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ApplicantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all applicants
        $applicants = Applicants::all();
        
        // Return view with applicants data
        return view('applicant.portal', compact('applicants'));
    }

    /**
     * Show the form for creating a new resource.
     */

     public function create()
     {
        return view('applicant.apply');
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Applicant_type' => 'required',
            'LN' => 'required',
            'FN' => 'required',
            'MN' => 'nullable',
            'Suffix' => 'nullable',
            'IDpicture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            'Date_of_birth' => 'required|date',
            'Sex' => 'required',
           
            'Civil_status' => 'required',
            'Deaf' => 'nullable',
            'Intellectual' => 'nullable',
            'Learning' => 'nullable',
            'Mental' => 'nullable',
            'Physical' => 'nullable',
            'Psychosocial' => 'nullable',
            'Speech_and_Language' => 'nullable',
            'Visual' => 'nullable',
            'Cancer' => 'nullable',
            'Rare_Disease' => 'nullable',
            'Congenital_ADHD' => 'nullable',
            'Congenital_Cerebral' => 'nullable',
            'Congenital_Down' => 'nullable',
            'Congenital_Others' => 'nullable',
            'Acquired_Chronic' => 'nullable',
            'Acquired_Cerebral' => 'nullable',
            'Acquired_Injury' => 'nullable',
            'Acquired_Others' => 'nullable',
            'HouseNo_Street' => 'required',
            'Barangay' => 'required',
            'Municipality' => 'required',
            'Province' => 'required',
            'Region' => 'required',
            'Landline_No' => 'string|nullable',
            'Mobile_No' => 'string|nullable|max:11',
            'Email_address' => 'nullable',
            'Educational_Attainment' => 'required',
            'Status_of_Employment' => 'required',
            'Category_of_Employment' => 'required',
            'Type_of_Employment' => 'required',
            'Occupation' => 'required',
            'Birth_Cert' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'Brgy_Clearance' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'Valid_id' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'Medical_Assesment' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'old_city_id' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'Contact_Emergency' =>'required'
        ]);
        // Create a new instance of applicant
        $applicant = new Applicants();

        $applicant->Date_applied = now();
        $applicant->status ="Waiting For Approval";
        $applicant->remarks="N/A";
        
        
        // After saving, generate the Track_id using the new ID
        
    
        // Save the Track_id

    // Generate the next Track_id using the same logic from create method
    
        // Define your file inputs and respective folders
    $fileFields = [
        'IDpicture' => 'Applicant/images',
        'Birth_Cert' => 'Applicant/Birth_cert',
        'Brgy_Clearance' => 'Applicant/Brgy_Clearance',
        'Valid_id' => 'Applicant/Valid_ID',
        'Medical_Assesment' => 'Applicant/Medical_Assesment',
        'old_city_id' => 'Applicant/Tranfer_id'
    ];

    // Get the user's last name (LN) and first name (FN) from the form input
    $LN = $request->input('LN');
    $FN = $request->input('FN');
    foreach ($fileFields as $fieldName => $folder) {
        if ($request->hasFile($fieldName)) {
            // Get the original file extension
            $extension = $request->file($fieldName)->getClientOriginalExtension();
            
            // Create a custom file name using LN_FN and a timestamp for uniqueness
            $fileName = $LN . '_' . $FN . '_' . time() . '.' . $extension;
            
            // Store the file with the custom file name in the designated folder
            $path = $request->file($fieldName)->storeAs($folder, $fileName, 'public');
            
            // Dynamically assign the file path to the corresponding field in $applicant
            $applicant->$fieldName = $path;
        }
    }
        
        
        
        // Set all attributes from the request (excluding the uploaded files)
        $applicant->fill($request->except(['IDpicture','Birth_Cert','Brgy_Clearance','Valid_id','Medical_Assesment', 'old_city_id']));
        
        // Save the applicants instance
        // Generate a temporary Track_id before saving the record
        $applicant->Track_id = '1700-' . (Applicants::max('id') + 1);

        // Save the applicant record (this will give it an ID)
        $applicant->save();

        // After saving, update the Track_id correctly (in case it was generated incorrectly in case of concurrency)
        $applicant->Track_id = '1700-' . $applicant->id;
        $applicant->update(['Track_id' => $applicant->Track_id]);
    
        return redirect()->route('store.applicants')->with('success', 'Application Succesful, Your Track ID is ' . $applicant->Track_id . '. Please proceed to PDAO for further confirmation.');
            
    }


/*     public function generateNextTrackId()
    {
        // Get the last inserted ID (auto-incremented)
        $lastId = Applicants::max('id'); // Get the max 'id' from the applicants table
    
        // Generate the next Track_id based on the last ID
        $predefinedPart = '1700-';
         // Increment from the last id
        
        // Return the next Track_id
        return $predefinedPart . $lastId;
    }
 */
    



    protected function logUserActivity($userId, $activity)
    {
        UserActivityLog::create([
            'user_id' => $userId,
            'activity' => $activity,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $applicant = Applicants::find($id);
    
        // Prepare an array to hold disability names
        $diseases = [
            'disabilities' => [
                'Deaf or Hard of hearing' => $applicant->Deaf === 1 ? 'Deaf' : null,
                'Intellectual Disability' => $applicant->Intellectual === 1 ? 'Intellectual' : null,
                'Learning Disability' => $applicant->Learning === 1 ? 'Learning' : null,
                'Mental Disability' => $applicant->Mental === 1 ? 'Mental' : null,
                'Physical Disability' => $applicant->Physical === 1 ? 'Physical' : null,
                'Psychosocial Disability' => $applicant->Psychosocial === 1 ? 'Psychosocial' : null,
                'Speech and Language Impairment' => $applicant->Speech_and_Language === 1 ? 'Speech and Language' : null,
                'Visual Disability' => $applicant->Visual === 1 ? 'Visual' : null,
                'Cancer' => $applicant->Cancer === 1 ? 'Cancer' : null,
                'Rare Disease' => $applicant->Rare_Disease === 1 ? 'Rare Disease' : null,
            ],
            'congenital' => [
                'ADHD' => $applicant->Congenital_ADHD === 1 ? 'ADHD' : null,
                'Cerebral Palsy' => $applicant->Congenital_Cerebral === 1 ? 'Cerebral Palsy' : null,
                'Down Syndrome' => $applicant->Congenital_Down === 1 ? 'Down Syndrome' : null,
                $applicant->Congenital_Others !== "NONE" ? $applicant->Congenital_Others : null,
            ],
            'acquired' => [
                'Chronic Illness' => $applicant->Acquired_Chronic === 1 ? 'Chronic Illness' : null,
                'Cerebral Palsy' => $applicant->Acquired_Cerebral === 1 ? 'Cerebral Palsy' : null,
                'Injury' => $applicant->Acquired_Injury === 1 ? 'Injury' : null,
                $applicant->Acquired_Others !== "NONE" ? $applicant->Acquired_Others : null,
            ],
        ];
    
        // Filter out null values
        $diseases['disabilities'] = array_filter($diseases['disabilities']);
        $diseases['congenital'] = array_filter($diseases['congenital']);
        $diseases['acquired'] = array_filter($diseases['acquired']);
    
        return view('applicant.showInfo', compact('applicant', 'diseases'));
    }
    
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Applicants $applicants)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Applicants $applicants)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Applicants $applicants)
    {
        //
    }

/*     public function approveApplicant(Request $request, $id)
{
    // Validate required inputs
    $validated = $request->validate([
        'Process_Officer' => 'required|string|max:255',
        'Approve_Officer' => 'required|string|max:255',
        'Encoder' => 'required|string|max:255',
        'Reporting_Unit' => 'required|string|max:255',
        'Reporting_Office' => 'required|string|max:255',
        'Control_No' => 'required|string|max:255',
        // Add any other missing fields here
    ]);

    // Fetch the applicant data by ID
    $applicant = Applicants::findOrFail($id);

    // Handle file uploads first (ensure files are properly uploaded and stored)
    $fileFields = [
        'IDpicture' => 'Clients/images',
        'Birth_Cert' => 'Clients/Birth_cert',
        'Brgy_Clearance' => 'Clients/Brgy_Clearance',
        'Valid_id' => 'Clients/Valid_ID',
        'Medical_Assesment' => 'Clients/Medical_Assesment',
        'old_city_id' => 'Clients/Transfer_id'
    ];

    // Handle file uploads before saving applicant
    foreach ($fileFields as $fieldName => $folder) {
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            $newFileName = $applicant->LN . '_' . $applicant->FN . '_' . time() . '.' . $file->getClientOriginalExtension();
            $targetPath = $folder . '/' . $newFileName;

            // Ensure the folder exists
            if (!Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->makeDirectory($folder);
            }

            // Store the file and update the field path
            $file->storeAs($folder, $newFileName, 'public');
            $applicant->$fieldName = $targetPath;
        }
    }

    // Save the updated applicant data
    $applicant->save();

    // Generate the next PWD_id
    $lastDataForm = DataForms::orderBy('PWD_id', 'desc')->first();
    $predefinedPart = '137604000-';

    if ($lastDataForm) {
        $lastIdNum = intval(substr($lastDataForm->PWD_id, strlen($predefinedPart)));
        $nextIdNum = $lastIdNum + 1;
    } else {
        $nextIdNum = 1;
    }

    $newPWD_id = $predefinedPart . $nextIdNum;

    // Insert applicant data into data_forms with the new PWD_id
    DataForms::create([
        'Applicant_type' => $applicant->Applicant_type,
        'PWD_id' => $newPWD_id,
        'Date_applied' => $applicant->Date_applied,
        'LN' => $applicant->LN,
        'FN' => $applicant->FN,
        'MN' => $applicant->MN,
        'Suffix' => $applicant->Suffix,
        'Date_of_birth' => $applicant->Date_of_birth,
        'Sex' => $applicant->Sex,
        'Civil_status' => $applicant->Civil_status,
        'IDpicture' => $applicant->IDpicture,
        'path' => $applicant->path,
        'Deaf' => $applicant->Deaf,
        'Intellectual' => $applicant->Intellectual,
        'Learning' => $applicant->Learning,
        'Mental' => $applicant->Mental,
        'Physical' => $applicant->Physical,
        'Psychosocial' => $applicant->Psychosocial,
        'Speech_and_Language' => $applicant->Speech_and_Language,
        'Visual' => $applicant->Visual,
        'Cancer' => $applicant->Cancer,
        'Rare_Disease' => $applicant->Rare_Disease,
        'Congenital_ADHD' => $applicant->Congenital_ADHD,
        'Congenital_Cerebral' => $applicant->Congenital_Cerebral,
        'Congenital_Down' => $applicant->Congenital_Down,
        'Congenital_Others' => $applicant->Congenital_Others,
        'Acquired_Chronic' => $applicant->Acquired_Chronic,
        'Acquired_Cerebral' => $applicant->Acquired_Cerebral,
        'Acquired_Injury' => $applicant->Acquired_Injury,
        'Acquired_Others' => $applicant->Acquired_Others,
        'HouseNo_Street' => $applicant->HouseNo_Street,
        'Barangay' => $applicant->Barangay,
        'Municipality' => $applicant->Municipality,
        'Province' => $applicant->Province,
        'Region' => $applicant->Region,
        'Landline_No' => $applicant->Landline_No,
        'Mobile_No' => $applicant->Mobile_No,
        'Email_address' => $applicant->Email_address,
        'Educational_Attainment' => $applicant->Educational_Attainment,
        'Status_of_Employment' => $applicant->Status_of_Employment,
        'Category_of_Employment' => $applicant->Category_of_Employment,
        'Type_of_Employment' => $applicant->Type_of_Employment,
        'Occupation' => $applicant->Occupation,
        'Accomplished_By' => $applicant->Accomplished_By,
        'A_LN' => $applicant->A_LN,
        'A_FN' => $applicant->A_FN,
        'A_MN' => $applicant->A_MN,
        'Cert_Physician' => $applicant->Cert_Physician,
        'Physician_License' => $request->input('Physician_License', 'default_value'), // Use input from form or set default
        'Process_Officer' => $request->input('Process_Officer'),
        'Approve_Officer' => $request->input('Approve_Officer'),
        'Encoder' => $request->input('Encoder'),
        'Reporting_Unit' => $request->input('Reporting_Unit'),
        'Reporting_Office' => $request->input('Reporting_Office'),
        'Control_No' => $request->input('Control_No'),
        'ContactPerson_No' => $applicant->ContactPerson_No,
        'Birth_Cert' => $applicant->Birth_Cert,
        'Brgy_Clearance' => $applicant->Brgy_Clearance,
        'Valid_id' => $applicant->Valid_id,
        'Medical_Assesment' => $applicant->Medical_Assesment,
        'Auth_letter' => $applicant->Auth_letter,
        'old_city_id' => $applicant->old_city_id,
        'Contact_Emergency' => $applicant->Contact_Emergency,
    ]);

    // Log user activity
    $this->logUserActivity(Auth::guard('user')->id(), 'Approved applicant and created a new data with PWD_id: ' . $newPWD_id);

    // After transfer, delete or mark the applicant as transferred
    $applicant->delete(); // Or mark it as transferred if necessary

    // Return a response
    return redirect()->route('views');
} */






public function approveApplicant(Request $request, $id)
{
    $validated = $request->validate([
        'Process_Officer' => 'required|string|max:255',
        'Approve_Officer' => 'required|string|max:255',
        'Encoder' => 'required|string|max:255',
        'Reporting_Unit' => 'required|string|max:255',
        'Reporting_Office' => 'required|string|max:255',
        'Control_No' => 'required|string|max:255',
        // Add any other missing fields here
    ]);
    // Fetch the applicant data by ID
    $applicant = Applicants::findOrFail($id);

    // Generate the next PWD_id
    $lastDataForm = DataForms::orderBy('PWD_id', 'desc')->first();
    $predefinedPart = '137604000-';

    if ($lastDataForm) {
        // Extract the last numeric part and increment
        $lastIdNum = intval(substr($lastDataForm->PWD_id, strlen($predefinedPart)));
        $nextIdNum = $lastIdNum + 1;
    } else {
        // If no data exists, start from 1
        $nextIdNum = 1;
    }

    // Create the new PWD_id with the predefined part
    $newPWD_id = $predefinedPart . $nextIdNum;

    // Define the file fields and their respective folder paths
    $fileFields = [
        'IDpicture' => 'Clients/images',
        'Birth_Cert' => 'Clients/Birth_cert',
        'Brgy_Clearance' => 'Clients/Brgy_Clearance',
        'Valid_id' => 'Clients/Valid_ID',
        'Medical_Assesment' => 'Clients/Medical_Assesment',
        'old_city_id' => 'Clients/Transfer_id'
    ];
    foreach ($fileFields as $fieldName => $folder) {
        if (!empty($applicant->$fieldName)) {
            // Get the relative file path from the applicant's record (use the 'storage' folder)
            $oldPath = storage_path('app/public/' . $applicant->$fieldName); // Full path to the file
    
            if (file_exists($oldPath)) {
                // Get the file extension
                $extension = pathinfo($oldPath, PATHINFO_EXTENSION);
            
                // Create a new file name for uniqueness
                $newFileName = $applicant->LN . '_' . $applicant->FN . '_' . time() . '.' . $extension;
            
                // Define the target path where the file should be moved
                $targetPath = $folder . '/' . $newFileName;
            
                // Ensure the target directory exists (creating it if necessary)
                if (!Storage::disk('public')->exists($folder)) {
                    Storage::disk('public')->makeDirectory($folder);
                }
            
                // Move the file to the new directory using putFileAs
                Storage::disk('public')->putFileAs($folder, new \Illuminate\Http\File($oldPath), $newFileName);
            
                // Delete the file from the old location after moving it
                Storage::delete($applicant->$fieldName); // Delete from the old location
            
                // Update the applicant record with the new path
                $applicant->$fieldName = $targetPath; // Store the relative path only
            }
            
        }
    }
    
    // Insert the applicant data into data_forms with the new PWD_id
    DataForms::create([
        'Applicant_type' => $applicant->Applicant_type,
        'PWD_id' => $newPWD_id,
        'Date_applied' => $applicant->Date_applied,
        'LN' => $applicant->LN,
        'FN' => $applicant->FN,
        'MN' => $applicant->MN,
        'Suffix' => $applicant->Suffix,
        'Date_of_birth' => $applicant->Date_of_birth,
        'Sex' => $applicant->Sex,
        'Civil_status' => $applicant->Civil_status,
        'IDpicture' => $applicant->IDpicture,
        'path' => $applicant->path,
        'Deaf' => $applicant->Deaf,
        'Intellectual' => $applicant->Intellectual,
        'Learning' => $applicant->Learning,
        'Mental' => $applicant->Mental,
        'Physical' => $applicant->Physical,
        'Psychosocial' => $applicant->Psychosocial,
        'Speech_and_Language' => $applicant->Speech_and_Language,
        'Visual' => $applicant->Visual,
        'Cancer' => $applicant->Cancer,
        'Rare_Disease' => $applicant->Rare_Disease,
        'Congenital_ADHD' => $applicant->Congenital_ADHD,
        'Congenital_Cerebral' => $applicant->Congenital_Cerebral,
        'Congenital_Down' => $applicant->Congenital_Down,
        'Congenital_Others' => $applicant->Congenital_Others,
        'Acquired_Chronic' => $applicant->Acquired_Chronic,
        'Acquired_Cerebral' => $applicant->Acquired_Cerebral,
        'Acquired_Injury' => $applicant->Acquired_Injury,
        'Acquired_Others' => $applicant->Acquired_Others,
        'HouseNo_Street' => $applicant->HouseNo_Street,
        'Barangay' => $applicant->Barangay,
        'Municipality' => $applicant->Municipality,
        'Province' => $applicant->Province,
        'Region' => $applicant->Region,
        'Landline_No' => $applicant->Landline_No,
        'Mobile_No' => $applicant->Mobile_No,
        'Email_address' => $applicant->Email_address,
        'Educational_Attainment' => $applicant->Educational_Attainment,
        'Status_of_Employment' => $applicant->Status_of_Employment,
        'Category_of_Employment' => $applicant->Category_of_Employment,
        'Type_of_Employment' => $applicant->Type_of_Employment,
        'Occupation' => $applicant->Occupation,
        'Org_Affiliation' => $applicant->Org_Affiliation,
        'Org_Contact' => $applicant->Org_Contact,
        'Org_Office' => $applicant->Org_Office,
        'Org_Tel' => $applicant->Org_Tel,
        'SSS_No' => $applicant->SSS_No,
        'GSIS_No' => $applicant->GSIS_No,
        'Pagibig_No' => $applicant->Pagibig_No,
        'PSN_No' => $applicant->PSN_No,
        'Philhealth_No' => $applicant->Philhealth_No,
        'Father_LN' => $applicant->Father_LN,
        'Father_FN' => $applicant->Father_FN,
        'Father_MN' => $applicant->Father_MN,
        'Mother_LN' => $applicant->Mother_LN,
        'Mother_FN' => $applicant->Mother_FN,
        'Mother_MN' => $applicant->Mother_MN,
        'Guardian_LN' => $applicant->Guardian_LN,
        'Guardian_FN' => $applicant->Guardian_FN,
        'Guardian_MN' => $applicant->Guardian_MN,
        'Accomplished_By' => $applicant->Accomplished_By,
        'A_LN' => $applicant->A_LN,
        'A_FN' => $applicant->A_FN,
        'A_MN' => $applicant->A_MN,
        'Cert_Physician' => $applicant->Cert_Physician,
        'Physician_License' => $request->input('Physician_License'), // Use input from form or set default
        'Process_Officer' => $request->input('Process_Officer'),
        'Approve_Officer' => $request->input('Approve_Officer'),
        'Encoder' => $request->input('Encoder'),
        'Reporting_Unit' => $request->input('Reporting_Unit'),
        'Reporting_Office' => $request->input('Reporting_Office'),
        'Control_No' => $request->input('Control_No'),
        'ContactPerson_No' => $applicant->ContactPerson_No,
        'Birth_Cert' => $applicant->Birth_Cert,
        'Brgy_Clearance' => $applicant->Brgy_Clearance,
        'Valid_id' => $applicant->Valid_id,
        'Medical_Assesment' => $applicant->Medical_Assesment,
        'Auth_letter' => $applicant->Auth_letter,
        'old_city_id' => $applicant->old_city_id,
        'Contact_Emergency' => $applicant->Contact_Emergency,
    ]);

    $this->logUserActivity(Auth::guard('user')->id(), 'Approved applicant and created a new data with PWD_id: ' . $newPWD_id);

    // After transfer, you may delete the applicant or mark as transferred
    $applicant->delete(); // Or update its status

    // Return a response, e.g., redirect or return to a view
    return redirect()->route('views');
}


public function pending(Request $request, $id)
{
    $request->validate([
        'remarks' => 'required' // Ensures remarks is provided
    ]);

    $applicant = Applicants::find($id);

    if ($applicant) {
        $applicant->status = 'PENDING';
        $applicant->remarks = $request->input('remarks'); // Save remarks to the database
        $applicant->save();
    }

    // Redirect to index with an error message
    return redirect()->route('applicants.index')->with('success', 'Applicant Succesfully marked as Pending');
}



}
