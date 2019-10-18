<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Match extends Model
{
    use SoftDeletes;

    public $table = 'matches';

    protected $dates = [
        'start_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'ticket',
        'home_id',
        'away_id',
        'result_h',
        'result_a',
        'start_time',
        'created_at',
        'updated_at',
        'deleted_at',
        'division_id',
    ];

    public function home()
    {
        return $this->belongsTo(Equipe::class, 'home_id');
    }

    public function away()
    {
        return $this->belongsTo(Equipe::class, 'away_id');
    }

    public function getStartTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function division()
    {
        return $this->belongsTo(Equipe::class, 'division_id');
    }
}
