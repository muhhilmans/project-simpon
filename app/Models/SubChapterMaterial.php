<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubChapterMaterial extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'chapter_material_id',
        'title',
        'description',
        'format',
        'file_path',
        'url',
    ];

    public function chapterMaterial()
    {
        return $this->belongsTo(ChapterMaterial::class);
    }
}
