<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentFile extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id', 
        'identity_card', 
        'family_card', 
        'school_certificate', 
        'birth_certificate', 
        'scholarship_application', 
        'receipt', 
        'final_report'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
