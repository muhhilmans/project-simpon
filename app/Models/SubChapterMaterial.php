<?php

namespace App\Models;

use Cohensive\OEmbed\Facades\OEmbed;
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

    public function getVideoAttribute()
    {
        if ($this->format === 'url' && $this->url) {
            $embed = OEmbed::get($this->url);

            if ($embed) {
                return $embed->html([
                    'width' => 640,
                    'height' => 360,
                    'frameborder' => 0,
                    'allow' => 'accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture',
                    'allowfullscreen' => true,
                    'controls' => 1,
                    'rel' => 0,
                    'modestbranding' => 1,
                    'fs' => 1,
                    'autohide' => 1,
                    'iv_load_policy' => 3
                ]);
            }
        }

        return '<p>Video tidak tersedia atau URL tidak valid.</p>';
    }
}
