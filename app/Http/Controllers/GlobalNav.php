<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\DataForms;
use Illuminate\Http\Request;
use app\Models\Applicants;
class GlobalNav extends Controller
{   
    public function apply() {
        return view ('applicant.apply');
    }
    public function register(){
        return view('HEAD.register');
    }

    public function login(){
        return view('PDAO.login');
    }

    public function loginHEAD(){
        return view('HEAD.login');
    }


    public function loginITDD(){
        return view('ITDD.login');
    }
    public function verifyPage(){
        return view('PDAO.verify');
    }

    public function verify(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->input('search');
    
            // Ensure the search term is not empty
            if (!empty($search)) {
                // Use the '===' operator to strictly match exact ID
                $dataForms = DataForms::where('PWD_id', $search)->get();
    
                // Return the records found or an empty array if no records were found
                return response()->json($dataForms);
            }
        }
    
        return view('PDAO.verify');
    }
    
}
