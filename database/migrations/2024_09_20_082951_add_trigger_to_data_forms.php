<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create the trigger
        DB::unprepared('
            CREATE TRIGGER set_applicant_type_expired
            BEFORE INSERT ON data_forms
            FOR EACH ROW
            BEGIN
                DECLARE expiry_date DATE;

                SET expiry_date = DATE_ADD(NEW.Date_applied, INTERVAL 5 YEAR);
                
                IF (expiry_date <= CURDATE()) THEN
                    -- Check if old_city_id is not null
                    IF (NEW.old_city_id IS NOT NULL) THEN
                        SET NEW.Applicant_type = "Expired Transferee";
                    ELSE
                        SET NEW.Applicant_type = "Expired";
                    END IF;
                END IF;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the trigger if it exists
        DB::unprepared('DROP TRIGGER IF EXISTS set_applicant_type_expired');
    }
};
