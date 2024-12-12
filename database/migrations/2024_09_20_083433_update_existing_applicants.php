<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateExistingApplicants extends Migration
{
    public function up()
    {
        // Update applicants with a non-empty old_city_id
        DB::table('data_forms')
            ->whereNotNull('old_city_id') // Check if old_city_id has a value
            ->update(['Applicant_type' => 'Expired Transferee']);
        
        // Update applicants whose Date_applied is more than 5 years old and old_city_id is empty
        DB::table('data_forms')
            ->whereNull('old_city_id') // Check if old_city_id is empty
            ->whereRaw('DATE_ADD(Date_applied, INTERVAL 5 YEAR) <= CURDATE()')
            ->update(['Applicant_type' => 'Expired']);
    }

    public function down()
    {
        // Implement rollback logic if necessary
    }
}