<?php

namespace App\Http\Controllers;

use App\Exports\ExpiredExport;
use App\Models\DataForms;
use App\Models\ExpiredRecord;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
class ExpiredController extends Controller
{




    public function showExpiredRecords(Request $request)
{
    $defaultApplicantTypes = ['EXPIRED'];
    
    // Get the applicant types from the request or use the default
    $applicantTypes = $request->input('applicant_types', $defaultApplicantTypes);

    // Retrieve the filtered data based on the applicant types
    $expiredRecords = ExpiredRecord::whereIn('Applicant_type', $applicantTypes)->get();
    
    return view('expired.index', compact('expiredRecords', 'applicantTypes'));
}

public function filter(Request $request) {
    $defaultChecked = ['EXPIRED'];

    // Get the applicant types from the request or use defaults
    $applicantTypes = $request->input('applicant_types', $defaultChecked);

    // Query the DataForms model based on the selected applicant types
    $query = ExpiredRecord::query();

    // Apply filter if there are selected applicant types
    if (!empty($applicantTypes)) {
        $query->whereIn('Applicant_type', $applicantTypes);
    }

    if ($request->filled('Barangay')) {
        $query->where('Barangay', $request->input('Barangay'));
    }

    $expiredRecords = $query->get();

    // Pass both the data and the selected applicant types to the view
    return view('expired.index', compact('expiredRecords', 'applicantTypes'));
}





    public function archive(Request $request)
{
    $ids = $request->input('ids');

    // Get the records from data_forms
    $records = DataForms::whereIn('id', $ids)->get();

    // Move records to expired_records
    foreach ($records as $record) {
        ExpiredRecord::create($record->toArray()); // Assuming both tables have the same structure
        $record->delete(); // Delete from data_forms
    }      
}

public function restore(Request $request)
{
    $ids = $request->input('ids');

    // Get the records from expired_records
    $record = ExpiredRecord::whereIn('id', $ids)->get();

    $errorMessages = [];
    
    // Check for duplicate PWD IDs before restoring anything
    foreach ($record as $records) {
        $existingRecord = DataForms::where('PWD_id', $records->PWD_id)->first();

        // If PWD ID already exists, add an error message
        if ($existingRecord) {
            $errorMessages[] = "PWD ID '{$records->PWD_id}' already exists.";
        }
    }

    // If there are any error messages, stop the restore process and return the errors
    if (count($errorMessages) > 0) {
        return response()->json(['errors' => $errorMessages], 422);
    }

    // If no errors, proceed with the restore process
    foreach ($record as $records) {
        DataForms::create($records->toArray());
        $records->delete(); // Delete from expired_records
    }

    return response()->json(['success' => 'Records restored successfully']);
}




public function exportSelected(Request $request)
{
    $ids = json_decode($request->input('ids', '[]'), true); // Decode JSON string to array
    return Excel::download(new ExpiredExport($ids), 'Expired.xlsx');
}

public function index(Request $request)
{
    // Set default checked values
    $defaultApplicantTypes = ['Active', 'New Applicant', 'Transferee', 'Active Transferee'];

    // Get the applicant types from the request or use the default
    $applicantTypes = $request->input('applicant_types', $defaultApplicantTypes);

    // Start the query
    $query = ExpiredRecord::query();

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
    $expiredRecords = $query->paginate(50);

    // Pass both the data and the selected applicant types to the view
    
    return view('expired.index', compact('expiredRecords', 'applicantTypes'));
}



}