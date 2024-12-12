<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string('Applicant_type');
            $table->string('Track_id')->unique();
            $table->date('Date_applied');
            $table->string('LN');
            $table->string('FN');
            $table->string('MN')->nullable();
            $table->string('Suffix')->default("NONE")->nullable();
            $table->date('Date_of_birth');
            $table->string('Sex');
            $table->string('Civil_status');
            
            $table->string('IDpicture')->nullable(); // Store the filename
            $table->string('path')->nullable(); // Store the file path


            //types of diseases
            $table->integer('Deaf')->default(0);
            $table->integer('Intellectual')->default(0);
            $table->integer('Learning')->default(0);
            $table->integer('Mental')->default(0);
            $table->integer('Physical')->default(0);
            $table->integer('Psychosocial')->default(0);
            $table->integer('Speech_and_Language')->default(0);
            $table->integer('Visual')->default(0);
            $table->integer('Cancer')->default(0);
            $table->integer('Rare_Disease')->default(0);

            //congential diseases
            $table->integer('Congenital_ADHD')->default(0);
            $table->integer('Congenital_Cerebral')->default(0);
            $table->integer('Congenital_Down')->default(0);
            $table->string('Congenital_Others')->default('NONE')->nullable();


            //acquired diseases
            $table->integer('Acquired_Chronic')->default(0);
            $table->integer('Acquired_Cerebral')->default(0);
            $table->integer('Acquired_Injury')->default(0);
            $table->string('Acquired_Others')->default('NONE')->nullable();

            $table->string('HouseNo_Street');
            $table->string('Barangay');
            $table->string('Municipality');
            $table->string('Province');
            $table->string('Region');

            $table->string('Landline_No')->nullable();
            $table->string('Mobile_No')->nullable();
            $table->string('Email_address')->nullable();

            $table->string('Educational_Attainment');
            $table->string('Status_of_Employment');
            $table->string('Category_of_Employment');
            $table->string('Type_of_Employment');
            $table->string('Occupation');

            $table->text('Org_Affiliation')->nullable();
            $table->text('Org_Contact')->nullable();
            $table->text('Org_Office')->nullable();
            $table->string('Org_Tel')->nullable();
            $table->string('SSS_No')->nullable();
            $table->string('GSIS_No')->nullable();
            $table->string('Pagibig_No')->nullable();
            $table->string('PSN_No')->nullable();
            $table->string('Philhealth_No')->nullable();
            $table->text('Father_LN')->nullable();
            $table->string('Father_FN')->nullable();
            $table->text('Father_MN')->nullable();
            $table->text('Mother_LN')->nullable();
            $table->text('Mother_FN')->nullable();
            $table->text('Mother_MN')->nullable();
            $table->text('Guardian_LN')->nullable();
            $table->text('Guardian_FN')->nullable();
            $table->text('Guardian_MN')->nullable();

            $table->string('Accomplished_By')->nullable();
            $table->string('A_LN')->nullable();
            $table->string('A_FN')->nullable();
            $table->string('A_MN')->nullable();
            $table->string('Cert_Physician')->nullable();
            $table->string('Physician_License')->nullable();
            $table->string('Process_Officer')->nullable();
            $table->string('Approve_Officer')->nullable();
            $table->string('Encoder')->nullable();
            $table->string('Reporting_Unit')->nullable();
            $table->string('Reporting_Office')->nullable();
            $table->string('Control_No')->nullable();
            $table->string('ContactPerson_No')->nullable();
            
            $table->string('Birth_Cert')->nullable();
            $table->string('Brgy_Clearance')->nullable();
            $table->string('Valid_id')->nullable();
            $table->string('Medical_Assesment')->nullable();
            $table->string('Auth_letter')->nullable();
            
            $table->string('old_city_id')->nullable();

            $table->string('Contact_Emergency')->nullable();

            $table->string('status')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
