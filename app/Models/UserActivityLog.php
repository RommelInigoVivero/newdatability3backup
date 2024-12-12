<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivityLog extends Model
{
    use HasFactory;
        protected $fillable = [
            'user_id', // Foreign key to users table
            'activity', // Description of the activity
        ];
    
        // Define the relationship with the User model (a user can have many activity logs)
        public function user()
        {
            return $this->belongsTo(User::class);
        }
}
