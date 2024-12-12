<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\UserActivityLog;
use Spatie\Browsershot\Browsershot;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\ExpiredRecord;
use App\Models\DataForms;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
class DataFormsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function preview($id)
    {
    // Fetch the form data by ID
    $dataForm = DataForms::find($id);

    // Check if the form data exists
    if (!$dataForm) {
        return redirect()->back()->with('error', 'Data not found!');
    }
    // Return the preview view with the form data
    return view('PDAO.print', compact('dataForm'));
    }

    public function index(Request $request)
    {
        // Set default checked values
        $defaultApplicantTypes = ['Active', 'New Applicant', 'Transferee', 'Active Transferee'];
    
        // Get the applicant types from the request or use the default
        $applicantTypes = $request->input('applicant_types', $defaultApplicantTypes);
    
        // Start the query
        $query = DataForms::query();
    
        // Filter the data based on applicant types
        if (!empty($applicantTypes)) {
            $query->whereIn('Applicant_type', $applicantTypes);
        }
    
        // Add additional filters if applicable
        if ($request->filled('Barangay')) {
            $query->where('Barangay', $request->input('Barangay'));
        }
    
        if ($request->filled('Disabilities')) {
            switch ($request->Disabilities) {
                case 'deaf':
                    $query->where('Deaf', 1);
                    break;
                case 'intellectual':
                    $query->where('Intellectual', 1);
                    break;
                case 'learning':
                    $query->where('Learning', 1);
                    break;
                case 'mental':
                    $query->where('Mental', 1);
                    break;
                case 'physical':
                    $query->where('Physical', 1);
                    break;
                case 'psychosocial':
                    $query->where('Psychosocial', 1);
                    break;
                case 'speech':
                    $query->where('Speech_and_Language', 1);
                    break;
                case 'visual':
                    $query->where('Visual', 1);
                    break;
                case 'cancer':
                    $query->where('Cancer', 1);
                    break;
                case 'rare':
                    $query->where('Rare_Disease', 1);
                    break;
                case 'adhd':
                    $query->where('Congenital_ADHD', 1);
                    break;
                case 'cp':
                    $query->where('Congenital_Cerebral', 1);
                    break;
                case 'down':
                    $query->where('Congenital_Down', 1);
                    break;
                case 'others':
                    $query->whereNotNull('Congenital_Others');
                    break;
                case 'chronic':
                    $query->where('Acquired_Chronic', 1);
                    break;
                case 'cp2':
                    $query->where('Acquired_Cerebral', 1);
                    break;
                case 'injury':
                    $query->where('Acquired_Injury', 1);
                    break;
                case 'others2':
                    $query->whereNotNull('Acquired_Others');
                    break;
            }
        }
    
        // Paginate the results
        $dataForms = $query->paginate(50);
    
        // Pass both the data and the selected applicant types to the view
        return view('PDAO.views', compact('dataForms', 'applicantTypes'));
    }
    
    



    public function exportSelected(Request $request)
    {
        $ids = json_decode($request->input('ids', '[]'), true); // Decode JSON string to array
        return Excel::download(new UsersExport($ids), 'PDAO.xlsx');
    }

    public function importExcel(Request $request)
    {
        // Log that the function has been triggered
        Log::info('importExcel function triggered.');
    
        // Validate the incoming file
        $request->validate([
            'file' => ['required', 'file'],
        ]);
    
        // Log file validation success
        Log::info('File validation successful.', [
            'file_name' => $request->file('file')->getClientOriginalName(),
            'file_path' => $request->file('file')->getPathName(),
        ]);
    
        try {
            // Log before starting the import process
            Log::info('Starting Excel import process.');
    
            // Import the Excel file
            Excel::import(new UsersImport, $request->file('file'));
    
            // Log successful import
            Log::info('Excel import completed successfully.');
    
            return redirect()->back()->with('success', 'Excel data imported successfully.');
        } catch (\Exception $e) {
            // Log the error details
            Log::error('Error during Excel import:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
    
            return redirect()->back()->with('error', 'Failed to import data: ' . $e->getMessage());
        }
    }
    



    public function Home()
    {
        $records = DataForms::pluck('Date_applied')->toArray(); // This will get an array of dates

        // Count records added today and last week
        $today = count(array_filter($records, fn($date) => \Carbon\Carbon::parse($date)->isToday()));
        $lastWeek = count(array_filter($records, fn($date) => \Carbon\Carbon::parse($date)->isLastWeek()));
    
        return view('PDAO.home', compact('records', 'today', 'lastWeek')); // Pass variables to the view
    }


    /**
     * Show the form for creating a new resource.
     */

    /**
     * Rommel FIX PWD_ID HERE
     * Other
     * 
     */
    public function create()
    {
        // Get the last PWD_id from the database, and the archive
        $lastDataForm = DataForms::orderBy('PWD_id', 'desc')->first();
        $lastarchiveid = ExpiredRecord::orderBy('PWD_id', 'desc')->first();

        if ($lastDataForm>$lastarchiveid){
            $recentid = $lastDataForm;
        }
        else {
            $recentid = $lastarchiveid;
        }
        
        // Define the predefined part of the ID
        $predefinedPart = '137604000-';
        
        // Determine the next number
        if ($recentid) {
            $lastIdNum = intval(substr($recentid->PWD_id, strlen($predefinedPart)));
            $nextIdNum = $lastIdNum + 1;
        } else {
            $nextIdNum = 1; // Start from 1 if no records exist
        }
        
        // Create the next PWD_id
        $nextPWD_id = $predefinedPart . $nextIdNum;
    
        return view('PDAO.forms', compact('nextPWD_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Applicant_type' => 'required',
            'PWD_id' => 'required',
            'Date_applied' => 'required|date',
            'Date_renewed' => 'nullable|date',
            'LN' => 'required',
            'FN' => 'required',
            'MN' => 'required',
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
            'Landline_No' => 'integer|nullable',
            'Mobile_No' => 'string|nullable|max:11',
            'Email_address' => 'nullable',
            'Educational_Attainment' => 'required',
            'Status_of_Employment' => 'required',
            'Category_of_Employment' => 'required',
            'Type_of_Employment' => 'required',
            'Occupation' => 'required',
            'Org_Affiliation' => 'nullable',
            'Org_Contact' => 'nullable',
            'Org_Office' => 'nullable',
            'Org_Tel' => 'nullable',
            'SSS_No' => 'nullable',
            'GSIS_No' => 'nullable',
            'Pagibig_No' => 'nullable',
            'PSN_No' => 'nullable',
            'Philhealth_No' => 'nullable',
            'Father_LN' => 'nullable',
            'Father_FN' => 'nullable',
            'Father_MN' => 'nullable',
            'Mother_LN' => 'nullable',
            'Mother_FN' => 'nullable',
            'Mother_MN' => 'nullable',
            'Guardian_LN' => 'nullable',
            'Guardian_FN' => 'nullable',
            'Guardian_MN' => 'nullable',
            'Accomplished_By' => 'nullable',
            'A_LN' => 'nullable',
            'A_FN' => 'nullable',
            'A_MN' => 'nullable',
            'Cert_Physician' => 'nullable',
            'Physician_License' => 'nullable',

            'Birth_Cert' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'Brgy_Clearance' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'Valid_id' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'Medical_Assesment' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'old_city_id' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'Contact_Emergency' =>'required'
        ]);
        // Create a new instance of DataForms
        $dataForm = new DataForms();
        // Define your file inputs and respective folders
    $fileFields = [
        'IDpicture' => 'Clients/images',
        'Birth_Cert' => 'Clients/Birth_cert',
        'Brgy_Clearance' => 'Clients/Brgy_Clearance',
        'Valid_id' => 'Clients/Valid_ID',
        'Medical_Assesment' => 'Clients/Medical_Assesment',
        'old_city_id' => 'Clients/Tranfer_id'
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
            
            // Dynamically assign the file path to the corresponding field in $dataForm
            $dataForm->$fieldName = $path;
        }
    }
        
        
        
        // Set all attributes from the request (excluding the uploaded files)
        $dataForm->fill($request->except(['IDpicture','Birth_Cert','Brgy_Clearance','Valid_id','Medical_Assesment', 'old_city_id']));


        // Calculate and set expiry date
        $dataForm->expiry_date = \Carbon\Carbon::parse($request->input('Date_applied'))->addYears(5);
    
        // Save the DataForms instance
        $dataForm->save();
        // Log user activity for the newly created data
        $this->logUserActivity(Auth::guard('user')->id(), 'Created a new data form with PWD_id: ' . $dataForm->PWD_id);
    
        return redirect()->route('views')->with('success', 'Data saved successfully!');
            
    }


    protected function logUserActivity($userId, $activity)
{
    UserActivityLog::create([
        'user_id' => $userId,
        'activity' => $activity,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}


    // Search for the data form
    public function showRenewForm(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->input('search');
            $dataForms = DataForms::where('FN', 'LIKE', "%$search%")
                ->orWhere('LN', 'LIKE', "%$search%")
                ->orWhere('PWD_id', 'LIKE', "%$search%") // Allow partial matches for PWD_id
                ->get();
    
            return response()->json($dataForms);
        }
    
        return view('PDAO.renew'); // This view should not include the dataForms by default
    }

    // Update the data form with the new renewal date
    public function updateRenewal(Request $request, $id)
    {
        $request->validate([
            'Date_renewed' => 'required|date|after_or_equal:today',
        ]);
    
        $dataForm = DataForms::findOrFail($id);
        $dataForm->Date_renewed = $request->Date_renewed;
    
        // Check if old_city_id has a value
        if (!empty($dataForm->old_city_id)) {
            $dataForm->Applicant_type = 'Active Transferee'; // Set to Active Transferee if old_city_id has a value
        } else {
            $dataForm->Applicant_type = 'Active'; // Set to Active if old_city_id is empty
        }
    
        // Calculate new expiry date (5 years from the renewed date)
        $expiryDate = \Carbon\Carbon::parse($request->Date_renewed)->addYears(5);
        $dataForm->expiry_date = $expiryDate;
    
        $dataForm->save();
    
        return redirect()->route('views')->with('success', 'Renewal successful');
    }
    




    private function generateNextIdNum($lastIdNum)
    {
        // Define the predefined part of the ID
        $predefinedPart = '137604000-';

        if (!$lastIdNum) {
            return $predefinedPart . '1'; // Start with 1 if no records exist
        }

        // Extract the numeric part of the last IDNum and increment it
        $lastNumber = intval(substr($lastIdNum, strlen($predefinedPart)));
        $nextNumber = $lastNumber + 1;

        return $predefinedPart . $nextNumber;
    }

    /**
     * Display the specified resource.
     */
    public function showApplicants()
    {
        return view('PDAO.portal');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dataForm = DataForms::findOrFail($id);
        return view('PDAO.edit', compact('dataForm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $dataForm = DataForms::findOrFail($id);

        $dataForm->Deaf = $request->has('Deaf') ? 1:0;
        $dataForm->Intellectual = $request->has('Intellectual') ? 1:0;
        $dataForm->Learning = $request->has('Learning') ? 1:0;
        $dataForm->Mental = $request->has('Mental') ? 1:0;
        $dataForm->Physical = $request->has('Physical') ? 1:0;
        $dataForm->Psychosocial = $request->has('Psychosocial') ? 1:0;
        $dataForm->Speech_and_Language = $request->has('Speech_and_Language') ? 1:0;
        $dataForm->Visual = $request->has('Visual') ? 1:0;
        $dataForm->Cancer = $request->has('Cancer') ? 1:0;
        $dataForm->Rare_Disease = $request->has('Rare_Disease') ? 1:0;

        $dataForm->Congenital_ADHD = $request->has('Congenital_ADHD') ? 1:0;
        $dataForm->Congenital_Cerebral = $request->has('Congenital_Cerebral') ? 1:0;
        $dataForm->Congenital_Down = $request->has('Congenital_Down') ? 1:0;
        $dataForm->Congenital_Others = $request->has('Congenital_Others', NULL);

        $dataForm->Acquired_Chronic = $request->has('Acquired_Chronic') ? 1:0;
        $dataForm->Acquired_Cerebral = $request->has('Acquired_Cerebral') ? 1:0;
        $dataForm->Acquired_Injury = $request->has('Acquired_Injury') ? 1:0;
        $dataForm->Acquired_Others = $request->has('Acquired_Others', NULL);

        $dataForm->update($request->all());


        $request->validate([
            'Birth_Cert' => 'image|mimes:jpeg,png,jpg|max:2048',
            'Brgy_Clearance' => 'image|mimes:jpeg,png,jpg|max:2048',
            'Valid_id' => 'image|mimes:jpeg,png,jpg|max:2048',
            'Medical_Assesment' => 'image|mimes:jpeg,png,jpg|max:2048',
            'old_city_id' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $dataForm->update($request->all());
        
    
        // Define file inputs and respective folders
        $fileFields = [
            'Birth_Cert' => 'Clients/Birth_cert',
            'Brgy_Clearance' => 'Clients/Brgy_Clearance',
            'Valid_id' => 'Clients/Valid_ID',
            'Medical_Assesment' => 'Clients/Medical_Assesment',
            'old_city_id' => 'Clients/Transfer_id',
        ];
        foreach ($fileFields as $fieldName => $folder) {
            if ($request->hasFile($fieldName)) {

                
                // Delete old file if it exists
                if ($dataForm->$fieldName) {
                    Storage::disk('public')->delete($dataForm->$fieldName);
                }
        
                // Generate the new file name with "updated" tag
                $extension = $request->file($fieldName)->getClientOriginalExtension();
                $timestamp = time(); // Add a timestamp to ensure uniqueness
                $fileName = $dataForm->LN . '_' . $dataForm->FN . '_updated_' . $timestamp . '.' . $extension;
        
                // Save the file
                $path = $request->file($fieldName)->storeAs($folder, $fileName, 'public');
        
                // Update the model with the new file path
                $dataForm->$fieldName = $path;
            }
        }
    
            
            

            // Save changes
            $dataForm->save();

            return redirect()->route('views')->with('success', 'Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */


public function getDiseases($id)
{
    $dataForm = DataForms::find($id); // Fetch the data form by ID

    $diseases = [
        'disabilities' => [
            'Deaf or Hard of hearing' => $dataForm->Deaf === 1 ? 'Deaf' : null,
            'Intellectual Disability' => $dataForm->Intellectual === 1 ? 'Intellectual' : null,
            'Learning Disability' => $dataForm->Learning === 1 ? 'Learning' : null,
            'Mental Disability' => $dataForm->Mental === 1 ? 'Mental' : null,
            'Physical Disability' => $dataForm->Physical === 1 ? 'Physical' : null,
            'Psychosocial Disability' => $dataForm->Psychosocial === 1 ? 'Psychosocial' : null,
            'Speech and Language Impairment' => $dataForm->Speech_and_Language === 1 ? 'Speech and Language' : null,
            'Visual Disability' => $dataForm->Visual === 1 ? 'Visual' : null,
            'Cancer' => $dataForm->Cancer === 1 ? 'Cancer' : null,
            'Rare Disease' => $dataForm->Rare_Disease === 1 ? 'Rare Disease' : null,
        ],
        'congenital' => [
            'ADHD' => $dataForm->Congenital_ADHD === 1 ? 'ADHD' : null,
            'Cerebral Palsy' => $dataForm->Congenital_Cerebral === 1 ? 'Cerebral Palsy' : null,
            'Down Syndrome' => $dataForm->Congenital_Down === 1 ? 'Down Syndrome' : null,
            $dataForm->Congenital_Others !== "NONE" ? $dataForm->Congenital_Others : null,
        ],
        'acquired' => [
            'Chronic Illness' => $dataForm->Acquired_Chronic === 1 ? 'Chronic Illness' : null,
            'Cerebral Palsy' => $dataForm->Acquired_Cerebral === 1 ? 'Cerebral Palsy' : null,
            'Injury' => $dataForm->Acquired_Injury === 1 ? 'Injury' : null,
            $dataForm->Acquired_Others !== "NONE" ? $dataForm->Acquired_Others : null,
        ],
    ];

    // Filter out null values
    $diseases['disabilities'] = array_filter($diseases['disabilities']);
    $diseases['congenital'] = array_filter($diseases['congenital']);
    $diseases['acquired'] = array_filter($diseases['acquired']);

    return response()->json($diseases);
}

public function getUserDetails($id)
{
    $form = DataForms::find($id);
    return response()->json($form);
}
public function transferSelected(Request $request)
{
    // Collect the selected IDs from the request
    $selectedIds = $request->input('selected_ids');

    // Pass the IDs to the ExpiredController's transfer function
    return redirect()->route('expired.transfer', ['ids' => $selectedIds]);
}

public function getDisabilityCounts(Request $request)
{
    // Validate the incoming request for barangay
    $request->validate([
        'barangay' => 'required|string',
    ]);

    // Get the selected barangay
    $selectedBarangay = $request->input('barangay');

    // Count records where the value is 1 and filter by the selected barangay
    $counts = DataForms::where('Barangay', $selectedBarangay)
        ->selectRaw('
            SUM(Deaf) as deaf,
            SUM(Intellectual) as intellectual,
            SUM(Learning) as learning,
            SUM(Mental) as mental,
            SUM(Physical) as physical,
            SUM(Psychosocial) as psychosocial,
            SUM(Speech_and_Language) as speech_and_language,
            SUM(Visual) as visual,
            SUM(Cancer) as cancer,
            SUM(Rare_Disease) as rare_disease
        ')
        ->first();

    return response()->json($counts);
}

public function causesofdisabilities(Request $request)
{
    // Validate the incoming request for barangay
    $request->validate([
        'barangay' => 'required|string',
    ]);

    // Get the selected barangay
    $selectedBarangay = $request->input('barangay');

    // Count records where the value is 1 and filter by the selected barangay
    $counts = DataForms::where('Barangay', $selectedBarangay)
        ->selectRaw('
            SUM(Congenital_ADHD) as congenital_adhd,
            SUM(Congenital_Cerebral) as congenital_cerebral,
            SUM(Congenital_Down) as congenital_down,
            SUM(Congenital_Others IS NOT NULL AND Congenital_Others != "NONE") as congenital_others,
            SUM(Acquired_Chronic) as acquired_chronic,
            SUM(Acquired_Cerebral) as acquired_cerebral,
            SUM(Acquired_Injury) as acquired_injury,
            SUM(Acquired_Others IS NOT NULL AND Acquired_Others != "NONE") as acquired_others
        ')
        ->first();

    return response()->json($counts);
}

public function getAttachments($id)
{
    $form = DataForms::findOrFail($id);

    $attachments = [
        ['name' => 'Birth Certificate', 'url' => asset('storage/' . $form->Birth_Cert)],
        ['name' => 'Barangay Clearance', 'url' => asset('storage/' . $form->Brgy_Clearance)],
        ['name' => 'Valid ID', 'url' => asset('storage/' . $form->Valid_id)],
        ['name' => 'Medical Assessment', 'url' => asset('storage/' . $form->Medical_Assesment)],
        ['name' => 'Old City ID', 'url' => asset('storage/' . $form->old_city_id)],
    ];

    // Filter out missing files
    $attachments = array_filter($attachments, fn($file) => !empty($file['url']));

    return response()->json($attachments);
}






}
