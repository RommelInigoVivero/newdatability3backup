<?php

namespace App\Exports;

use App\Models\ExpiredRecord;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExpiredExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */



    protected $ids;

    public function __construct(array $ids = []) // Default to an empty array
    {
        $this->ids = $ids;
    }
    public function collection()
    {
        $data = empty($this->ids) 
        ? ExpiredRecord::all() // Fetch all records
        : ExpiredRecord::whereIn('id', $this->ids)->get(); // Fetch records by IDs

    $formattedData = [];
    foreach ($data as $form) {
        $record = [];
        $record['Applicant Type'] = $form->Applicant_type;
        $record['PWD ID'] = $form->PWD_id;
        $record['Date Applied'] = $form->Date_applied;
        $record['Date Renewed'] = $form->Date_renewed;
        $record['Expiry Date'] = $form->expiry_date;
        $record['Last Name'] = $form->LN;
        $record['First Name'] = $form->FN;
        $record['Middle Name'] = $form->MN;
        $record['Suffix'] = $form->Suffix;
        $record['Date of Birth'] = $form->Date_of_birth;
        $record['Sex'] = $form->Sex;
        $record['Civil Status'] = $form->Civil_status;
        $record['Age'] = $form->Age;
        
        // Collect Disabilities
        $disabilities = [];
        if ($form->Deaf) $disabilities[] = 'Deaf';
        if ($form->Intellectual) $disabilities[] = 'Intellectual';
        if ($form->Learning) $disabilities[] = 'Learning';
        if ($form->Mental) $disabilities[] = 'Mental';
        if ($form->Physical) $disabilities[] = 'Physical';
        if ($form->Psychosocial) $disabilities[] = 'Psychosocial';
        if ($form->Speech_and_Language) $disabilities[] = 'Speech and Language';
        if ($form->Visual) $disabilities[] = 'Visual';
        if ($form->Cancer) $disabilities[] = 'Cancer';
        if ($form->Rare_Disease) $disabilities[] = 'Rare Disease';
        $record['Disabilities'] = implode(', ', $disabilities);

        // Collect Congenital Diseases
        $congenitalDiseases = [];
        if ($form->Congenital_ADHD) $congenitalDiseases[] = 'ADHD';
        if ($form->Congenital_Cerebral) $congenitalDiseases[] = 'Cerebral';
        if ($form->Congenital_Down) $congenitalDiseases[] = 'Down Syndrome';
        if ($form->Congenital_Others != 'NONE') $congenitalDiseases[] = $form->Congenital_Others;
        $record['Congenital'] = implode(', ', $congenitalDiseases);

        // Collect Acquired Diseases
        $acquiredDiseases = [];
        if ($form->Acquired_Chronic) $acquiredDiseases[] = 'Chronic';
        if ($form->Acquired_Cerebral) $acquiredDiseases[] = 'Cerebral';
        if ($form->Acquired_Injury) $acquiredDiseases[] = 'Injury';
        if ($form->Acquired_Others != 'NONE') $acquiredDiseases[] = $form->Acquired_Others;
        $record['Acquired'] = implode(', ', $acquiredDiseases);

        // Additional Information
        $record['HouseNo Street'] = $form->HouseNo_Street;
        $record['Barangay'] = $form->Barangay;
        $record['Municipality'] = $form->Municipality;
        $record['Province'] = $form->Province;
        $record['Region'] = $form->Region;
        $record['Landline No'] = $form->Landline_No;
        $record['Mobile No'] = $form->Mobile_No;
        $record['Email Address'] = $form->Email_address;
        $record['Educational Attainment'] = $form->Educational_Attainment;
        $record['Status of Employment'] = $form->Status_of_Employment;
        $record['Category of Employment'] = $form->Category_of_Employment;
        $record['Type of Employment'] = $form->Type_of_Employment;
        $record['Occupation'] = $form->Occupation;

        // Add the structured record to formatted data
        $formattedData[] = $record;
    }

    return collect($formattedData);
    }

    public function headings(): array
    {
        return [
            'Applicant Type',
            'PWD ID',
            'Date Applied',
            'Date Renewed',
            'Expiry Date',
            'Last Name',
            'First Name',
            'Middle Name',
            'Suffix',
            'Date of Birth',
            'Sex',
            'Civil Status',
            'Age',
            'Disabilities',
            'Congenital',
            'Acquired',
            'HouseNo Street',
            'Barangay',
            'Municipality',
            'Province',
            'Region',
            'Landline No',
            'Mobile No',
            'Email Address',
            'Educational Attainment',
            'Status of Employment',
            'Category of Employment',
            'Type of Employment',
            'Occupation'
        ];
    }
}
