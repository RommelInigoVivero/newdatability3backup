<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\DataForms;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $ids;

    public function __construct(array $ids = [])
    {
        $this->ids = $ids;
    }

    public function collection()
    {
        // Fetch all records if no IDs are provided
        $data = empty($this->ids) 
            ? DataForms::all() 
            : DataForms::whereIn('id', $this->ids)->get();

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
            $record['Age'] = (int)Carbon::parse($form->Date_of_birth)->diffInYears(Carbon::now());

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
            'Occupation',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Define the header row style
        $headerRowStyle = [
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FF000000'], // Black text
                'size' => 20,
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['argb' => 'FF00FF00'], // Green background
            ],
            'alignment' => [
                'horizontal' => 'center', // Center align text horizontally
                'vertical' => 'center',   // Center align text vertically
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'], // Black border
                ],
            ],
        ];
    
        // Apply the header row style to the first row
        $sheet->getStyle('A1:AC1')->applyFromArray($headerRowStyle);
        $sheet->getRowDimension(1)->setRowHeight(30); // Set header row height
    
        // Get the total number of rows and columns dynamically
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
    
        // Define alternating row styles for better readability
        $alternateRowStyle = [
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['argb' => 'FFF2F2F2'], // Light grey background
            ],
        ];
    
        // Apply styles to all cells
        $sheet->getStyle("A1:{$highestColumn}{$highestRow}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'], // Black border
                ],
            ],
            'alignment' => [
                'horizontal' => 'center', // Center align text horizontally
                'vertical' => 'center',   // Center align text vertically
            ],

            'font' => [
                'color' => ['argb' => 'FF000000'], // Black text
                'size' => 14,
            ],
        ]);
    
        // Apply alternating row colors for body rows
        for ($row = 2; $row <= $highestRow; $row++) {
            if ($row % 2 == 0) {
                $sheet->getStyle("A{$row}:{$highestColumn}{$row}")->applyFromArray($alternateRowStyle);
            }
        }
    
        // Adjust column width to auto-size
        foreach (range('A', $highestColumn) as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
    
        return [];
    }
}
