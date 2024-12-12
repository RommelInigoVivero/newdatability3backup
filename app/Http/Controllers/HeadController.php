<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\AdminActivityLog;
use App\Models\DataForms;
use App\Models\Head;
use App\Models\User;
use App\Models\UserActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        return view('HEAD.admin_views', compact('dataForms', 'applicantTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Head $head)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Head $head)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Head $head)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Head $head)
    {
        //
    }


    public function register(Request $request)
{
    $request->validate([
        'Lname' => 'required|string',
        'Fname' => 'required|string',
        'username' => 'required|string',
        'email' => 'required|email|unique:users,email|unique:admins,email',
        'password' => 'required|string|min:8',
        'role' => 'required|string'
    ]);

    // Restrict to only "HEAD" role
    
        // Store in the appropriate table (head or User based on your needs)
        Head::create([
            'Lname' => $request->Lname,
            'Fname' => $request->Fname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role

        ]);


    return view('HEAD.login');
}

public function loginPost(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    $credentials = $request->only('username', 'password');

    // Attempt to find the head user by username and check if the role is "HEAD"
    $head = Head::where('username', $request->username)->where('role', 'HEAD')->first();

    if ($head) {
        // Check if the account is suspended
        if ($head->status === 'SUSPENDED') {
            return redirect()->back()->with('error', 'Your account is suspended. Please inquire at the ITDD office.');
        }

        // Attempt to log in using the head guard
        if (Auth::guard('head')->attempt($credentials)) {
            // Log the successful login attempt (if necessary)
            // You can add any other login logic here, but since we are not logging activities, we'll skip activity logging.

            return redirect()->intended(route('HEAD.dashboard'));
        }
    }

    // Redirect back with an error message if login fails
    return view('HEAD.login')->with('error', 'Login Failed: Account does not exist, incorrect password, or not authorized as HEAD.');
}



public function dashboard()
    {
        return view('HEAD.dashboard');  // Redirect to the head dashboard view
    }

    public function accountDetails()
    {
        $admins = Admin::all();
        $users = User::all();
        
        // Fetch activity logs for today using `created_at`
        $activityLogs = AdminActivityLog::whereDate('created_at', today())->orderBy('created_at', 'desc')->get();
    
        // Format date and time for each log entry
        foreach ($activityLogs as $log) {
            // Format to DD/MM/YYYY for date and HH:MM AM/PM for time
            $log->formatted_date = $log->created_at->format('d/m/Y');  // Date: DD/MM/YYYY
            $log->formatted_time = $log->created_at->format('h:i A');  // Time: HH:MM AM/PM
        }
        
        return view('HEAD.account_details', compact('admins', 'users', 'activityLogs'));
    }
    

    


    public function verifyAccount(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8', // Minimum length for password
        ]);
    
        $user = Head::where('email', $request->email)->first();
        if (!$user) {
            $user = Head::where('email', $request->email)->first();
        }
    
        // If the user doesn't exist or password is incorrect
        if (!$user || !Hash::check($request->password, $user->password)) {
            // Only add this error if credentials are incorrect, not for validation issues
            return back()->withErrors([
                'login_error' => 'Unauthorized access. Please check your credentials!',
            ]);
        }
    
        // Proceed to account details if credentials are correct
        return redirect()->route('HEAD.account.details');
    }
    
    
    public function HeadchangePassword(Request $request)
    {
        // Validate the request data for admins, users, and heads
        $validator = Validator::make($request->all(), [
            'email' => 'required|email', // Check for valid email format
            'newPassword' => 'required|string|min:8', // Ensure password is at least 8 characters long
            'confirmPassword' => 'required|string|same:newPassword', // Ensure passwords match
        ]);
    
        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Check if the email belongs to an admin, head, or user
        $admin = Admin::where('email', $request->email)->first();
        $head = !$admin ? Head::where('email', $request->email)->first() : null;
        $user = !$admin && !$head ? User::where('email', $request->email)->first() : null;
    
        if ($admin) {
            // Update admin password
            $admin->password = Hash::make($request->newPassword);
            $admin->save();
    
            // Log admin password change
            AdminActivityLog::create([
                'admin_id' => $admin->id,
                'activity' => 'Changed password',
            ]);
    
            // Redirect to admin details with success message
            return redirect()->route('HEAD.account.details')
                ->with('success', 'Admin password changed successfully.');
        } elseif ($head) {
            // Update head password
            $head->password = Hash::make($request->newPassword);
            $head->save();
    
            // Log head password change

    
            // Redirect to head details with success message
            return redirect()->route('HEAD.account.details')
                ->with('success', 'Head password changed successfully.');
        } elseif ($user) {
            // Update user password
            $user->password = Hash::make($request->newPassword);
            $user->save();
    
            // Log user password change
            UserActivityLog::create([
                'user_id' => $user->id,
                'activity' => 'Changed password',
            ]);
    
            // Redirect to user details with success message
            return redirect()->route('HEAD.account.details')
                ->with('success', 'User password changed successfully.');
        }
    
        // If no matching account found, return error
        return redirect()->back()->with('error', 'Account not found.');
    }



    public function HeadLogout()
    {
        // Check if the admin is logged in before logging the action
        if (auth()->guard('head')->check()) {
            // Log the logout action

    
            // Debugging log or statement to verify the log is being created
            \Log::info('Admin logged out', ['admin_id' => auth()->guard('head')->id()]);
        }
        
        // Clear the session and log out the user
        Auth::guard('head')->logout();
        
        return redirect()->route('loginHEAD');
    }

    public function gotocreate () {
        return view('HEAD.createacc');
    }


    public function createacc(Request $request)
    {
        $request->validate([
            'Lname'=>'required|string',
            'Fname'=>'required|string',
            'username' => 'required|string',
            'email' => 'required|email|unique:users,email|unique:admins,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string'
        ]);

        if ($request->role === 'ITDD') {
            // Store in admin table
            Admin::create([
                'Lname' => $request->Lname,
                'Fname' => $request->Fname,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status'=>"ACTIVE"
            ]);
        } else if ($request->role === 'PDAO') {
            // Store in user table
            User::create([
                'Lname' => $request->Lname,
                'Fname' => $request->Fname,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status'=>"ACTIVE"
            ]);
            
        }
        return redirect()->route('HEAD.account.details')->with('success', 'Account succefully created')->with('message_type', 'success');
    }

    public function Headactivate($id)
    {
        $admin = Admin::find($id);
        if ($admin) {
            $admin->status = 'ACTIVE';
            $admin->save();
            return response()->json(['status' => 'ACTIVE']);
        }
        return response()->json(['status' => 'FAILED']);
        
    }
    
    public function Headsuspend($id)
    {
        $admin = Admin::find($id);
        if ($admin) {
            $admin->status = 'SUSPENDED';
            $admin->save();
            return response()->json(['status' => 'SUSPENDED']);
        }
        return response()->json(['status' => 'FAILED']);
    }


    public function Head_Pdaoactivate($id)
{
    $user = User::find($id);

    if ($user) {
        $user->status = 'ACTIVE';
        $user->save();
        return response()->json(['status' => 'ACTIVE']);
    }

    return response()->json(['status' => 'ACTIVE']);  // Return updated status
}

// Suspend PDAO account
public function Head_Pdaosuspend($id)
{
    $user = User::find($id);

    if ($user) {
        $user->status = 'SUSPENDED';
        $user->save();
        return response()->json(['status' => 'SUSPENDED']);
        
    }

    return response()->json(['status' => 'SUSPENDED']);  // Return updated status
}

    





}
