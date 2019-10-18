<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Actus extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'actuses';

    protected $appends = [
        'cover',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'content',
        'created_at',
        'updated_at',
        'deleted_at',
        'division_id',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function getCoverAttribute()
    {
        $file = $this->getMedia('cover')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;
    }

    public function division()
    {
        return $this->belongsTo(Equipe::class, 'division_id');
    }
}
