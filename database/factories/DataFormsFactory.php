<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\DataForms;
use Illuminate\Database\Eloquent\Factories\Factory;

class DataFormsFactory extends Factory
{
    protected $model = DataForms::class;

    public function definition()
    {
        // Define all possible disabilities
        $disabilities = [
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
            'Acquired_Chronic',
            'Acquired_Cerebral',
            'Acquired_Injury',
        ];

        // Shuffle the array and take two disabilities
        $selectedDisabilities = collect($disabilities)->shuffle()->take(2);

        // Initialize all disabilities to 0
        $disabilityData = array_fill_keys($disabilities, 0);

        // Set the selected disabilities to 1
        foreach ($selectedDisabilities as $disability) {
            $disabilityData[$disability] = 1;
        }

        return [
            'Applicant_type' => 'New Applicant',
            'PWD_id' => '137604000-' . $this->faker->unique()->numberBetween(1, 9999), // Custom PWD ID
            'Date_applied' => $this->faker->dateTimeBetween('-3 years'),
            'Date_renewed' => null,
            'expiry_date' => Carbon::now()->addYears(5), // sets expiry_date to 5 years from Date_applied
            'LN' => $this->faker->lastName(),
            'FN' => $this->faker->firstName(),
            'MN' => $this->faker->firstNameMale(),
            'Suffix' => $this->faker->optional()->randomElement(['NONE', 'Jr', 'Sr']),
            'Date_of_birth' => $this->faker->date(),
            'Sex' => $this->faker->randomElement(['MALE', 'FEMALE']),
            'Civil_status' => $this->faker->randomElement(['SINGLE', 'SEPARATED', 'COHABITATION', 'MARRIED', 'WIDOW/ER']),
            
            // Assign disabilities from the generated array
            'Deaf' => $disabilityData['Deaf'],
            'Intellectual' => $disabilityData['Intellectual'],
            'Learning' => $disabilityData['Learning'],
            'Mental' => $disabilityData['Mental'],
            'Physical' => $disabilityData['Physical'],
            'Psychosocial' => $disabilityData['Psychosocial'],
            'Speech_and_Language' => $disabilityData['Speech_and_Language'],
            'Visual' => $disabilityData['Visual'],
            'Cancer' => $disabilityData['Cancer'],
            'Rare_Disease' => $disabilityData['Rare_Disease'],
            'Congenital_ADHD' => $disabilityData['Congenital_ADHD'],
            'Congenital_Cerebral' => $disabilityData['Congenital_Cerebral'],
            'Congenital_Down' => $disabilityData['Congenital_Down'],
            'Congenital_Others' => $this->faker->optional()->word(),
            'Acquired_Chronic' => $disabilityData['Acquired_Chronic'],
            'Acquired_Cerebral' => $disabilityData['Acquired_Cerebral'],
            'Acquired_Injury' => $disabilityData['Acquired_Injury'],
            'Acquired_Others' => $this->faker->optional()->word(),
            'HouseNo_Street' => $this->faker->streetAddress(),
            'Barangay' => $this->faker->randomElement(['Baclaran', 'BF Homes', 'Don Bosco', 'Don Galo', 'La Huerta', 'Marcelo Green', 'Merville', 'Moonwalk', 'San Antonio', 'San Dionisio', 'San Isidro', 'San Martin de Porres', 'Santo Niño', 'Sun Valley', 'Tambo', 'Vitalez']),
            'Municipality' => 'Parañaque City',
            'Province' => 'Metro Manila',
            'Region' => 'NCR',
            'Landline_No' => $this->faker->optional()->phoneNumber(),
            'Mobile_No' => $this->faker->optional()->phoneNumber(),
            'Email_address' => $this->faker->optional()->safeEmail(),
            'Educational_Attainment' => $this->faker->randomElement(['None', 'Kindergarten', 'Elementary', 'Junior High School', 'Senior High School', 'College', 'Vocational', 'Post Graduate']),
            'Status_of_Employment' => $this->faker->randomElement(['Employed', 'Unemployed', 'Self-Employed']),
            'Category_of_Employment' => $this->faker->randomElement(['Government', 'Private']),
            'Type_of_Employment' => $this->faker->randomElement(['Permanent', 'Seasonal', 'Casual', 'Emergency']),
            'Occupation' => $this->faker->randomElement(['Managers', 'Professionals', 'Technical and associative Professionals', 'Clerical Support Workers', 'Service and Sales Workers', 'Skilled Agricultural, Forestry and Fishery Workers', 'Craft and Related Trade Workers', 'Elementary Occupations', 'Armed Forces Occupations']),
            'IDpicture' => $this->faker->imageUrl(640, 480, 'people'),
            'path' => $this->faker->filePath(),
            'Birth_Cert' => $this->faker->boolean(),
            'Brgy_Clearance' => $this->faker->boolean(),
            'Valid_id' => $this->faker->boolean(),
            'Medical_Assesment' => $this->faker->boolean(),
            'old_city_id' => $this->faker->word(),
            'Contact_Emergency' => $this->faker->phoneNumber(),
        ];
    }
}
