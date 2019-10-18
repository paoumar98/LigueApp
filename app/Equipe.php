<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Equipe extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'equipes';

    protected $appends = [
        'logo',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const DIVISION_RADIO = [
        '1' => 'Ligue 1',
        '2' => 'Ligue 2',
    ];

    protected $fillable = [
        'name',
        'division',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function matches()
    {
        return $this->hasMany(Match::class, 'home_id', 'id');
    }

    public function actuses()
    {
        return $this->hasMany(Actus::class, 'division_id', 'id');
    }

    public function getLogoAttribute()
    {
        $file = $this->getMedia('logo')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;
    }
}
