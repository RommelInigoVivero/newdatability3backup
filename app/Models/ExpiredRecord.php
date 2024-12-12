<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpiredRecord extends Model
{
    use HasFactory;
    protected $fillable = [
'Applicant_type',
        'PWD_id',
        'Date_applied',
        'Date_renewed',
        'expiry_date',
        'LN',
        'FN',
        'MN',
        'Suffix',
        'IDpicture',
        'path',
        'Date_of_birth',
        'Sex',
        
        'Civil_status',

        'Deaf',
        'Intellectual',
        'Learning',
        'Mental',
        'Physical',
        'Psychosocial',
        'Speech_and_Language',
        'Visual',
        'Cancer',
        'Rare_Disease',

        'Congenital_ADHD',
        'Congenital_Cerebral',
        'Congenital_Down',
        'Congenital_Others',

        'Acquired_Chronic',
        'Acquired_Cerebral',
        'Acquired_Injury',
        'Acquired_Others',

        'HouseNo_Street',
        'Barangay',
        'Municipality',
        'Province',
        'Region',

        'Landline_No',
        'Mobile_No',
        'Email_address',

        'Educational_Attainment',
        'Status_of_Employment',
        'Category_of_Employment',
        'Type_of_Employment',
        'Occupation',

        'Org_Affiliation',
        'Org_Contact',
        'Org_Office',
        'Org_Tel',
        'SSS_No',
        'GSIS_No',
        'Pagibig_No',
        'PSN_No',
        'Philhealth_No',
        'Father_LN',
        'Father_FN',
        'Father_MN',
        'Mother_LN',
        'Mother_FN',
        'Mother_MN',
        'Guardian_LN',
        'Guardian_FN',
        'Guardian_MN',
        'Accomplished_By',
        'A_LN',
        'A_FN',
        'A_MN',
        'Cert_Physician',
        'Physician_License',

        'Process_Officer',
        'Approve_Officer',
        'Encoder',
        'Reporting_Unit',
        'Reporting_Office',
        'Control_No',

        'Birth_Cert',
        'Brgy_Clearance',
        'Valid_id',
        'Medical_Assesment',
        'old_city_id',
        'Contact_Emergency'

        
    ];
}
