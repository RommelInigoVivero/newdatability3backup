<?php

namespace App\Http\Controllers;
use App\Models\AdminActivityLog;
use App\Models\DataForms;
use App\Models\User;
use App\Models\Admin;
use App\Models\UserActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;

class AdminController extends Controller
{
    public function register(Request $request)
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

        return view('ITDD.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('username', 'password');
        
        // Attempt to find the admin user by username
        $admin = Admin::where('username', $request->username)->first();
    
        if ($admin) {
            // Check if the account is suspended
            if ($admin->status === 'SUSPENDED') {
                // Log the failed login attempt with the admin_id
                $this->logActivity($admin->id, 'Failed login attempt (Account Suspended)');
                return redirect()->back()->with('error', 'Your account is suspended. Please inquire at the ITDD office.');
            }
    
            // Attempt to log in using the admin guard
            if (Auth::guard('admin')->attempt($credentials)) {
                // Log the successful login attempt
                AdminActivityLog::create([
                    'admin_id' => Auth::guard('admin')->id(), // Ensure admin_id is provided
                    'activity' => 'Logged in',
                ]);
    
                return redirect()->intended(route('ITDD.dashboard'));
            }
        }
    
        // Log failed login attempt if the admin is not found or credentials are incorrect
        if ($admin) {
            AdminActivityLog::create([
                'admin_id' => $admin->id, // Ensure admin_id is provided
                'activity' => 'Failed login attempt (Invalid password)',
            ]);
        }
    
        // Redirect back with an error message if authentication fails
        return redirect()->back()->with('error', 'Login Failed: Account does not exist or incorrect password.');
    }
    
    


    
    
    


    public function dashboard()
    {
        return view('ITDD.dashboard');  // Redirect to the admin dashboard view
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
        
        return view('ITDD.account_details', compact('admins', 'users', 'activityLogs'));
    }
    
    protected function logActivity($adminId, $activity)
    {
        AdminActivityLog::create([
            'admin_id' => $adminId,
            'activity' => $activity,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    


    public function verifyAccount(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8', // Minimum length for password
        ]);
    
        $user = Admin::where('email', $request->email)->first();
        if (!$user) {
            $user = User::where('email', $request->email)->first();
        }
    
        // If the user doesn't exist or password is incorrect
        if (!$user || !Hash::check($request->password, $user->password)) {
            // Only add this error if credentials are incorrect, not for validation issues
            return back()->withErrors([
                'login_error' => 'Unauthorized access. Please check your credentials!',
            ]);
        }
    
        // Proceed to account details if credentials are correct
        return redirect()->route('admin.account.details');
    }
    
    
    public function changePassword(Request $request)
    {
        // Validate the request data for admins and users
        $validator = Validator::make($request->all(), [
            'email' => 'required|email', // Check for valid email format
            'newPassword' => 'required|string|min:8', // Ensure password is at least 8 characters long
            'confirmPassword' => 'required|string|same:newPassword', // Ensure passwords match
        ]);
    
        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Check if the email belongs to an admin or user
        $admin = Admin::where('email', $request->email)->first();
        $user = !$admin ? User::where('email', $request->email)->first() : null;
    
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
            return redirect()->route('admin.account.details')
                ->with('success', 'Admin password changed successfully.');
        } elseif ($user) {
            // Update user password
            $user->password = Hash::make($request->newPassword);
            $user->save();
    
            // Log user password change (optional)
            UserActivityLog::create([
                'user_id' => $user->id,
                'activity' => 'Changed password',
            ]);
    
            // Redirect to user details with success message
            return redirect()->route('admin.account.details')
                ->with('success', 'User password changed successfully.');
        }
    
        // If no matching admin or user found, return error
        return redirect()->back()->with('error', 'Account not found.');
    }
    



    public function getActivityLogs($adminId, Request $request)
    {
        $date = $request->query('date'); // Get the selected date from the query parameter
    
        // If no date is provided, use today's date
        if (!$date) {
            $date = today()->toDateString(); // Default to today if no date is passed
        }
    
        // Fetch activity logs for a specific admin and specific date
        $activityLogs = AdminActivityLog::where('admin_id', $adminId)
                                          ->whereDate('created_at', $date) // Use the provided date
                                          ->orderBy('created_at', 'desc')
                                          ->get();
    
        // Format the date and time for each log entry
        foreach ($activityLogs as $log) {
            $log->formatted_date = $log->created_at->format('d/m/Y'); // Date: DD/MM/YYYY
            $log->formatted_time = $log->created_at->format('h:i A'); // Time: HH:MM AM/PM
        }
    
        // Return logs as a JSON response
        return response()->json($activityLogs);
    }




    public function getAdminActivityDates($adminId)
    {
        $dates = AdminActivityLog::where('admin_id', $adminId)
                ->selectRaw('DATE(created_at) as activity_date')
                ->distinct()
                ->orderBy('activity_date', 'desc')
                ->get()
                ->pluck('activity_date');

        return response()->json($dates);
    }
    
    public function Adminlogout()
    {
        // Check if the admin is logged in before logging the action
        if (auth()->guard('admin')->check()) {
            // Log the logout action
            AdminActivityLog::create([
                'admin_id' => auth()->guard('admin')->id(),
                'activity' => 'Logged out',
            ]);
    
            // Debugging log or statement to verify the log is being created
            \Log::info('Admin logged out', ['admin_id' => auth()->guard('admin')->id()]);
        }
        
        // Clear the session and log out the user
        Auth::guard('admin')->logout();
        
        return redirect()->route('ITDD.login');
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
        return view('ITDD.admin_views', compact('dataForms', 'applicantTypes'));
    }




    public function activate($id)
    {
        $admin = Admin::find($id);
        if ($admin) {
            $admin->status = 'ACTIVE';
            $admin->save();
            return response()->json(['status' => 'ACTIVE']);
        }
        return response()->json(['status' => 'FAILED']);
        
    }
    
    public function suspend($id)
    {
        $admin = Admin::find($id);
        if ($admin) {
            $admin->status = 'SUSPENDED';
            $admin->save();
            return response()->json(['status' => 'SUSPENDED']);
        }
        return response()->json(['status' => 'FAILED']);
    }








    // Activate PDAO account
public function Pdaoactivate($id)
{
    $user = User::find($id);

    if ($user) {
        $user->status = 'ACTIVE';
        $user->save();
    }

    return response()->json(['status' => 'ACTIVE']);  // Return updated status
}

// Suspend PDAO account
public function Pdaosuspend($id)
{
    $user = User::find($id);

    if ($user) {
        $user->status = 'SUSPENDED';
        $user->save();
    }

    return response()->json(['status' => 'SUSPENDED']);  // Return updated status
}
    

}
