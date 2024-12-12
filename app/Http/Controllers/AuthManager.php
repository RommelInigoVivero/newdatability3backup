<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class AuthManager extends Controller
{

    public function loginPost(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('username', 'password');
        
        // Attempt to find the user by username
        $user = User::where('username', $request->username)->first();
    
        if ($user) {
            // If the account is suspended
            if ($user->status === 'SUSPENDED') {
                // Log the failed attempt due to account suspension
                $this->logActivity($user->id, 'Failed login attempt (Account Suspended)');
                return redirect(route('login'))->with("error", "Your account is suspended. Please inquire at the ITDD office.");
            }
    
            // Attempt to authenticate the user (password check)
            if (Auth::guard('user')->attempt($credentials)) {
                // Log the successful login
                $this->logActivity($user->id, 'User logged in');
                return redirect()->intended(route('home'));
            } else {
                // Log the failed attempt due to incorrect password
                $this->logActivity($user->id, 'Failed login attempt (Incorrect password)');
            }
        }
    
        // Redirect back with an error message if authentication fails
        return redirect(route('login'))->with("error", "Login Failed: Account does not exist or incorrect password.");
    }
    
    
    
    
    
    public function logout() {
        // Check if the user is authenticated with the 'user' guard
        if (Auth::guard('user')->check()) {
            // Log the logout activity only if the user is authenticated
            $this->logActivity(Auth::guard('user')->id(), 'User logged out');
        }
    
        // Flush session and logout the user using the 'user' guard
        Auth::guard('user')->logout();  // Explicitly using the 'user' guard
    
        return redirect()->route('login');
    }


    protected function logActivity($userId, $activity)
    {
        UserActivityLog::create([
            'user_id' => $userId,
            'activity' => $activity,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }



    public function getUserActivityLogs(Request $request, $userId)
    {
        $date = $request->input('date'); // Fetch the date from the request
    
        // Validate the date (optional)
        if (!$date || !strtotime($date)) {
            return response()->json(['error' => 'Invalid date provided'], 400);
        }
    
        $logs = UserActivityLog::where('user_id', $userId)
                    ->whereDate('created_at', $date)
                    ->orderBy('created_at', 'desc')
                    ->get();
    
        foreach ($logs as $log) {
            $log->formatted_date = $log->created_at->format('d/m/Y'); // Date: DD/MM/YYYY
            $log->formatted_time = $log->created_at->format('h:i A'); // Time: HH:MM AM/PM
        }
    
        return response()->json($logs);
    }



    public function getUserActivityDates($userId)
    {
        $dates = UserActivityLog::where('user_id', $userId)
                    ->selectRaw('DATE(created_at) as activity_date')
                    ->distinct()
                    ->orderBy('activity_date', 'desc')
                    ->get()
                    ->pluck('activity_date'); // Get only the dates

        return response()->json($dates);
    }
}
