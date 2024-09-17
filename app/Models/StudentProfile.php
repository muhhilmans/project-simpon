<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'name',
        'nik',
        'nis',
        'nisn',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'address',
        'rt',
        'rw',
        'village',
        'district',
        'regency',
        'province',
        'phone_number',
        'photo',
        'father_name',
        'mother_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
