<?php

namespace App\Imports;

use App\Models\DataForms;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;

//class UsersImport implements ToCollection, WithHeadingRow

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {

        \Log::info('Row data:', $row);

        // // 1. Format Date of Issuance (Date_Applied) - Column 1
        
        $dateAppliednoformat = Date::excelToDateTimeObject($row['dateofissuance']);

        $dateApplied = $dateAppliednoformat->format('Y-m-d');

        // $dateApplied = \Carbon\Carbon::createFromFormat('m/d/y', $row['dateofissuance'])->format('Y-m-d');

        // // $dateApplied = \Carbon\Carbon::createFromFormat('m/d/y', $row['dateofissuance'] ?? '')->format('Y-m-d');

        // // Determine Applicant Type
        if ($dateAppliednoformat) {
            // Extract the year from the applied date
            $appliedYear = (int) $dateAppliednoformat->format('Y');
            
            // Get the current year
            $currentYear = (int) date('Y');
        
            // Determine applicant type based on the year difference
            $applicantType = ($currentYear - $appliedYear >= 5) ? 'Expired' : 'Active';
        } else {
            // Default to null if date is missing
            $applicantType = null;
        }

        // 2. Map Other Fields
        $pwdId = trim($row['idnumber']); // PWD ID (Column 2)
        $firstName = ucfirst(strtolower(trim($row['firstname']))); // First Name (Column 3)
        $middleName = ucfirst(strtolower(trim($row['middlename']))); // Middle Name (Column 4)
        $lastName = ucfirst(strtolower(trim($row['lastname']))); // Last Name (Column 5)
        $houseNoStreet = trim($row['address']); // Address (Column 6)
        $barangay = trim($row['barangay']); // Barangay (Column 7)

        // Format Birthday (Date_of_Birth) - Column 8

        $dateofBirthnoformat = Date::excelToDateTimeObject($row['birthday']);

        $dateofBirth=$dateofBirthnoformat->format('Y-m-d');
        // $dateOfBirth = \Carbon\Carbon::createFromFormat('m/d/y', $row['birthday'])->format('Y-m-d');
        // $dateOfBirth = \Carbon\Carbon::createFromFormat('m/d/y', trim($row['birthday']))->format('Y-m-d');


        // Map Sex (Column 10)
        $sex = $row['sex'] === 'M' ? 'MALE' : ($row['sex'] === 'F' ? 'FEMALE' : null);

        // Map Civil Status (Column 9)
        $civilStatusMap = [
            'S' => 'SINGLE',
            'M' => 'MARRIED',
            'W' => 'WIDOW/ER',
            'SEP' => 'SEPARATED',
            'C' => 'COHABITATION',
        ];
        $civilStatus = $civilStatusMap[$row['civilstatus']] ?? null;

        // 3. Map Types of Disabilities (Column 11)
        $disability = strtoupper(trim($row['typesofdisabilities']));
        $physical = in_array($disability, ['PHYSICAL/ORTHO', 'PHYSICAL']) ? 1 : 0;
        $deaf = in_array($disability, ['DEAF', 'HARD OF HEARING']) ? 1 : 0;
        $intellectual = $disability === 'INTELLECTUAL' ? 1 : 0;
        $learning = $disability === 'LEARNING' ? 1 : 0;
        $mental = $disability === 'MENTAL' ? 1 : 0;
        $psychosocial = $disability === 'PSYCHOSOCIAL' ? 1 : 0;
        $speechAndLanguage = $disability === 'SPEECH AND LANGUAGE' ? 1 : 0;
        $visual = $disability === 'VISUAL' ? 1 : 0;
        $cancer = $disability === 'CANCER (RA11215)' ? 1 : 0;
        $rareDisease = $disability === 'RARE DISEASE' ? 1 : 0;

        // 4. Map Cause of Disability (Column 12)
        $causeOfDisability = strtoupper(trim($row['causeofdisability']));
        $parts = explode('/', $causeOfDisability);
        $category = $parts[0] ?? null;
        $type = $parts[1] ?? null;

        // Initialize disability cause columns
        $congenitalADHD = 0;
        $congenitalCerebral = 0;
        $congenitalDown = 0;
        $congenitalOthers = null;

        $acquiredChronic = 0;
        $acquiredCerebral = 0;
        $acquiredInjury = 0;
        $acquiredOthers = null;

        if ($category === 'CONGENITAL') {
            if ($type === 'ADHD') {
                $congenitalADHD = 1;
            } elseif ($type === 'CEREBRAL PALSY') {
                $congenitalCerebral = 1;
            } elseif ($type === 'DOWN SYNDROME') {
                $congenitalDown = 1;
            } else {
                $congenitalOthers = $type; // Store unexpected types in Congenital_Others
            }
        } elseif ($category === 'ACQUIRED') {
            if ($type === 'CHRONIC ILLNESS') {
                $acquiredChronic = 1;
            } elseif ($type === 'CEREBRAL PALSY') {
                $acquiredCerebral = 1;
            } elseif ($type === 'INJURY') {
                $acquiredInjury = 1;
            } else {
                $acquiredOthers = $type; // Store unexpected types in Acquired_Others
            }
        }
        
        // 5. Employment Information
        $educationalAttainment = trim($row['educationalattainment']); // Educational Attainment (Column 13)
        $statusOfEmployment = trim($row['statusofemployment']); // Status of Employment (Column 14)
        $categoryOfEmployment = trim($row['categoryofemployment']); // Category of Employment (Column 15)
        $typeOfEmployment = trim($row['typesofemployment']); // Type of Employment (Column 16)
        $occupation = trim($row['occupation']); // Occupation (Column 17)

        // 6. Contact Information
        $mobileNo = trim($row['contactnumber']); // Contact Number (Column 18)

         // Default values for Municipality, Province, and Region
        $municipality = 'Parañaque';
        $province = 'Metro Manila';
        $region = 'NCR';

        $expiryDate = Carbon::parse($dateApplied)->addYears(5)->format('Y-m-d');


        return new DataForms([
            'Applicant_type' => $applicantType,
            'PWD_id' => $pwdId,
            'Date_applied' => $dateApplied,
            'Date_renewed' => null,
            'expiry_date' => $expiryDate,
            'LN' => $lastName,
            'FN'=> $firstName,
            'MN'=> $middleName,
            'Suffix'=> null,
            'IDpicture'=> null,
            'path'=> null,
            'Date_of_birth'=> $dateofBirth,
            'Sex'=> $sex,
            
            'Civil_status'=> $civilStatus,

            'Deaf'=> $deaf,
            'Intellectual'=> $intellectual,
            'Learning'=> $learning,
            'Mental'=> $mental,
            'Physical'=> $physical,
            'Psychosocial'=> $psychosocial,
            'Speech_and_Language'=> $speechAndLanguage,
            'Visual'=> $visual,
            'Cancer'=> $cancer,
            'Rare_Disease'=> $rareDisease,

            'Congenital_ADHD'=> $congenitalADHD,
            'Congenital_Cerebral'=> $congenitalCerebral,
            'Congenital_Down'=> $congenitalDown,
            'Congenital_Others'=> $congenitalOthers,

            'Acquired_Chronic'=> $acquiredChronic,
            'Acquired_Cerebral'=> $acquiredCerebral,
            'Acquired_Injury'=> $acquiredInjury,
            'Acquired_Others'=> $acquiredOthers,

            'HouseNo_Street'=> $houseNoStreet,
            'Barangay'=> $barangay,
            'Municipality'=> $municipality,
            'Province'=> $province,
            'Region'=> $region,

            'Landline_No'=> null,
            'Mobile_No'=> $mobileNo,
            'Email_address'=> null,

            'Educational_Attainment'=> $educationalAttainment,
            'Status_of_Employment'=> $statusOfEmployment,
            'Category_of_Employment'=> $categoryOfEmployment,
            'Type_of_Employment'=> $typeOfEmployment,
            'Occupation'=> $occupation,

            'Birth_Cert'=> null,
            'Brgy_Clearance'=> null,
            'Valid_id'=> null,
            'Medical_Assesment'=> null,
            'old_city_id'=> null,
            'Contact_Emergency' => $row['contact_emergency'] ?? 'N/A',
        ]);
    }
}

