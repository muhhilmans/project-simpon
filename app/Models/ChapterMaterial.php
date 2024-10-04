<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChapterMaterial extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'subject_id',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function subChapterMaterial()
    {
        return $this->hasMany(SubChapterMaterial::class);
    }
}
